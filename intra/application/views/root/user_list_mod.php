<div>
<?php
	if (!empty($tab_user))
	{
		echo '<TABLE style="border:1px solid black;width:500px;"> <CAPTION> Users </CAPTION> <tr> <th> Id </th><th> Pseudo </th><th> Email </th><th> Root </th> <th> change </th></tr>';
		foreach ($tab_user->result() as $value)
		{
			if($value->root == 1)
				$root = "oui";
			else
				$root = "non";
			if ($value->id !== $id_mod)
			{
				echo "
					<tr>
					<th> ".$value->id." </th>
					<th> ".$value->pseudo." </th>
					<th> ".$value->email." </th>
					<th> ".$root." </th>
					<th> ";
					echo form_open(base_url().'root_class/mod_user/'.$value->id);
					echo form_submit('button', '->').form_close()."</th></tr>";
			}
			else
			{
			}
		}
		echo "</table>";
	}
	else
		echo "no Users add...";
?>
</div>
