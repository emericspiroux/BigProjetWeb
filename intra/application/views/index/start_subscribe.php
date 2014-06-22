<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" style="display:inline;position:relative;top:0.5em" href="<?php echo base_url().'forum';?>"><?php echo $title;?></a>			<!-- <div class="fb-login-button" style="top:-2.5em;left:12em;"; data-max-rows="" data-size="small" data-show-faces="false" data-auto-logout-link="false"></div> -->
        </div>
		<div class="navbar-collapse collapse">
			<div  class="navbar-form navbar-right">
				<?php echo form_open(base_url().'user/connexion'); ?>

					<input type="text" name="login" class="form-control"  placeholder="Login" value="<?php echo $error_form_login ?>">
					<input type="password" name="passwd" class="form-control"  placeholder="Password">
					<INPUT type="hidden" name="locate" value="<?php echo $_SERVER['PHP_SELF'];?>" readonly/>
					<INPUT type="submit" id="button" class="btn btn-primary" value="login" >
      <div class="checkbox" style="color:white;">
        <label>
          <input type="checkbox" > Remember me
        </label>
</div>
				<?PHP echo form_close(); ?>
			</div>
			<div  class="navbar-form navbar-right" style="position:relative;">

					<a id="button" class="btn btn-primary" href="#subscribe">Subscribe</a>
			</div>
		</div>
</div>
</div>
<>
