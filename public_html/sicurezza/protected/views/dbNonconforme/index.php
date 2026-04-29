<?php
/* @var $this DbNonconformeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Azioni non conforme',
);

$this->menu=array(
	array('label'=>'Inserisci azione non conforme', 'url'=>array('create')),
	array('label'=>'Visualizza azioni non conformi', 'url'=>array('admin'),'itemOptions' => array('class' => 'last')),
);
?>

<h1>Gestione non conformita</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
        'summaryText' => 'Totale Azioni <span class=\'red\'>{count}</span> Pagina {page} di {pages}',
    'viewData' => array( 'switch' => true, 'blah' => 123 ),
    'itemView'=>'_view',
    'pager' => array(
        'pageSize' => 2,
        'header' => 'h',
        'firstPageLabel' => '<< ',
        'prevPageLabel' => '< ',
        'nextPageLabel' => '> ',
        'lastPageLabel' => '>> ',
    ),
    
    
)); ?>
