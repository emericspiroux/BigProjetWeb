<?php
class groupe_model extends CI_Model
{

	function __construct()
    {
        parent::__construct();
    }

    function id_to_name($id)
	{
		$query = $this->db->query('SELECT name FROM groupe WHERE id='.$id);
		if (!$query->result_array())
			return (false);
		$row = $query->row();
		return $row->name;
	}

	function user_groupe_info($id_groupe)
	{
		$query = $this->db->query('SELECT `user`.pseudo, `user`.img_profil FROM `groupe`, `user`, `inscrit_activity`  WHERE `groupe`.id = '.$id_groupe.' AND `inscrit_activity`.id_groupe = `groupe`.id AND `inscrit_activity`.id_user = `user`.id');
		if (!$query->result_array())
			return (false);
		else
			return $query;
	}

	function id_user_to_id_groupe($id_user)
	{
		$query = $this->db->query('SELECT `groupe`.id FROM `groupe`, `user`, `inscrit_activity`  WHERE `inscrit_activity`.id_groupe = `groupe`.id AND `inscrit_activity`.id_user = `user`.id AND `user`.id='.$id_user);
		if (!$query->result_array())
			return (false);
		$row = $query->row();
		return $row->id;
	}
}
?>
