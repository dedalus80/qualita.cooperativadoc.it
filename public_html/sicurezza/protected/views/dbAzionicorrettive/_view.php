<?php
/* @var $this DbAzionicorrettiveController */
/* @var $data DbAzionicorrettive */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
	<?php echo CHtml::encode($data->data); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_azione')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_azione); ?>
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

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('codice_riferimento')); ?>:</b>
	<?php echo CHtml::encode($data->codice_riferimento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('funzione')); ?>:</b>
	<?php echo CHtml::encode($data->funzione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipologia')); ?>:</b>
	<?php echo CHtml::encode($data->tipologia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descrizione')); ?>:</b>
	<?php echo CHtml::encode($data->descrizione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trattamento')); ?>:</b>
	<?php echo CHtml::encode($data->trattamento); ?>
	<br />

	*/ ?>

</div>