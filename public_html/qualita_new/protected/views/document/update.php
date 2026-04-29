<?php
/* @var $this DocumentController */
/* @var $model Documents */

$this->breadcrumbs=array(
	'Documenti'=>array('index','category_id'=>$model->category_id),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

/*$this->menu=array(
	array('label'=>'List Documents', 'url'=>array('index')),
	array('label'=>'Create Documents', 'url'=>array('create')),
	array('label'=>'View Documents', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Documents', 'url'=>array('admin')),
);*/
?>
<div class="panel panel-default panel-margin">
	<div class="panel-heading">
        <h2><i class='fa fa-file-o'></i>&nbsp; Aggiorna Documento "<?php echo $model->titolo; ?>"</span></h2>
    </div>
	<?php echo $this->renderPartial('_form', array('model'=>$model, 'categoryId'=>$model->category_id)); ?>
</div>