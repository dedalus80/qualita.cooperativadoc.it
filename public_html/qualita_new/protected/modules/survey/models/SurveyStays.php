<?php

/**
 * This is the model class for table "survey_stays".
 *
 * The followings are the available columns in table 'survey_stays':
 * @property integer $id
 * @property integer $tipologia_id
 * @property string $nome
 * @property string $cognome
 * @property integer $organizzatore
 * @property integer $type_stay
 * @property integer $soggiorno
 * @property integer $turno
 * @property string $email
 * @property string $nome_coordinatore
 * @property string $cognome_coordinatore
 * @property integer $eta
 * @property string $nome_gruppo
 * @property string $cellulare
 * @property string $divertimento
 * @property string $educatori
 * @property string $compagni
 * @property string $giochi
 * @property string $attivita_sportive
 * @property string $gite
 * @property string $laboratori
 * @property string $escursioni
 * @property string $soggiorno_esperienza
 * @property string $soggiorno_staff
 * @property string $soggiorno_communicazione
 * @property string $soggiorno_complessivo
 * @property string $studio_localita
 * @property string $studio_college
 * @property string $studio_attivita
 * @property string $studio_corso
 * @property string $studio_escursioni
 * @property string $studio_divertimento
 * @property string $studio_aspetto_vacanza
 * @property string $studio_attivita_utile
 * @property string $studio_suggerimenti
 * @property string $studio_location
 * @property string $studio_involvement
 * @property string $scientifici_organizzazione
 * @property string $scientifici_didattica
 * @property string $scientifici_formazione
 * @property string $scientifici_school_subject
 * @property string $scientifici_modules_liked
 * @property string $scientifici_involvement
 * @property string $sport_chosen
 * @property string $sport_organization
 * @property string $sport_involvement
 * @property string $suggerimenti
 * @property string $osservazioni
 * @property string $data_restituzione
 * @property integer $anno
 */
class SurveyStays extends CActiveRecord
{
	public $privacy;

	public $typeStay = [
		'JUN' => 'JUNIOR',
		'SEN' => 'SENIOR',
		'STU' => 'VACANZE INGLESE',
		'SCI' => 'CAMPUS SCIENTIFICI',
		'SPO' => 'CAMPUS SPORTIVI'
	];

	public $stats = array();

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'survey_stays';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, cognome, organizzatore, soggiorno, turno, nome_coordinatore, cognome_coordinatore, eta, nome_gruppo, tipologia_id', 'required'),
			array('studio_localita, studio_corso', 'required', 'message' => 'Questo campo è obbligatorio.', 'on' => 'student'),
			array('scientifici_organizzazione, scientifici_didattica, scientifici_formazione, scientifici_school_subject', 'required', 'on' => 'scientific', 'message' => 'Questo campo è obbligatorio.'),
			array('sport_chosen, sport_organization, sport_involvement', 'required', 'on' => 'sport', 'message' => 'Questo campo è obbligatorio.'),
			array('divertimento, educatori, compagni, giochi, gite, suggerimenti, privacy', 'required', 'message' => 'Questo campo è obbligatorio.'),
			//array('type_stay', 'length', 'max'=>3),
			array('organizzatore, soggiorno, turno, eta, anno', 'numerical', 'integerOnly'=>true),
			array('nome, cognome, nome_coordinatore, cognome_coordinatore, nome_gruppo', 'length', 'max'=>50),
			//array('email', 'length', 'max'=>255),
			//array('cellulare', 'length', 'max'=>20),
			array('tipologia_id, divertimento, educatori, compagni, giochi, attivita_sportive, gite, laboratori', 'length', 'max'=>1),
			array('studio_localita, studio_corso, studio_involvement', 'length', 'max'=>1, 'on' => 'student'),
			array('studio_location', 'length', 'min'=>2, 'max'=>2, 'on' => 'student'),
			array('scientifici_modules_liked, scientifici_involvement ', 'length', 'max'=>1, 'on' => 'scientific'),
			array('sport_organization, sport_involvement', 'length', 'max'=>1, 'on' => 'sport'),

			array('suggerimenti', 'filter', 'filter' => 'strip_tags'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nome, cognome, organizzatore, soggiorno, turno, email, nome_coordinatore, cognome_coordinatore, eta, nome_gruppo, cellulare, divertimento, educatori, compagni, giochi, attivita_sportive, gite, laboratori, escursioni, soggiorno_esperienza, soggiorno_staff, soggiorno_communicazione, soggiorno_complessivo, studio_localita, studio_college, studio_attivita, studio_corso, studio_escursioni, studio_divertimento, studio_aspetto_vacanza, studio_attivita_utile, studio_suggerimenti, scientifici_organizzazione, scientifici_didattica, scientifici_formazione, suggerimenti, osservazioni, data_restituzione, anno', 'safe', 'on'=>'search'),
			array('privacy, email, cellulare, osservazioni, data_restituzione, studio_attivita, studio_suggerimenti, studio_escursioni, escursioni, soggiorno_esperienza, soggiorno_staff, soggiorno_communicazione, soggiorno_complessivo, scientifici_organizzazione, scientifici_didattica, scientifici_formazione, laboratori, attivita_sportive, studio_college, studio_attivita_utile, studio_aspetto_vacanza, type_stay', 'safe'),
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
            'tipologia' => array(self::BELONGS_TO, 'TipologiaSoggiorni', 'tipologia_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tipologia_id' => Yii::t('survey', 'type_stay'),
			'nome' => Yii::t('survey', 'participant_name'),
			'cognome' => Yii::t('survey', 'participant_surname'),
			'organizzatore' => Yii::t('survey', 'company'),
			'type_stay' => Yii::t('survey', 'type_stay'),
			'soggiorno' => Yii::t('survey', 'stay'),
			'turno' => Yii::t('survey', 'shift'),
			'email' => 'Email',
			'nome_coordinatore' => Yii::t('survey', 'coordinator_name'),
			'cognome_coordinatore' => Yii::t('survey', 'coordinator_surname'),
			'eta' => Yii::t('survey', 'participant_age'),
			'nome_gruppo' => Yii::t('survey', 'group_name'),
			'cellulare' => 'Cellulare',
			'divertimento' => Yii::t('survey', 'stay.section1.fun'),
			'educatori' => Yii::t('survey', 'stay.section1.educators'),
			'compagni' => Yii::t('survey', 'stay.section1.companions'),
			'giochi' => Yii::t('survey', 'stay.section1.activities'),
			'attivita_sportive' => Yii::t('survey', 'stay.section1.sports'),
			'gite' => Yii::t('survey', 'stay.section1.excurion'),
			'laboratori' => Yii::t('survey', 'stay.section1.laboratories'),
			'escursioni' => 'Escursioni',
			'soggiorno_esperienza' => 'Soggiorno Esperienza',
			'soggiorno_staff' => 'Soggiorno Staff',
			'soggiorno_communicazione' => 'Soggiorno Communicazione',
			'soggiorno_complessivo' => 'Soggiorno Complessivo',
			'studio_localita' => Yii::t('survey','stay.section.study.place'),
			'studio_college' => Yii::t('survey', 'stay.section.study.college'),
			'studio_attivita' => 'Studio Attivita',
			'studio_corso' => Yii::t('survey', 'stay.section.study.course'),
			'studio_escursioni' => 'Studio Escursioni',
			'studio_divertimento' => 'Studio Divertimento',
			'studio_aspetto_vacanza' => Yii::t('survey', 'stay.section.study.feature'),
			'studio_attivita_utile' => Yii::t('survey', 'stay.section.study.activity'),
			'studio_suggerimenti' => 'Studio Suggerimenti',
			'studio_location' => Yii::t('survey', 'stay.section.study.location'),
			'studio_involvement' => Yii::t('survey', 'stay.section.study.involvement'),
			'scientifici_organizzazione' => Yii::t('survey', 'stay.section.scientific.organization'),
			'scientifici_didattica' => Yii::t('survey', 'stay.section.scientific.didactic'),
			'scientifici_formazione' => Yii::t('survey', 'stay.section.scientific.training'),
			'scientifici_school_subject' => Yii::t('survey', 'stay.section.scientific.school.subject'),
			'scientifici_modules_liked' => Yii::t('survey', 'stay.section.scientific.modules.liked'),
			'scientifici_involvement' => Yii::t('survey', 'stay.section.scientific.involvement'),
			'sport_chosen' => Yii::t('survey','stay.section.sport.chosen'),
			'sport_organization' => Yii::t('survey','stay.section.sport.organization'),
			'sport_involvement' => Yii::t('survey','stay.section.sport.involvement'),
			'suggerimenti' => Yii::t('survey', 'stay.section.parent.suggestions'),
			'osservazioni' => 'Osservazioni',
			'data_restituzione' => 'Data Restituzione',
			'anno' => 'Anno',
			'privacy' => Yii::t('survey', 'privacy'),
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
		$criteria->compare('tipologia_id',$this->tipologia_id);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('cognome',$this->cognome,true);
		$criteria->compare('organizzatore',$this->organizzatore);
		//$criteria->compare('soggiorno',$this->soggiorno);
		$criteria->compare('turno',$this->turno);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('nome_coordinatore',$this->nome_coordinatore,true);
		$criteria->compare('cognome_coordinatore',$this->cognome_coordinatore,true);
		$criteria->compare('eta',$this->eta);
		$criteria->compare('nome_gruppo',$this->nome_gruppo,true);
		$criteria->compare('cellulare',$this->cellulare,true);
		$criteria->compare('divertimento',$this->divertimento,true);
		$criteria->compare('educatori',$this->educatori,true);
		$criteria->compare('compagni',$this->compagni,true);
		$criteria->compare('giochi',$this->giochi,true);
		$criteria->compare('attivita_sportive',$this->attivita_sportive,true);
		$criteria->compare('gite',$this->gite,true);
		$criteria->compare('laboratori',$this->laboratori,true);
		$criteria->compare('escursioni',$this->escursioni,true);
		$criteria->compare('soggiorno_esperienza',$this->soggiorno_esperienza,true);
		$criteria->compare('soggiorno_staff',$this->soggiorno_staff,true);
		$criteria->compare('soggiorno_communicazione',$this->soggiorno_communicazione,true);
		$criteria->compare('soggiorno_complessivo',$this->soggiorno_complessivo,true);
		$criteria->compare('studio_localita',$this->studio_localita,true);
		$criteria->compare('studio_college',$this->studio_college,true);
		$criteria->compare('studio_attivita',$this->studio_attivita,true);
		$criteria->compare('studio_corso',$this->studio_corso,true);
		$criteria->compare('studio_escursioni',$this->studio_escursioni,true);
		$criteria->compare('studio_divertimento',$this->studio_divertimento,true);
		$criteria->compare('studio_aspetto_vacanza',$this->studio_aspetto_vacanza,true);
		$criteria->compare('studio_attivita_utile',$this->studio_attivita_utile,true);
		$criteria->compare('studio_suggerimenti',$this->studio_suggerimenti,true);
		$criteria->compare('sport_chosen',$this->sport_chosen,true);
		$criteria->compare('sport_organization',$this->sport_organization,true);
		$criteria->compare('sport_involvement',$this->sport_involvement,true);
		$criteria->compare('suggerimenti',$this->suggerimenti,true);
		$criteria->compare('osservazioni',$this->osservazioni,true);
		$criteria->compare('data_restituzione',$this->data_restituzione,true);
		$criteria->compare('anno',$this->anno);

		$user = Yii::app()->MyUtils->getUserInfo();
        $user['user_unita'] ? $criteria->addInCondition('soggiorno', explode(',',$user['user_unita'])) : $criteria->compare('soggiorno', $this->soggiorno) ;

		$criteria->order = 'insert_date DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getParticipantAges()
	{	
		$age = [];

		for($i=5;$i<18;$i++) {
			$age[$i] = $i;
		}

		return $age;
	}

	public static function getYears()
	{
		$years = [];

		for($i=2018;$i<=date('Y');$i++) {
			$years[$i] = $i;
		}

		return $years;
	}

	public function afterValidate()
	{
		$this->anno = date('Y');
		$this->data_restituzione = new CDbExpression('NOW()');

		return parent::afterValidate();
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SurveyStays the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getDettaglio($data , $t)
	{
		$tmp  = "<span class='bold'>Data:</span> ".Yii::app()->MyUtils->getItaDate($data->data_restituzione)." <br />";
		$tmp .= "<span class='bold'>Unit&agrave;:</span> ".Yii::app()->MyUtils->getSelectValue($data->soggiorno, "doc_unita")."  <br />";
		$tmp .= "<span class='bold'>Compilato da:</span> ".$data->nome."  ".$data->cognome;
		return $tmp;
	}

	public function getSoggiorno($data, $t)
	{
        return Yii::app()->MyUtils->getSelectValue($data->soggiorno, "doc_unita")."  ".$data->soggiorno;
    }

	public function exportSurvey($tipologia_id, $year)
	{
		$tipologia = TipologiaSoggiorni::model()->findByPk($tipologia_id);

		$surveys = Yii::app()->db->createCommand()
              ->select('ss.*, u.nome AS soggiorno, c.nome AS cliente')
              ->from('survey_stays ss')
              ->join('doc_unita u', 'ss.soggiorno = u.id')
			  ->join('doc_clienti c', 'ss.organizzatore = c.id')
              ->where('ss.tipologia_id = :tipologia_id AND anno = :year', [':tipologia_id' => $tipologia_id, ':year' => $year])
              ->queryAll();

		spl_autoload_unregister(array('YiiBase', 'autoload'));
		
		Yii::import('application.extensions.phpexcel.PHPExcel', true);
		
		spl_autoload_register(array('YiiBase','autoload')); 
		
		$objPHPExcel = new PHPExcel('UTF-8');

		$objPHPExcel->getProperties()->setCreator("Cooperativa doc")->setTitle("Questionari ".$tipologia->tipologia);

		$style1 = array(
			'font' => array(
				'bold' => true,
				'size' => 10,
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'borders' => array(
				'top' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
				),
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
					'rgb' => 'e0e4e7',
				),
				'endcolor' => array(
					'argb' => 'FFFFFFFF',
				),
			),
		);

		$style2 = array(
			'font' => array(
				'bold' => true,
				'size' => 10,
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'borders' => array(
				'top' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN,
				),
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
					'rgb' => '95a5a6',
				),
				'endcolor' => array(
					'argb' => 'FFFFFFFF',
				),
			),
		);
		$style3 = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
					'rgb' => 'fafbfc',
				),
			),
		);
		$style4 = array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
					'rgb' => 'f4f5f6',
				),
			),
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
		);

		$row = 1;

		$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
		$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(25);

		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($style1);
		$objPHPExcel->getActiveSheet()->getStyle('K1:S1')->applyFromArray($style2);

		$objPHPExcel->getActiveSheet()->getStyle('A2:S2')->applyFromArray($style4);

		/*for ($x = 2; $x < count($model->datiEsportazione) + 2; $x++) {
			if ($x % 2 == 0)
				$objPHPExcel->getActiveSheet()->getStyle('A' . $x . ':S' . $x)->applyFromArray($style3);
		}*/

		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'DATI PARTECIPANTE');
		$objPHPExcel->getActiveSheet()->setCellValue('K1', 'QUESITI PARTECIPANTE');

		$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
		$objPHPExcel->getActiveSheet()->mergeCells('K1:S1');

		$labels = [
			'ID',
			'Data restituzione',
			'Nome',
			'Cognome',
			'Nome gruppo',
			'Nome coordinatore',
			'Cognome coordinatore',
			'Soggiono',
			'Turno',
			'Organizzazione',
			/*$this->getAttributeLabel('divertimento'),
			$this->getAttributeLabel('educatori'),
			$this->getAttributeLabel('compagni'),
			$this->getAttributeLabel('giochi'),
			$this->getAttributeLabel('gite'),*/
			//'Laboratori',
			//'Suggerimenti',
			//'Osservazioni'
		];

		$labels = array_merge($labels, $this->getSurveyLabels($tipologia_id));
		$labels[] = 'Suggerimenti';

		$row = 2; 

		for ($x = 0; $x < count($labels); $x++)
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($x, $row, $labels[$x]);

		$row++;

		switch($tipologia_id) {
			case 1:
			case 2:
				for ($x = 0; $x < count($surveys); $x++) {
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $surveys[$x]['id']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $surveys[$x]['data_restituzione']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $surveys[$x]['nome']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $surveys[$x]['cognome']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $surveys[$x]['nome_gruppo']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $surveys[$x]['nome_coordinatore']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $surveys[$x]['cognome_coordinatore']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $surveys[$x]['soggiorno']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $surveys[$x]['turno']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $surveys[$x]['cliente']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, self::getValueAnswer($surveys[$x]['divertimento']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, self::getValueAnswer($surveys[$x]['educatori']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, self::getValueAnswer($surveys[$x]['compagni']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, self::getValueAnswer($surveys[$x]['giochi']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, self::getValueAnswer($surveys[$x]['gite']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $surveys[$x]['suggerimenti']);
					$row++;
				}
				break;
			case 3:
				for ($x = 0; $x < count($surveys); $x++) {
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $surveys[$x]['id']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $surveys[$x]['data_restituzione']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $surveys[$x]['nome']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $surveys[$x]['cognome']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $surveys[$x]['nome_gruppo']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $surveys[$x]['nome_coordinatore']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $surveys[$x]['cognome_coordinatore']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $surveys[$x]['soggiorno']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $surveys[$x]['turno']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $surveys[$x]['cliente']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, self::getValueAnswer($surveys[$x]['divertimento']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, self::getValueAnswer($surveys[$x]['educatori']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, self::getValueAnswer($surveys[$x]['compagni']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, self::getValueAnswer($surveys[$x]['giochi']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, self::getValueAnswer($surveys[$x]['gite']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, self::getValueAnswer($surveys[$x]['studio_localita']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, self::getValueAnswer($surveys[$x]['studio_college']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, self::getValueAnswer($surveys[$x]['studio_corso']));
					//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $surveys[$x]['studio_aspetto_vacanza']);
					//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(19, $row, $surveys[$x]['studio_attivita_utile']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $surveys[$x]['suggerimenti']);
					$row++;
				}
				break;
			case 4:
				for ($x = 0; $x < count($surveys); $x++) {
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $surveys[$x]['id']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $surveys[$x]['data_restituzione']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $surveys[$x]['nome']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $surveys[$x]['cognome']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $surveys[$x]['nome_gruppo']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $surveys[$x]['nome_coordinatore']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $surveys[$x]['cognome_coordinatore']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $surveys[$x]['soggiorno']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $surveys[$x]['turno']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $surveys[$x]['cliente']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, self::getValueAnswer($surveys[$x]['divertimento']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, self::getValueAnswer($surveys[$x]['educatori']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, self::getValueAnswer($surveys[$x]['compagni']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, self::getValueAnswer($surveys[$x]['giochi']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, self::getValueAnswer($surveys[$x]['gite']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, self::getValueAnswer($surveys[$x]['scientifici_school_subject']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, self::getValueAnswer($surveys[$x]['scientifici_modules_liked']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, self::getValueAnswer($surveys[$x]['scientifici_involvement']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $surveys[$x]['suggerimenti']);
					$row++;
				}
				break;
			case 5:
				for ($x = 0; $x < count($surveys); $x++) {
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $surveys[$x]['id']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $surveys[$x]['data_restituzione']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $surveys[$x]['nome']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $surveys[$x]['cognome']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $row, $surveys[$x]['nome_gruppo']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $row, $surveys[$x]['nome_coordinatore']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $row, $surveys[$x]['cognome_coordinatore']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $row, $surveys[$x]['soggiorno']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $row, $surveys[$x]['turno']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $row, $surveys[$x]['cliente']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $row, self::getValueAnswer($surveys[$x]['divertimento']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $row, self::getValueAnswer($surveys[$x]['educatori']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $row, self::getValueAnswer($surveys[$x]['compagni']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(13, $row, self::getValueAnswer($surveys[$x]['giochi']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(14, $row, self::getValueAnswer($surveys[$x]['gite']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(15, $row, $surveys[$x]['sport_chosen']);
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(16, $row, self::getValueAnswer($surveys[$x]['sport_organization']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(17, $row, self::getValueAnswer($surveys[$x]['sport_involvement']));
					$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(18, $row, $surveys[$x]['suggerimenti']);
					$row++;
				}
				break;
		}

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Questionari_'.$tipologia->tipologia.'.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //downloadable file is in Excel 2003 format (.xls)
		$objWriter->save('php://output');
		
		Yii::app()->end();
	}

	public function getSurveyLabels($tipologia_id)
	{
		switch($tipologia_id) {
			case 1:
			case 2:
				$labels = [
					$this->getAttributeLabel('divertimento'),
					$this->getAttributeLabel('educatori'),
					$this->getAttributeLabel('compagni'),
					$this->getAttributeLabel('giochi'),
					$this->getAttributeLabel('gite'),
				];
				break;
			case 3:
				$labels = [
					$this->getAttributeLabel('divertimento'),
					$this->getAttributeLabel('educatori'),
					$this->getAttributeLabel('compagni'),
					$this->getAttributeLabel('giochi'),
					$this->getAttributeLabel('gite'),
					$this->getAttributeLabel('studio_localita'),
					$this->getAttributeLabel('studio_college'),
					$this->getAttributeLabel('studio_corso'),
					//$this->getAttributeLabel('studio_aspetto_vacanza'),
					//$this->getAttributeLabel('studio_attivita_utile'),
				];
				break;
			case 4:
				$labels = [
					$this->getAttributeLabel('divertimento'),
					$this->getAttributeLabel('educatori'),
					$this->getAttributeLabel('compagni'),
					$this->getAttributeLabel('giochi'),
					$this->getAttributeLabel('gite'),
					$this->getAttributeLabel('scientifici_school_subject'),
					$this->getAttributeLabel('scientifici_modules_liked'),
					$this->getAttributeLabel('scientifici_involvement'),
				];
				break;
			case 5:
				$labels = [
					$this->getAttributeLabel('divertimento'),
					$this->getAttributeLabel('educatori'),
					$this->getAttributeLabel('compagni'),
					$this->getAttributeLabel('giochi'),
					$this->getAttributeLabel('gite'),
					$this->getAttributeLabel('sport_chosen'),
					$this->getAttributeLabel('sport_organization'),
					$this->getAttributeLabel('sport_involvement'),
				];
				break;
		}

		return $labels;
	}

	public static function getValueAnswer($v)
	{
		$answers = [
			'P' => 'POCO',
			'A' => 'ABBASTANZA',
			'M' => 'MOLTO'
		];

		return $answers[$v];
	}

	public function getDataToExport($anni = null)
	{

        if ($anni && $anni != '0,0,0,0,0')
            $WHERE = " WHERE q.anno IN (" . $anni . ") ";

        $query = "SELECT q.*, DATE_FORMAT(q.data_restituzione ,'%d-%m-%Y' ) as restituzione , c.nome as organizza, s.nome as struttura
            FROM " . $this->tableName() . " AS q 
            LEFT JOIN doc_clienti as c ON q.organizzatore = c.id
            LEFT JOIN doc_unita as s ON q.soggiorno = s.id
            " . $WHERE;

        $where_year = "";
        if ($anni && $anni != '0,0,0,0,0') {
            $where_year = "AND s.anno IN (" . $anni . ") ";
        }

        $query = "SELECT s.*, DATE_FORMAT(s.data_restituzione ,'%d-%m-%Y' ) as restituzione , c.nome as organizza, u.nome as struttura
            FROM survey_stays AS s
            LEFT JOIN doc_clienti as c ON s.organizzatore = c.id
            LEFT JOIN doc_unita as u ON s.soggiorno = u.id
            WHERE s.tipologia_id = 5 ".$where_year;

        $dati = Yii::app()->db->createCommand($query)->queryAll();

        return $dati;
    }
}
