<?php
/* @var $this QuestionnaireVersionController */
/* @var $model QuestionnaireVersion */

$this->breadcrumbs=array(
    'Questionari'=>array('questionnaire/index'),
    'Versioni'=>array('index'),
    'Crea',
);
?>

<div class="page-header">
    <h1><i class="fa fa-plus"></i> Crea Nuova Versione</h1>
</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
