<?php
class peer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function launch_peer($id_activity)
	{
		$row_user = $this->correction_model->find_user_correcting($id_activity);
		$row = $this->activity_model->info($id_activity);
		$nb_peer = $row->nb_peer;

		if ($row_user != false)
		{
			foreach ($row_user->result() as $value)
			{
				$row_peer = $this->correction_model->find_peer_correcting($id_activity, $value->id_user, $nb_peer);
				if ($row_peer != false)
				{
					foreach ($row_peer->result() as $peer)
					{
						$this->correction_model->add_correcting($value->id_user, $peer->id_user, $id_activity);
						$this->correction_model->update_peer_correcting($peer->id);
					}
				}
				$this->correction_model->update_user_correcting($value->id);
			}
			echo "ok";
		}
		else
			echo "no peer correcting.";

	}

	public function launch_group($activity_id)
	{
		$nb_groupe = $this->activity_model->nb_groupe($activity_id);
		$name_debut = $this->activity_model->name_to_id($activity_id);
		$row = $this->activity_model->info($id_activity);
		$nb_groupe = $row->nb_groupe;
		$i = 0;
		while ($this->activity_model->list_groupe_rand($activity_id, $nb_groupe))
		{
			$groupe = $this->activity_model->list_groupe_rand($activity_id, $nb_groupe);
			$id_groupe = $this->activity_model->add_groupe($name_debut."_groupe_".$i, $activity_id);
			foreach ($groupe->result() as $value)
			{
				$this->activity_model->add_user_to_groupe($id_groupe, $activity_id, $value->id_user);
			}
			$i = $i + 1;
		}
		echo "Group Create";
	}

	public function launch_group_peer($id_activity)
	{
		$row_user = $this->correction_model->find_user_correcting($id_activity);
		if ($row_user != false)
		{
			foreach ($row_user->result() as $value) {
				$row_peer = $this->correction_model->find_group_peer_correcting($id_activity, $value->id_user, $value->id_groupe);
				if ($row_peer != false)
				{
					foreach ($row_peer->result() as $peer) {
						$this->correction_model->add_groupe_correcting($value->id_user, $peer->id_groupe, $id_activity);
						$this->correction_model->update_groupe_peer_correcting($peer->id_groupe);
					}
				}
				$this->correction_model->update_user_correcting($value->id);
			}
			echo "ok";
		}
		else
			echo "no group peer correcting.";
	}

	public function launch_mark_activity($id_activity)
	{
		$row_user = $this->correction_model->find_peer($id_activity);
		if ($row_user != false)
		{
			foreach ($row_user->result() as $value)
			{
				if ($value->id_groupe == 0)
					$AVG_mark = $this->correction_model->avg_activity_mark_user($id_activity, $value->id_user);
				else
					$AVG_mark = $this->correction_model->avg_groupe_activity_mark_user($id_activity, $value->id_groupe);
				if ($AVG_mark != false)//warning NULL ?
				{
					$mark_activity = $AVG_mark;
				}
				else
					$mark_activity = 0;
				$this->correction_model->add_activity_mark($id_activity, $value->id_user, $mark_activity);
				echo "notation of $value->id_user her note : $mark_activity<br>";
			}
		}
		else
			echo "error;";
	}
}
