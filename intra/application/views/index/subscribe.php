<div class="jumbotron hidden-xs" id="subscribe" style="margin-top:-1em;" name="subscribe">
	<div class="center-block" style="width:300px;margin-top:-3em;">
<?php if (validation_errors()):?>
    <div class="alert alert-error bg-danger" style="border:1px solid red;color:red;"><?php echo validation_errors('<h5>-','</h5>');?></div>
<?php endif;?>

		<?php echo form_open('user/subscribe'); ?>
		<h3>Subscribe</h3>
	<input type="text" class="form-control" name="pseudo" placeholder="Login" value="<?php echo $error_form_login ?>" />
	<input type="password" class="form-control" name="passwd" placeholder="Password"/>
	<input type="password" class="form-control" name="passwd_conf" placeholder="Password confirmation"/>
	<input type="text" class="form-control" name="email" placeholder="exemple@exemple.fr" value="<?php echo $error_form_email ?>"/>
	<INPUT type="submit" class="btn btn-primary" type="submit" value="OK" />

		<?PHP echo form_close(); ?>
		</div>
</div>

<div class="jumbotron visible-xs" style="margin-top:2em;" name="subscribe">
	<div class="center-block" style="width:300px;margin-top:-3em;">
	 <?php if (isset($error_pseudo) || isset($error_passwd) || isset($error_email) || isset($error_formemail)){echo '<div id="error" style="color:red;border:1px solid red;">';}
	 	 if (isset($error_pseudo)){echo "<p style='color:red;'>-Pseudo already exist</p>";}
	 	 if (isset($error_passwd)){echo "<p style='color:red;'>-Do you know how write on keyboard ? Puts two identical password !</p>";}
	 	 if (isset($error_empty_passwd)){echo "<p style='color:red;'>-Do you know how write on keyboard ? Puts a password !</p>";}
	 	 if (isset($error_email)){echo "<p style='color:red;'>-Email already exist</p>";}
	 	 if (isset($error_formemail)){echo "<p style='color:red;'>-Email must be: exemple@exemple.truc</p>";}
	 if (isset($error_pseudo) || isset($error_passwd) || isset($error_email) || isset($error_formemail)){ echo "</div>";}?>

		<?php echo form_open('user/subscribe'); ?>
		<h3>Subscribe</h3>
	<input type="text" class="form-control" name="pseudo" placeholder="Login">
	<input type="password" class="form-control" name="passwd" placeholder="Password">
	<input type="password" class="form-control" name="passwd_conf" placeholder="Password confirmation">
	<input type="text" class="form-control" name="email" placeholder="exemple@exemple.fr">
	<INPUT type="submit" class="btn btn-primary" type="submit" value="OK" />

		<?PHP echo form_close(); ?>
		</div>
</div>
