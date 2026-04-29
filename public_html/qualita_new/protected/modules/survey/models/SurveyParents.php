<?php

/**
 * This is the model class for table "survey_parents".
 *
 * The followings are the available columns in table 'survey_parents':
 * @property integer $id
 * @property string $type_stay
 * @property string $nome
 * @property string $cognome
 * @property integer $organizzatore
 * @property integer $soggiorno
 * @property integer $turno
 * @property string $nome_coordinatore
 * @property string $cognome_coordinatore
 * @property integer $eta
 * @property string $nome_gruppo
 * @property string $assistenza
 * @property string $informazioni
 * @property string $trasferimenti
 * @property string $complessivo
 * @property string $organizzazione
 * @property string $attivita
 * @property string $esperienza
 * @property string $cura
 * @property string $communicazione
 * @property string $suggerimenti
 * @property string $data_restituzione
 * @property integer $anno
 * @property string $email_genitore
 */
class SurveyParents extends CActiveRecord
{
	public $privacy;

	public $typeStay = [
		'JUN' => 'JUNIOR',
		'SEN' => 'SENIOR',
		'STU' => 'VACANZE INGLESE',
		'SCI' => 'CAMPUS SCIENTIFICI',
		'SPO' => 'CAMPUS SPORTIVI'
	];

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'survey_parents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, cognome, organizzatore, soggiorno, turno, nome_coordinatore, cognome_coordinatore, eta, email_genitore, type_stay', 'required'),
			array('assistenza, informazioni, trasferimenti, complessivo, organizzazione, attivita, esperienza, cura, communicazione, privacy', 'required', 'message' => 'Questo campo è obbligatorio.'),
			array('organizzatore, soggiorno, turno, eta, anno', 'numerical', 'integerOnly'=>true),
			array('type_stay', 'length', 'max'=>3),
			array('nome, cognome, nome_coordinatore, cognome_coordinatore, nome_gruppo, email_genitore', 'length', 'max'=>50),
			array('assistenza, informazioni, trasferimenti, complessivo, organizzazione, attivita, esperienza, cura, communicazione', 'length', 'max'=>1),
			array('suggerimenti', 'filter', 'filter' => 'strip_tags'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type_stay, nome, cognome, organizzatore, soggiorno, turno, nome_coordinatore, cognome_coordinatore, eta, nome_gruppo, assistenza, informazioni, trasferimenti, complessivo, organizzazione, attivita, esperienza, cura, communicazione, suggerimenti, data_restituzione, anno, email_genitore', 'safe', 'on'=>'search'),
			array('privacy', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                   => 'ID',
			'type_stay'            => Yii::t('survey', 'type_stay'),
			'nome'                 => Yii::t('survey', 'participant_name'),// 'Nome',
			'cognome'              => Yii::t('survey', 'participant_surname'), //'Cognome',
			'organizzatore'        => Yii::t('survey','company'),
			'soggiorno'            => Yii::t('survey', 'stay'),
			'turno'                => Yii::t('survey', 'shift'),
			'nome_coordinatore'    => Yii::t('survey', 'coordinator_name'),
			'cognome_coordinatore' => Yii::t('survey', 'coordinator_surname'),
			'eta'                  => Yii::t('survey', 'participant_age'),
			'nome_gruppo'          => 'Nome Gruppo',
			'assistenza'           => Yii::t('survey', 'assistance'),
			'informazioni'         => Yii::t('survey', 'information'),
			'trasferimenti'        => Yii::t('survey', 'transfers'),
			'complessivo'          => Yii::t('survey', 'overall'),
			'organizzazione'       => Yii::t('survey', 'company'),
			'attivita'             => Yii::t('survey', 'activity'),
			'esperienza'           => Yii::t('survey', 'experience'),
			'cura'                 => Yii::t('survey', 'care'),
			'communicazione'       => Yii::t('survey', 'communication'),
			'suggerimenti'         => Yii::t('survey', 'suggestion'),
			'data_restituzione'    => 'Data Restituzione',
			'anno'                 => 'Anno',
			'email_genitore'       => Yii::t('survey', 'parent_email'),
			'privacy'              => Yii::t('survey', 'privacy'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('type_stay',$this->type_stay,true);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('cognome',$this->cognome,true);
		$criteria->compare('organizzatore',$this->organizzatore);
		//$criteria->compare('soggiorno',$this->soggiorno);
		$criteria->compare('turno',$this->turno);
		$criteria->compare('nome_coordinatore',$this->nome_coordinatore,true);
		$criteria->compare('cognome_coordinatore',$this->cognome_coordinatore,true);
		$criteria->compare('eta',$this->eta);
		$criteria->compare('nome_gruppo',$this->nome_gruppo,true);
		$criteria->compare('assistenza',$this->assistenza,true);
		$criteria->compare('informazioni',$this->informazioni,true);
		$criteria->compare('trasferimenti',$this->trasferimenti,true);
		$criteria->compare('complessivo',$this->complessivo,true);
		$criteria->compare('organizzazione',$this->organizzazione,true);
		$criteria->compare('attivita',$this->attivita,true);
		$criteria->compare('esperienza',$this->esperienza,true);
		$criteria->compare('cura',$this->cura,true);
		$criteria->compare('communicazione',$this->communicazione,true);
		$criteria->compare('suggerimenti',$this->suggerimenti,true);
		$criteria->compare('data_restituzione',$this->data_restituzione,true);
		$criteria->compare('anno',$this->anno);
		$criteria->compare('email_genitore',$this->email_genitore,true);

		$user = Yii::app()->MyUtils->getUserInfo();
        $user['user_unita'] ? $criteria->addInCondition('soggiorno', explode(',',$user['user_unita'])) : $criteria->compare('soggiorno', $this->soggiorno) ;

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SurveyParents the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getParticipantAges()
	{	
		$age = [];

		for($i=5;$i<18;$i++) {
			$age[$i] = $i;
		}

		return $age;
	}

	public function afterValidate()
	{
		$this->anno = date('Y');
		$this->data_restituzione = new CDbExpression('NOW()');

		return parent::afterValidate();
	}
}
