<?
function sendEmail($mittente, $destinatario, $soggetto, $bodyhtml, $bodytxt="", $allegato="", $allegatofolder="/tmpFatture/") {
    $boundary1 = "XXMAILXX" . md5(time()) . "XXMAILXX";
    $boundary2 = "YYMAILYY" . md5(time()) . "YYMAILYY";
    if ($bodytxt == "" && $bodyhtml != "") {
        $bodytxt = str_replace("<br>", "\n", $bodyhtml);
        $bodytxt = strip_tags($bodyhtml);
    }
    if ($bodytxt != "" && $bodyhtml == "") {
        $bodyhtml = $bodytxt;
    }

    $headers = "From: $mittente\n";
    //$headers .= "BCC: andrea@totalconnect.it\n";
    $headers .= "MIME-Version: 1.0\n";
    if ($allegato != "") {
        $headers .= "Content-Type: multipart/mixed;\n";
        $headers .= " boundary=\"$boundary1\";\n\n";
        $headers .= "--$boundary1\n";
    }

    $headers .= "Content-Type: multipart/alternative;\n";
    $headers .= " boundary=\"$boundary2\";\n\n";

    //mail alternativa solo testo
    $body = "--$boundary2\n";
    $body .= "Content-Type: text/plain; charset=ISO-8859-15; format=flowed\n";
    $body .= "Content-Transfer-Encoding: 7bit\n\n";
    $body .= "$bodytxt\n";

    //mail html
    $body .= "--$boundary2\n";
    $body .= "Content-Type: text/html; charset=ISO-8859-15\n";
    $body .= "Content-Transfer-Encoding: 7bit\n\n";
    $body .= "$bodyhtml\n\n";
    $body .= "--$boundary2--\n";

    //allegato se presente
    if ($allegato != "") {
        $fileallegato = getcwd() . $allegatofolder . $allegato;
        $fp = @fopen($fileallegato, "r");
        if ($fp) {
            $data = fread($fp, filesize($fileallegato));
        }

        $curr = chunk_split(base64_encode($data));

        $body .= "--$boundary1\n";
        /*
          $body .= "Content-Type: application/pdf;";
          $body .= "name=\"$allegato\"\n";
          $body .= "Content-Transfer-Encoding: base64\n\n";
          $body .= "Content-Disposition: attachment;\n";
          $body .= "filename=\"$allegato\"\n\n";
         */
        $body .= "Content-type: application/pdf; name=\"$allegato\"\n";
        $body .= "Content-Transfer-Encoding: BASE64\n";
        $body .= "Content-disposition: attachment; filename=\"$allegato\"\n\n";



        $body .= "$curr\n";
        $body .= "--$boundary1--\n";
    }

    if (@mail($destinatario, $soggetto, $body, $headers))
        return true;
    else
        return false;
}
?>