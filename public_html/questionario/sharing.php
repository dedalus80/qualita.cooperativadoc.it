<?
include("../lib/class-db.php");


$db = new MySql_DB("localhost", "qualita", "qualita", "00qQUFDTOlKl6O3", true);
$strutture = $db->CycleAssochId($db->Query("SELECT id, nome FROM doc_unita LIMIT 11"));
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
                <form id='questionario-sharing' method='POST' name='questionario-sharing' action='https://qualita.cooperativadoc.it/questionario/response.php'>
                    <input type="hidden" name="from" id="from" value='S' />
                    <div id="quest-logo"><img src="https://qualita.cooperativadoc.it/img/qu-sharing.png" /></div>
                    <div class='clear'></div>
                    <div class="intro-text">
                        <p>Gentile Ospite,<br />
                            ringraziandola di averci scelto, le chiediamo di aiutarci a comprendere quanto &egrave; soddifatto del soggiorno presso la nostra struttura. Le vorremmo perci&ograve; chiedere di dedicare qualche minuto per rispondere ad alcune domande contenute nel presente questionario.<br>
                            La Sua opinione sar&agrave; importante per aiutarci a realizzare in futuro un servizio migliore. Grazie <p>
                    </div>
                    <table cellspacing='0' cellpadding='0'>
                        <tbody>
                            <tr>
                                <td class="violet big left">QUESITO</td>
                                <td class="violet-clear">ECCELLENTE</td>
                                <td class="violet">BUONO</td>
                                <td class="violet-clear">SUFFICIENTE</td>
                                <td class="violet">INSUFFICIENTE</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="orange left">IL SOGGIORNO</td>
                            </tr>
                            <tr>
                                <td class="grey border left">GIUDIZIO COMPLESSIVO</td>
                                <td class="grey border"><input type="radio" name="vacanza" id="vacanza_1"  value='E'/></td>
                                <td class="grey border"><input type="radio" name="vacanza" id="vacanza_2" value='B'/></td>
                                <td class="grey border"><input type="radio" name="vacanza" id="vacanza_3" value='S'/></td>
                                <td class="grey border"><input type="radio" name="vacanza" id="vacanza_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="orange left">L'ALBERGO - LA STRUTTURA </td>
                                
                            </tr>
                            <tr>
                                <td class="white border left">Pulizia degli ambienti</td>
                                <td class="white border"><input type="radio" name="struttura_pulizia" id="struttura_pulizia_1"  value='E'/></td>
                                <td class="white border"><input type="radio" name="struttura_pulizia" id="struttura_pulizia_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="struttura_pulizia" id="struttura_pulizia_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="struttura_pulizia" id="struttura_pulizia_4" value='I'/></td>
                            </tr>
                            
                            <tr>
                                <td class="grey border left">GIUDIZIO COMPLESSIVO</td>
                                <td class="grey border"><input type="radio" name="struttura_complessivo" id="struttura_complessivo_1"  value='E'/></td>
                                <td class="grey border"><input type="radio" name="struttura_complessivo" id="struttura_complessivo_2" value='B'/></td>
                                <td class="grey border"><input type="radio" name="struttura_complessivo" id="struttura_complessivo_3" value='S'/></td>
                                <td class="grey border"><input type="radio" name="struttura_complessivo" id="struttura_complessivo_4" value='I'/></td>
                            </tr>
                            
                            <tr>
                                <td colspan="5" class="orange left">LA CAMERA</td>
                            </tr>
                            <tr>
                                <td class="white border left">Confort</td>
                                <td class="white border"><input type="radio" name="stanza_confort" id="stanza_confort_1" value='E'/></td>
                                <td class="white border"><input type="radio" name="stanza_confort" id="stanza_confort_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="stanza_confort" id="stanza_confort_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="stanza_confort" id="stanza_confort_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="orange-clear border left">Qualit&agrave; degli arredi</td>
                                <td class="orange-clear border"><input type="radio" name="stanza_arredi" id="stanza_arredi_1" value='E'/></td>
                                <td class="orange-clear border"><input type="radio" name="stanza_arredi" id="stanza_arredi_2" value='B'/></td>
                                <td class="orange-clear border"><input type="radio" name="stanza_arredi" id="stanza_arredi_3" value='S'/></td>
                                <td class="orange-clear border"><input type="radio" name="stanza_arredi" id="stanza_arredi_4" value='I'/></td>
                            </tr>
                             <tr>
                                <td class="white border left">Pulizia del locale</td>
                                <td class="white border"><input type="radio" name="stanza_pulizia" id="stanza_pulizia_1" value='E'/></td>
                                <td class="white border"><input type="radio" name="stanza_pulizia" id="stanza_pulizia_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="stanza_pulizia" id="stanza_pulizia_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="stanza_pulizia" id="stanza_pulizia_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="grey border left">GIUDIZIO COMPLESSIVO</td>
                                <td class="grey border"><input type="radio" name="stanza_complessivo" id="stanza_complessivo_1" value='E'/></td>
                                <td class="grey border"><input type="radio" name="stanza_complessivo" id="stanza_complessivo_2" value='B'/></td>
                                <td class="grey border"><input type="radio" name="stanza_complessivo" id="stanza_complessivo_3" value='S'/></td>
                                <td class="grey border"><input type="radio" name="stanza_complessivo" id="stanza_complessivo_4" value='I'/></td>
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
                                <td class="orange-clear border left">Tempi di attesa</td>
                                <td class="orange-clear border"><input type="radio" name="ristorante_attesa" id="ristorante_attesa_1" value='E'/></td>
                                <td class="orange-clear border"><input type="radio" name="ristorante_attesa" id="ristorante_attesa_2" value='B'/></td>
                                <td class="orange-clear border"><input type="radio" name="ristorante_attesa" id="ristorante_attesa_3" value='S'/></td>
                                <td class="orange-clear border"><input type="radio" name="ristorante_attesa" id="ristorante_attesa_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="white border left">Qualit&agrave; del cibo</td>
                                <td class="white border"><input type="radio" name="ristorante_cibo" id="ristorante_cibo_1" value='E'/></td>
                                <td class="white border"><input type="radio" name="ristorante_cibo" id="ristorante_cibo_2" value='B'/></td>
                                <td class="white border"><input type="radio" name="ristorante_cibo" id="ristorante_cibo_3" value='S'/></td>
                                <td class="white border"><input type="radio" name="ristorante_cibo" id="ristorante_cibo_4" value='I'/></td>
                            </tr>
                             <tr>
                                 <td class="orange-clear border left">Variet&agrave; del men&ugrave;</td>
                                <td class="orange-clear border"><input type="radio" name="ristorante_menu" id="ristorante_menu_1" value='E'/></td>
                                <td class="orange-clear border"><input type="radio" name="ristorante_menu" id="ristorante_menu_2" value='B'/></td>
                                <td class="orange-clear border"><input type="radio" name="ristorante_menu" id="ristorante_menu_3" value='S'/></td>
                                <td class="orange-clear border"><input type="radio" name="ristorante_menu" id="ristorante_menu_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td class="grey border left">GIUDIZIO COMPLESSIVO</td>
                                <td class="grey border"><input type="radio" name="ristorante_complessivo" id="ristorante_complessivo_1" value='E'/></td>
                                <td class="grey border"><input type="radio" name="ristorante_complessivo" id="ristorante_complessivo_2" value='B'/></td>
                                <td class="grey border"><input type="radio" name="ristorante_complessivo" id="ristorante_complessivo_3" value='S'/></td>
                                <td class="grey border"><input type="radio" name="ristorante_complessivo" id="ristorante_complessivo_4" value='I'/></td>
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
                                <td class="orange-clear border left">Professionalit&agrave;</td>
                                <td class="orange-clear border"><input type="radio" name="personale_professionalita" id="personale_professionalita_1" value='E'/></td>
                                <td class="orange-clear border"><input type="radio" name="personale_professionalita" id="personale_professionalita_2" value='B'/></td>
                                <td class="orange-clear border"><input type="radio" name="personale_professionalita" id="personale_professionalita_3" value='S'/></td>
                                <td class="orange-clear border"><input type="radio" name="personale_professionalita" id="personale_professionalita_4" value='I'/></td>
                            </tr>
                              <tr>
                                <td class="grey border left">GIUDIZIO COMPLESSIVO</td>
                                <td class="grey border"><input type="radio" name="personale_complessivo" id="personale_complessivo_1" value='E'/></td>
                                <td class="grey border"><input type="radio" name="personale_complessivo" id="personale_complessivo_2" value='B'/></td>
                                <td class="grey border"><input type="radio" name="personale_complessivo" id="personale_complessivo_3" value='S'/></td>
                                <td class="grey border"><input type="radio" name="personale_complessivo" id="personale_complessivo_4" value='I'/></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="orange left">CONSIGLIEREBBE UNA VACANZA AI SUOI CONOSCENTI E/O PARENTI;?</td>
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
                                <td colspan="5" class="violet left">SUGGERIMENTI PER MIGLIORARE IL SERVIZIO</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="white left"><textarea id="suggerimenti" name="suggerimenti" rows='6' ></textarea></td>
                            </tr>
                            <tr>  
                                <td colspan="5" class="violet left">DATI DEL COMPILATORE</td>
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
                        <a href="javascript:rispondi('S')"  class='sub subviolet'>INVIA QUESTIONARIO</a>
                    </div>
                    <div class='clear'></div>
                    <div class="tanks">Ringraziandola ancora per la sua collaborazione , ci auguriamo di avere il piacere di ospitarla nuovamente</div>
                </form>
            </div>
        </div>
    </body>
</html>