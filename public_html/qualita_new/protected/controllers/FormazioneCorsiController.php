<?php

class FormazioneCorsiController extends Controller{
	
    public $layout='//layouts/column2';
	
	public function filters()	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view'),
                'expression' => 'Yii::app()->user->getState("group") == "ADMIN"',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
	public function actionCreate()	{
        
		$model=new FormazioneCorsi;
        $model->setDefaultValues();
		if(isset($_POST['FormazioneCorsi'])){
            
            $model->attributes=$_POST['FormazioneCorsi'];
             $model->setAttribute('colore', Yii::app()->db->createCommand("SELECT id FROM doc_colori WHERE colore='" . $model->colore . "'")->queryScalar());
			if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Corso formazione <b>' . $model->nome . "</b> creato con successo");
                $this->redirect(array('admin'));
            }		
        }

		$this->render('create',array(			'model'=>$model,		));
	}

	public function actionUpdate($id)	{
		
        $model=$this->loadModel($id);
        $model->setDefaultValues();
		
        if(isset($_POST['FormazioneCorsi'])){
            
            $model->attributes=$_POST['FormazioneCorsi'];
            $model->setAttribute('colore', Yii::app()->db->createCommand("SELECT id FROM doc_colori WHERE colore='" . $model->colore . "'")->queryScalar());
                
            
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Corso  formazione <b>' . $model->nome . "</b> aggiornato con successo");
                $this->redirect(array('admin'));
            }		
        }
        
		$this->render('update',array(			'model'=>$model,		));
	}

	public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Corso formazione <b>' . $model->nome . '</b> rimosso con successo');
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    
	public function actionAdmin()	{
		$model=new FormazioneCorsi('search');
		$model->unsetAttributes();  // clear any default values
        
        $model->setDefaultValues();
        
        
		if(isset($_GET['FormazioneCorsi']))
			$model->attributes=$_GET['FormazioneCorsi'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)	{
		$model=FormazioneCorsi::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	protected function performAjaxValidation($model)	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='formazione-corsi-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
