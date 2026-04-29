<?php
/* @var $this QuestionarioKeluarController */
/* @var $model QuestionarioKeluar */

$this->breadcrumbs = array(
    'Questionario Keluar' => array('index'),
    'Gestisci',
);

$this->menu = array(
    array('label' => 'Questionari Doc', 'url' => array('./questionarioDoc/admin')),
    array('label' => 'Questionari Keluar', 'url' => array('./questionarioKeluar/admin')),
    array('label' => 'Questionari Sharing', 'url' => array('./questionarioSharing/admin')),
    array('label' => 'Statistiche Questionari Doc', 'url' => array('./questionarioDoc/create')),
    array('label' => 'Statistiche Keluar', 'url' => array('./questionarioKeluar/create')),
    array('label' => 'Statistiche Sharing', 'url' => array('./questionarioSharing/create'), 'itemOptions' => array('class' => 'last')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#questionario-keluar-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<div class='float_left' style='width: 50%'><h1>Questionari <span class='red'>Keluar</span> <?= $_SESSION['user']['user_type']==1? "<a href='./esporta'>Esporta Dati</a>":"" ?> </h1></div>
<div class='float_right'><?php echo CHtml::link('Ricerca Questionari', '#', array('class' => 'search-button')); ?></div>
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
    'id' => 'questionario-keluar-grid',
    'dataProvider' => $model->search(),
    'summaryText' => 'Totale questionari <span class=\'red\'>{count}</span> Pagina {page} di {pages}',
    'pager' => array(
        'pageSize' => 2,
        'header' => 'Vai alla pagina: ',
        'prevPageLabel' => '< Precedente',
        'nextPageLabel' => 'Prossima > ',
        
    ),
    'columns' => array(
        array(
            'name' => 'data_consegna',
            'value' => array($model, 'getDataFormated'),
        ),
        'nome',
        'cognome',
        array(
            'name' => 'struttura_nome',
            'value' => array($model, 'getStruttura'),
        ),
        array(
            'name' => 'viaggio_complessivo',
            'value' => array($model, 'getGiudizioViaggio'),
        ),
        
        array('class' => 'CButtonColumn',
            'template' => '{view}{print}',
            'buttons' => array
                (
                'print' => array
                    (
                    'label' => 'Stampa scheda',
                    'imageUrl' => Yii::app()->request->baseUrl . '/assets/64fee1cc/gridview/pdf.png',
                    'url' => 'Yii::app()->createUrl("questionarioKeluar/stampa", array("id"=>$data->id))',
                ),
            ),
        ),
    ),
));
?>
