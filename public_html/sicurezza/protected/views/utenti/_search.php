<?php
/* @var $this UtentiController */
/* @var $model Utenti */
/* @var $form CActiveForm */
?>


<div class="col-sm-12 widget-container-col ui-sortable" style="min-height: 127px;">
    <!-- #section:custom/widget-box.options.transparent -->
    <div class="widget-box transparent" style="opacity: 1; z-index: 0;">
        <div class="widget-header">
            <div class="widget-toolbar no-border">
               
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main padding-12 no-padding-left no-padding-right">
                 <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
            ));
    ?>
                <div class='row'>
                    <div class="col-xs-12  col-sm-6 col-md-3 col-lg-3">
				<?php echo $form->labelEx($model, 'nome'); ?>
             <?php echo $form->textField($model, 'nome',array('style'=>'width:100%; max-width:200px')); ?>							
                    </div>
                     <div class="col-xs-12  col-sm-6 col-md-3 col-lg-3">
			<?php echo $form->labelEx($model, 'cognome'); ?>
            <?php echo $form->textField($model, 'cognome'); ?>							
                    </div>
                     <div class="col-xs-12  col-sm-6 col-md-3 col-lg-3">
			<?php echo $form->labelEx($model, 'cognome'); ?>
            <?php echo $form->textField($model, 'cognome'); ?>							
                    </div>
                     <div class="col-xs-12  col-sm-6 col-md-3 col-lg-3">
			<?php echo $form->labelEx($model, 'cognome'); ?>
            <?php echo $form->textField($model, 'cognome'); ?>							
                    </div>
                    <div class="col-xs-12  col-sm-6 col-md-3 col-lg-3">
				<?php echo $form->labelEx($model, 'nome',array('with'=>'100%')); ?>
            <?php echo $form->textField($model, 'nome', array('size'=>'100%'));		?>			
                    </div>
                     <div class="col-xs-12  col-sm-6 col-md-3 col-lg-3">
			<?php echo $form->labelEx($model, 'cognome'); ?>
            <?php echo $form->textField($model, 'cognome'); ?>							
                    </div>
                     <div class="col-xs-12  col-sm-6 col-md-3 col-lg-3">
			<?php echo $form->labelEx($model, 'cognome'); ?>
            <?php echo $form->textField($model, 'cognome'); ?>							
                    </div>
                     <div class="col-xs-12  col-sm-6 col-md-3 col-lg-3">
			<?php echo $form->labelEx($model, 'cognome'); ?>
            <?php echo $form->textField($model, 'cognome'); ?>							
                    </div>
                    <div class="col-xs-12  col-sm-6 col-md-3 col-lg-3">
				<?php echo $form->labelEx($model, 'nome',array('with'=>'100%')); ?>
            <?php echo $form->textField($model, 'nome'); ?>						
                    </div>
                     <div class="col-xs-12  col-sm-6 col-md-3 col-lg-3">
			<?php echo $form->labelEx($model, 'cognome'); ?>
            <?php echo $form->textField($model, 'cognome'); ?>							
                    </div>
                     <div class="col-xs-12  col-sm-6 col-md-3 col-lg-3">
			<?php echo $form->labelEx($model, 'cognome'); ?>
            <?php echo $form->textField($model, 'cognome'); ?>							
                    </div>
                     <div class="col-xs-12  col-sm-6 col-md-3 col-lg-3">
			<?php echo $form->labelEx($model, 'cognome'); ?>
            <?php echo $form->textField($model, 'cognome'); ?>							
                    </div>
                </div>

    <div class="flaot_left big">
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'nome'); ?>
            <?php echo $form->textField($model, 'nome', array('size' => 17)); ?>
        </div>
        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'cognome'); ?>
            <?php echo $form->textField($model, 'cognome', array('size' => 17)); ?>
        </div>
        <div class='clear'></div>    
    </div>

    <div class='flaot_right big'>
        <div class="flaot_int ">
            <?php echo $form->labelEx($model, 'user'); ?>
            <?php echo $form->textField($model, 'user', array('size' => 17)); ?>
        </div>
        <div class="flaot_right_int" >
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->textField($model, 'password', array('size' => 17)); ?>
        </div>
    </div>
    <div class='clear'></div>


    <div class='flaot_left big'>
        <?php echo $form->labelEx($model, 'user_type'); ?>
        <? echo $form->dropDownList($model, "user_type", $model->selectTipi, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')); ?>
    </div>
    <div class='flaot_right big'>
        <?php echo $form->labelEx($model, 'email'); ?>
        <? echo $form->textField($model, "email", array('size' => 45)); ?>
    </div>
    <div class='clear'></div>

    <div class='flaot_left big'>
        <?php echo $form->labelEx($model, 'user_unita'); ?>
        <? echo $form->dropDownList($model, "user_unita", $model->selectUnita, array('empty' => 'Scegli', 'options' => $sel, 'class' => 'anno')); ?>
    </div>
    <div class='clear'></div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Cerca'); ?>
    </div>

    <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>

   
</div>