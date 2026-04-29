<?php
/* @var $this AzioniVerificheAmministrazioneController */
/* @var $data AzioniVerificheAmministrazione */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
	<?php echo CHtml::encode($data->data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unita_operativa')); ?>:</b>
	<?php echo CHtml::encode($data->unita_operativa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ora_inizio')); ?>:</b>
	<?php echo CHtml::encode($data->ora_inizio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ora_fine')); ?>:</b>
	<?php echo CHtml::encode($data->ora_fine); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_valutazione')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_valutazione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ordine')); ?>:</b>
	<?php echo CHtml::encode($data->ordine); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ordine_note')); ?>:</b>
	<?php echo CHtml::encode($data->ordine_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sado')); ?>:</b>
	<?php echo CHtml::encode($data->sado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('saldo_note')); ?>:</b>
	<?php echo CHtml::encode($data->saldo_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('archiviazione')); ?>:</b>
	<?php echo CHtml::encode($data->archiviazione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('archiviazione_note')); ?>:</b>
	<?php echo CHtml::encode($data->archiviazione_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documenti')); ?>:</b>
	<?php echo CHtml::encode($data->documenti); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documenti_note')); ?>:</b>
	<?php echo CHtml::encode($data->documenti_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('intestazione')); ?>:</b>
	<?php echo CHtml::encode($data->intestazione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('intestazione_note')); ?>:</b>
	<?php echo CHtml::encode($data->intestazione_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importo')); ?>:</b>
	<?php echo CHtml::encode($data->importo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('importo_note')); ?>:</b>
	<?php echo CHtml::encode($data->importo_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ragione_sociale')); ?>:</b>
	<?php echo CHtml::encode($data->ragione_sociale); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ragione_sociale_note')); ?>:</b>
	<?php echo CHtml::encode($data->ragione_sociale_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prezzi_conformi')); ?>:</b>
	<?php echo CHtml::encode($data->prezzi_conformi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prezzi_conformi_note')); ?>:</b>
	<?php echo CHtml::encode($data->prezzi_conformi_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('utilizzo_modulistica')); ?>:</b>
	<?php echo CHtml::encode($data->utilizzo_modulistica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('utilizzo_modulistica_note')); ?>:</b>
	<?php echo CHtml::encode($data->utilizzo_modulistica_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('moduli_spese')); ?>:</b>
	<?php echo CHtml::encode($data->moduli_spese); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('moduli_spese_note')); ?>:</b>
	<?php echo CHtml::encode($data->moduli_spese_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rapporto_giornaliero')); ?>:</b>
	<?php echo CHtml::encode($data->rapporto_giornaliero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rapporto_giornaliero_note')); ?>:</b>
	<?php echo CHtml::encode($data->rapporto_giornaliero_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_clienti')); ?>:</b>
	<?php echo CHtml::encode($data->numero_clienti); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_clienti_note')); ?>:</b>
	<?php echo CHtml::encode($data->numero_clienti_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scheda_veicoli')); ?>:</b>
	<?php echo CHtml::encode($data->scheda_veicoli); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scheda_veicoli_note')); ?>:</b>
	<?php echo CHtml::encode($data->scheda_veicoli_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_non_conformita')); ?>:</b>
	<?php echo CHtml::encode($data->numero_non_conformita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('note')); ?>:</b>
	<?php echo CHtml::encode($data->note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('osservazioni')); ?>:</b>
	<?php echo CHtml::encode($data->osservazioni); ?>
	<br />

	*/ ?>

</div>