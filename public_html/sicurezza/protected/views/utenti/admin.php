<?php
/* @var $this UtentiController */
/* @var $model Utenti */

$this->breadcrumbs = array(
    'Utenti' => array('admin'),
    'Gestisci',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#utenti-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class='float_left' style='width: 50%'><h1>Utenti qualita</h1></div>
<div class='float_right'><?php echo CHtml::link('Ricerca utenti', '#', array('class' => 'search-button')); ?></div>
<div class='clear'></div>

<div class="row" style="margin-bottom:0.8em;">
    <div class="col-xs-6">
        <button class="btn btn-sm" data-target="#modal-form" data-toggle="modal">
            <i class="ace-icon glyphicon glyphicon-search align-top bigger-110"></i>
            <span class="bigger-110 no-text-shadow"><?php echo CHtml::link('Ricerca utenti', '#', array('class' => 'search-button')); ?></span>
        </button>
    </div>
</div>



<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'itemsCssClass' => 'table table-striped table-bordered table-hover',
    'summaryText' => 'Totale utenti <span class=\'red\'>{count}</span> Pagina {page} di {pages}',
    'pager' => array(
        'pageSize' => 2,
        'header' => 'Vai alla pagina: ',
        'prevPageLabel' => '< Precedente',
        'nextPageLabel' => 'Prossima > ',
    ),
    'id' => 'utenti-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'user',
        'email',
        'password',
        array(
            'header' => 'test',
            'name' => 'user_type',
            'value' => array($model, 'getUserType'),
        ),
        array(
            'name' => 'user_unita',
            'value' => array($model, 'getStruttura'),
        ),
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
