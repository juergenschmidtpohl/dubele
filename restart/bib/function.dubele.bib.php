<?php

	#
	# spezielle Aufgaben für dubele
	#
	
	function ersterTag( $dat ) {
		return(substr($dat, 8, 2) . '.');
	}	

	function getWellenFarbe() {
		$aColors=array( 'bg_rot','bg_gruen','bg_blau','bg_violett','bg_gelb','bg_tuerkis','bg_oliv');
		$i = rand(0,count($aColors)-1);
		return $aColors[$i];
	}
	
	#######################################
	#   Suchmaschinenfreundliche URL für ein Seminar 
	#
	function createSeminarLink($id, $text) {
		$url = $ROOT.'seminar_'.$id.'/'.makeUrlText($text).'.htm';
		return $url;
		}

	#######################################
	#   Zeiten / Kosten etc. zusammensuchen und Formatieren
	#
	function erzeugeTerminbox( $sem_id, $kosten, $tage, $root ) {
		$query = "SELECT *
      		      FROM dub_ter_termine 
           		WHERE dub_ter_termine.sem_id=" . $sem_id . 
		           " ORDER BY erster_tag";
		$alleTermine = mysql_query($query);
		$einTermin = mysql_fetch_array($alleTermine, MYSQL_ASSOC);
		$first = true;
		do {		
			echo ersterTag($einTermin['erster_tag']).'/'.
					str_replace( ' ', '', FormatiereDatum($einTermin['zweiter_tag'], 1 ));
			if ($first) {
					$first=false;
					echo ' oder ';
			} else {
				echo ' '.$einTermin['Uhrzeit'];
			}	# erster Tag J/N 
					
					if ($einTermin['freieplaetze']>0 ) {
					?>
						<form method="post" action="<?php echo $root; ?>global/validate.form.inc.php" >
							<input name="formfilled" type="hidden" value="anmeldung" />
							<input name="termin" type="hidden" value="<?php echo $einTermin['ter_id']; ?>" />
							<button onclick="submit()">anmelden</button>
						</form>
					<?php	
					} else { // seminar voll
					?>
						<span>Seminar ausgebucht</span>				
					<?php	
					} // Plätze frei J/N
					
					?>
		<?php } while ($einTermin = mysql_fetch_array($alleTermine, MYSQL_ASSOC));
		# Kosten & Länge
		?>
		<div>
			<?php
				echo 'Kosten f&uuml;r das '.$tage.'-t&auml;gige Seminar:';
			?>
		</div>		
		<div>
			<?php
				echo $kosten.',-&nbsp;&euro;';
			?>
		</div>		
		<?php
	}  # erzeugeTerminbox
?>
