<?php

class QuestionarioSharingController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta','grafici','stampaGrafici'),
                'users' => Yii::app()->MyUtils->getPermition('QU'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    public function actionGrafici($struttura= null, $anno = null) {

        $model = new QuestionarioSharing;
         $model->selectStrutture     = Yii::app()->MyUtils->getSoggiorniQ("questionario_sharing",'soggiorno');
        $model->selectAnni          = Yii::app()->MyUtils->getYearsQ("questionario_sharing");
        $model->stats               = Yii::app()->MyStats->getStatsQuestionari("questionario_sharing", $struttura,$anno);
        $this->render('grafici', array('model' => $model,));
    
    }
    
    public function actionStampaGrafici() {
        
        $struttura      = $_POST['struttura']  ;
        $anno           = $_POST['anno'] ;
        $model          = new QuestionarioSharing;
        
        $struttura ? $nome = Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id ='".$struttura."'" )->queryScalar() : "";
        $struttura ? $file = 'statistiche-'.str_replace(" ","_",$nome)."-".$anno : $file ='statistiche-'.$anno ;
        
        $model->stats   = Yii::app()->MyStats->getStatsQuestionari("questionario_sharing", $struttura,$anno);
        $html2pdf       = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_grafici', array('model' => $model,'anno' => $anno , 'struttura'=>$struttura , 'nome' => $nome), true));
        
        $html2pdf->Output( YiiBase::getPathOfAlias('webroot').'/protected/stampe/questionari_sharing/'.$file.'.pdf', 'F');
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('stampa' => '/protected/stampe/questionari_sharing/'.$file.'.pdf?ver='.time()));
        Yii::app()->end();
    }
    
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionStampa($id) {
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('_print', array('model' => $this->loadModel($id)), true));
        $html2pdf->Output('Questionario_sharing-' . $id . '.pdf', 'D');
    }

    public function actionStampaStats($id= NULL, $data=NULL) {


        foreach ($_REQUEST as $k => $value)
            $periodo .= $k;

        $model = new QuestionarioSharing;
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('_stampa', array('model' => $model, 'periodo' => $periodo), true));
        $html2pdf->Output('Statistiche_questionari_sharing.pdf', 'D');
    }

    public function actionCreate($id=NULL, $data=NULL) {
        $model = new QuestionarioSharing;



        if (isset($_POST['QuestionarioSharing'])) {
            $model->attributes = $_POST['QuestionarioSharing'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        #prinr_r($_REQUEST);


        $this->render('create', array(
            'model' => $model, 'periodo' => $id
        ));
    }

    public function actionEsporta($anni = null) {

        $model = new QuestionarioSharing;
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);



        if (isset($_POST['QuestionarioSharing'])) {
            $model->attributes = $_POST['QuestionarioSharing'];
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
        $dataProvider = new CActiveDataProvider('QuestionarioSharing');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new QuestionarioSharing('search');
        $model->unsetAttributes();  // clear any default values
        $model->setSelect() ;
        
        $model->setAttribute('anno', date("Y"));
        if (isset($_POST['QuestionarioSharing']))
            $model->attributes = $_POST['QuestionarioSharing'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = QuestionarioSharing::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionario-sharing-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
