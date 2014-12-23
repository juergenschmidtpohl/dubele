<?php
 
  /* lokal 
  $server='localhost';
  $user='root';
  $pw='2aTtT,midN8';
  $database='dubele';
	*/
  /* remote stage
  $server = 'db390028760.db.1and1.com';
  $user = 'dbo390028760';
  $pw = '2aTtT,midN8';
  $database = 'db390028760';
  */

  /* remote produktiv */
  $server = 'db509222041.db.1and1.com';
  $user = 'dbo509222041';
  $pw = '12huebelchen34';
  $database = 'db509222041';
  
  
  $link = mysql_connect( $server, $user, $pw )
             or die("Keine Verbindung möglich: " . mysql_error());
  mysql_select_db($database) or die("Auswahl der Datenbank ".$database." fehlgeschlagen");
  

?>