<?php

class DefaultController extends CController
{
	public $customFooter = null;
	public function actionIndex()
	{
		$this->layout = 'main_survey_parents';
		$this->render('index');
	}

	public function actionSatisfactionParent()
	{

		//Yii::app()->setLanguage('en');

		$survey = new SurveyParents();

		if(isset($_POST['ajax']) && $_POST['ajax']==='survey-form')
		{
			echo CActiveForm::validate($survey);
			Yii::app()->end();
		}
		if(isset($_POST['SurveyParents'])) {
			$survey->attributes = $_POST['SurveyParents'];

			if($survey->validate() && $survey->save()) {
				$this->redirect('satisfaction-parent-success');
			}
		}
		
		$this->pageTitle = 'Questionario Genitori';
		$this->layout = 'main_survey_parents';
		$this->render('satisfaction-parent', array('model'=>$survey));
	}

	public function actionSatisfactionParentSuccess()
	{
		$this->pageTitle = 'Questionario Genitori';
		$this->layout = 'main_survey_parents';
		$this->render('satisfaction-parent-success');
	}

	public function actionSatisfactionSummerStays()
	{
		$survey = new SurveyStays();

		if(isset($_POST['ajax']) && $_POST['ajax']==='survey-form')
		{
			echo CActiveForm::validate($survey);
			Yii::app()->end();
		}
		if(isset($_POST['SurveyStays'])) {

			$tipologiaId = intval($_POST['SurveyStays']['tipologia_id']);

			switch($tipologiaId) {
				case 3:
					$scenario = 'student';
					break;
				case 4:
					$scenario = 'scientific';
					break;
				case 5:
					$scenario = 'sport';
					break;
				default:
					$scenario = 'insert';
			}

			$survey->setScenario($scenario);
			$survey->attributes = $_POST['SurveyStays'];

			if($survey->validate() && $survey->save()) {
				$this->redirect('satisfaction-summer-stays-success');
			}
		}

		$this->pageTitle = 'Questionario Partecipanti';
		$this->layout = 'main_survey_parents';
		$this->render('satisfaction-summer-stays', array('model'=>$survey));
	}

	public function actionSatisfactionSummerStaysSuccess()
	{
		$this->pageTitle = 'Questionario Partecipanti';
		$this->layout = 'main_survey_parents';
		$this->render('satisfaction-summer-stays-success');
	}

	public function actionStays()
	{
		$html = '';

		if(Yii::app()->request->isAjaxRequest) {
			$tipologia = intval(Yii::app()->request->getPost('t'));
			$cliente = intval(Yii::app()->request->getPost('c'));
			
			

			//$data = ClientiTipologiaSoggiorni::model()->with('soggiorno')->findAll(['condition'=>'cliente_id='.$cliente.' AND tipologia_id='.$tipologia, 'order'=>'soggiorno']);
			$data = Soggiorni::model()->with('soggiorni')->findAll(['condition'=>'soggiorni.cliente_id='.$cliente.' AND soggiorni.tipologia_id='.$tipologia, 'order'=>'nome']);
			
			if($data) {
				foreach($data as $row) {
					$html .= '<option value="'.$row['id'].'">'.$row['nome'].'</option>'."\n";
				}
			}

			/*
			switch ($tipologia) {
                case "JUN":
                    $col = "qjunior";
                    break;
                case "SEN":
                    $col = "qsenior";
                    break;
                case "STU":
                    $col = "qstudio";
                    break;
                case "SCI":
					$col = "qsport";
					break;
				case "SPO":
                    $col = "qscientifici";
                    break;
				default:
					$col = "";
            }

			if($col) {
				$records = CHtml::listData(Strutture::model()->findAll(['condition'=>$col.'="Y" AND ente = '.$cliente, 'order'=>'nome']), 'id', 'nome');
			
				foreach($records as $id => $val) {
					$html .= '<option value="'.$id.'">'.$val.'</option>'."\n";
				}
			}*/
		}

		echo $html;
		Yii::app()->end();
	}

	public function actionType()
	{
		$html = '';

		if(Yii::app()->request->isAjaxRequest) {
			$cliente = intval(Yii::app()->request->getPost('c'));


			$data = TipologiaSoggiorni::model()->with('tipologia')->findAll(['condition'=>'tipologia.cliente_id = '.$cliente, 'order'=>'t.tipologia']);

			if($data) {
				foreach($data as $row) {
					$html .= '<option value="'.$row['id'].'">'.$row['tipologia'].'</option>';
				}
			}
			
			/*exit;

			$data = Clienti::model()->findByPk($cliente);
			if($data) {
				if($data->qjunior == 'Y')
					$html .= '<option value="JUN">JUNIOR</option>';
				if($data->qsenior == 'Y')
					$html .= '<option value="SEN">SENIOR</option>';
				if($data->qstudio == 'Y')
					$html .= '<option value="STU">VACANZE STUDIO</option>';
				if($data->qscientifici == 'Y')
					$html .= '<option value="SCI">CAMPUS SCIENTIFICI</option>';
				if($data->qsport == 'Y')
					$html .= '<option value="SPO">CAMPUS SPO</option>';
			}*/
		}

		echo $html;
		Yii::app()->end();
	}

	public function actionExport($anni = null)
	{
		$model = new SurveyStays('search');
        $data = $model->getDataToExport($anni);
        $this->renderPartial('_export', array('model' => $data));
	}

	public function actionThankyou()
    {
        $this->layout = 'main_survey_parents';
        
        // Retrieve questionnaire information from session
        $questionnaire = null;
        if (isset(Yii::app()->session['completed_questionnaire'])) {
            $questionnaireData = Yii::app()->session['completed_questionnaire'];
            $questionnaire = new stdClass();
            $questionnaire->id = $questionnaireData['id'];
            $questionnaire->title = $questionnaireData['title'];
            $questionnaire->logo = $questionnaireData['logo'];
            $questionnaire->client_id = $questionnaireData['client_id'];
            $questionnaire->footer_description = $questionnaireData['footer_description'];
            
            // Generate footer HTML using the same logic as actionFill
            /*if (!empty($questionnaire->footer_description)) {
                $footerHtml = '';
                if (!empty($questionnaire->logo)) {
                    $logoUrl = CHtml::encode(Yii::app()->request->baseUrl . '/uploads/questionnaires/' . $questionnaire->logo);
                    $footerHtml = '<div class="row align-items-center justify-content-center p-3">
                        <div class="col-12 col-md-4 text-center mb-3 mb-md-0">
                            <img class="d-block mx-auto mb-4" src="' . $logoUrl . '" alt="Logo" width="150">
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start">
                            <div class="text-muted small">' . nl2br(CHtml::encode($questionnaire->footer_description)) . '</div>
                        </div>
                    </div>';
                } else {
                    $footerHtml = '<div class="row p-3"><div class="col-12 text-center"><div class="text-muted small">' . nl2br(CHtml::encode($questionnaire->footer_description)) . '</div></div></div>';
                }
                $this->customFooter = $footerHtml;
            }*/
            // Clear the session data after retrieving it
            unset(Yii::app()->session['completed_questionnaire']);
        }

		$this->customFooter = "<footer class=\"blog-footer\"></footer>";
        
        $this->render('thankyou', ['questionnaire' => $questionnaire]);
    }
}