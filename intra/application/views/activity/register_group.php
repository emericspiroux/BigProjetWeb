<?php if ($users):?>
<?php if (validation_errors()):?>
    <div class="alert alert-error bg-danger" style="border:1px solid red;color:red;"><?php echo validation_errors('<h5>-','</h5>');?></div>
<?php endif;?>
<?php if (isset($error_group)):?>
    <div class="alert alert-error bg-danger" style="border:1px solid red;color:red;"><h5>- You can't add many identical person.</h5></div>
<?php endif;?>
	</br>
	<?php echo form_open(base_url()."activity/manual_group");?>
		<div class='jumbotron' style='-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;margin:1em;padding:2em;'>
			<?php
				echo "<input type='hidden' value='$id_activity' name='id_activity'>";
				echo "<input type='hidden' value='$my_id' name='user_chief'>";
				echo "<input type='hidden' value='$size_groupe' name='size_groupe'>";
				echo "<input type='hidden' value='$id_mod' name='id_mod'>";
				echo "</br>";
				if (isset($name_group)){$name = $name_group;}else{$name = " ";}
				echo "Name of group : <input type='text' name='name_group' value='$name'>";
				echo "</br>";
				$i = 0;
				while ($i < $size_groupe - 1)
				{
					echo "<select name='user_$i'>";
					foreach ($users->result() as $value)
					{
						if ($value->id != $my_id)
							echo "<option value='$value->id'>$value->pseudo</option>";
					}
					echo "</select>";
					$i = $i + 1;
				}
				echo "</br>";
				echo "<input type='submit' class='btn btn-primary btn-xs' value='Create group'>";
			?>
		</div>
	<?php form_close()?>
<?php endif;?>
