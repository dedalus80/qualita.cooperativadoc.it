<?
function getNight($dstart, $dstop) {
    
    $nigth  = false;
    $stop   = strtotime(reverseDate($dstop));
    $start  = strtotime(reverseDate($dstart));
    
    
    if ($stop == $start)
        $night = 1;
    else if ($stop > $start)
        $nigth = ((( $stop - $start) / 3600) / 24);

    return $nigth;
}

function reverseDate($date) {
    $d = explode("-", $date);
    return $d[2] . "-" . $d[1] . "-" . $d[0];
}


function goToLocation($location) {
    header("Location: $location ");
}

function isValidField($field, $type = NULL, $max_lenght = NULL, $min_length = null) {

    switch ($type) {
        case"email":
            $pattern = "/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9_\.\-]+\.[a-z]{2,6}$/";
            break;
        case"nome":
        case"cognome":
            $pattern = "/^[a-zA-Zאטילעש ]*$/";
            break;
        case"password":
            $pattern = "/^[a-zA-Z0-9]*$/";
            break;
        case"numero":
        case"cellulare":
            $pattern = "/^[0-9]*$/";
            break;
        case"char":
            $pattern = "/^[A-Z]*$/";
            break;
        case"note":
            $pattern = "/^[a-zA-Z0-9\xE0\xE8\xE9\xF9\xF2\xEC\x27\x21\x22\x23\x24\x25\x26\x28\x29\x2a\x2b\x2c\x40 \.\-\ \/]*$/";
            break;
        default:
            $pattern = "/^[a-zA-Z0-9אטילעש_\. -]*$/";
            break;
    }

    if (preg_match($pattern, $field)) {
        if ($max_lenght && strlen($field) > $max_lenght)
            $ko = 1;
        if ($min_length && strlen($field) < $min_length)
            $ko = 1;
    }
    else
        $ko = 1;

    if ($ko == 1)
        return false;
    else
        return true;
}



class worpress_totalc {

    var $tcUrl = "https://panel.totalconnect.it/public/iscritti/inserimento_utente.php";
    var $tcHost = "";
    var $tcPort = "";
    var $tcUser = "";
    var $tcDebug = "Y";
    var $postData = array();
    var $tcField = array();
    var $tcResponse = "";

    function setTcFields() {
        if ($this->tcField['nascita'] && $this->tcField['id_user'] == '9884') {
            $d = explode("-", $this->tcField['nascita']);
            $this->tcField['VAR_g_n'] = $d[2];
            $this->tcField['VAR_m_n'] = $d[1];
            $this->tcField['VAR_a_n'] = $d[0];
        }


        $this->tcField['typerequest'] = 'remote';
        $this->postData = http_build_query($this->tcField);
    }

    function setHostAndPort() {
        $dominio = parse_url($this->tcUrl);
        $this->tcHost = $dominio['host'];
        $this->tcPort = $dominio['port'];
    }

    function socketRequest() {
        $len = strlen($this->postData);
        $s = "POST " . $this->tcUrl . " HTTP/1.0\r\n";
        $s.= "Host: " . $this->tcHost . "\r\n";
        $s.= "Content-type: application/x-www-form-urlencoded\r\n";
        $s.= "Content-length: $len\r\n\r\n";
        $s.= $this->postData . "\r\n";
        $s.= "\r\n";

        $fp = fsockopen($this->tcHost, $this->tcPort, $errno, $errstr, 60);


        fputs($fp, $s);
        $this->tcResponse = fread($fp, 1024);



        fclose($fp);
    }

    function curlRequest() {




        $ch = curl_init($this->tcUrl . "?t=t" . $this->tcField);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $this->tcResponse = curl_exec($ch);
        $this->tcResponse .= curl_errno($ch);
        $this->tcResponse .= curl_error($ch);
        curl_close($ch);
    }

    function sendStreamRequest() {
        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $this->postData
            )
        );

        $context = stream_context_create(
                array('http' =>
                    array(
                        'method' => 'POST',
                        'header' => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $this->postData
                    )
                )
        );

        $this->tcResponse = file_get_contents($this->tcUrl, false, $context);
    }

}


$mailC = new PHPMailer;
$mailC->isSMTP();

$mailC->SMTPDebug = 0;
$mailC->Debugoutput = 'html';
$mailC->Host = "mail.archynet.it";
$mailC->Port = 25;
$mailC->SMTPAuth = true;
$mailC->Username = "coopdoc@archynet.it";
$mailC->Password = "smtpcoopdoc#1";


?>