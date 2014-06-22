<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>
<div><h2><span class='glyphicon glyphicon-stats'></span>&nbsp;Correction of <?if (isset($name_student)){ echo str_replace('_', ' ', $name_student);}?> for <?if (isset($name_activity)){ echo str_replace('_', ' ', $name_activity);}?></h2></div><br>
<div style='position:relative;bottom:2em;border:1px solid black; width:100%;'></div>
<div style='position:absolute;left:65%'>
<?php
if (is_object($imgs_groupe))
{
	foreach ($imgs_groupe->result() as $value)
	{
			echo '<img src="'.base_url().$value->img_profil.'" class="img-circle" style="width:5em;height:5em;float:left;margin:0.5em;border:2px solid grey;">';
	}
}
?>

</div>
<?php if (validation_errors())
    	{echo '<div class="alert alert-error bg-danger" style="border:1px solid red;color:red;width:99%;">'.validation_errors("<h5>-","</h5>").'</div>';}?>

<?php echo form_open(base_url()."peer_correcting/valide_correct");?>
<div class="form-group">
<label for='mark' class="col-sm-2 control-label">Mark</label>
<input type="number" name='mark' id='mark' min="0" max="20" placeholder="/20" value="<?if (isset($mark)){ echo $mark;}?>"><br>
<!-- </div>
<div class="form-group"> -->
<label for='comment' class="col-sm-2 control-label">Comment</label>
<textarea cols="60" name='comment' id='comment' placeholder="Comment..."><?if (isset($feedback)){ echo $feedback;}?></textarea><br>
</div>
<input type="hidden" name='id'  value="<?if (isset($id)){ echo $id;}?>">
<label class="col-sm-2 control-label">&nbsp</label><input type="submit" name="submit" class="btn btn-primary" value="Send">&nbsp;<button class="btn btn-primary" name="submit" type="submit" value="save"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Save</button> <a href="<?php echo base_url(); ?>"><button class="btn btn-primary" name="submit" type="submit" value="save"><span class="glyphicon glyphicon-floppy-remove"></span>&nbsp;Quit</button></a>
<?php echo form_close();?>
</div>
