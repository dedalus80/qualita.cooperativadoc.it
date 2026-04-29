<?php
/* @var $this RuoliController */
/* @var $model UtentiTipi */

$this->breadcrumbs=array(
	'Ruoli'=>array('index'),
	'Crea',
);
?>
<h1>Crea Ruolo</h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  <a type="button" class="btn btn-default" href="<?php echo $this->createUrl('ruoli/admin');?>">Gestione Ruoli</a>
</div>

<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Nuovo Ruolo</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>