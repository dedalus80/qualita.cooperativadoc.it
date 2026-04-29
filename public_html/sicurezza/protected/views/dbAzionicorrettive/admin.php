<?php
/* @var $this DbAzionicorrettiveController */
/* @var $model DbAzionicorrettive */

$this->breadcrumbs = array(
    'Azioni correttive Azioni preventive' => array('admin'),
    'Gestisci',
);

$this->menu = array(
    array('label' => 'Lista azioni correttive/preventive', 'url' => array('admin')),
    array('label' => 'Inserisci azione correttive/preventive', 'url' => array('create'), 'itemOptions' => array('class' => 'last'))
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#db-azionicorrettive-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class='float_left' style='width: 75%'><h1>Gestisci azioni correttive/preventive <?= $_SESSION['user']['user_type']==1? "<a href='./esporta'>Esporta Dati</a>":"" ?></h1></div>
<div class='float_right'><?php echo CHtml::link('Ricerca Azioni', '#', array('class' => 'search-button')); ?> </div>
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
    'id' => 'db-azionicorrettive-grid',
    'dataProvider' => $model->search(),
    'summaryText' => 'Totale Azioni <span class=\'red\'>{count}</span> Pagina {page} di {pages}',
    'emptyText' => 'Nessuna azione preventiva / correttiva trovata',
    'pager' => array(
        'pageSize' => 2,
        'header' => 'Vai alla pagina: ',
        'prevPageLabel' => '< Precedente',
        'nextPageLabel' => 'Prossima > ',
        
    ),
    'columns' => array(
        array(
            'name' => 'codice_riferimento',
            'value' => array($model, 'getCode'), 
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
            'value' => array($model, 'getSocieta'),
        ),
        array(
            'name' => 'unita_operativa',
            'value' => array($model, 'getUnita'),
        ),
        'nome',
        'cognome',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{delete}{print}',
            'buttons' => array
                (
                'print' => array
                    (
                    'label' => 'Stampa scheda',
                    'imageUrl' => Yii::app()->request->baseUrl . '/assets/64fee1cc/gridview/pdf.png',
                    'url' => 'Yii::app()->createUrl("dbAzionicorrettive/stampa", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>
