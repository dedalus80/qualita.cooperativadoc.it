<?php
$mesi = array(1 => 'Gennaio', 2 => 'Febbraio', 3 => 'Marzo', 4 => 'Aprile', 5 => 'Maggio', 6 => 'Giunio', 7 => 'Luglio', 8 => 'Agosto', 9 => 'Settembre', 10 => 'Ottobre', 11 => 'Dovembre', 12 => 'Dicembre');

function draw_calendar($month, $year, $corsi = NULL) {

    
    $calendar = '<table cellpadding="0" cellspacing="0" style="border: #ddd 1px solid; width: 100%" >';

    $headings = array('Dom', 'Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab');
    $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">' . implode('</td><td class="calendar-day-head">', $headings) . '</td></tr>';

    $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
    $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    $calendar.= '<tr class="calendar-row">';

    for ($x = 0; $x < $running_day; $x++):
        $calendar.= '<td class="calendar-day-np"> </td>';
        $days_in_this_week++;
    endfor;

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

        $calendar.= '<td class="calendar-day-formazione" id="' . $giorno . '" >';
        $calendar.= '<div  style="position:relative;height: auto " >';
        $calendar.= '<div class="day-number" style="position:absolute; bottom:0; right:0;">' . $list_day . '</div>';

        $calendar.= '<div id="box-' . $giorno . '">';
        
        // QUI L' array dei dati 
        if ($corsi[$year . "-" . $vmonth . "-" . $vday]) {
            foreach ($corsi[$year . "-" . $vmonth . "-" . $vday] AS $val)
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
    'Calendario corsi formazione' => array('admin'),
);

Yii::app()->MyUtils->getMenuPermition('admin_formazione') ? $event = "checkEventoCalendarioFormazione('','')": $event = "doNothing()";


if (count($stats['reserved']) > 0)
    $events = "events: [" . implode(",", $stats['reserved']) . "] ,textEscape: false,'color': 'yellow', 'textColor': 'black',";
else
    $events = "";

if (Yii::app()->user->getId()) {
    Yii::app()->clientScript->registerScript('calendar', "
$(document).ready(function() {

	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	var calendar = $('#calendario-formazione').fullCalendar({
		eventClick: function(calEvent, jsEvent, view) {checkEventoCalendarioFormazione(calEvent.id,calEvent.type)},
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
    <div class='row '>
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2><i class='fa fa-calendar'></i>&nbsp;Corsi formazione <span class='orange return-block'></span></h2>
                    <div class="panel-ctrls">
                        <ul class="demo-btns li-480">
                            <li class="year-view" style="display:none;width: 130px">
                                <div class="input-group date" style="margin-bottom: -5px">
                                    <span class="input-group-addon ">Anno</span>
                                    <select id="anno" name="anno" class="form-control" style="width: 70px">
                                    <option value=""> -- Seleziona </option>
                                    <? foreach ($model->selectAnni AS $id => $val) { ?>
                                        <option value="<?= $id ?>"  <?= $model->anno == $id ? "selected='selected'" : "" ?>  ><?= $val ?></option>
                                    <? } ?>
                                </select>
                                </div>
                            </li>
                            <li class="year-view" style="display:none">
                                <?php echo CHtml::link('<i class="fa fa-refresh"></i>', '#', array('class' => 'button-icon button-icon-green', 'id' => 'update-years-formazione', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Aggiorna dati'))); ?></li>
                            <li class="year-view" style="display:none">
                                <?php echo CHtml::link('<i class="fa fa-calendar"></i>', '#', array('class' => ' button-icon button-icon-orange', 'id' => 'view-month-calendario', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza calendario mensile'))); ?></li>
                            <li class="mont-view">
                                <?php echo CHtml::link('<i class="fa fa-calendar"></i>', '#', array('class' => ' button-icon button-icon-orange', 'id' => 'view-year-calendario', 'rel' => 'tooltip', 'data-toggle' => 'tooltip', 'title' => Yii::t('app', 'Visualizza calendario annuale'))); ?></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body panel-padding">
                    <div id="calendario-formazione"></div>
                    <div id="full-year" style="display:none">
                        <div class="row">
                            <? for ($m = 1; $m <= 3; $m++) { ?>
                                <div class='col-sm-4 col-sx-6' style="margin-bottom: 20px">
                                    <div class="month-title" style="text-align: center">
                                        <?= $mesi[$m] ?>
                                    </div>
                                    <div class="mount-days" style="width: 100%">
                                        <?= draw_calendar($m, $model->anno, $corsi) ?>
                                    </div>
                                </div>
                                <? } ?>
                        </div>
                        <div class="row">
                            <? for ($m = 4; $m <= 6; $m++) { ?>
                                <div class='col-sm-4 col-sx-6' style="margin-bottom: 20px">
                                    <div class="month-title" style="text-align: center">
                                        <?= $mesi[$m] ?>
                                    </div>
                                    <div class="mount-days" style="width: 100%">
                                        <?= draw_calendar($m, $model->anno, $corsi) ?>
                                    </div>
                                </div>
                                <? } ?>
                        </div>
                        <div class="row">
                            <? for ($m = 7; $m <= 9; $m++) { ?>
                                <div class='col-sm-4 col-sx-6' style="margin-bottom: 20px">
                                    <div class="month-title" style="text-align: center">
                                        <?= $mesi[$m] ?>
                                    </div>
                                    <div class="mount-days" style="width: 100%">
                                        <?= draw_calendar($m, $model->anno, $corsi) ?>
                                    </div>
                                </div>
                                <? } ?>
                        </div>
                        <div class="row">
                            <? for ($m = 10; $m <= 12; $m++) { ?>
                                <div class='col-sm-4 col-sx-6' style="margin-bottom: 20px">
                                    <div class="month-title" style="text-align: center">
                                        <?= $mesi[$m] ?>
                                    </div>
                                    <div class="mount-days" style="width: 100%">
                                        <?= draw_calendar($m, $model->anno, $corsi) ?>
                                    </div>
                                </div>
                                <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 50px">
    </div>
    <div id="update-formazione" class="modal fade">
        <div class="modal-dialog" style='max-width: 500px'>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id='delDato_title'><i class='fa fa-graduation-cap'></i>&nbsp;Corsi formazione <span id="codice-formazione"></span> </h4>
                </div>
                <div class="modal-body" style='max-height: 350px ; overflow: auto'>
                    <form name="form-formazione" id="form-formazione" method="POST" class="wide form form-horizontal row-border">
                        <input type="hidden" name="id" id="idFormazione" value="" /> 
                        <input type="hidden" name="tipo-calendario-formazione" id="tipo-calendario-formazione" value="<?= $model->calendario ?>" /> 
                        <div class="row  row-10 errorSummary" id='messaggio-box' style='display: none ; margin: 5px'>
                            <div class="col-xs-12 row-10">
                                <div id='messaggio-text'></div>
                            </div>
                        </div>
                        <div class="form-group" style='border-top: none !important'>
                            <label class="col-sm-3 control-label">Titolo</label>
                            <div class="col-sm-8">
                                <input type='text' name="titolo_formazione" id="titolo_formazione" value="" class="form-control form-validate" data-field="titolo" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Corso</label>
                            <div class="col-sm-8"> <?= $model->selectCorsi ?>                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Data corso</label>
                            <div class="col-sm-8">
                                <div class="input-daterange input-group" id="datepicker-range">
								    <span class="p4-10 bleft input-group-addon data-calendar field-formazione remove-disabled" data-refer="prima_verifica" ><i class="fa fa-calendar"></i></span>
                                    <input  type="text" name="data_formazione" id="data_formazione" value="" class="left richiamo form-control form-validate remove-disabled" data-field="data_formazione"   <?= $readOnly ?> />
                                    <span class="input-group-addon p410" >Al</span>
								    <input  type="text" name="data_fine" id="data_fine" value="" class="left richiamo form-control form-validate remove-disabled" data-field="data_fine"   <?= $readOnly ?> />
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Orario</label>
                            <div class="col-sm-8">
                                <div class="input-group ">
                                    <span class="input-group-addon data-calendar field-formazione" data-refer=""><i class="fa fa-clock-o"></i></span>
                                    <input type="text" name="ora_formazione" id="ora_formazione" value="" class=" form-control form-validate" data-field="ora_formazione" <?= $readOnly ?> />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Invia Email</label>
                            <div class="col-sm-8">
                                <div class="input-group date">
                                    <span class="input-group-addon" style='padding: 4px 5px 4px'>
                                        <input type='checkbox' id='invio_email' name ='invio_email' class='checkbox-green' value='Y' />
                                    </span>
                                    <input type='number' id='giorni_invio_email' name='giorni_invio_email' max='5' min='0' class='form-control' />
                                    <span class="input-group-addon">Giorni prima del corso</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Invia Sms</label>
                            <div class="col-sm-8">
                                <div class="input-group date">
                                    <span class="input-group-addon" style='padding: 4px 5px 4px'>
                                        <input type='checkbox' id='invio_sms' name ='invio_sms' class='checkbox-green' value='Y' />
                                    </span>
                                    <input type='number' id='giorni_invio_sms' name='giorni_invio_sms' max='5' min='0' class='form-control' />
                                    <span class="input-group-addon">Giorni prima del corso</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Gruppi</label>
                            <div class="col-sm-8">
                                <?php foreach($model->selectGruppi AS $id => $val){  ?>
                                <div class="input-group date" style='margin-bottom: 5px'>
                                    <span class="input-group-addon" style='padding: 4px 5px 4px;'>
                                        <input id='gruppo_<?= $id ?>' type='checkbox' class='checkbox-green check-gruppo' name ='gruppi[<?= $id ?>]' value ='<?= $id ?>'  <?= $checked[$id] ?>  >
                                    </span>
                                    <input type='text' class='form-control' disabled='disabled' value='<?= $val ?>'>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn-formazione-undo">Anulla</button>
                    <button type="button" class="btn btn-orange" id="btn-formazione-confirm">Conferma</button>
                </div>
            </div>
        </div>
    </div>
    <div id="show-formazione" class="modal fade">
        <div class="modal-dialog" style='max-width: 500px'>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id='delDato_title'><i class='fa fa-graduation-cap'></i>&nbsp;Corso formazione <span id="codice-formazione"></span> </h4>
                </div>
                <div class="modal-body" style='max-height: 350px ; overflow: auto'>
                    <div class="row" style='border-top: none !important'>
                        <label class="col-sm-3 control-label">Titolo</label>
                        <div class="col-sm-8"><span id='view-corso-titolo'></span></div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 control-label">Tipo Corso</label>
                        <div class="col-sm-8"><span id='view-corso-corso'></span></div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 control-label">Data corso</label>
                        <div class="col-sm-8"><span id='view-corso-data'></span></div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 control-label">Tipo corso</label>
                        <div class="col-sm-8"><span id='view-corso-tipo'></span></div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 control-label">Luogo</label>
                        <div class="col-sm-8"><span id='view-corso-location'></span></div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 control-label">Note</label>
                        <div class="col-sm-8"><p id='view-corso-descrizione'></p></div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 control-label">Gruppi</label>
                        <div class="col-sm-8"><span id='view-corso-gruppi'></span></div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 control-label">Utenti</label>
                        <div class="col-sm-8"><span id='view-corso-utenti'></span></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-orange" id="btn-formazione-close" data-dismiss="modal" aria-label="Close" >Chiudi</button>
                </div>
            </div>
        </div>
    </div>