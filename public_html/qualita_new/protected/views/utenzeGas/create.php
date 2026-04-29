<?php
$this->breadcrumbs = array('Consumi Gas' => array('admin'),'Consumi gas struttura',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-fire'></i>&nbsp;Nuovi consumi gas</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>