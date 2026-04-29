<?php

class LettureController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta', 'elenco', 'azione', 'statistiche'),
                'users' => Yii::app()->MyUtils->getPermition('azioni'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionEsporta($id) {
        $model = new Letture('search');
        $model->id_matricola = $id;
        $model->datiEsportazione = $model->getEsportazione();
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionView($id) {

        $model = new Letture('search');
        $model->unsetAttributes();
        $model->setAttribute('id_matricola', $id);
        $model->setSelect();


        if (isset($_GET['Letture']))
            $model->attributes = $_GET['Letture'];
        $this->render('admin', array('model' => $model));
    }

    public function actionElenco() {
        $model = new Letture('search');
        $model->unsetAttributes();
        $model->setSelect();
        $model->letture = $model->getContatori();
        if (isset($_GET['Letture']))
            $model->attributes = $_GET['Letture'];
        $this->render('elenco', array('model' => $model));
    }

    public function actionCreate() {
        $model = new Letture;
        $model->setSelect();

        if (isset($_POST['Letture'])) {

            $model->attributes = $_POST['Letture'];
            $model->setAttribute('data_lettura', Yii::app()->MyUtils->reverseDate($model->data_lettura));
            if ($model->save()) {
                $model->getDifferenza();
                $contatore = Yii::app()->MyUtils->getSelectValue($data->id_matricola, "doc_matricole");
                
                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton("utenze_matricole", "lec", "create", $model->id_matricola);
                
                Yii::app()->user->setFlash('opResultOK', 'Nuovo lettura contatore <b>' . $contatore . "</b> creata con successo");
                $this->redirect(array('elenco'));
            }
        }
        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->setSelect();
        if (isset($_POST['Letture'])) {

            $model->attributes = $_POST['Letture'];
            $model->setAttribute('data_lettura', Yii::app()->MyUtils->reverseDate($model->data_lettura));
            if ($model->save()) {
                $model->getDifferenza();
                $contatore = Yii::app()->MyUtils->getSelectValue($data->id_matricola, "doc_matricole");
                
                 // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton("utenze_matricole", "lec", "update", $model->id_matricola);
                
                Yii::app()->user->setFlash('opResultOK', 'Lettura contatore <b>' . $contatore . "</b> aggiornata con successo");
                $this->redirect(array('elenco'));
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        $model->getDifferenza();
        $contatore = Yii::app()->MyUtils->getSelectValue($data->id_matricola, "doc_matricole");
        
        // INVIO NOTIFICHE PUSH
        Yii::app()->MyPush->newNotificaton("utenze_matricole", "lec", "delete", $model->id_matricola);
        
        Yii::app()->user->setFlash('opResultOK', 'Lettura contatore <b>' . $contatore . "</b> rimossa con successo");
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('elenco'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Letture');
        $this->render('index', array('dataProvider' => $dataProvider,));
    }

    public function actionAdmin() {
        $model = new Letture('search');
        $model->unsetAttributes();
        $model->setSelect();
        if (isset($_GET['Letture']))
            $model->attributes = $_GET['Letture'];
        $this->render('admin', array('model' => $model));
    }

    public function loadModel($id) {
        $model = Letture::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'letture-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
