<?php
/* @var $this ReportsController */
/* @var $model Reports */

$this->breadcrumbs=array(
	'Segnalazioni'=>array('index'),
	'Crea',
);
?>

<h1>Crea Segnalazione</h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('reports/admin');?>">Gestione Segnalazioni</a>
  	<?php if(in_array(Yii::app()->user->getState('group'), ['ADMIN','DIRECTOR'])):?>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('reports/unavailable-areas');?>">Aree / Spazi non disponibili</a>
    <?php endif;?>
</div>

<?php // $this->renderPartial('_form', array('model'=>$model)); ?>

<div class="panel panel-default panel-margin ">
    <div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Crea Segnalazione</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model'=>$model,'audit'=>$audit,'reportPictures'=>$reportPictures,'maintenancePictures'=>$maintenancePictures)); ?>	
    </div>
</div>