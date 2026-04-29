<?php


class FormazioneCorsi extends CActiveRecord{
	
    
    var $selectCategorie = array();
    var $selectColori = array();
    var $tmpColore;
    
	public static function model($className=__CLASS__)	{
		return parent::model($className);
	}

	public function tableName()	{
		return 'doc_formazione_formazioni';
	}

	public function rules()	{
		
		return array(
			array('id_categoria,codice, nome', 'required', 'message' => 'Il campo {attribute} &egrave; obbligatorio'),
			array('id_categoria , colore ', 'numerical', 'integerOnly'=>true),
			array('nome', 'length', 'max'=>150),
			array('codice', 'length', 'max'=>10),
			array('id, id_categoria, colore, nome', 'safe', 'on'=>'search'),
		);
	}

	public function relations()	{
		
		return array(
		);
	}

	public function attributeLabels()	{
		return array(
			'id' => 'ID',
			'id_categoria' => 'Categoria',
			'nome' => 'Nome',
			'colore' => 'Colore',
			'codice' => 'Codice',
		);
	}

	public function search()	{
	
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('id_categoria',$this->id_categoria);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('colore',$this->colore,true);
		$criteria->compare('codice',$this->codice,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function setDefaultValues(){
        $this->selectCategorie = Yii::app()->MyUtils->getSelect('doc_formazione_categorie');
       $this->selectColori = Yii::app()->MyUtils->getSelect("doc_colori");
    }
    
    public function getCategoria($data, $id){
        return Yii::app()->MyUtils->getSelectValue($data->id_categoria, "doc_formazione_categorie");
    }
    
    public function getColore($data, $id) {
        $background = Yii::app()->db->createCommand("SELECT colore FROM doc_colori WHERE id='" . $data->colore . "'")->queryScalar();
        $colore = "<span class='color-preview' style='background:" . $background . "'> &nbsp;</span>";
        return $colore;
    }
    
    
    
}