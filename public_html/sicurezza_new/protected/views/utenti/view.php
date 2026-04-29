<?php
/* @var $this UtentiController */
/* @var $model Utenti */

$this->breadcrumbs = array(
    'Utenti' => array('admin'),
    $model->user,
);

$this->menu = array(
    array('label' => 'Lista Utenti', 'url' => array('admin')),
    array('label' => 'Crea Utente', 'url' => array('create')),
    array('label' => 'Modifica Utenti', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Rimuovi Utenti', 'url' => '#', 'itemOptions' => array('class' => 'last'), 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Sicuro di voler rimuovere questo utente?')),
);
?>

<h1>Utente <span class='red'><?php echo $model->user; ?></span></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'user',
        'nome',
        'cognome',
        'email',
        'password',
        array(
            'name' => 'user_type',
            'value' => $model->getSelectValue($model->user_type, "utenti_tipi")
        ),
        array(
            'name' => 'user_unita',
            'value' => $model->getSelectValue($model->user_unita, "doc_unita")
        ),
    ),
));
?>
