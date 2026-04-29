<?php
$this->breadcrumbs=array('Pre Iscrizioni Stessopiano'=>array('admin'),'Modifica',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-book stessoP'></i>&nbsp;Modifica Pre Iscrizione <span class='orange return-block'></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>