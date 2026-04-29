<?php
/* @var $this DbNonconformeController */
/* @var $model DbNonconforme */

$this->breadcrumbs = array(
    'Azioni non conformi' => array('admin'),
    'Gestisci',
);

$this->menu = array(
    array('label' => 'Lista Azioni non conformi', 'url' => array('admin')),
    array('label' => 'Inserisci Azione non conforme', 'url' => array('create'), 'itemOptions' => array('class' => 'last'))
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#db-nonconforme-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class='float_left' style='width: 75%'><h1>Azioni non conformi <?= $_SESSION['user']['user_type']==1? "<a href='./esporta'>Esporta Dati</a>":"" ?></h1></div>
<div class='float_right'><?php echo CHtml::link('Ricerca Azioni', '#', array('class' => 'search-button')); ?></div>
<div class='clear'></div>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'db-nonconforme-grid',
    'dataProvider'=>$model->search(),
    'emptyText' => 'Nessuna azione non conforme trovata',
    'summaryText' => 'Totale Azioni <span class=\'red\'>{count}</span> Pagina {page} di {pages}',
   'pager' => array(
        'pageSize' => 2,
        'header' => 'Vai alla pagina: ',
        'prevPageLabel' => '< Precedente',
        'nextPageLabel' => 'Prossima > ',
        
    ),
    'columns' => array(
        'codice',
        array(
            'name'  => 'chiusura',
            'value' => array($model,'getChiusura'),
        ),
        
        
        array(
            'name'  => 'data',
            'value' => array($model,'getDataFormated'),
        ),
        array(
            'name'  => 'data_aggiornamento',
            'value' => array($model,'getDataUpadate'),
        ),
        array(
            'name' => 'societa',
            'value' => array($model,'getSocieta'),
        ),
        array(
            'name' => 'unita_operativa',
            'value' => array($model,'getUnita'),
        ),
        
        'nome',
        'cognome',
        array('class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}{print}',
            'buttons' => array
                (
                'print' => array
                    (
                    'label' => 'Stampa scheda',
                    'imageUrl' => Yii::app()->request->baseUrl . '/assets/64fee1cc/gridview/pdf.png',
                    'url' => 'Yii::app()->createUrl("dbNonconforme/stampa", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>
