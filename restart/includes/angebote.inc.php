<?php include('language/de.inc.php'); ?>
	<div id="angebote" class="onepage" >
		<h2><?php echo $vorRede['headline']; ?></h2>
		<p><?php echo $vorRede['text1']; ?></p>
		<ul>
		<?php
			for ( $i=1; $i<=count($vorRede['topic']); $i++) {
				echo '<li>'.$vorRede['topic'][$i].'</li>';
			} # alle topics
		?>	
		</ul>	
		<br />
		<h2><?php echo $vorRede['bolle_headline']; ?></h2>
		<?php
			for ( $i=1; $i<=count($vorRede['bolle']); $i++) {
				echo '<p>'.$vorRede['bolle'][$i].'</p>';
			} # alle topics
		?>	
	</div>
