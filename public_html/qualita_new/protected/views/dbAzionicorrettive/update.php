<?php
$this->breadcrumbs = array('Azioni correttiva / preventiva' => array('admin'),'Modifica azione correttiva',);
?>
<div class="panel panel-default panel-margin ">
	<div class="panel-heading"><h2><i class='fa fa-thumbs-o-up'></i>&nbsp;Modifica azione correttiva<span class='orange'><?= $model->id ?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model, 'strutture' => $strutture)); ?>	
    </div>
</div>