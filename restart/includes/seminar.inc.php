<?php
$item_id = paranoid($_GET['id']);
$item_id = intval($item_id);

$query = "SELECT *
            FROM dub_sem_seminare 
           WHERE dub_sem_seminare.sem_id=" . $item_id;
$alleItems = mysql_query($query);

# Fehler Seminar  nicht gefunden. Geht nur, wenn in der URL rumgebastelt wird
if ( !mysql_num_rows($alleItems) || mysql_num_rows($alleItems)<1 ) {
	echo '<h1>HAB ICH NICHT!!!</h1>'; 
#	header('Location: '. $THIS_PAGE.'/404/error.htm');
} else { # Seminarid gefunden 


	$einItem = mysql_fetch_array($alleItems, MYSQL_ASSOC);
	
	$query = "SELECT *
	            FROM dub_top_topics 
	           WHERE dub_top_topics.sem_id=" . $item_id;
	$alleTopics = mysql_query($query);
	$einTopic = mysql_fetch_array($alleTopics, MYSQL_ASSOC);
	
	$lfd_nr = $einItem['lfd_nr'];
	$id = $einItem['sem_id'];
	$descr = $einItem['info'];
	$titel = $einItem['headline'];
	$modul = str_replace('@', '<br />', $einItem['modultyp']);
	$hinweis  = $einItem['hinweis'];
	$kostenInEuro = $einItem['kosten'];
	$dauerInTagen = $einItem['laenge'];
	
	?>
	
	<article class="seminar-detailbox">
		<div class="titelbox">
		    <h1><?php echo $titel; ?></h1>
	   </div> <!-- .titelbox -->
		<div class="fbbox">
			<div class="fb">Fortbildung</div>
			<div class="lfdnr"><?php echo $lfd_nr; ?></div>	
		</div> <!-- .fbbox -->
		<div class="left">    
			<div class="topicbox">
				<ul>
				<?php	 do {	?>		
						<li><?php echo $einTopic['topic'];?></li>
				<?php } while ($einTopic = mysql_fetch_array($alleTopics, MYSQL_ASSOC)); ?>
				</ul>
			</div> <!-- .topicbox -->
	
			<div class="terminbox">
				<h2>Termine</h2>
				<?php 
					#  Ausnahmen : id 14 / 15
					switch ($id) {
					    case 14:
				    	    ?>
				    	    <strong>1.Staffel:</strong>&nbsp;19./20.01.; 24.-26.02.; 26./27.03. 2015<br />
				    	    jeweils von 9.00 bis 15.30 Uhr.
				    	    <form action="<?php echo $ROOT; ?>global/validate.form.inc.php" method="post">
								<input type="hidden" value="anmeldung" name="formfilled">
								<input type="hidden" value="27" name="termin">
								<input type="hidden" value="staffel_1" name="staffel">
								<button onclick="submit()">anmelden</button>
							</form>
							<br />
				    	    <strong>2.Staffel:</strong>&nbsp;18./19.05.; 01.-03.06.; 20./21.07. 2015<br />
				    	    jeweils von 9.00 bis 15.30 Uhr.
				    	    <form action="<?php echo $ROOT; ?>global/validate.form.inc.php" method="post">
								<input type="hidden" value="anmeldung" name="formfilled">
								<input type="hidden" value="28" name="termin">
								<input type="hidden" value="staffel_2" name="staffel">
								<button onclick="submit()">anmelden</button>
							</form>
							<br />
				    	    <strong>3.Staffel:</strong>&nbsp;28./29.09.; 12.-14.10.; 16./17.11. 2015 <br />
				    	    jeweils von 9.00 bis 15.30 Uhr.
				    	    <form action="<?php echo $ROOT; ?>global/validate.form.inc.php" method="post">
								<input type="hidden" value="anmeldung" name="formfilled">
								<input type="hidden" value="29" name="termin">
								<input type="hidden" value="staffel_3" name="staffel">
								<button onclick="submit()">anmelden</button>
							</form>
							<div>
								Kosten f&uuml;r das 7-t&auml;gige Seminar: 195,-&nbsp;&euro;
							</div>		

							<?php
				        	break;
					    case 15:
					        ?>
							<strong>1.Staffel:</strong>&nbsp;29./30.01.2015 und 05./06.03.2015 von 9.00 bis 15.30 Uhr 
				    	    <form action="<?php echo $ROOT; ?>global/validate.form.inc.php" method="post">
								<input type="hidden" value="anmeldung" name="formfilled">
								<input type="hidden" value="30" name="termin">
								<input type="hidden" value="staffel_1" name="staffel">
								<button onclick="submit()">anmelden</button>
							</form>
							<strong>2.Staffel:</strong>&nbsp;30./31.07.2015 und 10./11.08.2015 von 9.00 bis 15.30 Uhr
				    	    <form action="<?php echo $ROOT; ?>global/validate.form.inc.php" method="post">
								<input type="hidden" value="anmeldung" name="formfilled">
								<input type="hidden" value="31" name="termin">
								<input type="hidden" value="staffel_2" name="staffel">
								<button onclick="submit()">anmelden</button>
							</form>			
							<div>
								Kosten f&uuml;r das 4-t&auml;gige Seminar: 110,-&nbsp;&euro;
							</div>		

					        <?php
					        break;
				    default:
						erzeugeTerminbox($item_id, $kostenInEuro, $dauerInTagen, $ROOT ); 
					} 
				?>
			</div> <!-- .terminbox -->
		</div>
		<div class="right">   	
			<div class="modulbox"><?php echo $modul; ?></div> <!-- .modulbox -->
			<?php if($hinweis) { ?>
				<div class="tippbox">
					<h2>!!!</h2>
					<?php echo $hinweis; ?>
				</div> <!-- .tipp-box -->
			<?php } ?>
			
	    	<div class="infobox">
				<h2>Info</h2>    
	        	<?php echo $descr; ?>
	    	</div>
		</div> <!-- right -->
	</article>  <!--  seminar_detailbox  -->
	<div class="clear">&nbsp;</div>
<?php
}  # Seminarid gefunden J/N
?>
