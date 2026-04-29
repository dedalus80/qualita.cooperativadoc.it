<?php

/**
 * This is the model class for table "doc_documents_procedures".
 *
 * The followings are the available columns in table 'doc_documents_procedures':
 * @property integer $id
 * @property integer $category_id
 * @property string $procedura
 * @property string $created_at
 * @property string $update_at
 *
 * The followings are the available model relations:
 * @property Documents[] $documents
 * @property DocumentsCategory $category
 */
class DocumentsProcedures extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentsProcedures the static model class
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
		return 'doc_documents_procedures';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, procedura', 'required'),
			array('category_id', 'numerical', 'integerOnly'=>true),
			array('category_id', 'exist', 'className'=>'DocumentsCategory', 'attributeName'=>'id', 'message'=>'La categoria selezionata non è valida'),
			array('procedura', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_id, procedura, created_at, update_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Automatically set category_id from request parameter if not already set
	 * and set created_at and update_at timestamps
	 */
	protected function beforeSave()
	{
		if (parent::beforeSave()) {
			// Se category_id non è già impostato (ad esempio quando viene passato come parametro GET),
			// prova a prenderlo dalla richiesta
			if (empty($this->category_id)) {
				// Prova prima da GET
				$categoryId = Yii::app()->request->getQuery('category_id');
				
				if (!empty($categoryId) && is_numeric($categoryId)) {
					$this->category_id = (int)$categoryId;
				}
			}
			
			// Automatically set created_at and update_at timestamps
			$now = date('Y-m-d H:i:s');
			
			if ($this->isNewRecord) {
				// Set created_at only when creating a new record
				$this->created_at = $now;
			}
			
			// Always update update_at on both create and update
			$this->update_at = $now;
			
			return true;
		}
		return false;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'documents' => array(self::HAS_MANY, 'Documents', 'procedura_id'),
			'category' => array(self::BELONGS_TO, 'DocumentsCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Categoria',
			'procedura' => 'Procedura',
			'created_at' => 'Creato il',
			'update_at' => 'Aggiornato il',
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
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('procedura',$this->procedura,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('update_at',$this->update_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 20,
			),
		));
	}
}