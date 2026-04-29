<?php $form = $this->beginWidget('CActiveForm', array('id' => 'azioni-verifiche-form', 'enableAjaxValidation' => false, 'htmlOptions' => array('enctype' => 'multipart/form-data'))); 

$model->tipo_verifica =='6' || $model->tipo_verifica =='8' ? $disabled ='' : $disabled ='disabled';
$model->tipo_verifica =='8' ? $class='col-md-3' : $class ='col-md-4';

?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    <div class="row row-10">
        <div class="col-xs-12 <?= $class ?> processo">
            <label> <?php echo $form->labelEx($model, 'unita_operativa'); ?></label>
            <?php
                if (Yii::app()->user->getState('group') == 'ADMIN')
                    echo $form->dropDownList($model, "unita_operativa", CHtml::listData(Soggiorni::model()->findAll(array('order'=> 'nome')), 'id', 'nome'), array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
                else
                    echo $form->dropDownList($model, "unita_operativa", CHtml::listData(Soggiorni::model()->findAll(array('condition' => 'id IN ('.implode(',', Yii::app()->user->getState('strutture')).')', 'order'=> 'nome')), 'id', 'nome'), array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
            ?>
        </div>
        <div class="col-xs-12 <?= $class ?> processo">
            <label><?php echo $form->labelEx($model, 'tipo_verifica'); ?></label>
            <? echo $form->dropDownList($model, "tipo_verifica", $model->selectTipologie, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control select-tipi-verifiche form-update ')); ?>
        </div>
        <div class="col-xs-12 col-md-3 processo" id='box-processi' style='display:<?= $model->tipo_verifica =='8' ? "block":"none" ?>' >
            <label><?php echo $form->labelEx($model, 'tipo_processo'); ?></label>
            <? echo $form->dropDownList($model, "tipo_processo", $model->selectProcessi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control select-tipi-processi ')); ?>
        </div>
        
        <div class="col-xs-12 <?= $class ?> processo">
            <label><?php echo $form->labelEx($model, 'incaricato'); ?></label>
            <? echo $form->dropDownList($model, "incaricato", $model->selectIncaricati, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control')); ?>
        </div>
        
    </div> 
	<div class="row row-10" id="box-dettaglio" style="display: <?= $model->tipo_verifica =='6'  ? 'block':'none' ?>">
        <div class="col-xs-12 col-md-12">
            <label> <?php echo $form->labelEx($model, 'dettaglio'); ?></label>
            <? echo $form->textArea($model, "dettaglio",  array('class' => 'form-control')); ?>
        </div>
    </div>
	<div class="row row-10 " >
        <div class="col-xs-12 col-md-4">
            <label><?php echo $form->labelEx($model, 'data_prevista'); ?></label>
            <div class="input-daterange input-group" id="datepicker-range">
				<span class="p4-10 bleft input-group-addon data-calendar field-verifiche remove-disabled" data-refer="prima_verifica" ><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data_prevista', array('class' => 'left form-control hasDatepicker richiamo', 'value' => Yii::app()->MyUtils->reverseDate($model->data_prevista))); ?>
                <span class="input-group-addon p4-10" >Al</span>
				<?php echo $form->textField($model, 'data_prevista_fine', array('class' => 'left form-control hasDatepicker richiamo', 'value' => Yii::app()->MyUtils->reverseDate($model->data_prevista_fine))); ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-2">
            <label> <?php echo $form->labelEx($model, 'data_effettiva'); ?> </label>
            <div class="input-group date" >
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 
                <?php echo $form->textField($model, 'data_effettiva', array('class' => 'form-control hasDatepicker richiamo', 'disabled' => $disabled, 'value' => Yii::app()->MyUtils->reverseDate($model->data_effettiva))); ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-2">
            <label> <?php echo $form->labelEx($model, 'non_conformita'); ?> </label>
            <?php echo $form->textField($model, 'non_conformita', array('class' => 'form-control', 'disabled' => $disabled)); ?>
        </div>
        
		<div class="col-xs-12 col-md-2">
            <label> <?php echo $form->labelEx($model, 'stato'); ?> </label>
            <?php echo $form->textField($model, 'stato', array('class' => 'form-control', 'disabled' => $disabled)); ?>
        </div>
		
		<div class="col-xs-12 col-md-2" id="box-completa" style="display: <?= $model->tipo_verifica =='6' || $model->tipo_verifica =='8' ? 'block':'none' ?>">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'completa'); ?></label>
            <div class='radio-line'><?php echo $form->radioButtonList($model, 'completa', array('Y' => '&nbsp;SI&nbsp;&nbsp;&nbsp;', 'N' => '&nbsp;NO&nbsp;&nbsp;&nbsp;'), array('labelOptions' => array('style' => 'display:inline'), 'class' => 'radio-green', 'separator' => '&nbsp&nbsp;')); ?></div>
        </div>
	</div>
    <div class="row row-10 row-bottom" >
	<div class="col-xs-12 col-sm-6">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'diario'); ?> <?= $model->diario ? "<a href='".Yii::app()->request->baseUrl."/images/diari_verifiche/".$model->diario."' target='_blank' >".$model->diario."</a>" : "" ?>   </label>
            <?php echo $form->fileField($model, 'diario', array('class' => 'form-control')); ?>
        </div>
		<div class="col-xs-12 col-sm-6">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'verbale'); ?> <?= $model->verbale ? "<a href='".Yii::app()->request->baseUrl."/images/verbali_verifiche/".$model->verbale."' target='_blank' >".$model->verbale."</a>" : "" ?>   </label>
            <?php echo $form->fileField($model, 'verbale', array('class' => 'form-control')); ?>
        </div>
	
	
	</div>
	
	<div class='row row-10 row-bottom'>
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange btn-submit-form ', 'data-refer' => 'azioni-verifiche-form')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>

