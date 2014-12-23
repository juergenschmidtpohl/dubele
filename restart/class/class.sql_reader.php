<?php
/**
*
* @author < >
* @version 
* @module
*/

/**
*
*/
class sql_reader
{
  private $host = '';
  private $user = '';
  private $password = '';
  private $database = '';
  private $db_handle = '';
  private $query = '';
  private $result = NULL;
  private $rows_affected = 0;
  
  
  function __construct($host, $user, $pw, $db, $open) {
    $this->host = $host;
    $this->user = $user;
    $this->password = $pw;
    $this->database = $db;
    if ( $open ) $this->open();
  } // constructor

  function __destruct() {
    $this->close();
  }
  
  private function open() {
    $link = mysql_connect( $this->host, $this->user, $this->password );
    if ( $link ) { 
      $this->db_handle = $link;
      if (!mysql_select_db($this->database)) {
        die('Tabelle kann nicht ge&ouml;ffnet werden.');
      }
      // error
    } else {
      die('Datenbank kann nicht ge&ouml;ffnet werden.');  
    }  
  } // open
  
  private function displayError() {
    $errNo =  mysql_errno($this->db_handle);
    if ( $errNo != 0 ) {
      echo '<h3> MySQL :: Error ';
      echo $errNo.' :: ';
      echo mysql_error($this->db_handle).'</h3>';
    }
  } // displayError
  
  public function close() { mysql_close($this->db_handle); }

  public function setQuery($query) { $this->query = $query; }
  public function getQuery() { return $this->query; }  
  
  public function getRows_affected() { return $this->rows_affected; }
  
  public function read_query() {
    # $query auf Befehl pr&uuml;fen RegEx!!
    $res = mysql_query( $this->query, $this->db_handle );
    if ( is_resource($res) ) {
      $this->rows_affected = mysql_num_rows( $res );
      $this->result = $res;
    } else {  # AbfrageFehler
      $this->displayError();
      $this->rows_affected = -1;
      $this->result = NULL;
    }  
  } 
  
  public function getResult() { return $this->result; }
  
  
  
}
  
?>