<?php

class TimFascieController extends Controller {

    
    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete'),
                'users' => Yii::app()->MyUtils->getPermition('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionCreate() {
        $model = new TimFascie;
        
        if (isset($_POST['TimFascie'])) {
            $model->attributes = $_POST['TimFascie'];
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Nuova fascia  di reddito <b>' . $model->descrizione . "</b> creata con successo");
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['TimFascie'])) {
            $model->attributes = $_POST['TimFascie'];
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Fascia di reddito <b>' . $model->descrizione . ' </b> aggiornata con successo');
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array( 'model' => $model, ));
    }

    
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Fascia di reddito <b>' . $model->descrizione . '</b> rimossa con successo');
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        $model = new TimFascie('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['TimFascie']))
            $model->attributes = $_GET['TimFascie'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }
    
    public function loadModel($id) {
        $model = TimFascie::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tim-fascie-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
