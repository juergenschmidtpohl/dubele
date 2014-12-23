<?php

define("CRLF", chr(13) . chr(10));

###################
# Prein in Cent zur Ausgabe aufbereiten...
#
function formatierePreis($preisInCent) {
    $preisInEuro = number_format($preisInCent / 100, 2);
    $preisText = str_replace('.', ',', $preisInEuro) . ' &euro;';
    return $preisText;
}

// formatierePreis
//
###################
# Kurztext aus langem Text...
#
  function machAnriss($rein, $laenge=200) {
    $raus = strip_tags($rein);
    if ( strlen($rein) <= $laenge ) {
        $raus = $rein;
    } else {
        $raus = substr($raus, 0, $laenge);
        $raus = substr($raus, 0, strrpos($raus, ' ')) . '...';
    }
    return $raus;
}
// machAnriss

function paranoid($rein) {
    $raus = strip_tags($rein);
    $raus = trim($raus);
    $raus = stripslashes($raus);
#    $raus = mysql_real_escape_string($raus);
    return $raus;
}

function makeUrlText($word) {
    $word = html_entity_decode($word);
    $word = strtolower($word);
    $word = str_replace(".", "", $word);
    $word = str_replace(",", "", $word);
    $word = str_replace(":", "", $word);
    $word = str_replace(";", "", $word);
    $word = str_replace("ä", "ae", $word);
    $word = str_replace("ö", "oe", $word);
    $word = str_replace("ü", "ue", $word);
    $word = str_replace(" ", "-", $word);
    $word = str_replace("ß", "ss", $word);
    $word = str_replace("&auml;", "ae", $word);
    $word = str_replace("&ouml;", "oe", $word);
    $word = str_replace("&uuml;", "ue", $word);
    $word = str_replace("&szlig;", "ss", $word);
    return $word;
}

/* Konvertieren Datum */

function JulDat2MySQL($julDat) {
    $arr = explode('/', $julDat);
    $MySQLdat = $arr[2] . "-" . $arr[0] . "-" . $arr[1];
    return $MySQLdat;
}

// JulDat2MySQL

function JulNr2MySQL($julnr) {
    $juldat = jdtojulian($julnr);
    return JulDat2MySQL($juldat);
}

// JulNr2MySQL

function MySQL2JulNr($MySQLdat) {
    $arr = explode('-', $MySQLdat);
    return juliantojd($arr[1], $arr[2], $arr[0]);
}

// MySQL2JulNr

function FormatiereDatum($sqlDate, $wie) {
#    DebugOut($sqlDate);
    $monate = ARRAY('Januar', 'Februar', 'M&auml;rz', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember');
    $arr = explode(' ', $sqlDate);
    $datTeil = explode('-', $arr[0]);
    $zeitTeil = explode(':', $arr[1]);
    $jahr = $datTeil[0];
    $monat = $datTeil[1];
    $tag = $datTeil[2];
    $stunden = $zeitTeil[0];
    $minuten = $zeitTeil[1];
    $sekunden = $zeitTeil[2];
    switch ($wie) {
        case 1: $returnCode = str_pad($tag, 2, '0', STR_PAD_LEFT) . '. ' .
                    str_pad($monat, 2, '0', STR_PAD_LEFT) . '. ' . $jahr;
            break; // 01.01.1900
        case 2: $returnCode = $tag . '. ' . $monate[$monat - 1] . ' ' . $jahr;
            break; // Der Datumsanteil  12. April 1544
        case 3: $returnCode = $tag . '. ' . $monate[$monat - 1] . ' ' . $jahr . ' ' . $stunden . ':' . $minuten;
            break; // 12. April 1544 18:30
        case 4: $returnCode = $stunden . ':' . $minuten . ' Uhr';
            break; // der Zeitanteil  18:30
        default: $returnCode = $tag . '. ' . $monate[$monat - 1] . ' ' . $jahr;
            break; // 12. April 1544
    }

    return $returnCode;
}

// FormatiereDatum

function DebugOut($wasDenn) {
    echo '<h3>' . $wasDenn . '</h3>';
}

// DebugOut

function ErrorMsg($errorText) {
    echo '<h2>' . $errorText . '</h2>';
}

// ErrorMsg
?>