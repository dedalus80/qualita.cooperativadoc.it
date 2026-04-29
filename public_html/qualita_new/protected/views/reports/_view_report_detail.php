<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'htmlOptions'=>array(
        'class'=>'table table-striped'
    ),
    'attributes'=>array(
        'id',
        array (
            'name'=>'user_id',
            'type'=>'raw',
            'value'=>$model->user->nome." ".$model->user->cognome,
        ),
        array (
            'name'=>'structure_id',
            'type'=>'raw',
            'value'=>Strutture::model()->findByPk($model->structure_id)->nome,
        ),
        array (
            'name'=>'structure_area_id',
            'type'=>'raw',
            'value'=>$model->area->description
        ),
        'subject',
        'description',
        'site',
        array (
            'name'=>'status',
            'type'=>'raw',
            'value'=>constant("Reports::".$model->status)
        ),
        array (
            'name'=>'priority',
            'type'=>'raw',
            'value'=>($model->priority == 'normal' ? 'NORMALE' : 'URGENTE')
        ),
        array (
            'name'=>'created_at',
            'type'=>'raw',
            'value'=>Yii::app()->dateFormatter->format("dd/MM/yy HH:mm", $model->created_at)
        ),
        array (
            'name'=>'updated_at',
            'type'=>'raw',
            'value'=>Yii::app()->dateFormatter->format("dd/MM/yy HH:mm", $model->updated_at)
        ),
    ),
)); ?>

<?php if($model->pictures):?>
<div class="row row-10">
    <div class="col-xs-6">
        <div class="row gallery">
            <?php $i=1; foreach($model->pictures as $picture):?>
            <div class="col-xs-6 col-md-4 image-container" id="image<?php echo $i;?>">
                <a href="<?php echo Yii::app()->createUrl('reports/picture/rp/'.$picture->picture);?>" data-lightbox="gallery" data-title="Immagine <?php echo $i;?>">
                    <img src="<?php echo Yii::app()->createUrl('reports/picture/rp/'.$picture->picture);?>" alt="Immagine <?php echo $i;?>" class="img-responsive">
                </a>
            </div>
            <?php $i++; endforeach;?>
        </div>
    </div>
</div>
<?php endif;?>