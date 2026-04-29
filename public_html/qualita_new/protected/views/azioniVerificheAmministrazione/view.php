<?php
/* @var $this AzioniVerificheAmministrazioneController */
/* @var $model AzioniVerificheAmministrazione */

$this->breadcrumbs=array(
	'Azioni Verifiche Amministraziones'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AzioniVerificheAmministrazione', 'url'=>array('index')),
	array('label'=>'Create AzioniVerificheAmministrazione', 'url'=>array('create')),
	array('label'=>'Update AzioniVerificheAmministrazione', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AzioniVerificheAmministrazione', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AzioniVerificheAmministrazione', 'url'=>array('admin')),
);
?>

<h1>View AzioniVerificheAmministrazione #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'data',
		'unita_operativa',
		'ora_inizio',
		'ora_fine',
		'tipo_valutazione',
		'ordine',
		'ordine_note',
		'sado',
		'saldo_note',
		'archiviazione',
		'archiviazione_note',
		'documenti',
		'documenti_note',
		'intestazione',
		'intestazione_note',
		'importo',
		'importo_note',
		'ragione_sociale',
		'ragione_sociale_note',
		'prezzi_conformi',
		'prezzi_conformi_note',
		'utilizzo_modulistica',
		'utilizzo_modulistica_note',
		'moduli_spese',
		'moduli_spese_note',
		'rapporto_giornaliero',
		'rapporto_giornaliero_note',
		'numero_clienti',
		'numero_clienti_note',
		'scheda_veicoli',
		'scheda_veicoli_note',
		'numero_non_conformita',
		'note',
		'osservazioni',
	),
)); ?>
