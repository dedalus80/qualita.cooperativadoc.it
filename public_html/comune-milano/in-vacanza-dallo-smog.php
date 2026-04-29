<?

  date_default_timezone_set('Europe/Rome');

  $dati  = $_REQUEST;
  if($dati['message']=='OK DATI INSERITI CORRETTAMENTE' || $dati['message']=='UTENTE REGISTRATO CORRETTAMENTE'){
    $result ='OK';
  }

  if(!$dati['id_lista'])
     $dati['id_lista'] = '40985';

  //$oggi    = mktime(0, 0, 0, 3, date("d"), 2011, 0);
  $oggi    = time();
  $lunedi  = mktime(0, 0, 01, 4, 9, 2011);
  $fine    = mktime(23, 59, 59, 4, 14, 2011);
  
  if($oggi <= $lunedi || $oggi >= $fine  )
    $pubblica ='KO';
   
  $esaurito = $_REQUEST['es'];  
  /*
  if($_REQUEST['test'])
     $pubblica ='KO';
  */
?>



<html>
<head>
<title>IN VACANZA DALLO SMOG</title>

  <script type="text/javascript" src="./lib_js/jquery-1.4.4.js"></script>
	<script type="text/javascript" src="./lib_js/jquery.bgiframe-2.1.2.js"></script>
	<script type="text/javascript" src="./lib_js/jquery.ui.core.js"></script>
	<script type="text/javascript" src="./lib_js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="./lib_js/jquery.ui.mouse.js"></script>
	<script type="text/javascript" src="./lib_js/jquery.ui.draggable.js"></script>
	<script type="text/javascript" src="./lib_js/jquery.ui.position.js"></script>
	<script type="text/javascript" src="./lib_js/jquery.ui.resizable.js"></script>
	<script type="text/javascript" src="./lib_js/jquery.ui.dialog.js"></script>
  <script type="text/javascript" src="./lib_js/funzioni_generali.js" ></script>
  <link   rel="Stylesheet"       type="text/css" href="./lib_css/style.css" />
  <link   rel="Stylesheet"       type="text/css" href="./lib_css/jquery.css" />
    
  <!--[if IE]>
    <style type="text/css">
    #pagina{width: 900px}
    </style>
  <![endif]-->

</head>
<body>
 <div id='dialogAlert' title='Attenzione'>
      <p id='testoAlert' style='text-align:left' ></p>
    </div>


  <div id='sito'>
  
    <!-- DIALOG ALERT -->
    
    <? if($pubblica=='KO'){?>
      <div style='text-align: center; padding-left: 0px; padding-right:0px; '><img src='./lib_img/avvisoFine.png'>
    
      </div>
    <? }else{ ?>
  
    <div id='pagina'>
      
      <div id='fiore'>
      
        <div id='top' ></div>
        <? if(!$result){?>
        <div class='desc-black'>Scheda di iscrizione  &nbsp;&nbsp; - Per effettuare l'iscrizione &egrave; necessario:<br>
        &nbsp;&nbsp; - Compilare tutti i campi richiesti <br>
        &nbsp;&nbsp; - Scaricare e compilare la seguente <a class='linkTesto' href='./allegati_pdf/scheda-sanitaria.pdf' target='_blank' > "scheda sanitaria"</a><br>
        &nbsp;&nbsp; - Per info e problemi scrivere a <a  class='linkTesto' style='text-decoration:underline' href="mailto:invacanzadallosmog@cooperativadoc.it">invacanzadallosmog@cooperativadoc.it</a>
        <br>
        <br>
        
        
        
        
        </div>
        <?}?>
      </div>
      <br>
      <br>
      <div id='tabella'>
       
      
      
      
        <? if ($result){?>
          
          <div class='desc' style='padding-bottom: 160px; text-align: left; padding-right: 50px'>
          <?if($esaurito=='SI'){?>
          LA SUA ISCRIZIONE NON PUO' ESSERE ACCOLTA PRESSO LA CASA VACANZA RICHIESTA,<BR>
          SARA' CONTATTATO ENTRO IL 18 APRILE PER UNA PROPOSTA ALTERNATIVA, COMPATIBILE CON I POSTI COMPLESSIVAMENTE DISPONIBILI.
          <?}else{?>
          <p>GRAZIE PER AVER COMPILATO LA SCHEDA DI ISCRIZIONE DEL SERVIZIO IN VACANZA DALLO SMOG.<br><br>
          SARA' RICONTATTATO AL PIU' PRESTO PER RICEVERE CONFERMA DELL'AVVENUTA ISCRIZIONE E RICEVERA' UN SMS CON IL LUOGO E  L'ORARIO DI PARTENZA.</p>
          <p>LE RICORDIAMO CHE PER POTER PARTIRE OCCORRE PORTARE ALLA PARTENZA:<br>
          LA SCHEDA SANITARIA COMPILATA E FIRMATA<br>
          LA RICEVURA DEL VERSAMENTO DI Â€ 21,00</p>
          <p>INOLTRE PER INFORMAZIONI ED EVENTUALI DISDETTE E/O VARIAZIONI RIVOLGERSI ALLA SEGRETERIA ORGANIZZATIVA AL NUMERO <span class='desc-black'>3491664329</span></p>
          <?}?>
        </div>
        <?}else{?>
          <?if($dati['message']){?>
          <div class='alert'> 
          <font class='red' style='padding-left: 20px'>Attenzione I seguenti dati non sono corretti si prega di verificarli</font><br>
          <font class='desc' style=''><div style='padding-left: 20px'><?=$dati['message']?></div></font>
          </div>
        <?}?>
         <form name="contatto" method="post" action="https://www.totalconnect.it/iscritti/inserimento_utente_milano.php" onSubmit="return(CkForm(this));" enctype="multipart/form-data"> 
        <!-- <form name="contatto" method="post" action="https://www.totalconnect.it/iscritti/inserimento_utente_milano.php" enctype="multipart/form-data"> -->
          <table width='100%'>
            
            
            
            <tr>
              <td class='desc red' colspan='4' style='text-align:center'>ISCRIZIONI DAL 9 AL 14 APRILE</td>
            </tr>
            
            <tr>
              <td class='desc' colspan='4'>Il genitore ( o l'esercente la potest&agrave; familiare)</td>
            </tr>
            <tr>
              <td  class='left' width='25%'>Cognome&nbsp; </td>
              <td  class='right' ><input type="text" name="VAR_cognome" value="<?=$dati['VAR_nome']?>" size="23"></td>
              <td  class='left'>Nome&nbsp; </td>
              <td  class='right' width='40%'><input type="text" name="VAR_nome" value="<?=$dati['VAR_cognome']?>" size="23"></td>
            </tr>
            <tr>
              <td class='left'>Nato a&nbsp; </td>
              <td class='right' ><input type="text" name="VAR_campo_1" value="<?=$dati['VAR_campo_1']?>" size="23"></td>
              <td class='left'>Il&nbsp; </td>
              <td class='right' ><select name="VAR_g_n" >
                <option value="0" >--</option>
               <? for($x=1; $x<=31; $x++){
                      
                      if($x<10)
                        $k="0".$x;
                      else
                        $k =$x;
                      if($k==$dati['VAR_g_n'])
                        $selected[$x] = "selected='selected'";
                      
                      echo "<option value='".$k."' ".$selected[$x]." >".$x."</option>"; 
                  } 
                  ?>
              </select>
                <select name="VAR_m_n" >
                  <option value="0" >--</option>
                  <option value="01" <?= $dati['VAR_m_n']=='01' ? "selected='selected'":"" ?> >Gen</option>
                  <option value="02" <?= $dati['VAR_m_n']=='02' ? "selected='selected'":"" ?>>Feb</option>
                  <option value="03" <?= $dati['VAR_m_n']=='03' ? "selected='selected'":"" ?>>Mar</option>
                  <option value="04" <?= $dati['VAR_m_n']=='04' ? "selected='selected'":"" ?>>Apr</option>
                  <option value="05" <?= $dati['VAR_m_n']=='05' ? "selected='selected'":"" ?>>Mag</option>
                  <option value="06" <?= $dati['VAR_m_n']=='06' ? "selected='selected'":"" ?>>Giu</option>
                  <option value="07" <?= $dati['VAR_m_n']=='07' ? "selected='selected'":"" ?>>Lug</option>
                  <option value="08" <?= $dati['VAR_m_n']=='08' ? "selected='selected'":"" ?>>Ago</option>
                  <option value="09" <?= $dati['VAR_m_n']=='09' ? "selected='selected'":"" ?>>Set</option>
                  <option value="10" <?= $dati['VAR_m_n']=='10' ? "selected='selected'":"" ?>>Ott</option>
                  <option value="11" <?= $dati['VAR_m_n']=='11' ? "selected='selected'":"" ?>>Nov</option>
                  <option value="12" <?= $dati['VAR_m_n']=='12' ? "selected='selected'":"" ?>>Dic</option>
                </select>
                <select name="VAR_a_n" >
                  <option value="0">--</option>
                  <? for($x=1905; $x<=2011; $x++){
                      if($x==$dati['VAR_a_n'])
                        $selected[$x] = "selected='selected'";
                      echo "<option value='".$x."' ".$selected[$x]." >".$x."</option>"; 
                  }?>
                </select></td>
            </tr>
            <tr>
              <td class='left'>Residente a&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_citta" value="<?=$dati['VAR_citta']?>" size="23"></td>
              <td class='left'>In Via&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_indirizzo" value="<?=$dati['VAR_indirizzo']?>" size="23">
                &nbsp;N&deg;&nbsp;
                <input type="text" name="VAR_numero_1" value="<?=$dati['VAR_numero_1']?>" size="4"></td>
            </tr>
            <tr>
              <td class='left'>Cod. Fiscale&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_iva" value="<?=$dati['VAR_iva']?>" size="23"></td>
              <td class='left'>Cap&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_cap" value="<?=$dati['VAR_cap']?>" size="5"></td>
            </tr>
            <tr></tr>
            <tr>
              <td class='left'>Telefono&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_telefono" value="<?=$dati['VAR_telefono']?>" size="23"></td>
              <td class='left'>Cellulare&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_cellulare" value="<?=$dati['VAR_cellulare']?>" size="23"></td>
            </tr>
            <tr>
              <td class='left'>E-mail&nbsp;</td>
              <td class='right' colspan='3'><input type="text" name="VAR_email" value="<?=$dati['VAR_email']?>" size="23"></td>
            </tr>
            
            <tr>
              <td class='desc' colspan='4'>Documenti (in corso di validit&agrave;) </td>
            </tr>
            <tr>
              <td class='left'><input type="radio" name="VAR_select_1" value="3214" size="5" checked='checked' <?= $dati['VAR_select_1']=='3214' ?  "checked='checked'":""    ?> ></td>
              <td class='right' colspan='3'>Passaporto&nbsp;
                <input type="radio" name="VAR_select_1" value="3227"  <?= $dati['VAR_select_1']=='3227' ? "checked='checked'":""    ?>>Patente&nbsp;
                <input type="radio" name="VAR_select_1" value="3213" <?= $dati['VAR_select_1']=='3213' ? "checked='checked'":""    ?>>C.i</td>
            </tr>
            <tr>
              <td class='left'>Numero&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_campo_2" value="<?=$dati['VAR_campo_2']?>" size="23"></td>
              <td class='left'>Rilasciato da&nbsp;</td>
              <td  class='right'><input type="text" name="VAR_campo_3" value="<?=$dati['VAR_campo_3']?>" size="15">
                &nbsp;Il&nbsp;
                <select name="VAR_g_1" >
                  <option value="0" >--</option>
                  <? for($x=1; $x<=31; $x++){
                      
                      if($x<10)
                        $k="0".$x;
                      else
                        $k =$x;
                      if($k==$dati['VAR_g_1'])
                        $selected[$x] = "selected='selected'";
                      
                      echo "<option value='".$k."' ".$selected[$x]." >".$x."</option>"; 
                  } 
                  ?>
                </select>
                <select name="VAR_m_1" >
                  <option value="0" >--</option>
                  <option value="01" <?= $dati['VAR_m_1']=='01' ? "selected='selected'":""; ?> >Gen</option>
                  <option value="02" <?= $dati['VAR_m_1']=='02' ? "selected='selected'":""; ?>>Feb</option>
                  <option value="03" <?= $dati['VAR_m_1']=='03' ? "selected='selected'":""; ?>>Mar</option>
                  <option value="04" <?= $dati['VAR_m_1']=='04' ? "selected='selected'":""; ?>>Apr</option>
                  <option value="05" <?= $dati['VAR_m_1']=='05' ? "selected='selected'":"" ?>>Mag</option>
                  <option value="06" <?= $dati['VAR_m_1']=='06' ? "selected='selected'":"" ?>>Giu</option>
                  <option value="07" <?= $dati['VAR_m_1']=='07' ? "selected='selected'":"" ?>>Lug</option>
                  <option value="08" <?= $dati['VAR_m_1']=='08' ? "selected='selected'":"" ?>>Ago</option>
                  <option value="09" <?= $dati['VAR_m_1']=='09' ? "selected='selected'":"" ?>>Set</option>
                  <option value="10" <?= $dati['VAR_m_1']=='10' ? "selected='selected'":"" ?>>Ott</option>
                  <option value="11" <?= $dati['VAR_m_1']=='11' ? "selected='selected'":"" ?>>Nov</option>
                  <option value="12" <?= $dati['VAR_m_1']=='12' ? "selected='selected'":"" ?>>Dic</option>
                </select>
                <select name="VAR_a_1" >
                  <option value="0">--</option>
                  <? for($x=1905; $x<=2011; $x++){
                      if($x==$dati['VAR_a_1'])
                        $selected[$x] = "selected='selected'";
                      echo "<option value='".$x."' ".$selected[$x]." >".$x."</option>"; 
                  }?>
                
                </select></td>
            </tr>
            
            <!-- ULTIMA MODIFICA -->
            
            <tr>
              <td class='desc' colspan='4'>Il genitore 2 (obbligatorio in caso di ritiro del minore se diverso da chi esercita la potest&agrave; familiare)</td>
            </tr>
            <tr>
              <td  class='left'>Cognome&nbsp; </td>
              <td  class='right' ><input type="text" name="VAR_campo_11" value="<?=$dati['VAR_campo_11']?>" size="23"></td>
              <td  class='left'>Nome&nbsp; </td> 
              <td  class='right' ><input type="text" name="VAR_campo_12" value="<?=$dati['VAR_campo_12']?>" size="23"></td>  
            </tr>
            <tr>
              <td class='left'>Documento&nbsp;</td>
              <td class='right' >
                <input type="radio" name="VAR_select_2" value="3275" size="5" checked='checked' <?= $dati['VAR_select_2']=='3275' ?  "checked='checked'":""   ?> >Passaporto
                <input type="radio" name="VAR_select_2" value="3277" size="5" <?= $dati['VAR_select_2']=='3277' ? "checked='checked'":""    ?>>Patente
                <input type="radio" name="VAR_select_2" value="3276" size="5" <?= $dati['VAR_select_2']=='3276' ? "checked='checked'":""    ?>>C.i
              </td>
              <td class='left'>Numero&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_campo_13" value="<?=$dati['VAR_campo_13']?>" size="23"></td>
            </tr>
            <tr>
              <td  class='left'>Cellulare&nbsp;</td>
              <td colspan='3' class='right' ><input type="text" name="VAR_campo_14" value="<?=$dati['VAR_campo_14']?>" size="23"></td>
            </tr>
            <!-- ULTIMA MODIFICA -->
                     
            
            <tr>
              <td class='desc' colspan='4'> CHIEDE E AUTORIZZA PER IL/LA FIGLIO/A (*** </td>
            </tr>
            <tr>
              <td class='left'>Cognome&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_campo_4" value="<?=$dati['VAR_campo_4']?>" size="23"></td>
              <td class='left'>Nome&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_campo_5" value="<?=$dati['VAR_campo_5']?>" size="23"></td>
            </tr>
            <tr>
              <td class='left'>Nato a </td>
              <td class='right' ><input type="text" name="VAR_campo_6" value="<?=$dati['VAR_campo_6']?>" size="23"></td>
              <td class='left'>Il&nbsp;</td>
              <td class='right' ><select name="VAR_g_2" >
                <option value="0" >--</option>
                <? for($x=1; $x<=31; $x++){
                      
                      if($x<10)
                        $k="0".$x;
                      else
                        $k =$x;
                      if($k==$dati['VAR_g_2'])
                        $selected[$x] = "selected='selected'";
                      
                      echo "<option value='".$k."' ".$selected[$x]." >".$x."</option>"; 
                  } 
                  ?>
              </select>
                <select name="VAR_m_2" >
                  <option value="0" >--</option>
                  <option value="01" <?= $dati['VAR_m_2']=='01' ? "selected='selected'":"" ?> >Gen</option>
                  <option value="02" <?= $dati['VAR_m_2']=='02' ? "selected='selected'":"" ?>>Feb</option>
                  <option value="03" <?= $dati['VAR_m_2']=='03' ? "selected='selected'":"" ?>>Mar</option>
                  <option value="04" <?= $dati['VAR_m_2']=='04' ? "selected='selected'":"" ?>>Apr</option>
                  <option value="05" <?= $dati['VAR_m_2']=='05' ? "selected='selected'":"" ?>>Mag</option>
                  <option value="06" <?= $dati['VAR_m_2']=='06' ? "selected='selected'":"" ?>>Giu</option>
                  <option value="07" <?= $dati['VAR_m_2']=='07' ? "selected='selected'":"" ?>>Lug</option>
                  <option value="08" <?= $dati['VAR_m_2']=='08' ? "selected='selected'":"" ?>>Ago</option>
                  <option value="09" <?= $dati['VAR_m_2']=='09' ? "selected='selected'":"" ?>>Set</option>
                  <option value="10" <?= $dati['VAR_m_2']=='10' ? "selected='selected'":"" ?>>Ott</option>
                  <option value="11" <?= $dati['VAR_m_2']=='11' ? "selected='selected'":"" ?>>Nov</option>
                  <option value="12" <?= $dati['VAR_m_2']=='12' ? "selected='selected'":"" ?>>Dic</option>
                </select>
                <select name="VAR_a_2" >
                  <option value="0">--</option>
                  <? for($x=2000; $x<=2005; $x++){
                      if($x==$dati['VAR_a_2'])
                        $selected[$x] = "selected='selected'";
                      echo "<option value='".$x."' ".$selected[$x]." >".$x."</option>"; 
                  }?>
                  
                  
                  
                </select> *** </td>
            </tr>
            <tr>
              <td class='rleft' colspan='4'>
                <font class='desc-small-black' style='align:left'>
                  ** per l’anno 2005 unicamente i bambini e le bambine nati entro il 30 APRILE e iscritti alla scuola primaria
                </font>
              <td>
            </tr>  
            <tr>
              <td class='left'>Tessera sanitaria&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_campo_7" value="<?=$dati['VAR_campo_7']?>" size="23"></td>
              <td class='left'>Codice Fiscale&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_campo_8" value="<?=$dati['VAR_campo_8']?>" size="23"></td>
            </tr>
            <tr>
              <td class='left'>Scuola primaria di via&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_campo_9" value="<?=$dati['VAR_campo_9']?>" size="23"></td>
              <td class='left'>Classe&nbsp;</td>
              <td class='right' ><input type="text" name="VAR_campo_10" value="<?=$dati['VAR_campo_10']?>" size="10">
                &nbsp;Sezione&nbsp;
                <input type="text" name="VAR_numero_2" value="<?=$dati['VAR_numero_2']?>" size="2"></td>
            </tr>
            <tr>
              <td class='left'>Utente Milano Ristorazione&nbsp;</td>
              <td class='right' ><select name="VAR_select_4"  >
                <option value="3220" <?= $dati['VAR_select_4']=='3220'  ?"selected='selected'":""    ?>>No</option>
                <option value="3219" <?= $dati['VAR_select_4']=='3219' ? "selected='selected'":""    ?>>Si</option>
              </select></td>
              <td class='left'>Dieta Sanitaria&nbsp;</td>
              <td class='right' ><select name="VAR_select_5"  >
                <option value="3222" <?= $dati['VAR_select_5']=='3222' ? "selected='selected'":""    ?>>No</option>
                <option value="3221" <?= $dati['VAR_select_5']=='3221'  ?"selected='selected'":""    ?>>Si</option>
              </select>
                Dieta Etico Religiosa&nbsp;
                <select name="VAR_select_6"  >
                  <option value="3224" <?= $dati['VAR_select_6']=='3224'  ?"selected='selected'":""    ?>>No</option>
                  <option value="3223" <?= $dati['VAR_select_6']=='3223' ? "selected='selected'":""    ?>>Si</option>
                </select>
                </td>
            </tr>
            
            <tr>
            <td class='left' colspan='2'>&nbsp;</td>
            <td class='left' colspan='2' >
              <font class='desc-small-black'> In caso di dieta compilare la scheda <a class='linkTesto' href='./allegati_pdf/richieste-diete.pdf' target='_blank' > "richiesta dieta"</a>
            </td>   
          
            
            <tr>
              <td class='desc' colspan='4'>L'ISCRIZIONE ALL'INIZIATIVA "IN VACANZA DALLO SMOG" </td>
            </tr>
            <tr>
              <td class='left desc-small'>Presso la casa vacanza&nbsp;</td>
              <td class='right '><select name="VAR_casa_vacanza" onChange='javascript: setIdLista();' id="VAR_casa_vacanza" >
                <option value=0 > -- -- -- -- </option>
                <option value="1" <?= $dati['VAR_casa_vacanza']=='1' ? "selected='selected'":""?>>GHIFFA</option>
                <option value="2" <?= $dati['VAR_casa_vacanza']=='2' ? "selected='selected'":""?>>MALCESINE</option>
                <option value="3" <?= $dati['VAR_casa_vacanza']=='3' ? "selected='selected'":""?>>PIETRA LIGURE</option>
                <option value="4" <?= $dati['VAR_casa_vacanza']=='4' ? "selected='selected'":""?>>VACCIAGO</option>
                <option value="5" <?= $dati['VAR_casa_vacanza']=='5' ? "selected='selected'":""?>>ZAMBLA ALTA</option>
              </select></td>
              <td class='left desc-small' >Nel fine settimana&nbsp;</td>
              <td class='right ' ><select name="VAR_data_vacanza" onChange='javascript: setIdLista();' id="VAR_data_vacanza" >
                <option value=0 > -- -- -- -- </option>
                <option value="1" selected='selected' <?= $dati['VAR_data_vacanza']=='1' ? "selected='selected'":""?>>21/22 Aprile 2011</option> 
                <!-- <option value="1" <?= $dati['VAR_data_vacanza']=='1' ? "selected='selected'":""?>>19/20 Marzo 2011</option> 
                <option value="2" <?= $dati['VAR_data_vacanza']=='2' ? "selected='selected'":""?>>26/27 Marzo 2011</option>
                <option value="3" <?= $dati['VAR_data_vacanza']=='3' ? "selected='selected'":""?>>2/3 Aprile 2011</option> 
                <option value="4" <?= $dati['VAR_data_vacanza']=='4' ? "selected='selected'":""?>>9/10 Aprile 2011</option> 
                <option value="5" <?= $dati['VAR_data_vacanza']=='5' ? "selected='selected'":""?>>16/17 Aprile 2011</option> 
                <option value="6" <?= $dati['VAR_data_vacanza']=='6' ? "selected='selected'":""?>>30 Aprile 1 Maggio2011</option> -->
              </select></td>
            </tr>
            <tr>
              <td class='desc-black' colspan='4' style='padding-left:100px;padding-top: 15px; padding-bottom: 15px;font-size:13px'> Impegnandosi a versare al Comune di Milano il contributo per la   partecipazione di &euro; 21,00 a seguito di accettazione della richiesta.<br> 
              Il pagamento del contributo di partecipzione deve essere effettuato tramite versamento sul conto corrente postale n. 14922207 intestato a Comune di Milano - Settore Servizi Minori e Giovani - Servizio Tesoreria. Nella causale vanno indicati: cognome e nome dell'iscritto, Progetto "in vacanza dallo smog" - localit&agrave; - turno<br><br>
              L'Amministrazione si riserva di variare le sedi di soggiorno per ragioni tecnico-organizzative.
               
              
              </td>
            </tr>
            <tr>
              <td class='left' style="vertical-align:top">Legge Privacy&nbsp;</td>
              <td class='right' colspan='3'><textarea name="textarea" cols="120" rows="6" style="text-align:left">Informativa ai sensi dell'art .13 D.lgs 196/2003 all'interessato per il trattamento dei dati personali

Gentile Destinatario,
il Comune di Milano, in qualit&agrave; di Titolare del trattamento dei dati personali ai sensi dell'art .13 del D.lgs n.196 del 30.06.03 (Codice in materia di protezione dei dati personali), La informa di quanto segue.
I dati personali, nell'ambito del Servizio Estate Vacanza del Comune di Milano, sono trattati esclusivamente per le finalit&agrave; strumentali e connesse all'erogazione del Servizio, con particolare riguardo, nel caso di specie, alla garanzia di fornitura di diete speciali, volte ad assicurare la compatibilit&agrave;    degli alimenti somministrati con lo stato dei singoli ospiti.
I dati sono trattati con modalit&agrave; cartacee e con strumenti elettronici solo per le finalit&agrave; descritte.
Il loro conferimento &egrave; obbligatorio ed il rifiuto a fornirli comporta l'impedimento di dar corso all'iscrizione, nonch&eacute; a tutti gli altri adempimenti conseguenti. 
I dati sono conservati garantendone la sicurezza e la riservatezza con adeguate misure di protezione, secondo quanto disposto dagli Artt. da 31 a 36 del D.Lgs. 196/03, al fine di ridurre i rischi di distruzione o perdita, anche accidentale, dei dati, di accesso non autorizzato o di trattamento non consentito o non conforme alle finalit&agrave; della raccolta.
I dati personali, anche sensibili, possono essere comunicati ad altri soggetti pubblici e privati e possono essere diffusi, con esclusione dei dati idonei a rivelare lo stato di salute, quando tali trattamenti siano previsti da disposizioni di legge o di regolamento. I dati di carattere sanitario sono trattati limitatamente alle operazioni indispensabili per la tutela dell'incolumit&agrave; fisica del minore.  
I Responsabili del trattamento dei dati sono: 
1.il Direttore del Settore Servizi per Minori e Giovani dott. Patrizio Mercadante (per il servizio reso direttamente dal Comune di Milano)
2.Milano Ristorazione S.p.A nella persona del suo legale rappresentante dr. Marco Predolin, con sede a Milano in via Quaranta n. 41 (per gli adempimenti connessi all'approvvigionamento delle materie prime oggetto dell'attivit&agrave; specifica, produzione dei pasti e adempimenti obbligatori previsti dalla legge connessi alla gestione di tutto il servizio oggetto dell'attivit&agrave; dell'azienda)
3.D.O.C. S.C.S.  (societ&agrave; affidataria di servizi) nella persona del suo  legale rappresentante dr.ssa Maria Teresa Rossi, con sede a Torino in via Assetta n. 16/b ( per gli adempimenti connessi alla richiesta, al controllo, alla somministrazione dei pasti e adempimenti obbligatori previsti dalla legge connessi alla gestione di tutto il servizio oggetto dell'attivit&agrave; dell'azienda)
Gli incaricati del trattamento sono i dipendenti del Comune di Milano, addetti al Settore Servizi per Minori e Giovani (per la comunicazione ai destinatari finali ai fini della realizzazione del servizio) e i dipendenti / collaboratori dei soggetti di cui ai precedenti punti 2 e 3.
In ogni momento, quale interessato, Lei pu&ograve; esercitare i Suoi diritti nei confronti del titolare del trattamento, ai sensi dell'Art. 7 del D.lgs n.196 del 30.06.03, che per Sua comodit&agrave; di seguito riproduciamo integralmente.
Art. 7. Diritto di accesso ai dati personali ed altri diritti
1. L'interessato ha diritto di ottenere la conferma dell'esistenza o meno di dati personali che lo riguardano, anche se non ancora registrati, e la loro comunicazione in forma intelligibile.
2. L'interessato ha diritto di ottenere l'indicazione:
a) dell'origine dei dati personali;
b) delle finalit&agrave; e modalit&agrave; del trattamento;
c) della logica applicata in caso di trattamento effettuato con l'ausilio di strumenti elettronici;
d) degli estremi identificativi del titolare, dei responsabili e del rappresentante designato ai sensi dell'articolo 5, comma 2;
e) dei soggetti o delle categorie di soggetti ai quali i dati personali possono essere comunicati o che possono venirne a conoscenza in qualit&agrave; di rappresentante designato nel territorio dello Stato, di responsabili o incaricati.
3. L'interessato ha diritto di ottenere:
a) l'aggiornamento, la rettificazione ovvero, quando vi ha interesse, l'integrazione dei dati;
b) la cancellazione, la trasformazione in forma anonima o il blocco dei dati trattati in violazione di legge, compresi quelli di cui non &egrave; necessaria la conservazione in relazione agli scopi per i quali i dati sono stati raccolti o successivamente trattati;
c) l'attestazione che le operazioni di cui alle lettere a) e b) sono state portate a conoscenza, anche per quanto riguarda il loro contenuto, di coloro ai quali i dati sono stati comunicati o diffusi, eccettuato il caso in cui tale adempimento si rivela impossibile o comporta un impiego di mezzi manifestamente sproporzionato rispetto al diritto tutelato.
4. L'interessato ha diritto di opporsi, in tutto o in parte:
a) per motivi legittimi al trattamento dei dati personali che lo riguardano, ancorch&egrave; pertinenti allo scopo della raccolta;
b) al trattamento di dati personali che lo riguardano a fini di invio di materiale pubblicitario o di vendita diretta o per il compimento di ricerche di mercato o di comunicazione commerciale.
            </textarea></td>
            </tr>
            <tr>
              <td class='left'><input type ='checkbox' name ='VAR_select_7' value='3225' checked='checked' id='consenso' ></td>
              <td class='right' colspan='3' ><b>ACCONSENTO</b> al trattamento dei dati&nbsp;</td>
            </tr>
            <tr>
              <td class='left'><input type ='radio' checked='checked' name ='VAR_select_9' value='3230' <?= $dati['VAR_select_9']=='1' ? "checked='checked'":""?>></td>
              <td class='right' colspan='3' ><b>ACCONSENTO</b> a che siano effettuate fotografia e riprese video - di pertinenza esclusiva dell'organizzazione - per documentare le attivit&agrave; didattihce dell'iniziativa, anche in spazi promozionali. </td>
            </tr>
            <tr>
              <td class='left'><input type ='radio' name ='VAR_select_9' value='3231'  <?= $dati['VAR_select_9']=='1' ? "checked='checked'":""?> ></td>
              <td class='right' colspan='3' ><b>NON ACCONSENTO</b> a che siano effettuate fotografia e riprese video - di pertinenza esclusiva dell'organizzazione - per documentare le attivit&agrave; didattihce dell'iniziativa, anche in spazi promozionali. </td>
            </tr>
            <tr>
              <td ></td>
              <td class='right' colspan='3' style='padding-top:20px'><input type="hidden" name="action" value="adduser">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="hidden" name="id_user" value="25633">
                <input type="hidden" name="id_lista" value="<?=$dati['id_lista']?>" id='id_lista'>
                <input type="reset" value="Annulla" class='pulsante resetta'>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input class='pulsante invia' type="submit" value="Invia"></td>
            </tr>
          </table>
        </form>
        <?}?>
      </div>
    </div>
    <?}?>
  </div>
  <div id='footer'>In vacanza dallo smog &egrave; un iniziativa del <a href="http://www.comune.milano.it/portale/wps/portal/CDMHome" class='footerLink'>COMUNE DI MILANO</a></div>
</body>
</html>