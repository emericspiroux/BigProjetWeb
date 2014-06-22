<div class="jumbotron hidden-xs" id="contact" style="margin-top:-1em;" name="subscribe">
	<div class="center-block" style="width:300px;margin-top:-3em;">
	 <?php if (isset($error_formemail) || isset($error_message) || isset($error_name)){echo '<div id="error" style="color:red;border:1px solid red;">';}

		if (isset($error_name)){echo "<p style='color:red;'>-Your name is \"\" ? Impossible !</p>";}
		if (isset($error_formemail)){echo "<p style='color:red;'>-Email must be: exemple@exemple.truc</p>";}
		if (isset($error_message)){echo "<p style='color:red;'>-Message can't be empty</p>";}

	 if (isset($error_formemail) || isset($error_message) || isset($error_name)){ echo "</div>";}?>
	 <?php if (isset($contact_ok)){echo '<div id="confirm" style="color:green;border:1px solid green;">';}
		if (isset($contact_ok)){echo "<p>-Congratulation your message was send !</p>";}
	 if (isset($contact_ok)){ echo "</div>";}?>

		<?php echo form_open(base_url().'contact_class/add'); ?>
		<h3>Contact :</h3>
		<LABEL for="name">Name: </LABEL>
		<?php echo form_input('name', $pseudo = ''); ?><BR>

		<LABEL for="email">Email: </LABEL>
		<?php echo form_input('email', $email = ''); ?><BR>

		<LABEL for="message">Message: </LABEL>
		<?php echo form_textarea('message'); ?><BR>

		<input type="submit" class="btn btn-primary btn-lg btn-block "  style="width:60px;" value="OK">

		<?PHP echo form_close(); ?>
</div>
</div>
