<?php
include('../bib/tools.bib.php');

# $THIS_PAGE = "http://localhost/dubele.de/";
  $THIS_PAGE = "http://www.dubele.de/";
#$THIS_PAGE = "http://dubele.xn--fhrungen-am-limes-22b.de/";


if ( $_POST['formfilled'] ) {
  $aufrufende_form = paranoid($_POST['formfilled']);
  switch ($aufrufende_form) {

		case 'anmeldung':
			$termin = paranoid($_POST['termin']);
#			echo '<h2>'.$termin.'</h2>'; exit();
#			header('Location: '. $THIS_PAGE.'index.php?seite=anmeldung&termin='.$termin);
			header('Location: '. $THIS_PAGE.'anmeldung/termin_'.$termin.'.htm');
		break;
			
    default: break;
  } // welche Form wurde ausfgef&uuml;llt ??

} // irgendein Formular war als letztes dran

?>