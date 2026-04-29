<?php
/* @var $this DbReclamiController */
/* @var $data DbReclami */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('canale')); ?>:</b>
	<?php echo CHtml::encode($data->canale); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('canale_altro')); ?>:</b>
	<?php echo CHtml::encode($data->canale_altro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cognome')); ?>:</b>
	<?php echo CHtml::encode($data->cognome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipologia')); ?>:</b>
	<?php echo CHtml::encode($data->tipologia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome_compilatore')); ?>:</b>
	<?php echo CHtml::encode($data->nome_compilatore); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cognome_compilatore')); ?>:</b>
	<?php echo CHtml::encode($data->cognome_compilatore); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unita')); ?>:</b>
	<?php echo CHtml::encode($data->unita); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('societa')); ?>:</b>
	<?php echo CHtml::encode($data->societa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('funzione')); ?>:</b>
	<?php echo CHtml::encode($data->funzione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descrizione')); ?>:</b>
	<?php echo CHtml::encode($data->descrizione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allegato')); ?>:</b>
	<?php echo CHtml::encode($data->allegato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_inserimento')); ?>:</b>
	<?php echo CHtml::encode($data->data_inserimento); ?>
	<br />

	*/ ?>

</div>