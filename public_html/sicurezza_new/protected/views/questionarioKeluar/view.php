<?php
/* @var $this QuestionarioKeluarController */
/* @var $model QuestionarioKeluar */

$this->breadcrumbs = array(
    'Questionario Keluar' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Questionari Doc', 'url' => array('./questionarioDoc/admin')), 
    array('label' => 'Questionari Keluar', 'url' => array('./questionarioKeluar/admin')),
    array('label' => 'Questionari Sharing', 'url' => array('./questionarioSharing/admin')),
    array('label' => 'Statistiche Questionari Doc', 'url' => array('./questionarioDoc/create')),
    array('label' => 'Statistiche Keluar', 'url' => array('./questionarioKeluar/create')),
    array('label' => 'Statistiche Sharing', 'url' => array('./questionarioSharing/create'), 'itemOptions' => array('class' => 'last')),
);
?> 

<h1> Questionario Keluar <span class='red'><?php echo $model->id; ?></span>&nbsp;&nbsp;&nbsp;&nbsp; <a href='./stampa/<?=$model->id?>'>Stampa PDF</a></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'nome',
        'cognome',
        'sede_operativa',
        'scuola',
        array(
            'name' => 'data_restituzione',
            'value' => $model->getItaDate($model->data_restituzione)
        ),
        array(
            'name' => 'struttura_nome',
            'value' => $model->getSelectValue($model->struttura_nome, "doc_unita")
        ),
        array(
            'name' => 'viaggio_complessivo',
            'value' => $model->getSelectValue($model->viaggio_complessivo, "doc_giudizzi")
        ),
        array(
            'name' => 'struttura_complessivo',
            'value' => $model->getSelectValue($model->struttura_complessivo, "doc_giudizzi")
        ), array(
            'name' => 'rapporto_keluar',
            'value' => $model->getSelectValue($model->rapporto_keluar, "doc_giudizzi")
        ),
        'trasporto_nome',
        array(
            'name' => 'trasporto_qualita',
            'value' => $model->getSelectValue($model->trasporto_qualita, "doc_giudizzi")
        ), array(
            'name' => 'trasporto_cortesia',
            'value' => $model->getSelectValue($model->trasporto_cortesia, "doc_giudizzi")
        ), array(
            'name' => 'trasporto_tempi',
            'value' => $model->getSelectValue($model->trasporto_tempi, "doc_giudizzi")
        ), array(
            'name' => 'ristorante_servizio',
            'value' => $model->getSelectValue($model->ristorante_servizio, "doc_giudizzi")
        ), array(
            'name' => 'ristorante_cibo',
            'value' => $model->getSelectValue($model->ristorante_cibo, "doc_giudizzi")
        ), array(
            'name' => 'ristorante_menu',
            'value' => $model->getSelectValue($model->ristorante_menu, "doc_giudizzi")
        ), array(
            'name' => 'personale_cortesia',
            'value' => $model->getSelectValue($model->personale_cortesia, "doc_giudizzi")
        ), array(
            'name' => 'personale_disponibilita',
            'value' => $model->getSelectValue($model->personale_disponibilita, "doc_giudizzi")
        ),
        array(
            'name' => 'escursioni_itinerari',
            'value' => $model->getSelectValue($model->escursioni_itinerari, "doc_giudizzi")
        ), array(
            'name' => 'escursioni_guida',
            'value' => $model->getSelectValue($model->escursioni_guida, "doc_giudizzi")
        ), array(
            'name' => 'neve_noleggio',
            'value' => $model->getSelectValue($model->neve_noleggio, "doc_giudizzi")
        ), array(
            'name' => 'neve_scuola',
            'value' => $model->getSelectValue($model->neve_scuola, "doc_giudizzi")
        ), array(
            'name' => 'laboratori_tecnici',
            'value' => $model->getSelectValue($model->laboratori_tecnici, "doc_giudizzi")
        ), array(
            'name' => 'laboratori_competenze',
            'value' => $model->getSelectValue($model->laboratori_competenze, "doc_giudizzi")
        ),
        array(
            'name' => 'consiglia',
            'value' => $model->getSelectValue($model->consiglia, "doc_consiglia")
        ),
        'suggerimenti',
    ),
));
?>
