<?php
/* @var $this DocumentiSoggiorniController */
/* @var $model DocumentiSoggiorni */

$this->breadcrumbs=array(
	'Documenti Qualita'=>array('index', 'id'=>$proceduraId),
	'Crea',
);

/*$this->menu=array(
	array('label'=>'List DocumentiSoggiorni', 'url'=>array('index')),
	array('label'=>'Manage DocumentiSoggiorni', 'url'=>array('admin')),
);*/

$model->creato_da_utente = Yii::app()->user->getState('username');
$model->modificato_da_utente = "";

if($proceduraId) {
    $selectedProcedura = array($proceduraId => array('selected' => true));
}
else {
    $selectedProcedura = array();
}

?>

<div class="panel panel-default panel-margin">
	<div class="panel-heading">
        <h2><i class='fa fa-file-o'></i>&nbsp; Crea Nuovo Documento</span></h2>
        <!--<div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php //echo CHtml::link('<i class="fa fa-search"></i>', '#', array('class' => 'open-search button-icon button-icon-orange', 'id' => 'open-search-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Ricerca amministratori'))); ?></li>
                <li><?php //echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiungi amministratore'))); ?></li>
                <li><?php //echo CHtml::link('<i class="fa fa-download"></i>', './esporta', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Scarica amministratori'))); ?></li>
            </ul>
        </div>-->
    </div>
	<?php echo $this->renderPartial('_form', array('model'=>$model, 'selectedProcedura'=>$selectedProcedura)); ?>
</div>