<?php

class QuestionarioTorremarinaController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta','grafici'),
                'users' => Yii::app()->MyUtils->getPermition('QU'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionEsporta($anni = null) {
        $model = new QuestionarioTorremarina('search');
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }
    
    
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new QuestionarioTorremarina;



        if (isset($_POST['QuestionarioTorremarina'])) {
            $model->attributes = $_POST['QuestionarioTorremarina'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }
    
    public function actionGrafici($struttura= null, $anno = null) {

        $model = new QuestionarioTorremarina;

        if ($struttura) {
            $model->struttura = Yii::app()->MyUtils->getSelectValue($struttura, "doc_unita");
            $model->struttura_nome = $struttura;
        }
        if ($anno)
            $model->anno = $anno;
        else
            $model->anno = date("Y");

        $model->selectStrutture = Yii::app()->MyUtils->getSelect("doc_unita_doc");
        $model->selectAnni = Yii::app()->MyUtils->getYears();
        $model->stats = $model->getAllStats();
        $this->render('grafici', array('model' => $model,));
    }
    
    
    
    public function actionUpdate($id) {
        $model = $this->loadModel($id);



        if (isset($_POST['QuestionarioTorremarina'])) {
            $model->attributes = $_POST['QuestionarioTorremarina'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('QuestionarioTorremarina');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new QuestionarioTorremarina('search');
        $model->unsetAttributes();  // clear any default values
        $model->setSelect() ;
        $model->setAttribute('anno', date("Y"));
        if (isset($_POST['QuestionarioTorremarina']))
            $model->attributes = $_POST['QuestionarioTorremarina'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = QuestionarioTorremarina::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionario-torremarina-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
