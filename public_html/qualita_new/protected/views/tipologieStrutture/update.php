<?php
$this->breadcrumbs=array('Tipologie strutture'=>array('admin'),$model->nome =>array('admin','id'=>$model->id),	'Modifica',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-cogs'></i>&nbsp;Modifica <span class='hidden-480'>tipologia struttura</span> <span class='orange return-block'><?=$model->nome?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>