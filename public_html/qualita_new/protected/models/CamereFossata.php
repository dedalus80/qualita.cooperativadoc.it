<?php

class CamereFossata extends CActiveRecord{
	
	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'doc_camere_fossata';
	}

	public function rules()	{
		
		return array(
			array('nome, nome_it_IT, nome_en_GB, nome_es_ES', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
           array('nome', 'length', 'max'=>50, 'message' => 'Il campo {attribute} non &egrave; valido'),
			array('nome_it_IT, nome_en_GB, nome_es_ES', 'length', 'max'=>80, 'message' => 'Il campo {attribute} non &egrave; valido '),
			array('id, nome, nome_it_IT, nome_en_GB, nome_es_ES', 'safe', 'on'=>'search'),
		);
	}

	public function relations()	{
		return array(		);
	}

	public function attributeLabels()	{
		return array(
			'id' => 'ID',
			'nome' => 'Nome',
			'nome_it_IT' => 'Italiano',
			'nome_en_GB' => 'Inglese',
			'nome_es_ES' => 'Spagnolo',
		);
	}

	public function search()	{
		
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('nome_it_IT',$this->nome_it_IT,true);
		$criteria->compare('nome_en_GB',$this->nome_en_GB,true);
		$criteria->compare('nome_es_ES',$this->nome_es_ES,true);
		return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => 100,
                    ),
                ));
	}
    
    
}