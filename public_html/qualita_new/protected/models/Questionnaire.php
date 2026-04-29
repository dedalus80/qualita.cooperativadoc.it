<?php
class Questionnaire extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'questionnaires';
    }

    public function rules()
    {
        return array(
            array('title, slug', 'required'),
            array('client_id', 'numerical', 'integerOnly'=>true, 'allowEmpty'=>true),
            array('is_public', 'boolean'),
            array('email_notification', 'email'),
            array('email_contact', 'email'),
            array('description, link_privacy, footer_description, logo, email_notification', 'safe'),
            array('questionnaire_type', 'in', 'range'=>array('SP', 'SG', 'Q', 'A', 'F')),
            array('title', 'unique'),
            array('slug', 'unique'),
            array('slug', 'match', 'pattern' => '/^[a-z0-9-]+$/', 'message' => 'Lo slug può contenere solo lettere minuscole, numeri e trattini.'),
        );
    }

    public function relations()
    {
        return array(
            'client' => array(self::BELONGS_TO, 'Clienti', 'client_id'),
            'versions' => array(self::HAS_MANY, 'QuestionnaireVersion', 'questionnaire_id'),
            'participants' => array(self::HAS_MANY, 'QuestionnaireParticipant', 'questionnaire_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Titolo',
            'description' => 'Descrizione',
            'client_id' => 'Cliente',
            'is_public' => 'Pubblico',
            'questionnaire_type' => 'Tipo Questionario',
            'slug' => 'Slug URL univoco',
            'logo' => 'Logo',
            'link_privacy' => 'Link Privacy Policy',
            'footer_description' => 'Descrizione Footer',
            'email_notification' => 'Email di notifica',
            'email_contact' => 'Email di contatto',
            'created_at' => 'Creato il',
            'updated_at' => 'Aggiornato il',
        );
    }

    public function scopes()
    {
        return array(
            'public' => array('condition'=>'is_public=1'),
            'private' => array('condition'=>'is_public=0 AND client_id IS NOT NULL'),
        );
    }

    public function beforeValidate()
    {
        // Validazione del file upload se presente
        $uploadedFile = CUploadedFile::getInstance($this, 'logo');
        if ($uploadedFile) {
            // Controlla il tipo di file
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
            $fileExtension = strtolower($uploadedFile->getExtensionName());
            if (!in_array($fileExtension, $allowedTypes)) {
                $this->addError('logo', 'Il file deve essere di tipo: ' . implode(', ', $allowedTypes));
                return false;
            }
            
            // Controlla la dimensione del file (max 1MB)
            if ($uploadedFile->getSize() > 1024 * 1024) {
                $this->addError('logo', 'Il file deve essere inferiore a 1MB');
                return false;
            }
        }
        
        return parent::beforeValidate();
    }

    public function afterValidate()
    {
        // Automatically set created_at and updated_at timestamps
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s');
        }
        $this->updated_at = date('Y-m-d H:i:s');
        
        return parent::afterValidate();
    }

    public function getActiveVersion()
    {
        return QuestionnaireVersion::model()->findByAttributes([
            'questionnaire_id' => $this->id,
            'is_active' => 1,
        ]);
    }

    /**
     * Get the logo URL if exists, otherwise return default logo
     */
    public function getLogoUrl()
    {
        if (!empty($this->logo)) {
            return Yii::app()->request->baseUrl . '/uploads/questionnaire_logos/' . $this->logo;
        }
        return Yii::app()->request->baseUrl . '/images/survey/keluar_logo_21.png';
    }

    /**
     * Get privacy link if exists, otherwise return default
     */
    public function getPrivacyLink()
    {
        if (!empty($this->link_privacy)) {
            return $this->link_privacy;
        }
        return 'https://keluar.it/site/privacy/';
    }

    /**
     * Get footer description if exists, otherwise return empty
     */
    public function getFooterDescription()
    {
        return $this->footer_description;
    }

}
