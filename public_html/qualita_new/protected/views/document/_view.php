<?php
/* @var $this DocumentController */
/* @var $data Documents */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category_id')); ?>:</b>
	<?php echo CHtml::encode($data->category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('procedura_id')); ?>:</b>
	<?php echo CHtml::encode($data->procedura ? $data->procedura->procedura : ''); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titolo')); ?>:</b>
	<?php echo CHtml::encode($data->titolo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publication_date')); ?>:</b>
	<?php echo CHtml::encode($data->publication_date ? date('d-m-Y', strtotime($data->publication_date)) : ''); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('external_url')); ?>:</b>
	<?php echo $data->external_url ? CHtml::link(CHtml::encode($data->external_url), $data->external_url, array('target'=>'_blank', 'rel'=>'noopener')) : ''; ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('revisione')); ?>:</b>
	<?php echo CHtml::encode($data->revisione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_revisione')); ?>:</b>
	<?php echo CHtml::encode($data->data_revisione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titolo')); ?>:</b>
	<?php echo CHtml::encode($data->titolo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('redige')); ?>:</b>
	<?php echo CHtml::encode($data->redige); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('archivia')); ?>:</b>
	<?php echo CHtml::encode($data->archivia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('riesamina')); ?>:</b>
	<?php echo CHtml::encode($data->riesamina); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('autorizza')); ?>:</b>
	<?php echo CHtml::encode($data->autorizza); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('approva')); ?>:</b>
	<?php echo CHtml::encode($data->approva); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('periodicita_riesame')); ?>:</b>
	<?php echo CHtml::encode($data->periodicita_riesame); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modalita_archiviazione')); ?>:</b>
	<?php echo CHtml::encode($data->modalita_archiviazione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('luogo_archiviazione')); ?>:</b>
	<?php echo CHtml::encode($data->luogo_archiviazione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('formato')); ?>:</b>
	<?php echo CHtml::encode($data->formato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('funzione_responsabile_id')); ?>:</b>
	<?php echo CHtml::encode($data->funzione_responsabile_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_inserimento')); ?>:</b>
	<?php echo CHtml::encode($data->data_inserimento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_modifica')); ?>:</b>
	<?php echo CHtml::encode($data->data_modifica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creato_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->creato_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modificato_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->modificato_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('filename')); ?>:</b>
	<?php echo CHtml::encode($data->filename); ?>
	<br />

	*/ ?>

</div>
