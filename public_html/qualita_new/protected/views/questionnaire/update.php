<?php
/* @var $this QuestionnaireController */
/* @var $model Questionnaire */

$this->breadcrumbs=array(
    'Questionari'=>array('index'),
    'Aggiorna',
);
?>

<h1>Aggiorna Questionario: <?php echo CHtml::encode($model->title); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
