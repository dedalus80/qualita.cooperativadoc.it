<?
session_start();
include("/var/www/vhosts/cooperativadoc.it/qualita.cooperativadoc.it/progettoscuolanatura/class/class-db.php");
 $SN = new MySql_DB('localhost', 'qualita_scuolanaturamilano', 'qualitaSNM', 'kVz$h159', true);
function returnPage($location) {
    header("Location: $location ");
}

if ($_REQUEST['user'] && $_REQUEST['psw']) {

    $user = $_REQUEST['user'];
    $psw = $_REQUEST['psw'];
    $isUser = $SN->SingleField('id', "admin", "WHERE user='".$user."'  AND password='".$psw."' ");
    
    if ($isUser)
        $_SESSION['idUser'] = $isUser;
    else
        $_SESSION['error'] = "Autenticazione fallita verificare l'esattezza dei dati inseriti";
}

if ($_REQUEST['voucher'] && $_SESSION['idUser'] ) {
    
    $code       = $_REQUEST['voucher'];
    $isVoucher = $SN->FetchArray($SN->Query("SELECT * FROM iscrizione_tornaincitta WHERE code='".$code."'"));
    
    if ($isVoucher) {
        
        if($isVoucher['confermato']=='Y') #VERIFCO STATO
            $_SESSION['error'] = "Il codice Voucher risulta gi&agrave; utilizzato";
       else{
            $SN->Query("UPDATE iscrizione_tornaincitta SET confermato ='Y' , data_confirm = NOW() WHERE id='".$isVoucher['id']."' ");
            #SETTO CON VISITA EFFETTUATA 
            $_SESSION['result'] = "Codice Voucher valido e attivato";
        }
   }else
        $_SESSION['error'] = "Il codice Voucher non &egrave; valido";
}

returnPage("./validate.php");
?>