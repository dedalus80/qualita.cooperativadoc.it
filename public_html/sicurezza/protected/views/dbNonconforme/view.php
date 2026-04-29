<?php
/* @var $this DbNonconformeController */
/* @var $model DbNonconforme */

$this->breadcrumbs = array(
    'Azione non conforme' => array('index'),
    $model->codice,
);

$this->menu = array(
    array('label' => 'Lista azioni non conformi', 'url' => array('admin')),
    array('label' => 'Inserisci azione non conforme', 'url' => array('create')),
    array('label' => 'Aggiorna azione non conforme', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Rimuovi azione non conforme', 'url' => '#', 'itemOptions' => array('class' => 'last'),'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Sicuro di voler rimuovere questa azione non conforme?')),
);


$path =Yii::app()->baseUrl.'/images/allegati/';

?>

<h1>Azione non conforme id: <span class='red'><?php echo $model->id; ?></span>&nbsp;&nbsp;&nbsp;&nbsp; <a href='./stampa/<?=$model->id?>'>Stampa PDF</a></h1> 


<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'codice',
        array(
            'name' => 'chiusura',
            'value' => $model->getSelectValue($model->chiusura, "doc_chiusura")
        ),
        'nome',
        'cognome',
        array(
            'name' => 'data',
            'value' =>$model->getItaDate($model->data,"")
        ),
        array(
            'name' => 'data_aggiornamento',
            'value' =>$model->getItaDate($model->data_aggiornamento,"")
        ),
        
        array(
            'name' => 'responsabile',
            'value' => $model->getSelectValue($model->responsabile, "doc_responsabile")
        ),
        array(
            'name' => 'societa',
            'value' => $model->getSelectValue($model->societa, "doc_societa")
        ),
        array(
            'name' => 'unita operativa',
            'value' => $model->getSelectValue($model->unita_operativa, "doc_unita")
        ),
        array(
            'name' => 'funzione',
            'value' => $model->getSelectValue($model->funzione, "doc_funzione")
        ),
        array(
            'name' => 'tipologia',
            'value' => $model->getSelectValue($model->tipologia, "doc_tipologia_apertura")
        ),
        'descrizione',
        'trattamento',
        array(
            'name' => 'allegato',
            'type'=>'raw',
            'value' => CHtml::link(CHtml::encode($model->allegato), $path .$model->allegato, array('target'=>'_blank')),
        ), 
    ),
));
?>
