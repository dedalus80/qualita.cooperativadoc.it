<?php
$this->breadcrumbs = array(
    'Tag utenti' => array('admin'),
    $model->nome => array('admin', 'id' => $model->id),
    'Modifica',
);
?>

<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-tags'></i>&nbsp;Modifica <span class="hidden-480">tag</span> <span class='orange'><?php echo CHtml::encode($model->nome); ?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>
