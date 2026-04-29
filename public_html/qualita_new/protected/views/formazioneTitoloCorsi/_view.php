<?php
/* @var $this FormazioneTitoloCorsiController */
/* @var $data FormazioneTitoloCorsi */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titaolo_corso')); ?>:</b>
	<?php echo CHtml::encode($data->titaolo_corso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insert_date')); ?>:</b>
	<?php echo CHtml::encode($data->insert_date); ?>
	<br />


</div>