<?php
$this->breadcrumbs = array('Presenze Strutture' => array('admin'), $model->struttura_nome => array('view', 'id' => $model->id), 'Modifica',);
$form = $this->beginWidget('CActiveForm', array('id' => 'utenze-presenze-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-users'></i>&nbsp;Presenze <span class='orange return-block'><?= $model->struttura_nome; ?></span> <?= $model->anno; ?></h2></div>
    <div class="panel-body">
        <table class="table table-striped table-bordered dataTable">
            <thead>
                <tr>
                    <th><?= $form->labelEx($model, 'gennaio') ?></th>
                    <th><?= $form->labelEx($model, 'febbraio') ?></th>
                    <th><?= $form->labelEx($model, 'marzo') ?></th>
                    <th><?= $form->labelEx($model, 'aprile') ?></th>
                    <th><?= $form->labelEx($model, 'maggio') ?></th>
                    <th><?= $form->labelEx($model, 'giugno') ?></th>
                    <th><?= $form->labelEx($model, 'luglio') ?></th>
                    <th><?= $form->labelEx($model, 'agosto') ?></th>
                    <th><?= $form->labelEx($model, 'settembre') ?></th>
                    <th><?= $form->labelEx($model, 'ottobre') ?></th>
                    <th><?= $form->labelEx($model, 'novembre') ?></th>
                    <th><?= $form->labelEx($model, 'dicembre') ?></th>
                    <th><?= $form->labelEx($model, 'totale') ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $model->gennaio ?></td>
                    <td><?= $model->febbraio ?></td>
                    <td><?= $model->marzo ?></td>
                    <td><?= $model->aprile ?></td>
                    <td><?= $model->maggio ?></td>
                    <td><?= $model->giugno ?></td>
                    <td><?= $model->luglio ?></td>
                    <td><?= $model->agosto ?></td>
                    <td><?= $model->settembre ?></td>
                    <td><?= $model->ottobre ?></td>
                    <td><?= $model->novembre ?></td>
                    <td><?= $model->dicembre ?></td>
                    <td><?= $model->totale ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php $this->endWidget(); ?>