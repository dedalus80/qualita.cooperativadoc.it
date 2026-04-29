<?php
/* @var $this RuoliController */
/* @var $model UtentiTipi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'utenti-tipi-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">I campi con <span class="required">*</span> sono obbligarori.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'nome'); ?>
			<?php echo $form->textField($model,'nome',array('size'=>50,'maxlength'=>50, 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'nome'); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-6">
			<?php echo $form->labelEx($model,'gruppo'); ?>
			<?php echo $form->dropDownList($model, "gruppo", ['ADMIN'=>'ADMIN','DIRECTOR'=>'DIRECTOR','RESPONSIBLE'=>'RESPONSIBLE','USER'=>'USER','SEGNALATORE'=>'SEGNALATORE','MANUTENTORE'=>'MANUTENTORE'], array('empty' => 'Scegli...' , 'class' => 'form-control')); ?>
			<?php echo $form->error($model,'gruppo'); ?>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<?php echo $form->labelEx($model,'permissions'); ?>
			<table class="table">
				<tr>
					<th>Sezione</th>
					<th class="text-center">Abilita</th>
					<th class="text-center">Visualizza</th>
					<th class="text-center">Crea</th>
					<th class="text-center">Modifica</th>
					<th class="text-center">Elimina</th>
				</tr>
				
				<?php foreach($model->getPermissions() as $key => $perms):?>
				<tr>
					<td><?php echo $key;?></td>
					<td class="text-center"><?php echo $form->checkbox($model,'permissions['.$key.'][enabled]', array('value' => 1, 'checked' => ($perms['enabled']?'checked':''))); ?></td>
					<td class="text-center"><?php echo $form->checkbox($model,'permissions['.$key.'][view]', array('value' => 1, 'checked' => ($perms['view']?'checked':''))); ?></td>
					<td class="text-center"><?php echo $form->checkbox($model,'permissions['.$key.'][create]', array('value' => 1, 'checked' => ($perms['create']?'checked':''))); ?></td>
					<td class="text-center"><?php echo $form->checkbox($model,'permissions['.$key.'][update]', array('value' => 1, 'checked' => ($perms['update']?'checked':''))); ?></td>
					<td class="text-center"><?php echo $form->checkbox($model,'permissions['.$key.'][delete]', array('value' => 1, 'checked' => ($perms['delete']?'checked':''))); ?></td>
					<?php echo $form->hiddenField($model, 'permissions['.$key.'][class]', array('value' => $perms['class']));?>
					<?php echo $form->hiddenField($model, 'permissions['.$key.'][controller]', array('value' => $perms['controller']));?>
				</tr>
				<?php endforeach;?>
				
			</table>

			<?php echo $form->error($model,'permissions'); ?>
		</div>
	</div>

	<div class="panel-footer">
		<div class="pull-right">
			<?php echo CHtml::htmlButton($model->isNewRecord ? '<i class="fa fa-edit"></i>&nbsp;Crea' : '<i class="fa fa-edit"></i>&nbsp;Aggiorna', array('type'=>'submit', 'class' => 'btn btn-orange')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->