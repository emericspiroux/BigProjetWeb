<?php
if (is_object($tab_groupe))
{
	$door = true;
	$groupe = 0;
	$re_gr = " ";
	foreach ($tab_groupe->result() as $value)
	{
		if ($re_gr != $value->name)
		{
			if ($re_gr != " ")
				echo "</div>";
				echo '<div class="jumbotron col-sm-5" style="-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:2.5em;padding-top:2em;float:left">';
 					echo "<div>";
 							echo "<h3 style='position:relative;top:-1em;'><span class='glyphicon glyphicon-user'></span>&nbsp;".str_replace('_', ' ', $value->name)."</h3></div><br>
							<div style='position:relative;top:-3.6em;border:1px solid black; width:100%;float:left;'></div>";
			$door = true;
		}
		if ($door)
		{
			$re_gr= $value->name;
			$door = false;
		}
		echo "<div class='col-sm-3' style='text-align:center;margin-bottom:-4em;position:relative;top:-1.5em;'><img class='img-circle' style='width:4em;height:4em;' src='".base_url().$value->img_profil."'><h3 style='position:relative;top:-1em;'><small>$value->pseudo</small></h3></div>";
	}
	echo "</div>";
}
else
{
				echo '<div class="jumbotron col-sm-6" style="-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;">';
 					echo "<div>";
 							echo "<h2><span class='glyphicon glyphicon-user'></span>&nbsp;Groupe</h2></div><br>
							<div style='position:relative;bottom:2em;border:1px solid black; width:100%;'></div>";
							echo "<h2>No Group.</h2>";
					echo "</div>";
}
?>
