<?php
/* @var $this ReportsController */
/* @var $model Reports */

$this->breadcrumbs=array(
	'Segnalazioni'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Dettaglio',
);
?>

<h1>Segnalazione #<?php echo $model->id; ?></h1>

<div class="btn-group row-bottom" role="group" aria-label="...">
	<?php if(Yii::app()->user->can('Segnalazioni', 'create')):?>
  	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('reports/create');?>">Crea Segnalazione</a>
  	<?php endif;?>
 	<a type="button" class="btn btn-default" href="<?php echo $this->createUrl('reports/admin');?>">Elenco Segnalazioni</a>
  	<?php if(in_array(Yii::app()->user->getState('group'), ['ADMIN','DIRECTOR'])):?>
    <a type="button" class="btn btn-default" href="<?php echo $this->createUrl('reports/unavailable-areas');?>">Aree / Spazi non disponibili</a>
    <?php endif;?>
</div>

<div class="panel panel-default panel-margin ">
	<div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Dettaglio Segnalazione <span class='orange return-block'><?= $model->id?></span> - <?php echo $model->getHtmlStatus();?></h2></div>
	<div class="panel-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'htmlOptions'=>array(
				'class'=>'table table-striped'
			),
			'attributes'=>array(
				'id',
				array (
					'name'=>'user_id',
					'type'=>'raw',
					'value'=>$model->user->nome." ".$model->user->cognome,
				),
				array (
					'name'=>'structure_id',
					'type'=>'raw',
					'value'=>Strutture::model()->findByPk($model->structure_id)->nome,
				),
				array (
					'name'=>'structure_area_id',
					'type'=>'raw',
					'value'=>$model->area->description
				),
				array (
					'name'=>'category_id',
					'value'=>$model->category->name,
				),
				'description',
				array (
					'name'=>'status',
					'type'=>'raw',
					'value'=>constant("Reports::".$model->status)
				),
				array (
					'name'=>'priority',
					'type'=>'raw',
					'value'=>$model->priority
				),
				'resolve_by',
				array (
					'name'=>'area_not_available',
					'value'=>$model->area_not_available == 1 ? 'NO' : 'SI'
				),
				array (
					'name'=>'escalated_to_admin',
					'value'=>$model->escalated_to_admin == 1 ? 'SI' : 'NO'
				),
				array (
					'name'=>'created_at',
					'type'=>'raw',
					'value'=>Yii::app()->dateFormatter->format("dd/MM/yy HH:mm", $model->created_at)
				),
				array (
					'name'=>'updated_at',
					'type'=>'raw',
					'value'=>Yii::app()->dateFormatter->format("dd/MM/yy HH:mm", $model->updated_at)
				),
			),
		)); ?>

		<?php if($model->pictures):?>
		<div class="row row-10">
			<div class="col-xs-6">
				<div class="row gallery">
					<?php $i=1; foreach($model->pictures as $picture):?>
					<div class="col-xs-6 col-md-4 image-container" id="image<?php echo $i;?>">
						<a href="<?php echo Yii::app()->createUrl('reports/picture/rp/'.$picture->picture);?>" data-lightbox="gallery" data-title="Immagine <?php echo $i;?>">
							<img src="<?php echo Yii::app()->createUrl('reports/picture/rp/'.$picture->picture);?>" alt="Immagine <?php echo $i;?>" class="img-responsive">
						</a>
					</div>
					<?php $i++; endforeach;?>
				</div>
			</div>
		</div>
		<?php endif;?>
	</div>
</div>

<?php if($model->audit):?>
<div class="panel panel-default panel-margin ">
	<div class="panel-heading"><h2><i class='fa fa-bullhorn'></i>&nbsp;Dettaglio Manutenzione</h2></div>
	<div class="panel-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model->audit,
			'htmlOptions'=>array(
				'class'=>'table table-striped'
			),
			'attributes'=>array(
				'id',
				array (
					'name'=>'user_id',
					'type'=>'raw',
					'value'=>$model->audit->user->nome." ".$model->audit->user->cognome,
				),
				'description',
				array (
					'name'=>'created_at',
					'type'=>'raw',
					'value'=>Yii::app()->dateFormatter->format("dd/MM/yy HH:mm", $model->audit->created_at)
				),
				array (
					'name'=>'updated_at',
					'type'=>'raw',
					'value'=>Yii::app()->dateFormatter->format("dd/MM/yy HH:mm", $model->audit->updated_at)
				),
			),
		)); ?>

		<?php if($model->audit->pictures):?>
		<div class="row row-10">
			<div class="col-xs-6">
				<div class="row gallery">
					<?php $i=1; foreach($model->audit->pictures as $picture):?>
					<div class="col-xs-6 col-md-4 image-container" id="image<?php echo $i;?>">
						<a href="<?php echo Yii::app()->createUrl('reports/picture/mp/'.$picture->picture);?>" data-lightbox="gallery" data-title="Immagine <?php echo $i;?>">
							<img src="<?php echo Yii::app()->createUrl('reports/picture/mp/'.$picture->picture);?>" alt="Immagine <?php echo $i;?>" class="img-responsive">
						</a>
					</div>
					<?php $i++; endforeach;?>
				</div>
			</div>
		</div>
		<?php endif;?>
		
		<?php if(in_array(Yii::app()->user->getState('group'), ['ADMIN','DIRECTOR']) && $model->status == 'closed'):?>
		<div class="panel-footer">
			<div class="pull-right">
				<button id="btn-reopen" type="button" class="btn btn-info"><i class="fa fa-edit"></i>&nbsp;Riapri manuntezione</button>
			</div>
		</div>
		<?php endif;?>
	</div>
</div>
<?php endif;?>