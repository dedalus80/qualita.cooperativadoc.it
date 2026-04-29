<?php
/* @var $this QuestionnaireVersionController */
/* @var $model QuestionnaireVersion */

$this->breadcrumbs=array(
    'Questionari'=>array('questionnaire/index'),
    'Versioni'=>array('index'),
    'Aggiorna',
);
?>

<div class="page-header">
    <h1><i class="fa fa-pencil"></i> Aggiorna Versione #<?php echo $model->version_number; ?></h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
