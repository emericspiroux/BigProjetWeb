<div class='jumbotron' style='-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;margin:1em;padding:2em;'>
<h2>Planning</h2>
<?php
if (isset($tab_planning) && is_object($tab_planning))
{
			echo "<table class='table table-hover table-responsive'>";
		echo "<tr>";
		echo "<th>Name</th>
		<th>Module</th>
					<th>Register Date</th>
					<th>Begin Date</th>
					<th>Peer Date</th>
					<th>End Date</th>
				</tr>";
	foreach ($tab_planning->result() as $value) {
		echo "<tr>";
		echo "<td>".anchor(base_url().'activity/show/'.$value->module_name.'/'.$value->id, str_replace('_', ' ', $value->name))."</td>";
		echo "<td>".$value->module_name."</td>
					<td><span style='vertical-align:-0.8em;'>".$value->date_reg."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_beg."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_peer."</span></td>
						<td><span style='vertical-align:-0.8em;'>".$value->date_end."</span></td>";
		echo "</tr>";

if ((strtotime($value->date_beg) - strtotime($value->date_reg)) > 0)
		$progress_now_reg = (strtotime(date("Y-m-d H:t")) - strtotime($value->date_reg)) / (strtotime($value->date_beg) - strtotime($value->date_reg)) * 100;
	else
		$progress_now_reg = 0;
	if ((strtotime($value->date_peer) - strtotime($value->date_beg)) > 0)
		$progress_now_dev = (strtotime(date("Y-m-d H:t")) - strtotime($value->date_beg)) / (strtotime($value->date_peer) - strtotime($value->date_beg)) * 100;
	else
		$progress_now_dev = 0;
	if ((strtotime($value->date_end) - strtotime($value->date_peer)) > 0)
		$progress_now_peer = (strtotime(date("Y-m-d H:t")) - strtotime($value->date_peer)) / (strtotime($value->date_end) - strtotime($value->date_peer)) * 100;
	else
		$progress_now_peer = 0;

		if ($progress_now_reg < 0)
			$progress_now_reg = 0;
		if ($progress_now_reg > 100)
			$progress_now_reg = 100;

		if ($progress_now_dev < 0)
			$progress_now_dev = 0;
		if ($progress_now_dev > 100)
			$progress_now_dev = 100;

		if ($progress_now_peer < 0)
			$progress_now_peer = 0;
		if ($progress_now_peer > 100)
			$progress_now_peer = 100;
		echo '<tr>
				<td COLSPAN=2>Progress Bar :</td>
				<td COLSPAN=1.5><div class="progress">
  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress_now_reg.'%;">
    '.round ($progress_now_reg).'%
  </div>
</div></td>

<td COLSPAN=1.5><div class="progress">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress_now_dev.'%;">
    '.round ($progress_now_dev).'%
  </div>
</div></td>

<td COLSPAN=1.5><div class="progress">
  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '.$progress_now_peer.'%;">
    '.round ($progress_now_peer).'%
  </div>
</div></td>
				</tr>';
	}
	echo "</table>";
}
else
{
	echo "<h2>No Module register...</h2>";
}

?>
</div>
