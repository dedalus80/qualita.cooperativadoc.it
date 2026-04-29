<?php

$content = "
<style type='text/css'>
<!--
    
    table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
    table.page_footer {width: 100%;}
   .page-old table{width: 100%;
   }
    .or_bold{color:#313e3e}
    .class_td{
        padding-top:5px;
        paddin-bottom: 5px;
    }
    .class_td_big{
    padding-top:5px;
        paddin-bottom: 5px;
    }
    .page-old{
    border: 1px solid
    }
.title{
    color:#313e3e;
    font-size: 23px;
    font-weight: bold;
    line-height: 30px;
    }  
.sub-title{
    color:#313e3e;
    font-size:18px;
    line-height: 30px;
    font-weight: bold;
    }  
  .small-title{
  color:#313e3e;
  line-height: 20px;
    font-size: 16px;
    font-weight: bold;
}  

td{
    vertical-align: top;
    text-align: left;
}

.tdpadding{
    padding: 7px 0px;
}

.label{
    margin-right: 5px;
    font-weight: bold
}

.line-break{
    padding-bottom: 10px;
}

.bold-text{
font-weight: bold;
}

.bordered{
  
}


-->
</style>";


$marginTop = 370;


// PAGE FOOTER ***************************************************************** 
$content .='
<page pageset="old"  class="page-old" backtop="7mm" backbottom="7mm" backleft="10mm" backright="0mm" > 
    <page_header></page_header>
    <page_footer>
        <div style="text-align:center"> 
          <span class="or_bold">D.O.C. scs s.r.l.</span> Via Assietta 16/b 10128 Torino <span class="or_bold">t.</span> +39.011.516.20.38 <span class="or_bold">f.</span> +39.011.517.54.86 <span class="or_bold">e.</span> info@cooperativadoc.it 
         </div>
    </page_footer>';

$content .="<table style='width:100%'>
    <tr><td style='text-align:right; width: 100%' width='100%' align='right' ><img src='./img/" . $logo . "' style='width:250px'; /> </td></tr>
    </table>";

$content .="<table style='margin-top: 30px' >";
$content .="<tr><td style='text-align:center; width:100%;' ><span class='small-title'>Richiesta di Iscrizione all'Iniziativa</span><br> <span class='title'>" . $iniziativa . "</span><br><span class='sub-title'>" . $dati['turno_iniziativa'] . "</span></td></tr>";
$content .="</table >";

$content .="<table style='margin-top: 50px' >";
$content .="<tr><td style='font-size:16px; background:#313e3e;  padding:7px 0px 7px 10px;text-align: left; color:#FFF' colspan='2' >Dati Dipendente</td></tr>";
$content .="<tr style='line-height: 100px'>";
$content .="<td style='width: 50%' class='tdpadding' ><span class='label'>Nome:&nbsp;&nbsp;</span>" . $dati['nome'] . " </td><td style='width: 50%' class='tdpadding' ><span class='label'>Cognome:&nbsp;&nbsp;</span>" . $dati['cognome'] . " </td>";
$content .= "</tr>";

$content .="<tr>";
$content .="<td style='width: 50%' class='tdpadding'><span class='label'>Codice Fiscale:&nbsp;&nbsp;</span>" . $dati['codice_fiscale'] . " </td><td class='tdpadding' ><span class='label'>Societ&agrave;:&nbsp;&nbsp;</span>" . $dati['societa'] . " </td>";
$content .= "</tr>";
$content .="<tr>";
$content .="<td  class='tdpadding' ><span class='label'>Indirizzo:&nbsp;&nbsp;</span>" . $dati['indirizzo'] . " N&deg;" . $dati['civico'] . " " . $dati['cap'] . " " . $dati['citta'] . "</td><td colspan='2' class='tdpadding' ><span class='label'>Provincia:&nbsp;&nbsp;</span>" . $dati['province'] . "</td>";
$content .= "</tr>";
$content .="<tr>";
$content .="<td style='width: 50%' class='tdpadding'><span class='label'>Telefono casa:&nbsp;&nbsp;</span>" . $dati['telefono_casa'] . " </td><td class='tdpadding'><span class='label'>Telefono ufficio:&nbsp;&nbsp;</span>" . $dati['telefono_ufficio'] . " </td>";
$content .= "</tr>";
$content .="<tr>";
$content .="<td style='width: 50%; ' class='tdpadding' ><span class='label'>Cellulare:&nbsp;&nbsp;</span>" . $dati['cellulare'] . " </td><td class='tdpadding' ><span class='label'>Indirizzo Email:&nbsp;&nbsp;</span>" . $dati['email'] . " </td>";
$content .= "</tr>";
$content .="<tr>";
$content .="<td colspna='2' class='line-break' >&nbsp;</td>";
$content .= "</tr>";

if ($tipo == 'UVI') {

    $content .="<tr style='margin-top: 50px;'><td style='font-size:16px; background:#313e3e;margin-top: 50px;  padding:7px 0px 7px 10px; text-align: left; color:#FFF' colspan='2' >Dati Disabile </td></tr>";
    $content .="<tr>";
    $content .="<td style='width: 50%' class='tdpadding'><span class='label'>Nome:&nbsp;&nbsp;</span>" . $dati['disabile_nome'] . " </td><td class='tdpadding'><span class='label'>Cognome:&nbsp;&nbsp;</span>" . $dati['disabile_cognome'] . " </td>";
    $content .= "</tr>";
    $content .="<tr>";
    $content .="<td style='width: 50%' class='tdpadding'><span class='label'>Data Nascita:&nbsp;&nbsp;</span>" . $dati['nd'] . " </td><td class='tdpadding' ><span class='label'>Citt&agrave;:&nbsp;&nbsp;</span>" . $dati['disabile_citta'] . " </td>";
    $content .= "</tr>";

    $dati['disabile_parentela_dettaglio'] == 'A' ? $parente = $dati['disabile_parentela_altro'] : $parente = $parentele[$dati['disabile_parentela_dettaglio']];

    if ($dati['disabile_parentela'] == 'Y') {

        $marginTop = $marginTop - 30;

        $content .="<tr>";
        $content .="<td  colspan='2' style='width: 100%' class='tdpadding'><span class='label'>Dichiaro che il disabile &egrave; nel rapporto di parentela con il sottoscritto:</span>" . $parente . " </td>";
        $content .= "</tr>";
    }

    $content .="<tr>";
    $content .="<td colspna='2' class='line-break' >&nbsp;</td>";
    $content .= "</tr>";


    if ($dati["accompagnatori"] > 0) {

        $marginTop = $marginTop - 40;
        $content .="<tr><td style='font-size:16px; background:#313e3e;  padding:7px 0px 7px 10px; text-align: left; color:#FFF' colspan='2' >Altri Accompagnatori " . $dati["accompagnatori"] . " </td></tr>";

        if ($dati["accompagnatori"] >= 1) {
            $content .="<tr>";
            $content .="<td style='width: 50%' class='tdpadding'><span class='label'>Primo accompagnatore:&nbsp;&nbsp;</span>" . $dati['accompagnatore_1_nome'] . " </td><td class='tdpadding' ><span class='label'>Nato il:&nbsp;&nbsp;</span>" . $dati['na1'] . " </td>";
            $content .= "</tr>";
            $content .="<tr>";
            $content .="<td style='width: 50%' class='tdpadding'><span class='label'>Rapporto di parentela:&nbsp;&nbsp;</span>" . $parentele[$dati['accompagnatore_1_parentela']] . " </td><td class='tdpadding' ></td>";
            $content .= "</tr>";

            $marginTop = $marginTop - 60;
        }
        if ($dati["accompagnatori"] >= 2) {
            $content .="<tr>";
            $content .="<td style='width: 50%' class='tdpadding' ><span class='label'>Secondo accompagnatore:&nbsp;&nbsp;</span>" . $dati['accompagnatore_2_nome'] . " </td><td class='tdpadding'><span class='label'>Nato il:&nbsp;&nbsp;</span>" . $dati['na2'] . " </td>";
            $content .= "</tr>";
            $marginTop = $marginTop - 30;
        }
        if ($dati["accompagnatori"] >= 3) {
            $content .="<tr>";
            $content .="<td style='width: 50%' class='tdpadding' ><span class='label'>Terzo accompagnatore:&nbsp;&nbsp;</span>" . $dati['accompagnatore_3_nome'] . " </td><td class='tdpadding' ><span class='label'>Nato il:&nbsp;&nbsp;</span>" . $dati['na3'] . " </td>";
            $content .= "</tr>";
            $marginTop = $marginTop - 30;
        }
    }
}




if ($tipo == 'UVO') {
    $content .="<tr><td style='font-size:16px; background:#313e3e;  padding:7px 0px 7px 10px; text-align: left; color:#FFF' colspan='2' >Altri partecipanti " . $dati["numero_partecipanti"] . " </td></tr>";
    /*
      if ($dati['rapporto_parentela'] == 'Y') {
      $content .="<tr>";
      $content .="<td  colspan='2' style='width: 100%' class='tdpadding'><span class='label-td'>Dichiaro che il/i partecipante/i sono genitori del richiedente/coniuge/convivente:</span></td>";
      $content .= "</tr>";
      $marginTop = $marginTop - 30;
      }
     */
    if ($dati['autosufficienza'] == 'Y') {
        $content .="<tr>";
        $content .="<td  colspan='2' style='width: 100%' class='tdpadding' ><span class='label-td'>Dichiaro che i partecipanti sono autosufficienti e che quindi non necessitano di supporto per l'espletamento delle necessit&agrave; quotidiane e per la partecipazione alle attivit&agrave;</span>" . $parente . "</td>";
        $content .= "</tr>";
        $marginTop = $marginTop - 30;
    }

    $content .="<tr>";
    $content .="<td style='width: 50%' class='tdpadding'><span class='label'>Citt&agrave;:&nbsp;&nbsp;</span>" . $dati['citta_partecipante'] . "</td><td class='tdpadding' ><span class='label'>Provincia:</span>" . $db->SingleField("nome", "_provincia", " WHERE id ='" . $dati['provincia_partecipante'] . "' ") . " </td>";
    $content .= "</tr>";

    if ($dati["numero_partecipanti"] >= 1) {
        $content .="<tr>";
        $content .="<td style='width: 50%' class='tdpadding'><span class='label'>Primo genitore nome:&nbsp;&nbsp;</span>" . $dati['nome_genitore_1'] . " </td><td class='tdpadding'><span class='label'>Cognome:&nbsp;&nbsp;</span>" . $dati['cognome_genitore_1'] . " </td>";
        $content .= "</tr>";
        $content .="<tr>";
        $content .="<td style='width: 50%' class='tdpadding'><span class='label'>Nato il :&nbsp;&nbsp;</span>" . $dati['ng1'] . " </td><td class='tdpadding'><span class='label'>Parentela:&nbsp;&nbsp;</span>" . $parenteleGenitori[$dati['parentela_genitore_1']] . " </td>";
        $content .= "</tr>";

        $marginTop = $marginTop - 30;
    }

    if ($dati["numero_partecipanti"] >= 2) {
        $content .="<tr>";
        $content .="<td style='width: 50%' class='tdpadding'><span class='label'>Secondo genitore nome:&nbsp;&nbsp;</span>" . $dati['nome_genitore_2'] . " </td><td class='tdpadding'><span class='label'>Cognome:&nbsp;&nbsp;</span>" . $dati['cognome_genitore_2'] . " </td>";
        $content .= "</tr>";
        $content .="<tr>";
        $content .="<td style='width: 50%' class='tdpadding'><span class='label'>Nato il :&nbsp;&nbsp;</span>" . $dati['ng2'] . " </td><td class='tdpadding'><span class='label'>Parentela:&nbsp;&nbsp;</span>" . $parenteleGenitori[$dati['parentela_genitore_2']] . " </td>";
        $content .= "</tr>";
        $marginTop = $marginTop - 60;
    }

    $content .="<tr>";
    $content .="<td colspna='2' class='line-break' >&nbsp;</td>";
    $content .= "</tr>";



    if ($dati["altri_partecipanti"] > 0) {
        $content .="<tr><td style='font-size:16px; background:#313e3e; padding:7px 0px 7px 10px; text-align: left; color:#FFF' colspan='2' >Genitori partecipanti " . $dati["altri_partecipanti"] . " </td></tr>";

        $marginTop = $marginTop - 40;
        if ($dati["numero_partecipanti"] >= 1) {
            $content .= "<tr>";
            $content .="<td style='width: 50%' class='tdpadding' ><span class='label'>Primo partecipante:&nbsp;&nbsp;</span>" . $dati['nome_partecipante_1'] . " " . $dati['cognome_partecipante_1'] . "</td><td class='tdpadding' ><span class='label'>Nato il:&nbsp;&nbsp;</span>" . $dati['np1'] . " </td>";
            $content .= "</tr>";
            $content .= "<tr>";
            $content .="<td style='width: 50%' class='tdpadding' ><span class='label'>Rapporto parentela:&nbsp;&nbsp;</span>" . $dati['parentela_partecipante_1'] . " </td><td class='tdpadding' ></td>";
            $content .= "</tr>";

            $marginTop = $marginTop - 60;
        }
        if ($dati["altri_partecipanti"] >= 2) {
            $content .= "<tr>";
            $content .="<td style='width: 50%' class='tdpadding'><span class='label'>Secondo partecipante:&nbsp;&nbsp;</span>" . $dati['nome_partecipante_2'] . " " . $dati['cognome_partecipante_2'] . "</td><td class='tdpadding' ><span class='label'>Nato il:&nbsp;&nbsp;</span>" . $dati['np2'] . " </td>";
            $content .= "</tr>";
            $content .= "<tr>";
            $content .="<td style='width: 50%' class='tdpadding' ><span class='label'>Rapporto parentela:&nbsp;&nbsp;</span>" . $dati['parentela_partecipante_2'] . " </td><td class='tdpadding' ></td>";
            $content .= "</tr>";

            $marginTop = $marginTop - 60;
        }

        if ($dati["altri_partecipanti"] >= 3) {
            $content .= "<tr>";
            $content .="<td style='width: 50%' class='tdpadding'><span class='label'>Terzo partecipante:&nbsp;&nbsp;</span>" . $dati['nome_partecipante_3'] . " " . $dati['cognome_partecipante_3'] . "</td><td class='tdpadding' ><span class='label'>Nato il:&nbsp;&nbsp;</span>" . $dati['np3'] . " </td>";
            $content .= "</tr>";
            $content .= "<tr>";
            $content .="<td style='width: 50%' class='tdpadding' ><span class='label'>Rapporto parentela:&nbsp;&nbsp;</span>" . $dati['parentela_partecipante_3'] . " </td><td class='tdpadding' ></td>";
            $content .= "</tr>";

            $marginTop = $marginTop - 60;
        }
    }
}

if ($dati["note"]) {
    $content .= "<tr>";
    $content .="<td style='width: 100%; padding-top: 40px' class='tdpadding' colspan='2' ><b>Note:</b>" . $dati['note'] . "</td>";
    $content .= "</tr>";
    $marginTop = $marginTop - 60;
}


$content .="</table>";
$content .="<div style='margin-top: " . $marginTop . "px; width: 100% ; ' class='bordered' >";  
$content .="<table style=' width: 100%' width='100%'  class='bordered' >";
$content .="<tr>";
$content .="<td colspan='3' style='width: 100% ; ' class='tdpadding bordered' width='100%' ><span style='line-height: 100px'>Per ogni altra eventuale informazione la preghiamo di contattarci presso i nostri uffici ai seguenti riferimenti telefonici&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>";
$content .= "</tr>";

$content .="<tr>";
$content .="<td style='width: 20%' class='bordered' width='20%' ><span class='bold-text'>SEDE</span><br>D.O.C. s.c.s.<br />Via Assietta 16/b 10128 Torino<br/>p.iva 05617000012 </td>";
$content .="<td style='width: 34%' class='bordered' width='34%' ><span class='bold-text'>INFO & CONTATTI</span><br>t. +39.0115162038<br />f. +39.0115175486<br/>info@cooperativadoc.it</td>";
$content .="<td style='width: 33%' class='bordered' width='33%' ><span class='bold-text'>ORARI UFFICI</span><br>Lun-Ven: 8:30-18:00<br />Sab: 8:30-14:00<br/>Dom: closed</td>";
$content .= "</tr>";
$content .="</table>";

$content .="</div>";
$content .='</page>';

?>