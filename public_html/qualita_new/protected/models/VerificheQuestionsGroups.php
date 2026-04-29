<?php

/**
 * This is the model class for table "doc_verifiche_questions_groups".
 *
 * The followings are the available columns in table 'doc_verifiche_questions_groups':
 * @property integer $id
 * @property integer $tipologiaVerificaId
 * @property string $name
 * @property integer $rank
 *
 * The followings are the available model relations:
 * @property VerificheQuestions[] $verificheQuestions
 * @property TipologieVerifiche $tipologiaVerifica
 */
class VerificheQuestionsGroups extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VerificheQuestionsGroups the static model class
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
		return 'doc_verifiche_questions_groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipologiaVerificaId, name, rank', 'required'),
			array('tipologiaVerificaId, rank', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tipologiaVerificaId, name, rank', 'safe', 'on'=>'search'),
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
			'verificheQuestions' => array(self::HAS_MANY, 'VerificheQuestions', 'groupId', 'order'=>'ordine ASC', 'with'=>'verificheAnswers'),
			'groupQuestions' => array(self::HAS_MANY, 'VerificheQuestions', 'groupId', 'order'=>'ordine ASC'),
			'tipologiaVerifica' => array(self::BELONGS_TO, 'TipologieVerifiche', 'tipologiaVerificaId'),
			//'answers' => array(self::HAS_ONE, 'VerificheAnswers', array('id'=>'questionId'),'through'=>'verificheQuestions')
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
			'name' => 'Nome gruppo',
			'rank' => 'Ordine',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('rank',$this->rank);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}