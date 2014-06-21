<?php
class inscrit_activity_model extends CI_Model
{
	function __construct()
        parent::__construct();

    function add($id_user, $id_activity)
    {
    	$data = array(
               'id_user' => $id_user,
               'id_activity' => $id_activity
            );

		if ($this->db->insert('inscrit_activity', $data))
			return (true);
		else
			return (false);
    }

    function remove($id)
    {
    	if ($this->db->delete('inscrit_activity', array('id' => $id)))
			return (true);
		else
			return (false);
    }

    function update($id, $id_user, $id_activity)
    {
    	$data = array(
               'id_user' => $id_user,
               'id_activity' => $id_activity
            );

		if ($this->db->update('inscrit_activity', $data, array('id' => $id)))
			return (true);
		else
			return (false);
    }
}
?>
