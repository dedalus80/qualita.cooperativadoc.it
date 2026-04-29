
$(function() {
    
    $("#data_nascita ,#data_arrivo, #data_partenza").datepicker({
        todayHighlight: true,
        language: 'it',
        format: "dd-mm-yyyy",
        autoclose: true,
        showOnFocus: true,
        minDate: new Date()
    }).on('changeDate', function (e) {
        $(this).datepicker('hide');
    })

	$(".check-error").on('click', function(event){
		$("#error_"+$(this).data("refer")).html("").fadeOut("fast");
		console.log($(this).val())
	});

	$('.data_picker').click(function () {
		$("#" + $(this).data("refer")).datepicker('show');
	});

	$("#info_link").on('click', function (event) {
		$('#modal-privacy').modal("show");
	});

	$(".valida,#campus").on('change', function (event) {

		event.preventDefault()
		var tipo = $(this).data("tipo")
		var val = $(this).val()
		var label = $(this).data("label")

		if (!val && tipo != 'data')
			$(this).addClass("form_error")
		else if (!isValidField(tipo, val, "", "") && tipo != 'data' && val)
			$(this).addClass("form_error")
		else
			$(this).removeClass("form_error")

	});

	$("#btn-submit-form").on('click', function (event) {
		event.preventDefault()
		var from        = $(this).data("refer")
		var informativa = $('input[name="informativa"]:checked', '#' + from).val()
		var privacy     = $('input[name="privacy"]:checked', '#' + from).val()
		var sesso       = $('input[name="sesso"]:checked', '#' + from).val()
		var prima_volta = $('input[name="prima_volta"]:checked', '#' + from).val()
		var arrivo      = $("#data_arrivo").val();
		var partenza    = $("#data_partenza").val();
		var error       = "";
		
		
		// VALIDA CAMPI OBBLIGATORI
		$(".valida").each(function (index) {
			var tipo = $(this).data("tipo")
			var val = $(this).val()
			var label = $(this).data("label")

			if (!val && $(this).hasClass("obbligatorio")) {
				$(this).addClass("form_error")
				error += "<li class='error-row'>" + getError("OBLI", label) + "</li>"

			} else if (val && !isValidField(tipo, val, "", "")) {
				$(this).addClass("form_error")
				error += "<li class='error-row'>" + getError("INVALID", label) + "</li>"
			} else
				$(this).removeClass("form_error")
		});
		
		// CAMPO SESSO 
		if (!sesso) {
			error += "<li class='error-row'>" + getError("OBLI", $("#sesso").data("label") ) + "</li>"
			$( "#error_sesso" ).html(getError("OBLI", $("#sesso").data("label") )).fadeIn();
		}else
			$( "#error_sesso" ).html("").fadeOut();
		
		// CAMPO PRIMA VOLTA
		if (!prima_volta) {
			error += "<li class='error-row'>" + getError("OBLI", $("#prima_volta").data("label") ) + "</li>"
			$( "#error_prima_volta" ).html(getError("OBLI",  $("#prima_volta").data("label") ) ).fadeIn();
		}else
			$( "#error_prima_volta" ).html("").fadeOut();
		
		var formula = $("#formula").val()
		
		// TIPO ALLOGGIO
		if(from =='form-sharing'){ // SHARING
			if(!formula){
				$("#formula").addClass("form_error")
				error += "<li class='error-row'>" + getError("OBLI", $("#formula").data("label")) + "</li>"
			}else{
				
				
				if(formula =='1'){
					
					if( !$("#campus").val() ){
						$("#campus").addClass("form_error")
						error += "<li class='error-row'>" + getError("OBLI", $("#campus").data("label")) + "</li>"
					}else
						$("#campus").removeClass("form_error")
					
				}else if(formula =='2'){
					
					if( !$("#housing").val() ){
						$("#housing").addClass("form_error")
						error += "<li class='error-row'>" + getError("OBLI", $("#housing").data("label")) + "</li>"
					}else
						$("#housing").removeClass("form_error")
				}
				
				
			}
			
		}else if(from == 'form-campus'){  // CAMPUS SAN PAOLO 
			
			if(!$("#campus").val() ){
				$("#campus").addClass("form_error")
				error += "<li class='error-row'>" + getError("OBLI", $("#campus").data("label")) + "</li>"
			}else
				$("#campus").removeClass("form_error")
			
		}else if (from =='form-fossata'){ // CASCINA FOSSATA
			
			if(!formula) {
				$("#formula").addClass("form_error")
				error += "<li class='error-row'>" + getError("OBLI", $("#formula").data("label")) + "</li>"
			}
			else {
				if(!$("#campus").val()) {
					$("#campus").addClass("form_error")
					error += "<li class='error-row'>" + getError("OBLI", $("#campus").data("label")) + "</li>"
				}
				else {
					$("#campus").removeClass("form_error")
				}
			}
			
			/*else if(formula==1) {
				if(!$("#campus").val()){
					$("#campus").addClass("form_error")
					error += "<li class='error-row'>" + getError("OBLI", $("#campus").data("label")) + "</li>"
				}else
					$("#campus").removeClass("form_error")
			}
			else if(formula==2) {
				if( !$("#housing").val()){
					$("#housing").addClass("form_error")
					error += "<li class='error-row'>" + getError("OBLI", $("#housing").data("label")) + "</li>"
				}else
					$("#housing").removeClass("form_error")
			}
			else {
				$("#housing").removeClass("form_error")
				$("#campus").removeClass("form_error")
			}*/
		}
		
		console.log(informativa)
		
		//PRIVACY 
		if (!privacy) {
			error += "<li class='error-row'>" + getError("PRIVACY", "") + "</li>"
			$( "#error_privacy" ).html(getError("PRIVACY", "")).fadeIn();
		}else
			$( "#error_privacy" ).html("").fadeOut();

		// INFORMATIVA
		if (!informativa) {
		   error += "<li class='error-row'>" + getError("INFO", "") + "</li>"
			$( "#error_informativa" ).html(getError("INFO", "")).fadeIn();
		}else
			$( "#error_informativa" ).html("").fadeOut();
		
		// CAPTCHA
		var response = grecaptcha.getResponse();
		if (!response) {
			error += "<li class='error-row'>" + getError("ROBOT", "") + "</li>"
			$("#error_captcha_code").html(getError("ROBOT","")).fadeIn();
		} else
			$("#error_captcha_code").html("").fadeOut();
		
		// VERIFICA DATE
		if($("#data_arrivo").val() && $("#data_partenza").val() ) {
			
			var date = verifyDate( $("#data_arrivo").val(), $("#data_partenza").val() )
			
			console.log(date)
			
			if(date == 2) {
				
				error += "<li class='error-row'>" + getError("PARTENZA", "") + "</li>"
				$("#data_partenza").addClass("form_error")
			
			}else
				$("#data_partenza").removeClass("form_error")
			
			if(date == 3 ) {
				
				error += "<li class='error-row'>" + getError("ARRIVO", "") + "</li>"
				$("#data_arrivo").addClass("form_error")
		
			}else
				$("#data_arrivo").removeClass("form_error")
			
			
		}
		
		if (error != '') {
			$('#modal-info-title').append(getError("INCOMPLETO", ""));
			$('#modal-info-text').html("<p>" + getError("VERIFICA", "") + "</p><ul>" + error + "</ul>");
			$('#validationModal').modal("show");
		}
		else {
			$('#btn-submit-form').hide();
			$('#loading').show();
			
			$.post('assets/php/form.php', jQuery("#"+from).serialize(), function (data) {
				if(data.success == true) {
					$('#'+from).replaceWith(data.html).fadeIn();
				}
				else {
					$('#'+from).prepend(data.html).fadeIn();
				}
				
				$('#btn-submit-form').show();
				$('#loading').hide();
					
			},'json');

		}
	});

	$(".update-formula").on('change', function (event) {
		event.preventDefault()
		
		var tipo = $(this).val()
		
		$('#campus option:not(:first)').remove();
		
		$.each(rooms[tipo], function(id, item) {
			$('#campus').append($('<option>', { 
				value: id,
				text : item
			}));
		});
		
		$("#formula-campus" ).fadeIn();
		
		
		if(tipo =='1'){
			//$( "#formula-housing" ).fadeOut( "fast", function() {
				//$( "#formula-campus" ).fadeIn();
				$( "#formula-coabitazione" ).fadeIn();
			//});
			
		}
		//else if(tipo =='2'){
		//	$("#formula-campus" ).fadeOut( "slow", function() {
		//		$( "#formula-housing" ).fadeIn();
		//		$( "#formula-coabitazione" ).fadeOut();
		//	});
		//}
		else {
			//$( "#formula-housing" ).fadeOut();
			$( "#formula-coabitazione" ).fadeOut();
			//$( "#formula-campus" ).fadeOut();
		}
	});

	// Errori in lingua 
	function getError(tipo, label) {

		var lang = $("#language").val();

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
				//exp = /^([a-zA-Z0-9\xE0\xE8\xE9\xF9\xF2\xEC\x27\x21\x22\x23\x24\x25\x26\x28\x29\x2a\x2b\x2c\x40 \.\-\ \/ ])+$/;
				exp = /^.+$/;
				break;
			case "numero":
			case "cellulare":
				exp = /^([0-9])+$/;
				break;
			case "date":
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
		let today = new Date().toISOString().slice(0, 10)
		let oggi = new Date(today).getTime()
		
		var a = new Date(arrivo.split("-").reverse().join("-")).getTime();
		var p = new Date(partenza.split("-").reverse().join("-")).getTime();
		var stato = 2;
		
		if (p > a)
			stato = 1
		
		if(a < oggi)
			stato = 3
		
		return stato;
	}
});