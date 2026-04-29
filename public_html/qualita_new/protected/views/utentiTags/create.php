<?php
$this->breadcrumbs = array(
    'Tag utenti' => array('admin'),
    'Nuovo tag',
);
?>

<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-tags'></i>&nbsp;Nuovo tag utente</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </div>
</div>
