<?php
/* @var $this QuestionarioKeluarController */
/* @var $data QuestionarioKeluar */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('sede_operativa')); ?>:</b>
	<?php echo CHtml::encode($data->sede_operativa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('scuola')); ?>:</b>
	<?php echo CHtml::encode($data->scuola); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_consegna')); ?>:</b>
	<?php echo CHtml::encode($data->data_consegna); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_restituzione')); ?>:</b>
	<?php echo CHtml::encode($data->data_restituzione); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('villaggio_complessivo')); ?>:</b>
	<?php echo CHtml::encode($data->villaggio_complessivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('struttura_complessivo')); ?>:</b>
	<?php echo CHtml::encode($data->struttura_complessivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rapporto_keluar')); ?>:</b>
	<?php echo CHtml::encode($data->rapporto_keluar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trasporto_nome')); ?>:</b>
	<?php echo CHtml::encode($data->trasporto_nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trasporto_qualita')); ?>:</b>
	<?php echo CHtml::encode($data->trasporto_qualita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trasporto_cortesia')); ?>:</b>
	<?php echo CHtml::encode($data->trasporto_cortesia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trasporto_tempi')); ?>:</b>
	<?php echo CHtml::encode($data->trasporto_tempi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ristorante_servizio')); ?>:</b>
	<?php echo CHtml::encode($data->ristorante_servizio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ristorante_cibo')); ?>:</b>
	<?php echo CHtml::encode($data->ristorante_cibo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ristorante_menu')); ?>:</b>
	<?php echo CHtml::encode($data->ristorante_menu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personale_cortesia')); ?>:</b>
	<?php echo CHtml::encode($data->personale_cortesia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personale_disponibilita')); ?>:</b>
	<?php echo CHtml::encode($data->personale_disponibilita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('escursioni__itinerari')); ?>:</b>
	<?php echo CHtml::encode($data->escursioni__itinerari); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('escursioni_guida')); ?>:</b>
	<?php echo CHtml::encode($data->escursioni_guida); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('neve_noleggio')); ?>:</b>
	<?php echo CHtml::encode($data->neve_noleggio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('neve_scuola')); ?>:</b>
	<?php echo CHtml::encode($data->neve_scuola); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('laboratori_tecnici')); ?>:</b>
	<?php echo CHtml::encode($data->laboratori_tecnici); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('laboratori_competenze')); ?>:</b>
	<?php echo CHtml::encode($data->laboratori_competenze); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consiglia')); ?>:</b>
	<?php echo CHtml::encode($data->consiglia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suggerimenti')); ?>:</b>
	<?php echo CHtml::encode($data->suggerimenti); ?>
	<br />

	*/ ?>

</div>