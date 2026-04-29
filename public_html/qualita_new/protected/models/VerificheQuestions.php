<?php

/**
 * This is the model class for table "doc_verifiche_questions".
 *
 * The followings are the available columns in table 'doc_verifiche_questions':
 * @property integer $id
 * @property integer $tipologiaVerificaId
 * @property integer $groupId
 * @property string $question
 * @property string $type
 * @property integer $ordine
 *
 * The followings are the available model relations:
 * @property VerificheAnswers[] $verificheAnswers
 * @property TipologieVerifiche $tipologiaVerifica
 * @property VerificheQuestionsGroups $group
 */
class VerificheQuestions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VerificheQuestions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'doc_verifiche_questions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('groupId, question', 'required'),
			array('tipologiaVerificaId, groupId, ordine', 'numerical', 'integerOnly'=>true),
			array('question', 'length', 'max'=>255),
			array('type', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tipologiaVerificaId, groupId, question, type, ordine', 'safe', 'on'=>'search'),
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
			'verificheAnswers' => array(self::HAS_MANY, 'VerificheAnswers', 'questionId'),
			'tipologiaVerifica' => array(self::BELONGS_TO, 'TipologieVerifiche', 'tipologiaVerificaId'),
			'group' => array(self::BELONGS_TO, 'VerificheQuestionsGroups', 'groupId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tipologiaVerificaId' => 'Tipologia Verifica',
			'groupId' => 'Group',
			'question' => 'Question',
			'type' => 'Type',
			'ordine' => 'Ordine',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('tipologiaVerificaId',$this->tipologiaVerificaId);
		$criteria->compare('groupId',$this->groupId);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('ordine',$this->ordine);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}