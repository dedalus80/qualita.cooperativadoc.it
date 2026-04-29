var rootSito = "https://qualita.cooperativadoc.it/qualita_new/";

$(document).ready(function () {

    $('[data-toggle="tooltip"]').tooltip()

    $('.radio-ins').iCheck({
        radioClass: 'iradio_minimal-red'
    });

    $('.radio-suf').iCheck({
        radioClass: 'iradio_minimal-orange'
    });
    $('.radio-buo').iCheck({
        radioClass: 'iradio_minimal-green'
    });

    $('.radio-ott').iCheck({
        radioClass: 'iradio_minimal-purple'
    });

    $('.radio-red').iCheck('ifChecked', function () {
        radioClass: 'iradio_square-red'
    });

    $('.radio-green').iCheck({
        radioClass: 'iradio_square-green'
    });

    $('.checkbox-green').iCheck({
        checkboxClass: 'icheckbox_square-green'
    });

    //$('.radio-tipo-corso').iCheck('uncheck');
    $('.radio-tipo-corso').on('ifChecked', function(event) {
        if(this.value == 'P') {
            $('#view-address-accesso').show();
            $('#view-link-accesso').hide();
            $('#AzioniFormazione_link_accesso').val("");
        }
        if(this.value == 'O') {
            $('#view-link-accesso').show();
            $('#view-address-accesso').hide();
            $('#AzioniFormazione_address_accesso').val("");
        }
    });
    
    $("#Infortunio_nascita_data").datepicker({
        format: 'dd-mm-yyyy',
        language: 'it',
        changeMonth: true,
        changeYear: true,
        monthNamesShort: ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'],
        yearRange: '1940:2010',
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Me', 'Gi', 'Ve', 'Sa']
    }).on('changeDate', function (e) {
        $(this).datepicker('hide');
    });

    $(".richiamo").datepicker({
        todayHighlight: true,
        todayBtn: true,
        language: 'it',
        format: "dd-mm-yyyy",
        showOnFocus: false
    }).on('changeDate', function (e) {
        $(this).datepicker('hide');
    });
    
    $(".calendar").datepicker({
        todayHighlight: true,
        todayBtn: true,
        language: 'it',
        format: "dd-mm-yyyy",
        showOnFocus: false
    }).on('changeDate', function (e) {
        $(this).datepicker('hide');
    });

    $('#Infortunio_in_ore , #Infortunio_in_datore_ora , #Infortunio_in_abbandono_ora , #AzioniFormazione_ora , #ora_formazione ').timepicker({
        minuteStep: 1,
        showInputs: false,
        disableFocus: true,
        showMeridian: false,
        defaultTime: false
    });

    $("#Utenti_q_keluar div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Utenti_q_doc div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Utenti_q_junior div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Utenti_q_senior div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Utenti_q_sharing div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Utenti_q_campus div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Utenti_q_studio div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Utenti_q_scientifici div").last().removeClass("iradio_square-green").addClass("iradio_square-red");

    $("#TimPreiscrizioni_operatore_supporto div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#TimPreiscrizioni_allergie div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#TimPreiscrizioni_problema_sanitario div").last().removeClass("iradio_square-green").addClass("iradio_square-red");

    $("#SpPreiscrizioni_nuova_residenza div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#SpPreiscrizioni_privacy div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#SpPreiscrizioni_mailing div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#SpPreiscrizioni_media div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#SpPreiscrizioni_consenso div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#SpPreiscrizioni_appartamento div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#SpPreiscrizioni_camera div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#SpPreiscrizioni_animali div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#SpPreiscrizioni_fumatore div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#SpPreiscrizioni_coinquilini div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#SpPreiscrizioni_prima_volta div").last().removeClass("iradio_square-green").addClass("iradio_square-red");

    $("#ShPreiscrizioni_privacy div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#ShPreiscrizioni_prima_volta div").last().removeClass("iradio_square-green").addClass("iradio_square-red");

    $("#CaPreiscrizioni_privacy div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#CaPreiscrizioni_prima_volta div").last().removeClass("iradio_square-green").addClass("iradio_square-red");

    $("#Comunicazioni_stato div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Comunicazioni_tutti div").last().removeClass("iradio_square-green").addClass("iradio_square-red");

    $("#CmPreiscrizioni_dieta_religiosa div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#CmPreiscrizioni_dieta_sanitaria div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#CmPreiscrizioni_disabile div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#CmPreiscrizioni_educatore_individuale div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#CmPreiscrizioni_insegnante_sostegno div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#CmPreiscrizioni_utente_milano div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#CmPreiscrizioni_altro_genitore div").last().removeClass("iradio_square-green").addClass("iradio_square-red");

    $("#SendSms_tutti div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#SendEmail_tutti div").last().removeClass("iradio_square-green").addClass("iradio_square-red");

    $("#Utenti_preiscrizione_sn div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Utenti_preiscrizione_sp div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Utenti_preiscrizione_cs div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Utenti_preiscrizione_sh div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Utenti_preiscrizione_cm div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Utenti_preiscrizione_tim div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Utenti_preiscrizione_fo div").last().removeClass("iradio_square-green").addClass("iradio_square-red");

    $("#Strutture_qkeluar div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Strutture_qdoc div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Strutture_qsharing div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Strutture_qcampus div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Strutture_qsmog div").last().removeClass("iradio_square-green").addClass("iradio_square-red");

    $("#Strutture_qsenior div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Strutture_qjunior div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Strutture_qscientifici div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Strutture_qstudio div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Strutture_soloq div").last().removeClass("iradio_square-green").addClass("iradio_square-red");

    $("#Clienti_qkeluar div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Clienti_online div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Clienti_qdoc div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Clienti_qsharing div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Clienti_qcampus div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Clienti_qsenior div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Clienti_qjunior div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Clienti_qscientifici div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#Clienti_qstudio div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#TipologieFormazione_attivo div").last().removeClass("iradio_square-green").addClass("iradio_square-red");

    $("#AzioniVerifiche_completa div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#AzioniVerificheAmbientale_apertura_nc div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#AzioniVerificheSicurezza_apertura_nc div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#AzioniVerificheAmministrative_apertura_nc div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#AzioniVerificheManutenzione_apertura_nc div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#AzioniVerificheEducazione_apertura_nc div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#AzioniVerificheEducative_apertura_nc div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#AzioniVerificheRistorazione_apertura_nc div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("TimTurni_online div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("TimCentri_online div").last().removeClass("iradio_square-green").addClass("iradio_square-red");


    $("#DbNonconforme_trattamento_accettato div").last().removeClass("iradio_square-green").addClass("iradio_square-red");
    $("#DbReclami_non_conformita div").last().removeClass("iradio_square-green").addClass("iradio_square-red");

    $("#rgv1 div").first().removeClass("iradio_minimal-orange").addClass("iradio_minimal-purple");
    $("#rgv2 div").first().removeClass("iradio_minimal-orange").addClass("iradio_minimal-purple");
    $("#rgv3 div").first().removeClass("iradio_minimal-orange").addClass("iradio_minimal-purple");
    $("#rgv4 div").first().removeClass("iradio_minimal-orange").addClass("iradio_minimal-purple");
    $("#rgv5 div").first().removeClass("iradio_minimal-orange").addClass("iradio_minimal-purple");
    $("#rgv6 div").first().removeClass("iradio_minimal-orange").addClass("iradio_minimal-purple");
    $("#rgv7 div").first().removeClass("iradio_minimal-orange").addClass("iradio_minimal-purple");
    $("#rgv8 div").first().removeClass("iradio_minimal-orange").addClass("iradio_minimal-purple");
    $("#rgv9 div").first().removeClass("iradio_minimal-orange").addClass("iradio_minimal-purple");
    $("#rgv10 div").first().removeClass("iradio_minimal-orange").addClass("iradio_minimal-purple");
    $("#rgv11 div").first().removeClass("iradio_minimal-orange").addClass("iradio_minimal-purple");
    $("#rgv12 div").first().removeClass("iradio_minimal-orange").addClass("iradio_minimal-purple");

    $("#rgv1 div").last().removeClass("iradio_minimal-orange").addClass("iradio_minimal-red");
    $("#rgv2 div").last().removeClass("iradio_minimal-orange").addClass("iradio_minimal-red");
    $("#rgv3 div").last().removeClass("iradio_minimal-orange").addClass("iradio_minimal-red");
    $("#rgv4 div").last().removeClass("iradio_minimal-orange").addClass("iradio_minimal-red");
    $("#rgv5 div").last().removeClass("iradio_minimal-orange").addClass("iradio_minimal-red");
    $("#rgv6 div").last().removeClass("iradio_minimal-orange").addClass("iradio_minimal-red");
    $("#rgv7 div").last().removeClass("iradio_minimal-orange").addClass("iradio_minimal-red");
    $("#rgv8 div").last().removeClass("iradio_minimal-orange").addClass("iradio_minimal-red");
    $("#rgv9 div").last().removeClass("iradio_minimal-orange").addClass("iradio_minimal-red");
    $("#rgv10 div").last().removeClass("iradio_minimal-orange").addClass("iradio_minimal-red");
    $("#rgv11 div").last().removeClass("iradio_minimal-orange").addClass("iradio_minimal-red");
    $("#rgv12 div").last().removeClass("iradio_minimal-orange").addClass("iradio_minimal-red");

    $("#SendEmail_testo , #Comunicazioni_messaggio_email").summernote({
        height: 500,
        focus: true,
        toolbar: [
        ['style', ['bold', 'italic', 'underline']],
        ['para', ['ul', 'ol']],
        ]
    });

    $('.simple-colorpicker-2').ace_colorpicker().on('change', function () {
        $("#ForamzioneCorsi_colore").val(this.value)
    });

    $(".colorpick-btn").on('click', function (event) {
        $("#FormazioneCorsi_colore").val($(this).data("color"))
    });


    $('.simple-colorpicker-1').ace_colorpicker().on('change', function () {
        $("#TipologieVerifiche_colore").val(this.value)
    });

    $(".colorpick-btn").on('click', function (event) {
        $("#TipologieVerifiche_colore").val($(this).data("color"))
    });

    $('.simple-colorpicker-3').ace_colorpicker().on('change', function () {
        $("#Strutture_colore").val(this.value)
    });

    $(".colorpick-btn").on('click', function (event) {
        $("#Strutture_colore").val($(this).data("color"))
    });

    setTimeout(function () {
        chiudiAlert()
    }, 10000);

    var calendario = $('#tipo-calendario').val();
    if (calendario && calendario == 'anno') {
        $("#calendar-complete").fadeOut('slow', function (event) {
            $("#full-year").fadeIn('slow', function (event) {
                $(".mont-view").fadeOut('fast', function (event) {
                    $(".year-view").fadeIn('fast', function (event) {});
                });
            });
        });
    }
    var calendario_formazione = $('#tipo-calendario-formazione').val();
    if (calendario_formazione && calendario_formazione == 'anno') {
        $("#calendario-formazione").fadeOut('slow', function (event) {
            $("#full-year").fadeIn('slow', function (event) {
                $(".mont-view").fadeOut('fast', function (event) {
                    $(".year-view").fadeIn('fast', function (event) {});
                });
            });
        });
    }
});


$(".autocomplete").keyup(function () {

    var valore = $(this).val();
    var refer = $(this).data("refer");
    var field = $(this).data("field");
    var table = $(this).data("table");
    
    $.ajax({
        url: rootSito + 'index.php/site/getSelect',
        type: "POST",
        data: {
            'valore': valore,
            'refer': refer,
            'field': field,
            'table': table
        },
        success: function (result) {

            if (result.dati['totale'] > 0) {
                $("#UL_" + refer).html(result.dati['list'])
                $("#UL_" + refer).fadeIn()
                
                $(".autocomplete-li").on('click', function (event) {
                    event.preventDefault()
                    $("#" +refer).val($(this).data("id"));
                    $("#UL_" + refer).fadeOut()
                    $("#AUTO_"+refer).val($(this).data("text"))
                });

            } else {
                $("#UL_" + refer).html(result.dati['list'])
                $("#UL_" + refer).fadeOut()
            }
        }
    });
});


function changeOnlineStatus(table, model, stato, refer) {
    $.ajax({
        url: rootSito + 'index.php/' + model + '/setOnline',
        type: "POST",
        data: {
            'table': table,
            'id': refer,
            'stato': stato,
            'model': model
        },
        success: function (result) {

            var testo = "Stato OFFline aggiornato con successo"

            if (stato == 'Y')
                testo = "Stato ONline aggiornato con successo"

            $("#online-" + refer).html(result.online)
            showPin(testo, "Aggiornamento")
        }
    });
}

function setOnline(table, model, stato, id) {
    changeOnlineStatus(table, model, stato, id)
}

$(".set-online").on('click', function (event) {
    event.preventDefault();
    changeOnlineStatus($(this).data('table'), $(this).data('model'), $(this).data('stato'), $(this).data('refer'))
});

$(".reclamoDetail").on('change', function (event) {
    var id = $("#ReclamiAzioni_id_reclamo").val();
    if (id) {
        $.ajax({
            url: rootSito + 'index.php/ReclamiAzioni/ReclamoDetail',
            type: "POST",
            data: {
                'id': id
            },
            success: function (result) {
                $("#refer-codice").html(result.codice)
                $("#codice").html(result.codice)
                $("#refer-descrizione").html(result.descrizione)
                $("#refer-nome").html(result.nome)
                $("#refer-cognome").html(result.cognome)
                $("#refer-tipologia").html(result.tipologia)
                $("#refer-canale").html(result.canale)
                $("#user-detail").css("display", "block")
            }
        });
    } else
        $("#user-detail").css("display", "none")
});

$("#SpPreiscrizioni_occupazione").on("change", function (event) {

    switch ($(this).val()) {
        case "1":
            $("#studente-extra").fadeIn()
            $("#occupazione-extra").fadeOut()
            break;
        case "4":
            $("#occupazione-extra").fadeIn()
            $("#studente-extra").fadeOut()
            break;
        default:
            $("#occupazione-extra").fadeOut()
            $("#studente-extra").fadeOut()
    }
})

$(".update-nc").on('change', function (event) {
    var id = $("#DbAzionicorrettive_codice_riferimento").val();
    if (id) {
        $.ajax({
            url: rootSito + 'index.php/DbAzionicorrettive/NcDetail',
            type: "POST",
            data: {
                'id': id
            },
            success: function (result) {
                $("#refer-codice").html(result.codice)
                $("#codice").html(result.codice)
                $("#refer-descrizione").html(result.descrizione)
                $("#refer-trattamento").html(result.trattamento)
                $("#user-detail").css("display", "block")
            }
        });
    } else
        $("#user-detail").css("display", "none")
});

$("#view-year-calendar").on('click', function (event) {
    $("#calendar-complete").fadeOut('slow', function (event) {
        $("#full-year").fadeIn('slow', function (event) {
            $(".mont-view").fadeOut('fast', function (event) {
                $(".year-view").fadeIn('fast', function (event) {});
            });
        });
    });
});

$("#view-month-calendar").on('click', function (event) {
    $("#full-year").fadeOut('slow', function (event) {
        $("#calendar-complete").fadeIn('slow', function (event) {
            $(".year-view").fadeOut('fast', function (event) {
                $(".mont-view").fadeIn('fast', function (event) {});
            });
        });
    });
});

function chiudiAlert() {
    $(".alert-dismissable").fadeOut('slow', function (event) {});
}

// VERIFICHE ISPETTIVE ESTERNE DETTAGLIO

$(".select-tipi-verifiche").on('change', function (event) {

    var id = $(this).val();
    if (id == '6') {
        $("#box-dettaglio").fadeIn();
        $("#box-processi").fadeOut();
        if ($(this).hasClass("form-update")) {
            $(".processo").addClass("col-md-4").removeClass("col-md-3")
            $("#box-completa").fadeIn();
        }
    } else if (id == 8) {
        $("#box-dettaglio").fadeOut();
        $("#box-processi").fadeIn();
        if ($(this).hasClass("form-update")) {
            $(".processo").addClass("col-md-3").removeClass("col-md-4")
            $("#box-completa").fadeIn();
        }
    } else {
        $("#box-dettaglio").fadeOut();
        $("#box-processi").fadeOut();
        if ($(this).hasClass("form-update")) {
            $(".processo").addClass("col-md-4").removeClass("col-md-3")
            $("#box-completa").fadeOut();
        }
    }
});

$(".select-tipi-processi").on('change', function (event) {

    var id = $(this).val();
    if (id == '5') {
        $("#box-dettaglio").fadeIn();
    } else {
        $("#box-dettaglio").fadeOut();
    }
});

var corso = ""
var gruppo = ""
var iscrittiGruppo = [];
var gruppiCorso = [];

// GESTIONE ISCRITTI AI GRUPPI 
$("#btn-aggiungi-iscritti-gruppo").on('click', function (event) {

    var id = gruppo;

    iscrittiGruppo = [];
    var totale = '';
    var x = 0
    $(".check-user").each(function (event) {
        if ($(this).prop("checked") && $(this).data("refer") != '') {
            x++;
            iscrittiGruppo[x] = $(this).data("refer")
        }
    })

    $.ajax({
        url: rootSito + 'index.php/FormazioneGruppi/setUtenti',
        type: "POST",
        data: {
            'id': id,
            'utenti': iscrittiGruppo
        },
        success: function (result) {
            showPin(result.text);
            $("#box-utenti-gruppi").modal("hide");
            $("#gruppo_" + id).html(result.totale)
        }
    });

});

$("#btn-close-iscritti-gruppo").on('click', function (event) {
    $("#box-utenti-gruppi").modal("hide");
});

$(".add-to-group").on('click', function (event) {

    var id = gruppo = $(this).data("refer");

    $.ajax({
        url: rootSito + 'index.php/FormazioneGruppi/getUtenti',
        type: "POST",
        data: {
            'id': id
        },
        success: function (result) {

            $("#tabella-iscritti-gruppo").html(result.table);
            $("#nome-gruppo").html(result.nome);

            $('.checkbox-green').iCheck({
                checkboxClass: 'icheckbox_square-green'
            });

            console.log(result.nome)
            $("#box-utenti-gruppi").modal("show");

        }
    });

});


// GESTIONE GRUPPI PER I CORSI 

$(".add-group-to-course").on('click', function (event) {

    var id = corso = $(this).data("refer");

    $.ajax({
        url: rootSito + 'index.php/AzioniFormazione/getGruppi',
        type: "POST",
        data: {
            'id': id
        },
        success: function (result) {

            $("#tabella-gruppi-corso").html(result.table);
            $("#nome-corso").html(result.nome);

            $('.checkbox-green').iCheck({
                checkboxClass: 'icheckbox_square-green'
            });

            console.log(result.nome)
            $("#box-gruppi-corso").modal("show");

        }
    });

});

$("#btn-aggiungi-gruppi-corso").on('click', function (event) {

    var id = corso;

    gruppiCorso = [];
    var totale = '';
    var x = 0
    $(".check-gruppo").each(function (event) {
        if ($(this).prop("checked") && $(this).data("refer") != '') {
            x++;
            gruppiCorso[x] = $(this).data("refer")
        }
    })

    $.ajax({
        url: rootSito + 'index.php/AzioniFormazione/setGruppi',
        type: "POST",
        dataType: "json",
        data: {
            'id': id,
            'gruppi': gruppiCorso
        },
        success: function (result) {
            showPin(result.text);
            $(".gruppo_" + id).html(result.totale)
            $("#box-gruppi-corso").modal("hide");
        }
    });

});

$("#btn-close-gruppi-corso").on('click', function (event) {
    $("#box-gruppi-corso").modal("hide");
});

function doNothing() {}

function showPinWarning(text, titolo) {
    new PNotify({
        title: titolo,
        text: text,
        type: 'warning',
        styling: 'fontawesome',
        icon: 'fa fa-triangle',
        opacity: 0.90,
        animation: 'fade',
        animate_speed: 'slow',
        shadow: true,
        cornerclass: 'stack-bottomright',
        delay: 2000
    });
}

function showPin(text, titolo) {
    new PNotify({
        title: titolo,
        text: text,
        type: 'success',
        styling: 'fontawesome',
        icon: 'fa fa-cog fa-spin',
        opacity: 0.90,
        animation: 'fade',
        animate_speed: 'slow',
        shadow: true,
        cornerclass: 'stack-bottomright',
        delay: 2000
    });
}

// VERIFICHE ISPETTIVE 

$(".check-verifica-btn").on('click', function (event) {

    var id = $(this).data("idrefer");
    //inserisco verifica se non presente 
    $.ajax({
        url: rootSito + 'index.php/AzioniVerifiche/verifica',
        type: "POST",
        data: {
            'id': id
        },
        success: function (result) {
            window.location.href = rootSito + 'index.php/' + result.controller + '/compila/' + result.idverifica;
        }
    });

});


var tmpStart
var tmpStop

// FUNZIONI CALENDARIO SET DATA START

function setEventDate(start, stop) {

    var from = start.split("-");
    var to = stop.split("-");
    var end = to[2] - 1;
    var dataIn = from[2] + "-" + from[1] + "-" + from[0];
    var dataOut = end + "-" + to[1] + "-" + to[0];
    tmpStart = dataIn;
    tmpStop = dataOut;


    // console.log(tmpStart+" ===== >>>>> "+tmpStop);

}

// CALENDARIO FORMAZIONE -------------------------------------------------------------------------------------

function checkEventoCalendarioFormazione(id, type) {

    $('#invio_sms').iCheck('uncheck');
    $('#invio_email').iCheck('uncheck');
    $('.check-gruppo').iCheck('uncheck');
    $(".icheckbox_square-green").removeClass("checked");
    $("#form-formazione").trigger('reset');
    $('#messaggio-text').html("");
    $('#messaggio-box').removeClass("alert-success");

    if (id > 0) {
        $('#tipo-calendario-formazione').val('mesi');
        editFormazione(id, type)

        // disabilito pulsante formazione se non ci sono modifiche
        $("#btn-formazione-confirm").addClass("disabled")

    } else {

        $("#messaggio-box").fadeOut('slow', function (event) {
            $("#messaggio-text").html("");
        });

        $('#idFormazione').val("new");
        $('#tipo-calendario-formazione').val('mesi');
        $('#update-formazione').modal('show');
        $('#data_formazione').val(tmpStart);
        $('#data_fine').val();

        $("#btn-formazione-confirm").removeClass("disabled")

    }
}

function editFormazione(id, type) {

    $('#invio_sms').iCheck('uncheck');
    $('#invio_email').iCheck('uncheck');
    $('.check-gruppo').iCheck('uncheck');


    $("#form-formazione").trigger('reset');
    $("#box-dettaglio").fadeOut();
    $("#messaggio-box").fadeOut('slow', function (event) {});

    $.ajax({
        url: rootSito + 'index.php/AzioniFormazione/getFormazione',
        type: "POST",
        data: {
            'action': 'get',
            'id': id
        },
        success: function (result) {

            // Diferenzio in base al tipo di utente uno vede l' latro modifica
            if (result.user == 'admin') {

                $('#idFormazione').val(id);
                $('#data_formazione').val(result.data);
                $('#data_fine').val(result.data_fine);
                $('#titolo_formazione').val(result.titolo);
                $('#AzioniFormazione_id_categoria').val(result.tipo);
                $('#ora_formazione').val(result.ora);
                $('#giorni_invio_sms').val(result.giorni_sms);
                $('#giorni_invio_email').val(result.giorni_email);

                if (result.invio_sms == 'Y')
                    $("#invio_sms").iCheck('check')
                if (result.invio_email == 'Y')
                    $("#invio_email").iCheck('check')

                if (result.gruppi) {
                    for (x = 0; x < result.gruppi.length; x++) {
                        $("#gruppo_" + result.gruppi[x]).iCheck('check')
                    }
                }

                $('#dettaglio').val(result.dettaglio);
                if (result.messaggio) {
                    $('#messaggio-text').html("<b>" + result.messaggio + "</b>");
                    $('#messaggio-box').addClass(" alert-success");
                    $('#messaggio-box').fadeIn();
                }

                $('#update-formazione').modal('show');

            }
            else {
                $('#view-corso-titolo').html(result.titolo);
                $('#view-corso-corso').html(result.view_corso);
                $('#view-corso-data').html(result.view_data);
                $('#view-corso-gruppi').html(result.view_gruppi);
                $('#view-corso-utenti').html(result.view_utenti);
                $('#view-corso-tipo').html(result.view_tipo);
                $('#view-corso-location').html(result.view_location);
                $('#view-corso-descrizione').html(result.view_desc);
                $('#show-formazione').modal('show');
            }

            console.log(result);

        }
    });
}

function checkFormazione(refer) {
    $('#tipo-calendario-formazione').val('anno');
    editFormazione(refer, "")
}

$("#view-year-calendario").on('click', function (event) {
    $("#calendario-formazione").fadeOut('slow', function (event) {
        $("#full-year").fadeIn('slow', function (event) {
            $(".mont-view").fadeOut('fast', function (event) {
                $(".year-view").fadeIn('fast', function (event) {});
            });
        });
    });
});

$("#view-month-calendario").on('click', function (event) {
    $("#full-year").fadeOut('slow', function (event) {
        $("#calendario-formazione").fadeIn('slow', function (event) {
            $(".year-view").fadeOut('fast', function (event) {
                $(".mont-view").fadeIn('fast', function (event) {});
            });
        });
    });
});

$(".formazione").on('click', function (event) {
    checkFormazione($(this).data("refer"))
});

$(".calendar-day-formazione").on('click', function (event) {

    var tmp = $(this).attr('id').split("-");
    $('#tipo-calendario-formazione').val('anno');
    tmpStart = tmp[0] + "-" + tmp[1] + "-" + tmp[2]
    $('#data_formazione').val(tmpStart);
    $('#idFormazione').val("new");
    $('#update-formazione').modal('show');
    $('#codice-formazione').html("");

    console.log(tmpStart + " ===== >>>>> " + tmpStop);

});

$("#btn-formazione-confirm").on('click', function (event) {

    var gruppi = [];
    var error = "";
    var data = $("#data_formazione").val();
    var fine = $("#data_fine").val();
    var titolo = $("#titolo_formazione").val()
    var tipo = $("#AzioniFormazione_id_categoria").val()
    var ora = $("#ora_formazione").val();
    var giorni_invio_sms = $("#giorni_invio_sms").val();
    var giorni_invio_email = $("#giorni_invio_email").val();
    var id = $("#idFormazione").val();
    var calendario = $("#tipo-calendario-formazione").val();
    var invio_sms = "N";
    var invio_email = "N";
    var x = 0

    if (!data)
        error += "- Indicare la data del corso<br />";
    if (!ora)
        error += "- Indicare l'ora del corso<br />";
    if (data && fine && !dayDiff(data, fine))
        error += "- La data di fine corso non può essere inferiore a quella di inizio corso<br />";

    if (!tipo)
        error += "- Indicare il tipo di corso<br />";
    if (!titolo)
        error += "- Indicare il titolo del corso<br />";

    if ($("#invio_sms").prop("checked"))
        invio_sms = "Y";
    if ($("#invio_email").prop("checked"))
        invio_email = "Y";

    $(".check-gruppo").each(function (i) {
        if ($(this).prop("checked")) {
            gruppi[x] = $(this).val()
            x++
        }
    });

    if (error == "") {
        $.ajax({
            url: rootSito + 'index.php/AzioniFormazione/getFormazione',
            type: "POST",
            data: {
                'action': 'set',
                'id': id,
                'data': data,
                'data_fine': fine,
                'tipo': tipo,
                'ora': ora,
                'titolo': titolo,
                'invio_sms': invio_sms,
                'invio_email': invio_email,
                'giorni_invio_sms': giorni_invio_sms,
                'giorni_invio_email': giorni_invio_email,
                'gruppi': gruppi,
                'calendario': calendario
            },
            success: function (result) {

                console.log(result);

                if (result.stato == 'OK') {

                    if (result.remove) {

                        if (result.idRemove) {
                            if (calendario == 'mesi')
                                $('#calendario-formazione').fullCalendar('removeEvents', result.idRemove);
                            if (calendario == 'anno')
                                $('#formazione-' + result.idRemove).remove();
                        }
                        if (calendario == 'mesi')
                            $('#calendario-formazione').fullCalendar("rerenderEvents");
                    }

                    if (result.newDate == 'Y') {

                        var formazione = result.newFormazione
                        for (x = 0; x < formazione.length; x++) {

                            if (calendario == 'mesi') {
                                var nstart = formazione[x]['data_in'].split("-");
                                var nstop = formazione[x]['data_out'].split("-");
                                var myEvent = {
                                    type: 2,
                                    title: formazione[x]['titolo'],
                                    allDay: false,
                                    start: new Date(nstart[0], nstart[1], nstart[2], nstart[3], nstart[4]),
                                    end: new Date(nstop[0], nstop[1], nstop[2], nstop[3], nstop[4]),
                                    id: formazione[x]['id'],
                                    backgroundColor: Utility.getBrandColor(formazione[x]['color'])
                                }
                                $('#calendario-formazione').fullCalendar('renderEvent', myEvent);
                            }
                            if (calendario == 'anno') {
                                $('#box-' + formazione[x]['data_anno']).append(formazione[x]['small']);
                                console.log('#box-' + formazione[x]['data_anno'] + " " + formazione[x]['small']);
                            }

                            showPin(formazione[x]['mex'], "Inserimento corso formazione")
                        }
                    }
                }

                if (result.error != "") {
                    new PNotify({
                        title: '<b>Attenzione !!</b><br />',
                        text: result.error,
                        type: 'error',
                        icon: 'fa fa-alert',
                        styling: 'fontawesome'
                    });
                }

                $("#form-formazione").trigger('reset');

                $('#invio_sms , #invio_email , .check-gruppo').iCheck('uncheck');
            }
        });

        $('#update-formazione').modal("hide");
    } else {
        $("#messaggio-text").html("<b><span class='fa fa-alert'></span>&nbsp;Attenzione</b><br />&nbsp;" + error);
        $("#messaggio-box").fadeIn();
    }

});

$("#btn-formazione-undo").on('click', function (event) {

    $("#form-formazione").trigger('reset');
    $('#invio_sms , #invio_email , .check-gruppo').iCheck('uncheck');
    $('#update-formazione').modal('hide')
});

// CALENDARIO VERIFICHE -------------------------------------------------------------------------------------

$(".remove-disabled").on('change', function (event) {

    $("#btn-verifica-confirm , #btn-formazione-confirm").removeClass("disabled")
});

function checkVerifica(refer) {
    $('#tipo-calendario').val('anno');
    editVerifica(refer, "")
}

function checkEventoCalendario(id, type) {

    $("#form-verifiche").trigger('reset');
    $('#messaggio-text').html("");
    $('#messaggio-box').removeClass("alert-success");
    if (id > 0) {
        $('#tipo-calendario').val('mesi');
        editVerifica(id, type)

        // Aggiunta disabled per modifica verifica 
        $("#btn-verifica-confirm").addClass("disabled")

    } else {
        $("#messaggio-box").fadeOut('slow', function (event) {
            $("#messaggio-text").html("");
        });
        $('#prima_verifica').val(tmpStart);
        //$('#seconda_verifica').val(tmpStop);
        $('#idVerifica').val("new");
        $('#tipo-calendario').val('mesi');
        $('#update-verifiche').modal('show');
        $('#codice-verifica').html("");

        // Aggiunta disabled per modifica verifica 
        $("#btn-verifica-confirm").removeClass("disabled")

    }
}

function editVerifica(id, type) {

    $("#form-verifiche").trigger('reset');
    $("#box-dettaglio").fadeOut();

    $("#messaggio-box").fadeOut('slow', function (event) {});

    $.ajax({
        url: rootSito + 'index.php/AzioniVerifiche/getVerifica',
        type: "POST",
        data: {
            'action': 'get',
            'id': id
        },
        success: function (result) {

            $('#idVerifica').val(id);
            if (result.prima_verifica)
                $('#prima_verifica').val(result.prima_verifica);

            if (result.seconda_verifica)
                $('#seconda_verifica').val(result.seconda_verifica);

            $('#tipo_verifica').val(result.tipo_verifica);
            $('#tipo_processo').val(result.tipo_processo);
            $('#incaricato').val(result.incaricato);
            $('#dettaglio').val(result.dettaglio);

            $('#unita_operativa').val(result.unita_operativa);
            $('.unita_operativa').val(result.unita_operativa);
            $('#codice-verifica').html(result.codice);
            $('#nome-unita').html(result.nome_unita);

            if (result.messaggio) {
                $('#messaggio-text').html("<b>" + result.messaggio + "</b>");
                $('#messaggio-box').addClass(" alert-success");
                $('#messaggio-box').fadeIn();
            }

            if (result.tipo_verifica == '8')
                $("#box-processi").fadeIn();
            else
                $("#box-processi").fadeOut();

            if (result.tipo_verifica == '6' || result.tipo_processo == '5')
                $("#box-dettaglio").fadeIn();
            else
                $("#box-dettaglio").fadeOut();

            $('#update-verifiche').modal('show');


            console.log(result + " \n \n " + id);

        }
    });
}

$(".verifica").on('click', function (event) {
    checkVerifica($(this).data("refer"))
});

$(".calendar-day").on('click', function (event) {

    var tmp = $(this).attr('id').split("-");
    $('#tipo-calendario').val('anno');
    tmpStart = tmp[0] + "-" + tmp[1] + "-" + tmp[2]
    $('#prima_verifica').val(tmpStart);
    $('#seconda_verifica').val("");
    $('#idVerifica').val("new");
    $('#update-verifiche').modal('show');
    $('#codice-verifica').html("");

    alert("----")

});

function dayDiff(start, stop) {

    var day1 = start.split("-");
    var day2 = stop.split("-");
    var date1 = new Date(day1[1] + "-" + day1[0] + "-" + day1[2]);
    var date2 = new Date(day2[1] + "-" + day2[0] + "-" + day2[2]);
    var diff = date2 - date1;

    console.log("data in" + date1 + "\n " + date2 + "\n Diff " + diff)

    if (diff > 0)
        return true;

}

$("#btn-verifica-confirm").on('click', function (event) {

    var error = "";
    var prima_verifica = $("#prima_verifica").val();
    var seconda_verifica = $("#seconda_verifica").val();
    var tipo_verifica = $("#tipo_verifica").val()
    var tipo_processo = $("#tipo_processo").val()
    var unita_operativa = $("#unita_operativa").val();
    var id = $("#idVerifica").val();
    var calendario = $("#tipo-calendario").val();
    var incaricato = $("#incaricato").val();
    var dettaglio = $("#dettaglio").val();

    if (!prima_verifica)
        error += "- Indicare la data della  verifica <br />";
    if (prima_verifica && seconda_verifica && !dayDiff(prima_verifica, seconda_verifica))
        error += "- La data di fine verifica non può essere inferiore alla data di inizio verifica <br />";

    if (!tipo_verifica)
        error += "- Indicare il tipo di verifica <br />";
    if (!unita_operativa)
        error += "- Indicare l'unit&agrave; operativa della verifica <br />";
    if (!incaricato)
        error += "- Indicare l'utente incaricato della verifica <br />";

    if (error == "") {
        $.ajax({
            url: rootSito + 'index.php/AzioniVerifiche/getVerifica',
            type: "POST",
            data: {
                'action': 'set',
                'id': id,
                'prima_verifica': prima_verifica,
                'seconda_verifica': seconda_verifica,
                'tipo_verifica': tipo_verifica,
                'tipo_processo': tipo_processo,
                'unita_operativa': unita_operativa,
                'calendario': calendario,
                'incaricato': incaricato,
                'dettaglio': dettaglio
            },
            success: function (result) {

                if (result.stato == 'OK') {

                    if (result.remove) {

                        if (result.idRemove) {
                            if (calendario == 'mesi')
                                $('#calendar-complete').fullCalendar('removeEvents', result.idRemove);
                            if (calendario == 'anno')
                                $('#verifica-' + result.idRemove).remove();
                        }
                        if (calendario == 'mesi')
                            $('#calendar-complete').fullCalendar("rerenderEvents");
                    }

                    if (result.newDate == 'Y') {

                        var verifiche = result.newVerifiche
                        for (x = 0; x < verifiche.length; x++) {

                            if (calendario == 'mesi') {
                                var nstart = verifiche[x]['data_in'].split("-");
                                var nstop = verifiche[x]['data_out'].split("-");
                                var myEvent = {
                                    type: 2,
                                    title: verifiche[x]['titolo'],
                                    allDay: false,
                                    start: new Date(nstart[0], nstart[1], nstart[2], nstart[3], nstart[4]),
                                    end: new Date(nstop[0], nstop[1], nstop[2], nstop[3], nstop[4]),
                                    id: verifiche[x]['id'],
                                    backgroundColor: Utility.getBrandColor(verifiche[x]['color'])
                                }
                                $('#calendar-complete').fullCalendar('renderEvent', myEvent);
                            }
                            if (calendario == 'anno') {
                                $('#box-' + verifiche[x]['data_anno']).append(verifiche[x]['small']);
                                console.log('#box-' + verifiche[x]['data_anno'] + " " + verifiche[x]['small']);
                            }



                            showPin(verifiche[x]['mex'], "Inserimento verifiche ispettive")
                        }
                    }
                }

                if (result.error != "") {
                    new PNotify({
                        title: '<b>Attenzione !!</b><br />',
                        text: result.error,
                        type: 'error',
                        icon: 'fa fa-alert',
                        styling: 'fontawesome'
                    });
                }
                $("#form-verifiche").trigger('reset');
            }
        });

        $('#update-verifiche').modal("hide");
    } else {
        $("#messaggio-text").html("<b><span class='fa fa-alert'></span>&nbsp;Attenzione</b><br />&nbsp;" + error);
        $("#messaggio-box").fadeIn();
    }

});

$(".field-verifiche").on('click', function (event) {

    $("#messaggio-text").html('');
    $('#messaggio-box').fadeOut();
});

$("#btn-verifica-undo").on('click', function (event) {

    $("#form-verifiche").trigger('reset');
    $('#update-verifiche').modal('hide')
});

// APERURA FORM RICERCA
$("#open-search-btn").on('click', function (event) {
    $('#search-box').modal("show");
});

// APERURA FORM RICERCA
$("#open-insert-btn").on('click', function (event) {
    $('#insert-box').modal("show");
});

$("#open-group-btn").on('click', function (event) {
    $('#add-group-box').modal("show");
});

// SUBMIT DEI FORM 
$(".btn-submit-form").on('click', function (event) {
    $('#' + $(this).data("refer")).submit()
})

// APPROVAZIONE CONTENUTI 
$(".approved ,.non-approved ").on('click', function (event) {
    event.preventDefault();
    var stato = "N"
    var model = $(this).data("model")
    var id = $(this).data("refer")

    if ($(this).hasClass("non-approved"))
        stato = "Y";

    $.ajax({
        url: rootSito + 'index.php/' + model + '/approva',
        type: "POST",
        data: {
            'stato': stato,
            'id': id
        },
        success: function (result) {
            $("#approve-" + id).removeClass(result.class_remove).addClass(result.class_add)
            $("#approve-" + id).attr('title', result.titolo)
            $("#approve-" + id).attr('data-original-title', result.titolo)
            showPin(result.testo, result.titoloPin)
        }
    });
})

function showPin(text, titolo) {
    new PNotify({
        title: titolo,
        text: text,
        type: 'success',
        styling: 'fontawesome',
        icon: 'fa fa-cog fa-spin',
        opacity: 0.90,
        animation: 'fade',
        animate_speed: 'slow',
        shadow: true,
        cornerclass: 'stack-bottomright',
        delay: 2000
    });
}

function setStart() {

    var next = false;

    jQuery(".background-stars").each(function (index) {
        var max = jQuery(this).data("max");
        var step = jQuery(this).data("step");
        if (step < max) {
            var newWidth = step + 10;
            jQuery(this).data("step", newWidth);
            next = true;
        }
        jQuery(this).css("width", newWidth + "%")

    });

    if (next == true)
        setTimeout(function () {
            setStart();
        }, 100);

}

// APERURA FORM RICERCA
$(".sezione").on('change', function (event) {

    var nc = 0;
    var complete = 0
    var classe = $(this).data("class")
    var totale = $("#totale-" + classe).val()

    $("." + classe).each(function (i) {
        if ($(this).val())
            complete++
        if ($(this).val() == 'NC')
            nc++
    });

    var nc_percent = getPercent(nc, complete)
    var complete_percent = getPercent(complete, totale)

    $("#badge-" + classe).html(nc)
    $("#badge-" + classe).removeClass("badge-success , badge-danger , badge-warning ").addClass("badge-" + getColor(nc_percent, "DESC"));
    $("#progress-" + classe).removeClass("progress-bar-success , progress-bar-danger , progress-bar-warning ").addClass("progress-bar-" + getColor(complete_percent, "ASC"));
    $("#progress-" + classe).width(complete_percent + "%");

});

function getColor(tmp, tipo) {

    var color = "warning"
    if (tmp > 75) {
        if (tipo == 'ASC')
            color = "success";
        else
            color = "danger";
    } else if (tmp > 50)
        color = "warning";
    else {
        if (tipo == 'ASC')
            color = "danger";
        else
            color = "success";
    }

    return color
}

function getPercent(quanti, totale) {

    var tmp = 0;

    if (quanti > 0)
        tmp = ((quanti / totale) * 100).toPrecision(2)

    return tmp;
}

$("#Comunicazioni_tipo").on('change', function (event) {

    var p = $("#tipo_comunicazione").val();
    var tipo = $("#Comunicazioni_tipo").val();

    if (p) {
        $("#box-" + p).fadeOut("slow", function () {
            $("#box-" + tipo).fadeIn("slow", function () {});
        });
    } else
        $("#box-" + tipo).fadeIn("slow", function () {

        });

    $("#tipo_comunicazione").val(tipo);

});

function showFormula() {
    var formula = $('#ShPreiscrizioni_formula').val();
    var accomodations = $('#ShPreiscrizioni_campus');

    $.post( rootSito + 'index.php/shPreiscrizioni/accomodations', {"id":formula}, function(data) {
        accomodations.empty().append(data);
    }, 'html');

    /**
    if (formula == 1) {
        $("#housing_box").fadeOut("fast", function () {
            $("#campus_box").fadeIn("fast", function () {});
        });

    } else if (formula == 2) {
        $("#campus_box").fadeOut("fast", function () {
            $("#housing_box").fadeIn("fast", function () {});
        });
    } else {
        $("#campus_box").fadeOut("fast", function () {
            $("#housing_box").fadeOut("fast", function () {});
        });
    }*/
}
$("#TimPreiscrizioni_operatore_supporto_1").on('ifChecked', function (event) {
    $("#tim-supporto-dettaglio").fadeOut();
});

$("#TimPreiscrizioni_operatore_supporto_0").on('ifChecked', function (event) {
    $("#tim-supporto-dettaglio").fadeIn();

});

$("#TimPreiscrizioni_allergie_1").on('ifChecked', function (event) {
    $("#tim-allergie-dettaglio").fadeOut();
});

$("#TimPreiscrizioni_allergie_0").on('ifChecked', function (event) {
    $("#tim-allergie-dettaglio").fadeIn();
});

$("#TimPreiscrizioni_problema_sanitario_0").on('ifChecked', function (event) {
    $("#tim-problema-dettaglio").fadeIn();
});

$("#TimPreiscrizioni_problema_sanitario_1").on('ifChecked', function (event) {
    $("#tim-problema-dettaglio").fadeOut();
});

$("#SpPreiscrizioni_dove_vive_0 ,#SpPreiscrizioni_dove_vive_1 ,#SpPreiscrizioni_dove_vive_2 ,#SpPreiscrizioni_dove_vive_3 ,#SpPreiscrizioni_dove_vive_4 ,#SpPreiscrizioni_dove_vive_5").on('ifChecked', function (event) {
    $("#dovevive").fadeOut();
});

$("#SpPreiscrizioni_dove_vive_6").on('ifChecked', function (event) {
    $("#dovevive").fadeIn();
});

$("#CmPreiscrizioni_altro_genitore_1").on('ifChecked', function (event) {
    $("#altro_genitore").fadeOut();
});

$("#CmPreiscrizioni_altro_genitore_0").on('ifChecked', function (event) {
    $("#altro_genitore").fadeIn();
});

$("#CmPreiscrizioni_dieta_sanitaria_1").on('ifChecked', function (event) {
    $("#dieta_sanitaria_dettaglio").fadeOut();
});

$("#CmPreiscrizioni_dieta_sanitaria_0").on('ifChecked', function (event) {
    $("#dieta_sanitaria_dettaglio").fadeIn();
});

$("#CmPreiscrizioni_dieta_religiosa_1").on('ifChecked', function (event) {
    $("#dieta_religiosa_dettaglio").fadeOut();
});

$("#CmPreiscrizioni_dieta_religiosa_0").on('ifChecked', function (event) {
    $("#dieta_religiosa_dettaglio").fadeIn();
});

$("#CmPreiscrizioni_disabile_0").on('ifChecked', function (event) {
    $("#disabile_dettaglio").fadeIn();
    $("#educatore").fadeIn();
});

$("#CmPreiscrizioni_disabile_1").on('ifChecked', function (event) {
    $("#disabile_dettaglio").fadeOut();
    $("#educatore").fadeOut();
});

$("#DbReclami_non_conformita_1").on('ifChecked', function (event) {
    $("#motivo").fadeIn();
});
$("#DbReclami_non_conformita_0").on('ifChecked', function (event) {
    $("#motivo").fadeOut();
});

$("#SpPreiscrizioni_appartamento_0").on('ifChecked', function (event) {
    $("#show-appartamento-det").fadeIn();
});
$("#SpPreiscrizioni_appartamento_1").on('ifChecked', function (event) {
    $("#show-appartamento-det").fadeOut();
});
$("#SpPreiscrizioni_camera_0").on('ifChecked', function (event) {
    $("#show-camera-det").fadeIn();
});
$("#SpPreiscrizioni_camera_1").on('ifChecked', function (event) {
    $("#show-camera-det").fadeOut();
});
$("#SpPreiscrizioni_animali_0").on('ifChecked', function (event) {
    $("#show-animali-det").fadeIn();
});
$("#SpPreiscrizioni_animali_1").on('ifChecked', function (event) {
    $("#show-animali-det").fadeOut();
});
$("#SpPreiscrizioni_coinquilini_0").on('ifChecked', function (event) {
    $("#show-coinquilini-det").fadeIn();
});

$("#SpPreiscrizioni_coinquilini_1").on('ifChecked', function (event) {
    $("#show-coinquilini-det").fadeOut();
});

$("#SnPreiscrizioni_ruolo").on('change', function (event) {
    if ($(this).val() == '4')
        $("#show-ruoli-det").fadeIn();
    else
        $("#show-ruoli-det").fadeOut();
});


$("#SpPreiscrizioni_livello").on('change', function (event) {
    if ($(this).val() == '7')
        $("#livello-det").fadeIn();
    else
        $("#livello-det").fadeOut();
});


$("#DbReclami_canale").on('change', function (event) {
    if ($(this).val() == '4') {
        $("#canale").removeClass("left-small-big").addClass("left-small-small");
        $("#canale-specificare").fadeIn();
    } else {
        $("#canale-specificare").fadeOut(function () {
            $("#canale").addClass("left-small-big").removeClass("left-small-small")
        });
    }
});

$("#DbReclami_tipologia").on('change', function (event) {
    if ($(this).val() == '3') {
        $("#tipologia").removeClass("left-small-big").addClass("left-small-small");
        $("#tipologia-specificare").fadeIn();
    } else {
        $("#tipologia-specificare").fadeOut(function () {
            $("#tipologia").addClass("left-small-big").removeClass("left-small-small")
        });
    }
});


function getDeliveryEmail(id) {
    $.ajax({
        url: 'https://childrenpark.cooperativadoc.it/admin/index.php/sendEmail/delivery',
        type: "POST",
        data: {
            'id': id
        },
        success: function (result) {
            if (result.totale > 0) {
                $('#have_delivery').css("display", "block");
                $('#no_delivery').css("display", "none");
                $('#delivery_count').html("Totale notifiche per quest'invio: <b>" + result.totale + "</b> ");
                $('#table_body_delivery').html(result.delivery);
            } else {
                $('#have_delivery').css("display", "none");
                $('#no_delivery').css("display", "block");

            }

            $('#sendSms_box').modal("show");

        }
    });
}

function getDelivery(id) {
    $.ajax({
        url: rootSito + 'index.php/InviiSms/delivery',
        type: "POST",
        data: {
            'action': 'get',
            'id': id
        },
        success: function (result) {
            $("#totale-delivery").html("Totale: <b>" + result.totale + "</b>")
            $('#table-delivery').html(result.delivery);
            $('#delivery-box').modal("show");
        }
    });

}

function sendEmail(id, test) {
    $('#sendEmail_destinatario').val(id);
    $('#sendEmail_box').modal("show");
}

function sendSms(id) {
    $('#sms_id_destination').val(id);
    $('#sendSms_box').modal("show");
}

$("#sendSms_confirm").on('click', function (event) {
    $('#sendSms_form').submit();
});

$("#sendSms_undo").on('click', function (event) {
    $('#delivery-box').modal("hide");
});

function delDato(id, tipo) {

    var txt = ""
    var title = ""
    var url = ""

    switch (tipo) {
        case "tim-preiscrizione":
            txt = "<p><b>Attenzione</b> stai per rimuovere una <b>iscrizione TIM</b> </p>";
            title = "Rimozione iscrizione TIM";
            url = "timPreiscrizioni";
            break;

        case "sn-preiscrizione":
            txt = "<p><b>Attenzione</b> stai per rimuovere una <b>iscrizione al convegno</b> </p>";
            title = "Rimozione iscrizione convegno";
            url = "snPreiscrizioni";
            break;
        case "cm-preiscrizione":
            txt = "<p><b>Attenzione</b> stai per rimuovere una <b>iscrizione a facciamo l'albero</b> </p>";
            title = "Rimozione iscrizione facciamo l'albero";
            url = "cmPreiscrizioni";
            break;
        case "sh-preiscrizione":
            txt = "<p><b>Attenzione</b> stai per rimuovere una <b>preiscrizione Sharing</b> </p>";
            title = "Rimozione preiscrizione Sharing";
            url = "shPreiscrizioni";
            break;
        case "fo-preiscrizione":
            txt = "<p><b>Attenzione</b> stai per rimuovere una <b>preiscrizione Cascina Fossata</b> </p>";
            title = "Rimozione preiscrizione Cascina Fossata";
            url = "foPreiscrizioni";
            break;
        case "ca-preiscrizione":
            txt = "<p><b>Attenzione</b> stai per rimuovere una <b>preiscrizione Campus San Paolo</b> </p>";
            title = "Rimozione preiscrizione C. San Paolo";
            url = "caPreiscrizioni";
            break;
        case "sp-preiscrizione":
            txt = "<p><b>Attenzione</b> stai per rimuovere una <b>preiscrizione Stesso Piano</b> </p>";
            title = "Rimozione preiscrizione StessoPiano";
            url = "spPreiscrizioni";
            break;
        case "utente":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un utente</b> </p>";
            title = "Rimozione utente";
            url = "utenti";
            break;
        case "dbNonconforme":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un azione non conforme</b> </p>";
            title = "Rimozione azione non conforme";
            url = "DbNonconforme";
            break;
        case "dbAzionicorrettive":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un azione preventiva / correttiva </b> </p>";
            title = "Rimozione azione preventiva";
            url = "dbAzionicorrettive";
            break;
        case "reclamo":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un reclamo </b> </p>";
            title = "Rimozione reclamo";
            url = "DbReclami";
            break;
        case "azione":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un azione reclamo </b> </p>";
            title = "Rimozione azione reclamo";
            url = "ReclamiAzioni";
            break;
        case "struttura":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una struttura </b> </p>";
            title = "Rimozione struttura";
            url = "strutture";
            break;
        case "societa":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una societ&agrave; </b> </p>";
            title = "Rimozione societ&agrave;";
            url = "societa";
            break;
        case "tipologieStrutture":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una tipologia struttura </b> </p>";
            title = "Rimozione tipologia struttura";
            url = "tipologieStrutture";
            break;
        case "funzioni":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un funzione</b> </p>";
            title = "Rimozione funzioni";
            url = "funzioni";
            break;
        case "utentiTag":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un tag utente</b> </p>";
            title = "Rimozione tag utente";
            url = "utentiTags";
            break;
        case "responsabili":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un responsabile </b> </p>";
            title = "Rimozione responsabile";
            url = "responsabili";
            break;
        case "centri":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un centro </b> </p>";
            title = "Rimozione centro";
            url = "centri";
            break;
        case "tipologieVerifiche":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una tipologia verifica </b> </p>";
            title = "Rimozione tipologia verifica";
            url = "tipologieVerifiche";
            break;
        case "tipologieConformita":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una tipologia non conformit&agrave; </b> </p>";
            title = "Rimozione tipologia conformit&agrave;";
            url = "tipologieConformita";
            break;
        case "tipologieStrutture":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una tipologia struttura </b> </p>";
            title = "Rimozione tipologia struttura";
            url = "tipologieStrutture";
            break;

        case "questionario_doc":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioDoc";
            break;
        case "questionario_sharing":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioSharing";
            break;
        case "questionario_keluar":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioKeluar";
            break;
        case "questionario_formazione":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioFormazione";
            break;
        case "questionario_senior":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioSenior";
            break; /*   */
        case "questionario_genitori_senior":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioGenitoriSenior";
            break;
        case "questionario_genitori_junior":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioGenitoriJunior";
            break;
        case "questionario_genitori_studio":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioGenitoriStudio";
            break;
        case "questionario_genitori_scientifici":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioGenitoriScientifici";
            break;
        case "questionario_junior":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioJunior";
            break;
        case "questionario_studio":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioStudio";
            break;
        case "questionario_scientifici":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioScientifici";
            break;
        case "questionario_torremarina":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioTorremarina";
            break;
        case "questionario_unavacanza":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un questionario </b> </p>";
            title = "Rimozione questionario";
            url = "questionarioUnavacanza";
            break;
        case "utenze_presenze":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>le presenze per questa struttura </b> </p>";
            title = "Rimozione presenze";
            url = "utenzePresenze";
            break;
        case "utenze_gas":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>i consumi gas per questa struttura </b> </p>";
            title = "Rimozione consumi gas";
            url = "utenzeGas";
            break;
        case "utenze_luce":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>i consumi luce per questa struttura </b> </p>";
            title = "Rimozione consumi luce";
            url = "utenzeLuce";
            break;
        case "utenze_acqua":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>i consumi acqua per questa struttura </b> </p>";
            title = "Rimozione consumi acqua";
            url = "utenzeAcqua";
            break;
        case "utenze_chimici":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>i consumi sostanze chimiche per questa struttura </b> </p>";
            title = "Rimozione consumi sostanze chimiche";
            url = "utenzeChimici";
            break;
        case "utenze_rifiuti":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>i consumi rifiuti per questa struttura </b> </p>";
            title = "Rimozione consumi rifiuti";
            url = "utenzeRifiuti";
            break;
        case "matricole":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una matricola contatore </b> </p>";
            title = "Rimozione matricola contatore";
            url = "Matricole";
            break;
        case "letture":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una lettura contatore </b> </p>";
            title = "Rimozione lettura contatore";
            url = "Letture";
            break;
        case "cliente":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un cliente </b> </p>";
            title = "Rimozione cliente";
            url = "Clienti";
            break;
        case "comunicazione":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una comunicazione </b> </p>";
            title = "Rimozione comunicazione";
            url = "Comunicazioni";
            break;
        case "tipologia_formazione":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>tipologia corso </b> </p>";
            title = "Rimozione tipologia corso";
            url = "TipologieFormazione";
            break;
        case "azioniVerifiche":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una verifica ispettiva</b> </p>";
            title = "Rimozione verifica ispettiva";
            url = "AzioniVerifiche";
            break;
        case "azioniVerificheManutenzione":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una verifica ispettiva manutenzione </b> </p>";
            title = "Rimozione verifica amministrazione";
            url = "azioniVerificheManutenzione";
            break;
        case "azioniVerificheAmministrative":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una verifica ispettiva amministrativa </b> </p>";
            title = "Rimozione verifica amministrazione";
            url = "AzioniVerificheAmministrative";
            break;
        case "azioniVerificheSicurezza":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una verifica ispettiva sicurezza </b> </p>";
            title = "Rimozione verifica sicurezza";
            url = "AzioniVerificheSicurezza";
            break;
        case "azioniVerificheEducazione":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una verifica ispettiva servizio educativo </b> </p>";
            title = "Rimozione verifica servizio educativo";
            url = "AzioniVerificheEducazione";
            break;
        case "azioniVerificheEducative":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una verifica ispettiva servizio educativo </b> </p>";
            title = "Rimozione verifica servizio educativo";
            url = "AzioniVerificheEducative";
            break;
        case "azioniVerificheRistorazione":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una verifica ispettiva ristorazione </b> </p>";
            title = "Rimozione verifica ristorazione";
            url = "AzioniVerificheRistorazione";
            break;
        case "azioniVerificheAmbientale":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una verifica ispettiva ambiente </b> </p>";
            title = "Rimozione verifica ambiente";
            url = "AzioniVerificheAmbientale";
            break;
        case "formazioneCorso":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un corso formazione </b> </p>";
            title = "Rimozione corso formazione";
            url = "FormazioneCorsi";
            break;
        case "formazioneGruppo":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un gruppo corso formazione </b> </p>";
            title = "Rimozione gruppo corso";
            url = "FormazioneGruppi";
            break;
        case "formazioneCategoria":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una categoria corso formazione </b> </p>";
            title = "Rimozione categoria corsi";
            url = "FormazioneCategorie";
            break;
        case "azioniFormazione":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un  corso formazione </b> </p>";
            title = "Rimozione corso formazione";
            url = "azioniFormazione";
            break;
        case "timTurni":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un  turno</b> </p>";
            title = "Rimozione turno";
            url = "timTurni";
            break;
        case "timCentri":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un centro</b> </p>";
            title = "Rimozione centro";
            url = "timCentri";
            break;
        case "timFascie":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una fascia</b> </p>";
            title = "Rimozione fascia";
            url = "timFascie";
            break;
        case "timFunzioni":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una funzione</b> </p>";
            title = "Rimozione funzione";
            url = "timFunzioni";
            break;
        case "timSedi":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una sede</b> </p>";
            title = "Rimozione sede";
            url = "timSedi";
            break;
        case "timSocieta":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una societ&agrave;</b> </p>";
            title = "Rimozione societ&agrave;";
            url = "timSocieta";
            break;
        case "timSoggiorni":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>un soggiorno</b> </p>";
            title = "Rimozione soggiorno";
            url = "timSoggiorni";
            break;
        case "timPartenze":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>una partenza</b> </p>";
            title = "Rimozione partenza";
            url = "timPartenze";
            break;
		case "campusFossata":
			txt = "<p><b>Attenzione</b> stai per rimuovere <b>una formula</b> </p>";
            title = "Rimozione formula";
            url = "CampusFossata";
			break;
		case "housingFossata":
			txt = "<p><b>Attenzione</b> stai per rimuovere <b>un housing</b> </p>";
            title = "Rimozione housing";
            url = "HousingFossata";
			break;
        case "document":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>il documento</b> </p>";
            title = "Elimina documento";
            url = "document";
            break;
        case "documentCategory":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>la categoria documento</b> </p>";
            title = "Elimina categoria documento";
            url = "documentCategory";
            break;
        case "documenti":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>il documento</b> </p>";
            title = "Elimina documento";
            url = "documentiQualita";
            break;
        case "documentiSoggiorni":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>il documento</b> </p>";
            title = "Elimina documento";
            url = "documentiSoggiorni";
            break;
        case "tipologiaDocumenti":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>la tipologia documento</b> </p>";
            title = "Elimina tipologia";
            url = "documentiQualitaProcedura";
            break;
        case "tipologiaDocumentiSoggiorni":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>la tipologia documento</b> </p>";
            title = "Elimina tipologia";
            url = "documentiSoggiorniProcedura";
            break;
        case "verificheQuestions":
            txt = "<p><b>Attenzione</b> stai per rimuovere <b>la domanda</b> </p>";
            title = "Elimina domanda";
            url = "verificheQuestions";
            break;
        case "verificheQuestionsGroups":
            txt = "<p><b>Attenzione</b> stai per rimuovere la sezione <b>dal form</b> </p>";
            title = "Elimina sezione";
            url = "verificheQuestionsGroups";
            break;
        case 'surveystays':
            txt = '<p><b>Attenzione</b> stai per rimuovere il questionario selezionato</p>';
            title = 'Elimina questionario';
            url = 'surveyStays';
            break;
    }

    txt += "<p>Sicuro di voler continuare ?<br /> Tutti i dati ad esso associati andranno persi e non sar&agrave; possibile recuperarli</p>"
    $("#delDato_txt").html(txt);
    $("#delDato_confirm").removeClass("hide");
    $("#delDato_title").html(title);
    $('#delDato_form').attr("href", rootSito + "index.php/" + url + "/delete/" + id);
    $('#delDato_box').modal("show");

}

function addPush(id, tipo) {

    $.ajax({
        url: rootSito + '/index.php/utenti/getNotifiche',
        type: "POST",
        data: {
            'id': id
        },
        success: function (result) {
            var questionari = new Array("q_keluar", "q_doc", "q_sharing", "q_campus", "q_senior", "q_junior", "q_studio", "q_scientifici", "q_formazione", "q_vacanza");
            for (i = 0; i < questionari.length; i++) {
                if (result.dati[questionari[i]] == "Y")
                    $("#" + questionari[i]).iCheck('check');
                else
                    $("#" + questionari[i]).iCheck('uncheck');
            }
            $('#notification-id').val(id)
            $('#notification-user').html(result.dati['user'])
            $('#notification-box').modal("show");

        }
    });
}

$("#notification-confirm").on('click', function (event) {

    var questionari = new Array();
    var id = $('#notification-id').val()

    $('.q_check').each(function (i) {
        if ($(this).is(':checked'))
            questionari[$(this).attr("id")] = "Y";
        else
            questionari[$(this).attr("id")] = "N";
    });
    $.ajax({
        url: rootSito + '/index.php/utenti/setNotifiche',
        type: "POST",
        data: {
            'id': id,
            'q_keluar': questionari['q_keluar'],
            'q_sharing': questionari['q_sharing'],
            'q_campus': questionari['q_campus'],
            'q_scientifici': questionari['q_scientifici'],
            'q_studio': questionari['q_studio'],
            'q_doc': questionari['q_doc'],
            'q_junior': questionari['q_junior'],
            'q_senior': questionari['q_senior'],
            'q_formazione': questionari['q_formazione'],
            'q_vacanza': questionari['q_vacanza']

        },
        success: function (result) {
            $('#notification-box').modal("hide");
            new PNotify({
                title: 'Abilitazione notifiche',
                text: result.text,
                type: 'success',
                styling: 'fontawesome',
                icon: 'fa fa-bell-o',
                opacity: 0.90,
                animation: 'fade',
                animate_speed: 'slow',
                shadow: true,
                cornerclass: 'stack-bottomright',
                delay: 2000

            });
        }
    });

});

$("#notification-undo").on('click', function (event) {
    $('#notification-box').modal("hide");
});

$(".close-summary").on('click', function (event) {
    $('.errorSummary').css("display", "none");
});

$("#delDato_undo").on('click', function (event) {
    $('#delDato_box').modal("hide");
});


$("#delDato_confirm").on('click', function (event) {
    location.href = $('#delDato_form').attr("href");
});
$(".close-summary").on('click', function (event) {
    $('.errorSummary').css("display", "none");
});

// SUBMIT DEI FORM PRE ISCIZIONI 
$("#questionarioScientifici-btn").on('click', function (event) {
    $('#questionarioScientifici-form').submit()
})
$("#questionarioStudio-btn").on('click', function (event) {
    $('#questionarioStudio-form').submit()
})
$("#questionarioJunior-btn").on('click', function (event) {
    $('#questionarioJunior-form').submit()
})
$("#questionarioSenior-btn").on('click', function (event) {
    $('#questionarioSenior-form').submit()
})

$("#sp-preiscrizioni-btn").on('click', function (event) {
    $('#sp-preiscrizioni-form').submit()
});

$("#cm-preiscrizioni-btn").on('click', function (event) {
    $('#cm-preiscrizioni-form').submit()
});

$("#sh-preiscrizioni-btn").on('click', function (event) {
    $('#sh-preiscrizioni-form').submit()
});

$("#ca-preiscrizioni-btn").on('click', function (event) {
    $('#ca-preiscrizioni-form').submit()
});
$("#questionario-formazione-btn").on('click', function (event) {
    $('#questionario-formazione-form').submit()
});

$("#sn-preiscrizioni-btn").on('click', function (event) {
    $('#sn-preiscrizioni-form').submit()
});
$("#tim-preiscrizioni-btn").on('click', function (event) {
    $('#tim-preiscrizioni-form').submit()
});

$("#db-nonconforme-btn").on('click', function (event) {
    $('#db-nonconforme-form').submit()
});
$("#db-azionicorrettive-btn").on('click', function (event) {
    $('#db-azionicorrettive-form').submit()
});
$("#db-reclami-btn").on('click', function (event) {
    $('#db-reclami-form').submit()
});
$("#reclami-azioni-btn").on('click', function (event) {
    $('#reclami-azioni-form').submit()
});
// SUBMIT DEI FORM 
$("#utenti-btn").on('click', function (event) {
    $('#utenti-form').submit()
});

$("#tipologie-formazione-btn").on('click', function (event) {
    $('#tipologie-formazione-form').submit()
});

$("#matricole-btn").on('click', function (event) {
    $('#matricole-form').submit()
});

$("#letture-btn").on('click', function (event) {
    $('#letture-form').submit()
});

$("#strutture-btn").on('click', function (event) {
    $('#strutture-form').submit()
});

$("#clienti-btn").on('click', function (event) {
    $('#clienti-form').submit()
});

$("#comunicazione-btn").on('click', function (event) {
    $('#comunicazione-form').submit()
});

$("#send-sms-btn").on('click', function (event) {
    $('#send-sms-form').submit()
});

$("#send-email-btn").on('click', function (event) {
    $('#send-email-form').submit()
});

// SUBMIT GENERICO FORM RICERCA
$("#search-form-btn").on('click', function (event) {
    $('#search-form-int').submit()
});

// APERURA FORM RICERCA
$("#box-form-btn").on('click', function (event) {
    $('#search-form-box').css("display", "block");
    $(this).css("display", "none")
});

$("#variabili_sms").on('change', function (event) {

    var instext = $(this).val()
    var mess = document.getElementById('SendSms_testo');

    //IE support
    if (document.selection) {
        mess.focus();
        sel = document.selection.createRange();
        sel.text = instext;
    }
    //MOZILLA/NETSCAPE support
    else if (mess.selectionStart || mess.selectionStart == "0") {
        var startPos = mess.selectionStart;
        var endPos = mess.selectionEnd;
        var chaine = mess.value;

        mess.value = chaine.substring(0, startPos) + instext + chaine.substring(endPos, chaine.length);
        mess.selectionStart = startPos + instext.length;
        mess.selectionEnd = endPos + instext.length;
    } else {
        mess.value += instext;
    }
    mess.focus();

});

$("#variabili_email").on('change', function (event) {

    var instext = $(this).val()
    var mess = document.getElementById('SendEmail_testo');
    //IE support
    if (document.selection) {
        mess.focus();
        sel = document.selection.createRange();
        sel.text = instext;
    }
    //MOZILLA/NETSCAPE support
    else if (mess.selectionStart || mess.selectionStart == "0") {
        var startPos = mess.selectionStart;
        var endPos = mess.selectionEnd;
        var chaine = mess.value;

        mess.value = chaine.substring(0, startPos) + instext + chaine.substring(endPos, chaine.length);
        mess.selectionStart = startPos + instext.length;
        mess.selectionEnd = endPos + instext.length;
    } else {
        mess.value += instext;
    }
    mess.focus();
});

// REFRESH STATISTICHE CON PARAMETRI
/*$("#btn-update-stats").on('click', function (event) {
    var struttura = $('#struttura').val()
    var anno   = $('#anno').val()
    var gruppo = $('#nome_gruppo').val();
    var turno  = $('#turno').val();
    var model  = $(this).data("model")
    window.location.href = "http://qualita.cooperativadoc.it/qualita_new/index.php/questionario" + model + "/grafici?struttura=" + struttura + "&anno=" + anno + "&gruppo=" + gruppo + "&turno=" + turno;
});*/

$("#btn-update-stats").on('click', function (event) {
    var struttura = $('#struttura').val()
    var anno   = $('#anno').val()
    //var gruppo = $('#nome_gruppo').val();
    //var turno  = $('#turno').val();
    var type  = $(this).data("type")
    window.location.href = "http://qualita.cooperativadoc.it/qualita_new/index.php/survey-stays/stats/"+type+"?struttura=" + struttura + "&anno=" + anno;
});

// APERURA FORM RICERCA
$("#stats-doc-btn").on('click', function (event) {
    var struttura = $('#struttura').val()
    var anno = $('#anno').val()
    window.location.href = "http://qualita.cooperativadoc.it/qualita_new/index.php/questionarioDoc/grafici?struttura=" + struttura + "&anno=" + anno;
});

$("#stats-keluar-btn").on('click', function (event) {
    var struttura = $('#struttura').val()
    var anno = $('#anno').val()
    window.location.href = "http://qualita.cooperativadoc.it/qualita_new/index.php/questionarioKeluar/grafici?struttura=" + struttura + "&anno=" + anno;
});

$("#stats-formazione-btn").on('click', function (event) {
    var tipo_corso = $('#tipologia').val()
    var titolo = $('#titolo').val()
    var anno = $('#anno').val()
    window.location.href = "http://qualita.cooperativadoc.it/qualita_new/index.php/questionarioFormazione/grafici?tipologia=" + tipo_corso + "&anno=" + anno + "&titolo=" + titolo;
});

$("#stats-sharing-btn").on('click', function (event) {
    var struttura = $('#struttura').val()
    var anno = $('#anno').val()
    window.location.href = "http://qualita.cooperativadoc.it/qualita_new/index.php/questionarioSharing/grafici?struttura=" + struttura + "&anno=" + anno;
});

$("#stats-torremarina-btn").on('click', function (event) {
    var struttura = $('#struttura').val()
    var anno = $('#anno').val()
    window.location.href = "http://qualita.cooperativadoc.it/qualita_new/index.php/questionarioTorremarina/grafici?struttura=" + struttura + "&anno=" + anno;
});

$("#stats-presenze-btn").on('click', function (event) {
    
    
    var tipo      = $("#tipo").val() 
    var anno        = $("#anno").val()
    
    window.location.href = "http://qualita.cooperativadoc.it/qualita_new/index.php/utenzePresenze/stats?anno="+anno+"&tipo="+tipo;
});


$("#stats-utenze-btn").on('click', function (event) {
    
    var struttura   = $("#struttura").val() 
    var anno        = $("#anno").val()
    
    window.location.href = "http://qualita.cooperativadoc.it/qualita_new/index.php/utenzePresenze/statistiche?anno="+anno+"&struttura="+struttura;
});

$("#stats-generali-btn").on('click', function (event) {
    window.location.href = "http://qualita.cooperativadoc.it/qualita_new/index.php/dbReclami/statistiche?anno="+$('#anno').val();
});

$("#stampa-grafici-btn").on('click', function (event) {
    
    event.preventDefault;
    
    var struttura   = $("#struttura-utente").val(); 
    var model       = $(this).data("model");
    var anno        = $("#struttura-anno").val();
    var type        = $(this).data('type');
    
    $('#wait').modal("show");
     $.ajax({
        url: rootSito + 'index.php/'+model+'/stampaGrafici/',
        type: "POST",
        data: {
            'anno': anno,
            'model': model,
            'struttura': struttura,
            'type': type,
        },
        success: function (result) {
            $('#wait').modal("hide");
            window.open(rootSito+result.stampa,'_blank');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    })
})


$("#stampa-grafici-strutture-btn").on('click', function (event) {
    
    event.preventDefault;
    
    var tipo   = $("#tipo").val() 
    var anno   = $("#anno").val()
    
    $('#wait').modal("show");
     $.ajax({
        url: rootSito + 'index.php/UtenzePresenze/stampaGraficiStrutture',
        type: "POST",
        data: {
            'anno': anno,
            'tipo': tipo,
        },
        success: function (result) {
            $('#wait').modal("hide");
            window.open(rootSito+"/"+result.stampa,'_blank');
           
        }
    })
})


$(".stampa-grafici-formazione").on('click', function (event) {
    event.preventDefault;
    
    var corso  = $("#nome_corso_"+$(this).data("corso")).val()
    
    $('#wait').modal("show");
     $.ajax({
        url: rootSito + 'index.php/questionarioFormazione/stampaGrafici',
        type: "POST",
        dataType: "json",
        data: {
            'corso': corso,
        },
        success: function (result) {
            $('#wait').modal("hide");
            window.open(rootSito+"/"+result.stampa,'_blank');
           
        }
    })
})

$("#add-extra").on('click', function (event) {

    event.preventDefault();

    var row = $(".row-extra").length
    $('#no-extra').fadeOut();
    $.ajax({
        url: 'https://qualita.cooperativadoc.it/qualita_new/index.php/dbReclami/getAzione',
        type: "POST",
        data: {
            'id': row
        },
        success: function (result) {
            $('#extra-block').append(result.text).fadeIn()

            $(".richiamo").datepicker({
                todayHighlight: true,
                todayBtn: true,
                language: 'it',
                format: "dd-mm-yyyy"
            }).on('changeDate', function (e) {
                $(this).datepicker('hide');
            });

        }
    });
});

$(".convalida_utenza").on('click', function (event) {

    event.preventDefault();
    var tmp = $(this).attr("id");
    var anno = "";
    var struttura = "";
    var id = "";
    var model = "";
    var form = "";

    switch (tmp) {
        case "utenze-acqua-btn":
            anno = $("#UtenzeAcqua_anno").val();
            struttura = $("#UtenzeAcqua_struttura").val();
            id = $("#UtenzeAcqua_id").val();
            model = "utenzeAcqua";
            form = "utenze-acqua-form";
            break;
        case "utenze-gas-btn":
            anno = $("#UtenzeGas_anno").val();
            struttura = $("#UtenzeGas_struttura").val();
            id = $("#UtenzeGas_id").val();
            model = "utenzeGas";
            form = "utenze-gas-form";
            break;
        case "utenze-luce-btn":
            anno = $("#UtenzeLuce_anno").val();
            struttura = $("#UtenzeLuce_struttura").val();
            id = $("#UtenzeLuce_id").val();
            model = "utenzeLuce";
            form = "utenze-luce-form";
            break;
        case "utenze-presenze-btn":
            anno = $("#UtenzePresenze_anno").val();
            struttura = $("#UtenzePresenze_struttura").val();
            id = $("#UtenzePresenze_id").val();
            model = "utenzePresenze";
            form = "utenze-presenze-form";
            break;
        case "utenze-rifiuti-btn":
            anno = $("#UtenzeRifiuti_anno").val();
            struttura = $("#UtenzeRifiuti_struttura").val();
            id = $("#UtenzeRifiuti_id").val();
            model = "utenzeRifiuti";
            form = "utenze-rifiuti-form";
            break;
        case "utenze-chimici-btn":
            anno = $("#UtenzeChimici_anno").val();
            struttura = $("#UtenzeChimici_struttura").val();
            id = $("#UtenzeChimici_id").val();
            model = "utenzeChimici";
            form = "utenze-chimici-form";
            break;
    }





    if (!id) {
        $.ajax({
            url: "https://qualita.cooperativadoc.it/qualita_new/index.php/" + model + "/verifica",
            type: "POST",
            data: {
                'anno': anno,
                'struttura': struttura
            },
            success: function (result) {
                if (result.exist) {
                    var txt = "Attenzione sono gi&agrave; stati inseriti i dati per questa struttura e per quest'anno</p> <p> - Modificare l'anno o la struttura </p> <p> Se i dati sono corretti andare a modificare quelli inseriti in precedenza</p>"
                    $("#delDato_txt").html(txt);
                    $("#delDato_title").html("Attenzione!!");
                    $('#delDato_confirm').fadeOut();
                    $('#delDato_undo').html("OK");
                    $('#delDato_box').modal("show");
                } else
                    $('#' + form).submit()
            }
        });
    } else
        $('#' + form).submit()
});

$(".utenza").on('change', function (event) {

    event.preventDefault();
    var tmp = $(this).attr("id");
    var anno = "";
    var struttura = "";
    var model = "";
    var form_s = "";

    switch (tmp) {
        case "UtenzeAcqua_anno":
        case "UtenzeAcqua_struttura":
            anno = $("#UtenzeAcqua_anno").val();
            struttura = $("#UtenzeAcqua_struttura").val();
            model = "utenzeAcqua";

            break;
        case "UtenzeGas_anno":
        case "UtenzeGas_struttura":
            anno = $("#UtenzeGas_anno").val();
            struttura = $("#UtenzeGas_struttura").val();
            model = "utenzeGas";

            break;
        case "UtenzeLuce_anno":
        case "UtenzeLuce_struttura":
            anno = $("#UtenzeLuce_anno").val();
            struttura = $("#UtenzeLuce_struttura").val();
            model = "utenzeLuce";

            break;
        case "UtenzePresenze_anno":
        case "UtenzePresenze_struttura":
            anno = $("#UtenzePresenze_anno").val();
            struttura = $("#UtenzePresenze_struttura").val();
            model = "utenzePresenze";

            break;
    }

    $.ajax({
        url: "https://qualita.cooperativadoc.it/qualita_new/index.php/" + model + "/verifica",
        type: "POST",
        data: {
            'anno': anno,
            'struttura': struttura
        },
        success: function (result) {
            if (result.exist) {
                var txt = "Attenzione sono gi&agrave; stati inseriti i dati per questa struttura e per quest'anno</p> <p> - Modificare l'anno o la struttura </p> <p> Se i dati sono corretti andare a modificare quelli inseriti in precedenza</p>"
                $("#delDato_txt").html(txt);
                $("#delDato_title").html("Attenzione!!");
                $('#delDato_confirm').fadeOut();
                $('#delDato_undo').html("OK");
                $('#delDato_box').modal("show");
            }
        }
    });

});

$(".btn-export").on('click', function (event) {

    event.preventDefault();
    var id = $(this).attr("id")
    var label = '';

    switch (id) {
        case "UtenzeLuce":
            label = "i Consumi Luce";
            break;
        case "UtenzeGas":
            label = "i Consumi gas";
            break
        case "UtenzeAcqua":
            label = "i Consumi acqua";
            break
        case "UtenzePresenze":
            label = "le Presenze strutture";
            break
        case "dbNonconforme":
            label = "le Azioni non conformi";
            break
        case "dbAzionicorrettive":
            label = "le Azioni corretive";
            break
        case "dbReclami":
            label = "i reclami";
            break
        case "ReclamiAzioni":
            label = "le azioni reclami";
            break

    }

    $("#detail-export").html(label);
    $("#id_export").val(id);
    $('#export_box').modal("show");


});

$("#export_undo").on('click', function (event) {

    $('.checkbox-green').each(function (i) {
        $(this).iCheck('uncheck');
    });

    $('#export_box').modal("hide");
});

$("#export_confirm").on('click', function (event) {

    var anni = new Array();
    var model = $("#id_export").val()
    $('.checkbox-green').each(function (i) {

        if ($(this).is(':checked'))
            anni[$(this).attr("id")] = $(this).val();
        else
            anni[$(this).attr("id")] = "0";
    });

    var url = "https://qualita.cooperativadoc.it/qualita_new/index.php/" + model + "/esporta?anni=" + anni.join(",")


    $('.checkbox-green').each(function (i) {

        $(this).iCheck('uncheck');
    });


    $('#export_box').modal("hide");
    location.href = url;
});


function testOver() {
    $('#body').addClass("overlay");
    $('#over-test-block').addClass("overlay-message");

}

// FUNZIONI LOGIN

$("#btn-forgot").on('click', function (event) {
    event.preventDefault();
    $("#pulsante-accedi").fadeOut("slow", function () {
        $("#pulsante-reset").fadeIn();
    });

    $("#box-login").fadeOut("slow", function () {
        $("#box-reset").fadeIn();
    });

});

$("#btn-remember").on('click', function (event) {
    event.preventDefault();

    $("#pulsante-reset").fadeOut("slow", function () {
        $("#pulsante-accedi").fadeIn();
    });

    $("#box-reset").fadeOut("slow", function () {
        $("#box-login").fadeIn();
    });

});

$("#pulsante-reset").on('click', function (event) {

    event.preventDefault();

    var email = $("#LoginForm_email").val();
    var nome = $("#LoginForm_nome").val();

    if (nome || email) {
        $.ajax({
            url: rootSito + 'index.php/site/reset',
            type: "POST",
            data: {
                'email': email,
                'codice': nome
            },
            success: function (result) {
                var testo = result.testo

                if (result.stato == 'OK') {

                    $("#box-reset").fadeOut("slow", function () {
                        $("#box-login").fadeIn();
                    });
                    $("#pulsante-reset").fadeOut("slow", function () {
                        $("#pulsante-accedi").fadeIn();
                    });


                    $("#reset-ok-text").html(testo)
                    $("#alert-ok").fadeIn()

                } else {

                    $("#reset-ko-text").html(testo)
                    $("#alert-ko").fadeIn()

                }

                setTimeout(function () {
                    chiudiAlert()
                }, 3000);
            }
        });
    }
});

// NUOVE FUNZIONI ADMIN
$(".strutture").on('click', function (event) {
	event.preventDefault()
    
        var struttura    = $("#Utenti_user_unita").val();
    	$.ajax({
        url: rootSito + 'index.php/site/ajaxStrutture',
        type: "POST",
        data: {
            'struttura':struttura,
        },
        
        success: function (result) {
                
                $("#modal-strutture").modal("show")
                $("#modal-strutture-titolo").html(result.dati['titolo'])
                $("#modal-strutture-testo").html(result.dati['list'])
                
                $('.checkbox-blue').iCheck({
                    checkboxClass: 'icheckbox_minimal-orange'
                });
                                
                $(".check-struttura").on('ifChecked', function (event) {
                    event.preventDefault()
                    addStruttura( $(this).data("valore") ,$(this).data("codice"))
                });
                                                
                $(".check-struttura").on('ifUnchecked', function (event) {
                    event.preventDefault()
                    removeStruttura( $(this).data("valore") )
                });
        }
    });
});

function addStruttura(id,codice){
    var c = new Array();
    var tmp = $("#Utenti_user_unita").val()
    var app ='<span class="token" id="ctoken-'+id+'" ><span class="token-label" >'+codice+'</span><a href="javascript:removeStruttura('+id+')" data-refer="'+id+'" class="close-token" tabindex="-1">×</a></span>' 
       
    if(tmp)
      c = tmp.split(",")
        
    // Inserire solo se non presente
    if(c.indexOf(id) != -1 ){
	   console.log(app)
    }else{
         c.push(id);
	    $("#Utenti_strutture_tag").append(app);
    }
    	
          
    $("#Utenti_user_unita").val(c.join(",") )   
}

function removeStruttura(id){
    
    var c =    $("#Utenti_user_unita").val().split(",")
    
    for( var i = 0; i < c.length; i++){ 
        
        if ( c[i] == id) {
            c.splice(i, 1); 
        }
    }
    
    $("#ctoken-"+id).remove()
    $("#Utenti_user_unita").val(c.join(",")  )
}

$(".close-token").on('click', function (event) {
    event.preventDefault()
    removeStruttura( $(this).data("refer"))
});

$('#modal-strutture-dismiss').on('click', function (event) {
     $("#modal-corelati").modal("hide")
});
