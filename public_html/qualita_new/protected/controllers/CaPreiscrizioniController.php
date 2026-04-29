<?php

class CaPreiscrizioniController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta'),
                'users' => Yii::app()->MyUtils->getPermition('CS'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array('model' => $this->loadModel($id),));
    }

    public function actionCreate() {
        $model = new CaPreiscrizioni;
        $model->setSelectValue();
        

        if (isset($_POST['CaPreiscrizioni'])) {
            $model->attributes = $_POST['CaPreiscrizioni'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->setSelectValue();
        if (isset($_POST['CaPreiscrizioni'])) {
            
            $model->attributes = $_POST['CaPreiscrizioni'];
            $model->setAttribute('data_nascita', Yii::app()->MyUtils->reverseDate($model->data_nascita));
            $model->setAttribute('data_in', Yii::app()->MyUtils->reverseDate($model->data_in));
            $model->setAttribute('data_out', Yii::app()->MyUtils->reverseDate($model->data_out));
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }
        
        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('CaPreiscrizioni');
        $this->render('index', array('dataProvider' => $dataProvider));
    }

    public function actionAdmin() {
        $model = new CaPreiscrizioni('search');
        $model->unsetAttributes();  // clear any default values
        $model->setSelectValue();
         $model->setAttribute('anno', date("Y"));
        if (isset($_POST['CaPreiscrizioni']))
            $model->attributes = $_POST['CaPreiscrizioni'];

        $this->render('admin', array('model' => $model));
    }

    public function actionStampa($id) {
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('_print', array('model' => $this->loadModel($id)), true));
        $html2pdf->Output('CampusSanPaolo_Presiscrizione-' . $id . '.pdf', 'D');
    }

    public function actionEsporta($anni = null) {
        $model = new CaPreiscrizioni('search');
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function loadModel($id) {
        $model = CaPreiscrizioni::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ca-preiscrizioni-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
