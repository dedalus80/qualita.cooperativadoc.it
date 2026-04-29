<?php

/**
 * This is the model class for table "doc_verifiche_answers".
 *
 * The followings are the available columns in table 'doc_verifiche_answers':
 * @property integer $id
 * @property integer $verificaId
 * @property integer $questionId
 * @property string $answer
 * @property string $note
 *
 * The followings are the available model relations:
 * @property VerificheQuestions $question
 * @property DbVerifiche $verifica
 */
class VerificheAnswers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VerificheAnswers the static model class
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
		return 'doc_verifiche_answers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('verificaId', 'required'),
			array('verificaId, questionId', 'numerical', 'integerOnly'=>true),
			array('answer', 'length', 'max'=>2),
			array('note, file_nc', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, verificaId, questionId, answer, note', 'safe', 'on'=>'search'),
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
			'question' => array(self::BELONGS_TO, 'VerificheQuestions', 'questionId'),
			'verifica' => array(self::BELONGS_TO, 'DbVerifiche', 'verificaId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'verificaId' => 'Verifica',
			'questionId' => 'Question',
			'answer' => 'Answer',
			'note' => 'Note'
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
		$criteria->compare('verificaId',$this->verificaId);
		$criteria->compare('questionId',$this->questionId);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('note',$this->note,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getSelectAnswer($id, $selected = "") {
		$html = '
<select class="answer-select form-control" name="Questions['.$id.'][answer]" data-question-id="'.$id.'">
	<option value="" '.($selected == ''?'selected="selected"':'').'>Scegli</option>
	<option value="C" '.($selected == 'C'?'selected="selected"':'').'>CONFORME</option>
	<option value="NC" '.($selected == 'NC'?'selected="selected"':'').'>NON CONFORME</option>
	<option value="NA" '.($selected == 'NA'?'selected="selected"':'').'>NON APPLICABILE</option>
	<option value="NR" '.($selected == 'NR'?'selected="selected"':'').'>NON RILEVATA</option>
</select>
';	
		return $html;
	}

	public static function getValue($value)
	{
		$values = [
			'C' => 'CONFORME',
			'NC' => 'NON CONFORME',
			'NA' => 'NON APPLICABILE',
			'NR' => 'NON RILEVATA'
		];

		return $values[$value];
	}
}