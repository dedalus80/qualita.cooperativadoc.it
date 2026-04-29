<style>
    .errorMessage{color:darkred}
    th {background-color:#7f190e !important; color: #fff !important;}
</style>

<div class="py-5 text-left">
    <img class="d-block mx-auto mb-4" src="<?php echo Yii::app()->request->baseUrl ."/images/survey/keluar_logo_21.png";?>" alt="" width="150">
    <h3>Questionario di gradimento Genitori</h3>
    <p class="lead">Gentile genitore,<br />con l'obiettivo di conoscere la sua valutazione in merito al Soggiorno estivo cui ha partecipato sua/o figlia/o, Le chiediamo di compilare questo breve questionario. La sua valutazione ed eventuali osservazioni che vorrà comunicarci nella sezione "NOTE", saranno considerate con massima attenzione per migliorare il servizio futuro.<br /><br />La ringraziamo per la fiducia accordataci e le inviamo i nostri migliori saluti.</p>
</div>

<?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'survey-form',
        'enableAjaxValidation' => true,
        'enableClientValidation'=> false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            //'validateOnChange' => true,
            'errorCssClass' => 'has-error',
            'successCssClass' => 'has-success',
        ),
        'method' => 'post',
));?>

<div class="row g-3">
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="3"><?php echo Yii::t('survey', 'title.parent.section1');?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'nome'); ?>
                        <?php echo $form->textField($model, 'nome', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'nome');?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model, 'cognome'); ?>
                        <?php echo $form->textField($model, 'cognome', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'cognome');?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model, 'eta'); ?>
                        <?php echo $form->dropDownList($model, "eta", SurveyParents::getParticipantAges(), array('empty' => 'Scegli', 'class' => 'form-select'));?>
                        <?php echo $form->error($model, 'eta');?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'nome_coordinatore'); ?>
                        <?php echo $form->textField($model, 'nome_coordinatore', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'nome_coordinatore');?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model, 'cognome_coordinatore'); ?>
                        <?php echo $form->textField($model, 'cognome_coordinatore', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'cognome_coordinatore');?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model, 'email_genitore'); ?>
                        <?php echo $form->textField($model, 'email_genitore', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'email_genitore');?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'organizzatore'); ?>
                        <?php echo $form->dropDownList($model, "organizzatore", CHtml::listData(Clienti::model()->findAll(['order'=>'nome']),'id','nome'), array('empty' => 'Scegli', 'class' => 'form-select'));?>
                        <?php echo $form->error($model, 'organizzatore');?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model, 'type_stay'); ?>
                        <?php echo $form->dropDownList($model, "type_stay", $model->typeStay, array('empty' => 'Scegli', 'class' => 'form-select', 'onchange' => 'javascript:getStays(this.value);'));?>
                        <?php echo $form->error($model, 'type_stay');?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model, 'soggiorno'); ?>
                        <?php echo $form->dropDownList($model, "soggiorno", array(), array('empty' => 'Scegli', 'class' => 'form-select'));?>
                        <?php echo $form->error($model, 'soggiorno');?>
                    </td>
                </tr>
                    <td>
                        <?php echo $form->labelEx($model, 'turno'); ?>
                        <?php echo $form->dropDownList($model, "turno", array('1'=>'1','2'=>'2','3'=>'3','4'=>'4'), array('empty' => 'Scegli', 'class' => 'form-select'));?>
                        <?php echo $form->error($model, 'turno');?>
                    </td>
                    <td></td>
                    <td></td>
                <tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"><?php echo Yii::t('survey', 'title.parent.section2');?></th>
                    <th scope="col" class="text-center">POCO</th>
                    <th scope="col" class="text-center">ABBASTANZA</th>
                    <th scope="col" class="text-center">MOLTO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'assistenza');?>
                        <?php echo $form->error($model, 'assistenza');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'assistenza', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'informazioni');?>
                        <?php echo $form->error($model, 'informazioni');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'informazioni', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'trasferimenti');?>
                        <?php echo $form->error($model, 'trasferimenti');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'trasferimenti', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'organizzazione');?>
                        <?php echo $form->error($model, 'organizzazione');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'organizzazione', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'attivita');?>
                        <?php echo $form->error($model, 'attivita');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'attivita', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'esperienza');?>
                        <?php echo $form->error($model, 'esperienza');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'esperienza', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'cura');?>
                        <?php echo $form->error($model, 'cura');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'cura', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'communicazione');?>
                        <?php echo $form->error($model, 'communicazione');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'communicazione', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'complessivo');?>
                        <?php echo $form->error($model, 'complessivo');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'complessivo', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:inline'),'separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"><?php echo Yii::t('survey', 'title.parent.section3');?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col">
                        <?php echo $form->labelEx($model, 'suggerimenti');?>
                        <?php echo $form->textArea($model, 'suggerimenti', array('class' => 'form-control')) ;?>
                        <?php echo $form->error($model, 'suggerimenti');?>
                    </td>
                </tr>
                <tr>
                    <td scope="col" class="text-end">
                        <?php echo $form->checkBox($model,'privacy',array('value' => '1', 'uncheckValue'=>null)); ?>
                        <?php echo $form->labelEx($model, 'privacy');?>
                        <?php echo $form->error($model, 'privacy');?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-12 text-center">
        <?php echo CHtml::submitButton('INVIA QUESTIONARIO', array('class' => 'btn btn-warning btn-lg btn-submit-form ', 'data-refer' => 'survey-form')); ?>
    </div>
</div>
            
<?php $this->endWidget(); ?>

<script>
    //$(function() {
        function getStays(t) {
            $.post("/qualita_new/index.php/survey/default/stays",{"t": t},function(data) {
                $('#SurveyParents_soggiorno option:gt(0)').remove()
                $('#SurveyParents_soggiorno').append(data);
            }, "html");
        }
    //});
</script>