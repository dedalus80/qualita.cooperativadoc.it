<?php
/* @var $this QuestionarioSharingController */
/* @var $data QuestionarioSharing */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_consegna')); ?>:</b>
	<?php echo CHtml::encode($data->data_consegna); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_restituzione')); ?>:</b>
	<?php echo CHtml::encode($data->data_restituzione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vacanza')); ?>:</b>
	<?php echo CHtml::encode($data->vacanza); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('struttura_pulizia')); ?>:</b>
	<?php echo CHtml::encode($data->struttura_pulizia); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('stuttura_complessivo')); ?>:</b>
	<?php echo CHtml::encode($data->stuttura_complessivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stanza_confort')); ?>:</b>
	<?php echo CHtml::encode($data->stanza_confort); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stanza_arredi')); ?>:</b>
	<?php echo CHtml::encode($data->stanza_arredi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stanza_pulizia')); ?>:</b>
	<?php echo CHtml::encode($data->stanza_pulizia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stanza_complessivo')); ?>:</b>
	<?php echo CHtml::encode($data->stanza_complessivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ristorante_servizio')); ?>:</b>
	<?php echo CHtml::encode($data->ristorante_servizio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ristorante_attesa')); ?>:</b>
	<?php echo CHtml::encode($data->ristorante_attesa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ristorante_cibo')); ?>:</b>
	<?php echo CHtml::encode($data->ristorante_cibo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ristorante_menu')); ?>:</b>
	<?php echo CHtml::encode($data->ristorante_menu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ristorante_complessivo')); ?>:</b>
	<?php echo CHtml::encode($data->ristorante_complessivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personale_cortesia')); ?>:</b>
	<?php echo CHtml::encode($data->personale_cortesia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personale_professionalita')); ?>:</b>
	<?php echo CHtml::encode($data->personale_professionalita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('personale_complessivo')); ?>:</b>
	<?php echo CHtml::encode($data->personale_complessivo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('consiglia')); ?>:</b>
	<?php echo CHtml::encode($data->consiglia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('suggerimenti')); ?>:</b>
	<?php echo CHtml::encode($data->suggerimenti); ?>
	<br />

	*/ ?>

</div>