<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function init()
	{
		/*$fs = Yii::app()->clientScript;
		$fs->coreScriptPosition=CClientScript::POS_HEAD;
		$fs->clientScript->registerPackage('highcharts');
		$fs->clientScript->registerPackage('chart');
		*/
		Yii::app()->clientScript->coreScriptPosition=CClientScript::POS_END;
		Yii::app()->clientScript->registerPackage('jquery');
		Yii::app()->clientScript->registerPackage('jquery-ui');
		Yii::app()->clientScript->registerPackage('bootstrap');
		Yii::app()->clientScript->registerPackage('plugin');
		Yii::app()->clientScript->registerPackage('custom');
		Yii::app()->clientScript->registerPackage('stylecss');
		Yii::app()->clientScript->registerPackage('cloudflare');
		Yii::app()->clientScript->registerPackage('jsdelivr');
	}

	public function beforeAction($action)
	{
		/*if(Yii::app()->user->id) {
			if(Yii::app()->params['maintenance'] == true && !in_array(Yii::app()->user->id, array(100,37))) {				
				throw new CHttpException(503, 'Piattaforma in manutenzione');
				//$this->render('//layouts/maintenance');
			}
		}*/

		if (Yii::app()->user->isGuest && !$this->isPublicAction()) {
            $this->redirect(Yii::app()->createUrl('site/login'));
        }

		if(Yii::app()->user->id && Yii::app()->user->getState('expiredPassword') && Yii::app()->user->getState('expiredPassword') < time() && $this->action->id != 'expired') {
			//la password è scaduta
			$this->redirect(Yii::app()->createUrl('site/expired'));
		}
		
		if(Yii::app()->user->id) {
			$this->getInfoRequest();
		}

		return parent::beforeAction($action);
    }

	protected function isPublicAction()
	{
		if($this->id == 'site' || $this->action->id == 'index') {
			return true;
		}

		$publicActions = array(
			'document' => array('publicDownload'),
			'documentiQualita' => array('publicDownload'),
			'documentiSoggiorni' => array('publicDownload'),
		);

		return isset($publicActions[$this->id]) && in_array($this->action->id, $publicActions[$this->id]);
	}

	private function getInfoRequest() 
	{
		$request = Yii::app()->request;
		
		$type = $request->getRequestType();
		$url = $request->getUrl();
		$data = count($_POST) ? serialize($_POST): (count($_GET) ? serialize($_GET) : "");
		
		if(Yii::app()->request->rawBody) {
			$dataRaw = serialize(Yii::app()->request->rawBody);
		}

		$browser = $_SERVER['HTTP_USER_AGENT'];

		$currentClassControllerAction = ucfirst($this->id).".action".ucfirst($this->action->id);

		$logRequest = new UtentiLogRequest();
		$logRequest->user_id = Yii::app()->user->id ? Yii::app()->user->id : 0;
		$logRequest->request_method = $type;
		$logRequest->request_url = $url;
		$logRequest->request_data = $data;
		$logRequest->request_body_raw = $dataRaw;
		$logRequest->request_browser = $browser;
		$logRequest->class_controller_action = $currentClassControllerAction;
		$logRequest->ip_address = $_SERVER["HTTP_CF_CONNECTING_IP"] ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR'];
		$logRequest->request_http_code_response = http_response_code();
		$logRequest->save(false);
	}

	public function authorize($section = null, $action = null, $entityId = null, $unitId = null)
	{	
		if(Yii::app()->user->getState('group') !== 'ADMIN') {
			if(!$section) {
				throw new CHttpException(400, 'La richiesta non può essere processata correttamente.');
			}

			if(!$action) {
				$action = Yii::app()->controller->action->id;
			}

			if(!Yii::app()->user->can($section, $action)) {
				throw new CHttpException(403, 'Non hai permessi necessari per visualizzare questa pagina.');
			}

			//if($entityId && $unitId) {
			if($entityId && $unitId) {
				//if(!Yii::app()->user->can($section, $action)) {
				//	throw new CHttpException(403, 'Non hai permessi necessari per visualizzare questa pagina.');
				//}
				//else {
					if($entityId != Yii::app()->user->getId() && !in_array($unitId, Yii::app()->user->getState('strutture'))) {
					//if($entityId != Yii::app()->user->getId() || !in_array($unitId, Yii::app()->user->getState('strutture'))) {
						throw new CHttpException(403, 'Non hai permessi necessari per visualizzare questa pagina.');
					}
				//}
			}
		}
	}
}
