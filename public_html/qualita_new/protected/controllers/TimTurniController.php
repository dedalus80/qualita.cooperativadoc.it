<?php

class TimTurniController extends Controller {

    
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
        echo CJSON::encode(array('online' => $online  ));
        Yii::app()->end();
    }
    
    public function actionCreate() {
        $model = new TimTurni;
        $model->setDefaultValues();
        
        if (isset($_POST['TimTurni'])) {
            $model->attributes = $_POST['TimTurni'];
             $model->setAttribute('data_inizio', Yii::app()->MyUtils->reverseDate($model->data_inizio));
             $model->setAttribute('data_fine', Yii::app()->MyUtils->reverseDate($model->data_fine));
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Nuovo turno <b>' . $model->codice . "</b> creato con successo");
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        
        $model = $this->loadModel($id);
        $model->setDefaultValues();
        
        if (isset($_POST['TimTurni'])) {
            $model->attributes = $_POST['TimTurni'];
            $model->setAttribute('data_inizio', Yii::app()->MyUtils->reverseDate($model->data_inizio));
            $model->setAttribute('data_fine', Yii::app()->MyUtils->reverseDate($model->data_fine));
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Turno <b>' . $model->codice . ' </b> aggiornato con successo');
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array( 'model' => $model, ));
    }
        
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Turno <b>' . $model->codice . '</b> rimosso con successo');
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        
        $model = new TimTurni('search');
        $model->setDefaultValues();
        
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['TimTurni']))
            $model->attributes = $_GET['TimTurni'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }
    
    public function loadModel($id) {
        $model = TimTurni::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
        
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tim-turni-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
