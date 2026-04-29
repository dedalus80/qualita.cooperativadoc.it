<?php
$this->breadcrumbs=array('Pre Iscrizioni TIM'=>array('admin'),$model->nome." ".$model->cognome =>array('view','id'=>$model->id),	'Modifica',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-book tim'></i>&nbsp;Modifica Pre Iscrizione <span class='orange return-block'><?=$model->nome." ".$model->cognome ?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>