<?php
require_once('class/class.phpmailer.php');

/* AGB */
$agbheadline = "Gesch&auml;ftsbedingungen";
$agbtext = '<p><b>Anmeldung:</b><br />Alle Anmeldungen m&uuml;ssen schriftlich oder per Anmeldeformular erfolgen, in der
Regel bis 2 Wochen vor Seminarbeginn. Da ich bei allen Kursen eine Teilnehmerbeschr&auml;nkung von
maximal 15 TeilnehmerInnen habe, werden die Anmeldungen in der Reihenfolge des Eingangs
ber&uuml;cksichtigt. Die Anmeldung ist verbindlich, sobald sie von mir best&auml;tigt ist.</p>
<p><b>Abmeldung:</b><br />
Abmeldungen m&uuml;ssen schriftlich erfolgen. Bitte haben Sie Verst&auml;ndnis, dass aufgrund der 
Teilnehmerbegrenzung bei sp&auml;teren Abmeldungen oder Fernbleiben vom Seminar die Kursgeb&uuml;hr f&auml;llig ist.
Gerne kann auch eine Ersatzperson am gebuchten Seminar teilnehmen.</p>
<p><b>Seminargeb&uuml;hr:</b><br />
Die Seminargeb&uuml;hr ist nach Eingang der Seminarbest&auml;tigung, am Seminartag oder bis 10 Tage
nach der Veranstaltung f&auml;llig.</p>
<p><b>Veranstaltungsort:</b><br />
Die Seminare finden im katholischen Pfarrhaus in
Pohl statt.<br /> Eine Anfahrtsbeschreibungen finden Sie <a href="'.$mapsLink.'" target="_blank" >hier</a>.
</p>
<p><b>Haftung:</b><br />
Muss eine bereits best&auml;tigte Veranstaltung ausfallen, werde ich bereits gezahlte Kursgeb&uuml;hren erstatten
oder einen Ersatztermin anbieten. Weitergehende Anspr&uuml;che sind ausgeschlossen.</p>';
					  

$item_id = intval(paranoid($_GET['termin']));
	 
$query = "SELECT *
            FROM dub_ter_termine LEFT JOIN dub_sem_seminare ON dub_ter_termine.sem_id = dub_sem_seminare.sem_id  
           WHERE dub_ter_termine.ter_id=" . $item_id;
           
$alleItems = mysql_query($query);

# Fehler Seminar  nicht gefunden. Geht nur, wenn in der URL rumgebastelt wird
if ( !mysql_num_rows($alleItems) || mysql_num_rows($alleItems)<1 ) {
	echo '<h1>Diesen Termin gibt es nicht.</h1>'; 
} else { # Terminid gefunden 


	
	$einItem = mysql_fetch_array($alleItems, MYSQL_ASSOC);
	
	/* Seminardaten */
	$sem_id = $einItem['sem_id'];
	$sem_bezeichnung = $einItem['headline'];
	$kosten = $einItem['kosten'];
	$termin = str_replace( ' ', '', FormatiereDatum($einItem['erster_tag'], 1 ));
	
	$msgText = "Ich m&ouml;chte mich f&uuml;r das Fortbildungsseminar&nbsp;&ldquo;"
					.$sem_bezeichnung."&rdquo;&nbsp;am&nbsp;". $termin ."&nbsp;verbindlich anmelden.";
		
	$agbChecked = '';
	$displayButton = true;
	$recall = paranoid( $_POST['formfilled'] );
	
	if ($recall) { # gerufen aus selbst
		$name=paranoid($_POST['name']);
		$vorname=paranoid($_POST['vorname']);
		$position=paranoid($_POST['position']);
		$dienstjahre=paranoid($_POST['dienstjahre']);
		$strasse=paranoid($_POST['strasse']);
		$plz=paranoid($_POST['plz']);
		$ort=paranoid($_POST['ort']);
		$telefon=paranoid($_POST['telefon']);
		$email=paranoid($_POST['email']);
		$agb = paranoid($_POST['agb']);
		if ($agb) { $agbChecked = ' checked="checked"';}
		
	// prüfen	
		$errorCode=0;
		$errMsg = '';	
		if (!$name) { $errorCode+=1; $errMsg=$errMsg."Bitte einen Namen eintragen.<br />"; }	
		if (!$vorname) { $errorCode+=2; $errMsg=$errMsg."Bitte einen Vornamen eintragen.<br />"; }	
		if (!$dienstjahre) { $errorCode+=8; $errMsg=$errMsg."Bitte Ihre Dienstjahre eintragen.<br />"; }	
		if (!$strasse) { $errorCode+=16; $errMsg=$errMsg."Bitte eine Stra&szlig;e eintragen.<br />"; }	
		if (!$plz) { $errorCode+=32; $errMsg=$errMsg."Bitte eine Postleitzahl eintragen.<br />"; }	
		if (!$ort) { $errorCode+=64; $errMsg=$errMsg."Bitte einen Ort eintragen.<br />"; }	
		$pattern = '/([\w\-]+\@[\w\-]+\.[\w\-]+)/';
		if ( !$email || !preg_match ( $pattern , $email ) ) { 
			$errorCode+=256; 
			$errMsg=$errMsg."Bitte eine g&uuml;ltige E-Mail-Adresse angeben.<br />";
		}	# E-MAil fehlt oder unvollständig
		if (!$agb) { $errorCode+=512; $errMsg=$errMsg."Bitte die AGB best&auml;tigen.<br />"; }	
	
		if ($errorCode==0) {
			 $msgText = "Wir haben Sie f&uuml;r das Fortbildungsseminar&nbsp;&ldquo;"
					.$sem_bezeichnung."&rdquo;&nbsp;am&nbsp;". $termin ." vorgemerkt.<br />".
					" Eine Anmeldebest&auml;tigung erhalten Sie per E-Mail.";		
			 $displayButton = false;		
			 
		 	 # Nachricht an Nicole
		    $betreff = 'duBele Anmeldung von duBele.de';
	
			 $anmeldungFuer = "Seminar #".$sem_id.
			 						 "\r\n" .$sem_bezeichnung.
			 						 "\r\n" .$termin;
			
			 $nachricht = "Hallo Nicole,
	Du hast eine neue Anmeldung von duBele.de:
	-----------------------------------------------------------------
	
	Seminar #".$sem_id."
	 ".utf8_encode(html_entity_decode($sem_bezeichnung))."
	 am ".html_entity_decode($termin)."
	
	-----------------------------------------------------------------
	
	Name :".	$name."
	Vorname: ".	$vorname."
	Position: ".	$position."
	Dienstjahre: ". $dienstjahre."
	Strasse: ". $strasse."
	PLZ: ". $plz."
	Ort: ". $ort."
	Telefon: ". $telefon."
	E-Mail: ". $email."
	
	-----------------------------------------------------------------";
			
		$header = 'From: anmeldeformular@dubele.de' . "\r\n" .
		    'Reply-To: noreply@dubele.de' . "\r\n" .
		    'X-Mailer: PHP/' . phpversion().
			 'Mime-Version: 1.0' . "\r\n" .
			 'Content-Type: text/plain;charset=utf-8 ' . "\r\n" . 
			 'Content-Transfer-Encoding: quoted-printable';
			 			  
			 mail($anmeldungMailTo, $betreff, $nachricht, $header );
			
			 	
		 	# Bestätigung an Kunde
		 	#  mit PHPMailer
		 	#  nutzen für HTML -Bestätigung
		 	
	$mailer             = new PHPMailer();
	
	$body             = 
	'<body style="margin: 10px;">
		<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 14px;" />
			<div align="left" style="" >
				<img src="bilder/logo.png" style="height: 100px ">
			</div>
			<p style="">Hiermit bestätige ich Ihre Anmeldung für Seminar:<br /><br />
				<span style="font-weight:bold;font-size:16px;">'
					.html_entity_decode($sem_bezeichnung).
					' am '.html_entity_decode($termin).
				'</span>
			</p>
			<p style="">
			Ihre Anmeldedaten:<br />
				<ul style="list-style-type: none;">
					<li>Name: '.utf8_decode($name).'</li>
					<li>Vorname: '.utf8_decode($vorname).'</li>
					<li>Position: '.utf8_decode($position).'</li>
					<li>Dienstjahre: '.utf8_decode($dienstjahre).'</li>
					<li>Strasse: '.utf8_decode($strasse).'</li>
					<li>PLZ: '.utf8_decode($plz).'</li>
					<li>Ort: '.utf8_decode($ort).'</li>
					<li>Telefon: '.utf8_decode($telefon).'</li>
					<li>E-Mail: '.utf8_decode($email).'</li>
				</ul>
			</p>
			<p style="">
				Ihre Anreise können Sie über folgenden Link planen:<br />
				<a href="https://maps.google.de/maps?q=Kirchstra%C3%9Fe+1,+Pohl,+Rheinland-Pfalz&hl=de&ie=UTF8&ll=50.250388,7.86634&spn=0.011224,0.018239&sll=50.24971,7.864419&sspn=0.044895,0.072956&oq=Pohl,+Rheinland-Pfalz+kirchstrasse+1&hnear=Kirchstra%C3%9Fe+1,+56357+Pohl&t=m&z=16" >
					Veranstaltungsort: Katholisches Pfarrhaus, 56357 Pohl 
				</a>	
			</p>
			<p style="line-height: 1.2em;">
	Ich  bearbeite Ihre Anmeldung schnellstmöglich.<br />
	Sollten Sie nicht innerhalb von 2 Wochen eine schriftliche Bestätigung erhalten, bitten ich Sie sich mit mir telefonisch in Verbindung zu setzen (Tel: 06772 / 9185955).<br />
	Bei Rückfragen stehen ich Ihnen selbstverständlich telefonisch oder per E-Mail zur Verfügung.<br />Ich freue mich, Sie bald persönlich kennenlernen zu dürfen.<br />
			</p>
			<p style="font-weight:normal;font-size:16px;">Ihre Nicole Hübel</p>
		</div>
	</body>';
	
	$body             = eregi_replace("[\]",'',$body);
	
	$mailer->SetFrom('noreply@dubele.de', 'duBele.de');
	$mailer->AddAddress($email);
	$mailer->AddReplyTo("noreplyto@dubele.de","Webmaster");
	
	$mailer->Subject    = "Ihre Anmeldung bei duBele.de";
	$mailer->AltBody    = ""; //Text Body
	$mailer->WordWrap   = 50; // set word wrap
	
	$mailer->MsgHTML($body);
	
	$mailer->IsHTML(true); // send as HTML
	$mailer->Send();
	
		} # alles ausgefüllt
			
	} else { # erster Aufruf aus dem SeminarFenster
		$name="";
		$vorname="";
		$position="";
		$dienstjahre="";
		$strasse="";
		$plz="";
		$ort="";
		$telefon="";
		$email="";
	} # Aufruf über Seminarbutton
		
	?>
	<div class="formular-wrapper" id="form-top" >
		<div id="anm-header">
			<h1>Anmeldung</h1>
			<div class="text">
				<?php echo $msgText; ?>
			</div>	
		</div> <!-- anm-header -->
		<div class="fehler"><?php echo $errMsg; ?></div>
		<div class="left form">
			<form name="anmeldung" method="post" action="<?php $PHP_SELF; ?>#form-top" >
				<input name="formfilled" type="hidden" value="anmeldeformular" />
				<input name="termin" type="hidden" value="<?php echo $item_id; ?>" />
				<div class="formline">
					<span class="label">Name *</span>
					<input type="text" name="name" value="<?php echo $name; ?>" />
				</div>			
				<div class="formline">
					<span class="label">Vorname *</span>
					<input type="text" name = "vorname" value="<?php echo $vorname; ?>" />
				</div>			
				<div class="formline">
					<span class="label">Position</span>
					<input type="text" name = "position" value="<?php echo $position; ?>" />
				</div>			
				<div class="formline">
					<span class="label">Dienstjahre *</span>
					<input type="text" name = "dienstjahre" value="<?php echo $dienstjahre; ?>" />
				</div>			
				<div class="formline">
					<span class="label">Dienstanschrift:</span>
				</div>			
				<div class="formline">
					<span class="label">Stra&szlig;e *</span>
					<input type="text" name = "strasse" value="<?php echo $strasse; ?>" />
				</div>			
				<div class="formline">
					<span class="label">PLZ/Ort *</span>
					<input class="kleiner" type="text" name = "ort" value="<?php echo $ort; ?>" />
					<input class="klein" type="text" name = "plz" value="<?php echo $plz; ?>" />
				</div>			
				<div class="formline">
					<span class="label">Telefon</span>
					<input type="text" name = "telefon" value="<?php echo $telefon; ?>" />
				</div>			
				<div class="formline">
					<span class="label">E-Mail *</span>
					<input type="text" name = "email" value="<?php echo $email; ?>" />
				</div>			
				<div class="label long">
	Hiermit erkenne ich die nebenstehenden Gesch&auml;ftsbedingungen an.
					<input type="checkbox" name="agb" class="checkbox"<?php echo $agbChecked; ?> />
				</div>	
	
				<?php if($displayButton==true) { ?>
					<div class="text" id="kostenhinweis">
						F&uuml;r diese Anmeldung entstehen Kosten in H&ouml;he von <?php echo $kosten; ?>&nbsp;&euro;.
					</div> <!-- kostenhinweis -->
				
						<button onclick="submit();" >kostenpflichtig anmelden</button>				
				<?php } ?>	
			</form>
		</div> <!-- formular -->
		<div class="left agb">
			<h2><?php echo $agbheadline;?></h2>
			<?php echo $agbtext; ?>
		</div> <!-- agb -->
		<div class="clear">&nbsp;</div>
	</div> <!-- formular-wrapper -->
	
<?php } ?>	
