var J = jQuery.noConflict();

window.onload = function () {

    /*J('.radio-blu').iCheck({
        radioClass: 'iradio_square-orange'
    });

    J('.check-blue').iCheck({
        checkboxClass: 'icheckbox_square-orange'
    });*/
    
    J("#data_nascita ,#data_arrivo, #data_partenza").datepicker({
        todayHighlight: true,
        language: 'it',
        format: "dd-mm-yyyy",
        autoclose: true,
        showOnFocus: false,
        minDate: new Date()
    }).on('changeDate', function (e) {
        J(this).datepicker('hide');
    })
    
}

J(".check-error").on('ifClicked', function(event){
    J("#error_"+J(this).data("refer")).html("").fadeOut("fast");
    console.log(J(this).val())
});

J('.data_picker').click(function () {
    J("#" + J(this).data("refer")).datepicker('show');
});

J("#info_link").on('click', function (event) {
    J('#modal-privacy').modal("show");
});

J(".valida,#campus").on('change', function (event) {

    event.preventDefault()
    var tipo = J(this).data("tipo")
    var val = J(this).val()
    var label = J(this).data("label")

    if (!val && tipo != 'data')
        J(this).addClass("form_error")
    else if (!isValidField(tipo, val, "", "") && tipo != 'data' && val)
        J(this).addClass("form_error")
    else
        J(this).removeClass("form_error")

});

J("#btn-submit-form").on('click', function (event) {
    event.preventDefault()
    var from        = J(this).data("refer")
    var informativa = J('input[name="informativa"]:checked', '#' + from).val()
    var privacy     = J('input[name="privacy"]:checked', '#' + from).val()
    var sesso       = J('input[name="sesso"]:checked', '#' + from).val()
    var prima_volta = J('input[name="prima_volta"]:checked', '#' + from).val()
    var arrivo      = J("#data_arrivo").val();
    var partenza    = J("#data_partenza").val();
    var error       = "";
    
    
    // VALIDA CAMPI OBBLIGATORI
    J(".valida").each(function (index) {
        var tipo = J(this).data("tipo")
        var val = J(this).val()
        var label = J(this).data("label")

        if (!val && J(this).hasClass("obbligatorio")) {
            J(this).addClass("form_error")
            error += "<li class='error-row'>" + getError("OBLI", label) + "</li>"

        } else if (val && !isValidField(tipo, val, "", "")) {
            J(this).addClass("form_error")
            error += "<li class='error-row'>" + getError("INVALID", label) + "</li>"
        } else
            J(this).removeClass("form_error")
    });
    
    // CAMPO SESSO 
    if (!sesso) {
        error += "<li class='error-row'>" + getError("OBLI", J("#sesso").data("label") ) + "</li>"
        J( "#error_sesso" ).html(getError("OBLI", J("#sesso").data("label") )).fadeIn();
    }else
        J( "#error_sesso" ).html("").fadeOut();
    
    // CAMPO PRIMA VOLTA
    if (!prima_volta) {
        error += "<li class='error-row'>" + getError("OBLI", J("#prima_volta").data("label") ) + "</li>"
        J( "#error_prima_volta" ).html(getError("OBLI",  J("#prima_volta").data("label") ) ).fadeIn();
    }else
        J( "#error_prima_volta" ).html("").fadeOut();
	
	var formula = J("#formula").val()
    
    // TIPO ALLOGGIO
    if(from =='form-sharing'){ // SHARING
        if(!formula){
            J("#formula").addClass("form_error")
            error += "<li class='error-row'>" + getError("OBLI", J("#formula").data("label")) + "</li>"
        }
		else {
			if( !J("#campus").val() ){
				J("#campus").addClass("form_error")
				error += "<li class='error-row'>" + getError("OBLI", J("#campus").data("label")) + "</li>"
			}
			else {
                J("#campus").removeClass("form_error")
            }
            
            /*if(formula =='1'){
                
                if( !J("#campus").val() ){
                    J("#campus").addClass("form_error")
                    error += "<li class='error-row'>" + getError("OBLI", J("#campus").data("label")) + "</li>"
                }else
                    J("#campus").removeClass("form_error")
                
            }else if(formula =='2' || formula == 5){
                
                if( !J("#housing").val() ){
                    J("#housing").addClass("form_error")
                    error += "<li class='error-row'>" + getError("OBLI", J("#housing").data("label")) + "</li>"
                }else
                    J("#housing").removeClass("form_error")
            }*/
        }
        
    }else if(from == 'form-campus'){  // CAMPUS SAN PAOLO 
        
        if(!J("#campus").val() ){
            J("#campus").addClass("form_error")
            error += "<li class='error-row'>" + getError("OBLI", J("#campus").data("label")) + "</li>"
        }else
            J("#campus").removeClass("form_error")
        
    }else if (from =='form-fossata'){ // CASCINA FOSSATA 
        
		if(formula==1) {
			if(!J("#campus").val()){
				J("#campus").addClass("form_error")
				error += "<li class='error-row'>" + getError("OBLI", J("#campus").data("label")) + "</li>"
			}else
				J("#campus").removeClass("form_error")
		}
		else if(formula==2) {
			if( !J("#housing").val()){
				J("#housing").addClass("form_error")
				error += "<li class='error-row'>" + getError("OBLI", J("#housing").data("label")) + "</li>"
			}else
				J("#housing").removeClass("form_error")
		}
		else {
			J("#formula").addClass("form_error")
            error += "<li class='error-row'>" + getError("OBLI", J("#formula").data("label")) + "</li>"
		}
	}
    
    
    //PRIVACY 
    if (!privacy) {
        error += "<li class='error-row'>" + getError("PRIVACY", "") + "</li>"
        J( "#error_privacy" ).html(getError("PRIVACY", "")).fadeIn();
    }else
        J( "#error_privacy" ).html("").fadeOut();

    // INFORMATIVA
    if (!informativa) {
       error += "<li class='error-row'>" + getError("INFO", "") + "</li>"
        J( "#error_informativa" ).html(getError("INFO", "")).fadeIn();
    }else
        J( "#error_informativa" ).html("").fadeOut();
    
    // CAPTCHA
    var response = grecaptcha.getResponse();
    if (!response) {
        error += "<li class='error-row'>" + getError("ROBOT", "") + "</li>"
        J("#error_captcha_code").html(getError("ROBOT","")).fadeIn();
    } else
        J("#error_captcha_code").html("").fadeOut();
    
    // VERIFICA DATE
    if(J("#data_arrivo").val() && J("#data_partenza").val() ){
        
        var date = verifyDate( J("#data_arrivo").val(), J("#data_partenza").val() )
        
        if(date =='2'){
            
            error += "<li class='error-row'>" + getError("PARTENZA", "") + "</li>"
            J("#data_partenza").addClass("form_error")
        
        }else
            J("#data_partenza").removeClass("form_error")
        
        if(date =='3'){
            
            error += "<li class='error-row'>" + getError("ARRIVO", "") + "</li>"
            J("#data_arrivo").addClass("form_error")
    
        }else
            J("#data_arrivo").removeClass("form_error")
        
        
    }
    
    
    /*if (error != '') {
        J('#modal-info-title').html("<i class='fa fa-exclamation-triangle'></i>&nbsp;" + getError("INCOMPLETO", ""))
        J('#modal-info-text').html("<p>" + getError("VERIFICA", "") + "</p><ul>" + error + "</ul>")
        J('#modal-info').modal("show");
    } else
        J('#'+from).submit()*/
	
	if (error != '') {
		J('#modal-info-title').append(getError("INCOMPLETO", ""));
		J('#modal-info-text').html("<p>" + getError("VERIFICA", "") + "</p><ul>" + error + "</ul>");
		J('#validationModal').modal("show");
	}
	else {
		J('#btn-submit-form').hide();
		J('#loading').show();
		
		J.post('assets/php/form.php', jQuery("#"+from).serialize(), function (data) {
			if(data.success == true) {
				J('#'+from).replaceWith(data.html).fadeIn();
			}
			else {
				J('#'+from).prepend(data.html).fadeIn();
			}
			
			J('#btn-submit-form').show();
			J('#loading').hide();
				
		},'json');

	}
        
});

J(".update-formula").on('change', function (event) {
    event.preventDefault()
    
    var tipo = J(this).val()
	
	J('#campus option:not(:first)').remove();
	
	J.each(rooms[tipo], function(id, item) {
		J('#campus').append(J('<option>', { 
			value: id,
			text : item
		}));
	});
	
	J("#formula-campus" ).fadeIn();
	
	
    if(tipo == 8 || tipo == 5 || tipo == 7){
		//J( "#formula-housing" ).fadeOut( "fast", function() {
           //J( "#formula-campus" ).fadeIn();
           J( "#coabitazione" ).fadeIn();
           
        //});
    }
	else if(tipo == 2) {
        //J("#formula-campus" ).fadeOut( "slow", function() {
           //J( "#formula-housing" ).fadeIn();
         J( "#coabitazione" ).fadeOut();
        //});
    }
});

// Errori in lingua 
function getError(tipo, label) {

    var lang = J("#language").val();

    switch (lang) {
        case "en_GB":
            
            var trad = {
                "INCOMPLETO": "Uncompleted or invalid data",
                "VERIFICA": "Verify that you have completed all required fields correctly",
                "OBLI": "The field [CAMPO] is mandatory",
                "INVALID": "The field [CAMPO] is not valid",
                "PRIVACY": "It is necessary to accept the privacy policy",
                "INFO": "It is necessary to consent to the processing of data",
                "ROBOT": "Demonstrate that you are not a robot",
                "ARRIVO": "The start date of the stay can not be less than today",
                "PARTENZA": "The end-of-stay date can not be lower than the start-of-stay date",
            };
            break;
            
        case "es_ES":
            
            var trad = {
                "INCOMPLETO": "Datos incompletos o no v&aacute;lidos",
                "VERIFICA": "Verifique que haya completado todos los campos requeridos correctamente",
                "OBLI": "El campo [CAMPO] es obligatorio",
                "INVALID": "El campo [CAMPO] no es v&aacute;lido",
                "PRIVACY": "Es necesario aceptar la política de privacidad",
                "INFO": "Es necesario dar su consentimiento para el procesamiento de datos",
                "ROBOT": "Demuestra que no eres un robot",
                "ARRIVO": "La fecha de inicio de la estad&iacute;a no puede ser menor que hoy",
                "PARTENZA": "La fecha de finalización de la estadía no puede ser inferior a la fecha de inicio de la estad&iacute;a",
            };
            break;
            
        default:
            
            var trad = {
                "INCOMPLETO": "Dati inconpleti o non validi",
                "VERIFICA": "Verificare di avere completato correttamente tutti i campi obbligatori",
                "OBLI": "Il campo [CAMPO] &egrave; obbligatorio",
                "INVALID": "Il campo [CAMPO] non &egrave; valido",
                "PRIVACY": "&Egrave; neccessario accettare l'informativa sulla privacy",
                "INFO": "&Egrave; necessario dare il consenso al trattamento dei dati",
                "ROBOT":"Dimostrare di non essere un robot",
                "ARRIVO":"La data di inizio soggiorno non pu&ograve; essere inferiore ad oggi",
                "PARTENZA":"La data di fine soggiorno non può essere inferiore a quella di inizio soggiorno",
            };
            break;
    }
    
    var text = trad[tipo];
    
    return text.replace("[CAMPO]", label);

}

// VERIFICA DEI CAMPI 
function isValidField(field, value, maxLength, minLength) {
    var exp = "";
    switch (field) {
        case "email":
            exp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})(\s+([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4}))*$/
            break;
        case "note":
        case "text":
            exp = /^([a-zA-Z0-9\xE0\xE8\xE9\xF9\xF2\xEC\x27\x21\x22\x23\x24\x25\x26\x28\x29\x2a\x2b\x2c\x40 \.\-\ \/ ])+$/;
            break;
        case "numero":
        case "cellulare":
            exp = /^([0-9])+$/;
            break;
        case "data_nascita":
        case "data_partenza":
        case "data_arrivo":
        case "arrivo":
        case "partenza":
            exp = /^([0-9]{2}-[0-9]{2}-[0-9]{4})+$/;
            break;
        default:
            exp = /^([a-zA-Z0-9\xE0\xE8\xE9\xF9\xF2\xEC\x27 \.\-\ \/ ])+$/;
            break;

    }

    if (!value.match(exp))
        return false;
    else {
        if (maxLength && value.length > maxLength)
            return false;
        else if (minLength && value.length < minLength)
            return false;
        else
            return true;
    }
}

// Verifica che la data di pratenza sia maggiore della data di arrivo 
function verifyDate(arrivo, partenza) {
    var oggi = new Date().getTime()
    var a = new Date(arrivo.split("-").reverse().join("-")).getTime();
    var p = new Date(partenza.split("-").reverse().join("-")).getTime();
    var stato = 2;
    if (p > a)
        stato = 1
    if(a < oggi)
        stato = 3
    
    return stato;
}
