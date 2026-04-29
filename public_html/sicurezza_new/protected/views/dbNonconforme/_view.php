<?php
/* @var $this DbNonconformeController */
/* @var $data DbNonconforme */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
	<?php echo CHtml::encode($data->data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('societa')); ?>:</b>
	<?php echo CHtml::encode($data->societa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unita_operativa')); ?>:</b>
	<?php echo CHtml::encode($data->unita_operativa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cognome')); ?>:</b>
	<?php echo CHtml::encode($data->cognome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('funzione')); ?>:</b>
	<?php echo CHtml::encode($data->funzione); ?>
	<br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('allegato')); ?>:</b>
	<?php echo CHtml::encode($data->allegato); ?>
	<br />
	

</div>