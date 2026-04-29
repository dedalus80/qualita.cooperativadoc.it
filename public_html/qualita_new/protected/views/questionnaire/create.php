<?php
/* @var $this QuestionnaireController */
/* @var $model Questionnaire */

$this->breadcrumbs=array(
    'Questionari'=>array('index'),
    'Crea',
);
?>

<h1>Crea Questionario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
