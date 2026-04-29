<?

$mess = $_REQUEST['message'];
$mess = str_replace('Errore:', "<font class='desc-black'>Errore:</font>",$mess);



?>



<html>
<head>
<title>IN VACANZA DALLO SMOG</title>
</head>

<STYLE type="text/css">

  body, select, textarea{
	  color: #000000;
	  font-family: "Comic Sans MS", cursive;
	  font-size:12px;
	  background: #76c9e2;
    text-align: center;
  }
  select , input, textarea{
	   font-size:11px;
	   border: 1px dotted #3d6bad;
     background: #FFFFFF;
  }
  
  .left{
    text-align:right;
    font-size: 12px;
  }
  .right{
	  font-size: 12px;
	  text-align:left;
  }
  .clear{clear:both}
  .desc{
	  text-align:left;
	  color: #3d6bad;
 		font-size: 14px;
		font-style:oblique;
    font-weight: bold;  
   
  }
  .desc-small{
	  color: #3d6bad;
 		font-size: 12px;
		font-style:oblique;
    font-weight: bold;  
  }
  .desc-black{
	  margin-top:20px;
	 margin-bottom: 20px;
	  color: #00000;
 		font-size: 14px;
		font-style:oblique;
    font-weight: bold; 
	text-align: left; 
  }
  #pagina{
	  
	  text-align: center;
	  background-image: url(./immagini/sfondo.png);
	  background-position:bottom;
	  background-repeat: no-repeat;
	  padding-left: 50px;
	  padding-right:20px;
	  
   }
   
   
   
   
   
   
#sito{
  margin: 50 auto 0 auto;
  width: 900px;
	border: 2px solid #3d6bad;
	background: #FFFFFF;
  
}
  
  #top{
    background-image: url(./immagini/logo.png);
	  background-repeat: no-repeat;
	}
	#fiore{
		margin-top:25px;
		height:137px;
    background-image: url(./immagini/fiore.png);
	background-position:bottom right;
	  background-repeat: no-repeat;
	}
	
	
  #tabella{ padding-bottom: 400px; padding-top:50px }
  .pulsante{
    width:120px;
	  height:74px;
    color: #3d6bad;
    font-size: 15px;
    font-weight: bold;  
    vertical-align: center;
    padding-top: 30px;
    border: 0px;
  }
  .pulsante:hover{  color: #ffffff;}
  
  
  .invia{
	  	background-image:url(./immagini/uccello-i.png);
      background-repeat:no-repeat;
      cursor: pointer;
	cursor: hand;
  }
  .resetta{
	  	background-image:url(./immagini/uccello-a.png);
	 background-repeat:no-repeat;
    cursor: pointer;
	cursor: hand;
  }
  
  .invia:hover{
	  	background-image:url(./immagini/uccello-i-h.png);
	 background-repeat:no-repeat;
  }
  .resetta:hover{
	  	background-image:url(./immagini/uccello-a-h.png);
	 background-repeat:no-repeat;
  }
  
  
  #top{
    
    margin-top: 30px;
    margin-bottom:30px;
    height: 59px;
    width: 500px
    background-image:url(./immagini/logo.png);
	 background-repeat:no-repeat;
   
  }
  
  #footer{
	  
	  text-align:right;
	  font-size:14px;
	  
	  color: #3d6bad;
	  font-weight:bold;
	  margin: 15 auto 0 auto;
  width: 900px;
	  
  }
  .footerLink{
  	text-decoration: none;
	color:#fdf4a5;
	
  }
  .footerLink:hover{
  	color:#924633;
  }
</STYLE>
<body>
  <div id='sito'>
  <div id='pagina'>
    <div id='fiore'>
    	<div id='top'>   </div>
    </div>
    <div id='tabella'>
      <div class='desc'>
        <?
        if($mess){
          echo $mess;
        }
        else{?>  
        <p>GRAZIE PER AVER COMPILATO LA SCHEDA DI ISCRIZIONE DEL SERVIZIO IN VACANZA DALLO SMOG.<br><br>
          SARA' RICONTATTATO AL PIU' PRESTO PER RICEVERE CONFERMA DELL'AVVENUTA ISCRIZIONE E RICEVERA' UN SMS CON IL LUOGO E  L'ORARIO DI PARTENZA.</p>
        <p>          LE RICORDIAMO CHE PER POTER PARTIRE OCCORRE PORTARE ALLA PARTENZA:<br>
  <font class='desc'>1)</font> LA SCHEDA SANITARIA COMPILATA E FIRMATA<br>
  <font class='desc'>2)</font>  LA RICEVURA DEL VERSAMENTO DI € 21,00</p>
        <p>          INOLTRE PER INFORMAZIONI ED EVENTUALI DISDETTE E/O VARIAZIONI RIVOLGERSI ALLA SEGRETERIA ORGANIZZATIVA AL NUMERO <span class='desc-black'>3491664329</span></p>
        <?}?>
      </div>
      </div>
  </div>
  </div>
  <div id='footer'>In vacanza dallo smog è un iniziativa del <a href="http://www.comune.milano.it/portale/wps/portal/CDMHome" class='footerLink'>COMUNE DI MILANO</a></div>
</body>
</html>