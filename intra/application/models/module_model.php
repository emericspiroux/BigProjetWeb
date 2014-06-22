<?php
class module_model extends CI_Model
{
	function __construct()
  {
        parent::__construct();
  }

    function add($name, $description, $date_beg, $date_end_register, $date_end, $nb_credit, $nb_place)
    {
      $data = array(
               'name' => $name,
               'description' => $description,
               'date_beg' => $date_beg,
               'date_end_register' => $date_end_register,
               'date_end' => $date_end,
               'nb_credit' => $nb_credit,
               'nb_place' => $nb_place,
            );

		if ($this->db->insert('module', $data))
			return (true);
		else
			return (false);
    }

  function list_module($id_user)
  {
    $query = $this->db->query("Select distinct module.*, inscrit_module.inscrit from module left join inscrit_module on inscrit_module.id_mod = module.id AND inscrit_module.id_user =".$id_user);
    if (!$query->result_array())
      return (false);
    return $query;
  }

    function id_to_name($module_name)
    {
      $query = $this->db->query("SELECT id FROM module WHERE name='".$module_name."'");
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row->id;
    }

    function name_to_id($id_mod)
    {
      $query = $this->db->query("SELECT name FROM module WHERE id=".$id_mod);
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row->name;
    }

    function remove($id)
    {
    	if ($this->db->delete('module', array('id' => $id)))
			return (true);
		else
			return (false);
    }

    function catch_places($id)
    {
            $query = $this->db->query("Select nb_place from module where id = ".$id);
        if (!$query->result_array())
        return (false);
        $row = $query->row();
        return $row->nb_place;
    }

    function update_place($id, $nb_place)
    {
            $data = array(
               'nb_place' => $nb_place,
            );

    if ($this->db->update('module', $data, array('id' => $id)))
      return (true);
    else
      return (false);
    }

    function update($id, $name, $des, $date_beg, $date_end_register, $date_end, $nb_credit, $nb_place)
    {
      $data = array(
               'name' => $name,
               'description' => $des,
               'date_beg' => $date_beg,
               'date_end_register' => $date_end_register,
               'date_end' => $date_end,
               'nb_credit' => $nb_credit,
               'nb_place' => $nb_place,
            );

		if ($this->db->update('module', $data, array('id' => $id)))
			return (true);
		else
			return (false);
    }

    function register($id_user, $id_module)
    {
      $data = array(
               'id_user' => $id_user,
               'id_mod' => $id_module,
               'inscrit' => 1,
               'validate' => 0,

            );

    if ($this->db->insert('inscrit_module', $data))
      return (true);
    else
      return (false);
    }

    function check_register($id_user, $id_module)
    {
        $query = $this->db->query("Select * from inscrit_module where id_mod = ".$id_module." AND id_user = ".$id_user);
        if (!$query->result_array())
          return (false);
        return (true);
    }

    function unregister($id_user, $id_module)
    {
      if ($this->db->delete('inscrit_module', array('id_user' => $id_user, 'id_mod' => $id_module)))
      return (true);
    else
      return (false);
    }
}
?>
