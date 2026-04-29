<?php
$this->breadcrumbs = array('Tipologie corsi formazione' => array('admin'),'Nuova tipologia',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-cogs'></i>&nbsp;Nuova tipologia corsi formazione</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>