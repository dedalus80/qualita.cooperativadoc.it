<?php

class SegnalatoController extends Controller{
	
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
	
        $model=new Segnalato;
		if(isset($_POST['Segnalato']))		{
			$model->attributes=$_POST['Segnalato'];
			if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Nuova segnalazione <b>' . $model->nome . "</b> creata con successo");
                $this->redirect(array('admin'));
            }
		}

		$this->render('create',array('model'=>$model));
	}

	public function actionUpdate($id)	{
		
        $model=$this->loadModel($id);
        if(isset($_POST['Segnalato']))	{
			$model->attributes=$_POST['Segnalato'];
			if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Segnalazione <b>' . $model->nome . "</b> aggiornata con successo");
                $this->redirect(array('admin'));
            }
		}
		$this->render('update',array('model'=>$model));
	}

	public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Segnalazione <b>' . $model->nome . '</b> rimossa con successo');
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

	public function actionAdmin()	{
		$model=new Segnalato('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Segnalato']))
			$model->attributes=$_GET['Segnalato'];

		$this->render('admin',array('model'=>$model));
	}

	public function loadModel($id)	{
		$model=Segnalato::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='segnalato-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
