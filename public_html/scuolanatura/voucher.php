<?php

$content = "
<style type='text/css'>
<!--
    
    table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
    table.page_footer {width: 100%;}
   .page-old table{width: 100%;
   }
    .or_bold{color:#82a846}
    .class_td{
        padding-top:5px;
        paddin-bottom: 5px;
        font-size:14px;
    }
    .class_td_big{
    padding-top:5px;
        paddin-bottom: 5px;
    }
    .td_class{
    font-size: 14px;
    }
    .page-old{
    border: 1px solid
    }
.title{
    color:#82a846;
    font-size: 25px;
    font-weight: bold;
    }    
td{
    vertical-align: top;
}

-->
</style>";


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
    <tr><td style='text-align:center'   ><img src='./img/header-pdf.jpg' style='width:100%'; /> </td></tr>
    </table>";

$content .="<table style='width:100%;margin-top: 70px' >";
$content .="<tr><td style='text-align:center; width:100%;'><span class='title'></span></td></tr>";
$content .="<tr><td style='text-align:left;font-size:14px; width:100%;padding-top:50px;'><span style='text-align:left'>".cleanText($TESTO)."
</td></tr>";

$content .="<tr><td style='font-size: 14px; background: url(./img/linea_footer.png) no-repeat bottom left; padding:15px 0px 20px 0px; text-align: left' >Si ricordi di portare con s&egrave; questo voucher il giorno dell'Evento</td></tr>";
$content .="<tr>";
$content .="<td>";
$content .="<table style='width:100%;' >";
$content .="<tr>";
$content .="<td><img src='./code/" . $code . ".png' /></td>";
$content .="<td>";
$content .="<table style='width:100%; '>";
$content .= "<tr><td class='class_td_big' colspan='2' ><u>Dettaglio partecipante</u></td></tr>";

$content .="<tr>";
$content .= "<td class='class_td'><b>Nome</b>:&nbsp;" . $user['nome'] . "</td></tr><tr>";
$content .= "<td class='class_td' ><b>Cognome</b>:&nbsp;" . $user['cognome'] . "</td>";
$content .= "</tr>";

$content .="
<tr class='row top-20'>
    <td class='class_td'><b>Cellulare</b>:&nbsp;" . $user['cellulare'] . "</td></tr><tr>
    <td class='class_td'><b>Email</b>:&nbsp;" . $user['email'] . "</td>
</tr>";

if($user['ruolo']){
$content .="<tr class='row top-20'>
        <td class='class_td'><b>Ente/Scuola/Istituto</b>:&nbsp;" . utf8_encode($user['ente']) . "</td></tr><tr>
        <td class='class_td' ><b>Ruolo</b>:&nbsp;" . cleanText($user['ruolo']) . "</td>
</tr>";
}else{
    $content .="<tr class='row top-20'>
        <td class='class_td' colspan='2'><b>Ente/Scuola/Istituto</b>:&nbsp;" . utf8_encode($user['ente']) . "</td></tr><tr>
</tr>";
}

if($user['dieta'] ){
    
    if($user['dieta'] =='Y'){
        $content .="<tr class='row top-20'>
        <td class='class_td' colspan='2><b>Esigenze alimentari</b>:&nbsp;" . utf8_encode($user['dieta_dettaglio']) . "</td>
       </tr>";
    }else{
        $content .="<tr class='row top-20'>
        <td class='class_td' colspan='2><b>Nessuna esigenza alimentare</b></td>
        </tr>";
    }
    
}

if($user['panel'] ){
    
        $content .="<tr class='row top-20'>
        <td class='class_td' colspan='2><b>Panel</b>:&nbsp;" . $db->SingleField("nome","ns_panel "," WHERE id ='".$user['panel']."'  ") . "</td>
       </tr>";
    
}


$content .="<tr class='row top-20'>
        <td class='class_td'><b>QrCode</b>:&nbsp;" . $code . "</td>   
</tr>";

$content .="</table>";
$content .="</td>";

$content .="</tr>";

$content .="</table>";
$content .="</td>";

$content .="</tr>";

$content .="<tr><td style='background: url(./img/linea_footer.png) no-repeat top left;'>&nbsp;</td></tr>";
$content .="<tr><td style='text-align:center; padding-top:140px'><img src='./img/footer-pdf.jpg' style='width:100%'; /></td></tr>";
$content .="</table>";
$content .='</page>';

?>  


