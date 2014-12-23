
<?php define ('Zeit', time()); // Startzeit des Scripts setzen

$isSpam = true;
if (!isset($_POST['heiteitei'])) { /* Feld fehlt ->Spam */ }
elseif (!is_numeric($_POST['heiteitei'])) { /* Manipulierung ->Spam */ }
elseif (intval($_POST['heiteitei']) > Zeit-10) { /* zu schnell ->Spam */ }
elseif (intval($_POST['heiteitei']) < Zeit-10*3600) { /* altes Formular ->Spam */ }
else { /* kein Spamï¿½ -> ggf. weitere Prï¿½fungen und Verarbeitung des Eintrages */ }
  $isSpam = false;

if ( $isSpam === true ) {
  $betreff = 'SPAM -> Ferienhaus   '. $_POST['now'];
} else {
  $betreff = 'duBele Kontakt ';
} # spam J/N

# Nachricht geschrieben???
if (isset($_POST['fh_kontakt_action']) && $_POST['fh_kontakt_action']=='gesendet' && $isSpam==false ) {

	$nachricht = "Hallo Nicole,";
	$nachricht .= "\r\n Du hast eine neue Nachricht über das duBele-Kontaktformular";
	$nachricht .= "\r\n -----------------------------------------------------------------";
	$nachricht .= "\r\n ";
	$nachricht .= "\r\n Betreff: " .paranoid($_POST['fh_kontakt_betreff']);
	$nachricht .= "\r\n Name: " .paranoid($_POST['fh_kontakt_name']);
	$nachricht .= "\r\n Erreichbar unter: " .paranoid($_POST['fh_kontakt_erreichbar']);
	$nachricht .= "\r\n ";
	$nachricht .= wordwrap( paranoid($_POST['fh_kontakt_nachricht']), 70 );
	$nachricht .= "\r\n ";
	$nachricht .= "\r\n -----------------------------------------------------------------";
	
	$header = 'From: kontaktform@dubele.de' . "\r\n" .
	    'Reply-To: noreply@dubele.de' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();
	  
	  mail($mailTo, $betreff, $nachricht, $header );
	
	?>  
	  <!-- Nachricht ist versendet -->
	 <div id="fh_kontaktform_wrapper" > 
	  <div id="fh_kontaktform_response" >
	      <p>Vielen Dank f&uuml;r Ihre Nachricht.</p>
	      <?php if (($_POST['fh_kontakt_erreichbar'])<>"") { ?>
	      <p>Ich melde mich &uuml;ber die angegebene Kontaktm&ouml;glichkeit.</p>
	      <?php } else { ?>
	      <p>Sie haben keine Kontaktm&ouml;glichkeit angegeben. Ich kann leider nicht antworten.</p>
	      <?php }?>
	      <p>Durch Bewegung lernen - dubele.de - Nicole H&uuml;bel</p>
	    </div>  <!-- #fh_kontaktform_response -->
	  </div>  <!-- #fh_kontaktform_wrapper -->
<?php  
} else { # &Uuml;ber Nachricht aufgerufen
?>
  
<form id="fh_kontaktform" name="fh_kontaktform" action="#" method="post" >
 <input type="hidden" name="fh_kontakt_action" value="gesendet" />
 <div id="fh_kontaktform_wrapper" >
     <h1>Kontakt</h1>
    <div class="fh_kontaktitem">
      <div class="fh_kontaktlabel">Name:</div>
      <input type="text" name="fh_kontakt_name" class="fh_kontakt_input" size="50" value="<?php echo $_POST['fh_kontakt_name']; ?>" />
    </div>
    <!-- honeypott -->
    <p class="nosee">
      <label for="email">Ihre E-Mail wird nicht abgefragt. Tragen Sie hier bitte NICHTS ein:</label>
      <input id="email" name="email" size="60" value="" />
      <input name="now" type="hidden" value="<?php echo time(); ?>" />
    </p>
    
    <div class="fh_kontaktitem">
      <div class="fh_kontaktlabel">Betreff:</div>
      <input type="text" name="fh_kontakt_betreff" class="fh_kontakt_input" size="50" value="<?php echo $_POST['fh_kontakt_betreff']; ?>" />
    </div>
    <div class="fh_kontaktitem">
      <div class="fh_kontaktlabel">Wie kann ich Sie erreichen?<br /> ( E-Mail, Tel ):</div>
      <input type="text" name="fh_kontakt_erreichbar" class="fh_kontakt_input" size="50" value="<?php echo $_POST['fh_kontakt_erreichbar']; ?>" />
    </div>
    <div class="fh_kontaktitem">
      <div class="fh_kontaktlabel">Ihre Nachricht:</div>
      <textarea name="fh_kontakt_nachricht" class="fh_kontakt_input" cols="50" rows="10" ><?php echo $_POST['fh_kontakt_nachricht']; ?></textarea>
    </div>
    <div class="fh_kontaktitem">
			<button onclick="submit();" >absenden</button>				
    </div>
 </div>  <!-- #fh_kontaktform_wrapper -->
</form> <!-- #fh_kontaktform -->

<?php } ?>
