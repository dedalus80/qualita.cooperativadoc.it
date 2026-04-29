<?php

$HOME   = Yii::app()->getBaseUrl(true);
$IMG    = $HOME."/images/coopdoc-logo-pdf.png";

echo '<link href="'.$HOME.'/css/pdf.css" type="text/css" rel="stylesheet"/>';

$consumi = array(
    "utenze_gas" => array("nome" => "Gas","icona"=>"fa fa-fire",'volume' => 'Mc'),
    "utenze_acqua" =>array("nome" => "Acqua","icona"=>"fa fa-tint",'volume' => 'Mc'),
    "utenze_luce" => array("nome" => "Energetici","icona"=>"fa fa-plug",'volume' => 'Kwh'),
    "utenze_rifiuti" => array("nome" => "Rifiuti","icona"=>"fa fa-trash-o",'volume' => 'Mc'),
    "utenze_chimici" => array("nome" => "Sostanze Chimiche","icona"=>"fa fa-flask",'volume' => 'Mc')
);

foreach($consumi AS $id => $val){
    
    $GRAFICO = "grafici/PNG/utenze_".$tipo."/generali/".$anno."_".$id.".png";
    
    if(file_exists($_SERVER['DOCUMENT_ROOT']."/qualita_new/".$GRAFICO) ) { 
        
        $tipo =='p' ? $k = 'c_' : $k = '';
        $TOT = Yii::app()->db->createCommand("SELECT SUM(".$k."totale) FROM ".$id." WHERE anno ='".$anno."' ")->queryScalar();
        $tipo =='c' ? $label = $consumi[$id]['volume'] : $label = "Euro" ;
        
?>
<page pageset=""  class="" backtop="5mm" backbottom="5mm" backleft="5mm" backright="5mm" > 
    <page_header>

    </page_header>
    <page_footer>
        <table style='width:100%;'>
            <tr>
                <td class="footer-td-center">
                    <span class="or_bold">D.O.C. scs s.r.l.</span> Via Assietta 16/b 10128 Torino <span class="or_bold">t.</span> +39.011.516.20.38 <span class="or_bold">f.</span> +39.011.517.54.86
                </td>  
                <td class="footer-td-right"><?= "Pagina [[page_cu]] Di [[page_nb]]" ?></td>  
            </tr>
        </table>
    </page_footer>

    <table style='width:100%;' class="">
        <tr>
            <td class='intro-big' style="text-align: right; width: 100%" ><img src="<?= $IMG?>" style="width: 20%" /></td>
        </tr>
    </table>
    <table style='width:100%; margin-top: 0px;'  cellspacing="0" cellpadding="0" class="default-table t3070">
       <tr>
            <td class='intro-big' style="text-align: center; width: 100%" >
                <span class='titolo-grafici'>
                    Consumi <?= $consumi[$id]['nome']."<span class='anno-grafici'> ".$anno."</span> TOTALE ".$label." <span class='anno-grafici'>".$TOT."</span>"; ?>
                </span>
           </td>
        </tr>
       
         <tr>
            <td class='grafico-bif' style="text-align: center; width: 100%" ><img src='<?= $HOME."/".$GRAFICO ?>'  style="width: 80%" /></td>
        </tr>
    </table>
</page>

<?php } }?>


