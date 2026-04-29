<?php

class SiteController extends Controller 
{
    /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
			array('allow', // allow authenticated users to access all actions
                'actions'=>array('index','expired'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
                'actions'=>array('index','expired'),
				'users'=>array('*'),
			),
            array('allow',  // allow all users to access 'index' and 'view' actions.
				'users'=>array('*'),
			),
		);
	}

    public function actions() 
    {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }
    
    /*public function accessRules() {

        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('ajaxStrutture'),
            ),
        );
    }*/
    
    public function actionIndex()
    {
        
        // $model = new LoginForm;
        // if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
        //     echo CActiveForm::validate($model);
        //     Yii::app()->end();
        // }

        // if (isset($_POST['LoginForm'])) {
        //     $model->attributes = $_POST['LoginForm'];

        //     if ($model->maintenance) {
        //         if ($model->username == 'archynet' || $model->username == 'federico.gribaudo' || $model->username == 'utente1' || $model->username == 'auditor1' || $model->username == 'ResponsabileCentro1' || $model->username == 'RespStrutture1') {
        //             if ($model->validate() && $model->login())
        //             {
                        
        //             }
        //             else {
        //                 Yii::app()->user->setFlash('opResultKO', 'Dati utente non validi');
        //             }
        //         }
        //         else {
        //             Yii::app()->user->setFlash('maintenance', "Sito attualmente in manuntenzione.<br >Riprovare pi&ugrave; tardi o contattare l'amministratore");
        //         }
        //     }
        //     else {
        //         if ($model->validate() && $model->login()) {

        //             //check if password expired
        //             /**
        //                 if($model->passwordExpired()) {
        //                     ....    
        //                 }
        //              * 
        //              */

        //             Yii::app()->db->createCommand("UPDATE utenti SET last_login = NOW() WHERE id ='" . Yii::app()->user->getId() . "'")->execute();
        //         }
        //         else {
        //             Yii::app()->user->setFlash('opResultKO', 'Dati utente non validi');
        //         }
        //     }
        // }
        
        //$this->layout = 'mainsite';
        $this->render('index');
    }

    public function actionReset()
    {
        $model = new LoginForm;
        $dati = $model->checkUser($_POST);
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('stato' => $dati['stato'], 'testo' => $dati['testo']));
        Yii::app()->end();
    } 
        
    public function actionGetSelect()
    {    
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('dati' =>Yii::app()->MyUtils->getAjaxSelect($_POST) ));
        //echo CJSON::encode(array('dati' => array("ok") ));
        Yii::app()->end();
    }
    
    public function actionError() 
    {
        $this->layout = 'mainsite';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionContact() 
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form
        $this->layout = 'mainsite';
        $this->render('login', array('model' => $model));
    }

    public function actionExport() 
    {
        if (Yii::app()->user->isEnabled('Scarica Dati')) {
            $this->render('esporta');
        }
        else {
            throw new CHttpException(403, 'Non hai permessi necessari per visualizzare questa pagina.');
        }
    }

    public function actionLogout() 
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
    
    public function actionAjaxStrutture() 
    {
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('dati' => $dati = Yii::app()->MyUtils->getAjaxStrutture($_POST['struttura']) ));
        Yii::app()->end();
    }

    public function actionActivation($token)
    {
        $model = Utenti::model()->find('activation_token = :token AND is_active = :active', array('token'=>$token, 'active'=>'N'));
        if($model === null) {
            throw new CHttpException(404, 'La pagina richiesta non esiste');
        }

        if(isset($_POST['Utenti'])) {
            $model->scenario = 'activation';

            $model->attributes = $_POST['Utenti'];
            if($model->validate() && $model->save()) {
                Yii::app()->user->setFlash('activation', 'Password creata correttamente, ora puoi accedere al tuo account.');
                $this->redirect('/qualita_new/index.php/site/login');
            }
        }

        $this->layout = 'mainsite';

        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/psc.js?q=v'.rand(0,1000), CClientScript::POS_END);
        Yii::app()->clientScript->registerCss('cssPwdStrenght', '
            .displayBadge{
                margin-top:5px; 
                text-align:center;
            }
        ');

        $this->render('activation_account', array('model' => $model));
    }

    public function actionExpired()
    {
        $model = Utenti::model()->findByPk(Yii::app()->user->id);
        if($model === null) {
            throw new CHttpException(404, 'La pagina richiesta non esiste');
        }

        if(isset($_POST['Utenti'])) {
            $model->scenario = 'expired';

            $model->attributes = $_POST['Utenti'];
            if($model->validate() && $model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Password modificata correttamente!');
                $this->redirect('/qualita_new');
            }
            else {
                var_dump($model->getErrors());
                exit;
            }
        }

        $this->layout = 'mainsite';

        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/psc.js?q=v'.rand(0,1000), CClientScript::POS_END);
        Yii::app()->clientScript->registerCss('cssPwdStrenght', '
            .displayBadge{
                margin-top:5px; 
                text-align:center;
            }
        ');

        $this->render('password_expired', array('model' => $model));
    }

    public function actionChangepassword($token)
    {
        $reset = UtentiRequestResetPassword::model()->find('token = :token AND expire_date > NOW()', array('token'=>$token));
        if($reset === null) {
            throw new CHttpException(404, 'La pagina richiesta non esiste o è scaduta');
        }

        $model = Utenti::model()->findByPk($reset->user_id);

        if(isset($_POST['Utenti'])) {
            $model->scenario = 'change';

            $model->attributes = $_POST['Utenti'];
            if($model->validate() && $model->save()) {
                Yii::app()->user->setFlash('activation', 'Password modificata correttamente, ora puoi accedere al tuo account.');
                $this->redirect('/qualita_new/index.php/site/login');
            }
        }

        $this->layout = 'mainsite';

        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/psc.js?q=v'.rand(0,1000), CClientScript::POS_END);
        Yii::app()->clientScript->registerCss('cssPwdStrenght', '
            .displayBadge{
                margin-top:5px; 
                text-align:center;
            }
        ');

        $this->render('change_password', array('model'=> $model));
    }

    /*public function actionUpuser()
    {
        $users = Utenti::model()->findAll();

        foreach($users as $user) {
            $salt = '$6$'.base64_encode(openssl_random_pseudo_bytes(32));
            $password_hash = crypt($user->password, $salt);

            Yii::app()->db->createCommand("UPDATE utenti SET password_hash = '$password_hash' WHERE id = '".$user->id."'")->execute();
        }
    }*/
    
}