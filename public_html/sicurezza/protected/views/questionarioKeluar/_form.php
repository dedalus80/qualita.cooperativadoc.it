<script>
    
    function updateStruttura(){
        
        var anno =    document.getElementById('anni').options[document.getElementById('anni').selectedIndex].value;
        var mese = document.getElementById('mesi').options[document.getElementById('mesi').selectedIndex].value;
        if(anno !=0 && mese!=0)
            var periodo = anno+"-"+mese
        else
            var periodo ='';
        
        var struttura = document.getElementById('struttura_nome').options[document.getElementById('struttura_nome').selectedIndex].value;
        
        window.location.href = 'http://qualita.cooperativadoc.it/qualita/index.php/questionarioKeluar/create/id/'+struttura+'/periodo/'+periodo;
    }
    
</script>

<?

$periodo = $_REQUEST['periodo'];
$data = explode("-",$periodo);

foreach ($model->attributes as $id => $val)
    $stats[$id] = $model->getStats($id, $struttura, $periodo);

$strutture = $model->getStrutture();
$consiglia = $model->getConsiglia($model->attributes['consiglia'], $struttura ? $struttura : "", $periodo);

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
            <td class="white "><?= $stats["viaggio_complessivo"]['E'] . "" . $stats["viaggio_complessivo"]['Eper'] ?></td>
            <td class="white "><?= $stats["viaggio_complessivo"]['B'] . "" . $stats["viaggio_complessivo"]['Bper'] ?></td>
            <td class="white "><?= $stats["viaggio_complessivo"]['S'] . "" . $stats["viaggio_complessivo"]['Sper'] ?></td>
            <td class="white "><?= $stats["viaggio_complessivo"]['I'] . "" . $stats["viaggio_complessivo"]['Iper'] ?></td>
        </tr>
        <tr class="">
            <td class="grey text-left">I RAPPORTI CON LA STRUTTURA KELUAR</td>
            <td class="grey "><?= $stats["rapporto_keluar"]['E'] . "" . $stats["rapporto_keluar"]['Eper'] ?></td>
            <td class="grey "><?= $stats["rapporto_keluar"]['B'] . "" . $stats["rapporto_keluar"]['Bper'] ?></td>
            <td class="grey "><?= $stats["rapporto_keluar"]['S'] . "" . $stats["rapporto_keluar"]['Sper'] ?></td>
            <td class="grey "><?= $stats["rapporto_keluar"]['I'] . "" . $stats["rapporto_keluar"]['Iper'] ?></td>
        </tr>
        <tr class="greyblu text-left"> 
            <td colspan="5" class="greyblu text-left">IL TRASPORTO</td> 
        </tr>

        <tr>
            <td class="white  text-left">Qualit&agrave; del vettore</td>
            <td class="white "><?= $stats["trasporto_qualita"]['E'] . "" . $stats["trasporto_qualita"]['Eper'] ?></td>
            <td class="white "><?= $stats["trasporto_qualita"]['B'] . "" . $stats["trasporto_qualita"]['Bper'] ?></td>
            <td class="white "><?= $stats["trasporto_qualita"]['S'] . "" . $stats["trasporto_qualita"]['Sper'] ?></td>
            <td class="white "><?= $stats["trasporto_qualita"]['I'] . "" . $stats["trasporto_qualita"]['Iper'] ?></td>

        </tr>
        <tr>
            <td class="grey  text-left">Cortesia degli operatori</td>
            <td class="grey "><?= $stats["trasporto_cortesia"]['E'] . "" . $stats["trasporto_cortesia"]['Eper'] ?></td>
            <td class="grey "><?= $stats["trasporto_cortesia"]['B'] . "" . $stats["trasporto_cortesia"]['Bper'] ?></td>
            <td class="grey "><?= $stats["trasporto_cortesia"]['S'] . "" . $stats["trasporto_cortesia"]['Sper'] ?></td>
            <td class="grey "><?= $stats["trasporto_cortesia"]['I'] . "" . $stats["trasporto_cortesia"]['Iper'] ?></td>

        </tr>
        <tr>
            <td class="white  text-left">Rispetto dei tempi di viaggio previsti</td>
            <td class="white "><?= $stats["trasporto_tempi"]['E'] . "" . $stats["trasporto_tempi"]['Eper'] ?></td>
            <td class="white "><?= $stats["trasporto_tempi"]['B'] . "" . $stats["trasporto_tempi"]['Bper'] ?></td>
            <td class="white "><?= $stats["trasporto_tempi"]['S'] . "" . $stats["trasporto_tempi"]['Sper'] ?></td>
            <td class="white "><?= $stats["trasporto_tempi"]['I'] . "" . $stats["trasporto_tempi"]['Iper'] ?></td>

        </tr>

        <tr class="greyblu text-left"> 
            <td colspan="5" class="greyblu text-left">LA STRUTTURA</td> 
        </tr>

        <tr>
            <td class="white  text-left">GIUDIZIO COMPLESSIVO</td>
            <td class="white "><?= $stats["struttura_complessivo"]['E'] . "" . $stats["struttura_complessivo"]['Eper'] ?></td>
            <td class="white "><?= $stats["struttura_complessivo"]['B'] . "" . $stats["struttura_complessivo"]['Bper'] ?></td>
            <td class="white "><?= $stats["struttura_complessivo"]['S'] . "" . $stats["struttura_complessivo"]['Sper'] ?></td>
            <td class="white "><?= $stats["struttura_complessivo"]['I'] . "" . $stats["struttura_complessivo"]['Iper'] ?></td>

        </tr>

        <tr>
            <td colspan="5" class="greyblu text-left">LA CAMERA</td>
        </tr>
        <tr>
            <td class="white  text-left">Confort</td>
            <td class="white "><?= $stats["camera_confort"]['E'] . "" . $stats["camera_confort"]['Eper'] ?></td>
            <td class="white "><?= $stats["camera_confort"]['B'] . "" . $stats["camera_confort"]['Bper'] ?></td>
            <td class="white "><?= $stats["camera_confort"]['S'] . "" . $stats["camera_confort"]['Sper'] ?></td>
            <td class="white "><?= $stats["camera_confort"]['I'] . "" . $stats["camera_confort"]['Iper'] ?></td>

        </tr>
        <tr>
            <td class="grey  text-left">Pulizia</td>
            <td class="grey "><?= $stats["camera_pulizia"]['E'] . "" . $stats["camera_pulizia"]['Eper'] ?></td>
            <td class="grey "><?= $stats["camera_pulizia"]['B'] . "" . $stats["camera_pulizia"]['Bper'] ?></td>
            <td class="grey "><?= $stats["camera_pulizia"]['S'] . "" . $stats["camera_pulizia"]['Sper'] ?></td>
            <td class="grey "><?= $stats["camera_pulizia"]['I'] . "" . $stats["camera_pulizia"]['Iper'] ?></td>

        </tr>

        <tr>
            <td colspan="5" class="greyblu text-left">IL RISTORANTE</td>
        </tr>
        <tr>
            <td class="white  text-left">Servizio</td>
            <td class="white "><?= $stats["ristorante_servizio"]['E'] . "" . $stats["ristorante_servizio"]['Eper'] ?></td>
            <td class="white "><?= $stats["ristorante_servizio"]['B'] . "" . $stats["ristorante_servizio"]['Bper'] ?></td>
            <td class="white "><?= $stats["ristorante_servizio"]['S'] . "" . $stats["ristorante_servizio"]['Sper'] ?></td>
            <td class="white "><?= $stats["ristorante_servizio"]['I'] . "" . $stats["ristorante_servizio"]['Iper'] ?></td>

        </tr>

        <tr>
            <td class="grey text-left ">Qualit&agrave; del cibo</td>
            <td class="grey "><?= $stats["ristorante_cibo"]['E'] . "" . $stats["ristorante_cibo"]['Eper'] ?></td>
            <td class="grey "><?= $stats["ristorante_cibo"]['B'] . "" . $stats["ristorante_cibo"]['Bper'] ?></td>
            <td class="grey "><?= $stats["ristorante_cibo"]['S'] . "" . $stats["ristorante_cibo"]['Sper'] ?></td>
            <td class="grey "><?= $stats["ristorante_cibo"]['I'] . "" . $stats["ristorante_cibo"]['Iper'] ?></td>

        </tr>
        <tr>
            <td class="white text-left ">Variet&agrave; del men&ugrave;</td>
            <td class="white "><?= $stats["ristorante_menu"]['E'] . "" . $stats["ristorante_menu"]['Eper'] ?></td>
            <td class="white "><?= $stats["ristorante_menu"]['B'] . "" . $stats["ristorante_menu"]['Bper'] ?></td>
            <td class="white "><?= $stats["ristorante_menu"]['S'] . "" . $stats["ristorante_menu"]['Sper'] ?></td>
            <td class="white "><?= $stats["ristorante_menu"]['I'] . "" . $stats["ristorante_menu"]['Iper'] ?></td>

        </tr>
        <tr>
            <td colspan="5" class="greyblu text-left">IL PERSONALE</td> 
        </tr>
        <tr>
            <td class="white  text-left">Cortesia</td>
            <td class="white "><?= $stats["personale_cortesia"]['E'] . "" . $stats["personale_cortesia"]['Eper'] ?></td>
            <td class="white "><?= $stats["personale_cortesia"]['B'] . "" . $stats["personale_cortesia"]['Bper'] ?></td>
            <td class="white "><?= $stats["personale_cortesia"]['S'] . "" . $stats["personale_cortesia"]['Sper'] ?></td>
            <td class="white "><?= $stats["personale_cortesia"]['I'] . "" . $stats["personale_cortesia"]['Iper'] ?></td>

        </tr>
        <tr>
            <td class="grey  text-left">Disponibilit&agrave;</td>
            <td class="grey "><?= $stats["personale_disponibilita"]['E'] . "" . $stats["personale_disponibilita"]['Eper'] ?></td>
            <td class="grey "><?= $stats["personale_disponibilita"]['B'] . "" . $stats["personale_disponibilita"]['Bper'] ?></td>
            <td class="grey "><?= $stats["personale_disponibilita"]['S'] . "" . $stats["personale_disponibilita"]['Sper'] ?></td>
            <td class="grey "><?= $stats["personale_disponibilita"]['I'] . "" . $stats["personale_disponibilita"]['Iper'] ?></td>
        </tr>




        <tr>
            <td colspan="5" class="greyblu text-left">LE ESCURSIONI</td> 
        </tr>
        <tr>
            <td class="white  text-left">Itinerari</td>
            <td class="white "><?= $stats["escursioni_itinerari"]['E'] . "" . $stats["escursioni_itinerari"]['Eper'] ?></td>
            <td class="white "><?= $stats["escursioni_itinerari"]['B'] . "" . $stats["escursioni_itinerari"]['Bper'] ?></td>
            <td class="white "><?= $stats["escursioni_itinerari"]['S'] . "" . $stats["escursioni_itinerari"]['Sper'] ?></td>
            <td class="white "><?= $stats["escursioni_itinerari"]['I'] . "" . $stats["escursioni_itinerari"]['Iper'] ?></td>

        </tr>
        <tr>
            <td class="grey  text-left">Servizio guida turistica di accompagnamento</td>
            <td class="grey "><?= $stats["personale_disponibilita"]['E'] . "" . $stats["personale_disponibilita"]['Eper'] ?></td>
            <td class="grey "><?= $stats["personale_disponibilita"]['B'] . "" . $stats["personale_disponibilita"]['Bper'] ?></td>
            <td class="grey "><?= $stats["personale_disponibilita"]['S'] . "" . $stats["personale_disponibilita"]['Sper'] ?></td>
            <td class="grey "><?= $stats["personale_disponibilita"]['I'] . "" . $stats["personale_disponibilita"]['Iper'] ?></td>
        </tr>
        <tr>
            <td colspan="5" class="greyblu text-left">LE ATTIVIT&Agrave; SULLA NEVE</td> 
        </tr>
        <tr>
            <td class="white  text-left">Noleggio attrezzature</td>
            <td class="white "><?= $stats["neve_noleggio"]['E'] . "" . $stats["neve_noleggio"]['Eper'] ?></td>
            <td class="white "><?= $stats["neve_noleggio"]['B'] . "" . $stats["neve_noleggio"]['Bper'] ?></td>
            <td class="white "><?= $stats["neve_noleggio"]['S'] . "" . $stats["neve_noleggio"]['Sper'] ?></td>
            <td class="white "><?= $stats["neve_noleggio"]['I'] . "" . $stats["neve_noleggio"]['Iper'] ?></td>

        </tr>
        <tr>
            <td class="grey  text-left">Scuola sci&agrave;</td>
            <td class="grey "><?= $stats["neve_scuola"]['E'] . "" . $stats["neve_scuola"]['Eper'] ?></td>
            <td class="grey "><?= $stats["neve_scuola"]['B'] . "" . $stats["neve_scuola"]['Bper'] ?></td>
            <td class="grey "><?= $stats["neve_scuola"]['S'] . "" . $stats["neve_scuola"]['Sper'] ?></td>
            <td class="grey "><?= $stats["neve_scuola"]['I'] . "" . $stats["neve_scuola"]['Iper'] ?></td>
        </tr>

        <tr>
            <td colspan="5" class="greyblu text-left">LE ATTIVIT&Agrave; DI LABORATORIO</td> 
        </tr>
        <tr>
            <td class="white  text-left">Competenza dei tecnici</td>
            <td class="white "><?= $stats["laboratori_tecnici"]['E'] . "" . $stats["laboratori_tecnici"]['Eper'] ?></td>
            <td class="white "><?= $stats["laboratori_tecnici"]['B'] . "" . $stats["laboratori_tecnici"]['Bper'] ?></td>
            <td class="white "><?= $stats["laboratori_tecnici"]['S'] . "" . $stats["laboratori_tecnici"]['Sper'] ?></td>
            <td class="white "><?= $stats["laboratori_tecnici"]['I'] . "" . $stats["laboratori_tecnici"]['Iper'] ?></td>

        </tr>
        <tr>
            <td class="grey  text-left">Acquisizione di nuove competenze</td>
            <td class="grey "><?= $stats["laboratori_competenze"]['E'] . "" . $stats["laboratori_competenze"]['Eper'] ?></td>
            <td class="grey "><?= $stats["laboratori_competenze"]['B'] . "" . $stats["laboratori_competenze"]['Bper'] ?></td>
            <td class="grey "><?= $stats["laboratori_competenze"]['S'] . "" . $stats["laboratori_competenze"]['Sper'] ?></td>
            <td class="grey "><?= $stats["laboratori_competenze"]['I'] . "" . $stats["laboratori_competenze"]['Iper'] ?></td>
        </tr>
        <tr>
            <td colspan="5" class="greyblu text-left">CONSIGLIEREBBE UNA VACANZA AI SUOI CONOSCENTI E/O PARENTI?</td>
        </tr>
        <tr>
            <td class="white  text-left">Certamente si</td>
            <td class="white "><?= $consiglia['S'] . "" . $consiglia['Sper'] ?></td>
            <td colspan="3" class="white "></td>
        </tr>
        <tr>
            <td class="grey  text-left">Non so , forse</td>
            <td class="grey "><?= $consiglia['F'] . "" . $consiglia['Fper'] ?></td>
            <td colspan="3" class="grey "></td>
        </tr>
        <tr>
            <td class="white  text-left border_b">Certamente no</td>
            <td class="white border_b"><?= $consiglia['N'] . "" . $consiglia['Nper'] ?></td>
            <td colspan="3" class="white border_b"></td>
        </tr>

    </table>

</div>