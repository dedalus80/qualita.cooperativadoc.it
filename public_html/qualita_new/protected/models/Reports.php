<?php

/**
 * This is the model class for table "reports".
 *
 * The followings are the available columns in table 'reports':
 * @property string $id
 * @property integer $user_id
 * @property string $structure_id
 * @property string $subject
 * @property string $description
 * @property string $resolve_by
 * @property string $site
 * @property string $status
 * @property string $priority
 * @property string $created_at
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property Maintenance[] $maintenances
 * @property Utenti $user
 * @property ReportsPicture[] $reportsPictures
 */
class Reports extends CActiveRecord
{
	const opened = 'APERTO';
	const assigned = 'ASSEGNATO';
	const closed = 'COMPLETATO';
	const deleted = 'ELIMINATO';
	const API_TOKEN = 'aff4f947-009f-4b1e-a833-3edb4be2e7f3';
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reports';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, category_id, structure_id, structure_area_id, description, priority', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>255),
			array('status', 'length', 'max'=>8),
			array('priority', 'length', 'max'=>6),
			array('area_not_available', 'length', 'max'=>1),
			array('created_at, updated_at, resolve_by', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, structure_id, structure_area_id, area_not_available, escalated_to_admin, category_id, subject, description, site, status, priority, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'audit'    => array(self::HAS_ONE, 'Maintenance', 'report_id'),
			'user'     => array(self::BELONGS_TO, 'Utenti', 'user_id'),
			'pictures' => array(self::HAS_MANY, 'ReportsPicture', 'report_id'),
			'area'     => array(self::BELONGS_TO, 'UnitaMappaAree', 'structure_area_id'),
			'category' => array(self::BELONGS_TO, 'ReportsCategory', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                 => 'ID',
			'user_id'            => 'Segnalato da',
			'structure_id'       => 'Struttura',
			'structure_area_id'  => 'Area',
			'area_not_available' => 'Area disponibile?',
			'category_id'        => 'Categoria',
			'subject'            => 'Oggetto',
			'description'        => 'Descrizione',
			'site'               => 'Luogo',
			'status'             => 'Stato',
			'escalated_to_admin' => 'Richiesto intervento responsabile',
			'priority'           => 'Priorit&agrave;',
			'resolve_by'         => 'Da risolvere entro',
			'created_at'         => 'Creato il',
			'updated_at'         => 'Aggiornato il',
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

		$criteria->with = array('category','area','area.unita','audit');

		$criteria->compare('t.id',$this->id,false);
		$criteria->compare('t.user_id',$this->user_id, false);
		$criteria->compare('structure_id',$this->structure_id,false);
		$criteria->compare('structure_area_id',$this->structure_area_id,false);
		$criteria->compare('area_not_available',$this->area_not_available,true);
		$criteria->compare('category_id', $this->category_id, false);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('escalated_to_admin', $this->escalated_to_admin, true);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		if(Yii::app()->user->getState('group') == 'DIRECTOR') {
			$criteria->addInCondition('structure_id', Yii::app()->user->getState('strutture'));
		}

		if(Yii::app()->user->getState('group') == 'SEGNALATORE') {
			$criteria->compare('t.user_id', Yii::app()->user->id);
			
			if(!$this->status || $this->status == 'deleted') {
				$criteria->addCondition('t.status != "deleted"');
			}
		}

		if(Yii::app()->user->getState('group') == 'MANUTENTORE') {
			$criteria->compare('audit.user_id', Yii::app()->user->id, false);

			$criteria2 = new CDbCriteria();

			if(Yii::app()->user->getState('is_maintenance_lead') == 'Y') {
				$criteria2->addInCondition('structure_id', Yii::app()->user->getState('strutture'));
				$criteria2->addCondition('t.status != "deleted"');
			}
			else {
				$criteria2->addInCondition('structure_id', Yii::app()->user->getState('strutture'));
				$criteria2->addCondition('t.status = "opened"');
			}

			//$criteria->compare('audit.user_id', Yii::app()->user->id, false);
			//$criteria->addCondition('t.status = "opened"', 'OR');
			
			if(!$this->status || $this->status == 'deleted') {
				$criteria->addCondition('t.status != "deleted"');
			}

			$criteria->mergeWith($criteria2, 'OR');
		}

		$sort = new CSort;
		$sort->defaultOrder = 't.priority, t.created_at DESC';
		$sort->attributes = [
			'id' => [
				'asc' => 't.id',
				'desc' => 't.id desc',
			],
			'created_at'=>[
				'asc'=>"t.created_at",
				'desc'=>"t.created_at desc"
			],
			'user_id'=>[
				'asc'=>"t.user_id",
				'desc'=>"t.user_id desc"
			],
			'structure_id'=>[
				'asc'=>"t.structure_id",
				'desc'=>"t.structure_id desc"
			],
			'structure_area_id'=>[
				'asc'=>"area.description",
				'desc'=>"area.description desc"
			],
			'area_not_available'=>[
				'asc'=>"t.area_not_available",
				'desc'=>"t.area_not_available desc"
			],
			'category_id'=>[
				'asc'=>"category.name",
				'desc'=>"category.name desc"
			],
			'status'=>[
				'asc'=>"status",
				'desc'=>"status desc"
			],
			'escalated_to_admin'=>[
				'asc'=>"t.escalated_to_admin",
				'desc'=>"t.escalated_to_admin desc"
			],
			'priority'=>[
				'asc'=>"priority",
				'desc'=>"priority desc"
			]
		];

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort'=>$sort,
			'pagination' => array(
				'pageSize' => 25,
			),
		));
	}

	public function unavailableAreas()
	{
		$criteria=new CDbCriteria;

		$criteria->with = array('category','area','area.unita','audit');

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('structure_id',$this->structure_id,true);
		$criteria->compare('structure_area_id',$this->structure_area_id,true);
		$criteria->compare('category_id', $this->category_id, true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('escalated_to_admin', $this->escalated_to_admin, true);
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

		if(Yii::app()->user->getState('group') == 'DIRECTOR') {
			$criteria->addInCondition('structure_id', Yii::app()->user->getState('strutture'));
		}

		if(Yii::app()->user->getState('group') == 'SEGNALATORE') {
			$criteria->compare('t.user_id', Yii::app()->user->id);
			
			if(!$this->status || $this->status == 'deleted') {
				$criteria->addCondition('t.status != "deleted"');
			}
		}

		if(Yii::app()->user->getState('group') == 'MANUTENTORE') {
			$criteria->compare('audit.user_id', Yii::app()->user->id, false);
			$criteria->addCondition('t.status = "opened"', 'OR');
			
			if(!$this->status || $this->status == 'deleted') {
				$criteria->addCondition('t.status != "deleted"');
			}
		}

		//seleziono solo i records che hanno il flag a 1 per mostrare solo le aree non disponibili
		$criteria->addCondition('area_not_available = 1');
		$criteria->addCondition('status != "closed"');
		$criteria->addCondition('status != "deleted"');

		$criteria->select = "t.id, t.structure_id, area.description, t.created_at";

		$sort = new CSort;
		$sort->defaultOrder = 't.created_at DESC';
		$sort->attributes = [
			'id' => [
				'asc' => 't.id',
				'desc' => 't.id desc',
			],
			'created_at'=>[
				'asc'=>"t.created_at",
				'desc'=>"t.created_at desc"
			],
			'structure_id'=>[
				'asc'=>"t.structure_id",
				'desc'=>"t.structure_id desc"
			],
			'structure_area_id'=>[
				'asc'=>"area.description",
				'desc'=>"area.description desc"
			],
		];

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
			'sort'=>$sort,
			'pagination' => array(
				'pageSize' => 25,
			),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Reports the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getViewStatusFilter()
	{

		$status = array(
			array('id'=>'opened', 'status'=>'APERTO'),
			array('id'=>'assigned', 'status'=>'ASSEGNATO'),
			array('id'=>'closed', 'status'=>'COMPLETATO'),
		);

		if(!in_array(Yii::app()->user->getState('group'), ['SEGNALATORE','MANUTENTORE'])) {
			array_push($status, array('id'=>'deleted', 'status'=>'ELIMINATO'));
		}

		return $status;
	}

	public function getViewAreaFilter()
	{
		if(Yii::app()->user->getState('group') == 'ADMIN') {
			$areas = CHtml::listData(UnitaMappaAree::model()->with('unita')->findAll(['order'=>'unita.nome, description']), 'id', 'area');
		}
		else {
			$areas = CHtml::listData(UnitaMappaAree::model()->with('unita')->findAllByAttributes(['unita_id' => Yii::app()->user->getState('strutture')], ['order'=>'unita.nome, description']), 'id', 'area');
		}

		return $areas;
	}

	public function getViewStructureFilter()
	{
		if(Yii::app()->user->getState('group') == 'ADMIN') {
			$structures = CHtml::listData(Strutture::model()->findAll(['condition' => 'tipologia = 1', 'order' => 'nome']), 'id', 'nome');		
		}
		else {
			$structures = CHtml::listData(Strutture::model()->findAllByAttributes(['id' => Yii::app()->user->getState('strutture'), 'tipologia' => 1], ['order' => 'nome']), 'id', 'nome');		
		}

		return $structures;
	}

	public function getViewCategoryFilter()
	{
		$categories = CHtml::listData(ReportsCategory::model()->findAll(['order'=>'name']), 'id', 'name');

		$itemMove = 'ALTRO';

		// Trova l'indice dell'elemento
		$index = array_search($itemMove, $categories, true);

		if ($index !== false) {
			// Rimuovi l'elemento dall'array mantenendo gli indici
			unset($categories[$index]);
			
			// Reinserisci l'elemento alla fine con lo stesso indice
			$categories[$index] = $itemMove;
		}

		return $categories;
	}

	public function getHtmlStatus()
	{
		switch($this->status) {
			case 'opened':
				return '<span class="label label-default">'.constant("self::".$this->status).'</span>';
			case 'closed':
				return '<span class="label label-success">'.constant("self::".$this->status).'</span>';
			case 'assigned':
				return '<span class="label label-warning">'.constant("self::".$this->status).'</span>';
			case 'deleted':
				return '<span class="label label-danger">'.constant("self::".$this->status).'</span>';
			default:
				return '';
		}
	}

	public function getHtmlAreaNotAvailable()
	{
		if($this->area_not_available == 1) {
			return '<span class="label label-danger">NO</span>';
		}

		return 'SI';
	}

	public function getHtmlEscalatedToAdmin()
	{
		if($this->escalated_to_admin == 1) {
			return '<span class="label label-danger">SI</span>';
		}

		return 'NO';
	}

	public function abilityUpdate()
	{
		if(in_array(Yii::app()->user->getState("group"), ['ADMIN','DIRECTOR']) && $this->status != 'closed') {
			return true;
		}

		switch($this->status) {
			case 'opened':
				if(Yii::app()->user->getState("group")=="SEGNALATORE" && Yii::app()->user->can("Segnalazioni", "update", $this->user_id)) {
					return true;
				}

				if(Yii::app()->user->getState("group")=="MANUTENTORE") {
					return true;
				}
				return false;

			case 'assigned':
				if(Yii::app()->user->getState("group")=="MANUTENTORE" && Yii::app()->user->can('Manutenzioni', 'update', $this->audit->user_id)) {
					return true;
				}
				return false;

			default:
				return false;
		}
	}

	public function abilityDelete()
	{
		if(in_array(Yii::app()->user->getState("group"), ['ADMIN','DIRECTOR'])) {
			return true;

		}
		
		if(Yii::app()->user->can("Segnalazioni", "delete", $this->user_id) && $this->status == "opened") {
			return true;
		}

		return false;
	}

	public static function getListSegnalatore($structureId = null)
	{
		$data = [];

		if($structureId) {
			$data = CHtml::listData(
				Utenti::model()->findAll(
					[
						'condition' => 'user_type IN (11,13) AND FIND_IN_SET('.$structureId.', user_unita)', 
						'order'=>'nome, cognome'
					]
				), 
				'id', 
				'displayName'
			);
		}

		return $data;
	}
}
