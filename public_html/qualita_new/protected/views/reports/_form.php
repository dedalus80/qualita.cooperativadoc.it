<?php
/* @var $this ReportsController */
/* @var $model Reports */
/* @var $form CActiveForm */
?>

<style>
	/* Stili personalizzati */
	.gallery img {
		width: 100%;
		height: auto;
		border-radius: 5px;
		transition: 0.3s;
	}

	.gallery img:hover {
		transform: scale(1.05);
		box-shadow: 0px 4px 10px rgba(0,0,0,0.5);
	}

	.gallery {
		margin-bottom: 30px;
	}

	.image-container {
        position: relative;
        display: inline-block;
		margin-bottom: 5px;
		margin-top: 5px;
    }

    /* Icona rimuovi immagine */
    .remove-image {
        display: none;
        position: absolute;
        z-index: 10;
    }

    /* Mostra il bottone di rimozione al passaggio del mouse */
    .image-container:hover .remove-image {
        display: block;
    }
</style>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reports-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
    ),

)); ?>

	<p class="note">I campi con <span class="required">*</span> sono obbligarori.</p>

	<div class="row">
		<div class="col-xs-12">
			<?php echo $form->errorSummary($model); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'structure_id'); ?>
			<?php
                if (Yii::app()->user->getState('group') == 'ADMIN') {
                    echo $form->dropDownList($model, "structure_id", CHtml::listData(Soggiorni::model()->findAll(['condition' => 'tipologia = 1', 'order'=> 'nome']), 'id', 'nome'), array('empty' => 'Scegli...', 'options' => $sel, 'class' => 'form-control'));
				}
				else {
                    echo $form->dropDownList($model, "structure_id", CHtml::listData(Soggiorni::model()->findAll(array('condition' => 'id IN ('.implode(',', Yii::app()->user->getState('strutture')).') AND tipologia = 1', 'order'=>'nome')), 'id', 'nome'), array('empty' => 'Scegli...', 'options' => $sel, 'class' => 'form-control'));
				}
			?>
			<?php echo $form->error($model,'structure_id'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'structure_area_id'); ?>
			<?php 
				echo $form->dropDownList(
						$model, 
						'structure_area_id', 
						CHtml::listData(
							UnitaMappaAree::model()->findAllByAttributes(
								['unita_id'=>$model->structure_id], 
								['order'=>'description']
							), 
							'id',
							'description'
						),
						array(
							'empty' => 'Scegli...', 
							'options' => $sel, 
							'class' => 'form-control select2'
						)
				); 
			?>
			<?php echo $form->error($model,'structure_area_id'); ?>
		</div>
	</div>

	<?php if(in_array(Yii::app()->user->getState('group'), ['ADMIN','DIRECTOR'])):?>
	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'user_id'); ?>
			<?php 
				echo $form->dropDownList(
						$model, 
						"user_id", 
						[],
						array(
							'empty' => 'Scegli...' ,
							'class' => 'form-control'
						)
				); 
			?>
			<?php echo $form->error($model,'user_id'); ?>
		</div>
	</div>
	<?php endif;?>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'category_id'); ?>
			<?php
				echo $form->dropDownList(
						$model, 
						'category_id', 
						CHtml::listData(
								ReportsCategory::model()->findAll(['order'=>'name']), 
								'id',
								'name'
						),
						array(
							'empty' => 'Scegli', 
							'options' => $sel, 
							'class' => 'form-control select2'
						)
				); 
			?>

			<?php //echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255, 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'category_id'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'description'); ?>
			<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'description'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'priority'); ?>
			<?php echo $form->dropDownList($model, "priority", ['5'=>'5','4'=>'4','3'=>'3','2'=>'2','1'=>'1'], array('empty' => 'Scegli', 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'priority'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model, 'resolve_by'); ?>
			<?php echo $form->textField($model, 'resolve_by', ['class'=>'form-control']);?>
			<?php echo $form->error($model, 'resolve_by');?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<label for="reports_picture">Foto</label>

			<div class="row gallery">
				<?php
					if($model->pictures) {
						$i=1; 
						foreach($model->pictures as $picture) {
				?>
				<div class="col-xs-6 col-md-4 image-container" id="image<?php echo $i;?>">
					<a href="<?php echo Yii::app()->createUrl('reports/picture/rp/'.$picture->picture);?>" data-lightbox="gallery" data-title="Immagine <?php echo $i;?>">
						<img src="<?php echo Yii::app()->createUrl('reports/picture/rp/'.$picture->picture);?>" alt="Immagine <?php echo $i;?>" class="img-responsive">
					</a>
					<button class="remove-image btn btn-danger btn-xs" data-image-id="<?php echo $i;?>" data-image-dir="rp" data-image-name="<?php echo $picture->picture;?>" style="position: absolute; top: 10px; right: 20px;"><i class="fa fa-trash"></i></button>
				</div>
				<?php 
						$i++; 
						}
					}
					else { 
				?>
				<div class="col-xs-6">
					<div class="alert alert-info">Foto non presenti</div>
				</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($reportPictures, 'picture'); ?>
			<?php $this->widget('CMultiFileUpload', array(
                    'name' => 'ReportsPictures',
                    'accept' => 'jpeg|jpg|gif|png',
                    'duplicate' => 'File is not existed!',
                    'denied' => 'Not images', // useful,
                    'htmlOptions' => array(
                        'style' =>'color: transparent;',
                    ),
                ));
  			?>
		</div>
	</div>
	
	<div class="panel-footer" style="margin-top:20px">
		<div class="pull-right">
			<?php echo CHtml::htmlButton('<i class="fa fa-edit"></i>&nbsp;Crea', array('type'=>'submit', 'class' => 'btn btn-orange')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>
				
</div><!-- form -->