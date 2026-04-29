<?php
/* @var $this LettureController */
/* @var $data Letture */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_matricola')); ?>:</b>
	<?php echo CHtml::encode($data->id_matricola); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_lettira')); ?>:</b>
	<?php echo CHtml::encode($data->data_lettira); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('incremento')); ?>:</b>
	<?php echo CHtml::encode($data->incremento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('diffrenza')); ?>:</b>
	<?php echo CHtml::encode($data->diffrenza); ?>
	<br />


</div>