<?php
/* @var $this QuestionnaireSectionController */
/* @var $data QuestionnaireSection */
?>

<div class="view">

    <h3>
        <?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
    </h3>

    <p>
        <strong>Ordine:</strong> <?php echo CHtml::encode($data->order); ?><br>
        <strong>Creato il:</strong> <?php echo DateTimeHelper::formatItalianDateTime($data->created_at); ?>
    </p>

    <p>
        <?php echo CHtml::link('Aggiorna', array('update', 'id'=>$data->id)); ?> |
        <?php echo CHtml::link('Elimina', '#', array(
            'submit'=>array('delete','id'=>$data->id),
            'confirm'=>'Sei sicuro di voler eliminare questa sezione?'
        )); ?>
    </p>

</div>
