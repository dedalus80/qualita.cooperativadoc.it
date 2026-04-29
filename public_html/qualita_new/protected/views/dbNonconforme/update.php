<?php
$this->breadcrumbs = array('Azioni non conformi' => array('admin'),'Modifica azione non conforme',);
?>
<div class="panel panel-default panel-margin ">
    <div class="panel-heading"><h2><i class='fa fa-thumbs-o-down'></i>&nbsp;Modifica <span class='no-phone'>azione non conforme </span><span class='only-phone'>NC </span><span class='orange '><?= $model->codice ?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model, 'strutture' => $strutture)); ?>	
    </div>
</div>