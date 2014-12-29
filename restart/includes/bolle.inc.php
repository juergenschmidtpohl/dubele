<?php include('language/de.inc.php'); ?>
<div class="bolle onepage">
	<h2><?php echo $bolle['headline']; ?></h2>
	<p><?php echo $bolle['absatz'][1]; ?></p>
	<p><?php echo $bolle['absatz'][2]; ?></p>
	<p><?php echo $bolle['absatz'][3]; ?></p>
	<p><?php echo $bolle['absatz'][4]; ?></p>
	<div class="halb left">
		<ul>
		<?php
			for ( $i=1; $i<=count($bolle['topic']); $i++) {
				echo '<li>'.$bolle['topic'][$i].'</li>';
			} # alle topics
		?>	
		</ul>	
	</div>
	<div class="halb right">
		<img src="bilder/bolle001.jpg" title="bolle" alt="Entlebucher Sennenhund Bolle als Therapie- und P&auml;dagogikbegleithund" />
	</div>
	<div class="clear"></div>
	<p><?php echo $bolle['absatz'][5]; ?></p>

</div> <!-- bolle -->
