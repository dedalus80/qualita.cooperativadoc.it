<?php

class LoginForm extends CFormModel{
	
    var $maintenance = false;
    public $username;
    public $password;
    public $rememberMe; 
    public $nome;
    public $email;
	private $_identity;

	public function rules()	{
		return array(
			// username and password are required
			array('username, password', 'required','message'=>'Compilare il campo'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	public function attributeLabels()	{       
		return array(
			'rememberMe'=>'Resta connesso',
                        'username'=>"NOME UTENTE",
                        'password'=>"PASSWORD"
                    );
	}

	public function authenticate($attribute,$params)	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password.');
		}
	}

	public function login()	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
                
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
    
    function setUser() {
        $user = Yii::app()->db->createCommand("SELECT * FROM utenti WHERE id='".Yii::app()->user->id."' ")->queryRow();
        return $user;
    }
    
    public function checkUser($dati) {
        
        $dati['stato'] ='KO';
        $dati['testo'] ='Dati inseriti non validi riprovare';
        /*if($dati['email'])
            $AND .= " AND email ='".$dati['email']."' ";
        if($dati['codice'])
            $AND .= " AND user ='".$dati['nome']."' ";
        
        $is = Yii::app()->db->createCommand("SELECT * FROM utenti WHERE 1 ".$AND)->queryRow();
*/
        $user = Utenti::model()->findByAttributes(array('email' => $dati['email']));
        
        // Utente esistente reinoltro la password
        if($user !== null) {
            $dati['stato'] ='OK';
            $dati['testo'] ='E\' stata inviata un email con i dettagli per modificare la password';

            $token = UUID::generate();

            $txt  = "<p>Salve <b>".$user->nome." ".$user->cognome."</b></p>";
            $txt .= "<p>Come richiesto in data ".date("m-d-Y")." qui di seguito trova il link per il reset della password <a href=\"https://qualita.cooperativadoc.it/qualita_new/index.php/account/reset/$token\">Reset password Qualita Cooperativa DOC</a></p>";
            
            $oggetto  = "Reset password piattaforma Qualità - Cooperativa DOC";

            $template = Yii::app()->MyEmails->getTemplate();
            $template = str_replace("[MESSAGGIO]", $txt, $template);
            $template = str_replace("[TITOLO]", $oggetto, $template);
            
            Yii::app()->MyEmails->smtpObject  = $oggetto;
            Yii::app()->MyEmails->smtpText    = $template;
            Yii::app()->MyEmails->smtpDest    = array($user->email => $user->nome." ".$user->cognome);
            Yii::app()->MyEmails->sendSmtp();

            $reset = new UtentiRequestResetPassword();
            $reset->user_id = $user->id;
            $reset->token = $token;
            $reset->expire_date = (new DateTime('now + 3 hours'))->format('Y-m-d H:i:s');
            $reset->save(false);
        }
        
        return $dati;
    }
        
}
