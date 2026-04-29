<?php
/* @var $this UtenzePresenzeController */
/* @var $data UtenzePresenze */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('struttura')); ?>:</b>
	<?php echo CHtml::encode($data->struttura); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('anno')); ?>:</b>
	<?php echo CHtml::encode($data->anno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gennaio')); ?>:</b>
	<?php echo CHtml::encode($data->gennaio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('febbraio')); ?>:</b>
	<?php echo CHtml::encode($data->febbraio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('marzo')); ?>:</b>
	<?php echo CHtml::encode($data->marzo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aprile')); ?>:</b>
	<?php echo CHtml::encode($data->aprile); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('maggio')); ?>:</b>
	<?php echo CHtml::encode($data->maggio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('giugno')); ?>:</b>
	<?php echo CHtml::encode($data->giugno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('luglio')); ?>:</b>
	<?php echo CHtml::encode($data->luglio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agosto')); ?>:</b>
	<?php echo CHtml::encode($data->agosto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('settembre')); ?>:</b>
	<?php echo CHtml::encode($data->settembre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ottobre')); ?>:</b>
	<?php echo CHtml::encode($data->ottobre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('novembre')); ?>:</b>
	<?php echo CHtml::encode($data->novembre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dicembre')); ?>:</b>
	<?php echo CHtml::encode($data->dicembre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('totale')); ?>:</b>
	<?php echo CHtml::encode($data->totale); ?>
	<br />

	*/ ?>

</div>