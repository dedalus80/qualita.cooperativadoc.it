<?php

class QuestionarioKeluarController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta','stampa','grafici','stampaGrafici' ),
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
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionStampa($id) {
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('_print', array('model' => $this->loadModel($id)), true));
        $html2pdf->Output('Questionario_keluar-' . $id . '.pdf', 'D');
    }

    public function actionStampaStats($id= null, $periodo=NULL) {
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $model = new QuestionarioKeluar;
        if ($id) {
            $nomeStruttura = $model->getSelectValue($id, "doc_unita");
            $html2pdf->WriteHTML($this->renderPartial('_stampa', array('model' => $model, 'struttura' => $id, 'nomeStruttura' => $nomeStruttura, 'periodo' => $periodo), true));
        }
        else
            $html2pdf->WriteHTML($this->renderPartial('_stampa', array('model' => $model), true));

        $html2pdf->Output('Statistiche_questionari_keluar.pdf', 'D');
    }

    public function actionCreate($id= null, $periodo=NULL) {
        $model = new QuestionarioKeluar;

        if ($id)
            $nomeStruttura = $model->getSelectValue($id, "doc_unita");

        $this->render('create', array(
            'model' => $model, 'struttura' => $id, 'nomeStruttura' => $nomeStruttura, 'periodo' => $periodo
        ));
    }
    
    public function actionGrafici($struttura= null, $anno = null) {

        $model = new QuestionarioKeluar;
        
        !$anno ?  $anno = date("Y") :"";
        $model->anno = $anno ; 
        
        $model->selectStrutture     = Yii::app()->MyUtils->getSoggiorniQ("questionario_keluar",'struttura_nome');
        $model->selectAnni          = Yii::app()->MyUtils->getYearsQ("questionario_keluar");
        $model->stats               = Yii::app()->MyStats->getStatsQuestionari("questionario_keluar", $struttura,$anno);
        $this->render('grafici', array('model' => $model,));
    }
    
    public function actionStampaGrafici() {
        
        $struttura      = $_POST['struttura']  ;
        $anno           = $_POST['anno'] ;
        $model          = new QuestionarioKeluar;

        if(!$anno) $anno = date('Y');
        
        $struttura ? $nome = Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id ='".$struttura."'" )->queryScalar() : "";
        $struttura ? $file = 'statistiche-'.str_replace(" ","_",$nome)."-".$anno : $file ='statistiche-'.$anno ;
        
        $model->stats   = Yii::app()->MyStats->getStatsQuestionari("questionario_keluar", $struttura,$anno);
        $html2pdf       = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_grafici', array('model' => $model,'anno' => $anno , 'struttura'=>$struttura , 'nome' => $nome), true));
        
        $html2pdf->Output( YiiBase::getPathOfAlias('webroot').'/protected/stampe/questionari_keluar/'.$file.'.pdf', 'F');
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('stampa' => '/protected/stampe/questionari_keluar/'.$file.'.pdf?ver='.time()));
        Yii::app()->end();
    }
    
        
    public function actionEsporta($anni = null ) {
        $model = new QuestionarioKeluar('search');
        
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
      }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        if (isset($_POST['QuestionarioKeluar'])) {
            $model->attributes = $_POST['QuestionarioKeluar'];
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
        $dataProvider = new CActiveDataProvider('QuestionarioKeluar');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new QuestionarioKeluar('search');
        $model->unsetAttributes();  // clear any default values
        $model->setSelect();
        $model->setAttribute('anno', date("Y"));
        if (isset($_POST['QuestionarioKeluar']))
            $model->attributes = $_POST['QuestionarioKeluar'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = QuestionarioKeluar::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionario-keluar-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
