<?php

$HOME   = Yii::app()->getBaseUrl(true);
$IMG    = $HOME."/images/coopdoc-logo-pdf.png";

// Configurazione grafici: un grafico per pagina
$graficiConfig = array(
    array(
        'id' => 'acqua',
        'tipo' => 'acqua',
        'stats_key' => 'consumi',
        'titolo' => 'Statistiche consumi Acqua',
        'unita' => 'MC'
    ),
    array(
        'id' => 'acqua_costi',
        'tipo' => 'acqua',
        'stats_key' => 'costi',
        'titolo' => 'Statistiche costi Acqua',
        'unita' => 'Euro'
    ),
    array(
        'id' => 'gas',
        'tipo' => 'gas',
        'stats_key' => 'consumi',
        'titolo' => 'Statistiche consumi Gas',
        'unita' => 'MC'
    ),
    array(
        'id' => 'gas_costi',
        'tipo' => 'gas',
        'stats_key' => 'costi',
        'titolo' => 'Statistiche costi Gas',
        'unita' => 'Euro'
    ),
    array(
        'id' => 'luce',
        'tipo' => 'luce',
        'stats_key' => 'consumi',
        'titolo' => 'Statistiche consumi Energia Elettrica',
        'unita' => 'KWH'
    ),
    array(
        'id' => 'luce_costi',
        'tipo' => 'luce',
        'stats_key' => 'costi',
        'titolo' => 'Statistiche costi Energia Elettrica',
        'unita' => 'Euro'
    ),
    array(
        'id' => 'chimici',
        'tipo' => 'chimici',
        'stats_key' => 'consumi',
        'titolo' => 'Statistiche consumi Sostanze Chimiche',
        'unita' => 'MC'
    ),
    array(
        'id' => 'chimici_costi',
        'tipo' => 'chimici',
        'stats_key' => 'costi',
        'titolo' => 'Statistiche costi Sostanze Chimiche',
        'unita' => 'Euro'
    ),
    array(
        'id' => 'rifiuti',
        'tipo' => 'rifiuti',
        'stats_key' => 'costi',
        'titolo' => 'Statistiche costi Rifiuti',
        'unita' => 'Euro'
    ),
);

// Prepara percorsi grafici
$GRAF = array();
foreach($graficiConfig as $g) {
    $id = $g['id'];
    $GRAF[$id] = $struttura 
        ? "grafici/PNG/presenze/strutture/".$struttura."_statistiche_consumi_".$id.".png" 
        : "grafici/PNG/presenze/generali/statistiche_consumi_".$id.".png";
}

echo '<link href="'.$HOME.'/css/pdf.css" type="text/css" rel="stylesheet"/>';
?>
<style>
    .pdf-container { width: 100%; }
    .pdf-header { text-align: right; margin-bottom: 5px; }
    .pdf-header img { width: 12%; }
    .pdf-title { text-align: center; margin-bottom: 10px; font-size: 14px; }
    .pdf-title .struttura { color: #f7941e; font-weight: bold; }
    .pdf-chart { text-align: center; margin-bottom: 10px; }
    .pdf-chart img { width: 50%; height: auto; }
    .pdf-table { width: 80%; margin: 0 auto; border-collapse: collapse; font-size: 11px; }
    .pdf-table th, .pdf-table td { border: 1px solid #dadfe3; padding: 4px 6px; text-align: right; }
    .pdf-table th { background-color: #f5f5f5; font-weight: bold; }
    .pdf-table td { background-color: #fff; }
</style>
<?php
// Genera una pagina per ogni grafico
foreach($graficiConfig as $grafico):
    $tipo = $grafico['tipo'];
    $statsKey = $grafico['stats_key'];
    
    // Salta se non ci sono dati
    if(!isset($stats[$tipo]['anni']) || count($stats[$tipo]['anni']) == 0) continue;
    if(!isset($stats[$tipo][$statsKey]) || count($stats[$tipo][$statsKey]) == 0) continue;
    
    $numAnni = count($stats[$tipo]['anni']);
    $colWidth = floor(80 / $numAnni);
?>
<page pageset="" class="" backtop="3mm" backbottom="3mm" backleft="5mm" backright="5mm">
    <page_footer>
        <table style='width:100%; font-size:9px;'>
            <tr>
                <td style="text-align:center;">
                    <span style="font-weight:bold;">D.O.C. scs s.r.l.</span> Via Assietta 16/b 10128 Torino - t. +39.011.516.20.38 - f. +39.011.517.54.86
                </td>
                <td style="text-align:right; width:100px;">
                    Pag. [[page_cu]]/[[page_nb]]
                </td>
            </tr>
        </table>
    </page_footer>
    
    <div class="pdf-container">
        <!-- Logo -->
        <div class="pdf-header">
            <img src="<?= $IMG ?>" />
        </div>

        <!-- Titolo -->
        <div class="pdf-title">
            <?php if($nome): ?>
                <span class="struttura"><?= $nome ?></span> - 
            <?php endif; ?>
            <span style="font-weight:bold;"><?= $grafico['titolo'] ?></span>
        </div>

        <!-- Grafico -->
        <div class="pdf-chart">
            <img src='<?= $HOME."/".$GRAF[$grafico['id']].'?'.uniqid() ?>' />
        </div>

        <!-- Tabella dati -->
        <table class="pdf-table">
            <tr>
                <th style="width:20%;"><?= $grafico['unita'] ?></th>
                <?php foreach($stats[$tipo]['anni'] as $val): ?>
                <th style='width:<?= $colWidth ?>%;'><?= str_replace("'", "", $val) ?></th>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td style="font-weight:bold;">Valore</td>
                <?php foreach($stats[$tipo][$statsKey] as $val): ?>
                <td><?= number_format((float)$val, 2, ',', '.') ?></td>
                <?php endforeach; ?>
            </tr>
        </table>
    </div>

</page>
<?php endforeach; ?>
