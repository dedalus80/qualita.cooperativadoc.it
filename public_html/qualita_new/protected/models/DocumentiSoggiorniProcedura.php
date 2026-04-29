<?php

/**
 * This is the model class for table "doc_documenti_soggiorni_procedura".
 *
 * The followings are the available columns in table 'doc_documenti_soggiorni_procedura':
 * @property integer $id
 * @property string $procedura
 *
 * The followings are the available model relations:
 * @property DocumentiSoggiorni[] $documentiSoggiornis
 */
class DocumentiSoggiorniProcedura extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentiSoggiorniProcedura the static model class
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
		return 'doc_documenti_soggiorni_procedura';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('procedura', 'required'),
			array('procedura', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, procedura', 'safe', 'on'=>'search'),
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
			'documentiSoggiornis' => array(self::HAS_MANY, 'DocumentiSoggiorni', 'procedura_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'procedura' => 'Procedura',
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
		$criteria->compare('procedura',$this->procedura,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}