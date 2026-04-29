/*---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*  VALIDA EMAIL	 
/*---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/    
	
function validaEmail(email){
    var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})(\s+([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4}))*$/
    if (email.match(re))
        return email;
    else
        return false;
}
   
function validaTesto(testo){
    var re = /^([a-zA-Z\xE0\xE8\xE9\xF9\xF2\xEC\x27]\s?)+$/;
    if (testo.match(re)  )
        return true;
    else
        return false;
}

function validaNumero(numero){
    var re =  /^([0-9])+$/
    if (numero.match(re)  )
        return numero;
    else
        return false;
}

function getErrorText(text){
    
    var resp =''
    var lang = document.getElementById('language').value;
    
    switch(text){
        case"CO":
            switch(lang){
                case"it-IT":
                    resp="Campo Obbligatorio";
                    break;
                case"en-GB":
                    resp="Required Field";
                    break;
                case"es-ES":
                    resp="Campo obligatorio";
                    break;
                        
            }
            break;
        case"NV":
            switch(lang){
                case"it-IT":
                    resp="Valore non valido";
                    break;
                case"en-GB":
                    resp="Invalid value";
                    break;
                case"es-ES":
                    resp="Valor no válido";
                    break;
                        
            }
            break;
        case"DN":
            switch(lang){
                case"it-IT":
                    resp="Completare data di nascita";
                    break;
                case"en-GB":
                    resp="Complete date of birth";
                    break;
                case"es-ES":
                    resp="Fecha completa de nacimiento";
                    break;
                        
            }
            break;
        case"CS":
            switch(lang){
                case"it-IT":
                    resp="Indicare come si &egrave; venuti a conoscienza di Stessopiano.it";
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
            
            
            
            
    }
    
    return resp;
    
}

function inscriviti(){
    
    var error =''
    
    if(document.getElementById('nome').value==''){
        error =1
        document.getElementById('error_nome').innerHTML=  getErrorText('CO')
    }
    else if(!validaTesto(document.getElementById('nome').value)){
        error =1
        document.getElementById('error_nome').innerHTML= getErrorText('NV')
    }
    else
        document.getElementById('error_nome').innerHTML=''
    
    
    
    if(document.getElementById('cognome').value==''){
        error =1
        document.getElementById('error_cognome').innerHTML= getErrorText('CO')
    }
    else if(!validaTesto(document.getElementById('cognome').value)){
        error =1
        document.getElementById('error_cognome').innerHTML= getErrorText('NV')
    }
    else
        document.getElementById('error_cognome').innerHTML=''
    
    
    if(document.getElementById('email').value==''){
        error =1
        document.getElementById('error_email').innerHTML= getErrorText('CO')
    }
    else if(!validaEmail(document.getElementById('email').value)){
        error =1
        document.getElementById('error_email').innerHTML= getErrorText('NV')
    }
    else
        document.getElementById('error_email').innerHTML=''
     
     
    if(document.getElementById('cellulare').value==''){
        error =1
        document.getElementById('error_cellulare').innerHTML= getErrorText('CO')
    }
    else if(!validaNumero(document.getElementById('cellulare').value)){
        error =1
        document.getElementById('error_cellulare').innerHTML= getErrorText('NV')
    }
    else
        document.getElementById('error_cellulare').innerHTML=''
    
    if(document.getElementById('luogo_nascita').value==''){
        error =1
        document.getElementById('error_luogo_nascita').innerHTML= getErrorText('CO')
    }
    else
        document.getElementById('error_luogo_nascita').innerHTML=''
    
    var n_a = document.getElementById('n_a').options[document.getElementById('n_a').selectedIndex].value
    var n_g = document.getElementById('n_g').options[document.getElementById('n_g').selectedIndex].value
    var n_m = document.getElementById('n_m').options[document.getElementById('n_m').selectedIndex].value
    
    if(n_a=='0' || n_m =='0' || n_g=='0'){
        error =1
        document.getElementById('error_data_nascita').innerHTML= getErrorText('DN')
    }
    else
        document.getElementById('error_data_nascita').innerHTML=''
    
    if(document.getElementById('nazionalita').options[document.getElementById('nazionalita').selectedIndex].value=='0'){
        error =1
        document.getElementById('error_nazionalita').innerHTML= getErrorText('CO')
    }
    else
        document.getElementById('error_nazionalita').innerHTML=''
    
    if(document.getElementById('occupazione').options[document.getElementById('occupazione').selectedIndex].value=='0'){
        error =1
        document.getElementById('error_occupazione').innerHTML= getErrorText('CO')
    }
    else
        document.getElementById('error_occupazione').innerHTML=''
    
    if(document.getElementById('conoscienza').options[document.getElementById('conoscienza').selectedIndex].value=='0'){
        error =1
        document.getElementById('error_conoscienza').innerHTML= getErrorText('CS')
    }
    else
        document.getElementById('error_conoscienza').innerHTML=''
    
    // SESSO  ----------------------------------------------------------------------------------------------------------------------------------------------------
    
    var sesso = document.form_iscrizione.sesso;
    var sessoCheck =0;
    
    for(x=0; x < sesso.length; x++){
        if(sesso[x].checked == true)
            sessoCheck = 1;
    }
    if(sessoCheck==0){
        document.getElementById('error_sesso').innerHTML= getErrorText('CO')
        error =1
    }
    else
        document.getElementById('error_sesso').innerHTML='' 
    
    // PRIMA VOLTA ----------------------------------------------------------------------------------------------------------------------------------------------------
    
    var prima_volta = document.form_iscrizione.prima_volta;
    var prima_voltaCheck =0;
    
    for(x=0; x < prima_volta.length; x++){
        if(prima_volta[x].checked == true)
            prima_voltaCheck = 1;
    }
    
    //  APPARTAMENTO ----------------------------------------------------------------------------------------------------------------------------------------------------
    
    var appartamento = document.form_iscrizione.appartamento;
    var appartamento_check =0;
    for(x=0; x < appartamento.length; x++){
        if(appartamento[x].checked == true && appartamento[x].value =='Y')
            appartamento_check = 1;
    }
    
    if(appartamento_check == 1 && document.getElementById('tipo_appartamento').options[document.getElementById('tipo_appartamento').selectedIndex].value==0){
        document.getElementById('error_appartamento').innerHTML= "Specificare il tipo di appartamento scelto"
        error =1
    }else
        document.getElementById('error_appartamento').innerHTML=''   
    
    // CAMERA ----------------------------------------------------------------------------------------------------------------------------------------------------
    
    var camera = document.form_iscrizione.camera;
    var camera_check =0;
    for(x=0; x < camera.length; x++){
        if(camera[x].checked == true && camera[x].value =='Y')
            camera_check = 1;
    }
    
    if(camera_check == 1 && document.getElementById('tipo_camera').options[document.getElementById('tipo_camera').selectedIndex].value==0){
        document.getElementById('error_camera').innerHTML= "Specificare il tipo di camera scelto"
        error =1
    }else
        document.getElementById('error_camera').innerHTML=''   
    
    // LIVELLO ----------------------------------------------------------------------------------------------------------------------------------------------------
        
    var livello =  document.getElementById('livello').options[document.getElementById('livello').selectedIndex].value;
    if(livello==0){
        document.getElementById('error_livello').innerHTML= getErrorText('CO')
        error =1
    }
    else{
        
        if(livello=='7' && document.getElementById('livello_det').value==''){
            document.getElementById('error_livello').innerHTML= "Indicare il livello massimo di spesa mensile";
             error =1
        }
        else
            document.getElementById('error_livello').innerHTML='';
    }
    
    // COINQUILINI  ----------------------------------------------------------------------------------------------------------------------------------------------------
    
    var coinquilini = document.form_iscrizione.coinquilini;
    var coinquilini_check =0;
    for(x=0; x < coinquilini.length; x++){
        if(coinquilini[x].checked == true && coinquilini[x].value =='Y')
            coinquilini_check = 1;
    }
    
    if(coinquilini_check == 1 && document.getElementById('coinquilini_quanti').value==''){
        document.getElementById('error_coinquilini').innerHTML= "Indicare il numero coinquilini"
        error =1
    }else{
        if(!validaNumero(document.getElementById('coinquilini_quanti').value))
            document.getElementById('error_coinquilini').innerHTML= "Indicare il numero coinquilini"
        else
            document.getElementById('error_coinquilini').innerHTML=''
    }
         
    // QUARTIERI  ----------------------------------------------------------------------------------------------------------------------------------------------------
    
    var quartiere =  document.getElementById('quartiere').options[document.getElementById('quartiere').selectedIndex].value;
    if(livello==0){
        document.getElementById('error_quartiere').innerHTML= getErrorText('CO')
        error =1
    }
    else
        document.getElementById('error_quartiere').innerHTML= ""
    
    // FUMATORE  ----------------------------------------------------------------------------------------------------------------------------------------------------
    
    var fumatore = document.form_iscrizione.fumatore;
    var fumatore_check =0;
    for(x=0; x < fumatore.length; x++){
        if(fumatore[x].checked == true)
            fumatore_check = 1;
    }
    
    if(fumatore_check==0)
        document.getElementById('error_fumatore').innerHTML= getErrorText('CO')
    else
        document.getElementById('error_fumatore').innerHTML= ""
    
    // ANIMALI  ----------------------------------------------------------------------------------------------------------------------------------------------------
    
    var animali = document.form_iscrizione.animali;
    var animali_check =0;
    var quanti =0;
    for(x=0; x < animali.length; x++){
        if(animali[x].checked == true){
            if(animali[x].value =='Y')
                quanti =1
            
            animali_check = 1;
        }
    }
    
    if(animali_check==0)
        document.getElementById('error_animali').innerHTML= getErrorText('CO')
    else{
        
        if(quanti=='1'){
            if(document.getElementById('animali_det').value=='')
                document.getElementById('error_animali').innerHTML= ""
            else{
                if(!validaNumero(document.getElementById('animali_det').value))
                    document.getElementById('error_animali').innerHTML= getErrorText('CO')
                else
                    document.getElementById('error_animali').innerHTML= ""
            } 
        } else
            document.getElementById('error_animali').innerHTML= ""
    }
    
    if(prima_voltaCheck==0){
        document.getElementById('error_prima_volta').innerHTML= getErrorText('CO')
        error =1
    }
    else
        document.getElementById('error_prima_volta').innerHTML='' 
    
    
    if(document.getElementById('privacy').checked== false){
        document.getElementById('error_privacy').innerHTML=  getErrorText('PR')
        error =1
    }
    else
        document.getElementById('error_privacy').innerHTML=''
        
    var a_a = document.getElementById('a_a').options[document.getElementById('a_a').selectedIndex].value
    var a_g = document.getElementById('a_g').options[document.getElementById('a_g').selectedIndex].value
    var a_m = document.getElementById('a_m').options[document.getElementById('a_m').selectedIndex].value
    
    if(a_a=='0' || a_m =='0' || a_g=='0'){
        error =1
        document.getElementById('error_data').innerHTML= getErrorText('CD') 
    }
    else
        document.getElementById('error_data').innerHTML=''     
    
    var p_a = document.getElementById('p_a').options[document.getElementById('p_a').selectedIndex].value
    var p_g = document.getElementById('p_g').options[document.getElementById('p_g').selectedIndex].value
    var p_m = document.getElementById('p_m').options[document.getElementById('p_m').selectedIndex].value
    
    if(p_a=='0' || p_m =='0' || p_g=='0'){
        error =1
        document.getElementById('error_data').innerHTML= getErrorText('CD') 
    }
    else
        document.getElementById('error_data').innerHTML='' 
    /*
    if(error!='')
        alert("Si completare i dati della preiscrizione");
    else
        document.getElementById("form_iscrizione").submit();
    */
    
    document.getElementById("form_iscrizione").submit();
    
            
}


function showFormula(){
    var formula = document.getElementById('formula').options[document.getElementById('formula').selectedIndex].value;
    
    if(formula=='1'){
        document.getElementById('f_c').style.display='block'
        document.getElementById('f_h').style.display='none'
    }
    else if(formula=='2'){
        document.getElementById('f_c').style.display='none'
        document.getElementById('f_h').style.display='block'
    }
    else{
        document.getElementById('error_housing').innerHTML=''
        document.getElementById('error_campus').innerHTML=''
        document.getElementById('f_h').style.display='none'
        document.getElementById('f_c').style.display='none'
            
    }
    
}

function specificare(){
    var dato = document.getElementById('livello').options[document.getElementById('livello').selectedIndex].value;
    if(dato=='7')
        document.getElementById('livello_altro').style.display='inline'
    else
        document.getElementById('livello_altro').style.display='none'
}


function conosciuto(){
    var dato = document.getElementById('conoscienza').options[document.getElementById('conoscienza').selectedIndex].value;
    if(dato=='11')
        document.getElementById('box_conoscienza').style.display='inline'
    else
        document.getElementById('box_conoscienza').style.display='none'
}



function showSelect(dato){
    var box ='N';
    var campo = document.getElementsByName(dato)
    for (i=0; i < campo.length; i++) { 
        if (campo[i].checked && campo[i].value=='Y')
            box = "Y"
    }
        
    if(box=='Y')
        document.getElementById('box_'+dato).style.display='inline'
    else{
    
        document.getElementById('box_'+dato).style.display='none'
        if(dato=='appartamento')
            document.getElementById('error_appartamento').innerHTML=''
        if(dato=='camera')
            document.getElementById('error_camera').innerHTML=''
    }
}
