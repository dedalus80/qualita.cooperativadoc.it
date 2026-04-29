<?php
/* @var $this QuestionnaireSectionController */
/* @var $model QuestionnaireSection */

$this->breadcrumbs=array(
    'Questionari'=>array('questionnaire/index'),
    'Sezioni'=>array('index'),
    'Crea',
);
?>

<div class="page-header">
    <h1><i class="fa fa-plus"></i> Crea Nuova Sezione</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
