<?php

$content = "
<style type='text/css'>
<!--
    
    table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
    table.page_footer {width: 100%;}
   .page-old table{width: 100%;
   }
    .or_bold{color:#9C3588;}
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
          <span class="or_bold">STESSOPIANO</span>Via Michele Buniva 8, Torino - IT<span class="or_bold">t.</span> +39.011.668.68.12 <span class="or_bold">f.</span> +39.011.668.68.12 <span class="or_bold">e.</span> info@stessopiano.it 
         </div>
    </page_footer>';

$content .="<table style='width:100%'>
    <tr><td style='text-align:center; width: 100%' width='100%' align='center' ><img src='./img/logo_sp.jpg' style='width:100%'; /> </td></tr>
    </table>";





$content .="<table style='margin-top: 30px' >";

$content .="<tr><td style='text-align:left; width:100%;' ><span class='small-title'>". $text[$lang]['label_torino'] . ' :' . date('d') . '-' . date('m') . '-' . date('Y')."<br>".$text[$lang]['label_preiscrizione'] . " N:" . $nf."</span></td></tr>";
$content .="</table >";


 $dati['sesso'] == 'M' ? $sesso = $text[$lang]['label_sm_pdf'] : $sesso = $text[$lang]['label_sf_pdf'] ;

$content .="<table style='margin-top: 50px' >";

$content .="<tr><td style='font-size:16px; background:#9C3588;  padding:7px 0px 7px 10px;text-align: left; color:#FFF' colspan='3' >".$text[$lang]['label_dati']."</td></tr>";


$content .="<tr style='line-height: 100px'>";
$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_nome'].":&nbsp;&nbsp;</span>" . $dati['nome'] . " </td>";
$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_cognome'].":&nbsp;&nbsp;</span>" . $dati['cognome'] . " </td>";
$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_sesso'].":&nbsp;&nbsp;</span>" .$sesso. " </td>";
$content .= "</tr>";


$content .="<tr style='line-height: 100px'>";
$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_natoa'].":&nbsp;&nbsp;</span>" . $dati['luogo_nascita'] . " </td>";
$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_natoil'].":&nbsp;&nbsp;</span>" . $dati['nascita'] . " </td>";
$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_nazionalita_pdf'].":&nbsp;&nbsp;</span>" .$dati['nazione']. " </td>";
$content .= "</tr>";

$extra = '';
if($dati['acc'] == "4")
	$extra = $dati['occupazione_det'] ;
if($dati['occ'] == "1")
	$extra = $dati['studente_det'] ;



$content .="<tr style='line-height: 100px'>";
$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_cellulare'].":&nbsp;&nbsp;</span>" . $dati['cellulare'] . " </td>";
$content .="<td style='width: 66%' class='tdpadding' colspan='2' ><span class='label'>".$text[$lang]['label_email'].":&nbsp;&nbsp;</span>" . $dati['email'] . " </td>";
$content .= "</tr>";

$content .="<tr style='line-height: 100px'>";
$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_occupazione'].":&nbsp;&nbsp;</span> </td>";
$content .="<td style='width: 66%' class='tdpadding' colspan='2' >" . $dati['lavoro']. " ".$extra."</td>";
$content .= "</tr>";


$content .="<tr style='line-height: 100px'>";
$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_residenza'].":&nbsp;&nbsp;</span> </td>";
//$content .="<td style='width: 66%' class='tdpadding' colspan='2' >" . $dati['residenza'] . " " . $dati['indirizzo'] . " " . $dati['numero_civico'] . " " . $dati['cap'] . " " . $dati['prov']. "</td>";
$content .="<td style='width: 66%' class='tdpadding' colspan='2' >" . $dati['residenza'] . "</td>";
$content .= "</tr>";

//~ $content .="<tr style='line-height: 100px'>";
//~ $content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_tipo_documento'].":&nbsp;&nbsp;</span></td>";
//~ $content .="<td style='width: 66%' class='tdpadding' colspan='2' >". $dati['tipo_documento'] . " " . $dati['numero_documento']. " ".$text[$lang]['label_scadenza_documento'] . " " . $dati['scadenza']."</td>";
//~ $content .= "</tr>";

if($dati['permesso_soggiorno']){
	$content .="<tr style='line-height: 100px'>";
$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_permesso'].":&nbsp;&nbsp;</span></td>";
$content .="<td style='width: 66%' class='tdpadding' colspan='2' >" . $dati['permesso_soggiorno']."</td>";
$content .= "</tr>";
	
}

$content .="<tr><td style='font-size:16px; background:#9C3588;  padding:7px 0px 7px 10px;text-align: left; color:#FFF' colspan='3' >".$text[$lang]['label_altre_informazioni']."</td></tr>";

$content .="<tr style='line-height: 100px'>";
$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_alloggio_attuale_pdf']."</span></td>";
$content .="<td style='width: 66%' class='tdpadding' colspan='2' >" . $dati['alloggio']." ".$dati['dove_vive_altro']."</td>";
$content .= "</tr>";



if ($dati['camera_amici'] == 'Y')
    $amici = $text[$lang]['label_camera_amici_pdf_si'] . " " . utf8_encode($dati['camera_amici_dettaglio']);
else
    $amici = $text[$lang]['label_camera_amici_pdf_no'];

$content .="<tr style='line-height: 100px'>";
$content .="<td style='width: 66%' class='tdpadding' colspan='3' >".$amici."</td>";
$content .= "</tr>";


if($dati['amici_quanti'] >1){
	
	
	
	$content .="<tr style='line-height: 100px'>";
	$content .="<td style='width: 66%' class='tdpadding' colspan='3' ><b>".$text[$lang]['label_amici_si_pdf']."</b></td>";
	$content .= "</tr>";
	$content .="<tr style='line-height: 100px'>";
	$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_amici_quanti_pdf'].":&nbsp;&nbsp;</span>" . $dati['numero_amici'] . " </td>";
	$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_amici_genere'].":&nbsp;&nbsp;</span>" . $dati['genere'] . " </td>";
	
	$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_amici_eta_pdf'].":&nbsp;&nbsp;</span>" .utf8_encode($dati['eta']). " </td>";
	$content .= "</tr>";
	
	
	$content .="<tr style='line-height: 100px'>";
	$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_amici_occupazione'].":&nbsp;&nbsp;</span>" . $dati['occupazione'] . " </td>";
	$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_amici_fumo'].":&nbsp;&nbsp;</span>" . $dati['fumo'] . " </td>";
	$content .="<td style='width: 33%' class='tdpadding'  colspan='2'><span class='label'>".$text[$lang]['label_amici_animali'].":&nbsp;&nbsp;</span>" . $dati['animali'] . " ".utf8_encode($dati['amici_animali_dettaglio'])." </td>";
	
	
	
	$content .= "</tr>";
}

switch($dati['nuova_residenza']){
		
	case"1"	:
		$nuova = $text[$lang]['label_sposta_residenza_si'] ;
		break;
	case "2":
			$nuova = $text[$lang]['label_sposta_residenza_no'];
			break;
	case "3":
		$nuova = $text[$lang]['label_sposta_residenza_indiferente'];
		break;
}

$content .="<tr style='line-height: 100px'>";
$content .="<td style='width: 100%' class='tdpadding' colspan='3' >".$nuova."</td>";
$content .= "</tr>";

$dati['prima_volta'] == 'Y' ? $prima = $text[$lang]['label_prima_volta_si']: $prima = $text[$lang]['label_prima_volta_no'] ;

$content .="<tr style='line-height: 100px'>";
$content .="<td style='width: 100%' class='tdpadding' colspan='3' >".$prima."</td>";
$content .= "</tr>";

$content .="<tr style='line-height: 100px'>";
$content .="<td style='width: 100%' class='tdpadding' colspan='3' >".$text[$lang]['label_conoscenza_fattura'] . ': ' . utf8_encode($dati['conoscenza'])." ".utf8_encode($dati['conoscenza_dettaglio'])."</td>";
$content .= "</tr>";

$content .="<tr><td style='font-size:16px; background:#9C3588;  padding:7px 0px 7px 10px;text-align: left; color:#FFF' colspan='3' >".$text[$lang]['label_dati_formula']."</td></tr>";

$content .="<tr style='line-height: 100px'>";
	$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_periodo']."</span></td>";
	$content .="<td style='width: 66%' class='tdpadding'  colspan='2'>".$text[$lang]['label_dal'] . " " . $dati['arrivo'] . " " . $text[$lang]['label_al'] . "  " . $dati['partenza']." </td>";
	$content .= "</tr>";


$dati['camera_singola'] == 'Y' ? $ricerca .= $text[$lang]['label_camera_singola'] . " " : "";
    $dati['camera_doppia'] == 'Y' ? $ricerca .= $text[$lang]['label_camera_doppia'] . " " : "";
    $dati['camera_indiferente'] == 'Y' ? $ricerca .= $text[$lang]['label_indifferente'] . " " : "";
    

$content .="<tr style='line-height: 100px'>";
$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_sto_cercando_pdf']."</span></td>";
$content .="<td style='width: 66%' class='tdpadding' colspan='2' >".$ricerca."</td>";
$content .= "</tr>";

$dati['livello'] == 7 ? $livello =  utf8_encode($dati['livello_altro']) . " Euro":  $livello = str_replace("&euro;", "Euro", $dati['nome_livello']);

$content .="<tr style='line-height: 100px'>";
	$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_livello_pdf'].":</span></td>";
	$content .="<td style='width: 66%' class='tdpadding'  colspan='2'>".$livello." </td>";
	$content .= "</tr>";

if ($dati['quartieri']) {
       $quartieri = explode(",", $dati['quartieri']);
        for ($x = 0; $x < count($quartieri); $x++){
            $qua .= $db->SingleField("nome", "sp_quartiere", "WHERE id='" . $quartieri[$x] . "' ") . " ";
		}
		
	$content .="<tr style='line-height: 100px'>";
	$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_quartieri_pdf'].":</span> </td>";
	$content .="<td style='width: 66%' class='tdpadding'  colspan='2'>".$qua." </td>";
	$content .= "</tr>";
	
    }

$content .="<tr><td style='font-size:16px; background:#9C3588;  padding:7px 0px 7px 10px;text-align: left; color:#FFF' colspan='3' ></td></tr>";

if($dati['interessato']){

$content .="<tr style='line-height: 100px'>";
	$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_interessato_pdf'].":</span></td>";
	$content .="<td style='width: 66%' class='tdpadding'  colspan='2'>".utf8_encode($dati['interessato'])." </td>";
	$content .= "</tr>";
}

if($dati['note']){

$content .="<tr style='line-height: 100px'>";
	$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_note'].":</span></td>";
	$content .="<td style='width: 66%' class='tdpadding'  colspan='2'>".utf8_encode($dati['note'])." </td>";
	$content .= "</tr>";
}

if($dati['giorni_visita']){

$content .="<tr style='line-height: 100px'>";
	$content .="<td style='width: 33%' class='tdpadding' ><span class='label'>".$text[$lang]['label_giorni_visite_pdf']."</span></td>";
	$content .="<td style='width: 66%' class='tdpadding'  colspan='2'>".utf8_encode($dati['giorni_visita'])." </td>";
	$content .= "</tr>";
}

$content .="<tr style='line-height: 100px'>";
	$content .="<td style='width: 100%' class='tdpadding' colspan='3' >".$text[$lang]['label_privacy_pdf']."</td>";
	
	$content .= "</tr>";


$content .="</table>";


$content .='</page>';

?>