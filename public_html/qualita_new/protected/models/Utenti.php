<?php

class Utenti extends CActiveRecord {

    var $selectUnita      = array();
    var $selectTipi       = array();
    var $datiEsportazione = array();
    var $strutture        = array();

    var $newPassword;
    var $repeatPassword;
    public $selectedTags = array();

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'utenti';
    }

    public function rules() {

        return array(
            array('user, email, user_type, nome, cognome', 'required', 'message' => 'Il campo {attribute} è obbligatorio'),
            //array('password', 'length', 'min'=>8, 'message' => 'Il campo {attribute} deve avere almeno 8 caratteri', 'on' => 'create'),
            //array('password', 'length', 'min'=>8, 'allowEmpty' => true, 'message' => 'Il campo {attribute} deve avere almeno 8 caratteri', 'on' => 'update'),
            //array('password', 'checkStrength'),
            array('user_type', 'numerical', 'integerOnly' => true),
            array('user', 'length', 'max' => 60),
            array('preiscrizione_sn , preiscrizione_fo , preiscrizione_sp, preiscrizione_cs, preiscrizione_sh, preiscrizione_cm', 'length', 'max' => 1),
            array('q_keluar , q_doc, q_campus,q_sharing, q_junior, q_senior, q_scientifici, q_studio ,q_formazione, q_vacanza, documenti_qualita, documenti_soggiorni, area_documenti, is_maintenance_lead', 'length', 'max' => 1),
            array('email, password', 'length', 'max' => 60),
            array('avatar', 'length', 'max' => 50),
            array('selectedTags', 'safe'),
            array('id, user, email, password, user_type , user_unita', 'safe', 'on' => 'search'),
            array('user_unita','length','max'=>50),
            array('newPassword, repeatPassword', 'safe'),
            array('newPassword, repeatPassword', 'required', 'message' => 'Il campo {attribute} è obbligatorio', 'on' => 'activation, expired, change'),
            array('newPassword', 'length', 'min'=>8, 'tooShort' => 'La password deve avere almeno 8 caratteri', 'on' => 'activation, expired, change'),
            array('repeatPassword', 'compare', 'compareAttribute'=>'newPassword', 'message' => 'Le passwords non coincidono', 'on'=>'activation, expired, change'),
            array('newPassword', 'checkStrength', 'on' => 'activation, expired, change'),
            array('password, password_hash, activation_token, created_at, updated_at', 'unsafe'),
        );
    }

    public function checkStrength($attr)
    {
        if($this->$attr) {
            $policy1 = preg_match('/[A-Z]/', $this->$attr) ? 1 : 0 ;
            $policy2 = preg_match('/[a-z]/', $this->$attr) ? 1 : 0 ;
            $policy3 = preg_match('/[0-9]/', $this->$attr) ? 1 : 0 ;
            $policy4 = preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:\<\>,\.\?]/', $this->$attr) ? 1 : 0 ;

            if(!$policy1)
                $this->addError('newPassword', 'La password deve contenere almeno un carattere maiuscolo.');

            if(!$policy2)
                $this->addError('newPassword', 'La password deve contenere almeno un carattere minuscolo.');

            if(!$policy3)
                $this->addError('newPassword', 'La password deve contenere almeno un numero.');

            if(!$policy4)
                $this->addError('newPassword', 'La password deve contenere almeno un carattere speciale (/~`!@#$%^&*()_-+={}[]|;:<>,.?)');
        }
    }

    public function relations() {
        return array(
            'tags' => array(self::MANY_MANY, 'UtentiTag', 'utenti_tags_assoc(utente_id,tag_id)'),
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user' => 'Username',
            'email' => 'Email',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'password' => 'Password',
            'newPassword' => 'Nuova Password',
            'repeatPassword' => 'Ripeti Password',
            'user_type' => 'Tipo utente',
            'user_unita' => 'Struttura ',
            'avatar' => 'Avatar',
            'preiscrizione_sn' => 'Scuola natura',
            'preiscrizione_sp' => 'Stesso piano',
            'preiscrizione_cs' => 'Campus San Paolo',
            'preiscrizione_sh' => 'Sharing',
            'preiscrizione_cm' => 'Comune Milano',
            'preiscrizione_fo' => 'Cascina Fossata',
            'q_junior' => 'Questionario Junior',
            'q_senior' => 'Questionario senior',
            'q_doc' => 'Questionario Doc',
            'q_campus' => 'Questionario Campus San Paolo',   
            'q_studio' => 'Questionario V. Studio',
            'q_scientifici' => 'Questionario Scientifici',
            'q_keluar' => 'Questionario Keluar',
            'q_sharing' => 'Questionario Sharing',
            'q_formazione' => 'Questionario formazione',
            'q_vacanza' => 'Questionario Una vacanza',
            'documenti_qualita' => 'Documenti Qualità',
            'documenti_soggiorni' => 'Documenti Soggiorni',
            'area_documenti' => 'Area Documenti',
            'is_maintenance_lead' => 'Capo Manutentore',
            'selectedTags' => 'Tag utente',
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->order = ' cognome ASC';
        $criteria->compare('id', $this->id);
        $criteria->compare('user', $this->user, true);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cognome', $this->cognome, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('user_type', $this->user_type);
        $criteria->compare('user_unita', $this->user_unita);
        $criteria->compare('avatar', $this->avatar);
        $criteria->compare('preiscrizione_sn', $this->preiscrizione_sn);
        $criteria->compare('preiscrizione_sp', $this->preiscrizione_sp);
        $criteria->compare('preiscrizione_cs', $this->preiscrizione_cs);
        $criteria->compare('preiscrizione_sh', $this->preiscrizione_sh);
        $criteria->compare('preiscrizione_cm', $this->preiscrizione_cm);
        $criteria->compare('preiscrizione_fo', $this->preiscrizione_fo);
        $criteria->compare('q_junior', $this->q_junior);
        $criteria->compare('q_senior', $this->q_senior);
        $criteria->compare('q_doc', $this->q_doc);
        $criteria->compare('q_campus', $this->q_campus);
        $criteria->compare('q_studio', $this->q_studio);
        $criteria->compare('q_scientifici', $this->q_scientifici);
        $criteria->compare('q_keluar', $this->q_keluar);
        $criteria->compare('q_sharing', $this->q_sharing);
        $criteria->compare('q_formazione', $this->q_formazione);
        $criteria->compare('q_vacanza', $this->q_vacanza);
        $criteria->compare('documenti_qualita', $this->documenti_qualita);
        $criteria->compare('documenti_soggiorni', $this->documenti_soggiorni);
        $criteria->compare('area_documenti', $this->area_documenti);
        $criteria->compare('is_maintenance_lead', $this->is_maintenance_lead);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));
    }
	
	public function getDettaglio($data , $t){
	
		$tmp  = "<span class='bold'></span> ".$data->nome." ".$data->cognome."<br />";
		$tmp  .= "<span class='bold'>Nome Utente:</span> ".$data->user." <br />";
		$tmp .= "<span class='bold'>Ruolo:</span> ".Yii::app()->MyUtils->getSelectValue($data->user_type, "utenti_tipi")." <br />";
		$tmp .= "<span class='bold'>Struttura:</span> ".Yii::app()->MyUtils->getSelectValue($data->user_unita, "doc_unita");
		
		return $tmp;
	}
	
    public function getUserType($data, $t) {
        return Yii::app()->MyUtils->getSelectValue($data->user_type, "utenti_tipi");
    }

    public function getStruttura($data, $t) {
        
        $strutture = '';
        
        if($data->user_unita){
            $tmp = explode(",",$data->user_unita);
            if(count($tmp)){
                foreach($tmp AS $id )
                  $strutture .="<div>".Yii::app()->MyUtils->getSelectValue($id, "doc_unita")."</div>";
            }
        }
        return $strutture ;
    }

    public function getAvatar($id) {
        return Yii::app()->db->createCommand("SELECT avatar FROM utenti WHERE id='" . $id . "'")->queryScalar();
    }

    public function setSelectValue() {
        $this->selectUnita = Yii::app()->MyUtils->getSelect('doc_unita');
        
        $tipi = Yii::app()->MyUtils->getSelect('utenti_tipi');
        unset($tipi['9']);
        $this->selectTipi = $tipi;

        if (!$this->isNewRecord) {
            $this->selectedTags = $this->getSelectedTagIds();
        }
    }

    public function getSelectedTagIds()
    {
        $ids = array();

        if (!empty($this->tags)) {
            foreach ($this->tags as $tag) {
                $ids[] = (int)$tag->id;
            }
        }

        return $ids;
    }

    public function syncTags($tagIds)
    {
        $cleanIds = array();

        if (is_array($tagIds)) {
            foreach ($tagIds as $tagId) {
                $tagId = (int)$tagId;
                if ($tagId > 0) {
                    $cleanIds[] = $tagId;
                }
            }
        }

        $cleanIds = array_values(array_unique($cleanIds));

        Yii::app()->db->createCommand()->delete('utenti_tags_assoc', 'utente_id=:utente_id', array(':utente_id' => (int)$this->id));

        foreach ($cleanIds as $tagId) {
            Yii::app()->db->createCommand()->insert('utenti_tags_assoc', array(
                'utente_id' => (int)$this->id,
                'tag_id' => (int)$tagId,
            ));
        }
    }

    public function getTagsList($data, $t)
    {
        if (empty($data->tags)) {
            return '<span class="label label-primary tag-label-inline tag-label-soft">Nessun tag</span>';
        }

        $html = '';
        foreach ($data->tags as $tag) {
            $html .= '<span class="label label-primary tag-label-inline tag-label-primary">' . CHtml::encode($tag->nome) . '</span>';
        }

        return $html;
    }

    public function getEsportazione() {

        $query = "SELECT u.* , t.nome as tipo , s.nome as struttura FROM utenti AS u 
                    LEFT JOIN utenti_tipi as t ON u.user_type = t.id 
                    LEFT JOIN doc_unita as s ON u.user_unita = s.id ";

        return Yii::app()->db->createCommand($query)->queryAll();
    }
    
    public function getStrutture() {
        $tmp = '';

        if ($this->user_unita ) {
            $strutture = Yii::app()->db->createCommand("SELECT id , nome FROM doc_unita WHERE id IN (" . rtrim($this->user_unita,',') . ")  ")->queryAll();
            if (count($strutture)) {
                for ($x = 0; $x < count($strutture); $x++) {
                    $tmp .= '<span class="token" id="ctoken-' . $strutture[$x]['id'] . '" ><span class="token-label" >' . $strutture[$x]['nome'] . '</span><a href="#" data-refer="' . $strutture[$x]['id'] . '" class="close-token" tabindex="-1">×</a></span>';
                }
            }
        }

        return $tmp;
    }

    public function afterValidate()
    {
        if($this->isNewRecord) {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_$@%()[]?-=.,:&!';
            $password = substr(str_shuffle($permitted_chars), 0, 8);

            $salt = '$6$'.base64_encode(openssl_random_pseudo_bytes(32));
            $password_hash = crypt($password, $salt);

            $this->password_hash = $password_hash;
            $this->password = $password;
            $this->activation_token = UUID::generate();
            $this->created_at = date('Y-m-d H:i:s');
        }
        
        if($this->scenario == 'activation') {
            $this->is_active = 'Y';
            $this->password_expired_at = (new \DateTime('now +120 day'))->format('Y-m-d');
            $this->password = $this->newPassword;

            $salt = '$6$'.base64_encode(openssl_random_pseudo_bytes(32));
            $password_hash = crypt($this->newPassword, $salt);
            $this->password_hash = $password_hash;
        }

        if($this->scenario == 'expired' || $this->scenario == 'change') {
            $expiredPassword = new \DateTime('now +120 day');

            $this->password_expired_at = $expiredPassword->format('Y-m-d');
            $this->password = $this->newPassword;

            $salt = '$6$'.base64_encode(openssl_random_pseudo_bytes(32));
            $password_hash = crypt($this->newPassword, $salt);
            $this->password_hash = $password_hash;

            Yii::app()->user->setState('expiredPassword', $expiredPassword->getTimestamp());
        }

        if($this->user_type != '12') {
            $this->is_maintenance_lead = 'N';
        }

        $this->updated_at = date('Y-m-d H:i:s');

        return parent::afterValidate();
    }

    public function afterSave()
    {
        if($this->scenario == 'change') {
            UtentiRequestResetPassword::model()->deleteAllByAttributes(['user_id' => $this->id]);
        }

        return parent::afterSave();
    }

    public function getDisplayName()
    {
        return $this->nome." ".$this->cognome;
    }
}
