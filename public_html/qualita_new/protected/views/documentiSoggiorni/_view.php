<?php
/* @var $this DocumentiSoggiorniController */
/* @var $data DocumentiSoggiorni */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sgq')); ?>:</b>
	<?php echo CHtml::encode($data->sgq); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipologia')); ?>:</b>
	<?php echo CHtml::encode($data->tipologia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codice')); ?>:</b>
	<?php echo CHtml::encode($data->codice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero')); ?>:</b>
	<?php echo CHtml::encode($data->numero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('revisione')); ?>:</b>
	<?php echo CHtml::encode($data->revisione); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_revisione')); ?>:</b>
	<?php echo CHtml::encode($data->data_revisione); ?>
	<br />

	<?php /*
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('tempo_archiviazione')); ?>:</b>
	<?php echo CHtml::encode($data->tempo_archiviazione); ?>
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