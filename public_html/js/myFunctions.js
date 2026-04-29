
$(document).ready(function(){
    $("#dialogAlert").dialog({
        width: 500,
        bgiframe: true, 
        autoOpen: false,
        resizable: true,
        modal: true,
        
        buttons: {
            Ok: function() {
                $(this).dialog('close');
            }
        }
    });
    
    
});



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

/*---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*  VALIDA CELLULARE	 
/*---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/    
    
function validaCellulare(cellulare){
    var re =  /^([0-9])+$/
    if (cellulare.match(re) && cellulare.length >=8 && cellulare.length <=12  )
        return cellulare;
    else
        return false;
}

/*---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
/*  VALIDA NUMERO	 
/*---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/    
   
function validaTesto(testo){
    var re =  /^([a-zA-Z ])+$/
    if (testo.match(re)  )
        return true;
    else
        return false;
}

function validaCodiceFiscale(codice){
    var re =  /^[a-zA-Z]{6}[0-9]{2}[a-zA-Z][0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$/;
    if (codice.match(re)  )
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

function rispondi(){
    
    document.getElementById("questionario-keluar").submit();
}


function submitForm(form){
    var OK =false;
    var dati="";
    var posti="";
    var error="";
    
    //  Se ho un piu date
    
    if(document.busForm.linea.length > 1){
        
        
        
        for(var j=0;j < document.busForm.linea.length;j++)    {
        
            if (document.busForm.linea[j].checked==true)         {
                document.getElementById("data").value= j;
                dati	  = document.getElementById('data_evento_'+j).options[document.getElementById('data_evento_'+j).selectedIndex].value;
                posti     = document.getElementById("posti_"+j).value
                OK = true;
            }
        }
    } // Ho una sola data
    else{
        
        document.getElementById("data").value= 0;
        dati	  = document.getElementById('data_evento_0').options[document.getElementById('data_evento_0').selectedIndex].value;
        posti     = document.getElementById("posti_0").value
        OK=true;
        
    }
    
    if(OK==true){
        
        if(!posti || posti =='' || posti =='0')
            error += "Si prega di inserire un valore numerico per il campo partecipanti <br>"
        else if(isNaN(posti))    
            error += "Si prega di inserire un valore numerico per il campo partecipanti <br>"
        else if(posti>6)
            error += " &egrave; possibile prenotare fino ad un massimo di 6 posti per volta <br>"
        if(dati==0)
            error += "Specifcare la citta di partenza <br>"
        
        if(error=='')
            $("#"+form).submit();
    }
    else
        error += "Indicare la data del concerto che si vuole prenotare <br>"
    
    
    if(error!=''){
        $('#dialogAlert').dialog('option', 'title',"Verificare i seguendi dati");
        $('#testoAlert').html(error);
        $('#dialogAlert').dialog('open');
    }
    
}

function setBusStart(ct){
    for(var j=0;j < document.lineaForm.linea.length;j++)
    {
        if (document.busForm.linea[j].checked) {
            OK=true;
        }
    }
}

function showPlace(id){
    
    var posti ='';
    for(var j=0;j < document.lineaForm.busStop.length;j++){
      
        if(j==id){
            posti   =  document.getElementById("posti_"+j).value;
            document.getElementById("posti").value= posti;
            document.lineaForm.busStop[j].checked=true;
        }
        else{
            document.lineaForm.busStop[j].checked=false;
            document.getElementById("posti_"+j).value ='';
        }
    }
   
    if(posti!='' && posti>0){
        
        jQuery.post('../../wp-content/themes/customtheme/php/getPlace.php', {
            'posti': posti
        },
        function(data){ 
            document.getElementById("form_partecipanti").innerHTML = data.txt;
            document.getElementById("form_prenotazioni").style.display = 'block';
        }, "json");
   
    }else{
        document.getElementById("form_partecipanti").innerHTML = "";
        document.getElementById("form_prenotazioni").style.display = 'none'; 
    }
    
}

function updateChoise(id){
    
    var idEvento  = document.getElementById("idEvento").value
    var dati	  = document.getElementById('data_evento_'+id).options[document.getElementById('data_evento_'+id).selectedIndex].value;
    var posti     = document.getElementById("posti_"+id).value
    var dbdata     = document.getElementById("dbdata_"+id).value
    
    if(dati!=0)
        var value 	  = dati.split("_");
    else
        document.getElementById("disponibili_"+id).innerHTML = "";
                       
    if(posti){
        if(posti){
            if(posti > 0 && dati !=0){
                                
                jQuery.post('../../wp-content/themes/customtheme/php/getDataPlace.php', {
                    'posti': posti,
                    'tipo':value[0],
                    'idStop':value[1],
                    'idLinea':value[2],
                    'idEvento':idEvento,
                    'dbdata':dbdata,
                    'idData': id,
                    'sel':dati
            
                },
                function(data){ 
                    if(data.status=='OK'){
                        
                        // Aggiorno il prezzo 
                        document.getElementById("prezzo_"+id).innerHTML = data.prezzo;
                        document.getElementById("disponibili_"+id).innerHTML = "<br>Posti: <span style='color:red'>"+data.postiRimasti+"</span>";
                        if(data.ora)
                            document.getElementById("ora_"+id).innerHTML = "Ora: <span style='color:red'>"+data.ora+"</span>";
                        else
                            document.getElementById("ora_"+id).innerHTML ="";
                        //  Setto le coordinate per la mappa 
                        
                       
                        if(data.indirizzo){
                            document.getElementById("box-mappa").style.display = 'block'
                            document.getElementById("lt").value = data.lat
                            document.getElementById("lg").value = data.lng
                            document.getElementById("box-desc").innerHTML = data.indirizzo
                            document.getElementById("box-img").innerHTML = data.img
                            document.getElementById("desc").value = data.indirizzo
                            // Creo mappa di google 
                            initialize()
                        //initMappa()
                        }else{
                            document.getElementById("box-mappa").style.display = 'none'
                            document.getElementById("lt").value =""
                            document.getElementById("lg").value = ""
                            document.getElementById("desc").value = data.indirizzo
                            document.getElementById("box-desc").innerHTML = data.indirizzo
                        }
                    }
                    else{
                        var txt = "Il numero di posti scelti \u00C9 superiore ai posti rimasti <br> Si prega di diminuire il numero di parecipanti o scegliere un altra citta di partenza"
                        $('#testoAlert').html(txt);
                        $('#dialogAlert').dialog('open');
                    }
                }, "json");
            }
        }
        else{
            $('#testoAlert').html("Si prega di inserire soltanto valori numerici");
            $('#dialogAlert').dialog('open'); 
        }
    }
}

function switchFotoMap(go){
    
    var testo ='';
    
    if(go=='F'){
        testo ="<a href='javascript:switchFotoMap(\"M\")'> <img src ='http://www.livescanner.it/wp-content/themes/customtheme/img/mappa.jpg'></a>"
        document.getElementById("box-img").style.display ='block'
        document.getElementById("mappa").style.display ='none'
    }
    else{
        testo ="<a href='javascript:switchFotoMap(\"F\")'> <img src ='http://www.livescanner.it/wp-content/themes/customtheme/img/camera.jpg'></a>"
        document.getElementById("box-img").style.display ='none'
        document.getElementById("mappa").style.display ='block'
    } 
    
    
    document.getElementById("switch-type").innerHTML = testo;
        
        
        
}


function showMappa(){
    
    if(document.getElementById("desc").value!=''){
        document.getElementById("box-mappa").style.display = 'block';
        initialize()
    }
    
}


function updatePlace(id){
    
    showPlace(id)
    /* initialize(id);*/
    updatePrice(id)
   
}

function facebookRegistration(){
    
    $('#dialogRegistrati').dialog('open');
}

function facebookLogin(){
    
    jQuery.post('../../wp-content/themes/customtheme/php/setUser.php', {
        'action': 'form'
    }, function(data){ 
        $('#dialogLogin').dialog('option', 'title',"Accedi");
        $('#testoLogin').html(data.txt);
        $('#dialogLogin').dialog('open');
    }, "json");
    
  
}

function updateCode(){

    var nazionalita= document.getElementById('nazionalita_1').options[document.getElementById('nazionalita_1').selectedIndex].value 
   
    if(nazionalita=='68')
        document.getElementById('code').style.display ='block';
    else
        document.getElementById('code').style.display ='block';
           
}

function checkFormPlace(){ 
    
    var error ='';
    var posti = document.getElementById('posti').value;
    
    //Verifico i dati per l' utente principale
    if(posti>0){
        
        //Verifico i dati per l' utente principale
        if(document.getElementById('nome_1').value ==''){
            document.getElementById('alert_nome_1').innerHTML ='Obbligatorio'
            error=1;
        }
        else if(!validaTesto(document.getElementById('nome_1').value)){
            document.getElementById('alert_nome_1').innerHTML ='Non Valido'
            error=1;
        }
        else
            document.getElementById('alert_nome_1').innerHTML =''
        // cognome
        if(document.getElementById('cognome_1').value ==''){
            document.getElementById('alert_cognome_1').innerHTML ='Obbligatorio'
            error=1;
        }
        else if(!validaTesto(document.getElementById('cognome_1').value)){
            document.getElementById('alert_cognome_1').innerHTML ='Non Valido'
            error=1;
        }
        else
            document.getElementById('alert_cognome_1').innerHTML =''
        
        //email
        if(document.getElementById('email_1').value ==''){
            document.getElementById('alert_email_1').innerHTML ='Obbligatorio'
            error=1;
        }
        else if(!validaEmail(document.getElementById('email_1').value)){
            document.getElementById('alert_email_1').innerHTML ='Non Valido'
            error=1;
        }
        else
            document.getElementById('alert_email_1').innerHTML =''
        
        //cellulare
        if(document.getElementById('cellulare_1').value ==''){
            document.getElementById('alert_cellulare_1').innerHTML ='Obbligatorio'
            error=1;
        }
        else if(!validaNumero(document.getElementById('cellulare_1').value)){
            document.getElementById('alert_cellulare_1').innerHTML ='Non Valido'
            error=1;
        }
        else
            document.getElementById('alert_cellulare_1').innerHTML =''  
         
        //indirizzo
        if(document.getElementById('indirizzo_1').value ==''){
            document.getElementById('alert_indirizzo_1').innerHTML ='Obbligatorio'
            error=1;
        }
        else
            document.getElementById('alert_indirizzo_1').innerHTML =''  
         
        //citta
        if(document.getElementById('citta_1').value ==''){
            document.getElementById('alert_citta_1').innerHTML ='Obbligatorio'
            error=1;
        }
        else
            document.getElementById('alert_citta_1').innerHTML ='' 
         
         
        var nazionalita= document.getElementById('nazionalita_1').options[document.getElementById('nazionalita_1').selectedIndex].value 
         
        //citta
        if(nazionalita =='0'){
            document.getElementById('alert_nazionalita_1').innerHTML ='Obbligatorio'
            error=1;
        }
        else if(nazionalita =='68'){
            
            //codice_fiscale
            if(document.getElementById('codice_fiscale_1').value ==''){
                document.getElementById('alert_codice_fiscale_1').innerHTML ='Obbligatorio'
                error=1;
            }
            else if(!validaCodiceFiscale(document.getElementById('codice_fiscale_1').value)){
                document.getElementById('alert_codice_fiscale_1').innerHTML ='Non Valido'
                error=1;
            }
            else
                document.getElementById('alert_codice_fiscale_1').innerHTML =''
        }
        
    }
    
    for(x=2; x<=posti; x++){
        if(document.getElementById('nome_'+x).value ==''){
            document.getElementById('alert_nome_'+x).innerHTML ='Obbligatorio'
            error=1;
        }
        else if(!validaTesto(document.getElementById('nome_'+x).value)){
            document.getElementById('alert_nome_'+x).innerHTML ='Non Valido'
            error=1;
        }
        else
            document.getElementById('alert_nome_'+x).innerHTML =''
        // cognome
        if(document.getElementById('cognome_'+x).value ==''){
            document.getElementById('alert_cognome_'+x).innerHTML ='Obbligatorio'
            error=1;
        }
        else if(!validaTesto(document.getElementById('cognome_'+x).value)){
            document.getElementById('alert_cognome_'+x).innerHTML ='Non Valido'
            error=1;
        }
        else
            document.getElementById('alert_cognome_'+x).innerHTML =''
        
        //email
        if(document.getElementById('email_'+x).value ==''){
            document.getElementById('alert_email_'+x).innerHTML ='Obbligatorio'
            error=1;
        }
        else if(!validaEmail(document.getElementById('email_'+x).value)){
            document.getElementById('alert_email_'+x).innerHTML ='Non Valido'
            error=1;
        }
        else
            document.getElementById('alert_email_'+x).innerHTML =''
        
        //cellulare
        if(document.getElementById('cellulare_'+x).value ==''){
            document.getElementById('alert_cellulare_'+x).innerHTML ='Obbligatorio'
            error=1;
        }
        else if(!validaNumero(document.getElementById('cellulare_'+x).value)){
            document.getElementById('alert_cellulare_'+x).innerHTML ='Non Valido'
            error=1;
        }
        else
            document.getElementById('alert_cellulare_'+x).innerHTML ='' 
    }
    
    var tipo_pagamento = document.getElementById('tipo_pagamento').options[document.getElementById('tipo_pagamento').selectedIndex].value; 
    
    if(tipo_pagamento == '0'){
        error =1;
        document.getElementById('alert_modalita').innerHTML ='Seleziona Modalita\'' ;
    }
    else{
        /*
        if(tipo_pagamento=='2')
            document.getElementById('lineaForm').target = "_blank";
*/
       
        document.getElementById('alert_modalita').innerHTML ='';
    }
    if(document.getElementById('contratto').checked == false){
        error =1;
        document.getElementById('alert_contratto').innerHTML ='dare il consenso' 
    }
    else
        document.getElementById('alert_contratto').innerHTML ='';
    
    if(document.getElementById('privacy').checked == false){
        
        error =1;
        document.getElementById('alert_privacy').innerHTML ='dare il consenso' 
    }
    else
        document.getElementById('alert_privacy').innerHTML ='';
        
    if(error=='')
        document.getElementById('lineaForm').submit()
    else
        return false;
   
   
}



function setSessionUser(user){
    
    jQuery.post('../../wp-content/themes/customtheme/php/setUser.php', {
        'id': user
    }, function(data){ 
        var txt = data.txt;
        if(txt !='OK'){
            return true;
            document.location.href='http://www.livescanner.it/registrati'
        }
        else{
            return user+" email"; 
        }
    }, "json");
}

function logout(){
    jQuery.post('../../wp-content/themes/customtheme/php/setUser.php', {
        'action': 'logout'
    }, function(data){ 
        var txt = data.txt;
        if(txt !='OK'){
            document.location.href='http://www.livescanner.it'
        }
        else{
            document.location.href='http://www.livescanner.it'
        }
    }, "json");

}

function userLogin(){

    var email       = document.getElementById('login_email').value;
    var password    = document.getElementById('login_password').value;
    var error       = 0;
    if(document.getElementById('tmp_evento'))
        var evento = document.getElementById('tmp_evento').value;
   
   
    if(email==''){
        error=1;
        document.getElementById('login_alert_email').innerHTML ='Obbligatorio';
    }
    else if(!validaEmail(email)){
        error=1;
        document.getElementById('login_alert_email').innerHTML ='Non valido';
    }
    else
        document.getElementById('login_alert_email').innerHTML ='';
    
    if(password==''){
        error=1;
        document.getElementById('login_alert_password').innerHTML ='Obbligatorio';
    }
    else
        document.getElementById('login_alert_password').innerHTML ='Obbligatorio';
   
    
    if(error==0){
    
        jQuery.post('http://www.livescanner.it/wp-content/themes/customtheme/php/setUser.php', {
            'evento':evento,
            'action':'login',
            'password':password,
            'email': email
        }, function(data){ 
            var txt = data.txt;
            if(txt !='OK'){
                document.location.href='http://www.livescanner.it/login'
            }
            else{
                
                if(evento)
                    document.location.href='http://www.livescanner.it/concerto/' + evento 
                else
                    document.location.href='http://www.livescanner.it/home'
            }
        }, "json");
    
    }
}


function updatePrice(id){
    
    var price = document.getElementById('quota_'+id).value
    var quanti = document.getElementById('posti_'+id).value
   
    var totale = price * quanti;
    
    document.getElementById('quota').value = price;
    document.getElementById('totale').value = totale;
    document.getElementById('totaleView').innerHTML = totale;
    
}

function checkUserRegistrtion(){
    
    var error ='';
    
    
    if(document.getElementById('nome').value=='')
        error += '- Il campo nome   \u00E9 obligatorio \n <br>';
		
    if(document.getElementById('cognome').value=='')
        error +='- Il campo cognome    \u00E9 obligatorio \n <br>';
		
    if(document.getElementById('data_nascita').value=='')
        error +='- Il campo data di nascita   \u00E9 obligatorio\n <br>';
			
    if(document.getElementById('cellulare').value=='')
        error +='- Il campo cellulare    \u00E9 obligatorio \n <br>';
			
    if(document.getElementById('email').value=='')
        error +='- Il campo email   \u00E9 obligatorio \n <br>';
   
    if(document.getElementById('password').value=='')
        error +='- Il campo password   \u00E9 obligatorio \n <br>';
    else if(document.getElementById('ripassword').value=='')
        error +='- Devi ripetere 2 volte la  password';
    else if(document.getElementById('ripassword').value != document.getElementById('password').value)
        error +='- Le due password non coincidono';
    
  
    if(document.getElementById('privacy').checked == false)
        error +='- Devi aver letto l\'informativa sulla privacy D.lgs 196/2003 deve esere selezionato \n <br>';
    
    if(document.getElementById('contratto').checked == false)
        error +='- Devi avere letto e accettato le condizioni contrattuali relative ai pacchetti turistici  \n <br>';
    
    
    if(error!=''){
        $('#dialogAlert').dialog('option', 'title',"Verificare i dati inseriti");
        $('#testoAlert').html(error);
        $('#dialogAlert').dialog('open');
   
    }
    else{
        
        var nome            = document.getElementById('nome').value
        var cognome         =  document.getElementById('cognome').value
        var email           =  document.getElementById('email').value
        var cellulare       =  document.getElementById('cellulare').value
        var password        =  document.getElementById('password').value
        var data_nascita     =  document.getElementById('data_nascita').value
        var luogo_nascita   =  document.getElementById('luogo_nascita').value
        var idFacebook      =  document.getElementById('idFacebook').value  
        var from            =  document.getElementById('from').value      
          
        jQuery.post('../../wp-content/themes/customtheme/php/regUser.php', {
            'nome': nome, 
            'cognome': cognome,
            'email': email, 
            'cellulare': cellulare, 
            'password': password, 
            'data_nascita': data_nascita,
            'luogo_nascita': luogo_nascita,
            'idFacebook':idFacebook ,
            'from':from
        
        }, function(data){ 
            
            var txt = data.txt;
            
            if(txt =='OK')
                document.location.href= "http://www.livescanner.it/" + data.from
            else{
                $('#dialogAlert').dialog('option', 'title'," Verificare i dati inseriti");
                $('#testoAlert').html(txt);        
                $('#dialogAlert').dialog('open');
            }
        }, "json");
    }
}   

function checkCell(){

var stato = document.getElementById('use-mobile').checked;
if(stato!=true){
    
    document.getElementById('news-mobile').disabled = "disabled";
    document.getElementById('news-mobile').className = "input-disabled";
    
}
else{
    document.getElementById('news-mobile').disabled = "";
    document.getElementById('news-mobile').className = "";
}
    

}


function checkNews(){
        
    document.getElementById('news-result').innerHTML  = "";
    var email       = document.getElementById('news-email').value
    var cellulare   = document.getElementById('news-mobile').value
    var privacy     = document.getElementById('news-privacy').checked
    var error =0;
    
    if(email==''){
        error=1;
        document.getElementById('news-email-error').innerHTML ='Obbligatorio';
    }
    else if(!validaEmail(email)){
        error=1;
        document.getElementById('news-email-error').innerHTML ='Non valida';
    } else
        document.getElementById('news-email-error').innerHTML ='';
    
    if(cellulare && !validaNumero(cellulare)){
        document.getElementById('news-mobile-error').innerHTML ='Non valido';
        error=1;
    }
    else
        document.getElementById('news-mobile-error').innerHTML ='';
    
    if(privacy != true){
        error=1;
        document.getElementById('news-privacy-error').innerHTML ='Dare il consenso';
    }
    else
        document.getElementById('news-privacy-error').innerHTML ='';
     
    if(error=='0'){
     
        jQuery.post('../../wp-content/themes/customtheme/php/regNewsUser.php', {
            'email': email, 
            'cellulare': cellulare
           
        }, function(data){
             document.getElementById('news-email').value ='';
             document.getElementById('news-mobile').value ='';
            document.getElementById('news-result').innerHTML  = data.txt;
        }, "json");
    }
}