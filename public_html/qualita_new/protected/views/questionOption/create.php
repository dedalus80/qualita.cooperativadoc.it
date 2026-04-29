<?php
/* @var $this QuestionOptionController */
/* @var $model QuestionOption */

$this->breadcrumbs=array(
    'Domande'=>array('question/index'),
    'Opzioni'=>array('index'),
    'Crea',
);
?>

<div class="page-header">
    <h1><i class="fa fa-plus"></i> Crea Nuova Opzione</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
