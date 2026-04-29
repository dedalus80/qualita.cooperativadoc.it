window.onload = function(){
    
    $('.radio-green').iCheck({
        radioClass: 'iradio_square-green'
    });
    
	 $('.radio-purple').iCheck({
        radioClass: 'iradio_square-purple'
    });
    
    $('.check-purple').iCheck({
        checkboxClass: 'icheckbox_square-purple'
    });
	
	
	$('.radio-red').iCheck({
        radioClass: 'iradio_square-red'
    });
    
	
    $('.check-green').iCheck({
        checkboxClass: 'icheckbox_square-green'
    });
	       
    $(".privacy").on('click', function(event){
        event.preventDefault();
        $("#infoModal").modal({
            show: true
        });
    });
	
}

// Passaggio allo step successivo
$(".next").on("click",function(event){
    event.preventDefault();
    
	var step = $(this).data("step")
	var next = step + 1;
	$("#box-"+next).fadeIn("fast")
	$("#badge-"+step).removeClass("orange").addClass("badge-green")
	$("#next-"+step).fadeOut("fast")
    $('html , .main-content').animate({
        scrollTop: $("#box-"+next).offset().top +200
    }, 1000);
	//$.scrollTo($("#box-"+next),1000);
	if(step== 3)
		$("#button-4").removeClass("hidden-on-start")
	
	
	//$('html, body').animate({scrollTop: $("#box-"+next).offset().top }, 2000);
});

// Verifica che tutti i campi obbligatori siano completati e corretti
function checkCount(step){
	
	var totale 		= $('.step-'+step).length
	var error  		= false
	var oblistep    = $('.obli-'+step).length
	var tmp         = 0;
	
	$('.step-'+step).each(function() {
    	var valore = $(this).val();
		
		if($(this).hasClass("obli") ){
			if(!valore ||  ( !isValidField($(this).data("tipo") , valore ,"","")  && valore )  )
				error = true
			else
				tmp++;
		}else{
			if(valore && !isValidField($(this).data("tipo") , valore ,"","") )
				error = true
		}
	});
	
	//console.log(error)
	
	// verifico i campi checkbox
	error = checkRadioAndCheckbox(step)
	
	//verifico i campi extra occupazione
	/*if(step == 2) {
		error = checkExtraField();
	}*/
	
	// Non ci sono errori e i campi obbligatori sono completi
	if (error === false && oblistep == tmp ){
		
		if(step== 4)
			$("#button-4").fadeIn()
		
		$("#button-"+step).removeClass("disabled")
		$("#badge-"+step).removeClass("orange").addClass("badge-green")
	}
}

// Controllo delle checkbox 

function checkRadioAndCheckbox(step){
	
	var error = false
	
	switch(step){
		case 1:
			var sesso =  $('input[name="sesso"]:checked', '#form_iscrizione').val();
			if(!sesso)
				error = true;
			break;
		/*case 2:
			error = false ;
		break;*/
		case 2:
			/*var fumatore =  $('input[name="fumatore"]:checked', '#form_iscrizione').val();
			var animali  =  $('input[name="animali"]:checked', '#form_iscrizione').val();
		
			if(!fumatore || !animali)
				error = true;*/
			break;
		
		case 3:
			var prima_volta =  $('input[name="prima_volta"]:checked', '#form_iscrizione').val();
			//var camera_amici = $('input[name="camera_amici"]:checked', '#form_iscrizione').val();
			if(!prima_volta)
				error = true;
			break;
		case 4:
			//var camera_singola = $('input[name="camera_singola"]:checked', '#form_iscrizione').val();
			//var camera_doppia = $('input[name="camera_doppia"]:checked', '#form_iscrizione').val();
			//var camera_indiferente = $('input[name="camera_indiferente"]:checked', '#form_iscrizione').val();
			var privacy = $('input[name="privacy"]:checked', '#form_iscrizione').val();
			if(!privacy)
				error = true;
            var aut1 = $('input[name="consenso"]:checked', '#form_iscrizione').val();
            if(!aut1)
                error = true;
            var aut2 = $('input[name="mailing"]:checked', '#form_iscrizione').val();
            if(!aut2)
                error = true;
            
			break;
	}
	
	return error;
}

function checkExtraField() {
	var vs = $("#occupazione").val();
	
	switch(vs) {
		case 1:
			$("studente_extra input").each(function() {
				if($(this).val() == '')
					return true;
			});
			break;
		case 2:
			$("lavoratore_extra input").each(function() {
				if($(this).val() == '')
					return true;
			});
			break;
		default:
			return false;
	}
}

$(" .amici , .dove_vive , .sesso , .fumatore , .prima_volta , .animali , .camera_amici , .amici_animali, #privacy, input[name='consenso'], input[name='mailing'], input[name='media']").on('ifChecked', function(event){
    checkCount($(this).data("step"))
});

$(" .amici , .dove_vive ,  .prima_volta , .animali , .camera_amici , .amici_animali").on('ifChecked', function(event){
    
	
    var valore =    jQuery(this).val();
    var refer  =    jQuery(this).data("refer");
    var step   =    jQuery(this).data("step");
    
	if(valore =='Y')
        $("#"+refer+"-extra").fadeIn( "fast", function() {
			$("#"+refer+"_dettaglio").addClass("step step-"+step+" obli obli-"+step);
		})
    else
        $("#"+refer+"-extra").fadeOut( "fast", function() {
			$("#"+refer+"_dettaglio").removeClass("step step-"+step+" obli obli-"+step);
	})
   
    
});

$("#camera_singola, #camera_doppia, #camera_indiferente").on('ifChecked', function(event){
   	var camera_singola 		= $('input[name="camera_singola"]:checked', '#form_iscrizione').val();
   	var camera_doppia 		= $('input[name="camera_doppia"]:checked', '#form_iscrizione').val();
   	var camera_indiferente 	= $('input[name="camera_indiferente"]:checked', '#form_iscrizione').val();
	if(camera_singola  || camera_doppia  || camera_indiferente)
		 $("#label_camera_check").removeClass("has-error"); 
});

$("#privacy").on('ifChecked', function(event){
   	var privacy 			= $('input[name="privacy"]:checked', '#form_iscrizione').val();
	if(privacy)
		$( "#error_privacy" ).html("").fadeOut();
});

$("input[name='consenso']").on('ifChecked', function(event){
    var aut1 = $('input[name="consenso"]:checked', '#form_iscrizione').val();
    if(aut1)
         $( "#error_consenso" ).html("").fadeOut();
});
$("input[name='mailing']").on('ifChecked', function(event){
    var aut = $('input[name="mailing"]:checked', '#form_iscrizione').val();
    if(aut)
        $( "#error_mailing" ).html("").fadeOut();
});
$("input[name='media']").on('ifChecked', function(event){
    var aut = $('input[name="media"]:checked', '#form_iscrizione').val();
    if(aut)
        $( "#error_media" ).html("").fadeOut();
});

$(".step").on("change blur keyup",function(event){
	
	var valore = $(this).val();
	
	//if($(this).attr('id') == 'occupazione') {
		setExtraField($(this).attr('id'));
	//}
	
	if( $(this).hasClass("obli") ){
		if(!valore)
			$(this).removeClass("has-success").addClass("has-error")
		else if(!isValidField($(this).data("tipo") , valore ,"",""))
			$(this).removeClass("has-success").addClass("has-error")
		else
			$(this).removeClass("has-error").addClass("has-success")
	}else{
		if(valore && !isValidField($(this).data("tipo") , valore ,"","") )
			$(this).addClass("has-error")
		else
			$(this).removeClass("has-error")
	}
	
	checkCount($(this).data("step"))
	
})

// Select coinquilini 
$("#amici_quanti").on("change",function(event) {
	if($(this).val() > 1 ){
		$("#coinquilini_si").fadeIn();
		$("#amici_occupazione, #amici_genere, #amici_eta, #amici_nimali").addClass("step step-4 obli obli-4")
	}
	else{
		$("#amici_occupazione, #amici_genere, #amici_eta, #amici_nimali").removeClass("step step-4 obli obli-4")
		$("#coinquilini_si").fadeOut();
	}
})

// Verifica complementari
$(".other").on("change",function(event){
	
	var id     = $(this).attr("id")
	
	if($(this).data("valore") == $(this).val() ){
		$("#"+id+"-extra").fadeIn();
		$("#"+id+"_dettaglio").addClass("step obli obli-"+$(this).data("step")+" step-"+$(this).data("step")  )
	}
	else{
		$("#"+id+"_dettaglio").removeClass("step obli obli-"+$(this).data("step")+" step-"+$(this).data("step"))
		$("#"+id+"-extra").fadeOut();
	}
})

// Verifica campi complementari
/*$("#occupazione").on("change",function(event){
	 
	switch( $(this).val() ){
		case "1" :
			$("#studente-extra").fadeIn()
			$("#occupazione-extra").fadeOut()
		
			$(".studente-extra").fadeIn();
			$(".studente-extra input").addClass("obli obli-2 step step-2");
			
		
			$(".occupazione-extra").fadeOut();
			$(".lavoratore-extra").fadeOut();
			break;
		case "2" :
			$(".studente-extra").fadeOut();
			$(".occupazione-extra").fadeOut();
			$(".lavoratore-extra").fadeIn();
			$("#occupazione-extra").fadeOut()
			$("#studente-extra").fadeOut()
		
			$(".studente-extra input").removeClass("obli obli-2 step step-2");
			break;
		case "4" :
			$("#occupazione-extra").fadeIn()
			$("#studente-extra").fadeOut()
			$(".occupazione-extra").fadeIn();
			$(".lavoratore-extra").fadeOut();
			$(".studente-extra").fadeOut();
			break;
		default:
			$("#occupazione-extra").fadeOut()
			$("#studente-extra").fadeOut()
			$(".occupazione-extra").fadeOut();
			$(".lavoratore-extra").fadeOut();
			$(".studente-extra").fadeOut();
			$(".studente-extra input").removeClass("obli obli-2 step step-2");
	}
})*/

function setExtraField(id) {

    console.log(id);

	var vs = $("#"+id).val();
	
    if(id == 'occupazione') {
        switch(vs) {
            case "1":
                $("#studente-extra").fadeIn()
                $("#occupazione-extra").fadeOut()
            
                $(".studente-extra").fadeIn();
                $(".studente-extra input").addClass("obli obli-2 step step-2");
                
            
                $(".occupazione-extra").fadeOut();
                $(".occupazione-extra input").removeClass("obli obli-2 step step-2");
                
                $(".lavoratore-extra, .lavoratore-extra-tipo").fadeOut();
                $(".lavoratore-extra select, .lavoratore-extra-tipo input").removeClass("obli obli-2 step step-2");
                break;
            case "2" :
                $(".studente-extra").fadeOut();
                $(".studente-extra input").removeClass("obli obli-2 step step-2");
            
                $(".occupazione-extra").fadeOut();
                $(".occupazione-extra input").removeClass("obli obli-2 step step-2");
                
                $(".lavoratore-extra").fadeIn();
                $(".lavoratore-extra select").addClass("obli obli-2 step step-2");
            
                $("#occupazione-extra").fadeOut()
                $("#studente-extra").fadeOut()		
                break;
            case "4" :
                $("#occupazione-extra").fadeIn()
                $("#studente-extra").fadeOut()
                
                $(".occupazione-extra").fadeIn();
                $(".occupazione-extra input").addClass("obli obli-2 step step-2");
                
                $(".lavoratore-extra, .lavoratore-extra-tipo").fadeOut();
                $(".lavoratore-extra select, .lavoratore-extra-tipo input").removeClass("obli obli-2 step step-2");
                
                $(".studente-extra").fadeOut();
                $(".studente-extra input").removeClass("obli obli-2 step step-2");
                break;
            default:
                $("#occupazione-extra").fadeOut()
                $("#studente-extra").fadeOut()
                $(".occupazione-extra").fadeOut();
                $(".lavoratore-extra, .lavoratore-extra-tipo").fadeOut();
                $(".studente-extra").fadeOut();
                $(".studente-extra input").removeClass("obli obli-2 step step-2");
                $(".lavoratore-extra select, .lavoratore-extra-tipo input").removeClass("obli obli-2 step step-2");
                $(".occupazione-extra input").removeClass("obli obli-2 step step-2");
        }
    }

    if(id == 'lavoratore_tipo') {
        if(vs && vs != "1") {
            $(".lavoratore-extra-tipo").fadeIn();
            $(".lavoratore-extra-tipo input").addClass("obli obli-2 step step-2");

            if(vs == 4) {
                $(".lavoratore-extra-altro").fadeIn();
                $(".lavoratore-extra-altro input").addClass("obli obli-2 step step-2");
            }
        }
        else {
            $(".lavoratore-extra-tipo").fadeOut();
            $(".lavoratore-extra-altro").fadeOut();
            $(".lavoratore-extra-tipo input").removeClass("obli obli-2 step step-2");
            $(".lavoratore-extra-altro input").removeClass("obli obli-2 step step-2");
        }
    }
}


// Campi data
$("#scadenza_documento ,#data_nascita ,#data_in, #data_out, #lavoratore_scadenza").datepicker({ 
    todayHighlight: true,
    language:'it',
    format:"dd-mm-yyyy",
    autoclose: true,
    showOnFocus: false
}).on('changeDate', function(e){
    $(this).datepicker('hide');
});

$('.open-calendar').click(function(){ 
    $("#"+$(this).data("calendar")).datepicker('show');
});

$('#icona-lingua').click(function(){ 
    location.href = "http://qualita.cooperativadoc.it/stessopiano/setLang.php?lang="+$("#language").val();
});



// Privacy 

$("#link-informativa").on('click', function(event){
    
	event.preventDefault();
	
	$("#infoModal").modal({
        show: true
    });
});


$("#button-4").on('click', function(event){
    
    event.preventDefault();
    var error = false;
    var primo = "";
	var camera_singola 		= $('input[name="camera_singola"]:checked', '#form_iscrizione').val();
    var camera_doppia 		= $('input[name="camera_doppia"]:checked', '#form_iscrizione').val();
    var camera_indiferente 	= $('input[name="camera_indiferente"]:checked', '#form_iscrizione').val();
    var camera_amici 		= $('input[name="camera_amici"]:checked', '#form_iscrizione').val();
    var amici_animali 		= $('input[name="amici_animali"]:checked', '#form_iscrizione').val();
    var privacy 			= $('input[name="privacy"]:checked', '#form_iscrizione').val();
    var aut1                = $('input[name="consenso"]:checked', '#form_iscrizione').val();
    var aut2                = $('input[name="mailing"]:checked', '#form_iscrizione').val();
    var aut3                = $('input[name="media"]:checked', '#form_iscrizione').val();

	$('.step').each(function(){
    	var valore = $(this).val();
		
		if($(this).hasClass("obli") ){
			if(!valore && !isValidField($(this).data("tipo") , valore ,"","")) {
				error = true
				$(this).removeClass("has-success").addClass("has-error")
			}
			
		}else{
			if(valore && !isValidField($(this).data("tipo") , valore ,"","") ) {
				error = true
				$(this).removeClass("has-success").addClass("has-error")
			}
		}
		
	});
	 
    // VERIFICA SCELTA CAMERA
    /*if(!camera_singola && !camera_doppia && !camera_indiferente){
        error = true
        $("#label_camera_check").addClass("has-error");
    }
    else
        $("#label_camera_check").removeClass("has-error");*/
        
    // VERIFICA CAPCHA
    var response = grecaptcha.getResponse();
    if(!response){
        error = true;
        $( "#error_captcha_code" ).html(getErrorText("NOR")).fadeIn();
    }
    else
        $( "#error_captcha_code" ).html("").fadeOut(); 

    // VERIFICA CHECK SULLA PRIVACY 
    if(!privacy){
        error = true; 
        $( "#error_privacy" ).html(getErrorText("PR")).fadeIn();
    }
    else
        $( "#error_privacy" ).html("").fadeOut();

    if(!aut1){
        error = true; 
        $( "#error_consenso" ).html(getErrorText("CN")).fadeIn();
    }
    else
        $( "#error_consenso" ).html("").fadeOut();

    if(!aut2){
        error = true; 
        $( "#error_mailing" ).html(getErrorText("ML")).fadeIn();
    }
    else
        $( "#error_mailing" ).html("").fadeOut();

    if(!aut3){
        error = true; 
        $( "#error_media" ).html(getErrorText("ML")).fadeIn();
    }
    else
        $( "#error_media" ).html("").fadeOut();
  	
	// CONTROLLO DATE 
	
	var checkDate =  verifyDate();
	if(checkDate == false){
		$( "#data_out" ).removeClass("has-success").addClass("has-error"); 
		error = true	
	}
	else
		$( "#data_out" ).removeClass("has-error").addClass("has-success"); 
	
	
    if(error == false){
        $('#wait').modal("show");
		$( "#form_iscrizione" ).submit();
	}
    else
		$("#myModal").modal({show: true});
    
});

// VERIFICA DEI CAMPI 
function isValidField(field, value, maxLength, minLength) {  
    let exp;
    switch (field) {
        case "email":
            exp = /^([a-zA-Z0-9_\.\-])+@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})(\s+([a-zA-Z0-9_\.\-])+@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4}))*$/;
            break;
        case "alfa":
            exp = /^([a-zA-Z0-9])+$/;
            break;
        case "text":
            exp = /^([a-zA-Z0-9\xE0\xE8\xE9\xF9\xF2\xEC\x27 .\-\/ ])+$/;
            break;
        case "numero":
            exp = /^([0-9])+$/;
            break;
        case "cellulare":
            exp = /^([0-9\+])+$/;
            break;
        case "data":
            exp = /^([0-9]{2}-[0-9]{2}-[0-9]{4})$/;
            break;
        default:
            exp = /^([a-zA-Z0-9])+$/;
            break;    
    }

    // Convertiamo value in stringa solo se esiste
    if (value !== undefined && value !== null && value !== '') {
        const strValue = String(value);

        if (!exp.test(strValue)) return false;

        if (maxLength && strValue.length > maxLength) return false;
        if (minLength && strValue.length < minLength) return false;

        return true;
    }

    return false;
}


// TESTI PERSONALIZZATI IN LINGUA
function getErrorText(text){
    
    var resp =''
    var lang = document.getElementById('language').value;
    
    switch(text){
        case"STR":
            switch(lang){
                case"it":
                    resp="Selezionare la struttura";
                    break;
                case"en":
                    resp="Select accommodation";
                    break;
                case"es-ES":
                    resp="obligatorio";
                    break;
                        
            }
            break;
        case"GEN":
            switch(lang){
                case"it":
                    resp="Verificare i campi evidenziati";
                    break;
                case"en":
                    resp="Check the highlighted fields";
                    break;
                case"es-ES":
                    resp="Revise los campos resaltados";
                    break;
            }
            break;
        case"CO":
            switch(lang){
                case"it":
                    resp="Obbligatorio";
                    break;
                case"en":
                    resp="Required";
                    break;
                case"es-ES":
                    resp="obligatorio";
                    break;
            }
            break;
        case"NV":
            switch(lang){
                case"it":
                    resp="Non valido";
                    break;
                case"en":
                    resp="Invalid value";
                    break;
                case"es-ES":
                    resp="Valor no v?do";
                    break;
            }
            break;
        case"PR":
            switch(lang){
                case"it":
                    resp='<br />&Egrave; necessario dare il consenso al trattamento dei dati';
                    break;
                case"en":
                    resp="<br />You need to give consent to the processing of data";
                    break;
                case"es-ES":
                    resp="<br />Usted necesita dar su consentimiento al tratamiento de los datos";
                    break;
            }
            break;
        case"CS":
            switch(lang){
                case"it":
                    resp="Indicare come si &egrave; venuti a conoscienza di sharing.to.it";
                    break;
                case"en":
                    resp="Indicate how did you hear about sharing.to.it";
                    break;
                case"es-ES":
                    resp="Indique c&oacute;mo se enter&oacute; de sharing.to.it";
                    break;
                        
            }
            break;
        case"FA":
            switch(lang){
                case"it":
                    resp="Indicare la formula abitativa";
                    break;
                case"en":
                    resp="Enter the housing formula";
                    break;
                case"es-ES":
                    resp="Introduzca la vivienda f&oacute;rmula";
                    break;
                        
            }
            
            break;
        case"FC":
            switch(lang){
                case"it":
                    resp="Indicare tipo campus";
                    break;
                case"en":
                    resp="Indicate campus type";
                    break;
                case"es-ES":
                    resp="Indique el campus";
                    break;
                        
            }
            break;
        case"FH":
            switch(lang){
                case"it":
                    resp="Indicare tipo housing";
                    break;
                case"en":
                    resp="Indicate housing type";
                    break;
                case"es-ES":
                    resp="Indique el housing";
                    break;
                        
            }
            break;
        case"PR":
            switch(lang){
                case"it":
                    resp='&Egrave; necessario dare il consenso al trattamento dei dati';
                    break;
                case"en":
                    resp="You need to give consent to the processing of data";
                    break;
                case"es-ES":
                    resp="Usted necesita dar su consentimiento al tratamiento de los datos";
                    break;
                        
            }
            break;
        case"CN":
        case"ML":
            switch(lang){
                case"it":
                    resp='La scelta &egrave; obbligatoria';
                    break;
                case"en":
                    resp="The choise is mandatory";
                    break;
                case"es-ES":
                    resp="la elección es obligatoria";
                    break;
                        
            }
            break;
        case"CD":
            switch(lang){
                case"it":
                    resp='Completare periodo soggiorno';
                    break;
                case"en":
                    resp="Complete period of stay";
                    break;
                case"es-ES":
                    resp="Per&iacute;odo completo de la estancia";
                    break;
                        
            }
            break;
        case"NOR":
            switch(lang){
                case"it":
                    resp='Dimostrare di non essere un robot';
                    break;
                case"en":
                    resp="Demonstrate not to be a robot";
                    break;
                case"es-ES":
                    resp="Dimostrare di non essere un robot";
                    break;
                        
            }
            break;    
        case"CAP":
            switch(lang){
                case"it":
                    resp='Riportare l\'immagine di controllo';
                    break;
                case"en":
                    resp="Devuelva la imagen de control";
                    break;
                case"es-ES":
                    resp="Return the Control image";
                    break;
                        
            }
            break;
        case"CAPN":
            switch(lang){
                case"it":
                    resp='Immagine di controllo non valida';
                    break;
                case"en":
                    resp="The control image is not valid";
                   
                    break;
                case"es-ES":
                    resp="La imagen de control no es valida";
                    break;
                        
            }
            break;
        case"INFO":
            switch(lang){
                case"it":
                    resp="&Egrave; neccessario accettare l'informativa sulla privacy";
                    break;
                case"en":
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

// BOOKING ONLINE 
function verifyDate(){
    var stato = true
	
	var inDate = $( "#data_in" ).val().split("-")
	var dataIn = new Date(inDate[2],inDate[1],inDate[0]).getTime()
	
	var outDate = $( "#data_out" ).val().split("-")
	var dataOut = new Date(outDate[2],outDate[1],outDate[0]).getTime()
	
    if(dataOut < dataIn)
        stato = false
	
	console.log(dataIn + " " + dataOut)
	
	console.log('data ' + stato)
	
	return stato;
}
