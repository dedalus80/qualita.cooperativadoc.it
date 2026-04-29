<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
    'Questionari'=>array('questionnaire/index'),
    'Domande'=>array('index'),
    'Aggiorna',
);
?>

<div class="page-header">
    <h1><i class="fa fa-pencil"></i> Aggiorna Domanda</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
