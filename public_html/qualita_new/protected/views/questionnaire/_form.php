<?php
/* @var $this QuestionnaireController */
/* @var $model Questionnaire */

$this->breadcrumbs=array(
    'Questionari'=>array('index'),
    'Crea',
);
?>

<div class="page-header">
    <h1><i class="fa fa-plus"></i> Crea Nuovo Questionario</h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dati del Questionario</h3>
            </div>
            <div class="panel-body">

                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'questionnaire-form',
                    'enableAjaxValidation'=>true,
                    'htmlOptions' => array('class'=>'form-horizontal', 'enctype'=>'multipart/form-data'),
                )); ?>

                <p class="note">I campi con <span class="required">*</span> sono obbligatori.</p>

                <?php echo $form->errorSummary($model, null, null, array('class'=>'alert alert-danger')); ?>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'title', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'title', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'description', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textArea($model,'description',array('rows'=>4,'class'=>'form-control')); ?>
                        <?php echo $form->error($model,'description', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'client_id', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php
                        $clientiList = CHtml::listData(Clienti::model()->findAll(array('order'=>'nome ASC')), 'id', 'nome');
                        echo $form->dropDownList($model, 'client_id', $clientiList, array(
                            'prompt' => 'Seleziona Cliente',
                            'class' => 'form-control',
                        ));
                        ?>
                        <?php echo $form->error($model,'client_id', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'questionnaire_type', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php
                        $questionnaireTypes = array(
                            'SP' => 'Soggiorno Partecipante',
                            'SG' => 'Soggiorno Genitore',
                            'Q' => 'Questionario',
                            'A' => 'Anonimo (dati anagrafici non richiesti)',
                            'F' => 'Formazione',
                        );
                        echo $form->dropDownList($model, 'questionnaire_type', $questionnaireTypes, array(
                            'prompt' => 'Seleziona Tipo Questionario',
                            'class' => 'form-control',
                        ));
                        ?>
                        <?php echo $form->error($model,'questionnaire_type', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'slug', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textField($model, 'slug', array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                        <?php echo $form->error($model, 'slug', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'logo', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php if (!$model->isNewRecord && !empty($model->logo)): ?>
                            <div class="mb-2">
                                <img src="<?php echo $model->getLogoUrl(); ?>" alt="Logo attuale" style="max-height: 100px; max-width: 200px;" class="img-thumbnail">
                                <br><small>Logo attuale</small>
                            </div>
                        <?php endif; ?>
                        <?php echo $form->fileField($model,'logo',array('class'=>'form-control')); ?>
                        <small class="text-muted">Formati supportati: JPG, JPEG, PNG, GIF. Dimensione massima: 1MB</small>
                        <?php echo $form->error($model,'logo', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'link_privacy', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textField($model,'link_privacy',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'https://example.com/privacy')); ?>
                        <small class="text-muted">Se lasciato vuoto, verrà utilizzato il link di default</small>
                        <?php echo $form->error($model,'link_privacy', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'footer_description', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textArea($model,'footer_description',array('rows'=>3,'class'=>'form-control','placeholder'=>'Testo da mostrare nel footer del questionario')); ?>
                        <small class="text-muted">Testo opzionale da mostrare nel footer del questionario</small>
                        <?php echo $form->error($model,'footer_description', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'is_public', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <?php echo $form->checkBox($model,'is_public'); ?> Rendi il questionario pubblico
                            </label>
                        </div>
                        <?php echo $form->error($model,'is_public', array('class'=>'text-danger')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'email_notification', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textField($model,'email_notification',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'email@example.com')); ?>
                        <small class="text-muted">Email di notifica per i risultati del questionario</small>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model,'email_contact', array('class'=>'col-sm-2 control-label')); ?>
                    <div class="col-sm-10">
                        <?php echo $form->textField($model,'email_contact',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'email@example.com')); ?>
                        <small class="text-muted">Email di contatto mostrata nella pagina di ringraziamento</small>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <?php echo CHtml::submitButton($model->isNewRecord ? 'Crea' : 'Salva', array('class'=>'btn btn-primary')); ?>
                        <?php echo CHtml::link('Annulla', array('index'), array('class'=>'btn btn-default')); ?>
                    </div>
                </div>

                <?php $this->endWidget(); ?>

            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div> <!-- row -->
