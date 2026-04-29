<?php
$this->breadcrumbs=array(html_entity_decode('Societ&agrave;', ENT_QUOTES, 'UTF-8')=>array('admin'),$model->nome=>array('view','id'=>$model->id),	'Modifica',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-cogs'></i>&nbsp;Modifica <span class='no-phone'>societ&agrave;</span> <span class='orange'><?=$model->nome?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>