<?php if ($ticket && $conversation):?>
	<?php if (isset($root)):?>
		<form action="<?php echo base_url(); ?>ticket/update_admin" method="post" accept-charset="utf8">
			<div class='jumbotron' style='-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;margin:1em;padding:2em;'>
				<h4>Move ticket</h4>
				<?php
					$row = $ticket->row();
					if ($admin !== false)
					{
						echo "<select name='list_admin'><option value=''> ----- Choisir ----- </option>";
						foreach ($admin->result() as $value)
							echo "<option value='$value->id'>$value->pseudo</option>";
						echo "</select>";
						echo "<input type='hidden' name='id_ticket' value='$row->id'>";
						echo '<input type="submit" class="btn btn-primary btn-xs" value="Transférer">';
					}
					else
						echo "<p>No other Administrator.</p>";
				?>
			</div>
		</form>
	<?php endif;?>

	<div class='jumbotron' style='-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;margin:1em;padding:2em;'>
		<?php
  			foreach ($conversation->result() as $value) {
    			echo 	"<p class='panel panel-default' style='margin:0.5em;font-size:1em;padding:0.5em;'>
						$value->message
						<span style='color:gray;font-size:10px;'> - ".$value->pseudo." - ".$value->date_message."</span>
						</p>";
			}
  		?>
	</div>
	<?php
		$row = $ticket->row();
	?>
	<form action="<?php echo base_url(); ?>ticket/add_message" method="post" accept-charset="utf8">
		<div class='jumbotron' style='-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;margin:1em;padding:2em;'>
					<?php if (validation_errors())

    		echo '<div class="alert alert-error bg-danger" style="border:1px solid red;color:red;width:99%;">'.validation_errors("<h5>-","</h5>").'</div>';?>
			<textarea name="comment" cols="130" rows="6" array=""></textarea>
			<input type="hidden" name="id_ticket" value="<?php echo $row->id ?>"><br>
			<input type="submit" class="btn btn-primary" value="Send">
		</div>
	</form>
<?php endif;?>
