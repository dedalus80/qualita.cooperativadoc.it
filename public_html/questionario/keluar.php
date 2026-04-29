<?
include("../lib/class-db.php");


$db = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true);
$strutture = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_unita WHERE id NOT IN ('21','22','23','24')"));
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Questionario qualita</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="it" />
        <link rel="stylesheet" type="text/css" href="../qualita/css/main.css" />
        <link rel="stylesheet" type="text/css" href="../qualita/css/form.css" />
        <link rel="stylesheet" type="text/css" href="../qualita/css/custom.css" />
        <script language="javascript" type="text/javascript" src="../js/functions.js"></script>
    </head>
    <body>
         <div id="q-page">
            <div id="questionario">
                <form id='questionario-keluar' method='POST' name='questionario-keluar' action='https://qualita.cooperativadoc.it/questionario/response.php'>
                    <input type="hidden" name="from" id="from" value='K' />
                    <div id="quest-logo"><img src="https://qualita.cooperativadoc.it/img/qu-keluar.png" /></div>
                    <div id="quest-sede">
                        <div class="red sede-desc">SEDE OPERATIVA DI:</div>
                        <div class="grey"><input type="text" class='input-full' name="sede_operativa" id="sede_operativa" /></div>
                    </div>
                    <div class='clear'></div>
                    <div class="intro-text">
                        <p>Gentile Cliente,<br>
                            ringraziandola di averci scelto, le chiediamo di aiutarci a comprendere quanto &egrave; soddifatto del soggiorno presso la nostra struttura. Le vorremmo perci&ograve; chiedere di dedicare qualche minuto per rispondere ad alcune domande contenute nel presente questionario.
                            La Sua opinione sar&agrave; importante per aiutarci a realizzare in futuro un servizio migliore. Grazie</p>
                    </div>
                    <table cellspacing='0' cellpadding='0'>
                        <tbody>
                            <tr>
                                <td colspan="5" class="orange left">CLIENTE | GRUPPO ORGANIZZATO | ISTITUTO SCOLASTICO</td>
                               
                            </tr>
                            <tr>
                                <td colspan="5" class="white"><input type="text" class='input-full nop' name="scuola" id="scuola" /></td>
                                
                            </tr>
                            <tr>
                                <td class="red big left">QUESITO</td>
                                <td class="red-clear">ECCELLENTE</td>
                                <td class="red">BUONO</td>
                                <td class="red-clear">SUFFICIENTE</td>
                                <td class="red">INSUFFICIENTE</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="orange left">IL VIAGGIO DI ISTRUZIONE</td>
                            </tr>
                            <tr>
                                <td class="grey border left">GIUDIZIO COMPLESSIVO</td>
                                <td class="grey border"><input type="radio" name="viaggio_complessivo" id="viaggio_complessivo_1"  value='E'/></td>
                                <td class="grey border"><input type="radio" name="viaggio_complessivo" id="viaggio_complessivo_2" value='B'/></td>
                                <td class="grey border"><input type="radio" name="viaggio_complessivo" id="viaggio_complessivo_3" value='S'/></td>
                                <td class="grey border"><input type="radio" name="viaggio_complessivo" id="viaggio_complessivo_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="white border left">I RAPPORTI CON L'AGENZIA KELUAR</td>
                                <td class="white border"><input type="radio" name="rapporto_keluar" id="rapporto_keluar_1" value='E'/></td>
                                <td class="white border"><input type="radio" name="rapporto_keluar" id="rapporto_keluar_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="rapporto_keluar" id="rapporto_keluar_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="rapporto_keluar" id="rapporto_keluar_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="orange left">IL TRASPORTO - Indicare il mezzo di trasporto</td>
                                <td colspan="2" class="white border-ogange"><input type="text" name="trasporto_nome" id="trasporto_nome" class='input-full nop' /></td>
                            </tr>
                            <tr>
                                <td class="white border left">Qualit&agrave; del vettore</td>
                                <td class="white border"><input type="radio" name="trasporto_qualita" id="trasporto_qualita_1" value='E'/></td>
                                <td class="white border"><input type="radio" name="trasporto_qualita" id="trasporto_qualita_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="trasporto_qualita" id="trasporto_qualita_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="trasporto_qualita" id="trasporto_qualita_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="orange-clear border left">Cortesia degli operatori</td>
                                <td class="orange-clear border"><input type="radio" name="trasporto_cortesia" id="trasporto_cortesia_1" value='E'/></td>
                                <td class="orange-clear border"><input type="radio" name="trasporto_cortesia" id="trasporto_cortesia_2" value='B'/></td>
                                <td class="orange-clear border"><input type="radio" name="trasporto_cortesia" id="trasporto_cortesia_3" value='S'/></td>
                                <td class="orange-clear border"><input type="radio" name="trasporto_cortesia" id="trasporto_cortesia_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="white border left">Rispetto dei tempi di viaggio previsti</td>
                                <td class="white border"><input type="radio" name="trasporto_tempi" id="trasporto_tempi_1" value='E'/></td>
                                <td class="white border"><input type="radio" name="trasporto_tempi" id="trasporto_tempi_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="trasporto_tempi" id="trasporto_tempi_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="trasporto_tempi" id="trasporto_tempi_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="orange left">LA STRUTTURA - Indicare il nome della struttura ospitante</td>
                                <td colspan="2" class="white border-ogange">
                                    <select name ='struttura_nome' id="struttura_nome" class='input-full nop' >
                                        <option value ='0' >Scegli</option>
                                        <? foreach($strutture as $id => $val){?>
                                        <option  value='<?=$id?>'><?=$val?></option>
                                        <?}?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="grey border left">GIUDIZIO COMPLESSIVO</td>
                                <td class="grey border"><input type="radio" name="struttura_complessivo" id="struttura_complessivo_1" value='E'/></td>
                                <td class="grey border"><input type="radio" name="struttura_complessivo" id="struttura_complessivo_2" value='B'/></td>
                                <td class="grey border"><input type="radio" name="struttura_complessivo" id="struttura_complessivo_3" value='S'/></td>
                                <td class="grey border"><input type="radio" name="struttura_complessivo" id="struttura_complessivo_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="orange left">LA CAMERA</td>
                            </tr>
                            <tr>
                                <td class="white border left">Pulizia</td>
                                <td class="white border"><input type="radio" name="camera_pulizia" id="camera_pulizia_1" value='E'/></td>
                                <td class="white border"><input type="radio" name="camera_pulizia" id="camera_pulizia_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="camera_pulizia" id="camera_pulizia_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="camera_pulizia" id="camera_pulizia_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="orange-clear border left">Comfort</td>
                                <td class="orange-clear border"><input type="radio" name="camera_confort" id="camera_confort_1" value='E'/></td>
                                <td class="orange-clear border"><input type="radio" name="camera_confort" id="camera_confort_2" value='B'/></td>
                                <td class="orange-clear border"><input type="radio" name="camera_confort" id="camera_confort_3" value='S'/></td>
                                <td class="orange-clear border"><input type="radio" name="camera_confort" id="camera_confort_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="orange left">IL RISTORANTE</td>
                            </tr>
                            <tr>
                                <td class="white border left">Servizio</td>
                                <td class="white border"><input type="radio" name="ristorante_servizio" id="ristorante_servizio_1" value='E'/></td>
                                <td class="white border"><input type="radio" name="ristorante_servizio" id="ristorante_servizio_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="ristorante_servizio" id="ristorante_servizio_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="ristorante_servizio" id="ristorante_servizio_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="orange-clear border left">Qualit&agrave; del cibo</td>
                                <td class="orange-clear border"><input type="radio" name="ristorante_cibo" id="ristorante_cibo_1" value='E'/></td>
                                <td class="orange-clear border"><input type="radio" name="ristorante_cibo" id="ristorante_cibo_2" value='B'/></td>
                                <td class="orange-clear border"><input type="radio" name="ristorante_cibo" id="ristorante_cibo_3" value='S'/></td>
                                <td class="orange-clear border"><input type="radio" name="ristorante_cibo" id="ristorante_cibo_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="white border left">Variet&agrave; del menu</td>
                                <td class="white border"><input type="radio" name="ristorante_menu" id="ristorante_menu_1" value='E'/></td>
                                <td class="white border"><input type="radio" name="ristorante_menu" id="ristorante_menu_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="ristorante_menu" id="ristorante_menu_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="ristorante_menu" id="ristorante_menu_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="orange left">IL PERSONALE</td>
                            </tr>
                            <tr>
                                <td class="white border left">Cortesia</td>
                                <td class="white border"><input type="radio" name="personale_cortesia" id="personale_cortesia_1" value='E'/></td>
                                <td class="white border"><input type="radio" name="personale_cortesia" id="personale_cortesia_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="personale_cortesia" id="personale_cortesia_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="personale_cortesia" id="personale_cortesia_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="orange-clear border left">Disponibilit&agrave;</td>
                                <td class="orange-clear border"><input type="radio" name="personale_disponibilita" id="personale_disponibilita_1" value='E'/></td>
                                <td class="orange-clear border"><input type="radio" name="personale_disponibilita" id="personale_disponibilita_2" value='B'/></td>
                                <td class="orange-clear border"><input type="radio" name="personale_disponibilita" id="personale_disponibilita_3" value='S'/></td>
                                <td class="orange-clear border"><input type="radio" name="personale_disponibilita" id="personale_disponibilita_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="orange left">LE ESCURSIONI (Da compilare solo se previsto nel programma)</td>
                            </tr>
                            <tr>
                                <td class="white border left">Itinerari</td>
                                <td class="white border"><input type="radio" name="escursioni_itinerari" id="escursioni_itinerari_1" value='E'/></td>
                                <td class="white border"><input type="radio" name="escursioni_itinerari" id="escursioni_itinerari_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="escursioni_itinerari" id="escursioni_itinerari_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="escursioni_itinerari" id="escursioni_itinerari_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="orange-clear border left">Servizio guida turistica di accompagnamento;</td>
                                <td class="orange-clear border"><input type="radio" name="escursioni_guida" id="escursioni_guida_1" value='E'/></td>
                                <td class="orange-clear border"><input type="radio" name="escursioni_guida" id="escursioni_guida_2" value='B'/></td>
                                <td class="orange-clear border"><input type="radio" name="escursioni_guida" id="escursioni_guida_3" value='S'/></td>
                                <td class="orange-clear border"><input type="radio" name="escursioni_guida" id="escursioni_guida_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="orange left">LE ATTVIT&Agrave; SULLA NEVE (Da compilare solo se previsto nel programma)</td>
                            </tr>
                            <tr>
                                <td class="white border left">Noleggio attrezzature</td>
                                <td class="white border"><input type="radio" name="neve_noleggio" id="neve_noleggio_1" value='E'/></td>
                                <td class="white border"><input type="radio" name="neve_noleggio" id="neve_noleggio_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="neve_noleggio" id="neve_noleggio_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="neve_noleggio" id="escursioni_itinerari_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="orange-clear border left">Scuola sci</td>
                                <td class="orange-clear border"><input type="radio" name="neve_scuola" id="neve_scuola_1" value='E'/></td>
                                <td class="orange-clear border"><input type="radio" name="neve_scuola" id="neve_scuola_2" value='B'/></td>
                                <td class="orange-clear border"><input type="radio" name="neve_scuola" id="neve_scuola_3" value='S'/></td>
                                <td class="orange-clear border"><input type="radio" name="neve_scuola" id="neve_scuola_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="orange left">LE ATTVIT&Agrave; DI LABORATORIO (Da compilare solo se previsto nel programma)</td>
                            </tr>
                            <tr>
                                <td class="white border left">Competenza dei tecnici</td>
                                <td class="white border"><input type="radio" name="laboratori_tecnici" id="laboratori_tecnici_1" value='E'/></td>
                                <td class="white border"><input type="radio" name="laboratori_tecnici" id="laboratori_tecnici_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="laboratori_tecnici" id="laboratori_tecnici_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="laboratori_tecnici" id="escursioni_itinerari_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="orange-clear border left">Aquisizione di nuove competenze</td>
                                <td class="orange-clear border"><input type="radio" name="laboratori_competenze" id="laboratori_competenze_1" value='E'/></td>
                                <td class="orange-clear border"><input type="radio" name="laboratori_competenze" id="laboratori_competenze_2" value='B'/></td>
                                <td class="orange-clear border"><input type="radio" name="laboratori_competenze" id="laboratori_competenze_3" value='S'/></td>
                                <td class="orange-clear border"><input type="radio" name="laboratori_competenze" id="laboratori_competenze_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="orange left">CONSIGLIEREBBE UN VIAGGIO DI CLASSE NELLA STESSA LOCALIT&Agrave;?</td>
                            </tr>
                            <tr>
                                <td class="white border left">Certamente si</td>
                                <td class="white border"><input type="radio" name="consiglia" id="consiglia_1" value='S'/></td>
                                <td colspan="3" class="white border"></td>
                            </tr>
                            <tr>
                                <td class="grey border left">Non so , forse</td>
                                <td class="grey border"><input type="radio" name="consiglia" id="consiglia_1" value='F'/></td>
                                <td colspan="3" class="white border"></td>
                            </tr>
                            <tr>
                                <td class="white border left">Certamente no</td>
                                <td class="white border"><input type="radio" name="consiglia" id="consiglia_1" value='N'/></td>
                                <td colspan="3" class="white border"></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="red left">SUGGERIMENTI PER MIGLIORARE IL SERVIZIO</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="white left"><textarea id="suggerimenti" name="suggerimenti" rows='6' ></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="red left">DATI DEL COMPILATORE</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="left grey" style='padding: 2px 10px 2px 10px' >
                                    NOME&nbsp;&nbsp;<input type="text" name="nome" id="nome" class='input-small' />
                                    COGNOME&nbsp;&nbsp;<input type="text" name="cognome" id="cognome" class='input-small' />

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class='pulsante'>
                        <a href="javascript:rispondi('K')"  class='subred sub'>INVIA QUESTIONARIO</a>
                    </div>
                    <div class="tanks">Ringraziandola ancora per la sua collaborazione , ci auguriamo di avere il piacere di ospitarla nuovamente</div>
                </form>
            </div>
        </div>
    </body>
</html>