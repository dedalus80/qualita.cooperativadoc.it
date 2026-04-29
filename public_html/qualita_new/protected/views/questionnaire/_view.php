<tr>
    <td><?php echo CHtml::encode($data->id); ?></td>
    <td><?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?></td>
    <td><?php echo $data->client ? CHtml::encode($data->client->nome) : '-'; ?></td>
    <td class="text-center"><?php echo $data->is_public ? 'Sì' : 'No'; ?></td>
    <td><?php echo DateTimeHelper::formatItalianDateTime($data->created_at); ?></td>
    <td class="text-center">
        <?php echo CHtml::link('<i class="fa fa-eye"></i>', array('view','id'=>$data->id), array('class'=>'btn btn-xs btn-info','title'=>'Visualizza')); ?>
        <?php echo CHtml::link('<i class="fa fa-pencil"></i>', array('update','id'=>$data->id), array('class'=>'btn btn-xs btn-warning','title'=>'Aggiorna')); ?>
        <?php echo CHtml::link('<i class="fa fa-trash"></i>', '#', array(
            'submit'=>array('delete','id'=>$data->id),
            'confirm'=>'Sei sicuro di voler eliminare questo questionario?',
            'class'=>'btn btn-xs btn-danger',
            'title'=>'Elimina'
        )); ?>
    </td>
</tr>
