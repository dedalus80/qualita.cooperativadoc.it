<?php
$this->breadcrumbs = array('Matricole' => array('admin'),'Nuova matricola contatore',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-tachometer'></i>&nbsp;Nuova matricola contatore</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>