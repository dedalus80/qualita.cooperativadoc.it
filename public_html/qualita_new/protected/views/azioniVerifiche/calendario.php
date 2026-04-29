<?php
$mesi = array(1 => 'Gennaio', 2 => 'Febbraio', 3 => 'Marzo', 4 => 'Aprile', 5 => 'Maggio', 6 => 'Giugno', 7 => 'Luglio', 8 => 'Agosto', 9 => 'Settembre', 10 => 'Ottobre', 11 => 'Novembre', 12 => 'Dicembre');

function draw_calendar($month, $year, $verifiche = NULL) {

    /* draw table */
    $calendar = '<table cellpadding="0" cellspacing="0" style="border: #ddd 1px solid; width: 100%" >';

    /* table headings */
    $headings = array('Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab');
    $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">' . implode('</td><td class="calendar-day-head">', $headings) . '</td></tr>';

    /* days and weeks vars now ... */
    $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
    $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* row for week one */
    $calendar.= '<tr class="calendar-row">';

    /* print "blank" days until the first of the current week */
    for ($x = 0; $x < $running_day; $x++):
        $calendar.= '<td class="calendar-day-np"> </td>';
        $days_in_this_week++;
    endfor;

    /* keep going with days.... */
    for ($list_day = 1; $list_day <= $days_in_month; $list_day++):

        if ($list_day < 10)
            $vday = "0" . $list_day;
        else
            $vday = $list_day;

        if ($month < 10)
            $vmonth = "0" . $month;
        else
            $vmonth = $month;


        $giorno = $vday . '-' . $vmonth . '-' . $year;

        $calendar.= '<td class="calendar-day" id="' . $giorno . '" >';
        $calendar.= '<div  style="position:relative;height: 100%;" >';
        /* add in the day number */
        $calendar.= '<div class="day-number" style="position:absolute; bottom:0; right:0;">' . $list_day . '</div>';

        $calendar.= '<div id="box-' . $giorno . '">';
        // QUI L' array dei dati 
        if ($verifiche[$year . "-" . $vmonth . "-" . $vday]) {
            foreach ($verifiche[$year . "-" . $vmonth . "-" . $vday] AS $val)
                $calendar.= $val;
        }
        $calendar.= '</div >';
        $calendar.= '</div >';
        $calendar.= '</td>';
        if ($running_day == 6):
            $calendar.= '</tr>';
            if (($day_counter + 1) != $days_in_month):
                $calendar.= '<tr class="calendar-row">';
            endif;
            $running_day = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++;
        $running_day++;
        $day_counter++;
    endfor;

    /* finish the rest of the days in the week */
    if ($days_in_this_week < 8):
        for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
        endfor;
    endif;

    /* final row */
    $calendar.= '</tr>';

    /* end the table */
    $calendar.= '</table>';

    /* all done, return result */
    return $calendar;
}

$this->breadcrumbs = array(
    'Calendario verifiche ispettive' => array('admin'),
);

if ($ruolo != '1' && $ruolo != '4') {
    $readOnly = "";
    $event = "checkEventoCalendario('','')";
} else {
    $readOnly = "";
    $event = "checkEventoCalendario('','')";
}

if (count($stats['reserved']) > 0)
    $events = "events: [" . implode(",", $stats['reserved']) . "] ,'textEscape': true,'color': 'yellow', 'textColor': 'black',";
else
    $events = "";

if (Yii::app()->user->getId()) {
    Yii::app()->clientScript->registerScript('calendar', "
$(document).ready(function() {

	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	var calendar = $('#calendar-complete').fullCalendar({
		eventClick: function(calEvent, jsEvent, view) {checkEventoCalendario(calEvent.id,calEvent.type)},
                lang:'it',
                
                header: {
			left: 'prev',
			center: 'title',
			right: 'next,anno'
		},
        eventRender: function( event, element, view ) {
            var title = element.find('.fc-title, .fc-list-item-title');          
            title.html(title.text());
        },
		selectable: true,
		selectHelper: true,
		select: function(start, end, allDay) {
                        setEventDate(start.format(),end.format())
                        " . $event . ";
                        calendar.fullCalendar('unselect');
		},
                
		editable: false,
		" . $events . " 
		buttonText: {} 
	});
});
");
}
?>
<div class='row ' >
    <div class="col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2><i class='fa fa-calendar'></i>&nbsp;Verifiche ispettive <span class='orange return-block'></span></h2>
                <div class="panel-ctrls">
                    <ul class="demo-btns li-480"  >
                        <li class="year-view"  style="display:none;width: 130px"  >
                            <div class="input-group date" style="margin-bottom: -5px" >
                                <span class="input-group-addon ">Anno</span>
                                <select id="anno" name="anno" class="form-control" style="width: 70px">
                                    <option value=""> -- Seleziona </option>
                                    <? foreach ($model->selectAnni AS $id => $val) { ?>
                                        <option value="<?= $id ?>"  <?= $model->anno == $id ? "selected='selected'" : "" ?>  ><?= $val ?></option>
                                    <? } ?>
                                </select>
                            </div>
                        </li>
                        <li class="year-view" style="display:none"><?php echo CHtml::link('<i class="fa fa-refresh"></i>', '#', array('class' => 'button-icon button-icon-green', 'id' => 'update-years-verifiche', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiorna dati'))); ?></li>
                        <li class="year-view" style="display:none"><?php echo CHtml::link('<i class="fa fa-calendar"></i>', '#', array('class' => ' button-icon button-icon-orange', 'id' => 'view-month-calendar', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza calendario mensile'))); ?></li>
                        <li class="mont-view" ><?php echo CHtml::link('<i class="fa fa-calendar"></i>', '#', array('class' => ' button-icon button-icon-orange', 'id' => 'view-year-calendar', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza calendario annuale'))); ?></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body panel-padding">
                <div id="calendar-complete" ></div>
                <div id="full-year" style="display:none" >
                    <div class="row">
                        <? for ($m = 1; $m <= 3; $m++) { ?>
                            <div class='col-sm-4 col-sx-6' style="margin-bottom: 20px">
                                <div class="month-title" style="text-align: center" ><?= $mesi[$m] ?></div>
                                <div class="mount-days" style="width: 100%"><?= draw_calendar($m, $model->anno, $verifiche) ?></div>
                            </div>
                        <? } ?>
                    </div>
                    <div class="row">
                        <? for ($m = 4; $m <= 6; $m++) { ?>
                            <div class='col-sm-4 col-sx-6' style="margin-bottom: 20px">
                                <div class="month-title" style="text-align: center" ><?= $mesi[$m] ?></div>
                                <div class="mount-days" style="width: 100%"><?= draw_calendar($m, $model->anno, $verifiche) ?></div>
                            </div>
                        <? } ?>
                    </div>
                    <div class="row">
                        <? for ($m = 7; $m <= 9; $m++) { ?>
                            <div class='col-sm-4 col-sx-6' style="margin-bottom: 20px">
                                <div class="month-title" style="text-align: center" ><?= $mesi[$m] ?></div>
                                <div class="mount-days" style="width: 100%"><?= draw_calendar($m, $model->anno, $verifiche) ?></div>
                            </div>
                        <? } ?>
                    </div>
                    <div class="row">
                        <? for ($m = 10; $m <= 12; $m++) { ?>
                            <div class='col-sm-4 col-sx-6' style="margin-bottom: 20px">
                                <div class="month-title" style="text-align: center" ><?= $mesi[$m] ?></div>
                                <div class="mount-days" style="width: 100%"><?= draw_calendar($m, $model->anno, $verifiche) ?></div>
                            </div>
                        <? } ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div  style="margin-bottom: 50px" >
</div>
<div id="update-verifiche" class="modal fade">
    <div class="modal-dialog" style='max-width: 500px'>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id='delDato_title' ><i class='fa fa-check'></i>&nbsp;Verifica ispettiva <span id="codice-verifica"></span> </h4>
            </div>
            <div class="modal-body" style='padding-bottom: 0px'>
                <form name="form-verifiche" id="form-verifiche" method="POST" class="wide form form-horizontal row-border">

                    <div class="row  row-10 errorSummary"   id='messaggio-box'  style='display: none ; margin: 5px' >
                        <div class="col-xs-12 row-10">
                            <div id='messaggio-text'></div>
                        </div>
                    </div>

                    <div class="form-group" style='border-top: none'>
                        <label class="col-sm-3 control-label">Struttura</label>
                        <div class="col-sm-8">
                            <input type="hidden" name="id" id="idVerifica" value="" /> 
                            <input type="hidden" name="tipo-calendario" id="tipo-calendario" value="<?= $model->calendario ?>" /> 
                            <div id='admin-line'>

                            <?php
                                if (Yii::app()->user->getState('group') == 'ADMIN')
                                    echo CHtml::dropDownList('unita_operativa', "unita_operativa", CHtml::listData(Soggiorni::model()->findAll(array('order'=> 'nome')), 'id', 'nome'), array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control field-verifiche remove-disabled unita-operativa'));
                                else
                                    echo CHtml::dropDownList('unita_operativa', "unita_operativa", CHtml::listData(Soggiorni::model()->findAll(array('condition' => 'id IN ('.implode(',', Yii::app()->user->getState('strutture')).')', 'order'=> 'nome')), 'id', 'nome'), array('empty' => 'Scegli', 'options' => $sel, 'class' => 'form-control field-verifiche remove-disabled unita-operativa'));
                            ?>

                                <!--<select class="form-control field-verifiche remove-disabled unita-operativa" name="unita_operativa" id="unita_operativa" data-field="tipologia_scadenza"  <?= $readOnly ?> >
                                    <option value='' > -- Selezionare -- </option>
                                    <?php //foreach ($model->selectStrutture AS $id => $val) { ?>
                                        <option value='<?php //echo $id; ?>' ><?php //echo $val; ?></option>
                                    <?php //} ?>
                                </select>-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tipo verifica</label>
                        <div class="col-sm-8">
                            <select class="form-control field-verifiche select-tipi-verifiche remove-disabled" name="tipo_verifica" id="tipo_verifica" data-field="tipo_verifica"  <?= $readOnly ?> >
                                <option value='' > -- Selezionare -- </option>
                                <? foreach ($model->selectTipologie AS $id => $val) { ?>
                                    <option value='<?= $id ?>' ><?= $val ?></option>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id='box-processi' style='display: none'>
                        <label class="col-sm-3 control-label">Tipo processo</label>
                        <div class="col-sm-8">
                            <select class="form-control field-verifiche select-tipi-processi remove-disabled" name="tipo_processo" id="tipo_processo" data-field="tipo_processo"  <?= $readOnly ?> >
                                <option value='' > -- Selezionare -- </option>
                                <? foreach ($model->selectProcessi AS $id => $val) { ?>
                                    <option value='<?= $id ?>' ><?= $val ?></option>
                                <? } ?>
                            </select>
                        </div>
                    </div>
					<div class="form-group" id='box-dettaglio' style='display: none'>
                        <label class="col-sm-3 control-label">Specificare</label>
                        <div class="col-sm-8">
                            <textarea  name="dettaglio" id="dettaglio" value="" class="form-control form-validate remove-disabled" data-field="dettaglio" ></textarea>
						</div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-3 control-label">Incaricato</label>
                        <div class="col-sm-8">
                            <select class="form-control field-verifiche remove-disabled" name="tipo_verifica" id="incaricato" data-field="incaricato"  <?= $readOnly ?> >
                                <option value='' > -- Selezionare -- </option>
                                <? foreach ($model->selectIncaricati AS $id => $val) { ?>
                                    <option value='<?= $id ?>' ><?= $val ?></option>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Data verifica</label>
                        <div class="col-sm-8">
                            <div class="input-daterange input-group" id="datepicker-range">
								<span class="p4-10 bleft input-group-addon data-calendar field-verifiche remove-disabled" data-refer="prima_verifica" ><i class="fa fa-calendar"></i></span>
                                <input  type="text" name="prima_verifica" id="prima_verifica" value="" class="left richiamo form-control form-validate remove-disabled" data-field="prima_verifica"   <?= $readOnly ?> />
                                <span class="input-group-addon p410" >Al</span>
								<input  type="text" name="seconda_verifica" id="seconda_verifica" value="" class="left richiamo form-control form-validate remove-disabled" data-field="seconda_verifica"   <?= $readOnly ?> />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Inizio reminder</label>
                        <div class="col-sm-3">
                            <input  min="0" step='1' max='15' type="number" name="inizio_avvisi" id="inizio_avvisi" value="" class="form-control form-validate remove-disabled" data-field="inizio_avvisi"  />
                        </div>
                        <label class="col-sm-5" style='padding-top: 7px;'>
                                &nbsp;Giorni prima della verifica
                        </label>
                    </div>
                </form>    
            </div>    
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="btn-verifica-undo" >Anulla</button> 
                <button type="button" class="btn btn-orange" id="btn-verifica-confirm" >Conferma</button>
            </div>
        </div>
    </div>
</div>