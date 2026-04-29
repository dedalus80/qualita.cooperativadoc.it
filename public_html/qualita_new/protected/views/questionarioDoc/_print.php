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

<h1> Questionario Doc <span class='red'><?php echo $model->id; ?></span></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'nome',
        'cognome',
       
        array(
            'name' => 'data_restituzione',
            'value' => $model->getItaDate($model->data_restituzione)
        ),
        array(
            'name' => 'vacanza',
            'value' => $model->getSelectValue($model->vacanza, "doc_giudizzi")
        ),
        array(
            'name' => 'struttura_nome',
            'value' => $model->getSelectValue($model->struttura_nome, "doc_unita")
        ),
        array(
            'name' => 'struttura_pulizia',
            'value' => $model->getSelectValue($model->struttura_pulizia, "doc_giudizzi")
        ), array(
            'name' => 'struttura_pulizia',
            'value' => $model->getSelectValue($model->struttura_pulizia, "doc_giudizzi")
        ), array(
            'name' => 'struttura_pulizia',
            'value' => $model->getSelectValue($model->struttura_pulizia, "doc_giudizzi")
        ), array(
            'name' => 'struttura_complessivo',
            'value' => $model->getSelectValue($model->struttura_complessivo, "doc_giudizzi")
        ), array(
            'name' => 'stanza_confort',
            'value' => $model->getSelectValue($model->stanza_confort, "doc_giudizzi")
        ), array(
            'name' => 'stanza_arredi',
            'value' => $model->getSelectValue($model->stanza_arredi, "doc_giudizzi")
        ), array(
            'name' => 'stanza_pulizia',
            'value' => $model->getSelectValue($model->stanza_pulizia, "doc_giudizzi")
        ),
        array(
            'name' => 'stanza_complessivo',
            'value' => $model->getSelectValue($model->stanza_complessivo, "doc_giudizzi")
        ), array(
            'name' => 'ristorante_servizio',
            'value' => $model->getSelectValue($model->ristorante_servizio, "doc_giudizzi")
        ), array(
            'name' => 'ristorante_attesa',
            'value' => $model->getSelectValue($model->ristorante_attesa, "doc_giudizzi")
        ), array(
            'name' => 'ristorante_cibo',
            'value' => $model->getSelectValue($model->ristorante_cibo, "doc_giudizzi")
        ), array(
            'name' => 'ristorante_menu',
            'value' => $model->getSelectValue($model->ristorante_menu, "doc_giudizzi")
        ), array(
            'name' => 'ristorante_complessivo',
            'value' => $model->getSelectValue($model->ristorante_complessivo, "doc_giudizzi")
        ), array(
            'name' => 'personale_cortesia',
            'value' => $model->getSelectValue($model->personale_cortesia, "doc_giudizzi")
        ),
        array(
            'name' => 'personale_professionalita',
            'value' => $model->getSelectValue($model->personale_professionalita, "doc_giudizzi")
        ), array(
            'name' => 'personale_complessivo',
            'value' => $model->getSelectValue($model->personale_complessivo, "doc_giudizzi")
        ), array(
            'name' => 'consiglia',
            'value' => $model->getSelectValue($model->consiglia, "doc_consiglia")
        ),
        'suggerimenti',
    ),
));
?>
