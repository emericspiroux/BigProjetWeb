<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;min-height:20em;'>
<div><h2><span class='glyphicon glyphicon-stats'></span>&nbsp;Your Correction of <?if (isset($name_teacher)){ echo $name_teacher;}?> for <?if (isset($name_activity)){ echo str_replace('_', ' ', $name_activity);}?></h2></div><br>
<div style='position:relative;bottom:2em;border:1px solid black; width:100%;'></div>
<img src="<?php echo base_url().$img_teacher?>" class="img-circle" style="position:absolute;width:10em;height:10em;border:2px solid grey;left:70%;">

<?php
	if (isset($mark) && isset($feedback))
	{
		echo '<div style="position:relative;left:10%;"><h2>Note : '.$mark."</h2><br><p>".$feedback."</p><div>";
	}
	else
	{
		echo '<h3>Make your correction and come back again.</h3>';
	}
?>
</div>
