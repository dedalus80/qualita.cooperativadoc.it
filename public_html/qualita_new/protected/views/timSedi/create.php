<?php
$this->breadcrumbs = array('Sedi' => array('admin'),'Nuova sede',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-cogs'></i>&nbsp;Nuova sede</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>