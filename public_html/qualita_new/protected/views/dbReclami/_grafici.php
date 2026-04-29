<?php

$HOME   = "https://qualita.cooperativadoc.it/qualita_new";
$IMG    = $HOME."/images/coopdoc-logo-pdf.png";

echo '<link href="'.$HOME.'/css/pdf.css" type="text/css" rel="stylesheet"/>';

$grafici = array(
    "NC" => array("titolo"=> "Azioni non conformi","icona"=>"","tabella"=> "db_nonconforme","and"=>""),
    "AC" => array("titolo"=> "Azioni correttive","icona"=>"","tabella"=> "db_azionicorrettive","and"=>"AND tipo_azione ='1'"),
    "AP" => array("titolo"=> "Azioni preventive","icona"=>"","tabella"=> "db_azionicorrettive","and"=>"AND tipo_azione ='2'"),
    "R" => array("titolo"=> "Reclami","icona"=>"","tabella"=> "db_reclami","and"=>""),
);

foreach($grafici AS $ID => $val) {
    
    $GRAFICO = "grafici/PNG/azioni/generali/".$anno."_statistiche_".$ID.".png";
        
    if(file_exists($_SERVER['DOCUMENT_ROOT']."/qualita_new/".$GRAFICO) ) {
        $TOT =  Yii::app()->db->createCommand("SELECT COUNT(id) FROM ".$grafici[$ID]['tabella']." WHERE anno ='".$anno."' ".$grafici[$ID]['and']."  ")->queryScalar();

        $path = $_SERVER['DOCUMENT_ROOT']."/qualita_new/".$GRAFICO;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
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
    <table style='width:100%; margin-top: 25px;'  cellspacing="0" cellpadding="0" class="default-table t3070">
       <tr>
            <td class='intro-big' style="text-align: center; width: 100%" >
                <span class='titolo-grafici'>
                    <?php echo $grafici[$ID]['titolo']."<span class='anno-grafici'> ".$anno."</span> - TOTALE <span class='totale-grafici'>".$TOT."</span>"; ?>
                </span>
           </td>
        </tr>
       
         <tr>
            <td class='grafico-bif' style="text-align: center; width: 100%" ><img src="<?php echo $base64; ?>" style="width:75%" /></td>
        </tr>
    </table>
</page>

<?php
    }
}
?>
