<?php
/* @var $this RuoliController */
/* @var $model UtentiTipi */

$this->breadcrumbs=array(
	'Ruoli'=>array('index'),
	$model->nome=>array('view','id'=>$model->id),
	'Aggiorna',
);
?>
<h1>Modifica Ruolo #<?php echo $model->nome; ?></h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  <a type="button" class="btn btn-default" href="<?php echo $this->createUrl('ruoli/create');?>">Crea Ruolo</a>
  <a type="button" class="btn btn-default" href="<?php echo $this->createUrl('ruoli/'.$model->id);?>">Visualizza Ruolo</a>
  <a type="button" class="btn btn-default" href="<?php echo $this->createUrl('ruoli/admin');?>">Gestione Ruoli</a>
</div>

<div class="panel panel-default panel-margin ">
    <div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Modifica Ruolo <span class='orange return-block'><?= $model->nome?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>