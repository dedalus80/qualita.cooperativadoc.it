<?php

class QuestionarioSeniorController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin', 'delete', 'view', 'esporta', 'grafici', "update",'stampaGrafici'),
                'users' => Yii::app()->MyUtils->getPermition('q_senior'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionGrafici($struttura= null, $anno = null, $gruppo = null, $turno= null, $turno = null) {

        $model = new QuestionarioSenior;
        $anno ?  $model->anno = $anno : $model->anno = Yii::app()->MyStats->getCountStatsQuestionari("questionario_senior") ;
        $model->selectSoggiorni     = Yii::app()->MyUtils->getSoggiorniQ("questionario_senior",'soggiorno');
        $model->selectAnni          = Yii::app()->MyUtils->getYearsQ("questionario_senior");
        $model->stats               = Yii::app()->MyStats->getStatsQuestionari("questionario_senior", $struttura,$model->anno);
        $this->render('grafici', array('model' => $model,));
    
    }
    
    /*public function actionStampaGrafici() {
        
        $struttura      = $_POST['struttura']  ;
        $anno           = $_POST['anno'] ;
        $model          = new QuestionarioSenior;
        
        $struttura ? $nome = Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id ='".$struttura."'" )->queryScalar() : "";
        $struttura ? $file = 'statistiche-'.str_replace(" ","_",$nome)."-".$anno : $file ='statistiche-'.$anno ;
        
        
        $model->stats   = Yii::app()->MyStats->getStatsQuestionari("questionario_senior", $struttura,$anno);
        $html2pdf       = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_grafici', array('model' => $model,'anno' => $anno , 'struttura'=>$struttura , 'nome' => $nome), true));
        
        $html2pdf->Output( YiiBase::getPathOfAlias('webroot').'/protected/stampe/questionari_senior/'.$file.'.pdf', 'F');
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('stampa' => '/protected/stampe/questionari_senior/'.$file.'.pdf?ver='.time()));
        Yii::app()->end();
    }*/

    public function actionStampaGrafici() {
        
        $struttura      = $_POST['struttura']  ;
        $anno           = $_POST['anno'] ;
        /*$model          = new QuestionarioJunior; 
        
        $struttura ? $nome = Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id ='".$struttura."'" )->queryScalar() : "";
        $struttura ? $file = 'statistiche-'.str_replace(" ","_",$nome)."-".$anno : $file ='statistiche-'.$anno ;
        
        $model->stats   = Yii::app()->MyStats->getStatsFormazione();*/


        $id = 2;

        $model = new SurveyStays();
		$model->tipologia_id = $id;

        $tipologia = TipologiaSoggiorni::model()->findByPk($id);

        $struttura ? $nome = Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id ='".$struttura."'" )->queryScalar() : "";
        $struttura ? $file = 'statistiche-'.str_replace(" ","_",$nome)."-".$anno : $file ='statistiche-'.$anno;

        $model->stats   = Yii::app()->MyStats->getStatsQuestionari("survey_stays", $struttura, $model->anno, null, $id);
        $html2pdf       = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_grafici', array('model' => $model,'anno' => $anno , 'struttura'=>$struttura , 'nome' => $nome), true));
        
        $html2pdf->Output( YiiBase::getPathOfAlias('webroot').'/protected/stampe/questionari_junior/'.$file.'.pdf', 'F');
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('stampa' => '/protected/stampe/questionari_junior/'.$file.'.pdf?ver='.time()));
        Yii::app()->end();
    }
    

    public function actionUpdate($id) {

        $model = $this->loadModel($id);

        $model->osservazioni = html_entity_decode($model->osservazioni);
        $model->suggerimenti = html_entity_decode($model->suggerimenti);

        $this->performAjaxValidation($model);
        $model->setSelect();

        if (isset($_POST['QuestionarioSenior'])) {
            $model->attributes = $_POST['QuestionarioSenior'];
            $model->setAttribute('data_restituzione', Yii::app()->MyUtils->reverseDate($model->data_restituzione));
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Questionario senior <b>' . $model->nome . " " . $model->cognome . "</b> aggiornato con successo");
                $this->redirect(array('admin'));
            }
        }
        $this->render('update', array('model' => $model,));
    }

    public function actionEsporta($anni = null) {
        $model = new QuestionarioSenior('search');
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
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
        $model = new QuestionarioSenior('search');
        $model->unsetAttributes();  // clear any default values
        $model->setSelect();
        $model->setAttribute('anno', date("Y"));
        if (isset($_POST['QuestionarioSenior']))
            $model->attributes = $_POST['QuestionarioSenior'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = QuestionarioSenior::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionario-senior-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}