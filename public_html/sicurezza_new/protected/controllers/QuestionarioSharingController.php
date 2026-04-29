<?php

class QuestionarioSharingController extends Controller {

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
        $html2pdf->Output('Questionario_sharing-' . $id . '.pdf', 'D');
    }

    public function actionStampaStats($id= NULL, $data=NULL) {
        
        
        foreach($_REQUEST as $k => $value)
            $periodo .= $k;
        
        $model = new QuestionarioSharing;
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('_stampa', array('model' => $model, 'periodo' => $periodo), true));
        $html2pdf->Output('Statistiche_questionari_sharing.pdf', 'D');
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($id=NULL, $data=NULL) {
        $model = new QuestionarioSharing;
        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

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
    
    
    public function actionEsporta(){
            
            $model  = new QuestionarioSharing('search');
            $dati   = $model->getEsportazione();
            
		$this->renderPartial('_esporta',array(
			'dati'=>$dati,'model'=>$model
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

        if (isset($_POST['QuestionarioSharing'])) {
            $model->attributes = $_POST['QuestionarioSharing'];
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
        $dataProvider = new CActiveDataProvider('QuestionarioSharing');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new QuestionarioSharing('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['QuestionarioSharing']))
            $model->attributes = $_GET['QuestionarioSharing'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return QuestionarioSharing the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = QuestionarioSharing::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param QuestionarioSharing $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'questionario-sharing-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
