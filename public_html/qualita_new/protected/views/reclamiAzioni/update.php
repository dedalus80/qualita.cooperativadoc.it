<?php
$this->breadcrumbs = array('Azioni Reclami' => array('admin'),'Modifica Azioni',);
?>
<div class="panel panel-default panel-margin ">
    <div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Modifica azione reclamo <span class='orange return-block'><?= $model->codice?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>