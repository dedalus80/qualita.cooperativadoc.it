<?php
$this->breadcrumbs = array('Consumi Energia' => array('admin'),'Consumi energia struttura',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-plug'></i>&nbsp;Nuovi consumi energia</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>