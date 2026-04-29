<?php

class SpPreiscrizioniController extends Controller {

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
                'users' => Yii::app()->MyUtils->getPermition('SP'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $this->render('view', array('model' => $this->loadModel($id),));
    }

    public function actionStampa($id) {
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('_print', array('model' => $this->loadModel($id)), true));
        $html2pdf->Output('Stessopiano_Presiscrizione-' . $id . '.pdf', 'D');
    }

    public function actionEsporta($anni = null) {
        $model = new SpPreiscrizioni('search');
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionCreate() {
        $model = new SpPreiscrizioni;
        $model->setSelectValue();

        if (isset($_POST['SpPreiscrizioni'])) {
            $model->attributes = $_POST['SpPreiscrizioni'];
            
            $model->setAttribute('data_nascita', Yii::app()->MyUtils->reverseDate($model->data_nascita));
            $model->setAttribute('data_in', Yii::app()->MyUtils->reverseDate($model->data_in));
            $model->setAttribute('data_out', Yii::app()->MyUtils->reverseDate($model->data_out));
            $model->setAttribute('scadenza_documento', Yii::app()->MyUtils->reverseDate($model->scadenza_documento));
                        
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Pre iscrizione  <b>' . $model->nome . ' ' . $model->cognome . '</b> crata con successo');
                $this->redirect(array('admin'));
            }
        }
        $this->render('create');
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->setSelectValue();
        
        if (isset($_POST['SpPreiscrizioni'])) {
            $model->attributes = $_POST['SpPreiscrizioni'];
            
            $model->setAttribute('data_nascita', Yii::app()->MyUtils->reverseDate($model->data_nascita));
            $model->setAttribute('data_in', Yii::app()->MyUtils->reverseDate($model->data_in));
            $model->setAttribute('data_out', Yii::app()->MyUtils->reverseDate($model->data_out));
            $model->setAttribute('scadenza_documento', Yii::app()->MyUtils->reverseDate($model->scadenza_documento));
            
            
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Pre iscrizione  <b>' . $model->nome . ' ' . $model->cognome . '</b> aggiornata con successo');
                $this->redirect(array('admin'));
            }
        }
        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {
        $model = $this->loadModel($id);
        Yii::app()->user->setFlash('opResultOK', 'Pre iscrizione <b>' . $model->nome . ' ' . $model->cognome . '</b> rimossa con successo');
        $model->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin() {

        $model = new SpPreiscrizioni('search');
        $model->unsetAttributes();  // clear any default values
        $model->setAttribute('anno', date("Y"));
        $model->setSelectValue();

        if (isset($_POST['SpPreiscrizioni']))
            $model->attributes = $_POST['SpPreiscrizioni'];

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id) {
        $model = SpPreiscrizioni::model()->findByPk($id);
		
		
		//$model = SpPreiscrizioni::model()->with('lavoratori')->findByPk($id);
		
		
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sp-preiscrizioni-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
