<?php
$this->breadcrumbs = array('Consumi sostanze chimiche' => array('admin'), $model->struttura_nome => array('view', 'id' => $model->id), 'Modifica',);
$form = $this->beginWidget('CActiveForm', array('id' => 'utenze-chimici-form', 'enableAjaxValidation' => true, 'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));




$mesi = array("gennaio","febbraio","marzo","aprile","maggio","giugno","luglio","agosto","settembre", "ottobre", "novembre", "dicembre", "totale")

?>
<div class="panel panel-default panel-margin">
    <div class="panel-heading"><h2><i class='fa fa-flask'></i>&nbsp;Consumi sostanze chimiche  <span class='orange return-block'><?= $model->struttura_nome; ?></span> <?= $model->anno; ?></h2></div>
    <div class="panel-body">
        <table class="table table-striped table-bordered dataTable" id='consumi'>
            <thead>
                <tr>
                    <th class='left'   >Consumi Sostanze chimiche</th>
                    <? foreach($mesi as $mese){?>
                    <th  class='centered'  ><?= $form->labelEx($model, $mese) ?></th>
                    <?}?>
                   
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class='left'   >Litri</th>
                    <? foreach($mesi as $mese){?>
                    <td  class='centered'  ><?= $model->$mese > 0 ? $model->$mese :"" ?></td>
                    <?}?>
                </tr>
                <tr>
                    <th class='left'   >Euro</th>
                     <? foreach($mesi as $mese){
                         $x = "c_".$mese;
                         ?>
                    <td  class='centered'  ><?= $model->$x > 0 ? $model->$x :"" ?></td>
                    <?}?>
                </tr>
                 <tr>
                    <th class='left'   >Ospiti</th>
                     <? foreach($mesi as $mese){?>
                    <td  class='centered'  ><?= $model->utenze[$mese]  > 0 ? $model->utenze[$mese] :"" ?></td>
                    <?}?>
                   
                </tr>
                <tr>
                    <th class='left'   >&euro; / Osptite</th>
                    <? foreach($mesi as $mese){?>
                    <td  class='centered'  ><?= $model->utenze[$mese."_media_costi"] > 0  ?    number_format($model->utenze[$mese.'_media_costi'] , 2, '.', ''): ""?></td>
                    <?}?>
                    
                </tr>
                <tr>
                    <th class='left'   >Litri / Ospite</th>
                     <? foreach($mesi as $mese){?>
                    <td  class='centered'  ><?= $model->utenze[$mese."_media_consumi"] > 0  ?    number_format($model->utenze[$mese.'_media_consumi'] , 2, '.', ''): ""?></td>
                    <?}?>
                </tr>
                <tr>
                    <th class='left'   >&euro; / Mq</th>
                     <? foreach($mesi as $mese){?>
                    <td  class='centered'  ><?= $model->utenze[$mese."_media_superficie"] > 0  ?    number_format($model->utenze[$mese.'_media_superficie'] , 2, '.', ''): ""?></td>
                    <?}?>
                </tr>
                <tr>
                    <th class='left'   >Litri / Mq</th>
                     <? foreach($mesi as $mese){?>
                    <td  class='centered'  ><?= $model->utenze[$mese."_media_superficie_unita"] > 0  ?    number_format($model->utenze[$mese.'_media_superficie_unita'] , 2, '.', ''): ""?></td>
                    <?}?>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php $this->endWidget(); ?>