<?php
/* @var $this DbAzionicorrettiveController */
/* @var $model DbAzionicorrettive */

$this->breadcrumbs = array(
    'Richieste online Stessopiano' => array('admin'),
    'Gestisci',
);

$this->menu = array(
    array('label' => 'Lista richieste online', 'url' => array('admin'),  'itemOptions' => array('class' => 'last'))
    
);
?>

<h1>Lista Richieste online<span class='red'><?php echo $model->id; ?>&nbsp;&nbsp;&nbsp;&nbsp; <a href='./stampa/<?=$model->id?>'>Stampa PDF</a></h1>

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
            'value' => $model->getDettaglioFormula($model->camera,$model->appartamento,$model->id)
        ),
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
            'value' => $model->getSelectValue($model->occupazione,'sp_occupazione')
        ),
        array(
            'name' => 'data_nascita',
            'value' => $model->getItaDate($model->data_nascita)
        ),
        array(
            'name' => 'luogo_nascita',
            'value' => $model->luogo_nascita
        ),
        array(
            'name' => 'nazionalita',
            'value' => $model->getSelectValue($model->nazionalita,'doc_nazioni')
        ),
        array(
            'name' => 'conoscenza',
            'value' => $model->getSelectValue($model->conoscenza,'sp_conoscenza')
        ),
        array(
            'name' => 'prima_volta',
            'value' => $model->prima_volta=='Y'? "SI":"NO"
        ),
        array(
            'name' => 'livello',
            'value' => html_entity_decode($model->geLivello($model->livello,$model->id)) #$model->getSelectValue($model->livello,'sp_livello')
        ),
        array(
            'name' => 'coinquilini',
            'value' => $model->getCoinquilini($model->coinquilini,$model->id) #$model->coinquilini=='Y'? "SI":"NO"
        ),
        array(
            'name' => 'quartiere',
            'value' => $model->getQuartieri($model->quartieri)
        ),
        array(
            'name' => 'fumatore',
            'value' => $model->fumatore=='Y'? "SI":"NO"
        ),
        array(
            'name' => 'animali',
            'value' => $model->getAnimali($model->animali,$model->id) #$model->animali=='Y'? "SI":"NO"
        ),
        array(
            'name' => 'privacy',
            'value' => $model->privacy=='Y'? "SI":"NO"
        ),
        
        array(
            'name' => 'mailing',
            'value' => $model->mailing=='Y'? "SI":"NO"
        ),
        array(
            'name' => 'coabitazione',
            'value' => $model->getSelectValue($model->coabitazione,'sp_coabitazione')
        ),
        'interessato',
        'note', 
    ),
));
?>
