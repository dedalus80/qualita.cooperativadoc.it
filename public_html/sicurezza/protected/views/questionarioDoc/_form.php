<script>
    
    function updateStruttura(){
        
        var anno =    document.getElementById('anni').options[document.getElementById('anni').selectedIndex].value;
        var mese = document.getElementById('mesi').options[document.getElementById('mesi').selectedIndex].value;
        if(anno !=0 && mese!=0)
            var periodo = anno+"-"+mese
        else
            var periodo ='';
        
        var struttura = document.getElementById('struttura_nome').options[document.getElementById('struttura_nome').selectedIndex].value;
        
        window.location.href = 'http://qualita.cooperativadoc.it/qualita/index.php/questionarioDoc/create/id/'+struttura+'/periodo/'+periodo;
    }
    
</script>
<?php

$periodo = $_REQUEST['periodo'];
$data = explode("-",$periodo);

/* @var $this QuestionarioDocController */
/* @var $model QuestionarioDoc */
/* @var $form CActiveForm */


foreach ($model->attributes as $id => $val)
    $stats[$id] = $model->getStats($id,$struttura,$periodo);

$strutture = $model->getStrutture();
$consiglia = $model->getConsiglia($model->attributes['consiglia'],$struttura? $struttura:"", $periodo);


$mesi = array("0" => "Segli", "01" => "Gennaio", "02" => "Febbraio", "03" => "Marzo", "04" => "Aprile", "05" => "Maggio", "06" => "Giugno", "07" => "Luglio", "08" => "Agosto", "09" => "Settembre", 10 => "Ottobre", 11 => "Novembre", 12 => "Dicembre");

?>
<div id='stats'>
    <table cellspacing='0' cellpadding='0'>

        <tr>
            <td class="grey  text-left" colspan="5" style="border-top: #CCC 1px solid">
                <br>
                Periodo&nbsp;&nbsp;
                <select name="mesi" id="mesi"  class="myslim">
                    <?
                    foreach ($mesi as $id => $value){
                        
                        if($id == $data[1])
                            $sel_m[$id] = "selected='selected' ";
                        
                        echo "<option value='" . $id . "' ".$sel_m[$id]." >" . $value . "</option>";
                    }
                    ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;
                <select name="anni" id="anni"  class="myslim" >
                    <option value='0'>Scegli</option>
                    <?
                    for ($x = 2013; $x < 2020; $x++){
                        
                       if($x==$data[0])
                            $sel_a[$x] = "selected='selected' ";
                        
                        echo "<option value='" . $x . "' ".$sel_a[$x]."   >" . $x . "</option>";
                    }
                    ?>
                </select>
                <br>
                <div style='margin:5px 0px 5px 0px'>
                    Struttura

                    <select name ='struttura_nome' id="struttura_nome" class='' onChange='javascript:updateStruttura()' >
                        <option value ='0' >Scegli</option>
                        <? foreach ($strutture as $id => $val) { ?>
                            <option  value='<?= $id ?>' <?= $id == $struttura ? "selected='selected'" : "" ?>> <?= $val ?></option>
                        <? } ?>
                    </select>
                </div>
            </td>
        </tr>

        <tr>
            <td class="blue big  text-left noborder ">QUESITO</td>
            <td class="blue-clear noborder">ECCELLENTE</td>
            <td class="blue noborder">BUONO</td> 
            <td class="blue-clear noborder">SUFFICIENTE</td>
            <td class="blue noborder">INSUFFICIENTE</td>
        </tr>
        <tr class="greyblu text-left"> 
            <td colspan="5" class="greyblu text-left">LA VACANZA</td>
        </tr>
        <tr class="">
            <td class=" text-left">GIUDIZIO COMPLESSIVO</td>
            <td class="white "><?= $stats["vacanza"]['E'] . "" . $stats["vacanza"]['Eper']  ?></td>
            <td class="white "><?= $stats["vacanza"]['B'] . "" . $stats["vacanza"]['Bper']  ?></td>
            <td class="white "><?= $stats["vacanza"]['S'] . "" . $stats["vacanza"]['Sper']  ?></td>
            <td class="white "><?= $stats["vacanza"]['I'] . "" . $stats["vacanza"]['Iper']  ?></td>
        </tr>
         <tr class="greyblu text-left"> 
            <td colspan="5" class="greyblu text-left">LA STRUTTURA</td> 
        </tr>
        <tr>
            <td class="white  text-left">Pulizia degli ambienti</td>
            <td class="white "><?= $stats["struttura_pulizia"]['E'] . "" . $stats["struttura_pulizia"]['Eper']  ?></td>
            <td class="white "><?= $stats["struttura_pulizia"]['B'] . "" . $stats["struttura_pulizia"]['Bper']  ?></td>
            <td class="white "><?= $stats["struttura_pulizia"]['S'] . "" . $stats["struttura_pulizia"]['Sper']  ?></td>
            <td class="white "><?= $stats["struttura_pulizia"]['I'] . "" . $stats["struttura_pulizia"]['Iper']  ?></td>
        </tr>

        <tr>
            <td class="grey  text-left">GIUDIZIO COMPLESSIVO</td>
            <td class="grey "><?= $stats["struttura_complessivo"]['E'] . "" . $stats["struttura_complessivo"]['Eper']  ?></td>
            <td class="grey "><?= $stats["struttura_complessivo"]['B'] . "" . $stats["struttura_complessivo"]['Bper']  ?></td>
            <td class="grey "><?= $stats["struttura_complessivo"]['S'] . "" . $stats["struttura_complessivo"]['Sper']  ?></td>
            <td class="grey "><?= $stats["struttura_complessivo"]['I'] . "" . $stats["struttura_complessivo"]['Iper']  ?></td>

        </tr>

        <tr>
            <td colspan="5" class="greyblu text-left">LA CAMERA</td>
        </tr>
        <tr>
            <td class="white  text-left">Confort</td>
            <td class="white "><?= $stats["stanza_confort"]['E'] . "" . $stats["stanza_confort"]['Eper']  ?></td>
            <td class="white "><?= $stats["stanza_confort"]['B'] . "" . $stats["stanza_confort"]['Bper']  ?></td>
            <td class="white "><?= $stats["stanza_confort"]['S'] . "" . $stats["stanza_confort"]['Sper']  ?></td>
            <td class="white "><?= $stats["stanza_confort"]['I'] . "" . $stats["stanza_confort"]['Iper']  ?></td>

        </tr>
        <tr>
            <td class="grey  text-left">Qualit&agrave; degli arredi</td>
            <td class="grey "><?= $stats["stanza_arredi"]['E'] . "" . $stats["stanza_arredi"]['Eper']  ?></td>
            <td class="grey "><?= $stats["stanza_arredi"]['B'] . "" . $stats["stanza_arredi"]['Bper']  ?></td>
            <td class="grey "><?= $stats["stanza_arredi"]['S'] . "" . $stats["stanza_arredi"]['Sper']  ?></td>
            <td class="grey "><?= $stats["stanza_arredi"]['I'] . "" . $stats["stanza_arredi"]['Iper']  ?></td>

        </tr>
        <tr>
            <td class="white  text-left">Pulizia del locale</td>
            <td class="white "><?= $stats["stanza_pulizia"]['E'] . "" . $stats["stanza_pulizia"]['Eper']  ?></td>
            <td class="white "><?= $stats["stanza_pulizia"]['B'] . "" . $stats["stanza_pulizia"]['Bper']  ?></td>
            <td class="white "><?= $stats["stanza_pulizia"]['S'] . "" . $stats["stanza_pulizia"]['Sper']  ?></td>
            <td class="white "><?= $stats["stanza_pulizia"]['I'] . "" . $stats["stanza_pulizia"]['Iper']  ?></td>

        </tr>
        <tr>
            <td class="grey  text-left">GIUDIZIO COMPLESSIVO</td>
            <td class="grey "><?= $stats["stanza_complessivo"]['E'] . "" . $stats["stanza_complessivo"]['Eper']  ?></td>
            <td class="grey "><?= $stats["stanza_complessivo"]['B'] . "" . $stats["stanza_complessivo"]['Bper']  ?></td>
            <td class="grey "><?= $stats["stanza_complessivo"]['S'] . "" . $stats["stanza_complessivo"]['Sper']  ?></td>
            <td class="grey "><?= $stats["stanza_complessivo"]['I'] . "" . $stats["stanza_complessivo"]['Iper']  ?></td>

        </tr>
        <tr>
            <td colspan="5" class="greyblu text-left">IL RISTORANTE</td>
        </tr>
        <tr>
            <td class="white  text-left">Servizio</td>
            <td class="white "><?= $stats["ristorante_servizio"]['E'] . "" . $stats["ristorante_servizio"]['Eper']  ?></td>
            <td class="white "><?= $stats["ristorante_servizio"]['B'] . "" . $stats["ristorante_servizio"]['Bper']  ?></td>
            <td class="white "><?= $stats["ristorante_servizio"]['S'] . "" . $stats["ristorante_servizio"]['Sper']  ?></td>
            <td class="white "><?= $stats["ristorante_servizio"]['I'] . "" . $stats["ristorante_servizio"]['Iper']  ?></td>

        </tr>
        <tr>
            <td class="grey text-left ">Tempi di attesa</td>
            <td class="grey "><?= $stats["ristorante_attesa"]['E'] . "" . $stats["ristorante_attesa"]['Eper']  ?></td>
            <td class="grey "><?= $stats["ristorante_attesa"]['B'] . "" . $stats["ristorante_attesa"]['Bper']  ?></td>
            <td class="grey "><?= $stats["ristorante_attesa"]['S'] . "" . $stats["ristorante_attesa"]['Sper']  ?></td>
            <td class="grey "><?= $stats["ristorante_attesa"]['I'] . "" . $stats["ristorante_attesa"]['Iper']  ?></td>

        </tr>
        <tr>
            <td class="white text-left ">Qualit&agrave; del cibo</td>
            <td class="white "><?= $stats["ristorante_cibo"]['E'] . "" . $stats["ristorante_cibo"]['Eper']  ?></td>
            <td class="white "><?= $stats["ristorante_cibo"]['B'] . "" . $stats["ristorante_cibo"]['Bper']  ?></td>
            <td class="white "><?= $stats["ristorante_cibo"]['S'] . "" . $stats["ristorante_cibo"]['Sper']  ?></td>
            <td class="white "><?= $stats["ristorante_cibo"]['I'] . "" . $stats["ristorante_cibo"]['Iper']  ?></td>

        </tr>
        <tr>
            <td class="grey text-left ">Variet&agrave; del men&ugrave;</td>
            <td class="grey "><?= $stats["ristorante_menu"]['E'] . "" . $stats["ristorante_menu"]['Eper']  ?></td>
            <td class="grey "><?= $stats["ristorante_menu"]['B'] . "" . $stats["ristorante_menu"]['Bper']  ?></td>
            <td class="grey "><?= $stats["ristorante_menu"]['S'] . "" . $stats["ristorante_menu"]['Sper']  ?></td>
            <td class="grey "><?= $stats["ristorante_menu"]['I'] . "" . $stats["ristorante_menu"]['Iper']  ?></td>

        </tr>
        <tr>
            <td class="white text-left ">GIUDIZIO COMPLESSIVO</td>
            <td class="white "><?= $stats["ristorante_complessivo"]['E'] . "" . $stats["ristorante_complessivo"]['Eper']  ?></td>
            <td class="white "><?= $stats["ristorante_complessivo"]['B'] . "" . $stats["ristorante_complessivo"]['Bper']  ?></td>
            <td class="white "><?= $stats["ristorante_complessivo"]['S'] . "" . $stats["ristorante_complessivo"]['Sper']  ?></td>
            <td class="white "><?= $stats["ristorante_complessivo"]['I'] . "" . $stats["ristorante_complessivo"]['Iper']  ?></td>

        </tr>
        <tr>
            <td colspan="5" class="greyblu text-left">IL PERSONALE</td> 
        </tr>
        <tr>
            <td class="white  text-left">Cortesia</td>
            <td class="white "><?= $stats["personale_cortesia"]['E'] . "" . $stats["personale_cortesia"]['Eper']  ?></td>
            <td class="white "><?= $stats["personale_cortesia"]['B'] . "" . $stats["personale_cortesia"]['Bper']  ?></td>
            <td class="white "><?= $stats["personale_cortesia"]['S'] . "" . $stats["personale_cortesia"]['Sper']  ?></td>
            <td class="white "><?= $stats["personale_cortesia"]['I'] . "" . $stats["personale_cortesia"]['Iper']  ?></td>

        </tr>
        <tr>
            <td class="grey  text-left">Professionalit&agrave;</td>
            <td class="grey "><?= $stats["personale_professionalita"]['E'] . "" . $stats["personale_professionalita"]['Eper']  ?></td>
            <td class="grey "><?= $stats["personale_professionalita"]['B'] . "" . $stats["personale_professionalita"]['Bper']  ?></td>
            <td class="grey "><?= $stats["personale_professionalita"]['S'] . "" . $stats["personale_professionalita"]['Sper']  ?></td>
            <td class="grey "><?= $stats["personale_professionalita"]['I'] . "" . $stats["personale_professionalita"]['Iper']  ?></td>
        </tr>
        <tr>
            <td class="white  text-left">GIUDIZIO COMPLESSIVO</td>
            <td class="white "><?= $stats["personale_complessivo"]['E'] . "" . $stats["personale_complessivo"]['Eper']  ?></td>
            <td class="white "><?= $stats["personale_complessivo"]['B'] . "" . $stats["personale_complessivo"]['Bper']  ?></td>
            <td class="white "><?= $stats["personale_complessivo"]['S'] . "" . $stats["personale_complessivo"]['Sper']  ?></td>
            <td class="white "><?= $stats["personale_complessivo"]['I'] . "" . $stats["personale_complessivo"]['Iper']  ?></td>
        </tr>
        <tr>
            <td colspan="5" class="greyblu text-left">CONSIGLIEREBBE UNA VACANZA AI SUOI CONOSCENTI E/O PARENTI?</td>
        </tr>
        <tr>
            <td class="white  text-left">Certamente si</td>
            <td class="white "><?= $consiglia['S'] . "" . $consiglia['Sper']  ?></td>
            <td colspan="3" class="white "></td>
        </tr>
        <tr>
            <td class="grey  text-left">Non so , forse</td>
            <td class="grey "><?= $consiglia['F'] . "" . $consiglia['Fper']  ?></td>
            <td colspan="3" class="grey "></td>
        </tr>
        <tr>
            <td class="white  text-left border_b">Certamente no</td>
            <td class="white border_b"><?= $consiglia['N'] . "" . $consiglia['Nper']  ?></td>
            <td colspan="3" class="white border_b"></td>
        </tr>

    </table>

</div>
