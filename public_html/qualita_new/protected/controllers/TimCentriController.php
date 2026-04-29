<?php

class TimCentriController extends Controller {

    
    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete','setOnline'),
                'users' => Yii::app()->MyUtils->getPermition('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionSetOnline(){
        $online = Yii::app()->MyUtils->setOnline($_POST);        
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('online' => $online ));
        Yii::app()->end();
    }
    
    public function actionCreate() {
        $model = new TimCentri;
        $model->setDefaultValues();
        
        if (isset($_POST['TimCentri'])) {
            $model->attributes = $_POST['TimCentri'];
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Nuovo centro <b>' . $model->nome . "</b> creato con successo");
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->setDefaultValues();
        
        if (isset($_POST['TimCentri'])) {
            $model->attributes = $_POST['TimCentri'];
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Centro <b>' . $model->nome . ' </b> aggiornato con successo');
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array( 'model' => $model, ));
    }
        
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Centro <b>' . $model->nome . '</b> rimosso con successo');
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        $model = new TimCentri('search');
        $model->setDefaultValues();
        
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['TimCentri']))
            $model->attributes = $_GET['TimCentri'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }
    
    public function loadModel($id) {
        $model = TimCentri::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
        
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tim-centri-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
