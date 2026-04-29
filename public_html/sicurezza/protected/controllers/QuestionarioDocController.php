<?php

class QuestionarioDocController extends Controller {

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
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {

        return array(
          
              
          array('allow', // allow authenticated user to perform 'create' and 'update' actions
          'actions'=>array('create','update','admin','delete','view'),
          'users'=>array('@'),
          ),
             /*
           array('allow',  // allow all users to perform 'index' and 'view' actions
          'actions'=>array('index','view'),
          'users'=>array('*'),
          ),   
          array('allow', // allow admin user to perform 'admin' and 'delete' actions
          'actions'=>array('admin','delete'),
          'users'=>array('admin'),
          ),
          array('deny',  // deny all users
          'users'=>array('*'),
          ),*/
          ); 
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    
        public function actionEsporta(){
            
            $model  = new QuestionarioDoc('search');
            $dati   = $model->getEsportazione();
            
		$this->renderPartial('_esporta',array(
			'dati'=>$dati,'model'=>$model
		));
            
        }
    
    
    public function actionCreate($id= null) {
        $model = new QuestionarioDoc;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if ($id)
            $nomeStruttura = $model->getSelectValue($id, "doc_unita");


        $this->render('create', array(
            'model' => $model, 'struttura' => $id, 'nomeStruttura' => $nomeStruttura
        ));
    }

    public function actionCreati() {
        $model = new QuestionarioDoc;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['QuestionarioDoc'])) {
            $model->attributes = $_POST['QuestionarioDoc'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['QuestionarioDoc'])) {
            $model->attributes = $_POST['QuestionarioDoc'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('QuestionarioDoc');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new QuestionarioDoc('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['QuestionarioDoc'])){
            $model->attributes = $_GET['QuestionarioDoc'];
            $test = "yes";
            
        }
        
        $this->render('admin', array(
            'model' => $model,'test'=>$test
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return QuestionarioDoc the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = QuestionarioDoc::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param QuestionarioDoc $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionario-doc-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    function getValutazione($data) {

        switch ($data) {

            case"E":
                $val = "ECCELLENTE";
                break;
            case"B":
                $val = "BUONO";
                break;
            case"S":
                $val = "SUFFICIENTE";
                break;
            case"I":
                $val = "INSSUFFICIENTE";
                break;
        }
        return $val . $data;
    }

    function getItaDate($date) {

        $g = explode(" ", $date);
        $d = explode("-", $g);
        return $d[1] . " " . $this->getMount($d[2]) . " " . $d[0] . "XX" . $date;
    }

    function getMount($m) {
        switch ($m) {
            case"01":
                $mese = "Gennaio";
                break;
            case"02":
                $mese = "Febbraio";
                break;
            case"03":
                $mese = "Marzo";
                break;
            case"04":
                $mese = "Aprile";
                break;
            case"05":
                $mese = "Maggio";
                break;
            case"06":
                $mese = "Giugno";
                break;
            case"07":
                $mese = "Luglio";
                break;
            case"08":
                $mese = "Agosto";
                break;
            case"09":
                $mese = "Settembre";
                break;
            case"10":
                $mese = "Ottobre";
                break;
            case"11":
                $mese = "Novembre";
                break;
            case"12":
                $mese = "Dicembre";
                break;
        }

        return $mese;
    }

}
