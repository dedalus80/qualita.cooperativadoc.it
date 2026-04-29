<?php

/**
 * This is the model class for table "doc_unita".
 *
 * The followings are the available columns in table 'doc_unita':
 * @property integer $id
 * @property string $nome
 * @property string $codice
 * @property integer $superficie
 * @property integer $tipologia
 * @property integer $centro
 * @property integer $ente
 * @property integer $colore
 * @property string $qdoc
 * @property string $qkeluar
 * @property string $qsharing
 * @property string $qcampus
 * @property string $qsenior
 * @property string $qjunior
 * @property string $qscientifici
 * @property string $qstudio
 * @property string $qsport
 * @property string $qformazione
 * @property string $qsmog
 * @property string $soloq
 *
 * The followings are the available model relations:
 * @property DocClientiTipologiaSoggiorni[] $docClientiTipologiaSoggiornis
 * @property DocDocumentiQualitaUnita[] $docDocumentiQualitaUnitas
 * @property DocDocumentiSoggiorniUnita[] $docDocumentiSoggiorniUnitas
 */
class Soggiorni extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'doc_unita';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, codice, tipologia, centro, colore', 'required'),
			array('superficie, tipologia, centro, ente, colore', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>50),
			array('codice', 'length', 'max'=>4),
			array('qdoc, qkeluar, qsharing, qcampus, qsenior, qjunior, qscientifici, qstudio, qsport, qformazione, qsmog, soloq', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nome, codice, superficie, tipologia, centro, ente, colore, qdoc, qkeluar, qsharing, qcampus, qsenior, qjunior, qscientifici, qstudio, qsport, qformazione, qsmog, soloq', 'safe', 'on'=>'search'),
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
			'soggiorni' => array(self::HAS_MANY, 'ClientiTipologiaSoggiorni', 'soggiorno_id'),
			//'documentiQualitaUnitas' => array(self::HAS_MANY, 'DocumentiQualitaUnita', 'unita_id'),
			//'documentiSoggiorniUnitas' => array(self::HAS_MANY, 'DocumentiSoggiorniUnita', 'unita_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nome' => 'Nome',
			'codice' => 'Codice',
			'superficie' => 'Superficie',
			'tipologia' => 'Tipologia',
			'centro' => 'Centro',
			'ente' => 'Ente',
			'colore' => 'Colore',
			'qdoc' => 'Qdoc',
			'qkeluar' => 'Qkeluar',
			'qsharing' => 'Qsharing',
			'qcampus' => 'Qcampus',
			'qsenior' => 'Qsenior',
			'qjunior' => 'Qjunior',
			'qscientifici' => 'Qscientifici',
			'qstudio' => 'Qstudio',
			'qsport' => 'Qsport',
			'qformazione' => 'Qformazione',
			'qsmog' => 'Qsmog',
			'soloq' => 'Soloq',
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
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('codice',$this->codice,true);
		$criteria->compare('superficie',$this->superficie);
		$criteria->compare('tipologia',$this->tipologia);
		$criteria->compare('centro',$this->centro);
		$criteria->compare('ente',$this->ente);
		$criteria->compare('colore',$this->colore);
		$criteria->compare('qdoc',$this->qdoc,true);
		$criteria->compare('qkeluar',$this->qkeluar,true);
		$criteria->compare('qsharing',$this->qsharing,true);
		$criteria->compare('qcampus',$this->qcampus,true);
		$criteria->compare('qsenior',$this->qsenior,true);
		$criteria->compare('qjunior',$this->qjunior,true);
		$criteria->compare('qscientifici',$this->qscientifici,true);
		$criteria->compare('qstudio',$this->qstudio,true);
		$criteria->compare('qsport',$this->qsport,true);
		$criteria->compare('qformazione',$this->qformazione,true);
		$criteria->compare('qsmog',$this->qsmog,true);
		$criteria->compare('soloq',$this->soloq,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Soggiorni the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
