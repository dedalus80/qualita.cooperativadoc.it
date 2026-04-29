<?php
/* @var $this DocumentProcedureController */
/* @var $model DocumentsProcedures */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documents-procedures-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">I campi con <span class="required">*</span> sono obbligatori.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php 
	// Se category_id è passato come parametro GET, lo impostiamo automaticamente per pre-selezionarlo
	$categoryId = Yii::app()->request->getQuery('category_id');
	if ($categoryId && $model->isNewRecord) {
		$model->category_id = $categoryId;
	}
	// Prepara le opzioni per la select delle categorie
	$categories = CHtml::listData(DocumentsCategory::model()->findAll(array('order' => 'name')), 'id', 'name');
	$selectedCategory = array();
	if ($model->category_id) {
		$selectedCategory = array($model->category_id => array('selected' => true));
	}
	?>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'category_id'); ?>
			<?php echo $form->dropDownList($model, 'category_id', $categories, array('empty'=>'Seleziona categoria', 'class'=>'form-control', 'options' => $selectedCategory)); ?>
			<?php echo $form->error($model,'category_id'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'procedura'); ?>
			<?php echo $form->textField($model,'procedura',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'procedura'); ?>
		</div>
	</div>

	<div class="panel-footer" style="margin-top:20px">
		<div class="pull-right">
			<?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="fa fa-edit"></i>&nbsp;Crea' : '<i class="fa fa-edit"></i>&nbsp;Aggiorna', array('type'=>'submit', 'class' => 'btn btn-orange')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->