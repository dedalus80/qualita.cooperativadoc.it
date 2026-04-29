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

<?php $form = $this->beginWidget('CActiveForm', array('id' => 'verifiche-questions-form', 'enableAjaxValidation' => false, 'action' => Yii::app()->createUrl('//verificheQuestions/update', array('id'=>$model->id)))); ?>
<div> 
    <?php //echo $form->errorSummary($model, "<i class='ti ti-alert'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi  </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    
	<!--<?php //foreach($model->verificheQuestions as $question):?>
	<div class="row row-10">
		<div class="col-xs-9 col-md-9">
			<input maxlength="255" class="form-control" value="<?php //echo $question['question'];?>" name="Questions[<?php //echo $question['id'];?>][question]" id="Questions_<?php //echo $question['id'];?>_question" type="text" />
        </div>
		<div class="col-xs-1 col-md-1">
			<input class="form-control" type="text" name="Questions[<?php //echo $question['id'];?>][ordine]" value="<?php //echo $question['ordine'];?>" />
		</div>
		<div class="col-xs-2 col-md-2">
			<a href="#" onclick="delDato(<?php //echo $question['id']?>,'verificheQuestions');">Elimina</a>
		</div>
	</div>
	<?php //endforeach;?>-->

    <?php foreach($groupQuestions as $group):?>
    <div class="row">
        <h4><?php echo $group['name'];?></h4>
        <?php foreach($group->verificheQuestions as $question):?>
        <div class="row row-10">
            <div class="col-xs-8 col-xs-offset-1 col-md-8 col-md-offset-1">
                <input maxlength="255" class="form-control" value="<?php echo $question['question'];?>" name="Questions[<?php echo $question['id'];?>][question]" id="Questions_<?php echo $question['id'];?>_question" type="text" />
            </div>
            <div class="col-xs-1 col-md-1">
                <input class="form-control" type="text" name="Questions[<?php echo $question['id'];?>][ordine]" value="<?php echo $question['ordine'];?>" />
            </div>
            <div class="col-xs-1 col-md-1">
                <a href="#" onclick="delDato(<?php echo $question['id']?>,'verificheQuestions');">Elimina</a>
            </div>
        </div>
        <?php endforeach;?>
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

<div id="insert-box" class="modal fade">
    <div class="modal-dialog" style="max-width: 650px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><i class='fa fa-check'></i>&nbsp; Nuova domanda</h4>
            </div>
            <div class="modal-body">
                <?php $this->renderPartial('/verificheQuestions/_create', array('vid'=>$model->id, 'model' => $domanda)); ?>   
            </div>
            <div class="modal-footer">
                <?php echo CHtml::link('Inserisci', '#', array('class' => 'btn btn-orange btn-submit-form', 'data-refer' => 'insert-question-form')); ?>
            </div>
        </div>
    </div>
</div>