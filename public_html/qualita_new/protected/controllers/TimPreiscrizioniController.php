<?php

class TimPreiscrizioniController extends Controller {
	
    public $layout='//layouts/column2';

	public function filters()	{
		return array(
			'accessControl', // perform access control for CRUD operations
			
		);
	}
	
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta'),
                'users' => Yii::app()->MyUtils->getPermition('TIM'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
	public function actionCreate()	{
		
        $model=new TimPreiscrizioni;
        $model->setDefaultValues();
        
        if(isset($_POST['TimPreiscrizioni']))		{
			$model->attributes=$_POST['TimPreiscrizioni'];
             $model->setAttribute('nascita_data', Yii::app()->MyUtils->reverseDate($model->nascita_data));
             $model->setAttribute('secondo_genitore_nascita_data', Yii::app()->MyUtils->reverseDate($model->secondo_genitore_nascita_data));
            
            
			if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Pre iscrizione  <b>' . $model->nome . ' ' . $model->cognome . '</b> creata con successo');
                $this->redirect(array('admin'));
            }
		}

		$this->render('create',array('model'=>$model));
	}

	public function actionUpdate($id)	{
		
        $model = $this->loadModel($id);
        $model->setDefaultValues();
        
		if(isset($_POST['TimPreiscrizioni'])){
			$model->attributes=$_POST['TimPreiscrizioni'];
             $model->setAttribute('nascita_data', Yii::app()->MyUtils->reverseDate($model->nascita_data));
             $model->setAttribute('secondo_genitore_nascita_data', Yii::app()->MyUtils->reverseDate($model->secondo_genitore_nascita_data));
            
			if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Pre iscrizione  <b>' . $model->nome . ' ' . $model->cognome . '</b> aggiornata con successo');
                $this->redirect(array('admin'));
            }
		}

		$this->render('update',array('model'=>$model));
	}

	public function actionDelete($id)	{
		$model = $this->loadModel($id);
        Yii::app()->user->setFlash('opResultOK', 'Pre iscrizione <b>' . $model->nome . ' ' . $model->cognome . '</b> rimossa con successo');
        $model->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
    
	public function actionAdmin(){ 
        
		$model = new TimPreiscrizioni('search');
        $model->unsetAttributes();  // clear any default values
		$model->setDefaultValues();
        
        if(isset($_GET['TimPreiscrizioni']))
			$model->attributes=$_GET['TimPreiscrizioni'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
    
	public function loadModel($id)	{
		$model=TimPreiscrizioni::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	protected function performAjaxValidation($model)	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tim-preiscrizioni-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function actionEsporta($anni = null) {
        $model = new TimPreiscrizioni('search');
        $model->datiEsportazione = $model->getEsportazione($anni);
        $this->renderPartial('_esporta', array('model' => $model));
    }
    
    
}
