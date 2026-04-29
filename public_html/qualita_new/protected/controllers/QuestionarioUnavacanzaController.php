<?php

class QuestionarioUnavacanzaController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta', 'grafici'),
                'users' => Yii::app()->MyUtils->getPermition('QU'),
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
    
    public function actionEsporta($anni = null) {
        $model = new QuestionarioUnavacanza('search');
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }
    
    public function actionCreate() {
        $model = new QuestionarioUnavacanza;
        
        if (isset($_POST['QuestionarioUnavacanza'])) {
            $model->attributes = $_POST['QuestionarioUnavacanza'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('admin');
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['QuestionarioUnavacanza'])) {
            $model->attributes = $_POST['QuestionarioUnavacanza'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(  'model' => $model, ));
    }
   
    public function actionDelete($id) {
        $model = $this->loadModel($id);
        Yii::app()->user->setFlash('opResultOK', 'Questionario <b>' . $model->nome . "  ".$model->cognome."</b> rimosso con successo");
        $model->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('QuestionarioUnavacanza');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new QuestionarioUnavacanza('search');
        $model->setSelect();
        $model->unsetAttributes();  // clear any default values
        $model->setAttribute('anno', date("Y"));
        if (isset($_POST['QuestionarioUnavacanza']))
            $model->attributes = $_POST['QuestionarioUnavacanza'];

        $this->render('admin', array('model' => $model, ));
    }

    public function loadModel($id) {
        $model = QuestionarioUnavacanza::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionario-unavacanza-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
