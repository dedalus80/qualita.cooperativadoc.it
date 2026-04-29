<?php
/* @var $this QuestionnaireSectionController */
/* @var $model QuestionnaireSection */

$this->breadcrumbs=array(
    'Questionari'=>array('questionnaire/index'),
    'Sezioni'=>array('index'),
    'Aggiorna',
);
?>

<div class="page-header">
    <h1><i class="fa fa-pencil"></i> Aggiorna Sezione: <?php echo CHtml::encode($model->title); ?></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
