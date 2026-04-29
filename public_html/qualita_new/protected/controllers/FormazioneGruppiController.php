<?php

class FormazioneGruppiController extends Controller{
	
	public $layout='//layouts/column2';

	public function filters()	{
		return array(
			'accessControl', // perform access control for CRUD operations
			
		);
	}

	public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view','getUtenti','setUtenti'),
                'expression' => 'Yii::app()->user->getState("group") == "ADMIN"',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
	public function actionCreate()	{
		
        $model = new FormazioneGruppi;

		if(isset($_POST['FormazioneGruppi'])){
			$model->attributes=$_POST['FormazioneGruppi'];
			if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Gruppo formazione <b>' . $model->nome . "</b> creato con successo");
                $this->redirect(array('admin'));
            }		
		}

		$this->render('create',array('model'=>$model,));
	}

	public function actionUpdate($id)	{
		$model=$this->loadModel($id);

		if(isset($_POST['FormazioneGruppi']))		{
			$model->attributes=$_POST['FormazioneGruppi'];
			if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Gruppo formazione <b>' . $model->nome . "</b> aggiornato con successo");
                $this->redirect(array('admin'));
            }		
		}

		$this->render('update',array(			'model'=>$model,		));
	}

	public function actionDelete($id) {
        $model = $this->loadModel($id);
        $model->delete();
        
        // Rimuovi i gruppi assegnati al corso 
         Yii::app()->db->createCommand("DELETE FROM doc_formazione_utenti_gruppi WHERE id_gruppo ='".$id."'")->execute();
        
        Yii::app()->user->setFlash('opResultOK', 'Gruppo formazione <b>' . $model->nome . '</b> rimosso con successo');
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

	public function actionAdmin()	{
		$model=new FormazioneGruppi('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FormazioneGruppi']))
			$model->attributes=$_GET['FormazioneGruppi'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)	{
		$model=FormazioneGruppi::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

    public function actionGetUtenti() {
        $model  = $this->loadModel($_POST['id']);
        $result = $model->getUtenti();
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('table' => $result['table'], 'nome' => $result['nome']));
        Yii::app()->end();
    }
	
    public function actionSetUtenti() {
        $model          = $this->loadModel($_POST['id']);
        $model->iscritti = $_POST['utenti'] ;
        $result = $model->setUtenti();
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('text' => $result['text'], 'totale' => $result['totale']));
        Yii::app()->end();
    }
        
	protected function performAjaxValidation($model)	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='formazione-gruppi-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
