<?php
$this->breadcrumbs=array('Verifica ispettiva settore sicurezza'=>array('admin'), $model->codice_verifica =>array('admin','id'=>$model->id),'Modifica verifica',);
?>
<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading"><h2><i class='fa fa-check'></i>&nbsp;Modifica <span class="hidden-480">verifica settore sicurezza </span><span class='orange return-block'> <?= $model->codice_verifica  ?></span></h2></div>
    <div class="panel-body " id='panel-verifica'>
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>