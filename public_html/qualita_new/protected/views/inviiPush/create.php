<?php
$this->breadcrumbs=array('Notifiche inviate'=>array('admin'),'Nuova notifica',);
?>
<div class="panel panel-default panel-margin"> 
    <div class="panel-heading"><h2><i class='fa fa-microphone'></i>&nbsp;Nuovo Notifica <span id='contatti_invio'></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>
