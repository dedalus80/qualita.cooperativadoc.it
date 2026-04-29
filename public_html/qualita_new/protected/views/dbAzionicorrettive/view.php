<?php
/* @var $this DbAzionicorrettiveController */
/* @var $model DbAzionicorrettive */

$this->breadcrumbs = array(
    'Azioni correttive / preventive id: ' => array('admin'),
    $model->getCodice($model->codice_riferimento),
);

$path =Yii::app()->baseUrl.'/images/allegati/';

?> 

<!--<h1>Azione correttiva / preventiva riferimento:<span class='red'><?php echo $model->getCodice($model->codice_riferimento); ?>&nbsp;&nbsp;&nbsp;&nbsp; <a href='./stampa/<?=$model->id?>'>Stampa PDF</a></h1>-->
<div class="panel panel-default panel-margin">
    <div class="panel-heading">
        <h2><i class='fa fa-thumbs-o-down'></i>&nbsp;Azione correttiva / preventiva riferimento:<span class="red"><?php echo $model->getCodice($model->codice_riferimento); ?></span></h2>
    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'attributes' => array(
                'id',
                array(
                    'name' => 'data',
                    'value' => Yii::app()->MyUtils->getItaDate($model->data,"")
                ),
                array(
                    'name' => 'data_aggiornamento',
                    'value' => Yii::app()->MyUtils->getItaDate($model->data_aggiornamento,"")
                ),
                array(
                    'name' => 'codice_riferimento',
                    'value' => $model->getCodice($model->codice_riferimento)
                ),
                array(
                    'name' => 'tipo_azione',
                    'value' => Yii::app()->MyUtils->getSelectValue($model->tipo_azione, "doc_azione")
                ),
                'nome',
                'cognome',
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
                    'value' => Yii::app()->MyUtils->getSelectValue($model->tipologia, "doc_tipologie_aperture")
                ),
                array(
                    'name' => 'descrizione',
                    'value' => Yii::app()->MyUtils->getItaDate($model->descrizione,"")
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
        <div class="panel-footer">
            <div class="pull-right">
                <?php echo CHtml::link("<i class='fa fa-backward'></i>&nbsp;Indietro", 'javascript:history.back()', array('class' => 'btn btn-orange ')); ?>
            </div>
        </div>
    </div>
</div>
