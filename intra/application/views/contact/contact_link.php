<div class="center-block hidden-xs" style="width:200px;">
<div style="position:relative;right:8.5em;">
<?php echo form_open(base_url()."forum");?>
<input type="submit" class="btn btn-primary btn-lg btn-block " value="Go Forum">
<?php echo form_close();?>
</div>
<div style="position:relative;top:-3.2em;left:6.2em;">
<?php echo form_open(base_url()."contact_class/index");?>
<input type="submit" class="btn btn-primary btn-lg btn-block " value="Leave a Message">
<?php echo form_close();?>
</div>
</div>

<div class="center-block visible-xs" style="width:200px;">
<div style="margin-bottom:0.5em">
<?php echo form_open(base_url()."forum");?>
<input type="submit" class="btn btn-primary btn-lg btn-block " value="Go Forum">
<?php echo form_close();?>
</div>
<div>
<?php echo form_open(base_url()."contact_class/index");?>
<input type="submit" class="btn btn-primary btn-lg btn-block " value="Leave a Message">
<?php echo form_close();?>
</div>
</div>
