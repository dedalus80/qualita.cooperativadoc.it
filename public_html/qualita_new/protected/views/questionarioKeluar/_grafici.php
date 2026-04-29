<?php

$HOME   = Yii::app()->getBaseUrl(true);
$IMG    = $HOME."/images/coopdoc-logo-pdf.png";

echo '<link href="'.$HOME.'/css/pdf.css" type="text/css" rel="stylesheet"/>';

$tmp                = Yii::app()->MyUtils->getDatiQuestionario("questionario_keluar");
$giudizzi           = $tmp['giudizzi'] ;

foreach($giudizzi as $giudizzio){  
        
    if( $model->stats[$giudizzio]['totale'] > 0 ){ 
        $struttura ? $GRAFICO = "grafici/PNG/questionari_keluar/strutture/".$struttura."_".$anno."_".$giudizzio.".png" : $GRAFICO = "grafici/PNG/questionari_keluar/generali/".$anno."_".$giudizzio.".png";
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
                    <?= "<span class='anno-grafici'> ".$nome."</span> Questionari Keluar <span class='anno-grafici'> ".$anno."</span> <span class='totale-grafici'>".$TOT."</span>" ?>
                    <br /><br /><span class='sotto-titolo'>
                        <?= str_replace("_", " ", $giudizzio) ?></span>
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
                        <tr style='border-bottom: #dadfe3 1px solid'>
                            <td class='left'>Anno Precedente</td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['I'][0] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['S'][0] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['B'][0] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['E'][0] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['ieri'] ?>
                            </td>

                        </tr>
                        <tr style='border-bottom: #dadfe3 1px solid'>
                            <td class='left'>Anno in Corso</td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['I'][1] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['S'][1] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['B'][1] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['E'][1] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['anno'] ?>
                            </td>
                        </tr>
                        <tr style='border-bottom: #dadfe3 1px solid'>
                            <td class='left'>Totale Strutture </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['I'][2] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['S'][2] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['B'][2] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats[$giudizzio]['E'][2] ?>
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
<?php } } if( $model->stats['consiglia']['totale'] > 0){  

$struttura ? $GRAFICO = "grafici/PNG/questionari_keluar/strutture/".$struttura."_".$anno."_consiglia.png" : $GRAFICO = "grafici/PNG/questionari_keluar/generali/".$anno."_consiglia.png";


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
                    <?= "<span class='anno-grafici'> ".$nome."</span> Questionari Doc <span class='anno-grafici'> ".$anno."</span> <span class='totale-grafici'>".$TOT."</span>" ?>
                    <br /><br /><span class='sotto-titolo'>Consiglerebbe</span>
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
                            <th style='width:20%'></th>
                            <th style='width:20%' class='right head'>Certamente No</th>
                            <th style='width:20%' class='right head'>Non so Forse</th>
                            <th style='width:20%' class='right head'>Certamente Si</th>
                            <th style='width:14%' class='right head'>Totale</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style='border-bottom: #dadfe3 1px solid'>
                            <td class='left'>Anno Precedente</td>
                            <td class='right tdati'>
                                <?= $model->stats['consiglia']['N'][0] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats['consiglia']['F'][0] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats['consiglia']['S'][0] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats['consiglia']['ieri'] ?>
                            </td>
                        </tr>
                        <tr style='border-bottom: #dadfe3 1px solid'>
                            <td class='left'>Anno in Corso</td>
                            <td class='right tdati'>
                                <?= $model->stats['consiglia']['N'][1] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats['consiglia']['F'][1] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats['consiglia']['S'][1] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats['consiglia']['anno'] ?>
                            </td>
                        </tr>
                        <tr style='border-bottom: #dadfe3 1px solid'>
                            <td class='left'>Totale Strutture </td>
                            <td class='right tdati'>
                                <?= $model->stats['consiglia']['N'][2] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats['consiglia']['F'][2] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats['consiglia']['S'][2] ?>
                            </td>
                            <td class='right tdati'>
                                <?= $model->stats['consiglia']['totale'] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</page>


<?php } ?>
