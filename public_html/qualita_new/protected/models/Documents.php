<?php

/**
 * This is the model class for table "doc_documents".
 *
 * The followings are the available columns in table 'doc_documents':
 * @property integer $id
 * @property integer $category_id
 * @property integer $procedura_id
 * @property string $sgq
 * @property string $tipologia
 * @property string $codice
 * @property string $numero
 * @property string $revisione
 * @property string $data_revisione
 * @property string $titolo
 * @property string $redige
 * @property string $archivia
 * @property string $riesamina
 * @property string $autorizza
 * @property string $approva
 * @property string $periodicita_riesame
 * @property string $modalita_archiviazione
 * @property string $luogo_archiviazione
 * @property string $formato
 * @property integer $funzione_responsabile_id
 * @property string $data_inserimento
 * @property string $data_modifica
 * @property integer $creato_user_id
 * @property integer $modificato_user_id
 * @property string $filename
 *
 * The followings are the available model relations:
 * @property DocumentsProcedures $procedura
 * @property DocumentsCategory $category
 * @property Funzioni $funzioneResponsabile
 */
class Documents extends CActiveRecord
{
	public $creato_da_utente;
	public $modificato_da_utente;
	public $oldFilename;
	public $document;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documents the static model class
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
		return 'doc_documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		/*return array(
			array('category_id, sgq, tipologia, codice, numero, revisione, titolo, redige, archivia, riesamina, autorizza, approva, periodicita_riesame, modalita_archiviazione, luogo_archiviazione, filename', 'required'),
			array('category_id, procedura_id, funzione_responsabile_id, creato_user_id, modificato_user_id', 'numerical', 'integerOnly'=>true),
			array('sgq, tipologia, codice, numero, revisione, titolo, redige, archivia, riesamina, autorizza, approva, periodicita_riesame, modalita_archiviazione, luogo_archiviazione, filename', 'length', 'max'=>255),
			array('formato', 'length', 'max'=>5),
			array('data_revisione, data_inserimento, data_modifica', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_id, procedura_id, sgq, tipologia, codice, numero, revisione, data_revisione, titolo, redige, archivia, riesamina, autorizza, approva, periodicita_riesame, modalita_archiviazione, luogo_archiviazione, formato, funzione_responsabile_id, data_inserimento, data_modifica, creato_user_id, modificato_user_id, filename', 'safe', 'on'=>'search'),
		);*/

		return array(
			array('category_id, funzione_responsabile_id, sgq, tipologia, codice, numero, revisione, data_revisione, titolo, redige, archivia, riesamina, autorizza, approva, periodicita_riesame, modalita_archiviazione, luogo_archiviazione', 'required'),
			array('category_id, procedura_id, funzione_responsabile_id, creato_user_id, modificato_user_id', 'numerical', 'integerOnly'=>true),
			array('sgq, tipologia, codice, numero, revisione, data_revisione, titolo, redige, archivia, riesamina, autorizza, approva, periodicita_riesame, modalita_archiviazione, luogo_archiviazione, filename', 'length', 'max'=>255),
			array('formato', 'length', 'max'=>5),
			array('data_inserimento, data_modifica', 'type', 'type' => 'date', 'dateFormat' => 'dd-MM-yyyy'),
			array('document', 'file', 'types' => 'pdf,docx,doc,ppt,pptx,xls,xlsx', 'allowEmpty' => false, 'on' => 'insert'),
			array('document', 'file', 'types' => 'pdf,docx,doc,ppt,pptx,xls,xlsx', 'allowEmpty' => true, 'on' => 'update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_id, procedura_id, sgq, tipologia, codice, numero, revisione, data_revisione, titolo, redige, archivia, riesamina, autorizza, approva, periodicita_riesame, modalita_archiviazione, luogo_archiviazione, formato, funzione_responsabile_id, data_inserimento, data_modifica, creato_user_id, modificato_user_id, filename', 'safe', 'on'=>'search'),
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
			'procedura' => array(self::BELONGS_TO, 'DocumentsProcedures', 'procedura_id'),
			'category' => array(self::BELONGS_TO, 'DocumentsCategory', 'category_id'),
			'funzioneResponsabile' => array(self::BELONGS_TO, 'Funzioni', 'funzione_responsabile_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Category',
			'procedura_id' => 'Procedura',
			'sgq' => 'Sgq',
			'tipologia' => 'Tipologia',
			'codice' => 'Codice',
			'numero' => 'Numero',
			'revisione' => 'Revisione',
			'data_revisione' => 'Data Revisione',
			'titolo' => 'Titolo',
			'redige' => 'Redige',
			'archivia' => 'Archivia',
			'riesamina' => 'Riesamina',
			'autorizza' => 'Autorizza',
			'approva' => 'Approva',
			'periodicita_riesame' => 'Periodicita Riesame',
			'modalita_archiviazione' => 'Modalita Archiviazione',
			'luogo_archiviazione' => 'Luogo Archiviazione',
			'formato' => 'Formato',
			'funzione_responsabile_id' => 'Funzione Responsabile',
			'data_inserimento' => 'Data Inserimento',
			'data_modifica' => 'Data Modifica',
			'creato_user_id' => 'Creato User',
			'modificato_user_id' => 'Modificato User',
			'document' => 'File',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($categoryId = null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.category_id',($categoryId ? $categoryId : $this->category_id));
		$criteria->compare('t.procedura_id',$this->procedura_id);
		$criteria->compare('sgq',$this->sgq,true);
		$criteria->compare('tipologia',$this->tipologia,true);
		$criteria->compare('codice',$this->codice,true);
		$criteria->compare('numero',$this->numero,true);
		$criteria->compare('revisione',$this->revisione,true);
		$criteria->compare('data_revisione',$this->data_revisione,true);
		$criteria->compare('titolo',$this->titolo,true);
		$criteria->compare('redige',$this->redige,true);
		$criteria->compare('archivia',$this->archivia,true);
		$criteria->compare('riesamina',$this->riesamina,true);
		$criteria->compare('autorizza',$this->autorizza,true);
		$criteria->compare('approva',$this->approva,true);
		$criteria->compare('periodicita_riesame',$this->periodicita_riesame,true);
		$criteria->compare('modalita_archiviazione',$this->modalita_archiviazione,true);
		$criteria->compare('luogo_archiviazione',$this->luogo_archiviazione,true);
		$criteria->compare('formato',$this->formato,true);
		$criteria->compare('funzione_responsabile_id',$this->funzione_responsabile_id);
		$criteria->compare('data_inserimento',$this->data_inserimento,true);
		$criteria->compare('data_modifica',$this->data_modifica,true);
		$criteria->compare('creato_user_id',$this->creato_user_id);
		$criteria->compare('modificato_user_id',$this->modificato_user_id);
		$criteria->compare('filename',$this->filename,true);
		$criteria->with = array('procedura','funzioneResponsabile');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 25,
			),
		));
	}

	public static function getSgq()
	{
		$items = [
			'D.O.C. s.c.s' => 'D.O.C. s.c.s',
			'KELUAR s.r.l.' => 'KELUAR s.r.l.',
			'D.O.C. s.c.s/KELUAR s.r.l.' => 'D.O.C. s.c.s/KELUAR s.r.l.' 
		];

		return $items;
	}

	public static function getTipologia()
	{
		$items = [
			'MANUALE QUALITA\'' => 'MANUALE QUALITA\'',
			'MANUALE OPERATIVO' => 'MANUALE OPERATIVO',
			'PROCEDURA' => 'PROCEDURA',
			'ELENCO' => 'ELENCO',
			'ISTRUZIONE' => 'ISTRUZIONE',
			'MODULO' => 'MODULO',
			'SCHEDA' => 'SCHEDA',
			'ALLEGATI' => 'ALLEGATI',
			'M.A.I.' => 'M.A.I.'
		];

		return $items;
	}

	public static function getCodice()
	{
		$items = [
			'MQ' => 'MQ',
			'PR' => 'PR',
			'MD' => 'MD',
			'EL' => 'EL',
			'IS' => 'IS',
			'SEZ' => 'SEZ'
		];

		return $items;
	}

	public static function getFormato()
	{
		$items = [
			'DOC' => 'DOC',
			'EXCEL' => 'EXCEL',
			'PPT' => 'PPT',
			'PDF' => 'PDF'
		];

		return $items;
	}

	public function beforeSave()
	{
		$this->data_inserimento = Yii::app()->dateFormatter->format("yyyy-MM-dd", $this->data_inserimento);
		$this->data_modifica = Yii::app()->dateFormatter->format("yyyy-MM-dd", $this->data_modifica);
		$this->data_revisione = Yii::app()->dateFormatter->format("yyyy-MM-dd", $this->data_revisione);

		if($this->scenario == 'insert') {
			$this->creato_user_id = Yii::app()->user->id;
			$this->modificato_user_id = 0;
		}

		if($this->scenario == 'update') {
			$this->modificato_user_id = Yii::app()->user->id;
		}

		return parent::beforeSave();
	}
}