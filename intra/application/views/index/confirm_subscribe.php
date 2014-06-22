
	<div class="center-block" style="align:center;">
		<h3> Bienvenu a toi <?php echo $pseudo;?> !</h3>
	</div>

<div class="jumbotron" id="subscribe" style="margin-top:-1em;" name="subscribe">
	<div class="center-block" style="width:300px;margin-top:-3em;">
		<?php echo form_open(base_url()."user/resend_confirm/".$email."/".$pseudo."");?>
			<input type="submit" class="btn btn-primary btn-lg btn-block " value="Resend email confirmation">
		<?php echo form_close();?>
	</div>
</div>

