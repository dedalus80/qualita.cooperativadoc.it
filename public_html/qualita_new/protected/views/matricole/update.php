<?php
$this->breadcrumbs=array('Matricola'=>array('admin'),$model->matricola=>array('view','id'=>$model->id),	'Modifica',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-tachometer'></i>&nbsp;Modifica matricola contatore <span class='orange return-block'><?=$model->matricola?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>