<?php
$this->breadcrumbs=array('Email inviate'=>array('admin'),'Nuova Email',);
?>
<div class="panel panel-default panel-margin"> 
    <div class="panel-heading"><h2><i class='fa fa-envelope'></i>&nbsp;Nuova Email</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>
