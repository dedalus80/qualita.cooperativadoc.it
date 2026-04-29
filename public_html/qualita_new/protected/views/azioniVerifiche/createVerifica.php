<?php
$this->breadcrumbs=array('Verifica ispettiva'=>array('admin'),'Nuova verifica',);
?>
<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading"><h2><i class='fa fa-check'></i>&nbsp;Nuova verifica<span class='orange return-block'> </span></h2></div>
    <div class="panel-body " id='panel-verifica'>
        <?php echo $this->renderPartial('_formVerifica', array('model' => $model)); ?>	
    </div>
</div>