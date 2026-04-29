<?php

class MatricoleController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta', 'getAzione', 'azione', 'statistiche'),
                'users' => Yii::app()->MyUtils->getPermition('azioni'),
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
        $model = new Matricole;
        $model->setSelect();
        if (isset($_POST['Matricole'])) {
            $model->attributes = $_POST['Matricole'];
            if ($model->save()) {

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "mac", "create", $model->id);

                Yii::app()->user->setFlash('opResultOK', 'matricola contatore <b>' . $model->matricola . "</b> creata con successo");
                $this->redirect(array('admin'));
            }
        }
        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->setSelect();
        if (isset($_POST['Matricole'])) {
            $model->attributes = $_POST['Matricole'];
            if ($model->save()) {

                // INVIO NOTIFICHE PUSH
                Yii::app()->MyPush->newNotificaton($model->tableName(), "mac", "update", $model->id);

                Yii::app()->user->setFlash('opResultOK', 'matricola contatore <b>' . $model->matricola . "</b> aggiornata con successo");
                $this->redirect(array('admin'));
            }
        }
        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);

        // INVIO NOTIFICHE PUSH
        Yii::app()->MyPush->newNotificaton($model->tableName(), "mac", "delete", $model->id);

        Yii::app()->user->setFlash('opResultOK', 'Matricola contatore <b>' . $model->matricola . "</b> rimossa con successo");
        $model->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Matricole');
        $this->render('index', array('dataProvider' => $dataProvider,));
    }

    public function actionAdmin() {

        $model = new Matricole('search');
        $model->unsetAttributes();  // clear any default values
        $model->setSelect();

        if (isset($_POST['Matricole']))
            $model->attributes = $_POST['Matricole'];
        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {
        $model = Matricole::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'matricole-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
