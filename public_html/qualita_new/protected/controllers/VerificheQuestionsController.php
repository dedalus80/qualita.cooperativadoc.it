<?php

class VerificheQuestionsController extends Controller
{
	public function actionCreate($id)
	{
		if(isset($_POST['VerificheQuestions'])) {
			$model = new VerificheQuestions();
			$model->attributes = $_POST['VerificheQuestions'];
			$model->setAttribute('tipologiaVerificaId', $id);
			$model->setAttribute('type','SELECT');
			if($model->validate() && $model->save(false))
				Yii::app()->user->setFlash('opResultOK', 'Domanda verifica inserita correttamente');
			else
				Yii::app()->user->setFlash('opResultKO', 'Errore, dati mancanti o non validi');
		}

		$this->redirect(Yii::app()->request->urlReferrer);
	}

	public function actionUpdate($id)
	{
		if (isset($_POST['Questions'])) {
			foreach($_POST['Questions'] as $idk => $question) {
				$model = $this->loadModel($idk);
				$model->attributes = $question;
				$model->setAttribute('tipologiaVerificaId', $id);
				$model->setAttribute('type', 'SELECT');
				if($model->validate() && $model->save(false))
					Yii::app()->user->setFlash('opResultOK', 'Domanda verifica inserita correttamente');
				else
					Yii::app()->user->setFlash('opResultKO', 'Errore, dati mancanti o non validi');
			}
		}

		$this->redirect(Yii::app()->request->urlReferrer);
	}

	public function actionDelete($id)
	{
		$model = $this->loadModel($id)->delete();
        Yii::app()->user->setFlash('opResultOK', 'Domanda <b>' . $model->id . '</b> rimossa con successo');

        //if (!isset($_GET['ajax']))
        //    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));

		$this->redirect(Yii::app()->request->urlReferrer);
	}

	public function loadModel($id)
	{
        $model = VerificheQuestions::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
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