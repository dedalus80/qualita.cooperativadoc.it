<?php
/* @var $this QuestionnaireVersionController */
/* @var $model QuestionnaireVersion */

$this->breadcrumbs=array(
    'Questionari'=>array('questionnaire/index'),
    'Versioni'=>array('index'),
    'Versione '.$model->version_number,
);
?>

<div class="page-header">
    <h1><i class="fa fa-file-text"></i> Versione #<?php echo $model->version_number; ?></h1>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dettagli Versione - <?php if($model->isActive()): ?><span class="label label-success">Attiva</span><?php else: ?><span class="label label-default">Non attiva</span><?php endif; ?></h3>
            </div>
            <div class="panel-body">

                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td><?php echo CHtml::encode($model->id); ?></td>
                        </tr>
                        <tr>
                            <th>Versione</th>
                            <td>
                                <?php echo CHtml::encode($model->version_number); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Stato</th>
                            <td>
                                <?php if ($model->hasResponses()): ?>
                                    <span class="label label-danger">Con Risposte</span>
                                <?php else: ?>
                                    <span class="label label-success">Senza Risposte</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Questionario</th>
                            <td><?php echo CHtml::encode($model->questionnaire->title); ?></td>
                        </tr>
                        <tr>
                            <th>Descrizione</th>
                            <td><?php echo CHtml::encode($model->description); ?></td>
                        </tr>
                        <tr>
                            <th>Creato il</th>
                            <td><?php echo DateTimeHelper::formatItalianDateTimeFull($model->created_at); ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-group">
                    <?php if (!$model->isActive()): ?>
                        <?php echo CHtml::link(
                            '<i class="fa fa-check-circle"></i> Imposta come Attiva',
                            array('questionnaireVersion/setActive', 'id' => $model->id),
                            array(
                                'class' => 'btn btn-success',
                                'confirm' => 'Vuoi rendere attiva questa versione? Le altre saranno disattivate.'
                            )
                        ); ?>
                    <?php endif; ?>
                    <?php echo CHtml::link('<i class="fa fa-pencil"></i> Aggiorna', array('questionnaireSection/editFull', 'version_id' => $model->id), array('class'=>'btn btn-warning')); ?>
                    <?php //echo CHtml::link('<i class="fa fa-plus"></i> Crea Nuova Sezione', array('questionnaireSection/createFull', 'version_id' => $model->id), array('class'=>'btn btn-success')); ?>
                    <?php echo CHtml::link('<i class="fa fa-eye"></i> Anteprima Questionario', array('questionnaireVersion/preview', 'id' => $model->id), ['class'=>'btn btn-info']); ?>
                    <?php if(!$model->hasResponses() && !$model->isActive()): ?>
                        <?php echo CHtml::link('<i class="fa fa-trash"></i> Elimina Versione',
                            array('delete','id'=>$model->id),
                            array(
                                'class'=>'btn btn-danger',
                                'confirm'=>'Sei sicuro di voler eliminare questa versione?'
                            )
                        ); ?>
                    <?php endif; ?>
                    <?php echo CHtml::link('<i class="fa fa-copy"></i> Clona', array('cloneVersion', 'id'=>$model->id), array(
                        'class'=>'btn btn-info',
                        'confirm'=>'Sei sicuro di voler clonare questa versione?',
                    )); ?>
                    <?php echo CHtml::link('<i class="fa fa-arrow-left"></i> Torna all\'elenco', array('index'), array('class'=>'btn btn-default')); ?>
                </div>

            </div>
        </div>

    </div>
</div>
