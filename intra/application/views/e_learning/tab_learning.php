<div>
<?php
echo "<h1>".str_replace('_', ' ', $title_activity)."</h1>";
	if (isset($root) && !isset($add))
	{
				echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;width:7em;'>";
		echo "<tr><td><a href='".base_url().'e_learning/add_learning/'.$module_name."/".$title_activity."'><button type='button' class='btn btn-primary' style='position:relative;top:0.3em;'><span class='glyphicon glyphicon-plus'></span></button></a></td></tr>";
		echo "</div>";
	}
	if (isset($root) && isset($add))
	{
						if (validation_errors())
    		echo '<div class="alert alert-error bg-danger" style="border:1px solid red;color:red;width:99%;">'.validation_errors("<h5>-","</h5>").'</div>';
		echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>";
		echo form_open(base_url()."e_learning/add_valid");
		echo "<input type='text' name='name' style='position:relative;left:1em;' placeholder='Name'>&nbsp;&nbsp;";
		echo "<input type='url' name='youtube_url' style='margin:2em;width:23em;' placeholder='https://www.youtube.fr/watch?v=[YOUR_CODE]'>";
		echo "<input type='hidden' name='name_module' value='".$module_name."'>";
		echo "<input type='hidden' name='name_activity' value='".$title_activity."'>";
		echo "<input type='submit' class='btn btn-primary'>";
		echo "<a href='".base_url().'e_learning/show/'.$module_name."/".$title_activity."' style='float:left'><button type='button' class='btn btn-warning' style='position:relative;top:1.7em;'><span class='glyphicon glyphicon-chevron-left'></span></button></a>";

		echo form_close();
		echo "</div>";
	}

if (is_object($tab))
{
	foreach($tab->result() as $value)
	{
		echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>";
		echo "<h2>".$value->name."</h2>";
		if (isset($root))
		{
				$data = array();
				$data['style'] = "color:white";
				echo "<a href='".base_url().'e_learning/delete_learning/'.$module_name."/".$title_activity.'/'.$value->id."'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></a>";
		}
		if (strstr($value->url, 'https://www.youtube.com/watch?v='))
		{
			$youtube_url = str_replace('https:', '', $value->url);
			$youtube_url = str_replace('watch?v=', 'embed/', $youtube_url);
			echo '<div><iframe width="560" height="315" style="position:relative;left:50%;margin-left:-280px;"src="'.$youtube_url.'" frameborder="0" allowfullscreen></iframe></div>';
		}
		else
			echo "<div style='position:relative;width:560px;height:150px;left:50%;margin-left:-280px;'><h1><small> No Video </small></h1></div>";
		echo "</div>";
	}
}
else
{
		echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>";
	echo "<h1>No e-lesson...</h1>";
	echo "</div>";
}

?>
</div>
