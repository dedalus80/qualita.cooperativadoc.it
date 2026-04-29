<?php

class QuestionarioDocController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl',
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

    public function actionView($id) {
        $this->render('view', array('model' => $this->loadModel($id),));
    }

    public function actionStampa($id) {
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('_print', array('model' => $this->loadModel($id)), true));
        $html2pdf->Output('Questionario-doc-' . $id . '.pdf', 'D');
    }

    public function actionStampaStats($id=null) {
        $model = new QuestionarioDoc;
        if ($id)
            $nomeStruttura = $model->getSelectValue($id, "doc_unita");
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('_stampa', array('model' => $model, 'struttura' => $id, 'nomeStruttura' => $nomeStruttura), true));
        $html2pdf->Output('Statistiche_questionari_doc.pdf', 'D');
    }

    public function actionEsporta($anni = null) {
        $model = new QuestionarioDoc('search');
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionGrafici($struttura= null, $anno = null) {
        
        $model = new QuestionarioDoc;
        
        // Cambiare con anno corrente quando cominciano ad arrivare questionari
        !$anno ?  $anno = date("Y") :"";
        $model->anno = $anno ; 
        
        $model->selectStrutture     = Yii::app()->MyUtils->getSoggiorniQ("questionario_doc",'struttura_nome');
        $model->selectAnni          = Yii::app()->MyUtils->getYearsQ("questionario_doc");
        $model->stats               = Yii::app()->MyStats->getStatsQuestionari("questionario_doc", $struttura,$anno);
        $this->render('grafici', array('model' => $model));
    }
    
    public function actionStampaGrafici() {
        
        $struttura      = $_POST['struttura']  ;
        $anno           = $_POST['anno'] ;
        $model          = new QuestionarioDoc;
        
        $struttura ? $nome = Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id ='".$struttura."'" )->queryScalar() : "";
        $struttura ? $file = 'statistiche-'.str_replace(" ","_",$nome)."-".$anno : $file ='statistiche-'.$anno ;
        
        
        
        $model->stats   = Yii::app()->MyStats->getStatsQuestionari("questionario_doc", $struttura,$anno);
        $html2pdf       = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_grafici', array('model' => $model,'anno' => $anno , 'struttura'=>$struttura , 'nome' => $nome), true));
        
        $html2pdf->Output( YiiBase::getPathOfAlias('webroot').'/protected/stampe/questionari_doc/'.$file.'.pdf', 'F');
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('stampa' => '/protected/stampe/questionari_doc/'.$file.'.pdf?ver='.time()));
        Yii::app()->end();
    }
    
    
    public function actionCreate($id= null, $anno = null) {

        $model = new QuestionarioDoc;

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

        $this->render('create', array('model' => $model,));
    }

    public function actionCreati() {
        $model = new QuestionarioDoc;
        if (isset($_POST['QuestionarioDoc'])) {
            $model->attributes = $_POST['QuestionarioDoc'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        if (isset($_POST['QuestionarioDoc'])) {
            $model->attributes = $_POST['QuestionarioDoc'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }
        $this->render('update', array('model' => $model,));
    }

    public function actionDelete($id) {
        $this->loadModel($id)->delete();
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('QuestionarioDoc');
        $this->render('index', array('dataProvider' => $dataProvider,));
    }

    public function actionAdmin() {
        $model = new QuestionarioDoc('search');
        $model->setSelect();
        $model->unsetAttributes();
        $model->setAttribute('anno', date("Y"));

        if (isset($_GET['QuestionarioDoc']))
            $model->attributes = $_GET['QuestionarioDoc'];

        $this->render('admin', array('model' => $model));
    }

    public function loadModel($id) {
        $model = QuestionarioDoc::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionario-doc-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
