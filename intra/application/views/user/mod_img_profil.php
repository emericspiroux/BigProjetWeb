
<?php
if (!empty($info))
{
	foreach($info as $profile)
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
			}
		}
}
?>

<?php	if (isset($error))
			echo '<div style="position:relative;top:2em;">'.$error.'</div>';?>


<div class='jumbotron cols-sm-12' id='profil' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>


<!-- display/modify image -->
<div><h2><span class="glyphicon glyphicon-user"></span>&nbsp;Profile</h2></div><br>
<div style="position:relative;bottom:2em;border:1px solid black; width:100%;"></div>

<div style="position:relative;">
<img src="<?php echo base_url().$img_profil?>" alt="Your Face" class="img-circle" style="width:10em;height:10em;border:2px solid grey;"/><br>
<?PHP echo form_open_multipart(base_url()."user/change_img", array("name" => "formname"));?>
<input type="file" id='userfile' name='userfile' onchange="formname.submit();" style="display:none;" />
<div class="btn-group" style="position:relative;top:-2.5em;left:7em;">
	<button type="button" class='btn btn-warning' id = "selectedfile" value="" onclick="getfile()" ><span class='glyphicon glyphicon-pencil'></span></button>
</div>
<?PHP echo form_close();?>
</div>


<!-- Change password -->
<div class="bs-example">
    <p class="popover-examples">
        <a href="#" class="btn btn-danger" data-toggle="popover" data-content='
<div style="position:relative; left:2%;">
       <?php echo form_open(base_url()."user/change_password");?>
       <input type="password" name="password_old" placeholder="Old Password" style="margin:0.25em;">
       <input type="password" name="password_new" placeholder="New Password " style="margin:0.25em;">
       <input type="password" name="password_new_conf" placeholder="New Password Confirmation" style="margin:0.25em;">
       <input type="submit" class="btn btn-primary " value="Change" style="position:relative;margin-top:0.5em;left:26%;">
       <?php echo form_close();?>
</div>
        '>Change Password</a>
    </p>
</div>


<!-- Diplay info -->
<?php if (!isset($new['uid'])) :?>
<div style="position:absolute;top:8.5em;left:25%;">
	<h2><?php echo $pseudo;?></h2>
	<p>Email : <?php echo $email; ?></p>
</div>
<?php endif;?>

<?php if (isset($new['uid'])) :?>
<div style="position:absolute;top:8.5em;left:25%;">
<h2>
<?php echo $new['lastname']; ?>&nbsp;
<small><?php echo $new['firstname']; ?></small></h2>
<p>Pseudo: <?php echo $new['uid']; ?><br>
BirthDate : <?php echo $new['birthdate']; ?><br>
Mobile Phone: <?php echo $new['mobilephone']; ?></p>
</div>
<?php endif;?>

</div>
