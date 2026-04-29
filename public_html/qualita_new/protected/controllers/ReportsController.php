<?php

class ReportsController extends Controller
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
			'postOnly + reopen', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		/*return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);*/

		return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'picture', 'deletePicture', 'structureArea', 'users', 'unavailableAreas', 'reopen', 'testtest'),
                //'expression' => 'Yii::app()->user->getState("group") == "ADMIN" || Yii::app()->user->getState("group") == "DIRECTOR"',
                'expression' => 'Yii::app()->user->isEnabled("Segnalazioni")',
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
		$model = $this->loadModel($id);

		/*if(Yii::app()->user->getState('group') == 'SEGNALATORE') {
			$this->authorize('Segnalazioni', 'view', $model->user_id, $model->structure_id);
		}*/

		if(Yii::app()->user->getState('group') == 'MANUTENTORE') {
			$this->authorize('Manutenzioni', 'view', $model->audit->user_id, $model->structure_id);
		}
		else {
			$this->authorize('Segnalazioni', 'view', $model->user_id, $model->structure_id);
		}

		Yii::app()->clientScript->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/css/lightbox.min.css');
		Yii::app()->getClientScript()->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/js/lightbox.min.js', CClientScript::POS_END);

		Yii::app()->clientScript->registerScript('script', "
			$(document).ready(function() {
				$('#btn-reopen').on('click', function(e) {
					if(confirm('Sei sicuro di voler riaprire la manutenzione?')) {
						$.ajax({
							url: '".Yii::app()->createUrl('reports/reopen/'.$model->id)."',  // URL dove inviare la richiesta di rimozione
							method: 'POST',
							dataType: 'json',
							success: function(response) {
								if (response) {
									window.location.href = '".Yii::app()->createUrl('reports/update/'.$model->id)."';
								} else {
									alert('Errore interno del server...');
								}
							},
							error: function() {
								alert('Errore interno del server...');
							}
						});
					}
				});
			});
		", CClientScript::POS_END
		);


		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->authorize('Segnalazioni', 'create');

		$model=new Reports;
		//$audit = new Maintenance;
		$reportPictures = new ReportsPicture;
		//$maintenancePictures = new MaintenancePicture;

		// Uncomment the following line if AJAX validation is needed
		//$this->performAjaxValidation($model);

		if(isset($_POST['Reports'])) {
			try {
				$transaction = Yii::app()->db->beginTransaction();

				$model->attributes=$_POST['Reports'];
				
				//if(Yii::app()->user->getState('group') == 'SEGNALATORE') {
					$model->setAttribute('user_id', Yii::app()->user->id);
				//}
				
				$model->setAttribute('created_at', date('Y-m-d H:i:s'));
				$model->setAttribute('updated_at', date('Y-m-d H:i:s'));
				
				if(!$model->validate() || !$model->save()) {
					//$this->redirect(array('view','id'=>$model->id));
					throw new Exception('Errore nel salvataggio del report.');
				}

				if(isset($_FILES['ReportsPictures']) && count($_FILES['ReportsPictures'])) {
					$images = CUploadedFile::getInstancesByName('ReportsPictures');
					foreach ($images as $image => $pic) {
                        $extension = $pic->getExtensionName();
                        $newName   = $model->id."_".$model->user_id."_".sha1($pic->getName()).".".$extension;

						//salvo l'immagine fisica tramite api dell'app
						$contentImage = base64_encode(file_get_contents($pic->tempName));

						$payload = CJSON::encode( ["picName"=>$newName, 'picContent'=>$contentImage]);
						
						$upload = Tools::uploadImageToFileSystem('picture/rp/upload', Reports::API_TOKEN, $payload);

						if(!$upload) {
							throw new Exception('Immagine non salvata nel filesystem.');
						}

						$reportPictures->setAttributes([
							'report_id' => $model->id,
							'picture' => $newName,
							'created_at' => new CDbExpression('NOW()'),
							'updated_at' => new CDbExpression('NOW()'),
						]);

						if(!$reportPictures->save()) {
							throw new Exception('Immagine non salvata nel db.');
						}
                    }
				}

				/*if(Yii::app()->user->can('Maintenance', 'update')) {
					if(isset($_POST['Maintenance'])) {
						$audit->attributes = $_POST['Maintenance'];
						$audit->setAttributes([
							'created_at' => new CDbExpression('NOW()'),
							'updated_at' => new CDbExpression('NOW()'),
						]);

						if(!$audit->save()) {
							throw new Exception('Errore: manutenzione non salvata');
						}
					}

					if($audit->id && isset($_FILES['MaintenancePictures']) && count($_FILES['MaintenancePictures'])) {
						$images = CUploadedFile::getInstancesByName('MaintenancePictures');
						foreach ($images as $image => $pic) {
							$extension = $pic->getExtensionName();
							$newName   = $audit->id."_".$audit->user_id."_".sha1($pic->getName()).".".$extension;

							//salvo l'immagine fisica tramite api dell'app
							$contentImage = base64_encode(file_get_contents($pic->tempName));

							$payload = CJSON::encode( ["picName"=>$newName, 'picContent'=>$contentImage]);

							$upload = Tools::uploadImageToFileSystem('picture/mp/upload', Reports::API_TOKEN, $payload);
							
							if(!$payload) {
								throw new Exception('Immagine non salvata nel filesystem.');
							}

							$maintenancePictures->setAttributes([
								'maintenance_id' => $audit->id,
								'picture' => $newName,
								'created_at' => new CDbExpression('NOW()'),
								'updated_at' => new CDbExpression('NOW()'),
							]);

							if(!$maintenancePictures->save()) {
								throw new Exception('Immagine non salvata nel db.');
							}
						}
					}
				}*/
			
				$transaction->commit();
			}
			catch(Exception $e) {
				$transaction->rollback();
				Yii::app()->user->setFlash('opResultKO', 'Errore interno del server: '.$e->getMessage());
				$this->redirect(array('create'));
			}

			Yii::app()->user->setFlash('opResultOK', 'Segnalazione creata con successo');
			$this->redirect(array('update','id'=>$model->id));
		}

		self::getHTMLResource();

		$this->render('create',array(
			'model'=>$model,
			//'audit'=>$audit,
			'reportPictures'=>$reportPictures,
			//'maintenancePictures'=>$maintenancePictures,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		if($model->status == 'closed') {
			throw new CHttpException(403, 'Non hai permessi necessari per visualizzare questa pagina.');
		}

		switch(Yii::app()->user->getState('group')) {
			case 'MANUTENTORE':
				if($model->status != 'opened') {
					if(Yii::app()->user->getState('is_maintenance_lead') == 'Y' && $model->audit->user_id != Yii::app()->user->id) {
						throw new CHttpException(403, 'Non hai permessi necessari per visualizzare questa pagina.');
					}

					$this->authorize('Manutenzioni', 'update', $model->audit->user_id, $model->structure_id);
				}
				break;
			case 'SEGNALATORE':
				if($model->status != 'opened') {
					throw new CHttpException(403, 'Non hai permessi necessari per visualizzare questa pagina.');
				}
				$this->authorize('Segnalazioni', 'update', $model->user_id, $model->structure_id);
				break;
			default:
				$this->authorize('Segnalazioni', 'update', $model->user_id, $model->structure_id);
		}

		$audit = $model->audit ? $model->audit : new Maintenance('create');

		$reportPictures = new ReportsPicture;
		$maintenancePictures = new MaintenancePicture;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(Yii::app()->request->isPostRequest) {
			try {
				$transaction = Yii::app()->db->beginTransaction();

				//if(Yii::app()->user->can('Segnalazioni', 'update')) {
					if(isset($_POST['Reports'])) {
						$model->attributes=$_POST['Reports'];
						$model->setAttribute('updated_at', date('Y-m-d H:i:s'));

						if(!$model->validate()) {
							throw new Exception('Error validation form');
						}
						
						if(!$model->save()) {
							throw new Exception('Error save form');
						}
					}

					if(isset($_FILES['ReportsPictures']) && count($_FILES['ReportsPictures'])) {
						$images = CUploadedFile::getInstancesByName('ReportsPictures');
						foreach ($images as $image => $pic) {
							$extension = $pic->getExtensionName();
							$newName   = $model->id."_".$model->user_id."_".sha1($pic->getName()).".".$extension;

							//salvo l'immagine fisica tramite api dell'app
							$contentImage = base64_encode(file_get_contents($pic->tempName));

							$payload = CJSON::encode( ["picName"=>$newName, 'picContent'=>$contentImage]);
							
							$upload = Tools::uploadImageToFileSystem('picture/rp/upload', Reports::API_TOKEN, $payload);

							if(!$upload) {
								throw new Exception('Immagine non salvata nel filesystem.');
							}

							$reportPictures->setAttributes([
								'report_id'  => $model->id,
								'picture'    => $newName,
								'created_at' => new CDbExpression('NOW()'),
								'updated_at' => new CDbExpression('NOW()'),
							]);

							if(!$reportPictures->save()) {
								throw new Exception('Immagine non salvata nel db.');
							}
						}
					}
				//}

				/*
				if(Yii::app()->user->can('Manutenzioni', 'update')) {
					if($model->status == 'opened' || $model->status == 'deleted') {
						//segnalazione rimessa a disposizione, cancello i dati della manutenzione corrente se presente
						if(!$audit->isNewRecord) {
							$audit->delete();
						}
					}
					else {
						if(isset($_POST['Maintenance'])) {
							$audit->attributes = $_POST['Maintenance'];

							if($audit->isNewRecord) {
								$audit->setAttribute('report_id', $model->id);
								$audit->setAttribute('created_at', date('Y-m-d H:i:s'));
								$audit->setAttribute('updated_at', date('Y-m-d H:i:s'));
							}
							else {
								$audit->setAttribute('updated_at', date('Y-m-d H:i:s'));
							}

							if(!$audit->validate()) {
								throw new Exception('Form validation failed');
							}

							if(!$audit->save()) {
								throw new Exception('La manutenzione non può essere salvata.');
							}

							if($audit->id && isset($_FILES['MaintenancePictures']) && count($_FILES['MaintenancePictures'])) {
								$images = CUploadedFile::getInstancesByName('MaintenancePictures');
								foreach ($images as $image => $pic) {
									$extension = $pic->getExtensionName();
									$newName   = $audit->id."_".$audit->user_id."_".sha1($pic->getName()).".".$extension;
		
									//salvo l'immagine fisica tramite api dell'app
									$contentImage = base64_encode(file_get_contents($pic->tempName));
		
									$payload = CJSON::encode( ["picName"=>$newName, 'picContent'=>$contentImage]);
		
									$upload = Tools::uploadImageToFileSystem('picture/mp/upload', Reports::API_TOKEN, $payload);
									
									if(!$payload) {
										throw new Exception('Immagine non salvata nel filesystem.');
									}
		
									$maintenancePictures->setAttributes([
										'maintenance_id' => $audit->id,
										'picture' => $newName,
										'created_at' => new CDbExpression('NOW()'),
										'updated_at' => new CDbExpression('NOW()'),
									]);
		
									if(!$maintenancePictures->save()) {
										throw new Exception('Immagine non salvata nel db.');
									}
								}
							}
						}
					}
				}*/

				$transaction->commit();

				Yii::app()->user->setFlash('opResultOK', 'Segnalazione aggiornata correttamente.');
				$this->redirect(array('update','id'=>$model->id));
			}
			catch(Exception $e) {
				$transaction->rollback();
				//Yii::app()->user->setFlash('opResultKO', 'Errore interno del server: '.$e->getMessage());
				Yii::app()->user->setFlash('opResultKO', 'Si è verificato un errore...');
			}
		}
		
		self::getHTMLResource($audit);
		
		$this->render('update_global',array(
			'model'=>$model,
			'audit'=>$audit,
			'reportPictures'=>$reportPictures,
			'maintenancePictures'=>$maintenancePictures
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$report = $this->loadModel($id);

		$this->authorize('Segnalazioni', 'delete', $report->id, $report->structure_id);

		try {
			if(in_array(Yii::app()->user->getState('group'), ['ADMIN','DIRECTOR'])){
				$report->delete();
			}
			else {
				$report->status = 'deleted';
				$report->updated_at = new CDbExpression('NOW()');
				$report->save();
			}

			echo CJSON::encode(true);
		}
		catch(Exception $e) {
			echo CJSON::encode(['error'=>$e->getMessage()]);
		}
		catch(CHttpException $e) {
			echo $e->getMessage();
			echo CJSON::encode(['error'=>$e->getMessage()]);

		}

		//Yii::app()->end();

		//$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Reports');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->authorize('Segnalazioni', 'view');

		$model=new Reports('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Reports']))
			$model->attributes=$_GET['Reports'];

		Yii::app()->clientScript->registerCssFile('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
		Yii::app()->getClientScript()->registerScriptFile('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', CClientScript::POS_END);

		Yii::app()->clientScript->registerScript('js-remove-img', "
			$(document).ready(function() {
				loadStyleFilter();
			});

			function loadStyleFilter() {
					$('#Reports_structure_area_id, #Reports_structure_id').select2({dropdownAutoWidth : true});
			}
			", CClientScript::POS_END
		);

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Get Pictures of Report
	 */
	public function actionPicture($dir, $image)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.cooperativadoc.it/api/picture/$dir/$image",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer ".Reports::API_TOKEN
			),
		));

		$response = curl_exec($curl);

		$mime = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);

		header('Content-type: '.$mime);

		echo $response;
		exit;
	}

	public function actionDeletePicture()
	{

		$dir = Yii::app()->request->getPost('dir');
		$image = Yii::app()->request->getPost('image');

		//elimino dal db il record, ricavo dal nome dell'immagine l'id
		list($id, $uid, $picName) = explode('_', $image);

		$delete = false;

		if($dir == 'rp') {
			$delete = ReportsPicture::model()->deleteAllByAttributes(['report_id'=>$id,'picture'=>$image]);
		}
		if($dir == 'mp') {
			$delete = MaintenancePicture::model()->deleteAllByAttributes(['maintenance_id'=>$id,'picture'=>$image]);
		}

		if($delete) { //request api per eliminare fisicamente l'immagine dal filesystem
			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://api.cooperativadoc.it/api/picture/$dir/$image/delete",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "DELETE",
				CURLOPT_HTTPHEADER => array(
					"Authorization: Bearer ".Reports::API_TOKEN
				),
			));

			$response = curl_exec($curl);

			$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

			if($httpcode == 204) {
				$response = ['success'=>true, 'message' => 'Immagine eliminata correttamente.'];
			}
			else {
				$response = ['success'=>false, 'message' => 'Errore interno del server, immagine non eliminata.'];
			}

			echo CJSON::encode($response);
		}
		else {
			echo CJSON::encode(['status'=>false,'message'=>'Errore interno del server.']);
		}

		exit;
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Reports the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Reports::model()->with('audit')->findByPk($id);

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Reports $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='reports-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionStructureArea($id)
	{
		if($id) {
			$areas = CHtml::listData(UnitaMappaAree::model()->findAllByAttributes(['unita_id' => $id], ['order'=>'description']), 'id', 'description');
							
			$html = '<option value="">Scegli...</option>';

			foreach($areas as $id => $description) {
				$html .= "<option value=\"$id\">$description</option>";
			}
		}
		else {
			$html = '<option value="">Scegli...</option>';
		}

		echo $html;
	}

	public function actionUsers($id)
	{
		if($id) {
			$users_s = Reports::getListSegnalatore($id);

			$html_s = '<option value="">Scegli...</option>';

			foreach($users_s as $k => $name) {
				$html_s .= "<option value=\"$k\">$name</option>";
			}

			$users_m = CHtml::listData(
								Utenti::model()->findAll(
									"user_type = :type AND FIND_IN_SET(:id, user_unita) ORDER BY cognome, nome", 
									[':id'=>$id, ':type' => 12]
								),
								'id',
								'displayName'
			);

			$html_m = '<option value="">Scegli...</option>';

			foreach($users_m as $k => $name) {
				$html_m .= "<option value=\"$k\">$name</option>";
			}
		}
		else {
			$html_s = '<option value="">Scegli...</option>';
			$html_m = '<option value="">Scegli...</option>';
		}

		$data = [
			'reportUsers' => $html_s,
			'maintenanceUsers' => $html_m,
		];

		echo CJSON::encode($data);
	}

	private function getHTMLResource($audit = null)
	{
		Yii::app()->clientScript->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/css/lightbox.min.css');
		Yii::app()->clientScript->registerCssFile('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
		Yii::app()->getClientScript()->registerScriptFile('https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.5/js/lightbox.min.js', CClientScript::POS_END);
		Yii::app()->getClientScript()->registerScriptFile('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', CClientScript::POS_END);

		Yii::app()->clientScript->registerScript('script', "
			$(document).ready(function() {
				$('#Reports_structure_area_id').select2();

				$('.remove-image').on('click', function(e) {
					e.preventDefault();

					if(confirm('Sei sicuro di voler eliminare questa foto?')) {
						// Ottieni l'ID dell'immagine da rimuovere
						var imageDir = $(this).data('image-dir');
						var imageName = $(this).data('image-name');
						var imageId = $(this).data('image-id');
						var imageContainer = $('#image' + imageId); // Div contenitore dell'immagine

						// Invia una richiesta AJAX al server per rimuovere l'immagine
						$.ajax({
							url: '".Yii::app()->createUrl('reports/picture')."/delete',  // URL dove inviare la richiesta di rimozione
							method: 'POST',
							dataType: 'json',
							data: { dir: imageDir, image: imageName },
							success: function(response) {
								if (response.success) {
									// Rimuovi l'immagine dal DOM dopo la conferma dal server
									imageContainer.remove();
								} else {
									alert('Errore nella rimozione dell\'immagine.');
								}
							},
							error: function() {
								alert('Si è verificato un errore durante la richiesta.');
							}
						});
					}
				});

				$('#Reports_structure_id').on('change', function(e){
					e.preventDefault();

					let structureId = $(this).val() ? $(this).val() : 0;

					$.ajax({
						url: '".Yii::app()->createUrl('reports/structure/areas')."/' + structureId,
						method: 'GET',
						dataType: 'html',
						success: function(response) {
							$('#Reports_structure_area_id').html(response);
						},
						error: function() {
							alert('Internal error...');
						}
					});

					$.ajax({
						url: '".Yii::app()->createUrl('reports/users')."/' + structureId,
						method: 'GET',
						dataType: 'json',
						success: function(response) {
							$('#Reports_user_id').html(response.reportUsers);
							$('#Maintenance_user_id').html(response.maintenanceUsers);
						},
						error: function() {
							alert('Internal error...');
						}
					});

				});

				$('#Reports_status').on('change', function(e) {
					e.preventDefault();

					let status = $(this).val();

					if(status == 'opened') {
						alert('Impostando lo stato su \"APERTO\" la manutenzione attuale sarà eliminata e rimessa a disposizione dei manutentori');
						$('#audit-panel').hide();
					}
					else {
						$('#audit-panel').show();
					}
				});

				$('#btn-maintenance-delete').on('click', function(e) {
					e.preventDefault();

					if(confirm('Sei sicuro di eliminare la manutenzione? Lo stato della segnalazione sarà impostato ad \"APERTO\" e resa disponibile agli altri manutentori.')) {
						$.ajax({
							url: '".Yii::app()->createUrl('maintenance/delete/'.$audit->id)."',
							method: 'POST',
							dataType: 'json',
							success: function(response) {
								if(response) {
									alert('Manutenzione eliminata correttamente');
									window.location.href = '".Yii::app()->createUrl('reports/admin')."';
								}
								else {
									alert('Errore, impossibile eliminare la manutenzione.');
								}	
							},
							error: function() {
								alert('Internal error...');
							}
						});
					}
				});

				$('#btn-maintenance-complete').on('click', function(e) {
					e.preventDefault();

					if(confirm('Vuoi completare la manutenzione? Non sarà possibile modificarla successivamente')) {
						$.ajax({
							url: '".Yii::app()->createUrl('maintenance/complete/'.$audit->id)."',
							method: 'POST',
							dataType: 'json',
							success: function(response) {
								if(response.success) {
									//alert('Manutenzione completata con successo!');
									window.location.href = '".Yii::app()->createUrl('reports/admin')."';
								}
								else {
									alert(response.error);
								}
							},
							error: function() {
								alert('Internal error...');
							}
						});
					}
				});
			});
			", CClientScript::POS_END
		);

		Yii::app()->clientScript->registerCss('css-style', '
			/* Stili personalizzati */
			.gallery img {
				width: 100%;
				height: auto;
				border-radius: 5px;
				transition: 0.3s;
			}

			.gallery img:hover {
				transform: scale(1.05);
				box-shadow: 0px 4px 10px rgba(0,0,0,0.5);
			}

			.gallery {
				margin-bottom: 30px;
			}

			.image-container {
				position: relative;
				display: inline-block;
				margin-bottom: 5px;
				margin-top: 5px;
			}

			/* Icona rimuovi immagine */
			.remove-image {
				display: none;
				position: absolute;
				z-index: 10;
			}

			/* Mostra il bottone di rimozione al passaggio del mouse */
			.image-container:hover .remove-image {
				display: block;
			}
		');
	}

	public function actionUnavailableAreas()
	{
		$model=new Reports('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Reports']))
			$model->attributes=$_GET['Reports'];

		Yii::app()->clientScript->registerCssFile('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
		Yii::app()->getClientScript()->registerScriptFile('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', CClientScript::POS_END);

		Yii::app()->clientScript->registerScript('script', "
			$(document).ready(function() {
				loadStyleFilter();
			});

			function loadStyleFilter() {
					$('#Reports_structure_area_id, #Reports_structure_id').select2({dropdownAutoWidth : true});
			}
			", CClientScript::POS_END
		);

		$this->render('unavailableAreas',array(
			'model'=>$model,
		));
	}

	public function actionReopen($id)
	{
		if( in_array(Yii::app()->user->getState('group'), ['ADMIN','DIRECTOR'])) {
			$report = Reports::model()->findByPk($id);
			$report->status = 'assigned';
			$report->updated_at = new CDbExpression('NOW()');
			$report->save();

			$success = true;
		}
		else {
			$success = false;
		}

		echo CJSON::encode($success);
	}

	public function actionTesttest()
	{
		$report = new Reports();
		$report->created_at = date('Y-m-d H:i:s');
		$report->user_id = 100;
		$report->save(false);
	}
}
