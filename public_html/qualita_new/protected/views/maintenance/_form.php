<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'maintenance-form',
	'action'=>Yii::app()->createUrl('maintenance/'.($audit->isNewRecord?'create':'update/'.$audit->id)),
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
			<?php echo $form->errorSummary($audit); ?>
		</div>
	</div>

	<?php if(Yii::app()->user->can('Manutenzioni', 'update')):?>
	<div class="row">
		<?php if(in_array(Yii::app()->user->getState('group'), ['ADMIN','DIRECTOR'])):?>
		<div class="col-xs-6">
			<?php echo $form->labelEx($audit,'user_id'); ?>
			<?php echo $form->dropDownList($audit, "user_id", CHtml::listData(Utenti::model()->findAll(['condition' => 'user_type = 12 AND FIND_IN_SET('.$model->structure_id.', user_unita)', 'order'=>'nome, cognome']), 'id', 'displayName'), array('empty' => 'Scegli...' , 'class' => 'form-control')); ?>
			<?php echo $form->error($audit,'user_id'); ?>
		</div>
		<?php elseif($audit->isNewRecord  && Yii::app()->user->getState('is_maintenance_lead') == 'Y'):?>
		<div class="col-xs-6">
			<?php echo $form->labelEx($audit,'user_id'); ?>
			<?php echo $form->dropDownList($audit, "user_id", CHtml::listData(Utenti::model()->findAll(['condition' => 'user_type = 12 AND FIND_IN_SET('.$model->structure_id.', user_unita)', 'order'=>'nome, cognome']), 'id', 'displayName'), array('empty' => 'Scegli...' , 'class' => 'form-control')); ?>
			<?php echo $form->error($audit,'user_id'); ?>
		</div>
		<?php else:?>
		<div class="col-xs-6">
			<?php echo $form->labelEx($audit,'user_id'); ?> <strong><?php echo $audit->user->nome." ".$audit->user->cognome;?></strong>
		</div>
		<?php endif;?>
	</div>

	<?php if(!$audit->isNewRecord):?>
	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($audit,'description'); ?>
			<?php echo $form->textArea($audit,'description',array('rows'=>6, 'cols'=>50, 'class' => 'form-control')); ?>
			<?php echo $form->error($audit,'description'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model, 'area_not_available'); ?>
			<?php echo $form->radioButtonList($model, 'area_not_available', [0=>'SI',1=>'NO'], ['separator'=>'&nbsp;']);?>
			<?php echo $form->error($model, 'area_not_available'); ?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model, 'escalated_to_admin');?>
			<?php echo $form->radioButtonList($model, 'escalated_to_admin', [0=>'NO',1=>'SI'], ['separator'=>'&nbsp;']);?>
			<?php echo $form->error($model, 'escalated_to_admin');?>
		</div>
	</div>

	<div class="row row-10">
		<div class="col-xs-6">
			<label for="reports_picture">Foto</label>

			<div class="row gallery">
				<?php
					if($audit->pictures) {
						//$i=1; 
						foreach($audit->pictures as $picture) {
				?>
				<div class="col-xs-6 col-md-4 image-container" id="image<?php echo $i;?>">
					<a href="<?php echo Yii::app()->createUrl('reports/picture/mp/'.$picture->picture);?>" data-lightbox="gallery" data-title="Immagine <?php echo $i;?>">
						<img src="<?php echo Yii::app()->createUrl('reports/picture/mp/'.$picture->picture);?>" alt="Immagine <?php echo $i;?>" class="img-responsive">
					</a>
					<button class="remove-image btn btn-danger btn-xs" data-image-id="<?php echo $i;?>" data-image-dir="mp" data-image-name="<?php echo $picture->picture;?>" style="position: absolute; top: 10px; right: 20px;"><i class="fa fa-trash"></i></button>
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
			<?php echo $form->labelEx($maintenancePictures, 'picture'); ?>
			<?php $this->widget('CMultiFileUpload', array(
					'name' => 'MaintenancePictures',
					'accept' => 'jpeg|jpg|gif|png',
					'duplicate' => 'File is not existed!',
					'denied' => 'Not images', // useful,
					'htmlOptions' => array(
						'style' =>'color: transparent;',
					),
				));
			?>
			<?php echo $form->error($maintenancePictures, 'picture');?>
		</div>
	</div>
	<?php endif;?>
	
	<?php if(!$audit->isNewRecord):?>
	<div class="row row-10">
		<div class="col-xs-6">
			<?php echo $form->labelEx($audit,'created_at'); ?>
			<?php echo Yii::app()->dateFormatter->format("dd/MM/yyyy HH:mm", $audit->created_at);?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-6">
			<?php echo $form->labelEx($audit,'updated_at'); ?>
			<?php echo Yii::app()->dateFormatter->format("dd/MM/yyyy HH:mm", $audit->updated_at);?>
		</div>
	</div>
	<?php endif;?>

	<input type="hidden" id="del-audit" value="" />
	<?php echo $form->hiddenField($audit, 'report_id', ['value'=>$model->id]);?>

	<?php endif;?>

	<div class="panel-footer" style="margin-top:20px">
		<div class="pull-right">
			<?php echo CHtml::htmlButton($audit->isNewRecord ? '<i class="fa fa-edit"></i>&nbsp;Assegna' : '<i class="fa fa-edit"></i>&nbsp;Aggiorna', array('type'=>'submit', 'class' => 'btn btn-orange')); ?>
			<?php echo (!$audit->isNewRecord && (in_array(Yii::app()->user->getState('group'), ['ADMIN','DIRECTOR']) || $audit->user_id == Yii::app()->user->id)) ? CHtml::htmlButton('<i class="fa fa-stop-circle-o"></i>&nbsp;Completa', ['id'=>'btn-maintenance-complete', 'type'=>'button', 'class'=>'btn btn-info']) : '';?>
			<?php echo (!$audit->isNewRecord && (in_array(Yii::app()->user->getState('group'), ['ADMIN','DIRECTOR']) || $audit->user_id == Yii::app()->user->id)) ? CHtml::htmlButton('<i class="fa fa-trash"></i>&nbsp;Elimina', ['id'=>'btn-maintenance-delete', 'type'=>'button', 'class'=>'btn btn-danger']) : '';?>
		</div>
	</div>

<?php $this->endWidget(); ?>