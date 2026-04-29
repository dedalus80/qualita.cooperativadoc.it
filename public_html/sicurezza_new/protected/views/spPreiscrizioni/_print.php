<style>

    table.detail-view th, table.detail-view td {
        font-size: 0.9em;
        border: 1px white solid;
        padding: 0.3em 0.6em;
        vertical-align: top;
    }
    
    table.detail-view tr.even {
        background: #F8F8F8;
    }
    table.detail-view th {
        text-align: right;
        width: 250px;
        line-height: 40px;
        min-height: 30px;
        vertical-align: middle;
    }
    table.detail-view td {
        text-align: left;
        padding-left: 10px;
        width: 300px;
        line-height: 25px;
        vertical-align: middle;
    }
    h1 {

        font-size: 16px;
        font-weight: bold;
        margin-bottom: 20px;
    }
    table.detail-view tr.odd {
        background: #E5F1F4;
    }

    table.detail-view tr.odd {
        background: #ECEFF0;
    }
    .red {
        color: #D54E21;
    }
</style>

<h1>Ricerca Form Online Stessopiano :<span class='red'><?php echo $model->id; ?></span></h1>

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
            'value' => $model->getItaDate($model->luogo_nascita)
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
            'value' => $model->geLivello($model->livello,$model->id) #$model->getSelectValue($model->livello,'sp_livello')
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
