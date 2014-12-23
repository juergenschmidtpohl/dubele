<?php include('language/de.inc.php'); ?>
<article id="vita-wrapper" class="onepage" >
	<section>
		<h2><?php echo $vita['headline']; ?></h2>
		<ul>
		<?php
			for ( $i=1; $i<=count($vita['topic']); $i++) {
				echo '<li>'.$vita['topic'][$i].'</li>';
			} # alle topics
		?>	
		</ul>	
	</section>
</article> <!-- #vita-wrapper -->
