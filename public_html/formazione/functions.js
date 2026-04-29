jQuery(function() {

	// VERIFICA DEI CAMPI
	function isValidField(field,value,maxLength,minLength) {
		var exp ="";
		switch(field){
			case"email":
				exp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})(\s+([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4}))*$/
				break;
			case"testo":
			case"nome":
			case"cognome":
			case"luogo_di_nascita":
				exp = /^([a-zA-Z0-9\xE0\xE8\xE9\xF9\xF2\xEC\x27 \.\-\ \/ ])+$/;
				break;
			case"numero":
			case"cellulare":
				exp =   /^([0-9])+$/;
				break;
			default:
				exp = /^([a-zA-Z0-9\xE0\xE8\xE9\xF9\xF2\xEC\x27 \.\-\ \/ ])+$/;
				break;    
				
		}
		if(!value.match(exp))
			return false;
		else{
			if(maxLength && value.length > maxLength)
				return false;
			else if(minLength && value.length < minLength)
				return false;
			else
				return true;
		}
	}

	// TESTI PERSONALIZZATI IN LINGUA
	function getErrorText(text){
		
		var resp =''
		var lang = document.getElementById('language').value;
		
		switch(text){
			case"STR":
				switch(lang){
					case"it-IT":
						resp="Selezionare la struttura";
						break;
					case"en-GB":
						resp="Select accommodation";
						break;
					case"es-ES":
						resp="obligatorio";
						break;
							
				}
				break;
			case"GEN":
				switch(lang){
					case"it-IT":
						resp="Verificare i campi evidenziati";
						break;
					case"en-GB":
						resp="Check the highlighted fields";
						break;
					case"es-ES":
						resp="Revise los campos resaltados";
						break;
				}
				break;
			case"CO":
				switch(lang){
					case"it-IT":
						resp="Obbligatorio";
						break;
					case"en-GB":
						resp="Required";
						break;
					case"es-ES":
						resp="obligatorio";
						break;
				}
				break;
			case"NV":
				switch(lang){
					case"it-IT":
						resp="Non valido";
						break;
					case"en-GB":
						resp="Invalid value";
						break;
					case"es-ES":
						resp="Valor no válido";
						break;
				}
				break;
			case"PR":
				switch(lang){
					case"it-IT":
						resp='<br />&Egrave; necessario dare il consenso al trattamento dei dati';
						break;
					case"en-GB":
						resp="<br />You need to give consent to the processing of data";
						break;
					case"es-ES":
						resp="<br />Usted necesita dar su consentimiento al tratamiento de los datos";
						break;
				}
				break;
			case"CS":
				switch(lang){
					case"it-IT":
						resp="Indicare come si &egrave; venuti a conoscienza di sharing.to.it";
						break;
					case"en-GB":
						resp="Indicate how did you hear about sharing.to.it";
						break;
					case"es-ES":
						resp="Indique c&oacute;mo se enter&oacute; de sharing.to.it";
						break;
							
				}
				break;
			case"FA":
				switch(lang){
					case"it-IT":
						resp="Indicare la formula abitativa";
						break;
					case"en-GB":
						resp="Enter the housing formula";
						break;
					case"es-ES":
						resp="Introduzca la vivienda f&oacute;rmula";
						break;
							
				}
				
				break;
			case"FC":
				switch(lang){
					case"it-IT":
						resp="Indicare tipo campus";
						break;
					case"en-GB":
						resp="Indicate campus type";
						break;
					case"es-ES":
						resp="Indique el campus";
						break;
							
				}
				break;
			case"FH":
				switch(lang){
					case"it-IT":
						resp="Indicare tipo housing";
						break;
					case"en-GB":
						resp="Indicate housing type";
						break;
					case"es-ES":
						resp="Indique el housing";
						break;
							
				}
				break;
			case"PR":
				switch(lang){
					case"it-IT":
						resp='&Egrave; necessario dare il consenso al trattamento dei dati';
						break;
					case"en-GB":
						resp="You need to give consent to the processing of data";
						break;
					case"es-ES":
						resp="Usted necesita dar su consentimiento al tratamiento de los datos";
						break;
							
				}
				break;
			case"CD":
				switch(lang){
					case"it-IT":
						resp='Completare periodo soggiorno';
						break;
					case"en-GB":
						resp="Complete period of stay";
						break;
					case"es-ES":
						resp="Per&iacute;odo completo de la estancia";
						break;
							
				}
				break;
			case"NOR":
				switch(lang){
					case"it-IT":
						resp='Dimostrare di non essere un robot';
						break;
					case"en-GB":
						resp="Dimostrare di non essere un robot";
						break;
					case"es-ES":
						resp="Dimostrare di non essere un robot";
						break;
							
				}
				break;    
			case"CAP":
				switch(lang){
					case"it-IT":
						resp='Riportare l\'immagine di controllo';
						break;
					case"en-GB":
						resp="Devuelva la imagen de control";
						break;
					case"es-ES":
						resp="Return the Control image";
						break;
							
				}
				break;
			case"CAPN":
				switch(lang){
					case"it-IT":
						resp='Immagine di controllo non valida';
						break;
					case"en-GB":
						resp="The control image is not valid";
					   
						break;
					case"es-ES":
						resp="La imagen de control no es valida";
						break;
							
				}
				break;
				 case"INFO":
				switch(lang){
					case"it-IT":
						resp="&Egrave; neccessario accettare l'informativa sulla privacy";
						break;
					case"en-GB":
						 resp="&Egrave; neccessario accettare l'informativa sulla privacy";
						break;
					case"es-ES":
						 resp="&Egrave; neccessario accettare l'informativa sulla privacy";
						break;
							
				}
				break;
		}
		return resp;
		
	}


	jQuery('.btn-send').on('click', function (e) {
		
		e.preventDefault();
		
		var campi       = new Array('nome','cognome','data_corso','titolo');
		var obli        = new Array('temi','giudizio','consiglia','spazi','livello','conduzione');
		var viaggio     = jQuery('input[name="viaggio_complessivo"]:checked', '#form_formazione').val()
		var info        = jQuery('input[name="info"]:checked', '#form_formazione').val();
		var informativa = jQuery('input[name="informativa"]:checked', '#form_formazione').val();
		
		var error =   false;
		
		for(x=0; x < campi.length; x++){
			if(!jQuery("#"+campi[x] ).val()){
				error = true;
				jQuery( "#error_"+campi[x] ).html(getErrorText("CO")).fadeIn();
			}
			else if( !isValidField(campi[x],    jQuery( "#"+campi[x] ).val()   ,"","") &&  campi[x] !='tipo_corso' ){
				error = true;
				jQuery( "#error_"+campi[x] ).html(getErrorText("NV")).fadeIn();
			}
			else
				jQuery( "#error_"+campi[x] ).html("").fadeOut();
		}
		
		for(x=0; x < obli.length; x++){
			
			var check = jQuery('input[name="'+obli[x]+'"]:checked', '#form_formazione').val()
			
			if(!check){
				error = true;
				jQuery( "#error_"+obli[x] ).html(getErrorText("CO")).fadeIn();
			}
			else
				jQuery( "#error_"+obli[x] ).html("").fadeOut();
		}
		
		if(!jQuery("#tipo_corso").val()){
			error = true;
			jQuery( "#error_tipo_corso" ).html(getErrorText("CO")).fadeIn();
		}else
			  jQuery( "#error_tipo_corso" ).html("").fadeOut();
		
		
		
		var response = grecaptcha.getResponse();
		
		if(!response){
			error = true;
			jQuery( "#error_captcha_code" ).html(getErrorText("NOR")).fadeIn();
		}
		else
			jQuery( "#error_captcha_code" ).html("").fadeOut();
		
		if(!informativa){
			error = true;
			jQuery( "#error_informativa" ).html(getErrorText("INFO")).fadeIn();
		}
		else
			jQuery( "#error_informativa" ).html("").fadeOut();
		
		if(error == true){
			jQuery("#validationModal").modal({
				show: true
			});
		}
		else {
			jQuery.post('form.php', jQuery("#form_formazione").serialize(), function (data) {
				
				jQuery('#form_formazione').replaceWith(data.html).fadeIn();
			
			},'json');
		}
	});


	jQuery(".radio-ins , .radio-buo , .radio-suf , .radio-ott").on('ifClicked', function(event){
		
		var id = jQuery(this).attr("id");
		
		if(jQuery("#"+id).iCheck('checked')){
			   jQuery("#"+id).iCheck('uncheck');
		}
			
	});

});