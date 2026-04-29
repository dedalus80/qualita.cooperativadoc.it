<?php
/* @var $this QuestionnaireSectionController */
/* @var $model QuestionnaireSection */

$this->breadcrumbs=array(
    'Questionari'=>array('questionnaire/index'),
    'Sezioni'=>array('index'),
    $model->title,
);
?>

<div class="page-header">
    <h1><i class="fa fa-file-text"></i> Sezione: <?php echo CHtml::encode($model->title); ?></h1>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Dettagli Sezione</h3>
            </div>
            <div class="panel-body">

                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td><?php echo CHtml::encode($model->id); ?></td>
                        </tr>
                        <tr>
                            <th>Titolo</th>
                            <td><?php echo CHtml::encode($model->title); ?></td>
                        </tr>
                        <tr>
                            <th>Ordine</th>
                            <td><?php echo CHtml::encode($model->order); ?></td>
                        </tr>
                        <tr>
                            <th>Versione</th>
                            <td><?php echo CHtml::encode($model->version->version_number); ?></td>
                        </tr>
                        <tr>
                            <th>Creato il</th>
                            <td><?php echo DateTimeHelper::formatItalianDateTimeFull($model->created_at); ?></td>
                        </tr>
                        <tr>
                            <th>Aggiornato il</th>
                            <td><?php echo DateTimeHelper::formatItalianDateTimeFull($model->updated_at); ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-group">
                    <?php echo CHtml::link('<i class="fa fa-pencil"></i> Aggiorna', array('update', 'id'=>$model->id), array('class'=>'btn btn-warning')); ?>
                    <?php echo CHtml::link('<i class="fa fa-trash"></i> Elimina', '#', array(
                        'submit'=>array('delete','id'=>$model->id),
                        'confirm'=>'Sei sicuro di voler eliminare questa sezione?',
                        'class'=>'btn btn-danger',
                    )); ?>
                    <?php echo CHtml::link('<i class="fa fa-arrow-left"></i> Torna all\'elenco', array('index'), array('class'=>'btn btn-default')); ?>
                </div>

            </div>
        </div>

    </div>
</div>
