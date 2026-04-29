<?php
$this->breadcrumbs=array('Iscrizione convegno '=>array('admin'),'Crea',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-book scuolaNatura'></i>&nbsp;Nuova preiscrizione</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>