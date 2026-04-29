<?php
$this->breadcrumbs=array(html_entity_decode('Tipologia verifica', ENT_QUOTES, 'UTF-8')=>array('admin'),$model->nome=>array('admin','id'=>$model->id),'Modifica',);
?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-cogs'></i>&nbsp;Modifica <span class="hidden-480">tipologia verifica </span><span class='orange'><?=$model->nome?></span></h2>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>	
    </div>
</div>

<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-cogs'></i>&nbsp;Sezioni domande form</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', '#', array('class' => 'open-insert button-icon button-icon-orange', 'id' => 'open-group-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Nuova sezione'))); ?></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('/verificheQuestionsGroups/update', array('model' => $model, 'gruppo' => $group)); ?>	
    </div>
</div>

<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-cogs'></i>&nbsp;Domande form</h2>
        <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', '#', array('class' => 'open-insert button-icon button-icon-orange', 'id' => 'open-insert-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Nuova domanda'))); ?></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <?php echo $this->renderPartial('/verificheQuestions/update', array('model' => $model, 'domanda' => $question, 'groupQuestions' => $groupQuestions)); ?>	
    </div>
</div>