<?php
$this->breadcrumbs = array('Consumi Acqua' => array('admin'),'Consumi acqua struttura',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-tint'></i>&nbsp;Nuovi consumi acqua</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	 
    </div>
</div>