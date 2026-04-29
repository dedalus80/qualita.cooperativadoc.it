<?php
/* @var $this ReportsController */
/* @var $model Reports */

$this->breadcrumbs=array(
	'Segnalazioni'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Aggiorna',
);
?>
<h1>Modifica Segnalazione #<?php echo $model->id; ?></h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
  	<?php if(Yii::app()->user->can('Segnalazioni', 'create')):?>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('reports/create');?>">Crea Segnalazione</a>
  	<?php endif;?>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('reports/admin');?>">Elenco Segnalazioni</a>
  	<?php if(in_array(Yii::app()->user->getState('group'), ['ADMIN','DIRECTOR'])):?>
    <a type="button" class="btn btn-default" href="<?php echo $this->createUrl('reports/unavailable-areas');?>">Aree / Spazi non disponibili</a>
    <?php endif;?>
</div>

<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Modifica Segnalazione <span class='orange return-block'><?= $model->id?></span> - <?php echo $model->getHtmlStatus();?></h2></div>
    <div class="panel-body">
        <?php if(Yii::app()->user->can('Segnalazioni', 'update')):?>
        <?php echo $this->renderPartial('_form_update', array('model'=>$model,'audit'=>$audit,'reportPictures'=>$reportPictures,'maintenancePictures'=>$maintenancePictures)); ?>	
        <?php else:?>
        <?php echo $this->renderPartial('_view_report_detail', array('model'=>$model,'audit'=>$audit,'reportPictures'=>$reportPictures,'maintenancePictures'=>$maintenancePictures)); ?>	
        <?php endif;?>
    </div>
</div>
<?php if(Yii::app()->user->can('Manutenzioni', 'update')):?>
<div class="panel panel-default">
    <div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;<?php echo $audit->isNewRecord ? 'Assegna' : 'Modifica';?> Manutenzione</h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('//maintenance/_form', array('model'=>$model,'audit'=>$audit,'reportPictures'=>$reportPictures,'maintenancePictures'=>$maintenancePictures)); ?>	
    </div>
</div>
<?php endif;?>