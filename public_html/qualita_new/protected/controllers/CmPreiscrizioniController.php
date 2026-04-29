<?php

class CmPreiscrizioniController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl',);
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta'),
                'users' => Yii::app()->MyUtils->getPermition('CM'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionCreate() {
        $model = new CmPreiscrizioni;
        $model->setSelectValue();
        if (isset($_POST['CmPreiscrizioni'])) {
            $model->attributes = $_POST['CmPreiscrizioni'];
            $model->setAttribute('data_nascita', Yii::app()->MyUtils->reverseDate($model->data_nascita));
            $model->setAttribute('data_rilascio', Yii::app()->MyUtils->reverseDate($model->data_rilascio));
            $model->setAttribute('altro_data_nascita', Yii::app()->MyUtils->reverseDate($model->altro_data_nascita));
            $model->setAttribute('data_nascita_figlio', Yii::app()->MyUtils->reverseDate($model->data_nascita_figlio));
            if ($model->save()) {
                $this->redirect(array('admin', 'id' => $model->id));
            }
        }
        $this->render('create', array('model' => $model,));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->setSelectValue();
        if (isset($_POST['CmPreiscrizioni'])) {
            $model->attributes = $_POST['CmPreiscrizioni'];
            $model->setAttribute('data_nascita', Yii::app()->MyUtils->reverseDate($model->data_nascita));
            $model->setAttribute('data_rilascio', Yii::app()->MyUtils->reverseDate($model->data_rilascio));
            $model->setAttribute('altro_data_nascita', Yii::app()->MyUtils->reverseDate($model->altro_data_nascita));
            $model->setAttribute('data_nascita_figlio', Yii::app()->MyUtils->reverseDate($model->data_nascita_figlio));
            if ($model->save()) {
                $this->redirect(array('admin', 'id' => $model->id));
            }
        }
        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {
       $model =  $this->loadModel($id);
       $model->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {
        $model = new CmPreiscrizioni('search');
        $model->unsetAttributes();  // clear any default values
        $model->setSelectValue();
        if (isset($_POST['CmPreiscrizioni']))
            $model->attributes = $_POST['CmPreiscrizioni'];
        $this->render('admin', array( 'model' => $model, ));
    }

    public function loadModel($id) {
        $model = CmPreiscrizioni::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cm-preiscrizioni-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionEsporta($anni = null) {
        $model = new CmPreiscrizioni('search');
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }


}
