<style>
    .errorMessage{color:darkred}
    th {background-color:#7f190e !important; color: #fff !important;}
    .form-check-input:checked {
        background-color: #ec7a1d !important;
        border-color: #ec7a1d !important;
    }
    /*#section-study, #section-scientific {
        display:none;
    }*/
    #section2 table tr td, #section-study table tr td, #section-scientific table tr td, #section-sport table tr td {
        width:12% !important;
    }
    #section2 table tr td:first-child, #section-study table tr td:first-child, #section-scientific table tr td:first-child, #section-sport table tr td:first-child {
        width:65% !important;
    }

</style>

<div class="py-5 text-left">
    <img class="d-block mx-auto mb-4" src="<?php echo Yii::app()->request->baseUrl ."/images/survey/keluar_logo_21.png";?>" alt="" width="150">
    <h3>Questionario di gradimento</h3>
    <p class="lead">Ciao,<br />al termine della vacanza ti proponiamo questo questionario per raccogliere la tua valutazione sull'esperienza di soggiorno. Ti chiediamo di rispondere a tutte le domande, di scriverci quali sono i tuoi desideri per il prossimo anno suggerendoci nuove attività. Ogni tua valutazione ci sarà utile per migliorare ed organizzare il prossimo anno una vacanza ancor più divertente, coinvolgente e formativa.<br /><br />Grazie per il tuo importante contributo.<br />I tuoi animatori</p>
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
                    <th colspan="3"><?php echo Yii::t('survey', 'title.stay.section1');?></th>
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
                        <?php echo $form->dropDownList($model, "eta", SurveyStays::getParticipantAges(), array('empty' => 'Scegli', 'class' => 'form-select'));?>
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
                        <?php echo $form->labelEx($model, 'nome_gruppo'); ?>
                        <?php echo $form->textField($model, 'nome_gruppo', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'nome_gruppo');?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model, 'organizzatore'); ?>
                        <?php echo $form->dropDownList($model, "organizzatore", CHtml::listData(Clienti::model()->findAll(['condition'=>'online="Y"','order'=>'nome']),'id','nome'), array('empty' => 'Scegli', 'class' => 'form-select', 'onchange' => 'javascript:getTypeStay(this.value);'));?>
                        <?php echo $form->error($model, 'organizzatore');?>
                    </td>
                    <td>
                        <?php echo $form->labelEx($model, 'tipologia_id'); ?>
                        <?php echo $form->dropDownList($model, "tipologia_id", array(), array('empty' => 'Scegli', 'class' => 'form-select', 'onchange' => 'javascript:getStays(this.value);'));?>
                        <?php echo $form->error($model, 'tipologia_id');?>
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

<div id="section2" class="row g-3">
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"><?php echo Yii::t('survey', 'title.stay.section2');?></th>
                    <th scope="col" class="text-center">POCO</th>
                    <th scope="col" class="text-center">ABBASTANZA</th>
                    <th scope="col" class="text-center">MOLTO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">1</span>
                        <?php echo $form->labelEx($model, 'divertimento');?>
                        <?php echo $form->error($model, 'divertimento');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'divertimento', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">2</span>
                        <?php echo $form->labelEx($model, 'educatori');?>
                        <?php echo $form->error($model, 'educatori');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'educatori', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">3</span>
                        <?php echo $form->labelEx($model, 'compagni');?>
                        <?php echo $form->error($model, 'compagni');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'compagni', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">4</span>
                        <?php echo $form->labelEx($model, 'giochi');?>
                        <?php echo $form->error($model, 'giochi');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'giochi', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">5</span>
                        <?php echo $form->labelEx($model, 'gite');?>
                        <?php echo $form->error($model, 'gite');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'gite', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div id="section-study" class="row g-3 section-type d-none">
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"><?php echo Yii::t('survey', 'title.stay.study');?></th>
                    <th scope="col" class="text-center">POCO</th>
                    <th scope="col" class="text-center">ABBASTANZA</th>
                    <th scope="col" class="text-center">MOLTO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">6</span>
                        <?php echo $form->labelEx($model, 'studio_location');?>
                        <?php echo $form->error($model, 'studio_location');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'studio_location', array('IT'=>'ITALIA','ES'=>'ESTERO'), array('class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input} {label}</td>', 'uncheckValue'=>null));?>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">7</span>
                        <?php echo $form->labelEx($model, 'studio_localita');?>
                        <?php echo $form->error($model, 'studio_localita');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'studio_localita', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">8</span>
                        <?php echo $form->labelEx($model, 'studio_corso');?>
                        <?php echo $form->error($model, 'studio_corso');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'studio_corso', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">9</span>
                        <?php echo $form->labelEx($model, 'studio_involvement');?>
                        <?php echo $form->error($model, 'studio_involvement');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'studio_involvement', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div id="section-scientific" class="row g-3 section-type d-none">
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"><?php echo Yii::t('survey', 'title.stay.scientific');?></th>
                    <th scope="col" class="text-center">POCO</th>
                    <th scope="col" class="text-center">ABBASTANZA</th>
                    <th scope="col" class="text-center">MOLTO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">6</span>
                        <?php echo $form->labelEx($model, 'scientifici_school_subject');?>
                        <?php echo $form->error($model, 'scientifici_school_subject');?>
                    </td>
                    <td colspan="3">
                        <?php echo $form->textField($model, 'scientifici_school_subject', array('class'=>'form-control'));?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">6</span>
                        <?php echo $form->labelEx($model, 'scientifici_modules_liked');?>
                        <?php echo $form->error($model, 'scientifici_modules_liked');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'scientifici_modules_liked', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">7</span>
                        <?php echo $form->labelEx($model, 'scientifici_involvement');?>
                        <?php echo $form->error($model, 'scientifici_involvement');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'scientifici_involvement', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <!--<tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">8</span>
                        <?php //echo $form->labelEx($model, 'scientifici_formazione');?>
                        <?php //echo $form->error($model, 'scientifici_formazione');?>
                    </td>
                    <?php //echo $form->radioButtonList($model, 'scientifici_formazione', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>-->
            </tbody>
        </table>
    </div>
</div>

<div id="section-sport" class="row g-3 section-type d-none">
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"><?php echo Yii::t('survey', 'title.stay.sport');?></th>
                    <th scope="col" class="text-center">POCO</th>
                    <th scope="col" class="text-center">ABBASTANZA</th>
                    <th scope="col" class="text-center">MOLTO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">6</span>
                        <?php echo $form->labelEx($model, 'sport_chosen');?>
                        <?php echo $form->error($model, 'sport_chosen');?>
                    </td>
                    <td colspan="3">
                        <?php echo $form->textField($model, 'sport_chosen', array('class'=>'form-control'));?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">7</span>
                        <?php echo $form->labelEx($model, 'sport_organization');?>
                        <?php echo $form->error($model, 'sport_organization');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'sport_organization', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
                </tr>
                <tr>
                    <td>
                        <span class="badge rounded-pill bg-warning text-dark">8</span>
                        <?php echo $form->labelEx($model, 'sport_involvement');?>
                        <?php echo $form->error($model, 'sport_involvement');?>
                    </td>
                    <?php echo $form->radioButtonList($model, 'sport_involvement', array('P'=>'P','A'=>'A','M'=>'M'), array('labelOptions'=>array('style'=>'display:none'),'class'=>'form-check-input','separator'=>'','template'=>'<td class="text-center">{input}</td>', 'uncheckValue'=>null));?>
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
                    <th scope="col"><?php echo Yii::t('survey', 'title.stay.suggestions');?></th>
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
        <?php echo CHtml::submitButton('INVIA QUESTIONARIO', array('class' => 'btn btn-warning btn-lg btn-submit-form', 'data-refer' => 'survey-form')); ?>
    </div>
</div>
            
<?php $this->endWidget(); ?>

<script>

    function getTypeStay(c) {
        $.post("/qualita_new/index.php/survey/default/type",{"c":c},function(data) {
            $('#SurveyStays_tipologia_id option:gt(0)').remove();
            $('#SurveyStays_soggiorno option:gt(0)').remove();
            $('#SurveyStays_tipologia_id').append(data);
        }, "html");
    }

    function getStays(t) {
        var c = $('#SurveyStays_organizzatore').val();

        $.post("/qualita_new/index.php/survey/default/stays",{"c":c,"t":t},function(data) {
            $('#SurveyStays_soggiorno option:gt(0)').remove();
            $('#SurveyStays_soggiorno').append(data);
        }, "html");

        $('.section-type').addClass('d-none');
        $('.section-type :input').prop('disabled', true);

        switch(t) {
            case '3':
                $('#section-study').removeClass('d-none');
                $('#section-study :input').prop('disabled',false);
                break;
            case '4':
                $('#section-scientific').removeClass('d-none');
                $('#section-scientific :input').prop('disabled',false);
                break;
            case '5':
                $('#section-sport').removeClass('d-none');
                $('#section-sport :input').prop('disabled',false);
                break;
        }
    }

    $(function() {
        $('.btn-submit-form').on('click', function(){
            document.getElementById("survey-form").scrollIntoView();
        });
    });
</script>