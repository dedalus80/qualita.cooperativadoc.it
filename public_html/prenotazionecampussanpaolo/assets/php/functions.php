<?php
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
//~             $pattern = "/^[a-zA-Z0-9\xE0\xE8\xE9\xF9\xF2\xEC\x27\x21\x22\x23\x24\x25\x26\x28\x29\x2a\x2b\x2c\x40 \.\-\ \/]*$/";
            $pattern = "/^.+$/";
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

?>