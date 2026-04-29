<?php
/* @var $this DocumentiSoggiorniController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs=array(
	'Documenti',
);

/*$this->menu=array(
	array('label'=>'Crea nuovo Documento', 'url'=>array('create', 'id'=>$proceduraId)),
	//array('label'=>'Gestisci Documenti', 'url'=>array('admin')),
);*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
");
?>

<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading">
        <h2><i class='fa fa-check'></i>&nbsp;Documenti</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-search"></i>', '#', array('class' => 'open-search button-icon button-icon-orange', 'id' => 'open-search-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Ricerca documento'))); ?></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$model->search($proceduraId),
			'itemsCssClass' => 'table table-striped table-bordered dataTable',
			'summaryText' => 'Totale <span class=\'orange\'>{count}</span> Pagina {page} di {pages}',
            'emptyText' => 'Non sono stati trovati documenti',
            'pager' => array(
                'pageSize' => 2,
				'maxButtonCount'=>3,
                'header' => '',
                'prevPageLabel' => '<i class="ace-icon fa fa-angle-left"></i> Prec',
                'nextPageLabel' => 'Pros <i class="ace-icon fa fa-angle-right"></i>  ',
                'htmlOptions' => array('class' => 'pager_class')
            ),
			'id' => 'documenti-grid',
			'columns'=>array(
				'id',
				array(
					'header'=>'Creato il',
					'name'=>'data_inserimento',
					'type'=>'raw',
					'value'=>'date("d-m-Y", strtotime($data->data_inserimento))',
				),
				array(
					'header'=>'Procedura',
					'name'=>'procedura.procedura',
					'type'=>'raw',
					'value'=>'$data->procedura->procedura',
				),
				'titolo',
				'codice',
				'numero',
				'tipologia',
				array(
					'header'=>'Funzione responsabile',
					'name'=>'funzioneResponsabile.nome',
					'type'=>'raw',
					'value'=>'$data->funzioneResponsabile->nome',
				),
				array(
					'name'  => 'Filename',
					'value' => 'CHtml::link($data->filename,Yii::app()->createUrl("DocumentiSoggiorni/download",array("id"=>$data->id)))',
					'type'  => 'raw',
				),
			),
		)); ?>
	</div>
</div>

<div id="search-box" class="modal fade">
    <div class="modal-dialog" style="max-width: 650px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><i class='fa fa-check'></i>&nbsp; Documenti</h4>
            </div>
            <div class="modal-body">
                <?php $this->renderPartial('_search', array('model' => $model)); ?>   
            </div>
            <div class="modal-footer">
                <?php echo CHtml::link('<i class="fa fa-search"></i>&nbsp;&nbsp;Ricerca', '#', array('class' => 'btn btn-orange btn-submit-form', 'data-refer' => 'search-form-int')); ?>
            </div>
        </div>
    </div>
</div>