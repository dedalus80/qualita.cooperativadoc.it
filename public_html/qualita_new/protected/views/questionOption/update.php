<?php
/* @var $this QuestionOptionController */
/* @var $model QuestionOption */

$this->breadcrumbs=array(
    'Domande'=>array('question/index'),
    'Opzioni'=>array('index'),
    'Aggiorna',
);
?>

<div class="page-header">
    <h1><i class="fa fa-pencil"></i> Aggiorna Opzione</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
