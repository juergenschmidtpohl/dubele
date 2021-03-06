<?php
include('global/konstanten.php5');
include('global/global.config.inc.php');
include('global/connect.php5');
include('bib/tools.bib.php');
include('bib/function.dubele.bib.php');

$wellenClass = 'class="'.getWellenFarbe().'"';
#$wellenClass = 'class="gruen"';
$seite = paranoid($_GET['seite']);
?>
<!DOCTYPE html>

<html>
    <head>
      <meta charset="UTF-8" />

		<script type="text/javascript">
		
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-46844857-1']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		</script>		

		<script src="scripts/tagcanvas.min.js" type="text/javascript"></script>
    	<script type="text/javascript">
      window.onload = function() {
			TagCanvas.textFont = '"Playfair Display", serif';
			TagCanvas.textColour = '#47423F';
			TagCanvas.textHeight = 25;
			TagCanvas.outlineColour = '#c5c66d';
			TagCanvas.outlineThickness = 5;
			TagCanvas.outlineOffset = 1;
			TagCanvas.outlineMethod = 'block';
			TagCanvas.maxSpeed = 0.06;
			TagCanvas.minBrightness = 0.1;
			TagCanvas.depth = 0.95;
			TagCanvas.pulsateTo = 0.2;
			TagCanvas.pulsateTime = 0.75;
			TagCanvas.decel = 0.9;
			TagCanvas.reverse = true;
			TagCanvas.hideTags = true;
			TagCanvas.shadow = '#ccf';
			TagCanvas.shadowBlur = 10;
			TagCanvas.wheelZoom = true;
 		   TagCanvas.fadeIn = 800;
        try {
          TagCanvas.Start('myCanvas','tags');
        } catch(e) {
          // something went wrong, hide the canvas container
          document.getElementById('myCanvasContainer').style.display = 'none';
        }
      };
    	</script>		  

    	<title>Durch Bewegung lernen</title>
    	<link href='http://fonts.googleapis.com/css?family=Playfair+Display|Roboto+Slab' rel='stylesheet' type='text/css' />
		<meta name="description" content="Fortbildung und Beratung f&uuml;r ErzieherInnen in Anlehnung an die Bildungsempfehlungen von Rheinland-Pfalz.)" />
		<meta name="robots" content="index, follow" />
      <meta name="keywords" content="fortbildung, weiterbildung, erzieher, erzieherinnen, rheinland-pfalz" />
      <meta name="keywords" content="sprachentwicklung, erziehung, sprachf&ouml;rderung, motop&auml;die" />
		<link rel="shortcut icon" href="dubele.ico" type="image/x-icon">
      <link rel="stylesheet" type="text/css" href="<?php echo $ROOT;?>styles/style.css" />    
    </head>
    <body>
        <div id="content-wrapper">
        		<header class="zentriert_960">
        			<a href="<?php echo $THIS_PAGE; ?>">
						<img src="<?php echo $ROOT; ?>bilder/logo.png" alt="duBele.de - Nicole Hübel" title="" />  	
					</a>	
        		</header>
				<div class="clear"></div>
            <div id="main" class="zentriert_960">
            	<div id="navigation-wrapper">
	   	     		<nav>
	      	  			<ul>
								<li<?php if ($seite=='home' || $seite=='') echo $activClass; ?> >
									<a href="<?php echo $ROOT;?>home.htm">Home</a>
								</li>						
								<li<?php if ($seite=='liste' || $seite=='seminar') echo $activClass; ?> >
			<!--						<a href="<?php echo $ROOT; ?>seminarangebot.htm">Seminarprogramm</a>-->
									<a href="<?php echo $ROOT; ?>/index.php?seite=liste">Seminarprogramm</a>
								</li>						
								<li 
									<?php 
										if ($seite=='unternehmen' || 
										    $seite=='angebote' || 
										    $seite=='entwicklungsfragen' || 
										    $seite=='vita' || 
										    $seite=='anfahrt') {
										    		echo $mainpointActive;
										    } else { 
										    		echo $mainpoint; 
										    }?> >
									<a href="<?php echo $ROOT; ?>entwicklungsfragen.htm">Mein Unternehmen</a>
									<ul class="submenu">
										<li<?php if ($seite=='entwicklungsfragen') echo $activClass; ?>><a href="<?php echo $ROOT; ?>entwicklungsfragen.htm">Entwicklungsfragen</a></li>									
										<li<?php if ($seite=='angebote') echo $activClass; ?>><a href="<?php echo $ROOT; ?>mein_angebot.htm">Angebote</a></li>									
										<li<?php if ($seite=='vita') echo $activClass; ?>><a href="<?php echo $ROOT; ?>vita.htm">Vita</a></li>									
										<li<?php if ($seite=='anfahrt') echo $activClass; ?>><a href="<?php echo $ROOT;	?>anfahrt.htm">Anfahrt</a></li>									
									</ul>						
								</li>
								<li<?php if ($seite=='bolle') echo $activClass; ?> >
									<a href="<?php echo $ROOT;	?>bolle.htm">Bolle</a>
								</li>									
								<li<?php if ($seite=='kontakt') echo $activClass; ?> >
									<a href="<?php echo $ROOT;	?>kontakt.htm">Kontakt</a>
								</li>						
								<li<?php if ($seite=='impressum') echo $activClass; ?> >
									<a href="<?php echo $ROOT; ?>impressum.htm">Impressum</a>
								</li>						
							</ul>	        		
	   		 		</nav>
						<div class="clear"></div>
	        		</div> <!-- navigation-wrapper -->
	        		<div class="page-wrapper zentriert_960">
                    <?php
                    if (isset($seite) and !empty($seite)) {
#                    		echo $seite;
                        switch ($seite) {
                            case 'liste':
                                include('includes/liste.inc.php');
                                break;
                            case 'seminar':
                                include('includes/seminar.inc.php');
                                break;
                            case 'unternehmen':
                                include('includes/entwicklungsfragen.inc.php');
                                break;
                            case 'entwicklungsfragen':
                                include('includes/entwicklungsfragen.inc.php');
                                break;
                            case 'angebote':
                                include('includes/angebote.inc.php');
                                break;
                            case 'vita':
                                include('includes/vita.inc.php');
                                break;
                            case 'anfahrt':
                                include('includes/anfahrt.inc.php');
                                break;
                            case 'impressum':
                                include('includes/impressum.inc.php');
                                break;
                            case 'kontakt':
                                include('includes/kontakt.inc.php');
                                break;
                            case 'anmeldung':
                                include('includes/anmeldung.inc.php');
                                break;
                            case 'bolle':
                                include('includes/bolle.inc.php');
                                break;                                
                            default:
                                include('includes/home.inc.php');
                                break;
                        } // seite
                    } else {
                        include('includes/home.inc.php');
                    }
                    ?>
               </div> <!-- .page-wrapper -->
                    
            </div> <!-- #main -->
            <footer>
            <?php
	            include('includes/footer.inc.php');
            ?>
            </footer>
				<div id="welle" <?php echo $wellenClass; ?> >
				</div>  <!-- #welle -->
        </div> <!-- #content_wrapper -->
    
	 </body>	
</html>
