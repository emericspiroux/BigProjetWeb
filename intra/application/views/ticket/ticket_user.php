<?php if (validation_errors()):?>
    <div class="alert alert-error"><?php echo validation_errors('<p>','</p>');?></div>
<?php endif;?>

<div class='jumbotron' style='-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;margin:1em;padding:2em;'>
<div class="table-responsive">
  <table class="table">
  	<tr>
  		<td><h4>#</h4></td>
  		<td><h4>Object</h4></td>
  		<td><h4>Date sent</h4></td>
  		<td><h4>Message</h4></td>
  		<td><h4>Action</h4></td>
  	</tr>
  	<?php if($tickets):?>
  		<?php
  			$i = 1;
  			foreach ($tickets->result() as $value) {
    			echo 	"<tr>
    						<td>$i</td>
    						<td>$value->objet</td>
    						<td>$value->date_ticket</td>
    						<td>$value->message</td>
    						<td>
    					    	<a href ='".base_url()."ticket/display_ticket/".$value->id."'>
    								<button type='button' class='btn btn-default btn-xs'>
    									<span class='glyphicon glyphicon-eye-open'></span>
    								</button>
    							</a>
    						</td>
    					</tr>";
    			$i++;
			}
  		?>
  	<?php else:?>
  		<tr><td colspan="5"><center>Any ticket send</center></td></tr>
  	<?php endif;?>
  </table>
</div>
</div>
<?php ?>

<?php echo form_open('ticket/check_ticket'); ?>
<div class='jumbotron' style='-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;margin:1em;padding:2em;'>
      <?php
        if ($cat)
        {
          echo "<select name='id_cat' class='form-control'><option value=''> ----- Category ----- </option>";
          foreach ($cat->result() as $value)
            echo "<option value='$value->id_cat'>$value->nom_cat</option>";
          echo "</select>";
        }
      ?>
		<label class="control-label">Object</label>
		<input class="form-control"name="object" type="text" placeholder="" style="width:250px;">
		<label class="control-label">Content</label>
		<textarea class="form-control" rows="9" cols="50" name="content" placeholder="" style="width:550px;"/></textarea>
		<input type="submit" class="btn btn-primary" type="submit" value="OK"/>
<?php echo form_close(); ?>
</div>
