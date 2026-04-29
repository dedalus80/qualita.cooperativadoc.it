<?php 
    $grafico    = $_POST['grafico']; 
    $nome       = $_POST['nome'];
    $struttura  = $_POST['struttura'];
    $anno       = $_POST['anno'];
    $tipo       = $_POST['tipo'];

    if($tipo =='questionari_formazione') {
        $fileName = $nome ;
        $folder   = 'generali';
    }
    else if($tipo =='presenze') {
        $struttura && $struttura !='' ? $fileName = $struttura."_statistiche_consumi_".$nome : $fileName = "statistiche_consumi_".$nome;
    }
    else {
        $struttura && $struttura !='' ? $fileName = $struttura."_".$anno."_".$nome : $fileName = $anno."_".$nome;
    }

    $struttura && $struttura !='' ? $folder ="strutture" : $folder ='generali';

    if($grafico) {
        $pngPath = __DIR__."/PNG/".$tipo."/".$folder."/".$fileName.".png";

        // Salva direttamente il PNG decodificato dal base64 (rendering client-side)
        $imageData = base64_decode($grafico);
        
        // Crea la directory se non esiste
        $dir = dirname($pngPath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        if(file_put_contents($pngPath, $imageData)) {
            $dati['file'] = "Salvato: ".$fileName.".png";
        } else {
            $dati['file'] = "Errore salvataggio: ".$pngPath;
        }
    }
    else {
        $dati['file'] = "Data empty";
    }

    echo json_encode($dati);
?>