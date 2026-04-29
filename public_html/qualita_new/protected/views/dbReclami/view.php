<?php
/* @var $this DbReclamiController */
/* @var $model DbReclami */

$this->breadcrumbs=array(
	'Reclami'=>array('index'),
	$model->id,
);
?>

<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-thumbs-o-down'></i>&nbsp;Reclamo #<span class="red"><?php echo $model->id; ?></span></h2>
    </div>
    <div class="panel-body">
		<?php $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'attributes'=>array(
				'id',
				array(
					'name' => 'canale',
					'value' => $model->getCanale($model)
				),
				'canale_altro',
				'nome',
				'cognome',
				array(
					'name' => 'tipologia',
					'value' => $model->getTipologia($model)
				),
				'nome_compilatore',
				'cognome_compilatore',
				array(
					'name' => 'unita operativa',
					'value' => Yii::app()->MyUtils->getSelectValue($model->unita_operativa, "doc_unita")
				),
				array(
					'name' => 'societa',
					'value' => $model->getSocieta($model)
				),
				array(
                    'name' => 'funzione',
                    'value' => Yii::app()->MyUtils->getSelectValue($model->funzione, "doc_funzione")
                ),
				'descrizione',
				'allegato',
				array(
					'name' => 'data_inserimento',
					'value' => Yii::app()->MyUtils->getItaDate($model->data_inserimento,"")
				),
			),
		)); ?>
		<div class="panel-footer">
            <div class="pull-right">
                <?php echo CHtml::link("<i class='fa fa-backward'></i>&nbsp;Indietro", 'javascript:history.back()', array('class' => 'btn btn-orange ')); ?>
            </div>
        </div>
    </div>
</div>
