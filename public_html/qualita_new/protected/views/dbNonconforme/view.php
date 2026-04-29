<?php
/* @var $this DbNonconformeController */
/* @var $model DbNonconforme */

$this->breadcrumbs = array(
    'Azione non conforme' => array('index'),
    $model->codice,
);

$path =Yii::app()->baseUrl.'/images/allegati/';

?>

<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-thumbs-o-down'></i>&nbsp;Azione non conforme id: <span class="red"><?php echo $model->codice; ?></span></h2></div>
    <div class="panel-body">
        <?php
            $this->widget('zii.widgets.CDetailView', array(
                'data' => $model,
                'attributes' => array(
                    'codice',
                    array(
                        'name' => 'chiusura',
                        'value' => Yii::app()->MyUtils->getSelectValue($model->chiusura, "doc_chiusura")
                    ),
                    'nome',
                    'cognome',
                    array(
                        'name' => 'data',
                        'value' => Yii::app()->MyUtils->getItaDate($model->data,"")
                    ),
                    array(
                        'name' => 'data_aggiornamento',
                        'value' =>Yii::app()->MyUtils->getItaDate($model->data_aggiornamento,"")
                    ),
                    
                    array(
                        'name' => 'responsabile',
                        'value' =>Yii::app()->MyUtils->getSelectValue($model->responsabile, "doc_responsabile")
                    ),
                    array(
                        'name' => 'societa',
                        'value' => Yii::app()->MyUtils->getSelectValue($model->societa, "doc_societa")
                    ),
                    array(
                        'name' => 'unita operativa',
                        'value' => Yii::app()->MyUtils->getSelectValue($model->unita_operativa, "doc_unita")
                    ),
                    array(
                        'name' => 'funzione',
                        'value' => Yii::app()->MyUtils->getSelectValue($model->funzione, "doc_funzione")
                    ),
                    array(
                        'name' => 'tipologia',
                        'value' => Yii::app()->MyUtils->getSelectValue($data->tipologia, "doc_tipologie_aperture")
                    ),
                    'descrizione',
                    'trattamento',
                    array(
                        'name' => 'allegato',
                        'type'=>'raw',
                        'value' => CHtml::link(CHtml::encode($model->allegato), $path .$model->allegato, array('target'=>'_blank')),
                    ),
                    array(
                        'name' => 'foto',
                        'type'=>'raw',
                        'value' => $model->getPicture(),
                    ),
                ),
            ));
        ?>

        <div class="panel-footer">
            <div class="pull-right">
                <?php echo CHtml::link("<i class='fa fa-backward'></i>&nbsp;Indietro", 'javascript:history.back()', array('class' => 'btn btn-orange ')); ?>
            </div>
        </div>
    </div>
</div>

<!--<h1>Azione non conforme id: <span class='red'><?php echo $model->codice; ?></span>&nbsp;&nbsp;&nbsp;&nbsp; <a href='./stampa/<?=$model->id?>'>Stampa PDF</a></h1> -->

