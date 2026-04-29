<?php

class CampusController extends Controller{
	
	public $layout='//layouts/column2';
	
	public function filters()	{
		return array(
			'accessControl', // perform access control for CRUD operations
			
		);
	}

	public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete'),
                'users' => Yii::app()->MyUtils->getPermition('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionCreate()	{
	
        $model=new Campus;
		if(isset($_POST['Campus']))		{
			$model->attributes=$_POST['Campus'];
			if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Nuova formula campus <b>' . $model->nome . "</b> creata con successo");
                $this->redirect(array('admin'));
            }
		}

		$this->render('create',array('model'=>$model));
	}

	public function actionUpdate($id)	{
		
        $model=$this->loadModel($id);
        if(isset($_POST['Campus']))	{
			$model->attributes=$_POST['Campus'];
			if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Formula campus <b>' . $model->nome . "</b> aggiornata con successo");
                $this->redirect(array('admin'));
            }
		}
		$this->render('update',array('model'=>$model));
	}

	public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Formaul campus <b>' . $model->nome . '</b> rimosso con successo');
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

	public function actionAdmin()	{
		$model=new Campus('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Campus']))
			$model->attributes=$_GET['Campus'];

		$this->render('admin',array('model'=>$model));
	}

	public function loadModel($id)	{
		$model=Campus::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='campus-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
