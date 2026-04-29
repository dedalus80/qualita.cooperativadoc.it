
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


function rispondi(from){
    
    var where ='';
    var txt='';
    switch(from){
        case"K":
            radioType = new Array('consiglia','viaggio_complessivo','camera_pulizia','camera_confort','struttura_complessivo','rapporto_keluar','trasporto_qualita','trasporto_cortesia','trasporto_tempi','ristorante_servizio','ristorante_cibo','ristorante_menu','personale_cortesia','personale_disponibilita');
            where ="questionario-keluar"
            break;
        case"D":
            radioType = new Array('consiglia','vacanza','struttura_pulizia','struttura_complessivo','stanza_confort','stanza_arredi','stanza_pulizia','stanza_complessivo','ristorante_servizio','ristorante_attesa','ristorante_cibo','ristorante_menu','ristorante_complessivo','personale_cortesia','personale_professionalita','personale_complessivo');
           
            where ="questionario-doc"
            break;
        case"S":
            radioType = new Array('consiglia','vacanza','struttura_pulizia','struttura_complessivo','stanza_confort','stanza_arredi','stanza_pulizia','stanza_complessivo','ristorante_servizio','ristorante_attesa','ristorante_cibo','ristorante_menu','ristorante_complessivo','personale_cortesia','personale_professionalita','personale_complessivo');
            where ="questionario-sharing"
            break;
    }
    
    
    
    
    
    
    
    var radioChecked = new Array;
    var campo
    for(x=0; x < radioType.length; x++){
        campo = document.getElementsByName(radioType[x])
        for (i=0; i < campo.length; i++) { 
            if (campo[i].checked)
                radioChecked[radioType[x]] = "Y";
        }
    }
    
    for(x=0; x < radioType.length; x++){
        if(!radioChecked[radioType[x]])
            txt +=radioType[x] +"\n"
    } 
    
    var nome    = document.getElementById('nome').value
    var cognome = document.getElementById('cognome').value
    
    if(!nome)
        txt +='indicare il nome del compilatore'
    else if(!validaTesto(nome))
        txt +='nome compilatore non valido'
    
    if(!cognome)
        txt +='indicare il cognome del compilatore'
    else if(!validaTesto(cognome))
        txt +='cognome compilatore non valido'
    
    if(from=='D' || from=='K'){
        var struttura = document.getElementById('struttura_nome').options[document.getElementById('struttura_nome').selectedIndex].value;
        if(struttura==0)
            txt +='manca la struttura'
    }
    
    if(from=='K'){
        if(document.getElementById('trasporto_nome').value=='')
            txt +='indicare il nome del trasporto'
        if(document.getElementById('sede_operativa').value=='')
            txt +='indicare la sede operativa'
        if(document.getElementById('scuola').value=='')
            txt +='indicare la scuola'
   
    }
    
    if(txt!='')
        alert("Si prega di completare il questionario nella sua interezza");
    else
        document.getElementById(where).submit();
      
}

