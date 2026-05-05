<?php

class DocumentiSoggiorniController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('publicDownload'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','download','admin','create','update','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->authorize('DocumentiSoggiorni', 'view');

		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id = null)
	{
		$this->authorize('DocumentiSoggiorni', 'create');

		$model=new DocumentiSoggiorni('insert');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DocumentiSoggiorni'])) {
			$model->attributes=$_POST['DocumentiSoggiorni'];
			$model->document = CUploadedFile::getInstance($model, 'document');
			
			if($model->document) {
				$fileName = $model->document->getName();//  $model->getNomeAllegato($upload->extensionName);			
				$model->setAttribute('filename', $fileName);
			}

			if($model->validate()) {
				if($model->save()) {
					$model->document->saveAs(Yii::app()->basePath . '/documenti_soggiorni/' . $model->filename);
					$this->redirect(array('update','id'=>$model->id));
				}
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'proceduraId'=>$id,// Yii::app()->request->getQuery('p'),
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->authorize('DocumentiSoggiorni', 'update');

		$model=$this->loadModel($id);
		$model->scenario = 'update';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DocumentiSoggiorni']))
		{
			$model->oldFilename = $model->filename;

			$model->attributes=$_POST['DocumentiSoggiorni'];

			$model->document = CUploadedFile::getInstance($model, 'document');

			if($model->document) {
				$fileName = $model->document->getName();//$model->getNomeAllegato($upload->extensionName);				
				$model->setAttribute('filename', $fileName);
			}
			else {
				$model->setAttribute('filename', $model->oldFilename);
			}
			
			if($model->validate()) {
				if($model->save()) {
					if($fileName) {
						$model->document->saveAs(Yii::app()->basePath . '/documenti_soggiorni/' . $model->filename);
					}
					
					$this->redirect(array('update','id'=>$model->id));
				}
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->authorize('DocumentiSoggiorni', 'delete');

		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));

		$this->redirect(Yii::app()->request->urlReferrer);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id = null)
	{
		$this->authorize('DocumentiSoggiorni', 'view');

		$model = new DocumentiSoggiorni('search');
        $model->unsetAttributes();

        if(isset($_GET['DocumentiSoggiorni'])) {
            $model->attributes = $_GET['DocumentiSoggiorni'];
			if($_GET['DocumentiSoggiorni']['procedura_id'])
				$id = intval($_GET['DocumentiSoggiorni']['procedura_id']);
		}
		else {
			if(!$id) $id = 1;
		}

		if(Yii::app()->user->getState('group') == 'ADMIN') {
			$this->render('index',array(
				'model'=>$model,
				'proceduraId' => $id,
			));
		}
		else {
			$this->render('index_user',array(
				'model'=>$model,
				'proceduraId' => $id,
			));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->authorize('DocumentiSoggiorni', 'create');

		$model=new DocumentiSoggiorni('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DocumentiSoggiorni']))
			$model->attributes=$_GET['DocumentiSoggiorni'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionDownload($id)
	{
		$this->authorize('DocumentiSoggiorni', 'view');

		$document = $this->loadModel($id);
		$baseDir = Yii::app()->basePath."/documenti_soggiorni";
		$src = $baseDir."/".$document->filename;
		DocumentPublicDownload::sendFile($src, $baseDir);
	}

	public function actionPublicDownload($id, $expires, $token)
	{
		if(!DocumentPublicDownload::validateRequest('documentiSoggiorni/publicDownload', $id, $expires, $token)) {
			throw new CHttpException(403, 'Il link al documento non è valido o è scaduto.');
		}

		$document = $this->loadModel($id);
		$baseDir = Yii::app()->basePath."/documenti_soggiorni";
		$src = $baseDir."/".$document->filename;
		DocumentPublicDownload::sendFile($src, $baseDir);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return DocumentiSoggiorni the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=DocumentiSoggiorni::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param DocumentiSoggiorni $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='documenti-qualita-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
