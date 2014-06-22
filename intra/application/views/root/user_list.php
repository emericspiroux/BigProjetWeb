<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>
<?php
 $this->load->helper('form');
	if ($tab_user)
	{
		echo '<TABLE class="table table-hover"> <tr> <th> Id </th><th> Pseudo </th><th> Email </th><th> Root </th> <th> change </th><th> delete </th></tr>';
		foreach ($tab_user->result() as $value)
		{
			if($value->root == 1)
				$root = "oui";
			else
				$root = "non";
			if (empty($id_mod) || ($value->id != $id_mod))
			{
				echo "
					<tr>
					<td> ".$value->id." </td>
					<td> ".$value->pseudo." </td>
					<td> ".$value->email." </td>
					<td> ".$root." </td>
					<td><a href='".base_url().'root_class/mod_user/'.$value->id."'><button type='button' class='btn btn-warning' style='height:2.6em;'><span class='glyphicon glyphicon-pencil'></span></button></a></td>";
					if ($id_user != $value->id)
						echo "<td><a href='".base_url().'root_class/delete_user/'.$value->id."'><button type='button' class='btn btn-danger' style='height:2.6em;'><span class='glyphicon glyphicon-trash'></span></button></a></th>";
					else
						echo "<td><a href='#'><button type='button' disabled='disabled' class='btn btn-danger' style='height:2.6em;'><span class='glyphicon glyphicon-trash'></span></button></a></th>";
					echo "</tr>";
			}
			else
			{
				echo form_open(base_url().'root_class/valide_mod_user');
				echo "<tr>
				<th> ".form_hidden('id', $value->id).$value->id." </th>
				<th> ".form_input('pseudo', $value->pseudo)." </th>
				<th> ".form_input('email', $value->email)." </th>
				<th> ".form_input('root', $root)." </th>
				<th> ".form_submit('button', '->')."</th>";
				echo "<th> ".form_open(base_url().'root_class/delete_user/'.$value->id)."".form_submit('button', 'X').form_close()."</th>";
				echo "</tr>";
				echo form_close();
			}
		}
		echo "</table>";
	}
	else
		echo "no Users add...";
?>
</div>

<div class='jumbotron ' style='position:relative;top:3em;-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;padding:2em;'>
<div class="container-fluid" style="position:relative;left:30%;">

<?php echo form_open(base_url().'root_class/add_user_root'); ?>
		<h3>Add new user :</h3>
		<?php echo form_input(array('name' => 'pseudo', 'placeholder'=>'pseudo')); ?><BR>


		<?php echo form_password(array('name' => 'passwd', 'placeholder'=>'password')); ?><BR>


		<?php echo form_input(array('name' => 'email', 'placeholder'=>'email')); ?><BR>


		<div class="btn-group" data-toggle="buttons">
  <label class="btn btn-primary">
    <input type="radio" name="root" id="option1" value="oui"> Yes
  </label>
  <label class="btn btn-primary">
    <input type="radio" name="root" value="non"> No
  </label>
</div>

		<INPUT class="btn btn-primary" type="submit" value="OK" />

		<?PHP echo form_close(); ?>
</div>
</div>
