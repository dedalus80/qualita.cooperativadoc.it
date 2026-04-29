<?php
/* @var $this MatricoleController */
/* @var $data Matricole */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_struttura')); ?>:</b>
	<?php echo CHtml::encode($data->id_struttura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome_contatore')); ?>:</b>
	<?php echo CHtml::encode($data->nome_contatore); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('matricola')); ?>:</b>
	<?php echo CHtml::encode($data->matricola); ?>
	<br />


</div>