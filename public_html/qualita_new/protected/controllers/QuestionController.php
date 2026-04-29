<?php

class QuestionController extends Controller
{
    public $layout = 'main'; // usa layout del modulo se presente

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
                'actions' => array('index', 'view', 'create', 'update', 'delete'),
                'expression'=>'Yii::app()->user->getState("group") == "ADMIN"',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Question');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);

        // Breadcrumbs dinamici
        $this->breadcrumbs = array(
            'Questionari' => array('questionnaire/index'),
            $model->section->version->questionnaire->title => array('questionnaire/view', 'id' => $model->section->version->questionnaire_id),
            'Versioni' => array('questionnaireVersion/index', 'questionnaire_id' => $model->section->version->questionnaire_id),
            'Versione ' . $model->section->version->version_number => array('questionnaireVersion/view', 'id' => $model->section->version_id),
            'Sezioni' => array('questionnaireSection/index', 'version_id' => $model->section->version_id),
            $model->section->title => array('questionnaireSection/view', 'id' => $model->section_id),
            'Domanda #' . $model->id,
        );

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionCreate($section_id)
    {
        $model = new Question;
        $model->section_id = $section_id;

        if (isset($_POST['Question'])) {
            $model->attributes = $_POST['Question'];
            
            // Gestione campi condizionali
            if (empty($_POST['Question']['condition_question_id']) || empty($_POST['Question']['condition_operator']) || empty($_POST['Question']['condition_value'])) {
                $model->condition_question_id = null;
                $model->condition_operator = null;
                $model->condition_value = null;
            }
            
            if ($model->save()) {
                // Gestione opzioni custom
                if ($model->type === 'custom' && !empty($_POST['custom_options'])) {
                    $options = preg_split('/\r?\n/', trim($_POST['custom_options']));
                    $order = 1;
                    foreach ($options as $opt) {
                        $opt = trim($opt);
                        if ($opt === '') continue;
                        $option = new QuestionOption();
                        $option->question_id = $model->id;
                        $option->option_text = $opt;
                        $option->value = $order;
                        $option->order = $order;
                        $option->save();
                        $order++;
                    }
                }
                Yii::app()->user->setFlash('success', 'Domanda creata con successo.');
                $this->redirect(array('questionnaireSection/view', 'id'=>$section_id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Question'])) {
            $model->attributes = $_POST['Question'];
            
            // Gestione campi condizionali
            if (empty($_POST['Question']['condition_question_id']) || empty($_POST['Question']['condition_operator']) || empty($_POST['Question']['condition_value'])) {
                $model->condition_question_id = null;
                $model->condition_operator = null;
                $model->condition_value = null;
            }
            
            if ($model->save()) {
                // Gestione opzioni custom
                if ($model->type === 'custom') {
                    // Elimina le vecchie opzioni
                    QuestionOption::model()->deleteAllByAttributes(['question_id' => $model->id]);
                    if (!empty($_POST['custom_options'])) {
                        $options = preg_split('/\r?\n/', trim($_POST['custom_options']));
                        $order = 1;
                        foreach ($options as $opt) {
                            $opt = trim($opt);
                            if ($opt === '') continue;
                            $option = new QuestionOption();
                            $option->question_id = $model->id;
                            $option->option_text = $opt;
                            $option->value = $order;
                            $option->order = $order;
                            $option->save();
                            $order++;
                        }
                    }
                }
                Yii::app()->user->setFlash('success', 'Domanda aggiornata.');
                $this->redirect(array('questionnaireSection/view', 'id'=>$model->section_id));
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $model = $this->loadModel($id);
            $section_id = $model->section_id;
            $model->delete();

            Yii::app()->user->setFlash('success', 'Domanda eliminata.');
            $this->redirect(array('questionnaireSection/view', 'id'=>$section_id));
        } else {
            throw new CHttpException(400, 'Richiesta non valida.');
        }
    }

    public function loadModel($id)
    {
        $model = Question::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Domanda non trovata.');
        return $model;
    }
}
