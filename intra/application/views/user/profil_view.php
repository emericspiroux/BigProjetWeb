<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="height:4.5em;">
<div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="#" style="position:relative;top:0.3em;"><?php echo $title;?></a>
        </div>
		<div class="navbar-collapse collapse">
			<div  class="navbar-form navbar-right" style="position:relative;top:0.3em;">
				<?php echo form_open(base_url().'user/logout', array('style'=>"display:inline;float:left; margin-right:10px;")); ?>
							<p style="color:white;"><img src="<?php echo base_url().$img_profil?>" alt="Your Face" class="img-circle" style="width:2.5em;height:2.5em;border:2px solid grey;">&nbsp;&nbsp;<?echo $pseudo; ?>&nbsp;&nbsp; <button type="submit" class="btn btn-danger" style="width:4em;height:2em;"><span class='glyphicon glyphicon-off'></span></button>
				<?PHP echo form_close(); ?>
			</div>
		</div>
</div>
</div>
