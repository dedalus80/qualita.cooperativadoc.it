	window.onload = function() {

		jQuery(".resetError").on('change', function(event){
			jQuery("#error_"+jQuery(this).attr("id")).html("").fadeOut("slow");
		});

		jQuery("#arrivo, #partenza ,#data_nascita ,#data_arrivo, #data_partenza ").datepicker({
			todayHighlight: true,
			language:'it',
			format:"dd-mm-yyyy",
			autoclose: true
		}).on('changeDate', function(e){
			jQuery(this).datepicker('hide');
		});

		//~ jQuery('#arrivo-pick').click(function(){  
			//~ jQuery("#arrivo").datepicker('show');
		//~ });
		
		//~ jQuery('#partenza-pick').click(function(){ 
			//~ jQuery("#partenza").datepicker('show');
		//~ });
		

	};
	
	jQuery("#info_1").on('click', function(event){
		jQuery( "#dati-utente" ).fadeOut( "fast", function() { });
	});

	jQuery("#info_2").on('click', function(event){
		jQuery( "#dati-utente" ).fadeIn( "fast", function() {});
	});
	
	// VERIFICA DEI CAMPI 
	function isValidField(field,value,maxLength,minLength){ 
		var exp ="";
		switch(field) {
			case"email":
				exp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})(\s+([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4}))*$/
				break;
			case"testo":
			case"nome":
			case"cognome":
			case"luogo_di_nascita":
				exp = /^([a-zA-Z0-9\xE0\xE8\xE9\xF9\xF2\xEC\x27\x21\x22\x23\x24\x25\x26\x28\x29\x2a\x2b\x2c\x40 \.\-\ \/ ])+$/;
				break;
			case"numero":
			case"cellulare":
				exp =   /^([0-9])+$/;
				break;
			case "data_nascita":  
			case"data_partenza":
			case"data_arrivo":
			case"arrivo":
			case"partenza":
				exp =   /^([0-9]{2}-[0-9]{2}-[0-9]{4})+$/;
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
			case"NVD":
				switch(lang){
					case"it-IT":
						resp="Non valido gg-mm-aaaa";
						break;
					case"en-GB":
						resp="Invalid value dd-mm-yyyy";
						break;
					case"es-ES":
						resp="Valor no válido dd-mm-aaaa";
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

	function updateError(){
		jQuery( "#box-end").fadeIn()
		jQuery("#box-error").fadeOut( "fast", function() {
			jQuery(".error_resume").html("")
		})
	}


	function resetAll(){

		document.getElementById('error_nome').innerHTML=''
		document.getElementById('error_cognome').innerHTML=''
		document.getElementById('error_email').innerHTML=''
		document.getElementById('error_camera').innerHTML=''
		document.getElementById('error_cellulare').innerHTML=''
		document.getElementById('error_captcha').innerHTML="";
		 
		document.getElementById('nome').value=''
		document.getElementById('cognome').value=''
		document.getElementById('email').value=''
		document.getElementById('cellulare').value=''
		document.getElementById('camera').value=''
		document.getElementById('captcha_code').value=''
		
	}

	jQuery('.btn-send').on('click', function (e) {
        
        e.preventDefault();
			
		//~ jQuery(this).unbind('click');
		
		var campi       = new Array('albergo','tipologia','partenza','arrivo','conoscenza','tipologia_soggiorno');
		var viaggio     = jQuery('input[name="viaggio_complessivo"]:checked', '#form_questionario').val()
		var info        = jQuery('input[name="info"]:checked', '#form_questionario').val()
		var informativa     = jQuery('input[name="informativa"]:checked', '#form_questionario').val()
		var error =   false;
		
		for(x=0; x < campi.length; x++) {
			if(!jQuery( "#"+campi[x] ).val()) {
				error = true;
				jQuery( "#error_"+campi[x] ).html(getErrorText("CO")).fadeIn();
			} 
			else if( !isValidField(campi[x], jQuery( "#"+campi[x] ).val(), "", "")   ){
				error = true;

				if(campi[x]=='data_nascita' || campi[x]=='data_partenza'|| campi[x]=='data_arrivo')
					jQuery( "#error_"+campi[x] ).html(getErrorText("NVD")).fadeIn();
				else
					jQuery( "#error_"+campi[x] ).html(getErrorText("NV")).fadeIn();
			}
			else
				jQuery( "#error_"+campi[x] ).html("").fadeOut();
		}
		
		if(!viaggio){
			error = true;
			jQuery( "#error_complessivo" ).html(getErrorText("CO")).fadeIn();
		}
		else
			jQuery( "#error_complessivo" ).html("").fadeOut();
		
		if(!informativa){
			error = true; 
			jQuery( "#error_informativa" ).html(getErrorText("INFO")).fadeIn();
		}
		else
			jQuery( "#error_informativa" ).html("").fadeOut();

		if(verifyDate() != 1) {
			error = true; 
            jQuery( "#error_partenza" ).html(getErrorText("NV")).fadeIn();
		}
        else {
			jQuery( "#error_partenza" ).html("").fadeOut();
		}
        
		if(info=='S'){
			var altri =  new Array('nome','cognome','email','cellulare');
			for(x=0; x < altri.length; x++){
				if(!jQuery( "#"+altri[x] ).val()){
					error = true;
					jQuery( "#error_"+altri[x] ).html(getErrorText("CO")).fadeIn();
				}
				else if( !isValidField(altri[x],    jQuery( "#"+altri[x] ).val()   ,"","")   ){
					error = true;
					jQuery( "#error_"+altri[x] ).html(getErrorText("NV")).fadeIn();
				}
				else
					jQuery( "#error_"+altri[x] ).html("").fadeOut();
			}
		}
		
		var response = grecaptcha.getResponse();
		
		if(!response){
			error = true;
			jQuery( "#error_captcha_code" ).html(getErrorText("NOR")).fadeIn();
		}
		else
			jQuery( "#error_captcha_code" ).html("").fadeOut();
		
		if(error == true){
			jQuery("#validationModal").modal({
				show: true
			});
			
			//~ jQuery(this).bind('click');
		}
		else {
			jQuery.post('form.php', jQuery("#form_questionario").serialize(), function (data) {
				jQuery('#form_questionario').replaceWith(data.html).fadeIn();
			},'json');
			//~ jQuery(this).bind('click');
		}
	});

	function verifyDate() {

		var  a = new Date(jQuery("#arrivo").val().split("-").reverse().join("-")).getTime();
		var  p = new Date(jQuery("#partenza").val().split("-").reverse().join("-")).getTime();
		
		var stato = 2;
		if(p > a)
			stato = 1
		
		return stato;
	}