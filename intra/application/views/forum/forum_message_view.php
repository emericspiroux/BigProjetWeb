<div style="position:relative;top:2.5em;">
<span class="link" style="padding:1em;">
 <?php
  		echo "<div class='btn-group'>";
		echo "<button class='btn btn-primary'>".anchor(base_url()."forum/", 'home', array("style"=>"color:white;"))."</button>";
 		echo "<button class='btn btn-primary'>".anchor(base_url()."forum/index/".$id_cat, $cat_title, array("style"=>"color:white;"))."</button>";
 		echo "<button class='btn btn-primary'>".anchor(base_url()."forum/index/".$id_cat.'/'.$id_s_cat, $s_cat_title, array("style"=>"color:white;"))."</button>";
 		echo "<button class='btn btn-default active'>".$thread_title."</button></div></span><br><br>";

	if ($tab_message)
	{
		echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;'>";
		foreach ($tab_message->result() as $value)
		{
			if(file_exists(APPPATH."../".$value->img_profil))
				$img_profil = base_url().$value->img_profil;
			else
				$img_profil = base_url()."asset/images/profil.jpg";
			echo "<p class='panel panel-default' style='margin:0.5em;font-size:1em;padding:0.5em;min-height:6.2em;'><img src='".$img_profil."' alt='Your Face' class='img-circle' style='width:5em;height:5em;border:2px solid grey;display:block;float:left;position:absolute;'>
<span style='display:block;position:relative;left:6em;'>".$value->comment."<br><span style='color:gray;font-size:10px;' > - ".$value->pseudo." - ".$value->datetime."</span>";
			if (($id_user == $value->id_user || isset($root)) && isset($id_user))
				echo " - ".anchor(base_url().'forum/delete/'.$id_user.'/'.$id_cat.'/'.$id_s_cat.'/'.$id_thread.'/'.$value->id, "delete", array('style' => "font-size:10px;"))."</button>";
			echo "</span>";
			echo "</p>";
		}
		echo "</div>";
	}
	else
	{
		echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;'>";
		echo "<h2> No message add, be the first ! </h2>";
		echo "</div>";
	}
	if (isset($login))
	{
		echo "<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'><div class='center-block' style='position:relative;width:800px;margin-top:-2em;left:20%;'>";
		echo '<h3>Add message:</h3>';
		if (isset($error['comment'])){echo '<div id="error" style="color:red;border:1px solid red;">';}
			if (isset($error['comment'])){echo "<p style='color:red;'>-Do you know how write on keyboard ? Puts few words to in your message !</p>";}
		if (isset($error['comment'])){echo "</div>";}
		echo form_open(base_url().'forum/message_add/'.$id_cat.'/'.$id_s_cat.'/'.$id_thread);
		echo '<LABEL for="commment">comment: </LABEL><br>';
		echo form_textarea('comment')."<BR>";
		echo '<INPUT class="button" type="submit" value="OK" />';
		echo form_close();
		echo "</div>";
	}
?>
</div>
