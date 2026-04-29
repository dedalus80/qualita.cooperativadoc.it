<link href="https://qualita.scuolanaturamilano.it/css/pdf.css" type="text/css" rel="stylesheet"/>  
<?php
$label = $model->attributeLabels();
$valuta = array("C" => "CONFORME", "NC" => "NON CONFORME", "NA" => "NON APPLICABILE", "NR" => "NON RIVELATA");

for ($k = 1; $k <= count($model->campiSezioni); $k++) { 
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
                <td class='intro-big' style="text-align: right; width: 100%" ><img src="https://qualita.scuolanaturamilano.it/logo-pdf.png" style="width: 40%" /></td>
            </tr>
            <tr>
                <td class='intro-big' style="padding: 30px 0px ; width: 100% ">Verifica Ispettiva Settore educativo<br />Codice: <?= $model->codice_verifica ?></td>
            </tr>
        </table>
        <table style='width:100%;' class="intro-table">    
            <tr>
                <td class='intro-left' >Data Prevista </td>
                <td class='intro-right' ><?= Yii::app()->MyUtils->reverseDate($model->data) ?> </td>
            </tr>
            <tr>
                <td class='intro-left' ><?= utf8_decode("Unit&agrave; Operativa") ?>: </td>
                <td class='intro-right' ><?= Yii::app()->MyUtils->getSelectValue($model->unita_operativa, 'qualita_strutture') ?> </td>
            </tr>
            <tr>
                <td class='intro-left' >Incaricato Verifica </td>
                <td class='intro-right' ><?= Yii::app()->MyUtils->getSelectValue($model->autore, 'dettaglio_admin') ?></td>
            </tr>
            <tr>
                <td class='intro-left' >Tipologia valutazione </td>
                <td class='intro-right' ><?= $model->tipo_valutazione == 'A' ? "Autovalutazione" : "Valutazione" ?></td>
            </tr>
            <tr>
                <td class='intro-left' >Data esecuzione </td>
                <td class='intro-right' >Inizio Ore :<?= substr($model->ora_inizio, 0, 5) ?> Fine Ore : <?= substr($model->ora_fine, 0, 5) ?></td>
            </tr>
            <tr>
                <td class='intro-left' >Stato verifica </td>
                <td class='intro-right' >Non conformit&agrave;: <?= $model->getNCPdf($model) ?> </td>
            </tr>
        </table>

        <table style='width:100%; margin-top: 25px;'  cellspacing="0" cellpadding="0">
            <tr class="row-tr" >
                <td class='intro-sezione' colspan="2"><?= $model->bar['sezione_' . $k]['titolo'] ?></td>
                <td class='intro-nc' style="text-align: right" >NON CONFORMIT&Agrave; :<span class="red"> <?= $model->bar['sezione_' . $k]['complete_nc'] ?></span></td>
            </tr>
            <tr>
                <td class='intestazione intestazione-quesito'>PARAMETRO DA VALUTARE</td>
                <td class='intestazione intestazione-valutazione'>GIUDIZIO</td>
                <td class='intestazione intestazione-note'>NOTE SINGOLA VOCE</td>
            </tr>
            <?php
            for ($x = 0; $x < count($model->campiSezioni['sezione_' . $k]); $x++) {

                $x % 2 == 0 ? $bg = '' : $bg = 'odd';
                ?>
                <?php if ($k == 1 && $x == 0) { ?>
                    <tr class="row-border">
                        <td colspan="3">
                            IL SISTEMA DI PROGRAMMAZIONE - MONITORAGGIO - VALUTAZIONE DELL\'ESPERIENZA EDUCATIVA OFFERTA DALL\'ORGANIZZAZIONE &Egrave; STATO CORRETTAMENTE IMPEMENTATO? NELLO SPECIFICO SONO STATI CORRETTAMENTE COMPLETATI I SEGUENTI DOCUMENTI? (RILEVAMENTO DI ALMENO 2 CAMPIONI DI 2 GRUPPI DI RIFERIMENTO)
                        </td>
                    </tr>                 
                <?php } ?>                        
                <tr class="row-border">
                    <td class='intestazione-quesito <?= $bg ?>'><?= $label[$model->campiSezioni['sezione_' . $k][$x]] ?></td>
                    <td class='intestazione-valutazione <?= $bg ?>' ><?= $valuta[$model[$model->campiSezioni['sezione_' . $k][$x]]] ?></td>
                    <td class='intestazione-note <?= $bg ?>' ><?= $model[$model->campiSezioni['sezione_' . $k][$x] . "_note"] ?></td>
                </tr>
            <?php } ?>
                <tr class="row-border">
                    <td class=' <?= $x % 2 == '0' ? "":"odd" ?>' >Note</td>
                    <td colspan="2" class=' <?= $x % 2 == '0' ? "":"odd" ?>' ><?= $model['note_' . $k] ?></td>
                </tr>
                <tr class="row-border">
                   <td   class="<?= $x % 2 == '0' ? "odd":"" ?>" >Osservazioni del Gestore ed eventuali<br /> Azioni Correttive adottate/adottabili:</td>
                    <td class="<?= $x % 2 == '0' ? "odd":"" ?>" colspan="2" ><?= $model['osservazioni_' . $k] ?></td>
                </tr>
        </table>
    </page>
    <?php
}?>