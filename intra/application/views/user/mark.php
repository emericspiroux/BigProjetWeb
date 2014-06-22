<?php
if (is_object($tab_mark))
{
	$door = true;
	$re_module = " ";
	$re_activity = " ";
	foreach ($tab_mark->result() as $value)
	{
		if ($re_module != $value->name_module)
			{
				if ($re_module != " ")
					echo "</div>";
				echo '<div class="jumbotron col-xs-6 container-fluid" style="-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding-top:2em;float:left">';

				//grade
				$string_moyenne = "<span style='font-size:0.5em;'>".$value->date_end."</span>";
				if ($value->date_end < date("Y-m-d"))//WARNING TEST => '>'
				{
					$somme = 0;
					$div = 0;
					foreach ($tab_mark->result() as $avg )
					{
						if ($value->name_module == $avg->name_module)
						{
							$somme = $somme + $avg->mark;
							$div = $div + 1;
						}
					}
					$moyenne = $somme / $div;


					//Attribution des grades:
					if ($moyenne >= 8)
						$string_moyenne = "<span class='glyphicon glyphicon-certificate' style='color:#614E1A;font-size:0.5em;'></span>";
					else if ($moyenne >= 12)
						$string_moyenne = "<span class='glyphicon glyphicon-certificate' style='color:#CECECE;font-size:0.5em;'></span>";
					else if ($moyenne > 16)
						$string_moyenne = "<span class='glyphicon glyphicon-certificate' style='color:#FFD700;font-size:0.5em;'></span>";
					else
						$string_moyenne = " - ";
				}

				echo "<h2 style='position:relative;'>".str_replace('_', ' ', $value->name_module)." &nbsp<small>Rang:</small> $string_moyenne</h2>";
				$door = true;
			}
			if ($door)
			{
				$re_module = $value->name_module;
				$door = false;
			}
			echo " - $value->name_activity: $value->mark/20<br>";
	}
}
else
	echo "<div class='jumbotron col-xs-6 container-fluid' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;'> <h2>No Rate yet. </h2></div>";
?>
