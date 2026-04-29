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

<h1>Azione correttiva / preventiva riferimento:<span class='red'><?php echo $model->getCodice($model->codice_riferimento); ?></span></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        array(
            'name' => 'data',
            'value' =>$model->getItaDate($model->data,"")
        ),
        array(
            'name' => 'data_aggiornamento',
            'value' =>$model->getItaDate($model->data_aggiornamento,"")
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
         array(
            'name' => 'efficacia_verifica',
            'value' => $model->getEfficacia($model->verifica_efficacia)
        ),
        'trattamento',
        'allegato'
    ),
));
?>
