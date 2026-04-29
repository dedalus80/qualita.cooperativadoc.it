<?php
$this->breadcrumbs = array('Azioni reclamo' => array('admin'),'Nuova azione');
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Nuova azione reclamo</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>