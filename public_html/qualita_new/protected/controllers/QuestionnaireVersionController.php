<?php

class QuestionnaireVersionController extends Controller
{
    public function filters()
    {
        return array(
            'accessControl',
            'postOnly + delete',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'cloneVersion', 'setActive', 'preview'),
                'expression'=>'Yii::app()->user->getState("group") == "ADMIN"',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex($questionnaire_id = null)
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('questionnaire');
        $criteria->order = 't.created_at DESC';
        
        // Filtra per questionario se specificato
        if ($questionnaire_id !== null) {
            $criteria->condition = 't.questionnaire_id = :questionnaire_id';
            $criteria->params = array(':questionnaire_id' => $questionnaire_id);
            
            // Carica il questionario per i breadcrumbs
            $questionnaire = Questionnaire::model()->findByPk($questionnaire_id);
            if ($questionnaire) {
                $this->breadcrumbs = array(
                    'Questionari' => array('questionnaire/index'),
                    $questionnaire->title => array('questionnaire/view', 'id' => $questionnaire_id),
                    'Versioni',
                );
            }
        } else {
            $this->breadcrumbs = array(
                'Questionari' => array('questionnaire/index'),
                'Versioni',
            );
        }
        
        $dataProvider = new CActiveDataProvider('QuestionnaireVersion', array(
            'criteria' => $criteria,
        ));
        
        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'questionnaire_id' => $questionnaire_id,
        ));
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);

        // Breadcrumbs dinamici
        $this->breadcrumbs = array(
            'Questionari' => array('questionnaire/index'),
            $model->questionnaire->title => array('questionnaire/view', 'id' => $model->questionnaire_id),
            'Versioni' => array('questionnaireVersion/index', 'questionnaire_id' => $model->questionnaire_id),
            'Versione ' . $model->version_number,
        );

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionCreate($questionnaire_id)
    {
        $model = new QuestionnaireVersion;
        $model->questionnaire_id = $questionnaire_id;

        // calcola version_number incrementale
        $lastVersion = QuestionnaireVersion::model()->find(array(
            'condition' => 'questionnaire_id=:qid',
            'params' => array(':qid'=>$questionnaire_id),
            'order' => 'version_number DESC',
        ));

        $model->version_number = $lastVersion ? $lastVersion->version_number + 1 : 1;

        if(!$lastVersion) {
            $model->is_active = 1;
        }

        if (isset($_POST['QuestionnaireVersion'])) {
            $model->attributes = $_POST['QuestionnaireVersion'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Versione creata con successo.');
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['QuestionnaireVersion'])) {
            $model->attributes = $_POST['QuestionnaireVersion'];
            if ($model->save()) {
                Yii::app()->user->setFlash('success', 'Versione aggiornata.');
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        if ($model->hasResponses() || $model->isActive()) {
            Yii::app()->user->setFlash('error', 'Impossibile eliminare questa versione perché ha già ricevuto risposte.');
            $this->redirect(array('view', 'id' => $model->id));
            return;
        }

        // Se non ha risposte, elimina la versione
        $model->delete();

        Yii::app()->user->setFlash('success', 'Versione eliminata con successo.');
        $this->redirect(array('questionnaire/view', 'id' => $model->questionnaire_id));
    }


    /**
     * Clone logico della versione con sezioni e domande
     */
    public function actionCloneVersion($id)
    {
        $transaction = Yii::app()->db->beginTransaction();

        try {
            $version = $this->loadModel($id);

            // crea nuova versione
            $newVersion = new QuestionnaireVersion;
            $newVersion->questionnaire_id = $version->questionnaire_id;
            $newVersion->version_number = $version->version_number + 1;
            $newVersion->description = 'Clone di versione '.$version->version_number;
            if (!$newVersion->save())
                throw new Exception('Errore creazione nuova versione');

            // clona sezioni e domande
            foreach ($version->sections as $section) {
                $newSection = new QuestionnaireSection;
                $newSection->attributes = $section->attributes;
                $newSection->version_id = $newVersion->id;
                if (!$newSection->save())
                    throw new Exception('Errore clonazione sezione');

                foreach ($section->questions as $question) {
                    $newQuestion = new Question;
                    $newQuestion->attributes = $question->attributes;
                    $newQuestion->section_id = $newSection->id;
                    if (!$newQuestion->save())
                        throw new Exception('Errore clonazione domanda');
                }
            }

            $transaction->commit();
            Yii::app()->user->setFlash('success', 'Versione clonata con successo.');
            $this->redirect(array('view', 'id' => $newVersion->id));

        } catch(Exception $e) {

            print_r($e->getMessage());
            exit;
            $transaction->rollback();
            Yii::app()->user->setFlash('error', 'Errore durante la clonazione: '.$e->getMessage());
            $this->redirect(array('view', 'id' => $id));
        }
    }

    public function loadModel($id)
    {
        $model = QuestionnaireVersion::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Versione non trovata.');
        return $model;
    }

    public function actionSetActive($id)
    {
        $model = $this->loadModel($id);

        // Se è già attiva, non serve fare nulla
        if ($model->isActive()) {
            Yii::app()->user->setFlash('info', 'Questa versione è già attiva.');
            $this->redirect(array('view', 'id' => $model->id));
            return;
        }

        // Disattiva tutte le versioni dello stesso questionario
        QuestionnaireVersion::model()->updateAll(
            array('is_active' => 0),
            'questionnaire_id = :qid',
            array(':qid' => $model->questionnaire_id)
        );

        // Attiva questa versione
        $model->is_active = 1;

        if ($model->save(false)) {
            Yii::app()->user->setFlash('success', 'La versione è stata attivata correttamente.');
        } else {
            Yii::app()->user->setFlash('error', 'Errore durante l\'attivazione della versione.');
        }

        $this->redirect(array('questionnaireVersion/view', 'id' => $model->id));
    }

    public function actionPreview($id)
    {
        $model = $this->loadModel($id);
        $sections = QuestionnaireSection::model()
            ->with(array(
                'questions' => array(
                    'order' => '`questions`.`order` ASC',
                    'with' => array(
                        'options' => array(
                            'order' => '`options`.`order` ASC',
                        )
                    )
                )
            ))
            ->findAll(array(
                'condition' => 'version_id = :vid',
                'params' => array(':vid' => $model->id),
                'order' => '`t`.`order` ASC',
            ));


        $modal = isset($_GET['modal']) && $_GET['modal'] == '1' ? true : false;

        if($modal) {
            $this->renderPartial('_preview', array(
                'model' => $model,
                'sections' => $sections,
            ));
            Yii::app()->end();
        }
        else {
            $this->render('preview', array(
                'model' => $model,
                'sections' => $sections,
            ));
        }
    }

}
