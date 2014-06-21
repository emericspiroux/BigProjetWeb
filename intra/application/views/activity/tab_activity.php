<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>
<div class="table-responsive" >
<?php
	if (is_object($tab_activity))
	{
		echo "<table class='table table-hover table-responsive'>";
		echo "<tr>";
		if (isset($root) && !isset($id) && !isset($add))
		echo "<th>Modify</th>";
		echo "<th>Name</th>
		<th>Type</th>
					<th>Description</th>
					<th>Register Date</th>
					<th>Begin Date</th>
					<th>Peer Date<br>Nb peer</th>
					<th>End Date</th>
					<th>Groupe</th>
					<th>Places</th>
					<th>Add</th>
					";
		if (isset($root) && !isset($id))
			echo "<th>Delete</th>";
		echo"</tr>";

		foreach ($tab_activity->result() as $value)
		{
			if ($value->groupe == 0)
				$groupe = "<span class='glyphicon glyphicon-unchecked' ></span>";
			else if ($value->groupe == 1)
				$groupe = $value->nb_groupe."<span class='glyphicon glyphicon-expand' ></span> <br>Auto.";
			else
				$groupe = $value->nb_groupe."<span class='glyphicon glyphicon-expand' ></span> <br>Man.";
			if (!isset($id))
			{
				echo "<tr>";
				if (isset($root) && !isset($id) && !isset($add))
				{
					$data = array();
					$data['style'] = "color:white";
					echo "<td><a href='".base_url().'activity/modify/'.$activity_name.'/'.$id_mod.'/'.$value->id."'><button type='button' class='btn btn-warning' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-pencil'></span></button></td>";
				}
				echo "<td><span style='vertical-align:-0.8em;'>";
				echo anchor(base_url().'activity/show/'.$activity_name.'/'.$value->id, str_replace('_', ' ', utf8_decode($value->name)))."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->type."</span></td>
						<td><span style='vertical-align:-0.8em;'> ".substr(utf8_decode($value->description), 0, 35)."...</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_reg."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_beg."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_peer." ( peer: ".$value->nb_peer." )</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_end."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$groupe."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->nb_place."</span></td>";
				$data = array();
				$data['style'] = "color:white";
				$disabled = "";
				if (!isset($register))
					$disabled = "disabled='disabled'";
				if (!isset($value->inscrit))
				{
					if ($value->nb_place == 0)
						echo '<td><a href="#"><button type="button" class="btn btn-warning" disabled="disabled" style="position:relative;top:0.3em;width:7em;" >Full</button></a></td>';
					else if (strtotime($value->date_reg) <= strtotime(date("Y-m-d H:t")) && strtotime($value->date_beg) >= strtotime(date("Y-m-d")))
					{
						if ($value->groupe == 0)
							echo '<td><a href="'.base_url().'activity/register/'.$activity_name."/".$value->id.'"><button type="button" class="btn btn-success"  '.$disabled.' style="position:relative;top:0.3em;width:7em;" >Register</button></a></td>';
						else if ($value->groupe == 2)//manu
							echo '<td><a href="'.base_url().'activity/register_group/'.$id_mod."/".$activity_name."/".$value->id.'/'.$value->nb_groupe.'"><button class="btn btn-success" style="position:relative;top:0.3em;width:7em;">Group Reg.</button></td>';
						else if ($value->groupe == 1)//auto
							echo '<td><a href="'.base_url().'activity/register/'.$activity_name."/".$value->id.'"><button type="button" class="btn btn-success"  '.$disabled.' style="position:relative;top:0.3em;width:7em;" >Group Reg.</button></a></td>';
					}
					else if (strtotime($value->date_beg) < strtotime(date("Y-m-d H:t")))
						echo '<td><a href="'.base_url().'activity/register/'.$activity_name."/".$value->id.'"><button type="button" disabled="disabled" class="btn btn-danger" style="position:relative;top:0.3em;width:7em;" >Too Late</button></a></td>';
					else if (strtotime($value->date_reg) > strtotime(date("Y-m-d H:t")))
						echo '<td><a href="'.base_url().'activity/register/'.$activity_name."/".$value->id.'"><button type="button" disabled="disabled" class="btn btn-success" style="position:relative;top:0.3em;width:7em;" >Shortly</button></a></td>';
				}
				else if (isset($value->inscrit))
				{
					echo '<td><a href="'.base_url().'activity/unregister/'.$activity_name."/".$value->id.'"><button type="button" class="btn btn-danger" style="position:relative;top:0.3em;width:7em;" >Unregister</button></a></td>';
				}
				if (isset($root))
				{
					$data = array();
					$data['style'] = "color:white";
					echo "<td><a href='".base_url().'activity/delete/'.$activity_name.'/'.$id_mod.'/'.$value->id."'><button type='button' class='btn btn-danger' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-trash'></span></button></td>";
				}
				echo "</td></tr>";
			}
			else
			{
				if ($id !== $value->id)
				{
					echo "<tr>";
					if (isset($root) && !isset($id))
					{
						$data = array();
						$data['style'] = "color:white";
						echo "<td><a href='".base_url().'activity/modify/'.$activity_name.'/'.$id_mod.'/'.$value->id."'><button type='button' class='btn btn-warning' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-pencil'></span></button></td>";
					}
					echo "<td><span style='vertical-align:-0.8em;'>";
				echo anchor(base_url().'activity/show/'.$activity_name.'/'.$value->id, $value->name)."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->type."</span></td>
						<td><span style='vertical-align:-0.8em;'> ".$value->description." </span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_reg."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_beg."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_peer."<br>( peer: ".$value->nb_peer." )</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_end."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$groupe."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->nb_place."</span></td>";
					$data = array();
					$data['style'] = "color:white";
					if (isset($register))
					{
					if (!isset($value->inscrit))
					{
						if ($value->nb_place == 0)
							echo '<td><a href="#"><button type="button" class="btn btn-warning" disabled="disabled" style="position:relative;top:0.3em;width:7em;" >Full</button></a></td>';
						else if (strtotime($value->date_reg) <= strtotime(date("Y-m-d H:t")) && strtotime($value->date_beg) >= strtotime(date("Y-m-d")))
							echo '<td><a href="'.base_url().'activity/register/'.$activity_name."/".$value->id.'"><button type="button" class="btn btn-success"  '.$disabled.' style="position:relative;top:0.3em;width:7em;" >Register</button></a></td>';
						else if (strtotime($value->date_beg) < strtotime(date("Y-m-d H:t")))
							echo '<td><a href="'.base_url().'activity/register/'.$activity_name."/".$value->id.'"><button type="button" disabled="disabled" class="btn btn-danger" style="position:relative;top:0.3em;width:7em;" >Too Late</button></a></td>';
						else if (strtotime($value->date_reg) > strtotime(date("Y-m-d H:t")))
							echo '<td><a href="'.base_url().'activity/register/'.$activity_name."/".$value->id.'"><button type="button" disabled="disabled" class="btn btn-success" style="position:relative;top:0.3em;width:7em;" >Shortly</button></a></td>';
					}

						else if (isset($value->inscrit))
						{
							echo '<td><a href="'.base_url().'activity/unregister/'.$activity_name."/".$value->id.'"><button type="button" class="btn btn-danger" style="position:relative;top:0.3em;width:7em;" >Unregister</button></a></td>';
						}
				}
					if (isset($root))
					{
						$data = array();
						$data['style'] = "color:white";
						echo "<td><a href='".base_url().'activity/delete/'.$activity_name.'/'.$id_mod.'/'.$value->id."'><button type='button' class='btn btn-danger' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-trash'></span></button></td>";
					}
					echo "</td></tr>";

					}
					else
					{
					echo form_open(base_url().'activity/modify_validation');
					$data = array();
					$data['style'] = "color:white";
					echo "	<tr>
						<td><input type='text' name='name' placeholder='Name' style='width:5em;' value='".$value->name."'></td>
						<td><SELECT name='type' value='".$value->type."'>
							<OPTION VALUE='TD'>TD</OPTION>
							<OPTION VALUE='EXAM'>EXAM</OPTION>
							<OPTION VALUE='TP'>TP</OPTION>
						</SELECT></td>
						<td><TEXTAREA rows='2'  name='description' placeholder='description' style='height:2.8em;'>".$value->description."</TEXTAREA></td>
						<td><input type='datetime-local' name='date_reg' value='".str_replace(' ', 'T', $value->date_reg)."'></td>
						<td><input type='datetime-local' name='date_beg' value='".str_replace(' ', 'T', $value->date_beg)."'></td>
						<td><input type='datetime-local' name='date_peer' value='".str_replace(' ', 'T', $value->date_peer)."'><br><input type='number' name='nb_peer' min='2' value='".$value->nb_peer."'></td>
						<td><input type='datetime-local' name='date_end' value='".str_replace(' ', 'T', $value->date_end)."'></td>
						<td><span style='vertical-align:-0.8em;'>".$groupe."</span></td>
						<td><input type='text' name='places' placeholder='Places' style='width:5em;' value='".$value->nb_place."'></td>
						<input type='hidden' name='id_mod' value='".$id_mod."'' style='width:9em;'>
						<input type='hidden' name='id_activity' value='".$value->id."'' style='width:9em;'>
						<input type='hidden' name='groupe' value='".$value->groupe."'' style='width:9em;'></td>
						<input type='hidden' name='activity_name' value='".$activity_name."'' style='width:9em;'>
						<td><button type='submit' class='btn btn-success' style='position:relative;top:0.3em;width:7em;'><span class='glyphicon glyphicon-play-circle'></span></button></td>
						<td><a href='".base_url().'activity/index/'.$activity_name."'><button type='button' class='btn btn-warning' style='position:relative;top:0.2em;'><span class='glyphicon glyphicon-chevron-up'></span></button></a></td>

					</tr>";
					echo form_close();
					}
				}
			}
			if (isset($add))
			{
			echo form_open(base_url().'activity/add_validation');
			echo "	<tr>
						<td><input type='text' name='name' placeholder='Name' style='width:5em;' value='$error_form_name'></td>
						<td><SELECT name='type'>
							<OPTION VALUE='TD'>TD</OPTION>
							<OPTION VALUE='EXAM'>EXAM</OPTION>
							<OPTION VALUE='TP'>TP</OPTION>
						</SELECT></td>
						<td><TEXTAREA rows='2'  name='description' placeholder='description' style='height:2.8em;'> $error_form_des </TEXTAREA></td>
						<td><input type='datetime-local' name='date_reg' value='$error_form_date_reg'></td>
						<td><input type='datetime-local' name='date_beg' value='$error_form_date_beg'></td>
						<td><input type='datetime-local' name='date_peer' value='$error_form_date_peer'><br><input type='number' name='nb_peer' min='2' value='".$value->nb_peer."'></td>
						<td><input type='datetime-local' name='date_end' value='$error_form_date_end'></td>
						<td><input type='radio' name='groupe' value='0'>Alone<br>
							<input type='radio' name='groupe' value='1'>Auto. Group<br>
							<input type='radio' name='groupe' value='2'>Manuel Group
							<input type='number' name='nb_groupe' min='2' placeholder='2' style='width:4em;' value='$error_form_nb_groupe'></td>
						<td><input type='text' name='places' placeholder='Places' style='width:5em;' value='$error_form_places'></td>
						<input type='hidden' name='activity_name' value='".$activity_name."' style='width:9em;'>
						<input type='hidden' name='id_mod' value='".$id_mod."'' style='width:9em;'>
						<td><button type='submit' class='btn btn-success' style='position:relative;top:0.3em;width:7em;'><span class='glyphicon glyphicon-play-circle'></span></button></td>
						<td><a href='".base_url().'activity/index/'.$activity_name."'><button type='button' class='btn btn-warning' style='position:relative;top:0.2em;'><span class='glyphicon glyphicon-chevron-up'></span></button></a></td>
					</tr>";
					echo "<input type='hidden' name='id_mod' value='".$id_mod."'' style='width:9em;'><input type='hidden' name='activity_name' value='".$activity_name."'' style='width:9em;'>";
			echo form_close();
			}
			if (isset($root) && !isset($add))
			{
					$data = array();
					$data['style'] = "color:white";
			echo "<tr><td><a href='".base_url().'activity/add/'.$activity_name.'/'.$id_mod."'><button type='button' class='btn btn-primary' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-plus'></span></button></a></td></tr>";
			}
			echo "</table>";

			if (validation_errors())
    		echo '<div class="alert alert-error bg-danger" style="border:1px solid red;color:red;width:99%;">'.validation_errors("<h5>-","</h5>").'</div>';

			}
			else
			{
		echo "<h1>No Activity add...</h1>";
			if (isset($root) && !isset($add))
			{
			$data = array();
			$data['style'] = "color:white";
			echo "<br><a href='".base_url().'activity/add/'.$activity_name.'/'.$id_mod."''><button type='button' class='btn btn-primary' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-plus'></span></button></a>";
			}
			if (isset($add))
			{
			echo "<table class='table table-hover table-responsive'>";
			echo "<tr>";
		echo "<th>Name</th>
		<th>Type</th>
					<th>Description</th>
					<th>Register Date</th>
					<th>Begin Date</th>
					<th>Peer Date<br>Nb peer</th>
					<th>End Date</th>
					<th>Groupe</th>
					<th>Places</th>
					<th>Add</th>";
			echo"</tr>";
			echo form_open(base_url().'activity/add_validation');
			echo "	<tr>
						<td><input type='text' name='name' placeholder='Name' style='width:5em;'></td>
						<td><SELECT name='type'>
							<OPTION VALUE='TD'>TD</OPTION>
							<OPTION VALUE='EXAM'>EXAM</OPTION>
							<OPTION VALUE='TP'>TP</OPTION>
						</SELECT></td>
						<td><TEXTAREA rows='2'  name='description' placeholder='description' style='height:2.8em;'></TEXTAREA></td>
						<td><input type='datetime-local' name='date_reg'></td>
						<td><input type='datetime-local' name='date_beg'></td>
						<td><input type='datetime-local' name='date_peer'><br><input type='number' name='nb_peer' min='2'></td>
						<td><input type='datetime-local' name='date_end'></td>
						<td><input type='radio' name='groupe' value='0'>Alone<br>
							<input type='radio' name='groupe' value='1'>Auto. Group<br>
							<input type='radio' name='groupe' value='2'>Manuel Group
							<input type='number' name='nb_groupe' min='2' placeholder='2' style='width:4em;'></td>
						<td><input type='text' name='places' placeholder='Places' style='width:5em;'></td>
						<input type='hidden' name='activity_name' value='".$activity_name."'' style='width:9em;'>
						<input type='hidden' name='id_mod' value='".$id_mod."'' style='width:9em;'>
						<td><button type='submit' class='btn btn-success' style='position:relative;top:0.3em;width:7em;'><span class='glyphicon glyphicon-play-circle'></span></button></td>
						<td><a href='".base_url().'activity/index/'.$activity_name."'><button type='button' class='btn btn-warning' style='position:relative;top:0.2em;'><span class='glyphicon glyphicon-chevron-up'></span></button></a></td>
					</tr>";
			echo form_close();
			echo "</table>";
						$data = array();
			$data['style'] = "color:white";
			echo "<td><a href='".base_url().'activity/index/'.$activity_name."'><button type='button' class='btn btn-warning' style='position:relative;top:0.2em;'><span class='glyphicon glyphicon-chevron-up'></span></button></a></td>";
			if (validation_errors())
    		echo '<div class="alert alert-error bg-danger" style="border:1px solid red;color:red;width:99%;">'.validation_errors("<h5>-","</h5>").'</div>';

		}
	}
?>

