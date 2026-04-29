<?php

class QuestionarioGenitoriStudioController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin', 'delete', 'view', 'esporta', 'grafici'),
                'users' => Yii::app()->MyUtils->getPermition('q_junior'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionEsporta($anni = null) {
        $model = new QuestionarioGenitoriStudio('search');
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionGrafici($struttura= null, $anno = null, $gruppo = null, $turno= null) {

        $model = new QuestionarioGenitoriStudio;

        if ($struttura) {
            $model->struttura = Yii::app()->MyUtils->getSelectValue($struttura, "doc_unita");
            $model->soggiorno = $model->id_struttura = $struttura;
        }
        if ($gruppo)
            $model->nome_gruppo = urldecode($gruppo);
        if ($turno)
            $model->turno = $turno;
        if ($anno)
            $model->anno = $anno;
        else
            $model->anno = date("Y");

        $model->setSelect();
        $model->stats = $model->getAllStats();
        $this->render('grafici', array('model' => $model,));
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Questionario <b>' . $model->nome . " " . $model->cognome . "</b> eliminato con successo");
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        $model = new QuestionarioGenitoriStudio('search');
        $model->unsetAttributes();  // clear any default values
        $model->setSelect();
        $model->setAttribute('anno', date("Y"));

        if (isset($_GET['QuestionarioGenitoriStudio']))
            $model->attributes = $_GET['QuestionarioGenitoriStudio'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = QuestionarioGenitoriStudio::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionario-genitori-studio-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
