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
				<?php erzeugeTerminbox($item_id, $kostenInEuro, $dauerInTagen, $ROOT ); ?>
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
