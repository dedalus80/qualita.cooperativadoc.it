<?php
if(Yii::app()->user->getState('group') == 'ADMIN') {
    $this->breadcrumbs = array('Verifica ispettiva'=>array('admin'), $model->codice =>array('admin','id'=>$model->id),'Modifica verifica',);
}
else {
    $this->breadcrumbs = array(
                            'Verifica ispettiva'=>array('index', 'id' => $model->tipo_verifica),
                            $model->codice => array('id'=>$model->id),
                            'Modifica verifica'
                        );
}
?>
<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading"><h2><i class='fa fa-check'></i>&nbsp;Modifica <span class="hidden-480">verifica </span><span class='orange'> <?= $model->codice;?></span></h2></div>
    <div class="panel-body" id='panel-verifica'>
        <?php echo $this->renderPartial('_formVerifica', array('model' => $model, 'questions' => $questions, 'progress' => $progress)); ?>	
    </div>
</div>