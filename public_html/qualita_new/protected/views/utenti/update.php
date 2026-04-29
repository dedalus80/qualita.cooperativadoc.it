<?php
$this->breadcrumbs=array('Utenti'=>array('admin'),$model->user=>array('view','id'=>$model->id),	'Modifica',);
?>
<div class="panel panel-default panel-margin">
	<div class="panel-heading"><h2><img src="<?php echo Yii::app()->request->baseUrl; ?>/avatar/<?= $model->avatar ? $model->avatar : "default_avatar.png" ?>" class="avatar" />&nbsp;Modifica <span class='no-phone'>utente</span> <span class='orange'><?=$model->user?></span></h2></div>
    <div class="panel-body">
        <?php echo $this->renderPartial('_form', array('model' => $model, 'tagOptions' => $tagOptions)); ?>	
    </div>
</div>

<div id="modal-strutture" class="modal fade">
    <div class="modal-dialog" style='width: 400px'>
        <div class="modal-content" >
            <div class="modal-header" style='border-bottom: none!important'>
                <h4 class="modal-title" id='modal-strutture-titolo'><i class='fa fa-home'></i>&nbsp;Strutture</h4>
            </div>
            <div class="modal-body" style='padding:0px;max-height: 300px; overflow: auto'>
                <div class="bootbox-body" id="modal-strutture-testo">I am a custom dialog</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="modal-strutture-dismiss" data-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
