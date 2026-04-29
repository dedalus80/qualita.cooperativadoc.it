<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
    'Questionari'=>array('questionnaire/index'),
    'Domande'=>array('index'),
    'Crea',
);
?>

<div class="page-header">
    <h1><i class="fa fa-plus"></i> Crea Nuova Domanda</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
