<?php

class SurveyModule extends CWebModule
{
	/** @var bool Abilita il widget Google Translate nelle view fill e thankyou. Impostare true in produzione. */
	public $enableGoogleTranslateWidget = false;

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'survey.models.*',
			'survey.components.*',
		));

		$this->layoutPath = Yii::getPathOfAlias('survey.views.layouts');
		//$this->layout = 'main';
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
