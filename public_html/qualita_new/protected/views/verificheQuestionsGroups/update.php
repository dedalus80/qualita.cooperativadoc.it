<?php
/* @var $this VerificheQuestionsController */

$this->breadcrumbs=array(
	'Verifiche Questions'=>array('/verificheQuestions'),
	'Update',
);

Yii::app()->clientScript->registerScript('insert', "
$('.create-button').click(function(){
	$('.insert-box').toggle();
	return false;
});
");
?>

<?php $form = $this->beginWidget('CActiveForm', array('id' => 'questions-groups-form', 'enableAjaxValidation' => false, 'action' => Yii::app()->createUrl('//verificheQuestionsGroups/update', array('id'=>$model->id)))); ?>
<div> 
    <?php //echo $form->errorSummary($model, "<i class='ti ti-alert'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi  </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    
	<?php foreach($model->questionsGroups as $group):?>
	<div class="row row-10">
		<div class="col-xs-9 col-md-9">
			<input maxlength="255" class="form-control" value="<?php echo $group['name'];?>" name="Groups[<?php echo $group['id'];?>][name]" id="Groups_<?php echo $group['id'];?>_name" type="text" />
        </div>
		<div class="col-xs-1 col-md-1">
			<input class="form-control" type="text" name="Groups[<?php echo $group['id'];?>][rank]" value="<?php echo $group['rank'];?>" />
		</div>
		<div class="col-xs-2 col-md-2">
			<a href="#" onclick="delDato(<?php echo $group['id']?>,'verificheQuestionsGroups');">Elimina</a>
		</div>
	</div>
	<?php endforeach;?>
	<br />
</div>
<div class="panel-footer">
    <div class="pull-right ">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange btn-submit-form', 'data-refer' => 'verifiche-questions-form')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

<div id="add-group-box" class="modal fade">
    <div class="modal-dialog" style="max-width: 650px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><i class='fa fa-check'></i>&nbsp; Nuova sezione</h4>
            </div>
            <div class="modal-body">
                <?php $this->renderPartial('/verificheQuestionsGroups/_form', array('vid'=>$model->id, 'model' => $gruppo)); ?>   
            </div>
            <div class="modal-footer">
                <?php echo CHtml::link('Inserisci', '#', array('class' => 'btn btn-orange btn-submit-form', 'data-refer' => 'insert-group-form')); ?>
            </div>
        </div>
    </div>
</div>