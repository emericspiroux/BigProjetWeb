<div>
<?php
	if ($tab_cat)
	{
		foreach ($tab_cat->result() as $value)
		{
			echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>";
				echo "
					<h2> ".anchor(base_url().'forum/index/'.$value->id, str_replace('_', ' ', $value->title))." </h2>
					<p class='cat_comment'> ".$value->comment." </p>
					<p> - author category: ".$value->pseudo."</p>
				";
			if (isset($id_user))
			{
				if ($id_user == $value->id_user || isset($root))
				{
					$data = array();
					$data['style'] = "color:white";
					echo "<td><a href='".base_url().'forum/delete_cat/'.$value->id."'><button type='button' class='btn btn-danger' style='position:relative;right:-95%;bottom:3em;'><span class='glyphicon glyphicon-trash'></span></button></a></td>";
				}
			}
			echo "</div>";
		}
		if (isset($root))
		{
			echo '<div class="jumbotron" style="-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;">
	<div class="center-block" style="position:relative;width:800px;margin-top:-2em;left:20%;">
<h3>Add category:</h3>';
		if (isset($error['title']) || isset($error['comment'])){echo '<div id="error" style="color:red;border:1px solid red;">';}
			if (isset($error['title'])){ if ($error['title'] == 1){echo "<p style='color:red;'>-Title can't be empty</p>";}}
			if (isset($error['title'])){ if ($error['title'] == 2){echo "<p style='color:red;'>-Title doesn't exist yet !</p>";}}
			if (isset($error['comment'])){echo "<p style='color:red;'>-Do you know how write on keyboard ? Puts few words to resume your category !</p>";}
		if (isset($error['title']) || isset($error['comment'])){echo "</div>";}

	echo form_open('root_class/cat_add');
	echo '<input name="title" type="text" placeholder="Title..."/><br><br>';
	echo '<textarea rows="9" cols="70" name="comment" placeholder="Presentation..."/></textarea><BR>';
	echo '<INPUT id="button" class="btn btn-primary" type="submit" value="OK" />';
	echo form_close();
		}
	}
	else
		echo "no Category add...";
?>
</div>
</div>

