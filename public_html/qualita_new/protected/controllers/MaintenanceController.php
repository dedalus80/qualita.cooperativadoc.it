<?php

class MaintenanceController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
			'postOnly + complete', // we only allow deletion via POST request
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
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'picture', 'deletePicture', 'structureArea', 'users', 'unavailableAreas', 'complete'),
                'expression' => 'Yii::app()->user->isEnabled("Manutenzioni")',
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->authorize('Manutenzioni', 'create');

		$model=new Maintenance;
		$maintenancePictures = new MaintenancePicture;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Maintenance']))
		{
			$model->attributes=$_POST['Maintenance'];
			$model->setAttribute('created_at', date('Y-m-d H:i:s'));
			$model->setAttribute('updated_at', date('Y-m-d H:i:s'));

			if(Yii::app()->user->getState('group') == 'MANUTENTORE' && Yii::app()->user->getState('is_maintenance_lead') == 'N') {
				$model->setAttribute('user_id', Yii::app()->user->id);
			}

			$error = false;

			if($model->validate() && $model->save()) {

				$report = Reports::model()->findByPk($model->report_id);
				$report->status = 'assigned';
				$report->updated_at = new CDbExpression('NOW()');
				$report->save();

				if(isset($_FILES['MaintenancePictures']) && count($_FILES['MaintenancePictures'])) {
					$images = CUploadedFile::getInstancesByName('MaintenancePictures');
					foreach ($images as $image => $pic) {
						$extension = $pic->getExtensionName();
						$newName   = $model->id."_".$model->user_id."_".sha1($pic->getName()).".".$extension;

						//salvo l'immagine fisica tramite api dell'app
						$contentImage = base64_encode(file_get_contents($pic->tempName));

						$payload = CJSON::encode( ["picName"=>$newName, 'picContent'=>$contentImage]);

						$upload = Tools::uploadImageToFileSystem('picture/mp/upload', Reports::API_TOKEN, $payload);
						
						if($upload) {
							$maintenancePictures->setAttributes([
								'maintenance_id' => $model->id,
								'picture' => $newName,
								'created_at' => new CDbExpression('NOW()'),
								'updated_at' => new CDbExpression('NOW()'),
							]);
	
							if(!$maintenancePictures->save()) {
								Yii::app()->user->setFlash('opResultKO', 'Si è verificato un errore...');
								$error = true;
								break;
							}
						}
						else {
							$maintenancePictures->addError('picture', 'Immagine non salvata nel filesystem');
							$error = true;
							break;
						}
					}
				}
				
				if(!$error) {
					Yii::app()->user->setFlash('opResultOK', 'Manutenzione aggiornata correttamente.');
					//$this->redirect(array('reports/update','id'=>$model->report_id));

					if(Yii::app()->user->getState('is_maintenance_lead') == 'N') {
						$this->redirect(array('reports/update','id'=>$model->report_id));
					}
					else {
						$this->redirect($this->createUrl('reports/'.$model->report_id));
					}
				}
			}
		}

		$this->render('//reports/update',array(
			'model'=>$model->report,
			'audit'=>$model,
			'reportPictures'=>$model->report->pictures,
			'maintenancePictures'=>$maintenancePictures
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$maintenancePictures = new MaintenancePicture;

		$this->authorize('Manutenzioni', 'update', $model->user_id);
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$error = false;

		if(isset($_POST['Maintenance']))
		{
			$model->attributes=$_POST['Maintenance'];
			$model->setAttribute('updated_at', date('Y-m-d H:i:s'));

			if(Yii::app()->user->getState('group') == 'MANUTENTORE' && Yii::app()->user->getState('is_maintenance_lead') == 'N') {
				$model->setAttribute('user_id', Yii::app()->user->id);
			}

			if($model->validate() && $model->save()) {
				if(isset($_FILES['MaintenancePictures']) && count($_FILES['MaintenancePictures'])) {
					$images = CUploadedFile::getInstancesByName('MaintenancePictures');
					foreach ($images as $image => $pic) {
						$extension = $pic->getExtensionName();
						$newName   = $model->id."_".$model->user_id."_".sha1($pic->getName()).".".$extension;

						//salvo l'immagine fisica tramite api dell'app
						$contentImage = base64_encode(file_get_contents($pic->tempName));

						$payload = CJSON::encode( ["picName"=>$newName, 'picContent'=>$contentImage]);

						$upload = Tools::uploadImageToFileSystem('picture/mp/upload', Reports::API_TOKEN, $payload);
						
						if($upload) {
							$maintenancePictures->setAttributes([
								'maintenance_id' => $model->id,
								'picture' => $newName,
								'created_at' => new CDbExpression('NOW()'),
								'updated_at' => new CDbExpression('NOW()'),
							]);
	
							if(!$maintenancePictures->save()) {
								Yii::app()->user->setFlash('opResultKO', 'Si è verificato un errore...');
								$error = true;
								break;
							}
						}
						else {
							$maintenancePictures->addError('picture', 'Immagine non salvata nel filesystem');
							$error = true;
							break;
						}
					}
				}

				//check flags su tabella report
				if(isset($_POST['Reports'])) {
					$postData = $_POST['Reports'];

					$report = $model->report;
					$report->area_not_available = $postData['area_not_available']; 
					$report->escalated_to_admin = $postData['escalated_to_admin'];
					$report->updated_at = new CDbExpression('NOW()');
					$report->save(); 
				}

				if(!$error) {
					Yii::app()->user->setFlash('opResultOK', 'Manutenzione aggiornata correttamente.');
					$this->redirect(array('reports/update','id'=>$model->report_id));
				}
			}
		
			$this->redirect(array('reports/update','id'=>$model->report_id));
		}

		$this->render('//reports/update',array(
			'model'=>$model->report,
			'audit'=>$model,
			'reportPictures'=>$model->report->pictures,
			'maintenancePictures'=>$model->pictures
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$audit = $this->loadModel($id);

		$this->authorize('Manutenzioni', 'delete', $audit->user_id);

		try {
			$transaction = Yii::app()->db->beginTransaction();

			$report = $audit->report;
			$report->status = 'opened';
			$report->updated_at = new CDbExpression('NOW()');
			$report->save();

			$audit->delete();

			$transaction->commit();

			echo CJSON::encode(true);
		}
		catch(Exception $e) {	
			$transaction->rollback();

			echo CJSON::encode(false);
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));

		Yii::app()->end();
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Maintenance');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Maintenance('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Maintenance']))
			$model->attributes=$_GET['Maintenance'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Maintenance the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Maintenance::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Maintenance $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='maintenance-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionComplete($id)
	{
		$audit = $this->loadModel($id);

		$this->authorize('Manutenzioni', 'update', $audit->user_id);

		if($audit->description == '' || !$audit->description) {
			echo CJSON::encode(['success'=>false, 'error'=>'Non puoi completare la manutenzione senza inserire almeno la descrizione.']);
			Yii::app()->end();
		}

		try {
			$transaction = Yii::app()->db->beginTransaction();

			$report = $audit->report;
			$report->status = 'closed';
			$report->updated_at = new CDbExpression('NOW()');
			$report->save();

			$audit->updated_at = new CDbExpression('NOW()');
			$audit->save();

			$transaction->commit();

			Yii::app()->user->setFlash('opResultOK', 'Manutenzione completata correttamente.');

			echo CJSON::encode(['success'=>true]);
		}
		catch(Exception $e) {	
			$transaction->rollback();

			echo CJSON::encode(['success'=>false]);
		}
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		//if(!isset($_GET['ajax']))
		//	$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));

		Yii::app()->end();
	}
}
