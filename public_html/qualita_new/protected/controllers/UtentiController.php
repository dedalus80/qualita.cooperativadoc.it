<?php

class UtentiController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array('accessControl',);
    }

    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'view', 'esporta', 'getNotifiche', 'setNotifiche','email', 'ajaxTagLookup'),
                //'users' => Yii::app()->MyUtils->getPermition('admin'),
                'expression'=>'Yii::app()->user->getState("group") == "ADMIN"',
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('profilo', 'utente','changepassword'),
                'users' => Yii::app()->MyUtils->getPermition('all'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionGetNotifiche() {
        $dati = $this->loadModel($_POST['id']);
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('dati' => $dati));
        Yii::app()->end();
    }

    public function actionSetNotifiche() {

        $model = $this->loadModel($_POST['id']);
        $model->setAttribute('q_doc', $_POST['q_doc']);
        $model->setAttribute('q_keluar',$_POST['q_keluar']);
        $model->setAttribute('q_sharing', $_POST['q_sharing']);
        $model->setAttribute('q_senior', $_POST['q_senior']);
        $model->setAttribute('q_junior', $_POST['q_junior']);
        $model->setAttribute('q_formazione',$_POST['q_formazione']);
        $model->setAttribute('q_studio', $_POST['q_studio']);
        $model->setAttribute('q_scientifici', $_POST['q_scientifici']);
        $model->setAttribute('q_campus', $_POST['q_campus']);
        $model->setAttribute('q_vacanza', $_POST['q_vacanza']);
        
        $model->save();
        
        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode(array('text' => "Notifiche inserimento questionari per utente <b>".$model->user."</b> modificate con successo" ));
        Yii::app()->end();
    }
    
    public function actionProfilo() {

        $model = $this->loadModel(Yii::app()->user->getId());
        $model->setSelectValue();

        if (isset($_POST['Utenti'])) {
            $model->attributes = $_POST['Utenti'];

            # GESTIONE ALLEGATO 
            $model->avatar = CUploadedFile::getInstance($model, 'avatar');
            if ($model->avatar && $model->avatar != '') {
                $model->avatar->saveAs(YiiBase::getPathOfAlias('webroot') . '/avatar/' . $model->avatar);
            }
            else
                $model->setAttribute('avatar', $model->getAvatar($model->attributes['id']));

            if ($model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Dati profilo <b>' . $model->nome . ' ' . $model->cognome . '</b> aggiornati con successo');
                $this->redirect(array('profilo'));
            }
        }

        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/psc.js?q=v'.rand(0,1000), CClientScript::POS_END);
        Yii::app()->clientScript->registerCss('cssPwdStrenght', '
            .displayBadge{
                margin-top:5px; 
                text-align:center;
            }
        ');

        $this->render('profilo', array('model' => $model,));
    }
    
    public function actionUtente() {
        $model = new Utenti('search');
        $model->unsetAttributes();  // clear any default values
        $model->id = Yii::app()->user->getId();
        $model->setSelectValue();
        if (isset($_POST['Utenti']))
            $model->attributes = $_POST['Utenti'];

        $this->render('utente', array('model' => $model,));
    }
    
    public function actionEsporta() {
        $model = new Utenti;
        $model->datiEsportazione = $model->getEsportazione();
        $this->renderPartial('_esporta', array('model' => $model));
    }

    public function actionView($id) {
        $this->render('view', array('model' => $this->loadModel($id),));
    }

    public function actionCreate()
    {
        $this->authorize('Utenti', 'create');

        $model = new Utenti;
        $model->scenario = 'create';
        $model->setSelectValue();
        $model->strutture = $model->getStrutture() ; 
        $tagOptions = UtentiTag::getOptions();

        if (isset($_POST['Utenti'])) {

            $model->attributes = $_POST['Utenti'];
            $model->selectedTags = isset($_POST['Utenti']['selectedTags']) ? $_POST['Utenti']['selectedTags'] : array();

            # GESTIONE ALLEGATO 
            $model->avatar = CUploadedFile::getInstance($model, 'avatar');

            if ($model->avatar && $model->avatar != '') {
                $model->avatar->saveAs(YiiBase::getPathOfAlias('webroot') . '/avatar/' . $model->avatar);
            }

            if ($model->save()) {
                $model->syncTags($model->selectedTags);

                //mando email con link per attivazione account e cambio password
                $mail = new YiiMailer('activation_account', array('model' => $model));
                //$mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER;
                $mail->setTo($model->email);
                $mail->setFrom('gest.qualita@cooperativadoc.it', 'Qualità Cooperativa DOC');
                $mail->setSubject('Attivazione account piattaforma Qualità');
                $mail->setLayout('mail');
                
                $smtp = Yii::app()->params['SMTP'];
                $mail->setSmtp($smtp['host'], $smtp['port'], $smtp['secure'], $smtp['auth'], $smtp['username'], $smtp['password']);
                
                if(!$mail->send()) {
                    Yii::app()->user->setFlash('error','Error while sending email: '.$mail->getError());
                    //Yii::app()->user->setFlash('opResultKO', 'Nuovo utente <b>' . $model->nome . " " . $model->cognome . "</b> creato con successo, email non inviata");
                }

                Yii::app()->user->setFlash('opResultOK', 'Nuovo utente <b>' . $model->nome . " " . $model->cognome . "</b> creato con successo");
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array('model' => $model, 'tagOptions' => $tagOptions));
    }

    public function actionUpdate($id)
    {
        $this->authorize('Utenti', 'update');

        $model = $this->loadModel($id);
        $model->scenario = 'update';
        $model->setSelectValue(); 
        $model->strutture = $model->getStrutture() ; 
        $tagOptions = UtentiTag::getOptions();
        
        if (isset($_POST['Utenti'])) {
            $model->attributes = $_POST['Utenti'];
            $model->selectedTags = isset($_POST['Utenti']['selectedTags']) ? $_POST['Utenti']['selectedTags'] : array();

            # GESTIONE ALLEGATO 
            $model->avatar = CUploadedFile::getInstance($model, 'avatar');
            if ($model->avatar && $model->avatar != '') {
                $model->avatar->saveAs(YiiBase::getPathOfAlias('webroot') . '/avatar/' . $model->avatar);
            }
            else {
                $model->setAttribute('avatar', $model->getAvatar($model->attributes['id']));
            }

            if ($model->save()) {
                $model->syncTags($model->selectedTags);
                Yii::app()->user->setFlash('opResultOK', 'Utente <b>' . $model->nome . ' ' . $model->cognome . '</b> aggiornato con successo');
                $this->redirect(array('admin'));
            }
        }

        Yii::app()->clientScript->registerScript('script', "
			$(document).ready(function() {
                console.log('load');
                showAbilitiesApp();

                $('#Utenti_user_type').on('change', function(e) {
                    e.preventDefault();

                    let role = $(this).val();

                    if(role == 12) {
                        $('.abilities-app').show();
                    }
                    else {
                        $('.abilities-app').hide();
                    }
                });
			});

            function showAbilitiesApp() {
                let role = $('#Utenti_user_type').val();

                console.log(role);

                if(role == '12') {
                    $('.abilities-app').show();
                }
                else {
                    $('.abilities-app').hide();
                }
            }
			", CClientScript::POS_END
		);


        $this->render('update', array('model' => $model, 'tagOptions' => $tagOptions));
    }

    public function actionDelete($id)
    {
        $this->authorize('Utenti', 'delete');

        $model = $this->loadModel($id);
        $model->delete();
        Yii::app()->user->setFlash('opResultOK', 'Utente <b>' . $model->nome . ' ' . $model->cognome . '</b> rimosso con successo');
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionAdmin()
    {
        $this->authorize('Utenti', 'admin');

        $model = new Utenti('search');

        $model->unsetAttributes();  // clear any default values

        $model->setSelectValue();

        if (isset($_POST['Utenti']))
            $model->attributes = $_POST['Utenti'];

        $this->render('admin', array('model' => $model,));
    }

    public function actionAjaxTagLookup()
    {
        $term = isset($_POST['term']) ? trim($_POST['term']) : '';
        $response = array('results' => array());

        if (mb_strlen($term) >= 3) {
            $criteria = new CDbCriteria();
            $criteria->select = 't.id, t.nome, t.cognome, t.user, t.email';
            $criteria->condition = 't.nome LIKE :term OR t.cognome LIKE :term OR t.user LIKE :term OR t.email LIKE :term';
            $criteria->params = array(':term' => '%' . $term . '%');
            $criteria->order = 't.cognome ASC, t.nome ASC';
            $criteria->limit = 30;

            $utenti = Utenti::model()->findAll($criteria);
            foreach ($utenti as $utente) {
                $response['results'][] = array(
                    'id' => (int)$utente->id,
                    'label' => $utente->cognome . ' ' . $utente->nome . ' (' . $utente->user . ')',
                    'email' => $utente->email,
                );
            }
        }

        header('Content-Type: application/json; charset="UTF-8"');
        echo CJSON::encode($response);
        Yii::app()->end();
    }

    public function actionChangepassword()
    {
        $model = $this->loadModel(Yii::app()->user->id);
        
        if(isset($_POST['Utenti'])) {
            $model->scenario = 'change';

            $model->attributes = $_POST['Utenti'];

            if($model->validate() && $model->save()) {
                Yii::app()->user->setFlash('opResultOK', 'Password modificata con successo');
                $this->redirect(array('profilo'));
            }
        }

        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/psc.js?q=v'.rand(0,1000), CClientScript::POS_END);
        Yii::app()->clientScript->registerCss('cssPwdStrenght', '
            .displayBadge{
                margin-top:5px; 
                text-align:center;
            }
        ');

        $this->render('profilo', array('model' => $model, 'formhtml' => 'changepassword'));
    }

    public function loadModel($id)
    {
        $model = Utenti::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'La pagina richiesta non esiste');
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'utenti-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
