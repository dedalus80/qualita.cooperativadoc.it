<?
switch ($_REQUEST['from']) {

    case"K":
        $img = "qu-keluar.png";
        $mail = "info@keluar.it";
        break;
    case"D":
        $img = "qu-doc.png";
        $mail = "info@cooperativadoc.it";
        break;
    case"S":
        $img = "qu-sharing.png";
        $mail = "info@sharing.to.it";
        break;
    default:
        $img = "qu-doc.png";
        $mail = "info@cooperativadoc.it";
        break;
    
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>Questionario qualita</title>
        <meta name="language" content="it" />
        <link rel="stylesheet" type="text/css" href="../qualita/css/main.css" />
        <link rel="stylesheet" type="text/css" href="../qualita/css/form.css" />
        <link rel="stylesheet" type="text/css" href="../qualita/css/custom.css" />
        <script language="javascript" type="text/javascript" src="../js/functions.js"></script>
    </head>
    <body>
        <div id="q-page">
            <div id="questionario">
                <div id="quest-logo"><img src="http://qualita.cooperativadoc.it/img/<?= $img ?>" /></div>
                <div class='clear'></div>
                <div class="intro-text">
                    <p>Gentile Ospite<br />
                        <? if ($_REQUEST['more'] == 'y') { ?>
                            Ci risulta che in passato ha gi&agrave; compilato il nostro questionario.<br>
                        <? }elseif ($_REQUEST['more'] == 'n') { ?>
                            Non siamo riusciti ad elaborare il suo questionario la invitiamo a riprovare.<br>
                        <? } else { ?>
                            Grazie per aver compilato il questionario qualit&agrave; che ci dar&agrave; modo di poter valutare al meglio i nostri servizi, oltre a darci spunti di miglioramento.<br>
                        <? } ?>
                        Le ricordiamo che per ogni altra possibile informazione potr&agrave; mandare una mail all'indirizzo  <a href='mailto:<?= $mail ?>'><?= $mail ?></a></p>
                    <p>Sperando di averla nuovamente nostro ospite.<br/>Cordiali Saluti</p>
                </div>
            </div>
        </div>
    </body>
</html>