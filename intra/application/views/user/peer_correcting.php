<?php

if ((is_object($tab_peer) && is_object($tab_user)) || is_object($tab_group_peer) || is_object($tab_group_user))
{
	//alone
	if (is_object($tab_peer) && is_object($tab_user))
	{
		echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;margin:1em;'>";
		echo "<div><h2><span class='glyphicon glyphicon-stats'></span>&nbsp;Peer-correcting</h2></div><br>
	<div style='position:relative;bottom:2em;border:1px solid black; width:100%;margin-bottom:-2.6em;'></div>
		<div class='row'>
		<div class='col-sm-6'>";
		$door = true;
		$re_activity = " ";
		foreach($tab_peer->result() as $value)
		{
				if ($re_activity != $value->name)
				{
					echo "<h2><small>".str_replace('_', ' ', $value->name)."</small></h2>";
					$door = true;
				}
				if ($door)
				{
					$re_activity = $value->name;
					$door = false;
				}

				//watch if correction is do, save or not.
				echo "- Correction of ";
				if ($value->accept == 1)
					echo " ".$value->pseudo." finish <span class='glyphicon glyphicon-ok'></span> (note : $value->mark)<br>";
				else if ($value->save == 1)
					echo "<a href='".base_url()."peer_correcting/correct/".$value->id_activity."/".$value->id_teacher."/".$value->id_student."'>".$value->pseudo."</a> <span class='glyphicon glyphicon-floppy-saved'></span><br>";
				else
					echo "<a href='".base_url()."peer_correcting/correct/".$value->id_activity."/".$value->id_teacher."/".$value->id_student."'>".$value->pseudo."</a><br>";
		}
			echo "</div>";

			echo "<div class='col-sm-6' style='position:relative;top:-4em;'>";
		echo "<h2>&nbsp;</h2>";
		$re_activity = " ";
		$door = true;
		foreach($tab_user->result() as $value)
		{
				if ($re_activity != $value->name)
				{
					echo "<h2><small>".str_replace('_', ' ', $value->name)."</small></h2>";
					$door = true;
				}
				if ($door)
				{
					$re_activity = $value->name;
					$door = false;
				}
				if ($value->accept)
					echo "- Your correction of <a href='".base_url()."peer_correcting/my_correct/".$value->id_activity."/".$value->id_teacher."/".$value->id_student."'>".$value->pseudo."</a> (note : $value->mark)<br>";
				else
					echo "- Your correction of ".$value->pseudo." <span class='glyphicon glyphicon-remove'></span><br>";
		}
			echo "</div>";
	}

	if (is_object($tab_group_peer) || is_object($tab_group_user))
	{
	//Group peer
		if (!is_object($tab_peer) && !is_object($tab_user))
			echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;margin:1em;'><div><h2><span class='glyphicon glyphicon-stats'></span>&nbsp;Peer-correcting</h2></div><br>
	<div style='position:relative;bottom:2em;border:1px solid black; width:100%;margin-bottom:-2.6em;'></div><div class='row'>";
		echo "
		<div class='col-sm-6'>";
		if (is_object($tab_group_peer))
		{
			$door = true;
			$re_activity = " ";
			foreach($tab_group_peer->result() as $value)
			{
					if ($re_activity != $value->name_activity)
					{
						echo "<h2><small>".str_replace('_', ' ', $value->name_activity)."</small></h2>";
						$door = true;
					}
					if ($door)
					{
						$re_activity = $value->name_activity;
						$door = false;
					}

					//watch if correction is do, save or not.
					echo "- Correction of ";
					if ($value->accept == 1)
						echo " ".$value->name_groupe." finish <span class='glyphicon glyphicon-ok'></span> (note : $value->mark)<br>";
					else if ($value->save == 1)
						echo "<a href='".base_url()."peer_correcting/correct_groupe/".$value->id_activity."/".$value->id_teacher."/".$value->id_groupe."'>".$value->name_groupe."</a> <span class='glyphicon glyphicon-floppy-saved'></span><br>";
					else
						echo "<a href='".base_url()."peer_correcting/correct_groupe/".$value->id_activity."/".$value->id_teacher."/".$value->id_groupe."'>".$value->name_groupe."</a><br>";
			}
		}
		echo "</div>
		<div class='col-sm-6' style='position:relative;top:-4em;'>";
		echo "<h2>&nbsp;</h2>";
		if (is_object($tab_group_user))
		{
				$re_activity = " ";
				$door = true;
				foreach($tab_group_user->result() as $value)
				{
						if ($re_activity != $value->name_activity)
						{
							echo "<h2><small>".str_replace('_', ' ', $value->name_activity)."</small></h2>";
							$door = true;
						}
						if ($door)
						{
							$re_activity = $value->name_activity;
							$door = false;
						}
						if ($value->accept)
							echo "- Your correction of <a href='".base_url()."peer_correcting/my_correct_groupe/".$value->id_activity."/".$value->id_teacher."/".$value->id_groupe."'>".$value->pseudo."</a> (note : $value->mark)<br>";
						else
							echo "- Your correction of ".$value->pseudo." <span class='glyphicon glyphicon-remove'></span><br>";
				}
		}
			echo "</div>";
			echo "</div>";
			echo "</div>";//div class jumbotron
	}
	else
		echo "</div>";
}
else
{
	echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;margin:1em;padding-top:1em;'>";
		echo "<div><h2><span class='glyphicon glyphicon-stats'></span>&nbsp;Peer-correcting</h2></div><br>
	<div style='position:relative;bottom:2em;border:1px solid black; width:100%;margin-bottom:-2.6em;'></div>";
	echo "<h2>No Peer-correcting</h2>";
	echo "</div>";
}
?>
