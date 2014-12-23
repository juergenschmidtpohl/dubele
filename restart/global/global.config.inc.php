<?php
session_start();

#  error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
  error_reporting(E_ERROR );


  $GLOBAL_URL_LOCAL = 'http://localhost/dubele.de/vorschau';
  $GLOBAL_BASE_URL_LOCAL = 'http://localhost/dubele.de/vorschau';
  
  $GLOBAL_HOST_LOCAL = 'localhost';
  $GLOBAL_DBUSER_LOCAL = 'root';
  $GLOBAL_DBPW_LOCAL = '2aTtT,midN8';
  $GLOBAL_DATABASE_LOCAL = 'dubele';
  
  #######################################
  ##   Eintragen f&uuml;r remoteBetrieb
  #######################################
  $GLOBAL_URL_REMOTE = 'http://dubele.de';
  $GLOBAL_BASE_URL_REMOTE = 'http://dubele.de';
  $GLOBAL_HOST_REMOTE = 'db484875941.db.1and1.com';
  $GLOBAL_DBUSER_REMOTE = 'dbo484875941';
  $GLOBAL_DBPW_REMOTE = '2aTtT,midN8';
  $GLOBAL_DATABASE_REMOTE = 'kerina';

#  include('class/class.sql_reader.php');  
################
##  Datenbank  
################
  if ( $_SERVER['SERVER_NAME'] == 'localhost' ) { 
    $GLOBAL_URL = $GLOBAL_URL_LOCAL;
    $GLOBAL_BASE_URL = $GLOBAL_BASE_URL_LOCAL;
#    $GLOBAL_DB_CONNECTOR = new sql_reader( $GLOBAL_HOST_LOCAL, $GLOBAL_DBUSER_LOCAL, $GLOBAL_DBPW_LOCAL, $GLOBAL_DATABASE_LOCAL, true ); 
  } else { 
    $GLOBAL_URL = $GLOBAL_URL_REMOTE; 
    $GLOBAL_BASE_URL = $GLOBAL_BASE_URL_REMOTE;
#    $GLOBAL_DB_CONNECTOR = new sql_reader( $GLOBAL_HOST_REMOTE, $GLOBAL_DBUSER_REMOTE, $GLOBAL_DBPW_REMOTE, $GLOBAL_DATABASE_REMOTE, true ); 
  } // lokal vs. remote

####################################
#### Resourcen Bilder etc.
####################################
$GLOBAL_PFAD_ZU_BILDERN = $GLOBAL_BASE_URL.'bilder/';   


####################################
#### Links
####################################
#	$link_01 = $THIS_PAGE.'?seite=seminar&amp;id=1 ';
# mit mod_rewrite
	$link_01 = $ROOT.'seminar_1/windelalarm-01.htm';
	$link_02 = $ROOT.'seminar_2/entspannungsmethoden-fuer-kinder.htm';
	$link_03 = $ROOT.'seminar_3/windelalarm-02.htm';
	$link_04 = $ROOT.'seminar_4/ich-erzaehl-etwas-von-dir.htm';
	$link_05 = $ROOT.'seminar_5/psychomotorik.htm';
	$link_06 = $ROOT.'seminar_6/ich-kann-nicht-mehr.htm';
	$link_07 = $ROOT.'seminar_7/mit-allen-sinnen.htm';
	$link_08 = $ROOT.'seminar_8/ich-will-mich-spueren---sensorische-integration.htm';
	$link_09 = $ROOT.'seminar_9/gib-den-kindern-raum.htm';
	$link_10 = $ROOT.'seminar_10/walderlebnisse.htm';
	$link_11 = $ROOT.'seminar_11/wir-wollen-uns-bewegen.htm';
	$link_12 = $ROOT.'seminar_12/kinderschutz.htm';

	$link_entwicklungsfragen = $ROOT.'entwicklungsfragen.htm';
	$link_angebote = $ROOT.'mein_angebot.htm';
?>
