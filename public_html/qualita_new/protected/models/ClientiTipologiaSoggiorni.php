<?php

/**
 * This is the model class for table "doc_clienti_tipologia_soggiorni".
 *
 * The followings are the available columns in table 'doc_clienti_tipologia_soggiorni':
 * @property integer $id
 * @property integer $cliente_id
 * @property integer $tipologia_id
 * @property integer $soggiorno_id
 *
 * The followings are the available model relations:
 * @property DocClienti $cliente
 * @property DocUnita $soggiorno
 * @property DocTipologiaSoggiorni $tipologia
 */
class ClientiTipologiaSoggiorni extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'doc_clienti_tipologia_soggiorni';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cliente_id, tipologia_id, soggiorno_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cliente_id, tipologia_id, soggiorno_id', 'safe', 'on'=>'search'),
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
			'cliente' => array(self::BELONGS_TO, 'Clienti', 'cliente_id'),
			'soggiorno' => array(self::BELONGS_TO, 'Soggiorni', 'soggiorno_id'),
			'tipologia' => array(self::BELONGS_TO, 'TipologiaSoggiorni', 'tipologia_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cliente_id' => 'Cliente',
			'tipologia_id' => 'Tipologia',
			'soggiorno_id' => 'Soggiorno',
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
		$criteria->compare('cliente_id',$this->cliente_id);
		$criteria->compare('tipologia_id',$this->tipologia_id);
		$criteria->compare('soggiorno_id',$this->soggiorno_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ClientiTipologiaSoggiorni the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
