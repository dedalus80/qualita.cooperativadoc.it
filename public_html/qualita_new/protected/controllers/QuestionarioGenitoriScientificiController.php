<?php

class QuestionarioGenitoriScientificiController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
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
        $model = new QuestionarioGenitoriScientifici('search');
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionGrafici($struttura= null, $anno = null, $gruppo = null, $turno= null) {

        $model = new QuestionarioGenitoriScientifici;

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
        $model = new QuestionarioGenitoriScientifici('search');
        $model->unsetAttributes();  // clear any default values
        $model->setSelect();
        $model->setAttribute('anno', date("Y"));
        if (isset($_GET['QuestionarioGenitoriScientifici']))
            $model->attributes = $_GET['QuestionarioGenitoriScientifici'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = QuestionarioGenitoriScientifici::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionario-genitori-scientifici-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
