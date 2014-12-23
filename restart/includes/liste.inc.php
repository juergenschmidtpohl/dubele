<?php
$query = "SELECT * FROM dub_sem_seminare ORDER BY lfd_nr";
$alleItems = mysql_query($query);
$count = -1;
$einItem = mysql_fetch_array($alleItems, MYSQL_ASSOC);
?>

<h1 id="programm" >Seminarprogramm 2014</h1>
<?php
do {
    $lfd_nr = $einItem['lfd_nr'];
    $id = $einItem['sem_id'];
    $descr = machAnriss($einItem['info']);
	 $titel = $einItem['headline'];
	 $modul = str_replace('@', '<br />', $einItem['modultyp']);
	 $isLeft = '';
#	 $url = $THIS_PAGE . '?seite=seminar&amp;id=' . $id;
	 $url = createSeminarLink($id, $titel);
    # Zeilen- Spaltentrenner einbauen
    if ( (++$count %2 )==0 ) {
        $count=0;
        echo '<div class="clear"></div>';
        $isLeft = ' left-column';
    }
    ?>
    <!-- 2 Spalten a 450px -->
    <div class="semteaser-wrapper <?php echo $isLeft; ?>">
    	
    		<div class="left">Fortbildung&nbsp;<?php echo $lfd_nr; ?></div>
    		<div class="right"><?php echo $modul; ?></div>

        <div class="headerbox">
        	<h2>
            <a href="<?php echo $url; ?>">
	            <?php echo $titel; ?>
            </a>
        	</h2>
        </div> <!-- headerbox -->
        <div class="textbox">
            <a href="<?php echo $url; ?>">
	            <?php echo $descr; ?>
            </a>
        </div>    
           
    </div> <!-- .semteaser-wrapper -->

<?php } while ($einItem = mysql_fetch_array($alleItems, MYSQL_ASSOC)); ?>
    
<div  class="clear"></div>
