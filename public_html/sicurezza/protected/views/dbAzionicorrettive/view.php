<?php
/* @var $this DbAzionicorrettiveController */
/* @var $model DbAzionicorrettive */

$this->breadcrumbs = array(
    'Azioni correttive / preventive id: ' => array('admin'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Inserisci azione correttiva / preventiva', 'url' => array('create')),
    array('label' => 'Modifica azione correttiva / preventiva', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Cancella azione correttiva / preventiva', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Sicuro di voler rimuovere questa azione?')),
    array('label' => 'Gestisci azioni correttive / preventive', 'url' => array('admin'), 'itemOptions' => array('class' => 'last'))
);

$path =Yii::app()->baseUrl.'/images/allegati/';

?> 

<h1>Azione correttiva / preventiva riferimento:<span class='red'><?php echo $model->getCodice($model->codice_riferimento); ?>&nbsp;&nbsp;&nbsp;&nbsp; <a href='./stampa/<?=$model->id?>'>Stampa PDF</a></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        array(
            'name' => 'data',
            'value' => $model->getItaDate($model->data,"")
        ),
        array(
            'name' => 'data_aggiornamento',
            'value' => $model->getItaDate($model->data_aggiornamento,"")
        ),
        array(
            'name' => 'codice_riferimento',
            'value' => $model->getCodice($model->codice_riferimento)
        ),
        array(
            'name' => 'tipo_azione',
            'value' => $model->getSelectValue($model->tipo_azione, "doc_azione")
        ),
        'nome',
        'cognome',
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
        array(
            'name' => 'descrizione',
            'value' => $model->getDate($model->descrizione,"")
        ),
       'trattamento',
        array(
            'name' => 'verifica_efficacia',
            'value' => $model->getEfficacia($model->verifica_efficacia)
        ),
       array(
            'name' => 'allegato',
            'type'=>'raw',
            'value' => CHtml::link(CHtml::encode($model->allegato), $path .$model->allegato, array('target'=>'_blank')),
        ), 
    ),
));
?>
