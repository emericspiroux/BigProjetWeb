<div id="profil" style="border:1px solid black;width:200px;margin-top:10px;padding:10px;">
		<?php echo form_open('user/profil'); ?>
		<h3>Profil :</h3>
		<LABEL for="pseudo">pseudo: </LABEL>
		<?php echo form_input('pseudo', $mypseudo); ?><BR>

		<LABEL for="email">email: </LABEL>
		<?php echo form_input('email', $myemail);echo form_hidden('root', 'OUI'); ?><BR>

		<INPUT class="button" type="submit" value="OK" />

		<?PHP echo form_close(); ?>
</div>
