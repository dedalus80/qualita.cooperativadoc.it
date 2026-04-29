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
            <td class='intro-big' style="text-align: right; width: 100%" ><img src="<?= $IMG?> " style="width: 30%" /></td>
        </tr>
        <tr>
            <td class='intro-big' style="padding: 30px 0px ; width: 100% ">Azione Non Conforme<br />Codice: <?= $model->codice ?></td>
        </tr>
    </table>
    <table style='width:100%; margin-top: 25px;'  cellspacing="0" cellpadding="0" class="default-table t3070">
        <tr>
            <td class='intro-left odd' >Data </td>
            <td class='intro-right odd' ><?= Yii::app()->MyUtils->getItaDate($model->data_nc,"") ?> </td>
        </tr>
        <tr>
            <td class='intro-left ' >Nome </td>
            <td class='intro-right ' ><?= $model->nome ?></td>
        </tr>
        <tr>
            <td class='intro-left odd' >Cognome </td>
            <td class='intro-right odd' ><?= $model->cognome ?></td>
        </tr>
        <tr>
            <td class='intro-left ' >Struttura </td>
            <td class='intro-right ' > <?= Yii::app()->MyUtils->getSelectValue($model->unita_operativa, "doc_unita") ?> </td>
        </tr>
        <tr>
            <td class='intro-left odd' >Societ&agrave; </td>
            <td class='intro-right odd' > <?= Yii::app()->MyUtils->getSelectValue($model->societa, "doc_societa") ?> </td>
        </tr>
        <tr>
            <td class='intro-left ' >Funzione </td>
            <td class='intro-right ' > <?= Yii::app()->MyUtils->getSelectValue($model->funzione, "doc_funzione") ?> </td>
        </tr>
        <tr>
            <td class='intro-left odd' >Tipo non conformit&agrave; </td>
            <td class='intro-right odd' > <?= Yii::app()->MyUtils->getSelectValue($model->tipologia, "doc_tipologie_aperture") ?> </td>
        </tr>
        <tr>
            <td class='intro-left ' >Responsabile </td>
            <td class='intro-right ' > <?= Yii::app()->MyUtils->getSelectValue($model->responsabile, "doc_responsabile") ?> </td>
        </tr>
        <tr>
            <td class='intro-left odd' >Descrizione </td>
            <td class='intro-right odd'> <?= wordwrap(utf8_decode($model->descrizione), 70, "<br />",true); ?> </td>
        </tr>
        <tr>
            <td class='intro-left ' >Trattamento </td>
            <td class='intro-right ' > <?= wordwrap(utf8_decode($model->trattamento), 70, "<br />",true); ?> </td>
        </tr>
        <tr>
            <td class='intro-left odd' >Trattamento accettato</td>
            <td class='intro-right odd' > <?= $model->trattamento_accettato =='Y' ? "Si":"No" ?> </td>
        </tr>
         <tr>
            <td class='intro-left ' >Apertura non conformit&agrave;</td>
            <td class='intro-right ' > <?= $model->apertura_ac =='Y' ? "Si":"No" ?> </td>
        </tr>
        <tr>
            <td class='intro-left odd' >Note </td>
            <td class='intro-right odd' > <?= wordwrap(utf8_decode($model->trattamento_note), 70, "<br />",true); ?> </td>
        </tr>
        <tr>
            <td class='intro-left ' >Allegato </td>
            <td class='intro-right ' > <?= $model->allegato ?> </td>
        </tr>
        <tr>
            <td class='intro-left ' >Foto </td>
            <td class='intro-right ' > <?= $model->getPicture(true) ?> </td>
        </tr>
        <tr>
            <td class='intro-left ' >Chiusura </td>
             <td class='intro-right ' > <?= Yii::app()->MyUtils->getSelectValue($model->chiusura, "doc_chiusura") ?> </td>
        </tr>
  </table>
</page>
