<?php
$this->breadcrumbs = array('Formule Housing Sharing' => array('admin'),'Nuova formula housing Sharing',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-cogs'></i>&nbsp;Nuova formula housing Sharing</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>