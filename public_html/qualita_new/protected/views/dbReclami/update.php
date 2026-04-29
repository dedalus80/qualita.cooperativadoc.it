<?php
$this->breadcrumbs = array('Reclami' => array('admin'),'Modifica reclamo',);
?>
<div class="panel panel-default panel-margin ">
    <div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Modifica reclamo <span class='orange '><?= $model->codice?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model, 'strutture' => $strutture)); ?>	
    </div>
</div>