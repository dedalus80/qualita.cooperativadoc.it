<?php
$this->breadcrumbs = array(html_entity_decode('Gruppi formazione', ENT_QUOTES, 'UTF-8') => array('admin'),html_entity_decode('Nuovo gruppo formazione', ENT_QUOTES, 'UTF-8'),);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-graduation-cap'></i>&nbsp;Nuovo gruppo formazione</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>