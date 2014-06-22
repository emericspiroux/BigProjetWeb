<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>
<?php
 $this->load->helper('form');
	if ($tab_contact)
	{
		echo '<TABLE style="border:1px solid black;width:1000px;"> <CAPTION> Contacts </CAPTION> <tr> <th> Name </th><th> Email </th><th> Message </th><th> delete </th></tr>';
		foreach ($tab_contact->result() as $value)
		{
				echo "
					<tr>
					<th> ".$value->name." </th>
					<th> ".$value->email." </th>
					<th> ".form_textarea('message',$value->message)." </th>
					<th> ".form_open(base_url().'root_class/delete_contact/'.$value->id)."".form_submit('button', 'X').form_close()."</th>
					</tr>
				";
		}
		echo "</table>";
	}
	else
		echo "no Contacts add...";
?>
</div>
