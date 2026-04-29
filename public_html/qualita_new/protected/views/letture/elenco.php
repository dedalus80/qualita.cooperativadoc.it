<?php
$this->breadcrumbs = array(
    'Letture contatori' => array('admin'),
    'Gestione',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
");
?>

<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading">
        <h2><i class='fa fa-tachometer'></i>&nbsp; Letture contatori</h2>
       <div class="panel-ctrls">
            <ul class="demo-btns">
                <li><?php echo CHtml::link('<i class="fa fa-plus"></i>', './create', array('class' => 'button-icon button-icon-green', 'id' => '', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiungi lettura'))); ?></li>
                <li><?php echo CHtml::link('<i class="fa fa-search"></i>', '#', array('class' => 'open-search button-icon button-icon-orange', 'id' => 'open-search-btn', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Ricerca letture'))); ?></li>
            </ul>
        </div>
    </div>
    <div class="panel-body">
        <div class="search-form" style="display:none" id="search-form-box">
            <?php $this->renderPartial('_search', array('model' => $model)); ?>
        </div><!-- search-form -->
        <table class="table table-striped table-bordered dataTable" >
            <thead>
                <tr>
                    <th class='no-phone'>Tipo</th>
					<th>Struttura</th>
					<th>Matricola</th>
					<th class='no-phone'>Ultima lettura</th>
					<th class='no-phone'>lettura</th>
					<th class='no-phone' >Differenza</th>
					<th class='centered' >Vedi</th>
					<th class='centered'>Esporta</th>
                </tr>
            </thead>
            <tbody>
                <? 
                if(count($model->letture)){
                
                for ($x = 0; $x < count($model->letture); $x++) { ?>
                    <tr>
                        <td class='no-phone'><?= $model->selectTipologie[$model->letture[$x]['tipo_matricola']] ?></td>
                        <td ><?= $model->letture[$x]['struttura'] ?></td>
                        <td><?= $model->letture[$x]['matricola'] ?>  </td>
                        <td class='no-phone'><?= $model->letture[$x]['data_lettura'] ?></td>
                        <td class='no-phone'><?= $model->letture[$x]['incremento'] ?></td>
                        <td class='no-phone'><?= $model->letture[$x]['differenza'] ?></td>
                        <td class="centered" ><a href='./view/<?= $model->letture[$x]['id_matricola'] ?>'  rel="tooltip" data-toggle="tooltip" title=""  data-original-title="Visualizza letture consumi <?= $model->selectTipologie[$model->letture[$x]['tipo_matricola']] . " " . $model->letture[$x]['struttura'] ?> "     ><i class='fa fa-search bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                        <td class="centered" ><a href='./esporta/<?= $model->letture[$x]['id_matricola'] ?>'rel="tooltip" data-toggle="tooltip" title=""  data-original-title="Scarica letture consumi <?= $model->selectTipologie[$model->letture[$x]['tipo_matricola']] . " " . $model->letture[$x]['struttura'] ?>"  ><i class='fa-download fa bigger-110 icon-only btn  btn-circle circle-blue'></i></a></td>
                    </tr>
                <? } }else{ ?>
                    <tr><td colspan='8'>Non sono presenti letture per questo contatore</td></tr>
               <? } ?>

            </tbody>
        </table>
    </div>
</div>
<div id="search-box" class="modal fade">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" ><i class='fa fa-tachometer'></i>&nbsp;&nbsp;Ricerca letture</h4>
            </div>
            <div class="modal-body">
                <?php $this->renderPartial('_search', array('model' => $model)); ?>   
            </div>
            <div class="modal-footer">
                <?php echo CHtml::link('<i class="fa fa-search"></i>&nbsp;&nbsp;Ricerca', '#', array('class' => 'btn btn-orange btn-submit-form', 'data-refer' => 'search-form-int')); ?>
            </div>
        </div>
    </div>
</div>



