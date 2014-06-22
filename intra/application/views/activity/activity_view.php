<div>

<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>

<h1><?php echo 		$name = str_replace('_', ' ', $activity_info->name);?></h1>
<p style="margin:1.5em;"><?php echo $activity_info->description;?></p>
<div class='hidden-xs' style='position:relative;left:80%;top:-1em;'><a href='<?php echo base_url()."e_learning/show/".$activity_name."/".$menu_activity_name?>'><button class="btn btn-success"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;E-Learning</button></a></div>
<div class='visible-xs'><a href='<?php echo base_url()."e_learning/show/".$activity_name."/".$menu_activity_name?>'><button class="btn btn-success"><span class="glyphicon glyphicon-facetime-video"></span>&nbsp;E-Learning</button></a></div>

</div>

<?php
	echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>";
if (isset($register) || isset($root))
{
	if ($activity_info->date_beg > date("Y-m-d H:t") && !isset($root))
		echo "<h2>Files available on ".$activity_info->date_beg."</h2>";
	else if ($tab_object)
	{
		echo "<h5> files :</h5>";
		echo "<table class='table table-hover'>";
		echo "<tr>";
			echo "<th>Name</th>";
			echo "<th>Link</th>";
		if (isset($root) && !isset($add_object))
			echo "<th>Delete</th>";
		echo "</tr>";

		foreach ($tab_object->result() as $file)
		{
			echo "<tr>";
			echo "<td>".$file->name."</td>";
			echo "<td><a href='".base_url().$file->link."'><button type='button' class='btn btn-primary'><span class='glyphicon glyphicon-download'></span></button></a></td>";
			if (isset($root) && !isset($add_object))
			{
				$data = array();
				$data['style'] = "color:white";
				echo "<td><a href='".base_url().'activity/delete_file/'.$activity_name."/".$menu_activity_name."/".$file->id."'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></a></td>";
			}
			echo "</tr>";
		}

		if (isset($root) && isset($add_object))
		{
			echo form_open_multipart(base_url()."activity/add_object_valid/".$activity_name."/".$menu_activity_name);
			echo "<tr>";
			echo "<td><input type='file' name='userfile'></td>";
			echo "<td><input type='submit'class='btn btn-primary' value='Upload'></td>";
			echo "</tr>";
			echo form_close();
		}
		echo "</table>";
	}
	else
	{
		echo "<h4>No files add...</h4>";
		if (isset($root) && isset($add_object))
		{
			echo "<table class='table table-hover'>";
			echo "<tr>";
			echo "<th>Name</th>";
			echo "<th>Link</th>";
			echo "</tr>";
			echo form_open_multipart(base_url()."activity/add_object_valid/".$activity_name."/".$menu_activity_name);
			echo "<tr>";
			echo "<td><input type='file' name='userfile'></td>";
			echo "<td><input type='submit'class='btn btn-primary' value='Upload'></td>";
			echo "</tr>";
			echo form_close();
		}
		echo "</table>";
	}
	if (isset($root) && !isset($add_object))
	{
		$data = array();
		$data['style'] = "color:white";
		echo "<tr><td><a href='".base_url().'activity/add_object/'.$activity_name."/".$menu_activity_name."'><button type='button' class='btn btn-primary' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-plus'></span></button></a></td></tr>";
	}
	if (isset($add_object))
	{
		$data = array();
		$data['style'] = "color:white";
		echo "<tr><td><a href='".base_url().'activity/show/'.$activity_name."/".$id_act."'><button type='button' class='btn btn-warning' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-chevron-up'></span></button></a></td></tr>";
		echo "</table>";
		if (isset($error))
			echo '<div style="position:relative;top:2em;">'.$error.'</div>';
	}
}
else
{
	echo "<h2>You're not registered.</h2>";
}
?>
</div>

</div>
