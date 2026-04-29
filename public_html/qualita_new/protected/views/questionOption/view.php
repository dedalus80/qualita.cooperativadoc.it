<?php
/* @var $this QuestionOptionController */
/* @var $model QuestionOption */

$this->breadcrumbs=array(
    'Domande'=>array('question/index'),
    'Opzioni'=>array('index'),
    $model->option_text,
);
?>

<div class="page-header">
    <h1><i class="fa fa-file-text"></i> Opzione</h1>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Dettagli Opzione</h3>
            </div>
            <div class="panel-body">

                <table class="table table-striped table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td><?php echo CHtml::encode($model->id); ?></td>
                        </tr>
                        <tr>
                            <th>Testo</th>
                            <td><?php echo CHtml::encode($model->option_text); ?></td>
                        </tr>
                        <tr>
                            <th>Valore</th>
                            <td><?php echo CHtml::encode($model->value); ?></td>
                        </tr>
                        <tr>
                            <th>Ordine</th>
                            <td><?php echo CHtml::encode($model->order); ?></td>
                        </tr>
                        <tr>
                            <th>Domanda</th>
                            <td><?php echo CHtml::encode($model->question->text); ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="form-group">
                    <?php echo CHtml::link('<i class="fa fa-pencil"></i> Aggiorna', array('update', 'id'=>$model->id), array('class'=>'btn btn-warning')); ?>
                    <?php echo CHtml::link('<i class="fa fa-trash"></i> Elimina', '#', array(
                        'submit'=>array('delete','id'=>$model->id),
                        'confirm'=>'Sei sicuro di voler eliminare questa opzione?',
                        'class'=>'btn btn-danger',
                    )); ?>
                    <?php echo CHtml::link('<i class="fa fa-arrow-left"></i> Torna alla domanda', array('question/view', 'id'=>$model->question_id), array('class'=>'btn btn-default')); ?>
                </div>

            </div>
        </div>

    </div>
</div>
