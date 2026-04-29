<?php
$this->breadcrumbs=array('Presenze Strutture'=>array('admin'), $model->struttura_nome => array('view','id'=>$model->id),	'Modifica',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-users'></i>&nbsp;Modifica presenze <span class='orange '><?= $model->struttura_nome;?></span> <?= $model->anno;?></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>