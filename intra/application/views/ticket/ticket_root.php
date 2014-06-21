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
    			echo "<tr>
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

    						<a href ='".base_url()."ticket/delete_ticket/".$value->id."'>
    							<button type='button' class='btn btn-default btn-xs' name='deletebutton'>
 										<span class='glyphicon glyphicon-remove'></span>
								</button>
							</a>
						</td>
    					</tr>";
    			$i++;
			}
  		?>
  	<?php else:?>
  		<tr><td colspan="5"><center>Any ticket received</center></td></tr>
  	<?php endif;?>
  </table>
</div>
</div>
