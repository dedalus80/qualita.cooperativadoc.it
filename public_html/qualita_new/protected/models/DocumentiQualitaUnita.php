<?php

/**
 * This is the model class for table "doc_documenti_qualita_unita".
 *
 * The followings are the available columns in table 'doc_documenti_qualita_unita':
 * @property integer $id
 * @property integer $documenti_id
 * @property integer $unita_id
 *
 * The followings are the available model relations:
 * @property DocumentiQualita $documenti
 * @property Unita $unita
 */
class DocumentiQualitaUnita extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentiQualitaUnita the static model class
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
		return 'doc_documenti_qualita_unita';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('documenti_id, unita_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, documenti_id, unita_id', 'safe', 'on'=>'search'),
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
			'documenti' => array(self::BELONGS_TO, 'DocumentiQualita', 'documenti_id'),
			'unita' => array(self::BELONGS_TO, 'Unita', 'unita_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'documenti_id' => 'Documenti',
			'unita_id' => 'Unita',
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
		$criteria->compare('documenti_id',$this->documenti_id);
		$criteria->compare('unita_id',$this->unita_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}