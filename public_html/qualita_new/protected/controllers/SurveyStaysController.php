<?php

class SurveyStaysController extends Controller
{
	public $layout = '//layouts/column2';

	public function filters()
	{
        return array(
            'accessControl', // perform access control for CRUD operations
                // 'postOnly + delete', // we only allow deletion via POST request
        );
    }

	public function accessRules()
	{
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin', 'delete', 'view', 'esporta', 'stats', 'update', 'smile','stampaGrafici','download'),
                'users' => Yii::app()->MyUtils->getPermition('q_junior'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionAdmin($id)
	{
		$model = new SurveyStays('search');
        $model->unsetAttributes();  // clear any default values
        //$model->setSelect();
		$model->setAttribute('tipologia_id', $id);
        $model->setAttribute('anno', date("Y"));
        
		if (isset($_POST['SurveyStays'])) {
            $model->attributes = $_POST['SurveyStays'];
		}

		$tipologia = TipologiaSoggiorni::model()->findByPk($id);

		$user = Yii::app()->MyUtils->getUserInfo();
		if($user['user_unita']) {
			$centri = $user['user_unita'];
		}
		else {
			$centri = null;
		}

        $this->render('admin', array(
            'model' => $model,
			'tipologia' => $tipologia,
			'centri' => $centri
        ));
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionUpdate()
	{
		$this->render('update');
	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);

		$cliente = Clienti::model()->findByPk($model->organizzatore);
		$centro = Soggiorni::model()->findByPk($model->soggiorno);

		$this->render('view', array('model'=>$model, 'cliente'=>$cliente->nome, 'centro'=>$centro->nome));
	}

	public function actionStats($id) //$struttura= null, $anno = null, $gruppo = null, $turno= null)
	{
		$anno = Yii::app()->request->getQuery('anno');
		$struttura = Yii::app()->request->getQuery('struttura');

        $model = new SurveyStays();
		$model->tipologia_id = $id;

        //$anno ? $model->anno = $anno : $model->anno = Yii::app()->MyStats->getCountStatsQuestionari("questionario_junior");

		$anno ? $model->anno = $anno : $model->anno = date('Y');

		if($struttura) $model->soggiorno = $struttura;

		switch($id) {
			case 1:
				$col = 'qjunior';
				$modelPrint = 'questionarioJunior'; 
				break;
			case 2:
				$col = 'qsenior';
				$modelPrint = 'questionarioSenior'; 
				break;
			case 3:
				$col = 'qstudio';
				$modelPrint = 'questionarioStudio';
				break;
			case 4:
				$col = 'qscientifici'; 
				$modelPrint = 'questionarioScientifici';
				break;
			case 5:
				$col = 'qsport'; 
				$modelPrint = 'questionarioSport';
				break;
		}

		$user = Yii::app()->MyUtils->getUserInfo();
		if($user['user_unita']) {
			$centri = $user['user_unita'];
		}
		else {
			$centri = null;
		}
		
		if($centri) {
			$dataSoggiorni = Soggiorni::model()->findAll(['condition'=>'id IN ('.$centri.') AND '.$col.'="Y"', 'order'=>'nome']);
		}
		else {
			$dataSoggiorni = Soggiorni::model()->findAll(['condition'=>$col.'="Y"', 'order'=>'nome']);
		}

		/*$data = ClientiTipologiaSoggiorni::model()->with('soggiorno')->findAll(['condition'=>'tipologia_id='.$model->tipologia_id]);
		echo '<pre>';
		print_r($data);
		echo '</pre>';*/

        //$model->selectSoggiorni = Yii::app()->MyUtils->getSoggiorniQ("questionario_junior",'soggiorno');
        //$model->selectAnni      = Yii::app()->MyUtils->getYearsQ("questionario_junior");
        $model->stats           = Yii::app()->MyStats->getStatsQuestionari("survey_stays", $struttura, $model->anno, null, $id);

		Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/canvg/1.4/rgbcolor.min.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/stackblur-canvas/1.4.1/stackblur.min.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile('https://cdn.jsdelivr.net/npm/canvg/dist/browser/canvg.min.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile('https://code.highcharts.com/highcharts.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile('https://code.highcharts.com/modules/series-label.js', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerScriptFile('https://code.highcharts.com/modules/exporting.js', CClientScript::POS_HEAD);

		$tipologia = TipologiaSoggiorni::model()->findByPk($id);
        
		$this->render('grafici', array('model' => $model, 'dataSoggiorni' => $dataSoggiorni, 'tipologia' => $tipologia->tipologia,'localType'=>$tipologia->local_name, 'modelPrint'=>$modelPrint));
    }

	public function actionStampaGrafici()
	{    
        $struttura      = $_POST['struttura'];
        $anno           = $_POST['anno'];
        /*$model          = new QuestionarioJunior; 
        
        $struttura ? $nome = Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id ='".$struttura."'" )->queryScalar() : "";
        $struttura ? $file = 'statistiche-'.str_replace(" ","_",$nome)."-".$anno : $file ='statistiche-'.$anno ;
        
        $model->stats   = Yii::app()->MyStats->getStatsFormazione();*/

        $id = $_POST['type'];

        $model = new SurveyStays();
		$model->tipologia_id = $id;

        $tipologia = TipologiaSoggiorni::model()->findByPk($id);

        $struttura ? $nome = Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id ='".$struttura."'" )->queryScalar() : "";
        $struttura ? $file = $id.'_statistiche-'.str_replace(" ","_",$nome)."-".$anno : $file = $id.'_statistiche-'.$anno;

        $model->stats   = Yii::app()->MyStats->getStatsQuestionari("survey_stays", $struttura, $model->anno, null, $id);
        $html2pdf       = Yii::app()->ePdf->HTML2PDF('P', 'A4', 'en', false, 'ISO-8859-15', array(mL, mT, mR, mB));
        $html2pdf->WriteHTML($this->renderPartial('_grafici', array('model' => $model,'anno' => $anno , 'struttura'=>$struttura , 'nome' => $nome, 'tipologia' => $tipologia), true));
        
        $html2pdf->Output( YiiBase::getPathOfAlias('webroot').'/protected/stampe/survey/'.$file.'.pdf', 'F');
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('stampa' => '/protected/stampe/survey/'.$file.'.pdf?ver='.time()));
        Yii::app()->end();
    }

	public function actionDelete($id)
	{
        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Questionario <b>' . $model->nome . " " . $model->cognome . "</b> eliminato con successo");
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : Yii::app()->request->urlReferrer);
    }

	public function actionDownload($id)
	{
		$tipologia_id = $id;
		$year = date("Y");

		$surveys = new SurveyStays();

		$surveys->exportSurvey($tipologia_id, $year);


/*
		$model = new SurveyStays('search');
        $model->unsetAttributes();  // clear any default values
        //$model->setSelect();
		$model->setAttribute('tipologia_id', $id);
        $model->setAttribute('anno', date("Y"));
        
		//if (isset($_POST['SurveyStays'])) {
        //    $model->attributes = $_POST['SurveyStays'];
		//}

		$tipologia = TipologiaSoggiorni::model()->findByPk($id);

		/*$user = Yii::app()->MyUtils->getUserInfo();
		if($user['user_unita']) {
			$centri = $user['user_unita'];
		}
		else {
			$centri = null;
		}

        $this->render('_esporta', array(
            'model' => $model->search(),
			'tipologia' => $tipologia->tipologia,
        ));*/
	}

	public function loadModel($id)
	{
		$model=SurveyStays::model()->with('tipologia')->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}