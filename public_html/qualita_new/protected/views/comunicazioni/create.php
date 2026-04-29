<?php
$this->breadcrumbs = array('Comunicazionie' => array('admin'),'Nuova comunicazione',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-microphone'></i>&nbsp;Nuova communicazione</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>