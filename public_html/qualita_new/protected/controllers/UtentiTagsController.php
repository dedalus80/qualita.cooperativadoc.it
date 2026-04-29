<?php

class UtentiTagsController extends Controller
{
    public $layout = '//layouts/column2';

    public function filters()
    {
        return array('accessControl');
    }

    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('admin', 'create', 'update', 'delete', 'assegna', 'ajaxUserSearch'),
                'expression' => 'Yii::app()->user->getState("group") == "ADMIN"',
            ),
            array('deny', 'users' => array('*')),
        );
    }

    public function actionAdmin()
    {
        $model = new UtentiTag('search');
        $model->unsetAttributes();

        if (isset($_POST['UtentiTag'])) {
            $model->attributes = $_POST['UtentiTag'];
        }

        $this->render('admin', array('model' => $model));
    }

    public function actionCreate()
    {
        $model = new UtentiTag;

        if (isset($_POST['UtentiTag'])) {
            $model->attributes = $_POST['UtentiTag'];
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Tag <b>' . CHtml::encode($model->nome) . '</b> creato con successo');
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['UtentiTag'])) {
            $model->attributes = $_POST['UtentiTag'];
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Tag <b>' . CHtml::encode($model->nome) . '</b> aggiornato con successo');
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $nome = $model->nome;
        $model->delete();

        Yii::app()->user->setFlash('opResultOK', 'Tag <b>' . CHtml::encode($nome) . '</b> rimosso con successo');

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    public function actionAssegna()
    {
        $model = new UtentiTagAssoc;
        $tagOptions = UtentiTag::getOptions();
        $utentiSelezionati = array();
        $utentiSelezionatiDettaglio = array();

        if (isset($_POST['UtentiTagAssoc'])) {
            $tagId = isset($_POST['UtentiTagAssoc']['tag_id']) ? (int)$_POST['UtentiTagAssoc']['tag_id'] : 0;
            $utentiSelezionati = isset($_POST['utenti_ids']) ? $_POST['utenti_ids'] : array();

            if ($tagId <= 0) {
                Yii::app()->user->setFlash('opResultKO', 'Seleziona un tag valido');
            } else {
                $inserted = 0;
                $cleanIds = array();

                foreach ((array)$utentiSelezionati as $utenteId) {
                    $utenteId = (int)$utenteId;
                    if ($utenteId > 0) {
                        $cleanIds[] = $utenteId;
                    }
                }

                $cleanIds = array_values(array_unique($cleanIds));

                foreach ($cleanIds as $utenteId) {
                    $exists = UtentiTagAssoc::model()->exists('utente_id=:utente_id AND tag_id=:tag_id', array(
                        ':utente_id' => $utenteId,
                        ':tag_id' => $tagId,
                    ));

                    if (!$exists) {
                        $assoc = new UtentiTagAssoc;
                        $assoc->utente_id = $utenteId;
                        $assoc->tag_id = $tagId;
                        if ($assoc->save()) {
                            $inserted++;
                        }
                    }
                }

                if ($inserted > 0) {
                    Yii::app()->user->setFlash('opResultOK', 'Tag assegnato a <b>' . $inserted . '</b> utenti');
                } else {
                    Yii::app()->user->setFlash('opResultKO', 'Nessuna nuova assegnazione effettuata');
                }
            }
        }

        $cleanIds = array();
        foreach ((array)$utentiSelezionati as $utenteId) {
            $utenteId = (int)$utenteId;
            if ($utenteId > 0) {
                $cleanIds[] = $utenteId;
            }
        }

        $cleanIds = array_values(array_unique($cleanIds));
        if (!empty($cleanIds)) {
            $criteria = new CDbCriteria();
            $criteria->addInCondition('id', $cleanIds);
            $utenti = Utenti::model()->findAll($criteria);

            foreach ($utenti as $utente) {
                $utentiSelezionatiDettaglio[$utente->id] = array(
                    'id' => (int)$utente->id,
                    'label' => $utente->cognome . ' ' . $utente->nome . ' (' . $utente->user . ')',
                );
            }
        }

        $this->render('assegna', array(
            'model' => $model,
            'tagOptions' => $tagOptions,
            'utentiSelezionati' => $utentiSelezionati,
            'utentiSelezionatiDettaglio' => $utentiSelezionatiDettaglio,
        ));
    }

    public function actionAjaxUserSearch()
    {
        $term = isset($_POST['term']) ? trim($_POST['term']) : '';
        $response = array('results' => array());

        if (mb_strlen($term) >= 3) {
            $criteria = new CDbCriteria();
            $criteria->select = 't.id, t.nome, t.cognome, t.user, t.email';
            $criteria->condition = 't.nome LIKE :term OR t.cognome LIKE :term OR t.user LIKE :term OR t.email LIKE :term';
            $criteria->params = array(':term' => '%' . $term . '%');
            $criteria->order = 't.cognome ASC, t.nome ASC';
            $criteria->limit = 30;

            $utenti = Utenti::model()->findAll($criteria);
            foreach ($utenti as $utente) {
                $response['results'][] = array(
                    'id' => (int)$utente->id,
                    'label' => $utente->cognome . ' ' . $utente->nome . ' (' . $utente->user . ')',
                    'email' => $utente->email,
                );
            }
        }

        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode($response);
        Yii::app()->end();
    }

    public function loadModel($id)
    {
        $model = UtentiTag::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'La pagina richiesta non esiste');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'utenti-tag-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
