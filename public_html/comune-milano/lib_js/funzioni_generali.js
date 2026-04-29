/* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */  
/* SET LISTA PER INSERIMENTO  */  
/* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
  
  
  
    $(document).ready(function() {
        $("#dialogAlert").dialog({show: 'bounce',position: 'top',hide: 'fold',height: "auto", width: "300",bgiframe: true, autoOpen: false,resizable: true,modal: true, draggable: true,closeOnEscape: true, close: function(event, ui) {document.getElementById('VAR_cognome');}});
    });
  
  
  
  function openDialog(testo){
  
    $('#testoAlert').html(testo);
    $('#dialogAlert').dialog('open');
  
  
  }
  

  function setIdLista(){
  
    var vacanzaLuogo = document.getElementById('VAR_casa_vacanza').options[document.getElementById('VAR_casa_vacanza').selectedIndex].value;
    var vacanzaData  = document.getElementById('VAR_data_vacanza').options[document.getElementById('VAR_data_vacanza').selectedIndex].value;
    
    switch(vacanzaLuogo){
      case '1':
        switch(vacanzaData){
          case '1': document.getElementById('id_lista').value = '40955' ; break;
          case '2': document.getElementById('id_lista').value = '40957' ; break;
          case '3': document.getElementById('id_lista').value = '40958' ; break;
          case '4': document.getElementById('id_lista').value = '40959' ; break;
          case '5': document.getElementById('id_lista').value = '40960' ; break;
          case '6': document.getElementById('id_lista').value = '40956' ; break;
          default: document.getElementById('id_lista').value = '40985'; break;
        }
      break;
      case '2':
        switch(vacanzaData){
          case '1': document.getElementById('id_lista').value = '40962' ; break;
          case '2': document.getElementById('id_lista').value = '40963' ; break;
          case '3': document.getElementById('id_lista').value = '40964' ; break;
          case '4': document.getElementById('id_lista').value = '40965' ; break;
          case '5': document.getElementById('id_lista').value = '40966' ; break;
          case '6': document.getElementById('id_lista').value = '40961' ; break;
          default: document.getElementById('id_lista').value = '40985' ; break;
        }
      break;
      case '3':
        switch(vacanzaData){
          case '1': document.getElementById('id_lista').value = '40967' ; break;
          case '2': document.getElementById('id_lista').value = '40968' ; break;
          case '3': document.getElementById('id_lista').value = '40969' ; break;
          case '4': document.getElementById('id_lista').value = '40970' ; break;
          case '5': document.getElementById('id_lista').value = '40971' ; break;
          case '6': document.getElementById('id_lista').value = '40972' ; break;
          default: document.getElementById('id_lista').value = '40985' ; break;
        }
      break;
      case '4':
        switch(vacanzaData){
          case '1': document.getElementById('id_lista').value = '40973' ; break;
          case '2': document.getElementById('id_lista').value = '40974' ; break;
          case '3': document.getElementById('id_lista').value = '40975' ; break;
          case '4': document.getElementById('id_lista').value = '40976' ; break;
          case '5': document.getElementById('id_lista').value = '40977' ; break;
          case '6': document.getElementById('id_lista').value = '40978' ; break;
          default: document.getElementById('id_lista').value = '40985' ; break;
        }
      break;
      case '5':
        switch(vacanzaData){
          case '1': document.getElementById('id_lista').value = '40979' ; break;
          case '2': document.getElementById('id_lista').value = '40980' ; break;
          case '3': document.getElementById('id_lista').value = '40981' ; break;
          case '4': document.getElementById('id_lista').value = '40982' ; break;
          case '5': document.getElementById('id_lista').value = '40983' ; break;
          case '6': document.getElementById('id_lista').value = '40984' ; break;
          default: document.getElementById('id_lista').value = '40985'; break;
        }
      break;
      default: document.getElementById('id_lista').value = '40985'  ; break;
    }
    
    if(document.getElementById('id_lista').value == '40959'){
      openDialog("Posti esauriti per il week del 9-10 Aprile presso la casa vacanza GHIFFA \n Modificare la propria scelta ");
      return false;
    }
    
    
  }
  
  function CkForm(element) {
      
    if(document.getElementById('id_lista').value == '40985'){
      openDialog("Specificare la casa vancanza e la data");
      return false;
    }
    
    if(document.getElementById('id_lista').value == '40959'){
      openDialog("PPosti esauriti per il week del 9-10 Aprile presso la casa vacanza GHIFFA \n Modificare la propria scelta");
      return false;
    }
    
    if(element.VAR_cognome.value==""){
      openDialog("Il campo Cognome è obbligatorio!");
      element.VAR_cognome.focus();
      return false;
    }

    if(element.VAR_nome.value=="")  {
      openDialog("Il campo Nome è obbligatorio!");
      element.VAR_nome.focus();
      return false;
    }
    
    if(element.VAR_campo_1.value==""){
      openDialog("Il campo Luogo di Nascita è obbligatorio!");
      element.VAR_campo_1.focus();
      return false;
    }
    
    var tmp_a_n  = element.VAR_a_n.options[element.VAR_a_n.selectedIndex].value;
    var tmp_m_n  = element.VAR_m_n.options[element.VAR_m_n.selectedIndex].value;   
    var tmp_g_n  = element.VAR_g_n.options[element.VAR_g_n.selectedIndex].value;   
		tmp_a_n = parseInt(tmp_a_n, 10);
		tmp_m_n = parseInt(tmp_m_n, 10);
		tmp_g_n = parseInt(tmp_g_n, 10);

    if(tmp_a_n != 0 || tmp_m_n != 0 || tmp_g_n != 0){
      if(tmp_a_n == 0 || tmp_m_n == 0 || tmp_g_n == 0 ){
        openDialog("Completare il campo Data di Nascita selezionando GIORNO, MESE e ANNO.");
        return false;
      }
    }
    else{
      openDialog("Completare il campo Data di Nascita selezionando GIORNO, MESE e ANNO.");
      return false;
    }
    
    if(element.VAR_citta.value==""){
      openDialog("Il campo Città è obbligatorio!");
      element.VAR_citta.focus();
      return false;
    }
    
     if(element.VAR_indirizzo.value==""){
      openDialog("Il campo Indirizzo è obbligatorio!");
      element.VAR_indirizzo.focus();
      return false;
    }
    
       if(element.VAR_numero_1.value=="")
    {
      openDialog("Il campo Numero Civico è obbligatorio!");
      element.VAR_numero_1.focus();
      return false;
    }
    else
        {
      var cont=element.VAR_numero_1.value;
      var exp = /\D+/;
      if(exp.test(cont)){
        openDialog("Nel campo Numero Civico non è corretto!\nSono accettati solo caratteri numerici.");
        element.VAR_numero_1.focus();
        return false;
      }        
    }
    
    
    if(element.VAR_iva.value=="")
    {
      openDialog("Il campo P. IVA / Cod. Fiscale è obbligatorio!");
      element.VAR_iva.focus();
      return false;
    }
    else    
        {
      cod = element.VAR_iva.value;
      if( cod.length == 16 )
        err = controllaCF(cod);
      else if( cod.length == 11 )
        err = controllaPIVA(cod);
      else
        err = "Il codice introdotto non e' valido:\n\n" +
        "  - un codice fiscale deve essere lungo 16 caratteri;\n\n" +
        "  - una partita IVA deve essere lunga 11 caratteri.\n";

      if( err > '')
      {
        element.VAR_iva.focus();
        openDialog("VALORE ERRATO\n\n" + err + "\nCorreggi e riprova!");
        return false;
      }
    }
    
    
    
    if(element.VAR_cap.value==""){
      openDialog("Il campo CAP è obbligatorio!");
      element.VAR_cap.focus();
      return false;
    }
    else    
    
    {
      var cont=element.VAR_cap.value;
      var exp = /\D+/;
      if(cont.length != 5 || exp.test(cont)){
        openDialog("Il campo CAP non è corretto.\nSono accettati 5 caratteri numerici!");
        element.VAR_cap.focus();
        return false;
      }
    }
    
    
    if(element.VAR_email.value!=""){
      var email_reg_exp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-]{2,})+\.)+([a-zA-Z0-9]{2,})+$/;

      if (!email_reg_exp.test(element.VAR_email.value) || (element.VAR_email.value == "") || (element.VAR_email.value == "undefined")){
        element.VAR_email.focus();
        openDialog("Inserire un indirizzo e-mail valido!");
        return false;
      }
    }
    
    
    
    
       if(element.VAR_cellulare.value=="")
    {
      openDialog("Il campo Cellulare è obbligatorio!");
      element.VAR_cellulare.focus();
      return false;
    }
    else
        {
      var ctrl_cell = /^([\+]{0,1})([0-9]+)$/;
      
      if(!ctrl_cell.test(element.VAR_cellulare.value)){
        openDialog("Il Cellulare inserito non è corretto!");
        element.VAR_cellulare.focus();
        return false;
      }
    }
    
    
    
    
    
     
    
     if(element.VAR_campo_2.value==""){
      openDialog("Il campo N Documento è obbligatorio!");
      element.VAR_campo_2.focus();
      return false;
    }
    
    
    
       if(element.VAR_campo_3.value==""){
      openDialog("Il campo Luogo di rilascio del documento è obbligatorio!");
      element.VAR_campo_3.focus();
      return false;
    }
    
    
    
    
        var tmp_a_1  = element.VAR_a_1.options[element.VAR_a_1.selectedIndex].value;
    var tmp_m_1  = element.VAR_m_1.options[element.VAR_m_1.selectedIndex].value;   
    var tmp_g_1  = element.VAR_g_1.options[element.VAR_g_1.selectedIndex].value;   
		tmp_a_1 = parseInt(tmp_a_1, 10);
		tmp_m_1 = parseInt(tmp_m_1, 10);
		tmp_g_1 = parseInt(tmp_g_1, 10);

    if(tmp_a_1 != 0 || tmp_m_1 != 0 || tmp_g_1 != 0){
      if(tmp_a_1 == 0 || tmp_m_1 == 0 || tmp_g_1 == 0 ){
        openDialog("Completare il campo Data di rilascio del documento selezionando GIORNO, MESE e ANNO.");
        return false;
      }
		}
    else{
      openDialog("Completare il campo  Data di rilascio del documento selezionando GIORNO, MESE e ANNO.");
      return false;
    }
    
    
    
    
    
      if(element.VAR_campo_4.value==""){
      openDialog("Il campo Cognome del figlio/a è obbligatorio!");
      element.VAR_campo_4.focus();
      return false;
    }
    
    if(element.VAR_campo_5.value==""){
      openDialog("Il campo Nome del figlio/a è obbligatorio!");
      element.VAR_campo_5.focus();
      return false;
    }
    
     if(element.VAR_campo_6.value==""){
      openDialog("Il campo Luogo Di Nascita del figlio/a è obbligatorio!");
      element.VAR_campo_6.focus();
      return false;
    }
    
    
    
    
    
     var tmp_a_2  = element.VAR_a_2.options[element.VAR_a_2.selectedIndex].value;
    var tmp_m_2  = element.VAR_m_2.options[element.VAR_m_2.selectedIndex].value;   
    var tmp_g_2  = element.VAR_g_2.options[element.VAR_g_2.selectedIndex].value;   
		tmp_a_2 = parseInt(tmp_a_2, 10);
		tmp_m_2 = parseInt(tmp_m_2, 10);
		tmp_g_2 = parseInt(tmp_g_2, 10);

    if(tmp_a_2 != 0 || tmp_m_2 != 0 || tmp_g_2 != 0){
      if(tmp_a_2 == 0 || tmp_m_2 == 0 || tmp_g_2 == 0 )
      {
        openDialog("Completare il campo Nascita del Figlio/a selezionando GIORNO, MESE e ANNO.");
        return false;
      }
    }
    else{
      openDialog("Completare il campo Nascita del Figlio/a selezionando GIORNO, MESE e ANNO.");
      return false;
    }
    
   
    
    if(element.VAR_campo_7.value==""){
      openDialog("Il campo Tessera Sanitaria è obbligatorio!");
      element.VAR_campo_7.focus();
      return false;
    }
    
   
    
    if(element.VAR_campo_8.value=="")
    {
      openDialog("Il campo P. IVA / Cod. Fiscale è obbligatorio!");
      element.VAR_campo_8.focus();
      return false;
    }
    else    
        {
      cod = element.VAR_campo_8.value;
      if( cod.length == 16 )
        err = controllaCF(cod);
      else if( cod.length == 11 )
        err = controllaPIVA(cod);
      else
        err = "Il codice introdotto non e' valido:\n\n" +
        "  - un codice fiscale deve essere lungo 16 caratteri;\n\n" +
        "  - una partita IVA deve essere lunga 11 caratteri.\n";

      if( err > '')
      {
        element.VAR_campo_8.focus();
        openDialog("VALORE ERRATO\n\n" + err + "\nCorreggi e riprova!");
        return false;
      }
    }
    
    
    
    if(element.VAR_campo_9.value==""){
      openDialog("Il campo Nome Scuola è obbligatorio!");
      element.VAR_campo_9.focus();
      return false;
    }
       
    
    
    
    
        if(element.VAR_campo_10.value==""){
      openDialog("Il campo Classe è obbligatorio!");
      element.VAR_campo_10.focus();
      return false;
    }
       
    
         if(element.VAR_numero_2.value==""){
      openDialog("Il campo Zezione è obbligatorio!");
      element.VAR_numero_2.focus();
      return false;
    }
         
    

     
       
    
    
       
    
     
     
        if(element.VAR_select_4.options[element.VAR_select_4.selectedIndex].value==0)
    {
      openDialog("Il campo Utente Milano Ristorazione è obbligatorio!");
      element.VAR_select_4.focus();
      return false;
    }
    
    
    
    
    
        if(element.VAR_select_5.options[element.VAR_select_5.selectedIndex].value==0)
    {
      openDialog("Il campo Dieta Sanitaria è obbligatorio!");
      element.VAR_select_5.focus();
      return false;
    }
    
    
    if(element.VAR_select_6.options[element.VAR_select_6.selectedIndex].value==0)
    {
      openDialog("Il campo Dieta Etico Religiosa è obbligatorio!");
      element.VAR_select_6.focus();
      return false;
    }
    
    
    if(element.VAR_casa_vacanza.options[element.VAR_casa_vacanza.selectedIndex].value==0)
    {
      openDialog("Specificare la destinazione della vacanza!");
      element.VAR_casa_vacanza.focus();
      return false;
    }
    
    
    if(element.VAR_data_vacanza.options[element.VAR_data_vacanza.selectedIndex].value==0)
    {
       openDialog("Specificare la data della vacanza!");
      element.VAR_data_vacanza.focus();
      return false;
    }
    
    
    if(document.getElementById('consenso').checked == false){
      openDialog("E obbligatorio aver letto l\'informativa sulla privacy. \n E dare il sonsenso al trattamento dei dati !");
      element.VAR_select_7.focus();
      return false;
    }
    
    
    return true;
  }
  
  function controllaPIVA(pi)
  {
    if( pi == '' )
      return '';
    if( pi.length != 11 )
      return "La lunghezza della partita IVA non è\n" +"corretta: la partita IVA dovrebbe essere lunga\n" +"esattamente 11 caratteri.\n";
        
    validi = "0123456789";
    for( i = 0; i < 11; i++ )
    {
      if( validi.indexOf( pi.charAt(i) ) == -1 )
        return "La partita IVA contiene un carattere non valido `" +pi.charAt(i) + "'.\nI caratteri validi sono solo i numeri.\n";
    }
        
    s = 0;
    for( i = 0; i <= 9; i += 2 )
      s += pi.charCodeAt(i) - '0'.charCodeAt(0);
        
    for( i = 1; i <= 9; i += 2 )
    {
      c = 2*( pi.charCodeAt(i) - '0'.charCodeAt(0) );
      if( c > 9 )  c = c - 9;
      s += c;
    }
        
    if(( 10 - s%10 )%10 != pi.charCodeAt(10) - '0'.charCodeAt(0) )
      return "La partita IVA non è valida:\n" +"il codice di controllo non corrisponde.\n";
    
    return '';
  }
  
  function controllaCF(cf)
  {
    var validi, i, s, set1, set2, setpari, setdisp;
    if( cf == '' )  return '';
    cf = cf.toUpperCase();
    if( cf.length != 16 )
      return "La lunghezza del codice fiscale non è\n"
                +"corretta: il codice fiscale dovrebbe essere lungo\n"
                +"esattamente 16 caratteri.\n";
    
    validi = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    for( i = 0; i < 16; i++ )
    {
      if( validi.indexOf( cf.charAt(i) ) == -1 )
        return "Il codice fiscale contiene un carattere non valido `" +cf.charAt(i) +"'.\nI caratteri validi sono le lettere e le cifre.\n";
    }
    set1 = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    set2 = "ABCDEFGHIJABCDEFGHIJKLMNOPQRSTUVWXYZ";
    setpari = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    setdisp = "BAKPLCQDREVOSFTGUHMINJWZYX";
    s = 0;
    
    for( i = 1; i <= 13; i += 2 )
      s += setpari.indexOf( set2.charAt( set1.indexOf( cf.charAt(i) )));
        
    for( i = 0; i <= 14; i += 2 )
      s += setdisp.indexOf( set2.charAt( set1.indexOf( cf.charAt(i) )));
        
    if( s%26 != cf.charCodeAt(15)-'A'.charCodeAt(0) )
      return "Il codice fiscale non è corretto:\n"+"il codice di controllo non corrisponde.\n";
        
    return "";
  }