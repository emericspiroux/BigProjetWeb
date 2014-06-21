<?php
if ($search['count'] == 0)
	echo '<div class="jumbotron" style="-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding-top:2em;float:left"><h1>No match found.</h1></div>';
else
{
	foreach($search as $profile)
	{
		if (is_array($profile))
		{
			$new = array();
			foreach($profile as $var)
			{
				if (is_array($var))
				   $tmp = $var[0];
				else
				{
					if (isset($tmp))
					{
						$var = preg_replace("/(.*)-(.*)/", "$1$2", $var);
						if ($var == 'birthdate')
						{
							$year = substr($tmp, 0, 4);
							$month = substr($tmp, 4, 2);
							$day = substr($tmp, 6, 2);
							$tmp = $day." / ".$month." / ".$year;
						}
						if ($var == 'picture')
						   $tmp = base64_encode($tmp);
						$new[$var] = $tmp;
						unset($tmp);
					}
				}
			}
		?>
		<div class="jumbotron col-xs-4 container-fluid" style="-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding-top:2em;float:left">
			<?php if (isset($new['picture'])){echo "<img class='img-circle' style='height:10em;width:10em;border: 2px solid grey;position:relative;left:6%;' src=\"data:image/jpg;base64,".$new['picture']."\">";}?>
		<div style="">
		<br>
			<?php echo "<b>uid : </b>".$new['uid']; ?><br>
			<?php echo "<b>Firstname : </b>".$new['firstname']; ?><br>
			<?php echo "<b>Lastname : </b>".$new['lastname']; ?><br>
			<?php echo "<b>Birthdate : </b>".$new['birthdate']; ?><br>
			<?php echo "<b>Mobile : </b>".$new['mobilephone']; ?>
		</div>
		</div>
		<?php
		}
	}
}
?>
