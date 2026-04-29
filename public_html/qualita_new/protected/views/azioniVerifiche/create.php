<?php
$this->breadcrumbs=array('Verifiche ispettive'=>array('admin'),'Nuova verifica ispettiva',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-check'></i>&nbsp;Nuova verifica ispettiva<span class='orange return-block'> </span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>