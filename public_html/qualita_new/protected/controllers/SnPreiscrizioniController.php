<?php

class SnPreiscrizioniController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', 
        );
    }

   public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta'),
                'users' => Yii::app()->MyUtils->getPermition('SN'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    
    public function actionEsporta($anni = null) {
        $model = new SnPreiscrizioni('search');
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }
    
    
    public function actionView($id) {
        $this->render('view', array('model' => $this->loadModel($id),));
    }

    public function actionCreate() {
        $model = new SnPreiscrizioni;
        $model->setSelectValue();

        if (isset($_POST['SnPreiscrizioni'])) {
            $model->attributes = $_POST['SnPreiscrizioni'];
            $model->setAttribute('data_insert', date("Y") . "-" . date("m") . "-" . date("d"));
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Preiscrizione ' . $model->nome . ' ' . $model->cognome . '  creata con successo');
                $this->redirect(array('admin'));
            }
        }
        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->setSelectValue();
        if (isset($_POST['SnPreiscrizioni'])) {
            $model->attributes = $_POST['SnPreiscrizioni'];
            $model->setAttribute('data_insert', date("Y") . "-" . date("m") . "-" . date("d"));
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Preiscrizione ' . $model->nome . ' ' . $model->cognome . '  aggiornata con successo');
                $this->redirect(array('admin'));
            }
        }
        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {

        $model = $this->loadModel($id);
        Yii::app()->user->setFlash('opResultOK', 'Preiscrizione ' . $model->nome . ' ' . $model->cognome . '  rimossa con successo');
        $model->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('SnPreiscrizioni');
        $this->render('index', array('dataProvider' => $dataProvider,));
    }

    public function actionAdmin() {
        $model = new SnPreiscrizioni('search');
        $model->setSelectValue();
        $model->unsetAttributes();  // clear any default values
         $model->setAttribute('anno', date("Y"));
        if (isset($_POST['SnPreiscrizioni']))
            $model->attributes = $_POST['SnPreiscrizioni'];

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {
        $model = SnPreiscrizioni::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sn-preiscrizioni-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
