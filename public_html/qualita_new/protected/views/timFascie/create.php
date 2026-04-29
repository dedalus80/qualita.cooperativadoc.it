<?php
$this->breadcrumbs = array('Fascie di reddito' => array('admin'),'Nuovo fascia di reddito',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-cogs'></i>&nbsp;Nuovo fascia di reddito</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>