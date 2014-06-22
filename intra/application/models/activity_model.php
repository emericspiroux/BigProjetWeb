<?php
class activity_model extends CI_Model
{
	function __construct()
  {
        parent::__construct();
  }

    function list_profil_activity($id_user)
    {
            $query = $this->db->query("Select distinct activity.*, module.name as module_name, inscrit_activity.inscrit AS inscrit_a, inscrit_module.inscrit AS inscrit_m from activity left join inscrit_activity on inscrit_activity.id_activity = activity.id
      AND inscrit_activity.id_user = ".$id_user.", module left join inscrit_module on inscrit_module.id_mod = module.id
      AND inscrit_module.id_user = ".$id_user." where activity.date_reg < '".date("Y-m-d H:t")."' AND activity.date_end > '".date("Y-m-d H:t")."' AND module.id = activity.id_mod AND  inscrit_module.inscrit = 1;");
      if (!$query->result_array())
        return (false);
      return $query;
    }

    function add_object($id_activity, $name, $link)
    {
        $data = array(
              'id_activity' => $id_activity,
               'name' => $name,
               'link' => $link,
            );

    if ($this->db->insert('objet_activity', $data))
      return (true);
    else
      return (false);
    }

    function add($name, $description, $date_reg, $date_beg, $date_peer, $date_end, $id_mod, $nb_place, $groupe, $nb_groupe, $type, $nb_peer)
    {
    	$data = array(
               'name' => $name,
               'description' => $description,
               'date_reg' => $date_reg,
               'date_beg' => $date_beg,
               'date_peer' => $date_peer,
               'date_end' => $date_end,
               'id_mod' => $id_mod,
               'nb_place' => $nb_place,
               'groupe' => $groupe,
               'nb_groupe' => $nb_groupe,
               'type' => $type,
               'nb_peer' => $nb_peer
            );

		  $this->db->insert('activity', $data);
      $query = $this->db->query('SELECT * from activity WHERE name = "'.$name.'" AND description = "'.$description.'" AND id_mod = '.$id_mod);
      if (!$query->result_array())
        return (NULL);
      $row = $query->row();
		  return ($row->id);
    }

    function update_cron($id, $id_cron_peer, $id_cron_groupe, $id_cron_mark)
    {
            $data = array(
               'id_cron_peer' => $id_cron_peer,
               'id_cron_groupe' => $id_cron_groupe,
               'id_cron_mark' => $id_cron_mark
            );

    if ($this->db->update('activity', $data, array('id' => $id)))
      return (true);
    else
      return (false);
    }

    function list_activity($id_module, $id_user)
    {
      $query = $this->db->query('Select distinct activity.*, inscrit_activity.inscrit from activity left join inscrit_activity on inscrit_activity.id_activity = activity.id AND inscrit_activity.id_user = '.$id_user.' where activity.id_mod ='.$id_module);
      if (!$query->result_array())
        return (false);
      return $query;
    }

    function list_groupe($id_activity)
    {
      $query = $this->db->query('SELECT *, groupe.name AS name_groupe
                                 FROM inscrit_activity, groupe, user
                                 WHERE groupe.id=inscrit_activity.id_groupe
                                 AND user.id = inscrit_activity.id_user
                                 AND inscrit_activity.id_activity = '.$id_activity.'
                                 ORDER BY id_groupe ASC');
      if (!$query->result_array())
        return (false);
      return $query;
    }

    function catch_places($id)
    {
        $query = $this->db->query("Select nb_place from activity where id = ".$id);
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

      if ($this->db->update('activity', $data, array('id' => $id)))
        return (true);
      else
        return (false);
    }

    function register($id_user, $id_activity)
    {
      $data = array(
               'id_user' => $id_user,
               'id_activity' => $id_activity,
               'inscrit' => 1,
               'validate' => 0,

            );

    if ($this->db->insert('inscrit_activity', $data))
      return (true);
    else
      return (false);
    }

    function check_register($id_user, $id_activity)
    {
        $query = $this->db->query("Select * from inscrit_activity where id_activity = ".$id_activity." AND id_user = ".$id_user);
        if (!$query->result_array())
          return (false);
        return (true);
    }

    function unregister($id_user, $id_activity)
    {
      if ($this->db->delete('inscrit_activity', array('id_user' => $id_user, 'id_activity' => $id_activity)))
      return (true);
    else
      return (false);
    }

    function id_to_name($activity_name)
    {
      $query = $this->db->query("SELECT id FROM activity WHERE name='".$activity_name."'");
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row->id;
    }

    function name_to_id($activity_id)
    {
      $query = $this->db->query("SELECT name FROM activity WHERE id='".$activity_id."'");
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row->name;
    }

    function id_to_path($id_file)
    {
      $query = $this->db->query("SELECT link FROM objet_activity WHERE id='".$id_file."'");
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row->link;
    }

    function remove($id)
    {
    	if ($this->db->delete('activity', array('id' => $id)))
			return (true);
		else
			return (false);
    }

    function info($id_activity)
    {
        $query = $this->db->query('SELECT * FROM activity WHERE id='.$id_activity.'');
        if (!$query->result_array())
          return (false);
        return $query->row();
    }

    function list_object($activity_id)
    {
        $query = $this->db->query('SELECT * FROM activity, objet_activity WHERE activity.id = objet_activity.id_activity AND activity.id='.$activity_id);
        if (!$query->result_array())
          return (false);
        return $query;
    }

    function  remove_file($id)
    {
      if ($this->db->delete('objet_activity', array('id' => $id)))
      return (true);
    else
      return (false);
    }

    function update($id, $name, $description, $date_reg, $date_beg, $date_peer, $date_end, $id_mod, $nb_place, $type, $nb_peer)
    {
      $data = array(
               'name' => $name,
               'description' => $description,
               'date_reg' => $date_reg,
               'date_beg' => $date_beg,
               'date_peer' => $date_peer,
               'date_end' => $date_end,
               'id_mod' => $id_mod,
               'nb_place' => $nb_place,
               'type' => $type,
               'nb_peer' => $nb_peer
            );

		if ($this->db->update('activity', $data, array('id' => $id)))
			return (true);
		else
			return (false);
    }


    function list_groupe_rand($activity_id, $nb_groupe)
    {
        $query = $this->db->query('SELECT *
                                   FROM inscrit_activity
                                   WHERE id_activity = '.$activity_id.'
                                   AND  `select` = 0
                                   ORDER BY RAND( )
                                   LIMIT 0 , '.$nb_groupe.'');
        if (!$query->result_array())
          return (false);
        return $query;
    }

    function nb_groupe($activity_id)
    {
        $query = $this->db->query('SELECT *
                                   FROM activity
                                   WHERE id = '.$activity_id);
        if (!$query->result_array())
          return (false);
        $row = $query->row();
        return $row->nb_groupe;
    }

    function add_groupe($name, $id_activity)
    {
      $data = array(
               'name' => $name,
               'id_activity' => $id_activity,
            );

      $this->db->insert('groupe', $data);

      //return id_groupe.
      $query = $this->db->query('SELECT *
                                   FROM groupe
                                   WHERE name = "'.$name.'"');
        if (!$query->result_array())
          return (false);
        $row = $query->row();
        return $row->id;
    }

    function add_user_to_groupe($id_groupe, $id_activity, $id_user)
    {
      $data = array(
               'id_groupe' => $id_groupe,
               'select' => 1
            );

    if ($this->db->update('inscrit_activity', $data, array('id_user' => $id_user, 'id_activity' => $id_activity)))
      return (true);
    else
      return (false);
    }

    function add_user_to_inscrit_groupe($id_groupe, $id_activity, $id_user)
    {
      $data = array(
              'id_user' => $id_user,
              'id_activity' => $id_activity,
               'id_groupe' => $id_groupe,
               'select' => 1
            );

      if ($this->db->insert('inscrit_activity', $data))
        return (true);
      else
        return (false);
    }

    function get_user_no_group($id_mod)
    {
      $query = $this->db->query('SELECT DISTINCT user.id, user.pseudo
                                   FROM inscrit_module, user, inscrit_activity
                                   WHERE user.id = inscrit_module.id_user
                                   AND inscrit_activity.id_user != user.id
                                   AND id_mod = '.$id_mod);
      if (!$query->result_array())
        return (false);
      return $query;
    }

}
?>
