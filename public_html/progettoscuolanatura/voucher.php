<?

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
    }
    .class_td_big{
    padding-top:5px;
        paddin-bottom: 5px;
    }
    .page-old{
    border: 1px solid
    }
.title{
    color:#82a846;
    font-size: 25px;
    font-weight: bold;
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
    <tr><td style='text-align:left'   ><img src='./img/logo_scuolanatura_unificato.png'  style='width: 200px'/> </td></tr>
    </table>";

$content .="<table style='width:100%;margin-top: 105px' >";
$content .="<tr><td style='text-align:center; width:100%;'><span class='title'>LA SCUOLA OLTRE LA SCUOLA</span><br><br><span style='padding-top:20px'>Voucher N&deg;" . $code . "</span> </td></tr>";
$content .="<tr><td style='font-size: 14px; background: url(./img/linea_footer.png) no-repeat bottom left; padding:45px 0px 20px 0px; text-align: left' >Si riccordi di portare con s&egrave; questo voucher il giorno del convegno</td></tr>";
$content .="<tr>";
$content .="<td>";
$content .="<table style='width:100%;' >";
$content .="<tr>";
$content .="<td><img src='./code/" . $code . ".png' /></td>";
$content .="<td>";
$content .="<table style='width:100%; '>";
$content .= "<tr><td class='class_td_big' colspan='2' ><u>Dettaglio partecipante</u></td></tr>";

$content .="<tr>";
$content .= "<td class='class_td'><b>Nome</b>:&nbsp;" . $user['nome'] . "</td>";
$content .= "<td class='class_td' >&nbsp;&nbsp;<b>Cognome</b>:&nbsp;" . $user['cognome'] . "</td>";
$content .= "</tr>";

$content .="
<tr class='row top-20'>
    <td class='class_td'><b>Cellulare</b>:&nbsp;" . $user['cellulare'] . "</td>
    <td class='class_td'>&nbsp;&nbsp;<b>Email</b>:&nbsp;" . $user['email'] . "</td>
</tr>";

$content .="<tr class='row top-20'>
        <td class='class_td' colspan='2'><b>Ente</b>:&nbsp;" . $user['ente'] . "</td>
</tr>";


if ($user['ruolo'] == '4')
    $user['n_ruolo'] = $user['altro_ruolo'];

$content .="<tr class='row top-20'>
   <td class='class_td' colspan='2'><b>Ruolo</b>:&nbsp;" . cleanText($user['n_ruolo']) . "</td>
</tr>";
$content .="<tr class='row top-20'>
    <td class='class_td' colspan='2'><b>Workshop</b>:&nbsp;" . cleanText($user['n_focus']) . "</td>
</tr>";



$content .="<tr class='row top-20'>
    <td class='class_td' colspan='2'><b>Tour al castello</b>:&nbsp;" . cleanText($user['n_percorso']) . "</td>
</tr>";



$content .="<tr class='row top-20'>
    <td class='class_td' colspan='2' >" . $testo . "</td>
</tr>";


$content .="</table>";
$content .="</td>";

$content .="</tr>";

$content .="</table>";
$content .="</td>";

$content .="</tr>";

$content .="<tr><td style='background: url(./img/linea_footer.png) no-repeat top left;'>&nbsp;</td></tr>";
$content .="<tr><td style='text-align:center; width:100%;padding-top: 70px'><img src='./img/banner_castello.jpg' /></td></tr>";
$content .="</table>";
$content .='</page>';
?>  


