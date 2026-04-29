<?php

/**
 * This is the model class for table "utenti_tipi".
 *
 * The followings are the available columns in table 'utenti_tipi':
 * @property integer $id
 * @property string $nome
 * @property string $gruppo
 * @property string $permissions
 */
class UtentiTipi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'utenti_tipi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, gruppo', 'required'),
			array('nome', 'length', 'max'=>50),
			array('gruppo', 'in', 'range'=>['ADMIN','DIRECTOR','RESPONSIBLE','USER','SEGNALATORE','MANUTENTORE'], 'allowEmpty'=>false),
			array('permissions','type','type'=>'array'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nome, gruppo, permissions', 'safe', 'on'=>'search'),
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

	public function afterValidate()
	{
		parent::afterValidate();
		$this->permissions = json_encode($this->permissions);
	}
	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nome' => 'Nome',
			'gruppo' => 'Gruppo',
			'permissions' => 'Permessi',
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
		$criteria->compare('gruppo',$this->gruppo,true);
		$criteria->compare('permissions',$this->permissions,true);

		if(Yii::app()->user->getState('typeUserId') != 9) {
			$criteria->addCondition('gruppo != "ADMIN"');
		}

		$criteria->addCondition('gruppo != "ADMIN"');
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UtentiTipi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getPermissions()
	{
		$permissions = [
			'Utenti'                 => [
				'controller' => 'utenti',
				'enabled' => false,
				'view'    => false,
				'create'  => false,
				'update'  => false,
				'delete'  => false,
				'class'   => User::class
			],
			'Impostazioni'           => [
				'controller' => '',
				'enabled' => false,
				'view'    => false,
				'create'  => false,
				'update'  => false,
				'delete'  => false,
				'class'   => '',
			],
			'Comunicazioni'          => [
				'controller' => 'comunicazioni',
				'enabled' => false,
				'view'    => false,
				'create'  => false,
				'update'  => false,
				'delete'  => false,
				'class'   => '',
			],
			'AzioniNonConformi'      => [
				'controller' => 'dbNonconforme',
				'enabled' 	 => false,
				'view'    	 => false,
				'create'  	 => false,
				'update'  	 => false,
				'delete'     => false,
				'class'      => DbNonconforme::class,
			],
			'AzioniCorrettive'       => [
				'controller' => 'dbAzioniCorrettive',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => DbAzionicorrettive::class,
			],
			'Reclami'                => [
				'controller' => 'dbReclami',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => DbReclami::class,
			],
			'AzioniReclami'          => [
				'controller' => 'reclamiAzioni',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => ReclamiAzioni::class,
			],
			'Verifiche'              => [
				'controller' => 'azioniVerifiche',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => AzioniVerifiche::class,
			],
			'DocumentiQualita'       => [
				'controller' => 'documentiQualita',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => DocumentiQualita::class,
			],
			'DocumentiSoggiorni'     => [
				'controller' => 'documentiSoggiorni',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => DocumentiSoggiorni::class,
			],
			'Area Documenti'     => [
				'controller' => 'documents',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => Documents::class,
			],
			'Formazione'             => [
				'controller' => 'azioniFormazioni',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => FormazioneCorsi::class,
			],
			'Statistiche'            => [
				'controller' => '',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => '',
			],
			'Utenze'                 => [
				'controller' => 'utenzePresenze',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => '',
			],
			'Letture contatori'      => [
				'controller' => '',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => '',
			],
			'IndiceSoddisfazione'    => [
				'controller' => '',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => '',
			],
			'Questionari'            => [
				'controller' => '',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => '',
			],
			'StatisticheQuestionari' => [
				'controller' => '',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => '',
			],
			'Preiscrizioni'          => [
				'controller' => '',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => '',
			],
			'Segnalazioni'          => [
				'controller' => '',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => '',
			],
			'Manutenzioni'          => [
				'controller' => '',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => '',
			],
			'Scarica Dati' => [
				'controller' => '',
				'enabled'    => false,
				'view'       => false,
				'create'     => false,
				'update'     => false,
				'delete'     => false,
				'class'      => '',
			],
		];

		if($this->permissions) {
			$perms = json_decode($this->permissions, true);
			$permissions = array_replace($permissions, $perms);
		}

		unset($permissions['Comunicazioni']);

		return $permissions;
	}

	public function displayPermissions()
	{
		$html = '<table class="table">
				<tr>
					<th>Sezione</th>
					<th class="text-center">Abilita</th>
					<th class="text-center">Visualizza</th>
					<th class="text-center">Crea</th>
					<th class="text-center">Modifica</th>
					<th class="text-center">Elimina</th>
				</tr>';
				
		foreach($this->getPermissions() as $key => $perms) {
				$html .= '<tr>
					<td>'.$key.'</td>
					<td class="text-center">'.($perms['enabled']?'<i class="fa fa-check" />':'').'</td>
					<td class="text-center">'.($perms['view']?'<i class="fa fa-check" />':'').'</td>
					<td class="text-center">'.($perms['create']?'<i class="fa fa-check" />':'').'</td>
					<td class="text-center">'.($perms['update']?'<i class="fa fa-check" />':'').'</td>
					<td class="text-center">'.($perms['delete']?'<i class="fa fa-check" />':'').'</td>
				</tr>';
		}
				
		$html .= '</table>';

		return $html;
	}
}
