<?php
$HOME   = Yii::app()->getBaseUrl(true);
$IMG    = $HOME."/images/coopdoc-logo-pdf.png";

echo '<link href="'.$HOME.'/css/pdf.css" type="text/css" rel="stylesheet"/>';

$tmp = Yii::app()->MyUtils->getDatiQuestionario("questionario_scientifici");
$giudizzi = $tmp['giudizzi'] ;

foreach($giudizzi as $giudizzio){  
        
    if( $model->stats[$giudizzio]['totale'] > 0 ){ 
        
        $struttura ? $GRAFICO = "grafici/PNG/questionari_scientifici/strutture/".$struttura."_".$anno."_".$giudizzio.".png" : $GRAFICO = "grafici/PNG/questionari_scientifici/generali/".$anno."_".$giudizzio.".png";
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
                    <?= "<span class='anno-grafici'> ".$nome."</span> Questionari Campus formativi  <span class='anno-grafici'> ".$anno."</span> <span class='totale-grafici'>".$TOT."</span>" ?>
                    <br /><br /><span class='sotto-titolo'>
                         <?= str_replace("_"," ",$model->stats[$giudizzio]['label']) ?></span>
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
                            <th style='width:28%'></th>
                            <th style='width:18%' class='right head'>Poco</th>
                            <th style='width:18%' class='right head'>Abbastanza</th>
                            <th style='width:18%' class='right head'>Molto</th>
                            <th style='width:18%' class='right head'>Totale</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style='border-bottom: #dadfe3 1px solid'>
                            <td class='left'>Anno Precedente</td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['P'][0] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['A'][0] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['M'][0] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['ieri'] ?>
                            </td>

                        </tr>
                        <tr style='border-bottom: #dadfe3 1px solid'>
                            <td class='left'>Anno in Corso</td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['P'][1] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['A'][1] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['M'][1] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['anno'] ?>
                            </td>
                        </tr>
                        <tr style='border-bottom: #dadfe3 1px solid'>
                            <td class='left'>Totale Strutture </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['P'][2] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['A'][2] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['M'][2] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['totale'] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</page>
<?php } }  ?>
