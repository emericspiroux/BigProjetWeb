<?php
class e_learning_model extends CI_Model
{
	function __construct()
  {
        parent::__construct();
  }

    function add_learning($name, $url, $id_activity)
    {
    	$data = array(
               'name' => $name,
               'url' => $url,
               'id_activity' => $id_activity
            );

		if ($this->db->insert('e_learning', $data))
			return (true);
		else
			return (false);
    }

    function remove($id)
    {
    	if ($this->db->delete('e_learning', array('id' => $id)))
			return (true);
		else
			return (false);
    }

    function list_all_stuff()
    {
      $query = $this->db->query('SELECT module.name AS name_module, activity.name AS name_activity, e_learning.name AS name_e_learning FROM activity, module, e_learning WHERE module.id = activity.id_mod AND activity.id = e_learning.id_activity ORDER BY name_module');
      if (!$query->result_array())
        return (false);
      return $query;
    }

    function list_learning($name_activity)
    {
      $query = $this->db->query('SELECT e_learning.id, e_learning.name, e_learning.url FROM e_learning, activity WHERE activity.id = e_learning.id_activity AND activity.name="'.$name_activity.'"');
      if (!$query->result_array())
        return (false);
      return $query;
    }

    function youtube($name)
    {
      $query = $this->db->query('SELECT * FROM e_learning WHERE name="'.$name.'"');
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row->url;
    }

    function update($id, $name, $url, $id_activity)
    {
      $data = array(
               'name' => $name,
               'url' => $url,
               'id_activity' => $id_activity
            );

		if ($this->db->update('e_learning', $data, array('id' => $id)))
			return (true);
		else
			return (false);
    }
}
?>
