<?php
/* @var $this DocumentiSoggiorniProceduraController */
/* @var $data DocumentiSoggiorniProcedura */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('procedura')); ?>:</b>
	<?php echo CHtml::encode($data->procedura); ?>
	<br />


</div>