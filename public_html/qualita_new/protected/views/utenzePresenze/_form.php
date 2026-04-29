<?php $form = $this->beginWidget('CActiveForm', array('id' => 'utenze-presenze-form','enableAjaxValidation' => true,'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
 ));
?>
<div>
    <?php echo $form->errorSummary($model, "<i class='fa fa-fw fa-warning'></i>&nbsp; <strong>Attenzione!! Verificare i seguenti campi </strong> <button type='button' class='close close-summary' data-dismiss='errorSummary' aria-hidden='true'>x</button>"); ?>
    
    <? if(!$model->id){?>
    <div class="row row-10">
        <div class="col-sm-10 col-xs-12 ">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'struttura'); ?></label>
            <?php
                if (Yii::app()->user->getState('group') == 'ADMIN')
                    echo $form->dropDownList($model, "struttura", CHtml::listData(Soggiorni::model()->findAll(array('order'=> 'nome')), 'id', 'nome'), array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
                else
                    echo $form->dropDownList($model, "struttura", CHtml::listData(Soggiorni::model()->findAll(array('condition' => 'id IN ('.implode(',', Yii::app()->user->getState('strutture')).')', 'order'=> 'nome')), 'id', 'nome'), array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control'));
            ?>
        </div>
        <div class="col-sm-2 col-xs-12 ">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'anno'); ?></label>
            <? echo $form->dropDownList($model, "anno", $model->selectAnni, array('empty' => 'Scegli', 'class' => 'form-control utenza')); ?>
        </div>
    </div>
	
    <?}else{ ?>
     <div class="row row-10">
        <div class="col-xs-6 ">
            <label for="" class="c ontrol-label">Totale presenze
             <?= "<b>".$model->struttura_nome." Anno ".$model->anno."</b>  - ".$model->totale ?></label>
        </div>
    </div>
    <?} ?>
    <div class="row row-10">
        <div class="col-xs-6 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'gennaio'); ?></label>
            <?php echo $form->textField($model, 'gennaio', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-6 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'febbraio'); ?></label>
            <?php echo $form->textField($model, 'febbraio', array('class' => 'form-control')); ?>
        </div>
         <div class="col-xs-6 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'marzo'); ?></label>
            <?php echo $form->textField($model, 'marzo', array('class' => 'form-control')); ?>
        </div>
         <div class="col-xs-6 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'aprile'); ?></label>
            <?php echo $form->textField($model, 'aprile', array('class' => 'form-control')); ?>
        </div>
         <div class="col-xs-6 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'maggio'); ?></label>
            <?php echo $form->textField($model, 'maggio', array('class' => 'form-control')); ?>
        </div>
         <div class="col-xs-6 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'giugno'); ?></label>
            <?php echo $form->textField($model, 'giugno', array('class' => 'form-control')); ?>
        </div>
    </div> 
    <div class="row row-10 ">
        <div class="col-xs-6 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'luglio'); ?></label>
            <?php echo $form->textField($model, 'luglio', array('class' => 'form-control')); ?>
        </div>
        <div class="col-xs-6 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'agosto'); ?></label>
            <?php echo $form->textField($model, 'agosto', array('class' => 'form-control')); ?>
        </div>
         <div class="col-xs-6 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'settembre'); ?></label>
            <?php echo $form->textField($model, 'settembre', array('class' => 'form-control')); ?>
        </div>
         <div class="col-xs-6 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'ottobre'); ?></label>
            <?php echo $form->textField($model, 'ottobre', array('class' => 'form-control')); ?>
        </div>
         <div class="col-xs-6 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'novembre'); ?></label>
            <?php echo $form->textField($model, 'novembre', array('class' => 'form-control')); ?>
        </div>
         <div class="col-xs-6 col-md-2">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'dicembre'); ?></label>
            <?php echo $form->textField($model, 'dicembre', array('class' => 'form-control')); ?>
        </div>
    </div> 
    <div class='row row-10'>
        <div class="col-xs-12">
            <p> I campi contrasegnati con <em>*</em> sono obbligatori</p> 
        </div>
    </div>
</div>
<div class="panel-footer">
    <div class="pull-right">
        <?php echo CHtml::link($model->isNewRecord ? "<i class='fa fa-edit '></i>&nbsp;Inserisci" : "<i class='fa fa-edit '></i>&nbsp;Aggiorna", '#', array('class' => 'btn btn-orange convalida_utenza', 'id' => 'utenze-presenze-btn')); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
