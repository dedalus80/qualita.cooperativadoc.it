<link href="https://qualita.cooperativadoc.it/qualita_new/css/pdf.css" type="text/css" rel="stylesheet"/>  
<?php
$label = $model->attributeLabels();
$valuta = array("C" => "CONFORME", "NC" => "NON CONFORME", "NA" => "NON APPLICABILE", "NR" => "NON RIVELATA");
$IMG = "https://qualita.cooperativadoc.it/qualita_new/images/logo_pdf.png";


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
                <td class='' style="text-align: left; width: 75%" ><img src="<?= $IMG ?>" style="width: 75%" /> </td>
                <td class='' style="text-align:left; width: 25%;padding-top: 5px" >
                    <div class="box-codice">
                        MD 07-08 <br />
                        del .../.../...... <br />
                        rev02
                    </div>
                </td>
            </tr>
            <tr>
                <td class='intro-big' colspan="2" style="padding: 30px 0px ; width: 100%; text-align: center ">Verifica Ispettiva Ambiente</td>
            </tr>
        </table>
        <table style='width:100%;' class="intro-table">    
            <tr>
                <td class='intro-left' >Data Prevista </td>
                <td class='intro-right' > </td>
            </tr>
            <tr>
                <td class='intro-left' ><?= utf8_decode("Unit&agrave; Operativa") ?>: </td>
                <td class='intro-right' > </td>
            </tr>
            <tr>
                <td class='intro-left' >Incaricato Verifica </td>
                <td class='intro-right' ></td>
            </tr>
            <tr>
                <td class='intro-left' >Tipologia valutazione </td>
                <td class='intro-right' ></td>
            </tr>
            <tr>
                <td class='intro-left' >Data esecuzione </td>
                <td class='intro-right' >Inizio Ore :</td>
            </tr>
            <tr>
                <td class='intro-left' >Stato verifica </td>
                <td class='intro-right' >Non conformit&agrave;:  </td>
            </tr>
        </table>
        <table style='width:100%; margin-top: 15px;'  cellspacing="0" cellpadding="0">
            <tr><td><B>LEGENDA:</B> C-CONFORME&nbsp;&nbsp;&nbsp;&nbsp;NC-NON CONFORME&nbsp;&nbsp;&nbsp;&nbsp; NR-NON RILEVABILE&nbsp;&nbsp;&nbsp;&nbsp; NA-NON APPLICABILE  </td></tr>
        </table>
        <table style='width:100%; margin-top: 15px;'  cellspacing="0" cellpadding="0">
            <tr class="row-tr" >
                <td class='intro-sezione' colspan="2"><?= $model->bar['sezione_' . $k]['titolo'] ?></td>
                <td class='intro-nc' style="text-align: right; padding-right: 20px" >NON CONFORMIT&Agrave;:</td>
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
                <?php if ($k == 2 && $x == 0) { ?>
                    <tr class="row-border-grey">
                        <td colspan='4' style='width:100%;' >
                            IL SISTEMA DI GESTIONE AMBIENTALE &Egrave; STATO CORRETTAMENTE IMPLEMENTATO?NELLO SPECIFICO SONO STATI CORRETTAMENTE COMPLETATI I SEGUENTI DOCUMENTI? (RILEVAMENTO DI ALMENO 2 CAMPIONI DI 2 GRUPPI DI RIFERIMENTO).
                        </td>
                    </tr>                  
                <?php } ?>
				<tr class="row-border">
                    <td class='intestazione-quesito <?= $bg ?>'><?= utf8_decode($label[$model->campiSezioni['sezione_' . $k][$x]]) ?></td>
                    <td class='intestazione-valutazione <?= $bg ?>' ><?= $valuta[$model[$model->campiSezioni['sezione_' . $k][$x]]] ?></td>
                    <td class='intestazione-note <?= $bg ?>' ><?= utf8_decode($model[$model->campiSezioni['sezione_' . $k][$x] . "_note"]) ?></td>
                </tr>
            <?php } ?>
            <tr class="row-border">
                <td class=' <?= $x % 2 == '0' ? "" : "odd" ?>' style="width: 50%" >Note</td>
                <td colspan="2" class=' <?= $x % 2 == '0' ? "" : "odd" ?>' style="width: 50%"  ><?= utf8_decode($model['note_' . $k]) ?></td>
            </tr>
            <tr class="row-border">
                <td   class="<?= $x % 2 == '0' ? "odd" : "" ?>"style="width: 50%"  >Osservazioni del Gestore ed eventuali<br /> Azioni Correttive adottate/adottabili:</td>
                <td class="<?= $x % 2 == '0' ? "odd" : "" ?>" colspan="2" style="width: 50%"  ><?= utf8_decode($model['osservazioni_' . $k]) ?></td>
            </tr>
        </table>
    </page>
    <?php
}?>