<?php
/* @var $this DbAzionicorrettiveController */
/* @var $model DbAzionicorrettive */

$this->breadcrumbs = array(
    'Pre Iscrizioni Sharing' => array('admin'),
    'Gestisci',
);

$this->menu = array(
    array('label' => 'Lista pre iscrizioni', 'url' => array('admin'),  'itemOptions' => array('class' => 'last'))
    
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#sh-preiscrizioni-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class='float_left' style='width: 75%'><h1>Gestisci Pre Iscrizioni Sharing <?= $_SESSION['user']['id']==39 || $_SESSION['user']['id']==56 || $_SESSION['user']['id']==1? "<a href='./esporta'>Esporta Dati</a>":"" ?></h1></div>
<div class='float_right'><?php echo CHtml::link('Ricerca Pre Iscrizioni', '#', array('class' => 'search-button')); ?> </div>
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
    'id' => 'sh-preiscrizioni-grid',
    'dataProvider' => $model->search(),
    'summaryText' => 'Totale Pre Iscrizioni <span class=\'red\'>{count}</span> Pagina {page} di {pages}',
    'pager' => array(
        'pageSize' => 2,
        'header' => 'Vai alla pagina: ',
        'prevPageLabel' => '< Precedente',
        'nextPageLabel' => 'Prossima > ',
        
    ),
    'columns' => array(
        array(
            'name'  => 'data_in',
            'value' => array($model,'getDataInFormated'),
        ),
        array(
            'name'  => 'data_out',
            'value' => array($model,'getDataOutFormated'),
        ),
        
        array(
            'name'  => 'formula',
            'value' => array($model,'getFormula'),
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
                    'url' => 'Yii::app()->createUrl("shPreiscrizioni/stampa", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>
