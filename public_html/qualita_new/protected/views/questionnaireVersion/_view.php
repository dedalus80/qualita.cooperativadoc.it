<?php
/* @var $this QuestionnaireVersionController */
/* @var $data QuestionnaireVersion */
?>

<div class="view">

    <h3>
        <?php echo CHtml::link('Versione '.$data->version_number, array('view', 'id'=>$data->id)); ?>
    </h3>

    <p>
        <strong>Questionario:</strong> <?php echo CHtml::encode($data->questionnaire->title); ?><br>
        <strong>Descrizione:</strong> <?php echo CHtml::encode($data->description); ?><br>
        <strong>Creato il:</strong> <?php echo DateTimeHelper::formatItalianDateTime($data->created_at); ?>
    </p>

    <p>
        <?php echo CHtml::link('Aggiorna', array('update', 'id'=>$data->id)); ?> |
        <?php if(!$data->hasResponses() && !$data->isActive()): ?>
            <?php echo CHtml::link('Elimina', '#', array(
                'submit'=>array('delete','id'=>$data->id),
                'confirm'=>'Sei sicuro di voler eliminare questa versione?'
            )); ?> |
        <?php endif; ?>
        <?php echo CHtml::link('Clona Versione', array('cloneVersion', 'id'=>$data->id), array(
            'confirm'=>'Sei sicuro di voler clonare questa versione?',
        )); ?>
    </p>

</div>
