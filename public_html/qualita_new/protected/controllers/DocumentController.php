<?php

class DocumentController extends Controller
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
		$this->authorize('Area Documenti', 'view');

		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'update' page.
	 */
	public function actionCreate($id = null)
	{
		$this->authorize('Area Documenti', 'create');
		$categoryId = $id ? $id : Yii::app()->request->getParam('category_id');
		$category = $categoryId ? DocumentsCategory::model()->findByPk($categoryId) : null;

		if(!$category) {
			throw new CHttpException(404,'La categoria documento non è stata trovata.');
		}

		$model=new Documents('insert');
		$model->category_id = $categoryId;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documents'])) {
			$model->attributes=$_POST['Documents'];
			$model->category_id = $categoryId;
			$model->document = CUploadedFile::getInstance($model, 'document');

			if($model->document) {
				$fileName = $this->sanitizeUploadedFilename($model->document->getName());
				$model->setAttribute('filename', $fileName);
			}

			if($model->validate()) {
				if($model->save()) {
					if($model->document) {
						$model->document->saveAs(Yii::app()->basePath . '/documents/' . $model->filename);
					}
					$this->redirect(array('update','id'=>$model->id));
				}
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'categoryId'=>$categoryId,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'update' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		$this->authorize('Area Documenti', 'update');

		$model->scenario = 'update';

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Documents']))
		{
			$fileName = null;
			$model->oldFilename = $model->filename;
			$categoryId = $model->category_id;

			$model->attributes=$_POST['Documents'];
			$model->category_id = $categoryId;

			$model->document = CUploadedFile::getInstance($model, 'document');
			if($model->document) {
				$fileName = $this->sanitizeUploadedFilename($model->document->getName());
             	$model->setAttribute('filename', $fileName);
			}
			else {
				$model->setAttribute('filename', $model->oldFilename);
			}

			if($model->validate()) {
				if($model->save()) {
					if($fileName) {
						$model->document->saveAs(Yii::app()->basePath . '/documents/' . $model->filename);
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
	 * If deletion is successful, the browser will be redirected to the previous page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->authorize('Area Documenti', 'delete');

		$this->loadModel($id)->delete();

		$this->redirect(Yii::app()->request->urlReferrer);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id = null)
	{
		$this->authorize('Area Documenti', 'view');

		$model = new Documents('search');
        $model->unsetAttributes();

        if(isset($_GET['Documents'])) {
            $model->attributes = $_GET['Documents'];
			if($_GET['Documents']['category_id'])
				$id = intval($_GET['Documents']['category_id']);
		}

		$category = $id ? DocumentsCategory::model()->findByPk($id) : null;

		if($id && !$category) {
			throw new CHttpException(404,'La categoria documento non è stata trovata.');
		}

		$categoryName = $category ? $category->name : 'Elenco documenti';

		if(Yii::app()->user->getState('group') == 'ADMIN') {
			$this->render('index',array(
				'model'=>$model,
				'categoryId' => $id,
				'category' => $categoryName,
			));
		}
		else {
			$this->render('index_user',array(
				'model'=>$model,
				'categoryId' => $id,
				'category' => $categoryName,
			));
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->authorize('Area Documenti', 'create');

		$model=new Documents('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Documents']))
			$model->attributes=$_GET['Documents'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionDownload($id)
	{
		$this->authorize('Area Documenti', 'view');

		$document = $this->loadModel($id);
		$baseDir = Yii::app()->basePath."/documents";
		$src = $baseDir."/".$document->filename;
		DocumentPublicDownload::sendFile($src, $baseDir);
	}

	public function actionPublicDownload($id, $expires, $token)
	{
		if(!DocumentPublicDownload::validateRequest('document/publicDownload', $id, $expires, $token)) {
			throw new CHttpException(403, 'Il link al documento non è valido o è scaduto.');
		}

		$document = $this->loadModel($id);
		$baseDir = Yii::app()->basePath."/documents";
		$src = $baseDir."/".$document->filename;
		DocumentPublicDownload::sendFile($src, $baseDir);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Documents the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Documents::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Documents $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='documents-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	protected function sanitizeUploadedFilename($filename)
	{
		$filename = basename(str_replace('\\', '/', $filename));
		$filename = str_replace(array('/', '\\', "\0", "\r", "\n", '"'), '', $filename);
		$filename = trim($filename);

		if($filename === '') {
			$filename = uniqid('document_', true);
		}

		return $filename;
	}
}
