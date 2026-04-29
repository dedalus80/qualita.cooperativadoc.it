<?php
/* @var $this CmPreiscrizioniController */
/* @var $model CmPreiscrizioni */

$this->breadcrumbs=array(
	'Cm Preiscrizionis'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CmPreiscrizioni', 'url'=>array('index')),
	array('label'=>'Create CmPreiscrizioni', 'url'=>array('create')),
	array('label'=>'Update CmPreiscrizioni', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CmPreiscrizioni', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CmPreiscrizioni', 'url'=>array('admin')),
);
?>

<h1>View CmPreiscrizioni #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nome',
		'cognome',
		'luogo_nascita',
		'data_nascita',
		'residenza',
		'indirizzo',
		'numero',
		'codicefiscale',
		'cap',
		'email',
		'cellulare',
		'altro_genitore',
		'altro_nome',
		'altro_cognome',
		'altro_luogo_nascita',
		'altro_data_nascita',
		'altro_residenza',
		'altro_indirizzo',
		'altro_numero',
		'altro_codice_fiscale',
		'altro_cap',
		'altro_email',
		'altro_cellulare',
		'documento',
		'documento_numero',
		'documento_rilascio',
		'data_rilascio',
		'nome_figlio',
		'cognome_filglio',
		'luogo_nascita_figlio',
		'data_nascita_figlio',
		'tessera_sanitaria_figlio',
		'codice_fiscale_figlio',
		'scuola',
		'classe',
		'sezione',
		'utente_milano',
		'dieta_sanitaria',
		'dieta_sanitaria_dettaglio',
		'dieta_religiosa',
		'dieta_religiosa_dettaglio',
		'insegnate_sostegno',
		'disabile',
		'disabile_dettaglio',
		'casa_vacanza',
		'informativa',
		'privacy',
		'mailing',
	),
)); ?>
