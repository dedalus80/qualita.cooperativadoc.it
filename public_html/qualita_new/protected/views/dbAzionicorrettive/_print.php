<?
$IMG    = "https://qualita.cooperativadoc.it/qualita_new/images/coopdoc-logo-pdf.png";
?>
<link href="https://qualita.cooperativadoc.it/qualita_new/css/pdf.css" type="text/css" rel="stylesheet"/>  

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
            <td class='intro-big' style="text-align: right; width: 100%" ><img src="<?= $IMG ?>" style="width: 30%" /></td>
        </tr>
        <tr>
            <td class='intro-big' style="padding: 30px 0px ; width: 100% ">Azione correttiva <br />Codice: <?= $model->refer['codice'] ?></td>
        </tr>
    </table>
    <table style='width:100%;' class="intro-table t3070" >    
        <tr>
            <td class='intro-left' >Codice non conformit&agrave; </td>
            <td class='intro-right' ><?= $model->refer['codice'] ?> </td>
        </tr>
        <tr>
            <td class='intro-left' >Data inserimento </td>
            <td class='intro-right' ><?= Yii::app()->MyUtils->getItaDate($model->data, "") ?> </td>
        </tr>
        <tr>
            <td class='intro-left' >Data aggiornamento </td>
            <td class='intro-right' ><?= Yii::app()->MyUtils->getItaDate($model->data_aggiornamento, "") ?></td>
        </tr>
        <tr>
            <td class='intro-left' >Descrizione </td>
            <td class='intro-right' ><?= wordwrap(utf8_decode($model->refer['descrizione']), 70, "<br />",true); ?></td>
        </tr>
        <tr>
            <td class='intro-left' >Trattamento </td>
            <td class='intro-right' ><?= wordwrap(utf8_decode($model->refer['trattamento']), 70, "<br />",true); ?></td>
        </tr>
    </table>
     <table style='width:100%; margin-top: 25px;'  cellspacing="0" cellpadding="0" class="default-table t3070">
        <tr>
            <td class='intro-left odd' >Data Azione </td>
            <td class='intro-right odd' ><?= Yii::app()->MyUtils->reverseDate($model->data_az) ?> </td>
        </tr>
        <tr>
            <td class='intro-left ' >Codice NC </td>
            <td class='intro-right ' ><?= $model->codice_riferimento ?> </td>
        </tr>
        <tr>
            <td class='intro-left odd' >Tipo Azione </td>
            <td class='intro-right odd' ><?=  Yii::app()->MyUtils->getSelectValue($model->tipo_azione, "doc_azione") ?></td>
        </tr>
        <tr>
            <td class='intro-left ' >Unit&agrave; Operativa </td>
            <td class='intro-right ' ><?= Yii::app()->MyUtils->getSelectValue($model->unita_operativa, "doc_unita") ?></td>
        </tr>
        <tr>
            <td class='intro-left odd' >Societ&agrave; </td>
            <td class='intro-right odd' ><?= Yii::app()->MyUtils->getSelectValue($model->societa, "doc_societa") ?></td>
        </tr>
        <tr>
            <td class='intro-left ' >Nome </td>
            <td class='intro-right ' ><?= $model->nome ?> </td>
        </tr>
        <tr>
            <td class='intro-left odd' >Cognome </td>
            <td class='intro-right odd' > <?= $model->cognome ?> </td>
        </tr>
        <tr>
            <td class='intro-left ' >Funzione </td>
            <td class='intro-right ' > <?= Yii::app()->MyUtils->getSelectValue($model->funzione, "doc_funzione") ?> </td>
        </tr>
        <tr>
            <td class='intro-left odd' >tipologia </td>
            <td class='intro-right odd' ><?= Yii::app()->MyUtils->getSelectValue($model->tipologia, "doc_tipologie_aperture") ?> </td>
        </tr>
        <tr>
            <td class='intro-left ' >Scadenza </td>
            <td class='intro-right ' ><?= Yii::app()->MyUtils->reverseDate($model->descrizione) ?>  </td>
        </tr>
        <tr>
            <td class='intro-left odd' >Descrizione </td>
            <td class='intro-right odd' > <?= wordwrap(utf8_decode($model->trattamento), 70, "<br />",true); ?> </td>
        </tr>
         <tr>
            <td class='intro-left ' >Allegato </td>
            <td class='intro-right ' ><?= $model->allegato ?> </td>
        </tr>
    </table>
</page>
