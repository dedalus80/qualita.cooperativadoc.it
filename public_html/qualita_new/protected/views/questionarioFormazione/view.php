<?
$this->breadcrumbs = array(
    'Questionario Formazione' => array('index'),
    $model->id,
);
?>
<?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'post', 'id' => 'search-form-int')); ?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-question'></i>&nbsp; Questionario Formazione <span class='orange return-block'><?= $model->nome . " " . $model->cognome ?></h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">

            </ul>
        </div>
    </div>
    <div class="panel-body question-body">
        <div id="detail">
            <div class="row "> 
                <div class="col-xs-12 col-sm-4">
                    <?= $form->labelEx($model, 'data_corso'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->reverseDate($model->data_corso); ?></span>
                </div>
               <div class="col-xs-12 col-sm-4">
                    <?= $form->labelEx($model, 'titolo'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->titolo; ?></span>
                </div>
               <div class="col-xs-12 col-sm-4">
                    <?= $form->labelEx($model, 'tipo_corso'); ?>:&nbsp;&nbsp;<span class='bold'><?= Yii::app()->MyUtils->getSelectValue($model->tipo_corso, "doc_tipologie_formazione"); ?></span>
                </div>
            </div>
            <div class="row "> 
                <div class="col-xs-12 col-sm-4">
                    <?= $form->labelEx($model, 'nome'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->nome; ?></span>
                </div>
              <div class="col-xs-12 col-sm-4">
                    <?= $form->labelEx($model, 'cognome'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->cognome; ?></span>
                </div>
               <div class="col-xs-12 col-sm-4">
                    <?= $form->labelEx($model, 'ente_corso'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->ente_corso; ?></span>
                </div>
            </div>
            <div class="row "> 
                <div class="col-xs-12 col-sm-6">
                    <?= $form->labelEx($model, 'argomenti'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->argomenti; ?></span>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <?= $form->labelEx($model, 'suggerimenti'); ?>:&nbsp;&nbsp;<span class='bold'><?= $model->suggerimenti; ?></span>
                </div>
            </div>
        </div>
        
        <div class="row  title">
            <div class="col-xs-4"> <span class='bold'>QUESITO</span></div>
            <div class="col-xs-2 centered"> <span class='bold'>INSUFFICIENTE</span></div>
            <div class="col-xs-2 centered"> <span class='bold'>SUFFICIENTE</span></div>
            <div class="col-xs-2 centered"> <span class='bold'>BUONA</span></div>
            <div class="col-xs-2 centered"> <span class='bold'>OTTIMO</span></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'giudizio'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->giudizio == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->giudizio == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->giudizio == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->giudizio == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'corso'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->corso == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->corso == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->corso == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->corso == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'conduzione'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->conduzione == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->conduzione == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->conduzione == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->conduzione == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'spazi'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->spazi == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->spazi == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->spazi == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->spazi == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        <div class="row ">
            <div class="col-xs-4"> <span class='bold'><?= $form->labelEx($model, 'livello'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->livello == 'I' ? "<img src='".Yii::app()->request->baseUrl."/images/insufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->livello == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->livello == 'B' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->livello == 'E' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
        
        <div class="row title">
            <div class="col-xs-6"> <span class='bold'>CONSIGLEREBBE</span></div>
            <div class="col-xs-2 centered"> <span class='bold'>CERTAMENTE NO </span></div>
            <div class="col-xs-2 centered"> <span class='bold'>FORSE</span></div>
            <div class="col-xs-2 centered"> <span class='bold'>CERTAMENTE SI </span></div>
        </div>
        <div class="row " style="margin-bottom: 20px">
            <div class="col-xs-6"> <span class='bold'><?= $form->labelEx($model, 'consiglerebbe'); ?></span></div>
            <div class="col-xs-2 centered"><?= $model->consiglerebbe == 'N' ? "<img src='".Yii::app()->request->baseUrl."/images/sufficente.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->consiglerebbe == 'F' ? "<img src='".Yii::app()->request->baseUrl."/images/buono.png '>" : "" ?></div>
            <div class="col-xs-2 centered"><?= $model->consiglerebbe == 'S' ? "<img src='".Yii::app()->request->baseUrl."/images/ottimo.png '>" : "" ?></div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?> 