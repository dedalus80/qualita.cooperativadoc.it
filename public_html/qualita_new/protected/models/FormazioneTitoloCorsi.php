<?php

/**
 * This is the model class for table "doc_formazione_titolo_corsi".
 *
 * The followings are the available columns in table 'doc_formazione_titolo_corsi':
 * @property integer $id
 * @property string $titolo_corso
 * @property string $categoria
 * @property string $attivo
 * @property string $insert_date
 */
class FormazioneTitoloCorsi extends CActiveRecord
{
	const CATEGORIA_SOCI = 'SOCI';
	const CATEGORIA_APERTA_TUTTI = 'APERTA A TUTTI';
	const CATEGORIA_ENTRAMBI = 'ENTRAMBI';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FormazioneTitoloCorsi the static model class
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
		return 'doc_formazione_titolo_corsi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titolo_corso, categoria', 'required'),
			array('titolo_corso', 'length', 'max'=>255),
			array('categoria', 'length', 'max'=>20),
			array('categoria', 'in', 'range'=>array_keys(self::getcategoriaOptions())),
			array('titolo_corso, categoria', 'filter', 'filter'=>'trim'),
			array('attivo', 'length', 'max' => 1),
			array('insert_date', 'default', 'value' => new CDbExpression('NOW()')),
			array('insert_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, titolo_corso, categoria, insert_date, attivo', 'safe', 'on'=>'search'),
		);
	}

	public static function getcategoriaOptions()
	{
		return array(
			self::CATEGORIA_SOCI => self::CATEGORIA_SOCI,
			self::CATEGORIA_APERTA_TUTTI => self::CATEGORIA_APERTA_TUTTI,
			self::CATEGORIA_ENTRAMBI => self::CATEGORIA_ENTRAMBI,
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
			'id' => 'ID',
			'titolo_corso' => 'Titolo Corso',
			'categoria'  => 'Categoria',
			'insert_date'  => 'Data',
			'attivo'       => 'Attivo', 
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
		$criteria->compare('titolo_corso',$this->titolo_corso,true);
		$criteria->compare('categoria',$this->categoria,true);
		$criteria->compare('insert_date',$this->insert_date,true);
		$criteria->compare('attivo',$this->attivo,true);

		//ordine per titolo_corso, attivo = Y
		$criteria->order = 'attivo ASC, titolo_corso ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getAttivo($data) {
        $check ='';
        if($data->attivo=='Y')
            $check = "<i class='fa fa-check green alert-success' data-toggle ='tooltip' title='Abilitato' ></i>" ;
        else
			$check = "<i class='fa fa-times red alert-danger' data-toggle ='tooltip' title='Disabilitato' ></i>" ;
		return $check;
    }
}
