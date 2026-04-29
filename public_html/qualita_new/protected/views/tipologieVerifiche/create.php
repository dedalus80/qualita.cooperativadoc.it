<?php
$this->breadcrumbs = array( html_entity_decode('Tipologie verifiche', ENT_QUOTES, 'UTF-8') => array('admin'), html_entity_decode('Nuova tipologie verifica', ENT_QUOTES, 'UTF-8'),);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-cogs'></i>&nbsp;Nuova tipologie verifica</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>