<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>
<div class="table-responsive" style="">
<?php

	if ($tab_module)
	{
		echo "<table class='table table-hover'>";
		echo "<tr>";
		if (isset($root) && !isset($id) && !isset($add))
		echo "<th>Modify</th>";
		echo "<th>Name</th>
				<th>Description</th>
				<th>Begin Date</th>
				<th>End Register</th>
				<th>End Date</th>
				<th>Points</th>
				<th>Places</th>
				<th>Subscribe</th>";
		if (isset($root))
			echo "<th>Delete</th>";
		echo"</tr>";

		foreach ($tab_module->result() as $value)
		{
			if (!isset($id))
			{
				echo "<tr>";
				if (isset($root) && !isset($id) && !isset($add))
				{
					$data = array();
					$data['style'] = "color:white";
					echo "<td><a href='".base_url().'module/modify/'.$value->id."'><button type='button' class='btn btn-warning' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-pencil'></span></button></a></td>";
				}
				echo "<td><span style='vertical-align:-0.8em;'>";
				echo anchor(base_url().'activity/index/'.$value->name.'/'.$value->id, str_replace('_', ' ', $value->name))."</span></td>
						<td><span style='vertical-align:-0.8em;'> ".$value->description." </span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_beg."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_end_register."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_end."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->nb_credit."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->nb_place."</span></td>";
				$data = array();
				$data['style'] = "color:white";
					if (!isset($value->inscrit) && ($value->nb_place > 0))
					{
						if (strtotime($value->date_beg) <= strtotime(date("Y-m-d")) && strtotime($value->date_end_register) >= strtotime(date("Y-m-d")))
							echo '<td><a href="'.base_url().'module/register/'.$value->id.'"><button type="button" class="btn btn-success" style="position:relative;top:0.3em;width:7em;" >Register</button></a></td>';
						else if (strtotime($value->date_end_register) <= strtotime(date("Y-m-d")))
							echo '<td><a href="'.base_url().'module/register/'.$value->id.'"><button type="button" disabled="disabled" class="btn btn-danger" style="position:relative;top:0.3em;width:7em;" >Too Late</button></a></td>';
						else if (strtotime($value->date_beg) >= strtotime(date("Y-m-d")))
							echo '<td><a href="'.base_url().'module/register/'.$value->id.'"><button type="button" disabled="disabled" class="btn btn-success" style="position:relative;top:0.3em;width:7em;" >Shortly</button></a></td>';
					}
				else if (isset($value->inscrit))
				{
					echo '<td><a href="'.base_url().'module/unregister/'.$value->id.'"><button type="button" class="btn btn-danger" style="position:relative;top:0.3em;width:7em;" >Unregister</button></a></td>';
				}
				else if ($value->nb_place == 0 || $value->nb_place == -1)
				{
					echo '<td><a href="#"><button type="button" class="btn btn-warning" disabled="disabled" style="position:relative;top:0.3em;width:7em;" >Full</button></a></td>';
				}
				if (isset($root))
				{
					$data = array();
					$data['style'] = "color:white";
					echo "<td><a href='".base_url().'module/delete/'.$value->id."'><button type='button' class='btn btn-danger' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-trash'></span></button></a></td>";
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
							echo "<td><a href='".base_url().'module/modify/'.$value->id."'><button type='button' class='btn btn-warning' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-pencil'></span></button></a></td>";
						}
						echo "<td><span style='vertical-align:-0.8em;'>";
						echo anchor(base_url().'activity/index/'.$value->id, $value->name)."</span></td>
								<td><span style='vertical-align:-0.8em;'> ".$value->description." </span></td>
								<td><span style='vertical-align:-0.8em;'>".$value->date_beg."</span></td>
								<td><span style='vertical-align:-0.8em;'>".$value->date_end_register."</span></td>
								<td><span style='vertical-align:-0.8em;'>".$value->date_end."</span></td>
								<td><span style='vertical-align:-0.8em;'>".$value->nb_credit."</span></td>
								<td><span style='vertical-align:-0.8em;'>".$value->nb_place."</span></td>";
						$data = array();
						$data['style'] = "color:white";
					if (!isset($value->inscrit) && ($value->nb_place > 0))
					{
						if (strtotime($value->date_beg) <= strtotime(date("Y-m-d")) && strtotime($value->date_end_register) >= strtotime(date("Y-m-d")))
							echo '<td><a href="'.base_url().'module/register/'.$value->id.'"><button type="button" class="btn btn-success" style="position:relative;top:0.3em;width:7em;" >Register</button></a></td>';
						else if (strtotime($value->date_end_register) <= strtotime(date("Y-m-d")))
							echo '<td><a href="'.base_url().'module/register/'.$value->id.'"><button type="button" disabled="disabled" class="btn btn-danger" style="position:relative;top:0.3em;width:7em;" >Too Late</button></a></td>';
						else if (strtotime($value->date_beg) >= strtotime(date("Y-m-d")))
							echo '<td><a href="'.base_url().'module/register/'.$value->id.'"><button type="button" disabled="disabled" class="btn btn-success" style="position:relative;top:0.3em;width:7em;" >Shortly</button></a></td>';
					}
					else if (isset($value->inscrit))
					{
						echo '<td><a href="'.base_url().'module/unregister/'.$value->id.'"><button type="button" class="btn btn-danger" style="position:relative;top:0.3em;width:7em;" >Unregister</button></a></td>';
					}
					else if ($value->nb_place == 0 || $value->nb_place == -1)
					{
						echo '<td><a href="#"><button type="button" class="btn btn-warning" disabled="disabled" style="position:relative;top:0.3em;width:7em;" >Full</button></a></td>';
					}
					if (isset($root))
					{
							$data = array();
							$data['style'] = "color:white";
							echo "<td><a href='".base_url().'module/delete/'.$value->id."'><button type='button' class='btn btn-danger' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-trash'></span></button></a></td>";
					}
						echo "</td></tr>";

				}
				else
				{
					echo form_open(base_url().'module/modify_validation/'.$value->id);
					$data = array();
					$data['style'] = "color:white";
					echo "	<tr>
							<td><input type='text' name='name' placeholder='Name' style='width:5em;' value='".$value->name."'></td>
							<td><TEXTAREA rows='2'  name='description' placeholder='description' style='height:2.8em;'>".$value->description."</TEXTAREA></td>
							<td><input type='date' name='date_beg' style='width:10em;' value='".$value->date_beg."'></td>
							<td><input type='date' name='date_end_register' style='width:10em;' value='".$value->date_end_register."'></td>
							<td><input type='date' name='date_end' style='width:10em;' value='".$value->date_end."'></td>
							<td><input type='text' name='nb_credit' placeholder='credits' style='width:5em;height:2.8em;' value='".$value->nb_credit."'/></td>
							<td><input type='text' name='places' placeholder='Places' value='".$value->nb_place."' style='width:5em;height:2.8em;'></td>
							<td><button type='submit' class='btn btn-warning' style='position:relative;top:0.3em;width:7em;'><span class='glyphicon glyphicon-play-circle'></span></button></td>
							<td><a href='".base_url().'module'."'><button type='button' class='btn btn-primary' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-chevron-up'></span></button></a></td>
							</tr>";
					echo form_close();
				}
			}
		}
		if (isset($add))
		{
			echo form_open(base_url().'module/add_validation');
			echo "	<tr>
						<td><input type='text' name='name' placeholder='Name' style='width:5em;' value='$error_form_name'></td>
						<td><TEXTAREA rows='2'  name='description' placeholder='description' style='height:2.8em;' >".$error_form_des."</TEXTAREA></td>
						<td><input type='date' name='date_beg' style='width:10em;' value='$error_form_date_beg'></td>
						<td><input type='date' name='date_end_register' style='width:10em;' value='$error_form_date_end_reg'></td>
						<td><input type='date' name='date_end' style='width:10em;' value='$error_form_date_end'></td>
						<td><input type='text' name='nb_credit' placeholder='credits' style='width:5em;height:2.8em;' value='$error_form_nb_credit'></td>
						<td><input type='text' name='places' placeholder='Places' style='width:5em;height:2.8em;' value='$error_form_places'></td>
						<td><button type='submit' class='btn btn-success' style='position:relative;top:0.3em;width:7em;'><span class='glyphicon glyphicon-play-circle'></span></button></td>
						<td><a href='".base_url().'module'."'><button type='button' class='btn btn-warning' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-chevron-up'></span></button></a></td>
					</tr>";
			echo form_close();
		}
		if (isset($root) && !isset($add))
		{
					$data = array();
					$data['style'] = "color:white";
			echo "<tr><td><a href='".base_url().'module/add/'."'><button type='button' class='btn btn-primary' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-plus'></span></button></td></a></tr>";
		}
		echo "</table>";

		if (validation_errors())
    		echo '<div class="alert alert-error bg-danger" style="border:1px solid red;color:red;width:99%;">'.validation_errors("<h5>-","</h5>").'</div>';

	}
	else
	{
		echo "<h1>No Module add...</h1>";
		if (isset($root) && !isset($add))
		{
			$data = array();
			$data['style'] = "color:white";
			echo "<br><a href='".base_url().'module/add/'."'><button type='button' class='btn btn-primary' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-plus'></span></button></a>";
		}
		if (isset($add))
		{
			echo "<table class='table table-hover'>";
			echo "<tr>";
			echo "<th>Name</th>
				<th>Description</th>
				<th>Begin Date</th>
				<th>End Register</th>
				<th>End Date</th>
				<th>Points</th>
				<th>Places</th>
				<th>Validation</th>";
			echo"</tr>";
			echo form_open(base_url().'module/add_validation');
			echo "	<tr>
						<td><input type='text' name='name' placeholder='Name' style='width:5em;' value='$error_form_name'></td>
						<td><TEXTAREA rows='2'  name='description' placeholder='description' style='height:2.8em;' >".$error_form_des."</TEXTAREA></td>
						<td><input type='date' name='date_beg' style='width:10em;' value='$error_form_date_beg'></td>
						<td><input type='date' name='date_end_register' style='width:10em;' value='$error_form_date_end_reg'></td>
						<td><input type='date' name='date_end' style='width:10em;' value='$error_form_date_end'></td>
						<td><input type='text' name='nb_credit' placeholder='credits' style='width:5em;height:2.8em;' value='$error_form_nb_credit'></td>
						<td><input type='text' name='places' placeholder='Places' style='width:5em;height:2.8em;' value='$error_form_places'></td>
						<td><button type='submit' class='btn btn-success' style='position:relative;top:0.3em;width:7em;'><span class='glyphicon glyphicon-play-circle'></span></button></td>
						<td><a href='".base_url().'module'."'><button type='button' class='btn btn-warning' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-chevron-up'></span></button></a></td>
					</tr>";
			echo form_close();
			echo "</table>";
						$data = array();
			$data['style'] = "color:white";
			echo "<td><a href='".base_url().'module'."'><button type='button' class='btn btn-warning' style='position:relative;top:-1em;'><span class='glyphicon glyphicon-chevron-up'></span></button></a></td>";
			if (validation_errors())
    		echo '<div class="alert alert-error bg-danger" style="border:1px solid red;color:red;width:99%;">'.validation_errors("<h5>-","</h5>").'</div>';

		}
	}
?>
</div>
</div>
