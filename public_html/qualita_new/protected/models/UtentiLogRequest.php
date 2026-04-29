<?php

/**
 * This is the model class for table "utenti_log_request".
 *
 * The followings are the available columns in table 'utenti_log_request':
 * @property integer $id
 * @property integer $user_id
 * @property string $insert_date
 * @property string $request_method
 * @property string $request_http_code_response
 * @property string $request_url
 * @property string $request_data
 * @property string $request_body_raw
 * @property string $class_controller_action
 * @property string $request_browser
 * @property string $ip_address
 */
class UtentiLogRequest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'utenti_log_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, insert_date', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('request_method', 'length', 'max'=>10),
			array('request_http_code_response', 'length', 'max'=>3),
			array('request_url, class_controller_action, request_browser', 'length', 'max'=>255),
			array('ip_address', 'length', 'max'=>20),
			array('request_data, request_body_raw', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, insert_date, request_method, request_http_code_response, request_url, request_data, request_body_raw, class_controller_action, request_browser, ip_address', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'insert_date' => 'Insert Date',
			'request_method' => 'Request Method',
			'request_http_code_response' => 'Request Http Code Response',
			'request_url' => 'Request Url',
			'request_data' => 'Request Data',
			'request_body_raw' => 'Request Body Raw',
			'class_controller_action' => 'Class Controller Action',
			'request_browser' => 'Request Browser',
			'ip_address' => 'Ip Address',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('insert_date',$this->insert_date,true);
		$criteria->compare('request_method',$this->request_method,true);
		$criteria->compare('request_http_code_response',$this->request_http_code_response,true);
		$criteria->compare('request_url',$this->request_url,true);
		$criteria->compare('request_data',$this->request_data,true);
		$criteria->compare('request_body_raw',$this->request_body_raw,true);
		$criteria->compare('class_controller_action',$this->class_controller_action,true);
		$criteria->compare('request_browser',$this->request_browser,true);
		$criteria->compare('ip_address',$this->ip_address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UtentiLogRequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
