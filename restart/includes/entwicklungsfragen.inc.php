<?php include('language/de.inc.php'); ?>
	<div id="entwicklungsfragen" class="onepage" >
		<h2><?php echo $entwicklungsFragen['headline']; ?></h2>
		<p><?php echo $entwicklungsFragen['text1']; ?></p>
		<ul>
		<?php
			for ( $i=1; $i<=count($entwicklungsFragen['topics']); $i++) {
				echo '<li>'.$entwicklungsFragen['topics'][$i].'</li>';
			} # alle topics
		?>	
		</ul>	
		<p><?php echo $entwicklungsFragen['text2']; ?></p>
	</div>
