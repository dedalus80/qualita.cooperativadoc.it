<?php
$this->breadcrumbs=array('Verifica ispettiva '=>array('admin'), $model->codice =>array('admin','id'=>$model->id),'Modifica verifica',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-check'></i>&nbsp;Modifica <span class='no-phone'>verifica </span><span class='orange'><?= $model->codice  ?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div> 