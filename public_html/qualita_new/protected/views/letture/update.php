<?php
$this->breadcrumbs=array('Lettura contatore'=>array('admin'),$model->data_lettura=>array('view','id'=>$model->id),	'Modifica',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-tachometer'></i>&nbsp;Modifica lettura contatore <span class='orange return-block'><?=$model->data_lettura?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>