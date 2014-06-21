<h1><?php echo $name_module; ?><small>&nbsp;/&nbsp;<?php echo $name_activity; ?></small></h1>

<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>
<h2><?php if (isset($tuto_title)){echo "<h2>".$tuto_title."</h2>";}else{echo "tuto_title";}?></h2>
<iframe width="560" height="315" float="left" style="position:relative;left:50%;margin-left:-280px;" src="//<?php echo $youtube_url; ?>" frameborder="0" allowfullscreen></iframe>
</div>
