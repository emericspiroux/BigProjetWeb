<div style="position:relative;top:2.5em;">
<span class="link" style="padding:1em;">
<?php echo "<div class='btn-group'><button class='btn btn-primary'>".anchor(base_url()."forum/", 'home', array("style"=>"color:white;"))."</button>";?>
	<button class='btn btn-default active'><?php echo $cat_title;?></button></div></span><br><br>
<?php
	if ($tab_s_cat)
	{
		foreach ($tab_s_cat->result() as $value)
		{
			echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>";
				echo "
					<h2> ".anchor(base_url().'forum/index/'.$value->id_cat.'/'.$value->id, $value->title)." </h2>
					<p class='cat_comment'> ".$value->comment." </p>
					<p> - sub-category author: ".$value->pseudo."</p>";
			if (isset($id_user))
			{
				if ($id_user == $value->id_user || isset($root))
				{
					$data = array();
					$data['style'] = "color:white";
					echo "<td><a href='".base_url().'forum/delete/'.$id_user.'/'.$value->id_cat.'/'.$value->id."'><button type='button' class='btn btn-danger' style='position:relative;right:-95%;bottom:3em;'><span class='glyphicon glyphicon-trash'></span></button></a></td>";
				}
			}
			echo "</div>";
		}
	}
	else
	{
		echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;'>";
				echo "<h2> No sub-Category add, be the first ! </h2>";
			echo "</div>";
	}
	if (isset($root))
	{
		echo '<div class="jumbotron" style="-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;">
	<div class="center-block" style="position:relative;width:800px;margin-top:-2em;left:20%;">';
		echo '<h3>Add sub-category:</h3>';

		if (isset($error['title']) || isset($error['comment'])){echo '<div id="error" style="color:red;border:1px solid red;">';}
			if (isset($error['title'])){ if ($error['title'] == 1){echo "<p style='color:red;'>-Title can't be empty</p>";}}
			if (isset($error['title'])){ if ($error['title'] == 2){echo "<p style='color:red;'>-Title doesn't exist yet !</p>";}}
			if (isset($error['comment'])){echo "<p style='color:red;'>-Do you know how write on keyboard ? Puts few words to resume your category !</p>";}
		if (isset($error['title']) || isset($error['comment'])){echo "</div>";}

		echo form_open(base_url().'forum/s_cat_add/'.$id_cat);
		echo '<LABEL for="title">title: </LABEL>';
		echo form_input('title', $title = '');
		echo '<BR><LABEL for="title">comment: </LABEL><br>';
		echo form_textarea('comment'); ;
		echo '<BR><INPUT class="button" type="submit" value="OK">';
		echo form_close();
		echo '</div>';
	}
?>
</div>
