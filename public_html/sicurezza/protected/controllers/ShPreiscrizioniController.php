<?php

class ShPreiscrizioniController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{       
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionStampa($id)
	{
            $html2pdf = Yii::app()->ePdf->HTML2PDF();
            $html2pdf->WriteHTML($this->renderPartial('_print', array('model'=>$this->loadModel($id)), true));
            $html2pdf->Output('Sharing_Presiscrizione-'.$id.'.pdf','D');
           
	}
        public function actionEsporta(){
            
            $model  = new ShPreiscrizioni('search');
            $dati   = $model->getEsportazione();
            
		$this->renderPartial('_esporta',array(
			'dati'=>$dati,'model'=>$model
		));
            
        }
        
        
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ShPreiscrizioni;
                
                
		if(isset($_POST['ShPreiscrizioni']))
		{
			$model->attributes=$_POST['ShPreiscrizioni'];
                        if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create');
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
                $model->data_in = $model->getUserDate($model->data_in);
                $model->data_nascita = $model->getUserDate($model->data_nascita);
                $model->data_out = $model->getUserDate($model->data_out);
                
                
		if(isset($_POST['ShPreiscrizioni']))
		
                {
                    
                   	$model->attributes = $_POST['ShPreiscrizioni'];
                        if($model->save())
				$this->redirect(array('view','id'=>$model->id));
                }

                                
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ShPreiscrizioni');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ShPreiscrizioni('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ShPreiscrizioni']))
			$model->attributes=$_GET['ShPreiscrizioni'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DbAzionicorrettive the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ShPreiscrizioni::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DbAzionicorrettive $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sh-preiscrizioni-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
