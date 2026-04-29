<link href="https://qualita.cooperativadoc.it/qualita_new/css/pdf.css" type="text/css" rel="stylesheet"/> 

<?php
//$label = $model->attributeLabels();
$valuta = array("C" => "CONFORME", "NC" => "NON CONFORME", "NA" => "NON APPLICABILE", "NR" => "NON RIVELATA");
$IMG = "https://qualita.cooperativadoc.it/qualita_new/images/logo_pdf.png";

$k=1;
foreach($questions as $question):
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
                    <td class="footer-td-right"><?php echo "Pagina [[page_cu]] Di [[page_nb]]";?></td>  
                </tr>
            </table>
        </page_footer>

        <table style="width:100%">
            <tr>
                <td style="text-align: left; width: 75%" ><img src="<?= $IMG ?>" style="width: 75%" /></td>
                <td style="text-align:left; width: 25%; padding-top: 5px" >
                    <div class="box-codice">
                        MD 07-10 <br />
                        del <?php echo (new DateTime($model->data))->format('d-m-Y'); ?> <br />
                        rev03
                    </div>
                </td>
            </tr>
            <tr>
                <td class='intro-big' colspan='2' style="padding: 30px 0px ; width: 100% ">Verifica Ispettiva<br />Codice: <?= $model->codice ?></td>
            </tr>
        </table>
        <table style='width:100%;' class="intro-table">    
            <tr>
                <td class='intro-left' >Data Prevista </td>
                <td class='intro-right' ><?php echo (new DateTime($model->data))->format('d-m-Y');?> </td>
            </tr>
            <tr>
                <td class='intro-left' ><?php echo utf8_decode("Unit&agrave; Operativa"); ?>: </td>
                <td class='intro-right' ><?php echo Yii::app()->MyUtils->getSelectValue($model->unita_operativa, 'doc_unita');?></td>
            </tr>
            <tr>
                <td class='intro-left' >Incaricato Verifica </td>
                <td class='intro-right' ><?php echo Yii::app()->MyUtils->getSelectValue($model->incaricato, 'dettaglio_admin');?></td>
            </tr>
            <tr>
                <td class='intro-left' >Tipologia valutazione </td>
                <td class='intro-right' ><?php echo ($model->tipo_valutazione == 'A' ? "Autovalutazione" : "Valutazione");?></td>
            </tr>
            <tr>
                <td class='intro-left' >Data esecuzione </td>
                <td class='intro-right' >Inizio Ore: <?php echo substr($model->ora_inizio, 0, 5); ?> Fine Ore: <?php echo substr($model->ora_fine, 0, 5);?></td>
            </tr>
            <tr>
                <td class='intro-left' >Stato verifica </td>
                <td class='intro-right' >Non conformit&agrave;: <?php //echo $model->getNC($model, $model->tipo_verifica); ?> </td>
            </tr>
        </table>
        
        <table style='width:100%; margin-top: 25px;'  cellspacing="0" cellpadding="0">
            <tr class="row-tr">
                <td class="intro-sezione" colspan="2"><?php echo $question['name']; ?></td>
                <td class="intro-nc" style="text-align:right; padding-right: 20px" >NON CONFORMIT&Agrave;:<span class="red"> <?php echo $progress[$question['id']]['nc']; ?></span></td>
            </tr>
            <tr>
                <td class="intestazione intestazione-quesito">PARAMETRO DA VALUTARE</td>
                <td class="intestazione intestazione-valutazione">GIUDIZIO</td>
                <td class='intestazione intestazione-note'>NOTE SINGOLA VOCE</td>
            </tr>

        <?php
            $i=0;
            foreach($question['verificheQuestions'] as $domanda):
                $i % 2 == 0 ? $bg = "" : $bg = "odd";
                
                if($k == 2 && $i == 12):
        ?>
        </table>
    </page>

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
                <td class='' style="text-align: left; width: 75%" ><img src="<?= $IMG ?>" style="width: 75%" /></td>
                <td class='' style="text-align:left; width: 25%; padding-top: 5px" >
                    <div class="box-codice">
                        MD 07-10 <br />
                        del <?php echo (new DateTime($model->data))->format('d-m-Y'); ?> <br />
                        rev03
                    </div>
                </td>
            </tr>
            <tr>
                <td class='intro-big' colspan='2' style="padding: 30px 0px ; width: 100% ">Verifica Ispettiva<br />Codice: <?= $model->codice ?></td>
            </tr>
        </table>
        <table style='width:100%;' class="intro-table">    
            <tr>
                <td class='intro-left' >Data Prevista </td>
                <td class='intro-right' ><?php echo (new DateTime($model->data))->format('d-m-Y');?> </td>
            </tr>
            <tr>
                <td class='intro-left' ><?php echo utf8_decode("Unit&agrave; Operativa"); ?>: </td>
                <td class='intro-right' ><?php echo Yii::app()->MyUtils->getSelectValue($model->unita_operativa, 'doc_unita');?></td>
            </tr>
            <tr>
                <td class='intro-left' >Incaricato Verifica </td>
                <td class='intro-right' ><?php echo Yii::app()->MyUtils->getSelectValue($model->incaricato, 'dettaglio_admin');?></td>
            </tr>
            <tr>
                <td class='intro-left' >Tipologia valutazione </td>
                <td class='intro-right' ><?php echo ($model->tipo_valutazione == 'A' ? "Autovalutazione" : "Valutazione");?></td>
            </tr>
            <tr>
                <td class='intro-left' >Data esecuzione </td>
                <td class='intro-right' >Inizio Ore: <?php echo substr($model->ora_inizio, 0, 5); ?> Fine Ore: <?php echo substr($model->ora_fine, 0, 5);?></td>
            </tr>
            <tr>
                <td class='intro-left' >Stato verifica </td>
                <td class='intro-right' >Non conformit&agrave;: <?php //echo $model->getNC($model, $model->tipo_verifica); ?> </td>
            </tr>
        </table>

        <table style="width:100%;margin-top:25px;" cellspacing="0" cellpadding="0">
            <tr class="row-tr">
                <td class="intro-sezione" colspan="2"><?php echo $question['name']; ?></td>
                <td class="intro-nc" style="text-align:right; padding-right: 20px" >NON CONFORMIT&Agrave;:<span class="red"> <?php echo $progress[$question['id']]['nc']; ?></span></td>
            </tr>
            <tr>
                <td class="intestazione intestazione-quesito">PARAMETRO DA VALUTARE</td>
                <td class="intestazione intestazione-valutazione">GIUDIZIO</td>
                <td class='intestazione intestazione-note'>NOTE SINGOLA VOCE</td>
            </tr>
            
            <?php endif; ?>

            <tr class="row-border">
                <td class="intestazione-quesito <?php echo $bg;?>"><?php echo $domanda['question'];?></td>
                <td class="intestazione-valutazione <?php echo $bg;?>"><?php echo VerificheAnswers::getValue($domanda['verificheAnswers'][0]['answer']);?></td>
                <td class="intestazione-note <?php echo $bg;?>" ><?php echo $domanda['verificheAnswers'][0]['note']; ?></td>
            </tr>
            <?php
                $fileNc = isset($domanda['verificheAnswers'][0]['file_nc']) ? $domanda['verificheAnswers'][0]['file_nc'] : '';
                if($fileNc):
                    $ncDir = Yii::app()->basePath . '/data/nc';
                    $ncFilePath = $ncDir . '/' . $fileNc;
                    if(file_exists($ncFilePath)):
                        $isImage = in_array(strtolower(pathinfo($fileNc, PATHINFO_EXTENSION)), array('jpg', 'jpeg', 'png', 'gif'));
            ?>
            <tr>
                <td colspan="3" class="<?php echo $bg;?>" style="padding: 5px 10px;">
                    <?php if($isImage): ?>
                        <img src="<?php echo $ncFilePath; ?>" width="150" height="150" />
                    <?php else: ?>
                        Allegato: <?php echo $fileNc; ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php
                    endif;
                endif;
            ?>
        <?php
            $i++;
            endforeach;
        ?>
        </table>
    </page>
<?php
    $k++;
    endforeach;
?>
              