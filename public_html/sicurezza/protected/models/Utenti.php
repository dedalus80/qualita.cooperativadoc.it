<?php

class Utenti extends CActiveRecord {
    
    
    var $selectUnita = array();
    var $selectTipi  = array();
    
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'utenti';
    }

    public function rules() {

        return array(
            array('user, email, password, user_type, nome, cognome , user_unita', 'required', 'message' => 'Compilare il campo'),
            array('user_type', 'numerical', 'integerOnly' => true),
            array('user', 'length', 'max' => 20),
            array('email, password', 'length', 'max' => 40),
            // Please remove those attributes that should not be searched.
            array('id, user, email, password, user_type , user_unita', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'user' => 'Nome Utente',
            'email' => 'Email',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'password' => 'Password',
            'user_type' => 'Tipo utente',
            'user_unita' => 'Struttura '
        );
    }

    public function search() {
        

        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('user', $this->user, true);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('cognome', $this->cognome, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('user_type', $this->user_type);
        $criteria->compare('user_unita', $this->user_unita);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getUserType($data, $t) {
        return Yii::app()->db->createCommand("SELECT nome FROM utenti_tipi WHERE id='" . $data->user_type . "'")->queryScalar();
    }
    
    public function getStruttura($data, $t) {
        return Yii::app()->db->createCommand("SELECT nome FROM doc_unita WHERE id='" . $data->user_unita . "'")->queryScalar();
    }
    


    public function getSelect($table) {
        $dati = Yii::app()->db->createCommand("SELECT id, nome FROM " . $table)->queryAll();
        for ($x = 0; $x < count($dati); $x++)
            $select[$dati[$x]['id']] = $dati[$x]['nome'];
        return $select;
    }

    public function getSelectValue($id, $table) {
        return Yii::app()->db->createCommand("SELECT nome FROM " . $table . " WHERE id='" . $id . "'")->queryScalar();
    }
    
   

}