<?php
$this->breadcrumbs=array('Questionario Formazione'=>array('admin'),$model->id ,	'Modifica',);
?>
<div class="panel panel-default panel-margin question-body">
    <div class="panel-heading"><h2><i class='fa fa-question'></i>&nbsp;Questionario formazione <span class='orange return-block'><?=$model->id?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>