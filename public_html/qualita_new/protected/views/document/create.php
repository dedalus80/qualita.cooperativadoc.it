<?php
/* @var $this DocumentController */
/* @var $model Documents */

$this->breadcrumbs=array(
	'Documenti'=>array('index', 'category_id'=>$categoryId),
	'Crea',
);

/*$this->menu=array(
	array('label'=>'List Documents', 'url'=>array('index')),
	array('label'=>'Manage Documents', 'url'=>array('admin')),
);*/

?>
<div class="panel panel-default panel-margin">
	<div class="panel-heading">
        <h2><i class='fa fa-file-o'></i>&nbsp; Crea Nuovo Documento</span></h2>
    </div>
	<?php echo $this->renderPartial('_form', array('model'=>$model, 'categoryId'=>$categoryId)); ?>
</div>