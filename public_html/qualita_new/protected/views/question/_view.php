<?php
/* @var $this QuestionController */
/* @var $data Question */
?>

<div class="view">

    <h3>
        <?php echo CHtml::encode($data->text); ?>
    </h3>

    <p>
        <strong>Tipo:</strong> <?php echo CHtml::encode($data->type); ?><br>
        <strong>Ordine:</strong> <?php echo CHtml::encode($data->order); ?><br>
        <strong>Creato il:</strong> <?php echo DateTimeHelper::formatItalianDateTime($data->created_at); ?>
    </p>

    <p>
        <?php echo CHtml::link('Aggiorna', array('update', 'id'=>$data->id)); ?> |
        <?php echo CHtml::link('Elimina', '#', array(
            'submit'=>array('delete','id'=>$data->id),
            'confirm'=>'Sei sicuro di voler eliminare questa domanda?'
        )); ?>
    </p>

</div>
