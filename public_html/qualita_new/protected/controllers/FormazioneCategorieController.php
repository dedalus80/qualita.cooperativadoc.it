<?php

class FormazioneCategorieController extends Controller{
	
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
		
        $model=new FormazioneCategorie;

		if(isset($_POST['FormazioneCategorie']))		{
			$model->attributes=$_POST['FormazioneCategorie'];
			if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Nuova categoria corso formazione <b>' . $model->nome . "</b> creata con successo");
                $this->redirect(array('admin'));
            }
		}

		$this->render('create',array('model'=>$model,));
	}
	
	public function actionUpdate($id)	{
		
        $model=$this->loadModel($id);

		if(isset($_POST['FormazioneCategorie']))		{
			$model->attributes=$_POST['FormazioneCategorie'];
            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Categoria corsi foramzione <b>' . $model->nome . "</b> aggiornata con successo");
                $this->redirect(array('admin'));
            }		
        }

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Categoria corsi formazione <b>' . $model->nome . '</b> rimossa con successo');
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

	public function actionAdmin()	{
		$model=new FormazioneCategorie('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FormazioneCategorie']))
			$model->attributes=$_GET['FormazioneCategorie'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)	{
		$model=FormazioneCategorie::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	protected function performAjaxValidation($model)	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='formazione-categorie-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
}
