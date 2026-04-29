<div class="wide form">
    <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route), 'method' => 'POST', 'id' => 'search-form-int')); ?>
    
    <div class="row row-10">
         <div class="col-xs-12 col-md-3">
            <label for="" class="control-label"><?php echo $form->labelEx($model, 'centro_vacanza'); ?></label>
            <?
            $ruolo = Yii::app()->db->createCommand("SELECT ruolo,struttura FROM utenti WHERE id='" . Yii::app()->user->getId() . "'")->queryRow();
            if ($ruolo['ruolo'] == '2') {
                echo "<br><b>" . Yii::app()->db->createCommand("SELECT nome FROM _centri_vacanza WHERE id='" . $ruolo['struttura'] . "'")->queryScalar() . "</b>";
                echo $form->hiddenField($model, 'centro_vacanza', array('value' => $ruolo['struttura']));
            }
            else
                echo $form->dropDownList($model, "centro_vacanza", $model->selectCentri, array('empty' => 'Scegli', 'class' => 'form-control'));
            ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'data_invio'); ?></label>
            <div class="input-group date" >
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $form->textField($model, 'data_invio', array('class' => 'form-control hasDatepicker form-size', 'size' => '10', 'maxlength' => '10', 'id' => 'dataNascita' ,'value' =>  $model->data_invio ? $model->reverseData($model->data_invio):"")); ?>
            </div>
        </div>
        
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'turno'); ?></label>
            <? echo $form->dropDownList($model, "turno", $model->selectTurni, array('empty' => 'Scegli', 'class' => 'form-control')); ?>
        </div>
        <div class="col-xs-12 col-md-3">
            <label for="" class="c ontrol-label"><?php echo $form->labelEx($model, 'periodo'); ?></label>
            <? echo $form->dropDownList($model, "periodo", $model->selectPeriodi, array('empty' => 'Scegli', 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="row buttons" style='margin:20px 0px 10px 0px'>
        <div class="text-gray pull-right "> 
            <?php echo CHtml::link('<i class="fa fa-search"></i>Ricerca', '#', array('class' => 'btn btn-orange btn-sm open-search', 'id' => 'search-form-btn')); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- search-form -->