<?php

/**
 * This is the model class for table "doc_sms_queue".
 *
 * The followings are the available columns in table 'doc_sms_queue':
 * @property string $id
 * @property integer $id_user
 * @property string $recipient
 * @property string $sender
 * @property string $message
 * @property integer $max_attempts
 * @property integer $attempts
 * @property integer $success
 * @property string $date_published
 * @property string $last_attempt
 * @property string $date_sent
 */
class SmsQueue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SmsQueue the static model class
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
		return 'doc_sms_queue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('recipient, sender, message', 'required'),
			array('id_user, max_attempts, attempts, success', 'numerical', 'integerOnly'=>true),
			array('recipient', 'length', 'max'=>60),
			array('sender', 'length', 'max'=>16),
			array('date_published, last_attempt, date_sent', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_user, recipient, sender, message, max_attempts, attempts, success, date_published, last_attempt, date_sent', 'safe', 'on'=>'search'),
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
			'id_user' => 'Id User',
			'recipient' => 'Recipient',
			'sender' => 'Sender',
			'message' => 'Message',
			'max_attempts' => 'Max Attempts',
			'attempts' => 'Attempts',
			'success' => 'Success',
			'date_published' => 'Date Published',
			'last_attempt' => 'Last Attempt',
			'date_sent' => 'Date Sent',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('recipient',$this->recipient,true);
		$criteria->compare('sender',$this->sender,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('max_attempts',$this->max_attempts);
		$criteria->compare('attempts',$this->attempts);
		$criteria->compare('success',$this->success);
		$criteria->compare('date_published',$this->date_published,true);
		$criteria->compare('last_attempt',$this->last_attempt,true);
		$criteria->compare('date_sent',$this->date_sent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}