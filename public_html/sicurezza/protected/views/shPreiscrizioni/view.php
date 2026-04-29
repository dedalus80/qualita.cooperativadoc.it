<?php
/* @var $this DbAzionicorrettiveController */
/* @var $model DbAzionicorrettive */

$this->breadcrumbs = array(
    'Pre Iscrizioni Sharing' => array('admin'),
    'Gestisci',
);

$this->menu = array(
    array('label' => 'Lista pre iscrizioni', 'url' => array('admin'),  'itemOptions' => array('class' => 'last'))
    
);
?>

<h1>Lista Pre Iscrizioni<span class='red'><?php echo $model->id; ?>&nbsp;&nbsp;&nbsp;&nbsp; <a href='./stampa/<?=$model->id?>'>Stampa PDF</a></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        
        'id',
        
       
        
        array(
            'name' => 'data_insert',
            'value' => $model->getItaDate($model->data_insert)
        ),
        
        array(
            'name' => 'formula',
            'value' => $model->getDettaglioFormula($model->formula,$model->campus,$model->housing)
        ),
        
        'coabitazione',
        array(
            'name' => 'data_in',
            'value' => $model->getItaDate($model->data_in)
        ),
        
        array(
            'name' => 'data_out',
            'value' => $model->getItaDate($model->data_out)
        ),
        
        'nome',
        'cognome',
        'email',
        'cellulare',
        array(
            'name' => 'sesso',
            'value' => $model->sesso=='M'? "Maschio":"Femmina"
        ),
        array(
            'name' => 'occupazione',
            'value' => $model->getSelectValue($model->occupazione,'doc_occupazioni')
        ),
        array(
            'name' => 'data_nascita',
            'value' => $model->getItaDate($model->data_nascita)
        ),
        array(
            'name' => 'luogo_nascita',
            'value' => $model->getItaDate($model->luogo_nascita)
        ),
        array(
            'name' => 'nazionalita',
            'value' => $model->getSelectValue($model->nazionalita,'doc_nazioni')
        ),
        array(
            'name' => 'conoscenza',
            'value' => $model->getSelectValue($model->conoscenza,'doc_segnalato')
        ),
        array(
            'name' => 'prima_volta',
            'value' => $model->prima_volta=='Y'? "SI":"NO"
        ),

        
        array(
            'name' => 'privacy',
            'value' => $model->privacy=='Y'? "SI":"NO"
        ),
        array(
            'name' => 'mailing',
            'value' => $model->mailing=='Y'? "SI":"NO"
        ),
        
        'note', 
    ),
));
?>
