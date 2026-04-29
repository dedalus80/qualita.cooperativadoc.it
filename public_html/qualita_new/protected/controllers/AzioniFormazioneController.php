<?php

class AzioniFormazioneController extends Controller{
	
	public $layout='//layouts/column2';

	public function filters()	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view','getGruppi','setGruppi','calendario','getFormazione'),
                'expression' => 'Yii::app()->user->getState("group") == "ADMIN"',
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('calendario','getFormazione'),
                'users' => Yii::app()->user->accessController('Formazione'), //Yii::app()->MyUtils->getPermition('formazione'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
	public function actionCreate()	{
		
        $model = new AzioniFormazione;
        $model->setDefaultValues();
        
		if(isset($_POST['AzioniFormazione'])) {
			
            $model->attributes=$_POST['AzioniFormazione'];
            $model->gruppi  = isset($_POST['gruppi']) ? $_POST['gruppi'] : array();
            $model->utenti  = array();
			$model->selectedTags = isset($_POST['AzioniFormazione']['selectedTags']) ? $_POST['AzioniFormazione']['selectedTags'] : array();
            
            $d = explode("-",$model->data) ;
            $model->setAttribute('data', Yii::app()->MyUtils->reverseDate($model->data));
            $model->data_fine ? $model->setAttribute('data_fine', Yii::app()->MyUtils->reverseDate($model->data_fine)) : $model->setAttribute('data_fine', NULL);
            
            $model->setAttribute('anno', $d['2']);
            
			if ($model->save()) {
                $model->setGruppi();
                $model->setUtenti();
                Yii::app()->user->setFlash('opResultOK', 'Corso formazione <b>' . $model->titolo . "</b> creata con successo");
                $this->redirect(array('admin'));
            }	
		}

		$this->render('create',array('model'=>$model,));
	}

    public function actionUpdate($id)	{
		
        $model=$this->loadModel($id);
        $model->setDefaultValues();
        
		if(isset($_POST['AzioniFormazione']))		{
			
            $model->attributes=$_POST['AzioniFormazione'];
			$model->gruppi  = isset($_POST['gruppi']) ? $_POST['gruppi'] : array();
            $model->utenti  = array();
			$model->selectedTags = isset($_POST['AzioniFormazione']['selectedTags']) ? $_POST['AzioniFormazione']['selectedTags'] : array();
            
            $d = explode("-",$model->data);
            $model->setAttribute('data', Yii::app()->MyUtils->reverseDate($model->data));
            $model->data_fine ? $model->setAttribute('data_fine', Yii::app()->MyUtils->reverseDate($model->data_fine)) : $model->setAttribute('data_fine', NULL);
            
            $model->setAttribute('anno', $d['2']);
            
            if ($model->save()) {
                $model->setGruppi();
                $model->setUtenti();
                Yii::app()->user->setFlash('opResultOK', 'Formazione <b>' . $model->titolo . "</b> aggiornata con successo");
                $this->redirect(array('admin'));
            }	
		}

		$this->render('update',array(			'model'=>$model,		));
	}
	
	public function actionDelete($id)	{
		$model = $this->loadModel($id);
        $model->delete();
        
        // Rimuovi i gruppi assegnati al corso 
         Yii::app()->db->createCommand("DELETE FROM doc_formazione_gruppi_corsi WHERE id_corso ='".$id."'")->execute();
        
        Yii::app()->user->setFlash('opResultOK', 'Formazione <b>' . $model->titolo . '</b> rimossa con successo');

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

    public function actionAdmin()	{
		$model=new AzioniFormazione('search');
		$model->unsetAttributes();  // clear any default values
        
        $model->anno = date("Y");
        
		if(isset($_GET['AzioniFormazione']))
			$model->attributes=$_GET['AzioniFormazione'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)	{
		$model=AzioniFormazione::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    public function actionGetGruppi() {
        
        $model  = $this->loadModel($_POST['id']);
        $result = $model->getGruppi();
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('table' => $result['table'], 'nome' => $result['nome']));
        Yii::app()->end();
    }
	
    public function actionSetGruppi() {
        
        $model = $this->loadModel($_POST['id']);
        $model->gruppi = $_POST['gruppi'] ;
        $result = $model->setGruppi();
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('text' => $result['text'], 'totale' => $result['totale']));
        Yii::app()->end();
    }
        
    public function actionCalendario($anno = null) {

        $model = new AzioniFormazione;
        if ($anno) {
            $model->anno = $anno;
            $model->calendario = "anno";
        } else {
            $model->anno = date("Y");
            $model->calendario = "mesi";
        }

        $model->setDefaultValues();
        
        $stats = $model->getCorsiFormazione();
        $corsi = $model->getSmallCorsiFormazione($model->anno);
        $this->render('calendario', array("model" => $model, 'stats' => $stats, 'corsi' => $corsi));
    }
        
    public function actionGetFormazione() {
        
       
        $action = $_POST['action'];

        if ($action == 'get') {
            $model = new AzioniFormazione;
            $dati = $model->getFormazione($_POST['id']);
            header('Content-Type: application/json; charset="UTF-8"');
            //echo CJSON::encode(array('data' => $dati['data'],'data_fine' => $dati['data_fine'], 'titolo' => $dati['titolo'], 'ora' => $dati['ora'], 'tipo' => $dati['tipo'], 'invio_sms' => $dati['invio_sms'], 'invio_email' => $dati['invio_email'], 'giorni_sms' => $dati['giorni_sms'] , 'giorni_email' => $dati['giorni_email'] , 'gruppi' => $dati['gruppi'] ,'view_data' => $dati['view_data'] ,'view_gruppi' => $dati['view_gruppi'], 'view_corso' => $dati['view_corso'] ));
            
            echo CJSON::encode($dati);
            
            Yii::app()->end();
        } else if ($action == 'set') {

            $model = new AzioniFormazione;
            $model->titolo             = $_POST['titolo'] ;#= "Test ";
            $model->id_categoria       = $_POST['tipo'] ;#= "4";
            $model->data 	           = Yii::app()->MyUtils->reverseDate($_POST['data']) ;# = */ "2017-11-12";
            $model->data_fine 	       = Yii::app()->MyUtils->reverseDate($_POST['data_fine']) ;# = */ "2017-11-12";
            $model->ora 	           = $_POST['ora'] ;#= "14:00";
            $model->invio_sms 	       = $_POST['invio_sms'] ;#= "Y";
            $model->invio_email 	   = $_POST['invio_email'] ;#= "Y";
            $model->giorni_invio_email = $_POST['giorni_invio_email'] ;#= "2";
            $model->giorni_invio_sms   = $_POST['giorni_invio_sms'] ;#= "3";
            $model->gruppi 		       = $_POST['gruppi'] ;#= array("1","2");
            
            
            
            $dati = $model->setFormazione($_POST['id']);

            header('Content-Type: application/json; charset="UTF-8"');
            echo CJSON::encode(array(
                'mex' => $dati['messaggio'],
                'newFormazione' => $dati['newFormazione'],
                'idRemove' => $dati['idRemove'],
                'remove' => $dati['remove'],
                'newDate' => $dati['newDate'],
                'stato' => $dati['stato'],
                'error' => $dati['error']
            ));

            Yii::app()->end();
        }
    }
    
	protected function performAjaxValidation($model)	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='azioni-formazione-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
