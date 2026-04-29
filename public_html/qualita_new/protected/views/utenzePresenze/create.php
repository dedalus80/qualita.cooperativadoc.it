<?php
$this->breadcrumbs = array('Presenze Strutture' => array('admin'),'Presenze struttura',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-users'></i>&nbsp;Nuove presenze</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>