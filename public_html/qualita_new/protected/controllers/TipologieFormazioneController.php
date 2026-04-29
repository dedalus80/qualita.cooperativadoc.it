<?php

class TipologieFormazioneController extends Controller {

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

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new TipologieFormazione;


        if (isset($_POST['TipologieFormazione'])) {
            $model->attributes = $_POST['TipologieFormazione'];
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Nuova tipologia corso <b>' . $model->nome . "</b> creata con successo");
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);


        if (isset($_POST['TipologieFormazione'])) {
            $model->attributes = $_POST['TipologieFormazione'];
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Tipologia corso <b>' . $model->nome . ' </b> aggiornata con successo');

                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Tipologia corso <b>' . $model->nome . '</b> rimossa con successo');

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('TipologieFormazione');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new TipologieFormazione('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['TipologieFormazione']))
            $model->attributes = $_GET['TipologieFormazione'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = TipologieFormazione::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tipologie-formazione-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
