<?php
$this->breadcrumbs = array('tipologie strutture' => array('admin'),'Nuova tipologia struttura',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-cogs'></i>&nbsp;Nuovo tipologia struttura</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>