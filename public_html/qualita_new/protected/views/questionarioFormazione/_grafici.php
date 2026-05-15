<?php

$HOME   = Yii::app()->getBaseUrl(true);
$IMG    = $HOME."/images/DOC_GCM_2021_slim_02.png";

echo '<link href="'.$HOME.'/css/pdf.css" type="text/css" rel="stylesheet"/>';

$corsi              = Yii::app()->MyStats->getCorsiFormazione($nome);
$valutazioni       = array("corso" => "Il corso","giudizio" => "Il giudizio","spazi"=> "Gli spazi",'conduzione'=>"La conduzione",'livello'=> "Il livello"); 

 foreach($corsi AS $id => $corso ){ 
    $data     = Yii::app()->db->createCommand("SELECT DATE_FORMAT(data_corso,'%d-%m-%Y') FROM questionario_formazione WHERE titolo LIKE '%".addslashes($corso)."%' ")->queryScalar();                            
    $GRAFICO  = "grafici/PNG/questionari_formazione/generali/".preg_replace('/[^a-zA-Z0-9_.]/', '_', $nome).".png";
    $TOT      = Yii::app()->db->createCommand("SELECT COUNT(id) FROM questionario_formazione WHERE titolo = '".addslashes($corso)."' ")->queryScalar(); 

?>
<page pageset="" class="" backtop="5mm" backbottom="5mm" backleft="5mm" backright="5mm">
    <page_header>

    </page_header>
    <page_footer>
        <table style='width:100%;'>
            <tr>
                <td class="footer-td-center">
                    <span class="or_bold">D.O.C. scs s.r.l.</span> Via Assietta 16/b 10128 Torino <span class="or_bold">t.</span> +39.011.516.20.38 <span class="or_bold">f.</span> +39.011.517.54.86
                </td>
                <td class="footer-td-right">
                    <?= "Pagina [[page_cu]] Di [[page_nb]]" ?>
                </td>
            </tr>
        </table>
    </page_footer>
    <table style='width:100%;' class="">
        <tr>
            <td class='intro-big' style="text-align: right; width: 100%"><img src="<?= $IMG?>" style="width: 20%" /></td>
        </tr>
    </table>
    <table style='width:100%; margin-top: 50px;' cellspacing="0" cellpadding="0" class="default-table t3070">
        <tr>
            <td class='intro-big' style="text-align: center; width: 100%">
                <span class='titolo-grafici-small'>
                    <?= "<span class='anno-grafici'>".$data."</span><span class=''> ".$nome."</span><br> Totale questionari:<span class='totale-grafici'>".$TOT."</span>" ?>
                </span>
            </td>
        </tr>
    </table>
    <table style='width:100%; margin-top: 35px;' cellspacing="0" cellpadding="0" class="default-table t3070">
        <tr>
            <td><img src='<?= $HOME."/".$GRAFICO ?>' style="width:90%" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style='width:100%; text-align: center;; padding: 40px'>
               <table class='custom-table-pdf' style='margin-top: 35px; width:100%; border: #dadfe3 1px solid ; border-radius: 5px' cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th style='width:25%'></th>
                            <th style='width:19%' class='right head'>Insufficiente</th>
                            <th style='width:14%' class='right head'>Sufficente</th>
                            <th style='width:14%' class='right head'>Buono</th>
                            <th style='width:14%' class='right head'>Eccelente</th>
                            <th style='width:14%' class='right head'>Totale</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($valutazioni AS $val => $giudizio){?>
                       <tr style='border-bottom: #dadfe3 1px solid'>
                            <td class='left'><?=$giudizio ?></td>
                            <td class='right tdati'><?= $model->stats['corso_'.$id][$val]['I'] ?></td>
                            <td class='right tdati'><?= $model->stats['corso_'.$id][$val]['S'] ?></td>
                            <td class='right tdati'><?= $model->stats['corso_'.$id][$val]['B'] ?></td> 
                            <td class='right tdati'><?= $model->stats['corso_'.$id][$val]['E'] ?></td> 
                            <td class='right tdati'><?= $model->stats['corso_'.$id]['totale_campo'] ?></td> 
                        </tr>
                     <?php }?>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</page>
<?php  } ?>
