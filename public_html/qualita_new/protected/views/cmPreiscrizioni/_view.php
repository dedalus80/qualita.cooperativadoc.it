<?php
/* @var $this CmPreiscrizioniController */
/* @var $data CmPreiscrizioni */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cognome')); ?>:</b>
	<?php echo CHtml::encode($data->cognome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('luogo_nascita')); ?>:</b>
	<?php echo CHtml::encode($data->luogo_nascita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_nascita')); ?>:</b>
	<?php echo CHtml::encode($data->data_nascita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('residenza')); ?>:</b>
	<?php echo CHtml::encode($data->residenza); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indirizzo')); ?>:</b>
	<?php echo CHtml::encode($data->indirizzo); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('numero')); ?>:</b>
	<?php echo CHtml::encode($data->numero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codicefiscale')); ?>:</b>
	<?php echo CHtml::encode($data->codicefiscale); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cap')); ?>:</b>
	<?php echo CHtml::encode($data->cap); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cellulare')); ?>:</b>
	<?php echo CHtml::encode($data->cellulare); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altro_genitore')); ?>:</b>
	<?php echo CHtml::encode($data->altro_genitore); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altro_nome')); ?>:</b>
	<?php echo CHtml::encode($data->altro_nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altro_cognome')); ?>:</b>
	<?php echo CHtml::encode($data->altro_cognome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altro_luogo_nascita')); ?>:</b>
	<?php echo CHtml::encode($data->altro_luogo_nascita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altro_data_nascita')); ?>:</b>
	<?php echo CHtml::encode($data->altro_data_nascita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altro_residenza')); ?>:</b>
	<?php echo CHtml::encode($data->altro_residenza); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altro_indirizzo')); ?>:</b>
	<?php echo CHtml::encode($data->altro_indirizzo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altro_numero')); ?>:</b>
	<?php echo CHtml::encode($data->altro_numero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altro_codice_fiscale')); ?>:</b>
	<?php echo CHtml::encode($data->altro_codice_fiscale); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altro_cap')); ?>:</b>
	<?php echo CHtml::encode($data->altro_cap); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altro_email')); ?>:</b>
	<?php echo CHtml::encode($data->altro_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('altro_cellulare')); ?>:</b>
	<?php echo CHtml::encode($data->altro_cellulare); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documento')); ?>:</b>
	<?php echo CHtml::encode($data->documento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documento_numero')); ?>:</b>
	<?php echo CHtml::encode($data->documento_numero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documento_rilascio')); ?>:</b>
	<?php echo CHtml::encode($data->documento_rilascio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_rilascio')); ?>:</b>
	<?php echo CHtml::encode($data->data_rilascio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome_figlio')); ?>:</b>
	<?php echo CHtml::encode($data->nome_figlio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cognome_filglio')); ?>:</b>
	<?php echo CHtml::encode($data->cognome_filglio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('luogo_nascita_figlio')); ?>:</b>
	<?php echo CHtml::encode($data->luogo_nascita_figlio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_nascita_figlio')); ?>:</b>
	<?php echo CHtml::encode($data->data_nascita_figlio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tessera_sanitaria_figlio')); ?>:</b>
	<?php echo CHtml::encode($data->tessera_sanitaria_figlio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codice_fiscale_figlio')); ?>:</b>
	<?php echo CHtml::encode($data->codice_fiscale_figlio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scuola')); ?>:</b>
	<?php echo CHtml::encode($data->scuola); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('classe')); ?>:</b>
	<?php echo CHtml::encode($data->classe); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sezione')); ?>:</b>
	<?php echo CHtml::encode($data->sezione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('utente_milano')); ?>:</b>
	<?php echo CHtml::encode($data->utente_milano); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dieta_sanitaria')); ?>:</b>
	<?php echo CHtml::encode($data->dieta_sanitaria); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dieta_sanitaria_dettaglio')); ?>:</b>
	<?php echo CHtml::encode($data->dieta_sanitaria_dettaglio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dieta_religiosa')); ?>:</b>
	<?php echo CHtml::encode($data->dieta_religiosa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dieta_religiosa_dettaglio')); ?>:</b>
	<?php echo CHtml::encode($data->dieta_religiosa_dettaglio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insegnate_sostegno')); ?>:</b>
	<?php echo CHtml::encode($data->insegnate_sostegno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disabile')); ?>:</b>
	<?php echo CHtml::encode($data->disabile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disabile_dettaglio')); ?>:</b>
	<?php echo CHtml::encode($data->disabile_dettaglio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('casa_vacanza')); ?>:</b>
	<?php echo CHtml::encode($data->casa_vacanza); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('informativa')); ?>:</b>
	<?php echo CHtml::encode($data->informativa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('privacy')); ?>:</b>
	<?php echo CHtml::encode($data->privacy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mailing')); ?>:</b>
	<?php echo CHtml::encode($data->mailing); ?>
	<br />

	*/ ?>

</div>