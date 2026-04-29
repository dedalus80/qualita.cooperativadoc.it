<?php
$this->breadcrumbs=array('Pre Iscrizioni Tim'=>array('admin'),'Modifica',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-book tim'></i>&nbsp;Modifica Pre TIM <span class='orange return-block'></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>