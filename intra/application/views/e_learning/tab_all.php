<?php
	if (is_object($tab_all_stuff))
	{
		$door = true;
		$re_module = " ";
		$re_activity = " ";
		foreach ($tab_all_stuff->result() as $value)
		{
			if ($re_module != $value->name_module)
			{
				if ($re_module != " ")
					echo "</div>";
				echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;width:46%;float:left;'>";
				echo "<h2 style='position:relative;top:-0.5em;margin-bottom:-1em;'>".str_replace('_', ' ', $value->name_module)."</h2>";
				$door = true;
			}
			if ($door)
			{
				$re_module = $value->name_module;
				$door = false;
			}

			if ($re_activity != $value->name_activity)
			{
				echo "<h2><small>".str_replace('_', ' ', $value->name_activity)."</small></h1>";
				$door = true;
			}
			if ($door)
			{
				$re_activity = $value->name_activity;
				$door = false;
			}
			echo "<div><a href='".base_url()."e_learning/learning/".$value->name_module.'/'.$value->name_activity.'/'.str_replace(' ', '_', $value->name_e_learning)."'> - ".str_replace('_', ' ', $value->name_e_learning)."</a></div>";
		}
	}
	else
	{
		echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;width:46%;float:left;'><h2>No E-learning...</h2></div>";
	}
?>
