<?php

class CentriController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view'),
                'users' => Yii::app()->MyUtils->getPermition('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionCreate() {
        $model = new Centri;
        $model->setDefaultValue() ;
        if (isset($_POST['Centri'])) {
            $model->attributes = $_POST['Centri'];
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Nuova centro <b>' . $model->nome . "</b> creato con successo");
                $this->redirect(array('admin'));
            }
        }
        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->setDefaultValue() ;
        if (isset($_POST['Centri'])) {
            $model->attributes = $_POST['Centri'];
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Centro <b>' . $model->nome . "</b> agiornato con successo");
                $this->redirect(array('admin'));
            }
        }
        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Centro <b>' . $model->nome . '</b> rimosso con successo');
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        $model = new Centri('search');
        $model->setDefaultValue() ;
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Centri']))
            $model->attributes = $_GET['Centri'];
        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {
        $model = Centri::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'centri-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
