<?php
/* @var $this QuestionarioSharingController */
/* @var $model QuestionarioSharing */

$this->breadcrumbs = array(
    'Questionario Sharing' => array('index'),
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

<h1> Questionario Sharing <span class='red'><?php echo $model->id; ?></span>&nbsp;&nbsp;&nbsp;&nbsp; <a href='./stampa/<?=$model->id?>'>Stampa PDF</a></h1>

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
            'name' => 'struttura_pulizia',
            'value' => $model->getSelectValue($model->struttura_pulizia, "doc_giudizzi")
        ),
        array(
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
        ), array(
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
        ),
        array(
            'name' => 'personale_cortesia',
            'value' => $model->getSelectValue($model->personale_cortesia, "doc_giudizzi")
        ),
        array(
            'name' => 'personale_professionalita',
            'value' => $model->getSelectValue($model->personale_professionalita, "doc_giudizzi")
        ),
        array(
            'name' => 'personale_complessivo',
            'value' => $model->getSelectValue($model->personale_complessivo, "doc_giudizzi")
        ),
        array(
            'name' => 'consiglia',
            'value' => $model->getSelectValue($model->consiglia, "doc_consiglia")
        ),
        'suggerimenti',
    ),
));
?>
