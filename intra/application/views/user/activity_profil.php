<?php
echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;'><div><h2><span class='glyphicon glyphicon-download'></span>&nbsp;Activity</h2></div><br>
<div style='position:relative;bottom:2em;border:1px solid black; width:100%;'></div>";
	if (is_object($tab_activity))
	{
		echo "<table class='table table-hover'>";
		echo "<tr>";
		echo "			<th>Name</th>
						<th>Module</th>
						<th>Description</th>
						<th>Register Date</th>
						<th>Begin Date</th>
						<th>Peer Date</th>
						<th>End Date</th>
						<th>Groupe</th>
						<th>Places</th>";
				echo "	<th>Add</th>";
		echo"</tr>";

		foreach ($tab_activity->result() as $value)
		{

			//Group icon
			if ($value->groupe == 0)
				$groupe = "<span class='glyphicon glyphicon-unchecked' ></span>";
			else if ($value->groupe == 1)
				$groupe = $value->nb_groupe."<span class='glyphicon glyphicon-expand' ></span> <br>Auto.";
			else
				$groupe = $value->nb_groupe."<span class='glyphicon glyphicon-expand' ></span> <br>Man.";

			//show info
				echo "<tr>";
				echo "<td><span style='vertical-align:-0.8em;'>";
				echo anchor(base_url().'activity/show/'.str_replace(' ', '_', $value->module_name).'/'.str_replace(' ', '_', $value->id), str_replace('_', ' ', utf8_decode($value->name)))."</span></td>
				<td><span style='vertical-align:-0.8em;'> ".str_replace('_', ' ', $value->module_name)."...</span></td>
						<td><span style='vertical-align:-0.8em;'> ".substr(utf8_decode($value->description), 0, 35)."...</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_reg."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_beg."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_peer."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_end."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$groupe."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->nb_place."</span></td>";


			//register bouton switch all possibility
			$disabled = "";
			if (!isset($value->inscrit_a))
			{
				if ($value->nb_place == 0)
						echo '<td><a href="#"><button type="button" class="btn btn-warning" disabled="disabled" style="position:relative;top:0.3em;width:7em;" >Full</button></a></td>';
				else if (strtotime($value->date_reg) <= strtotime(date("Y-m-d H:t")) && strtotime($value->date_beg) >= strtotime(date("Y-m-d")))
				{
					if ($value->groupe == 0)
						echo '<td><a href="'.base_url().'activity/register/'.str_replace(' ', '_', $value->module_name)."/".$value->id.'"><button type="button" class="btn btn-success"  '.$disabled.' style="position:relative;top:0.3em;width:7em;" >Register</button></a></td>';
					else if ($value->groupe == 2)
					{
						echo '<td><a href="'.base_url().'activity/register_group/'.$value->id_mod."/".$value->name."/".$value->id.'/'.$value->nb_groupe.'"><button class="btn btn-success" style="position:relative;top:0.3em;width:7em;">Group Reg.</button></td>';
					}
					else if ($value->groupe == 1)
							echo '<td><a href="'.base_url().'activity/register/'.str_replace(' ', '_', $value->module_name)."/".$value->id.'"><button type="button" class="btn btn-success"  '.$disabled.' style="position:relative;top:0.3em;width:7em;" >Reg. Group</button></a></td>';
				}
				else if (strtotime($value->date_beg) < strtotime(date("Y-m-d H:t")))
					echo '<td><a href="'.base_url().'activity/register/'.str_replace(' ', '_', $value->module_name)."/".$value->id.'"><button type="button" disabled="disabled" class="btn btn-danger" style="position:relative;top:0.3em;width:7em;" >Too Late</button></a></td>';
				else if (strtotime($value->date_reg) > strtotime(date("Y-m-d H:t")))
					echo '<td><a href="'.base_url().'activity/register/'.str_replace(' ', '_', $value->module_name)."/".$value->id.'"><button type="button" disabled="disabled" class="btn btn-success" style="position:relative;top:0.3em;width:7em;" >Shortly</button></a></td>';
			}
			else if (isset($value->inscrit_a))
			{
				echo '<td><a href="'.base_url().'activity/unregister/'.str_replace(' ', '_', $value->module_name)."/".$value->id.'"><button type="button" class="btn btn-danger" style="position:relative;top:0.3em;width:7em;" >Unregister</button></a></td>';
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	else
	{
		echo "<h2>

		No activity register...

		</h2>";
	}
	echo "</div>";
?>
