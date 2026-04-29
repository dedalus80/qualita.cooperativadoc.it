<?php
$this->breadcrumbs=array('Pre Iscrizioni Facciamo l\'albero'=>array('admin'),$model->nome." ".$model->cognome =>array('view','id'=>$model->id),	'Modifica',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-book scuolaNatura'></i>&nbsp;Modifica Pre Iscrizione <span class='orange return-block'><?=$model->nome_figlio." ".$model->cognome_figlio ?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>