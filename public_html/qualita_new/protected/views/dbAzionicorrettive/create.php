<?php
$this->breadcrumbs = array('Azioni non conformi' => array('admin'),'Nuova azione correttiva',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-thumbs-o-up'></i>&nbsp;azione correttiva</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model, 'strutture' => $strutture)); ?>	
    </div>
</div>


