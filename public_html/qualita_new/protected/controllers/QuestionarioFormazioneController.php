<?php

class QuestionarioFormazioneController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta', 'grafici','stampaGrafici'),
                'users' => Yii::app()->MyUtils->getPermition('QU'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function init()
    {
        parent::init();
        
        Yii::app()->clientScript->registerScriptFile('https://code.highcharts.com/highcharts.js');
        Yii::app()->clientScript->registerScriptFile('https://code.highcharts.com/modules/series-label.js');
        Yii::app()->clientScript->registerScriptFile('https://code.highcharts.com/modules/exporting.js');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/grafici_percentuale.js');
    }

    public function actionEsporta($anni = null) {
        $model = new QuestionarioFormazione('search');
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionGrafici() {
        
        $model          = new QuestionarioFormazione;
        $model->stats   = Yii::app()->MyStats->getStatsFormazione();
        $this->render('grafici', array('model' => $model,));
    }
    
    public function actionStampaGrafici() {
        
        $corso          = $_POST['corso'];

        $model          = new QuestionarioFormazione;
        
        $model->stats   = Yii::app()->MyStats->getStatsFormazione($corso);

        $fileName = preg_replace('/[^a-zA-Z0-9_.]/', '_', $corso);

        $html2pdf       = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_grafici', array('model' => $model,'nome' => $corso ), true));    
        $html2pdf->Output( YiiBase::getPathOfAlias('webroot').'/protected/stampe/questionari_formazione/'.$fileName.'.pdf', 'F');
        
        header('Content-Type: application/json; charset="UTF-8"');

        echo CJSON::encode(array('stampa' => '/protected/stampe/questionari_formazione/'.$fileName.'.pdf?ver='.time()));
        
        Yii::app()->end();
    }
    
    
    
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionCreate() {
        $model = new QuestionarioFormazione;
        $model->setSelect();


        if (isset($_POST['QuestionarioFormazione'])) {
            $model->attributes = $_POST['QuestionarioFormazione'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model->setSelect();
        if (isset($_POST['QuestionarioFormazione'])) {
            $model->attributes = $_POST['QuestionarioFormazione'];
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Questionario formazione  <b>' . $model->id . "</b> aggiornato con successo");
                $this->redirect(array('admin'));
            }
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
        $dataProvider = new CActiveDataProvider('QuestionarioFormazione');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new QuestionarioFormazione('search');
        $model->unsetAttributes();  // clear any default values
        $model->setSelect();
        $model->setAttribute('anno', date("Y"));
        if (isset($_POST['QuestionarioFormazione']))
            $model->attributes = $_POST['QuestionarioFormazione'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = QuestionarioFormazione::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionario-formazione-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
