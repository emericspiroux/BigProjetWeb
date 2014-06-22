<?php
class inscrit_module_model extends CI_Model
{
	function __construct()
        parent::__construct();

    function add($id_user, $id_module)
    {
    	$data = array(
               'id_user' => $id_user,
               'id_module' => $id_module
            );

		if ($this->db->insert('inscrit_module', $data))
			return (true);
		else
			return (false);
    }

    function remove($id)
    {
    	if ($this->db->delete('inscrit_module', array('id' => $id)))
			return (true);
		else
			return (false);
    }

    function update($id, $id_user, $id_module)
    {
    	$data = array(
               'id_user' => $id_user,
               'id_module' => $id_module
            );

		if ($this->db->update('inscrit_module', $data, array('id' => $id)))
			return (true);
		else
			return (false);
    }
}
?>
