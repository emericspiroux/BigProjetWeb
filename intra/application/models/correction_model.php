<?php
class correction_model extends CI_Model
{
	function __construct()
  {
        parent::__construct();
  }

    function add($id_teacher, $id_student, $id_activity, $mark, $feedback, $accept, $save)
    {
    	$data = array(
               'id_teacher' => $id_teacher,
               'id_student' => $id_student,
               'id_activity' => $id_activity,
               'mark' => $mark,
               'feedback' => $feedback,
               '$accept' => $accept,
               '$save' => $save
            );

		if ($this->db->insert('correction', $data))
			return (true);
		else
			return (false);
    }

    function add_correcting($id_teacher, $id_student, $id_activity)
    {
      $data = array(
               'id_teacher' => $id_teacher,
               'id_student' => $id_student,
               'id_activity' => $id_activity
            );

    if ($this->db->insert('correction', $data))
      return (true);
    else
      return (false);
    }

    function add_groupe_correcting($id_teacher, $id_groupe, $id_activity)
    {
      $data = array(
               'id_teacher' => $id_teacher,
               'id_groupe' => $id_groupe,
               'id_activity' => $id_activity
            );

    if ($this->db->insert('correction', $data))
      return (true);
    else
      return (false);
    }

    function remove($id)
    {
    	if ($this->db->delete('correction', array('id' => $id)))
			return (true);
		else
			return (false);
    }

    function update($id, $id_teacher, $id_student, $id_activity, $mark, $feedback, $accept, $save)
    {
      $data = array(
               'id_teacher' => $id_teacher,
               'id_student' => $id_student,
               'id_activity' => $id_activity,
               'mark' => $mark,
               'feedback' => $feedback,
               '$accept' => $accept,
               '$save' => $save
            );

		if ($this->db->update('correction', $data, array('id' => $id)))
			return (true);
		else
			return (false);
    }

    function update_mark($id, $mark, $feedback, $accept, $save)
    {
      $data = array(
               'mark' => $mark,
               'feedback' => $feedback,
               'accept' => $accept,
               'save' => $save
            );

    if ($this->db->update('correction', $data, array('id' => $id)))
      return (true);
    else
      return (false);
    }

    function update_mark_group($id_group, $mark, $feedback, $accept, $save)
    {
      $data = array(
               'mark' => $mark,
               'feedback' => $feedback,
               'accept' => $accept,
               'save' => $save
            );

    if ($this->db->update('correction', $data, array('id_groupe' => $id_group)))
      return (true);
    else
      return (false);
    }

    function info_id($id)
    {
        $query = $this->db->query("SELECT *
                                     FROM `correction`
                                     WHERE id = ".$id);
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row;
    }

    function update_peer_correcting($id)
    {
      $query = $this->db->query("SELECT *
                                 FROM `inscrit_activity`
                                 WHERE id =".$id);
      $row = $query->row();
      $data = array(
               'peer_correcting' => $row->peer_correcting + 1
            );

    if ($this->db->update('inscrit_activity', $data, array('id' => $id)))
      return (true);
    else
      return (false);
    }


    function update_groupe_peer_correcting($id)
    {
      $query = $this->db->query("SELECT *
                                 FROM `groupe`
                                 WHERE id =".$id);
      $row = $query->row();
      $data = array(
               'peer_correcting' => $row->peer_correcting + 1
            );

    if ($this->db->update('groupe', $data, array('id' => $id)))
      return (true);
    else
      return (false);
    }

    function update_user_correcting($id)
    {
      $data = array(
               'user_correcting' => 1
            );

    if ($this->db->update('inscrit_activity', $data, array('id' => $id)))
      return (true);
    else
      return (false);
    }


    function find_peer_correcting($id_activity, $id_user)
    {
          $query = $this->db->query("SELECT *
                                     FROM `inscrit_activity`
                                     WHERE peer_correcting < 6
                                     AND id_activity = ".$id_activity."
                                     AND id_user <> ".$id_user."
                                     ORDER BY RAND()
                                     LIMIT 0, ".$nb_peer);
      if (!$query->result_array())
        return (false);
      return $query;
    }

    function find_peer($id_activity)
    {
          $query = $this->db->query("SELECT *
                                     FROM `inscrit_activity`
                                     WHERE id_activity = ".$id_activity);
      if (!$query->result_array())
        return (false);
      return $query;
    }

    function find_group_peer_correcting($id_activity, $id_user, $id_user_group)
    {
          $query = $this->db->query("SELECT *
                                     FROM `inscrit_activity`, groupe
                                     WHERE `groupe`.peer_correcting < 6
                                     AND `groupe`.id = `inscrit_activity`.id_groupe
                                     AND `groupe`.id_activity = $id_activity
                                     AND `inscrit_activity`.id_user <> $id_user
                                     AND `inscrit_activity`.id_groupe <> $id_user_group
                                     GROUP BY name
                                     ORDER BY RAND()
                                     LIMIT 0, 5");
      if (!$query->result_array())
        return (false);
      return $query;
    }

    function find_id($id_teacher, $id_student, $id_activity)
    {
          $query = $this->db->query("SELECT *
                                     FROM `correction`
                                     WHERE id_teacher = ".$id_teacher."
                                     AND id_student = ".$id_student."
                                     AND id_activity = ".$id_activity);
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row->id;
    }

    function mark_user($id_user, $id_activity)
    {
          $query = $this->db->query("SELECT ROUND(AVG(mark)) AS moy FROM correction WHERE `id_student` = $id_user AND `id_activity` = $id_activity");
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row->moy;
    }

    function mark_user_group($id_user, $id_activity)
    {
      $query = $this->db->query("SELECT ROUND(AVG(mark)) AS moy FROM correction, inscrit_activity WHERE correction.`id_groupe` = inscrit_activity.id_groupe AND correction.`id_activity` = $id_activity AND inscrit_activity.id_user = $id_user");
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row->moy;
    }

    function find_id_for_groupe($id_teacher, $id_groupe, $id_activity)
    {
          $query = $this->db->query("SELECT *
                                     FROM `correction`
                                     WHERE id_teacher = ".$id_teacher."
                                     AND id_groupe = ".$id_groupe."
                                     AND id_activity = ".$id_activity);
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row->id;
    }

    function find_user_correcting($id_activity)
    {
          $query = $this->db->query("SELECT *
                                     FROM `inscrit_activity`
                                     WHERE user_correcting = 0
                                     AND id_activity = ".$id_activity);
      if (!$query->result_array())
        return (false);
      return $query;
    }

    function list_peer_correcting($id_user)
    {
          $query = $this->db->query("SELECT *
                                     FROM `correction`, `user`, `activity`
                                     WHERE id_teacher = ".$id_user."
                                     AND `correction`.id_student=`user`.id
                                     AND `activity`.id = `correction`.id_activity
                                    AND `activity`.date_end > '".date("Y-m-d H:t")."'
                                     ORDER BY id_activity");
      if (!$query->result_array())
        return (false);
      return $query;
    }

    function list_user_correcting($id_user)
    {
          $query = $this->db->query("SELECT *
                                     FROM `correction`, `user`, `activity`
                                     WHERE id_student = ".$id_user."
                                     AND `correction`.id_teacher=`user`.id
                                     AND `activity`.id = `correction`.id_activity
                                    AND `activity`.date_end > '".date("Y-m-d H:t")."'
                                     ORDER BY id_activity");
      if (!$query->result_array())
        return (false);
      return $query;
    }

    function list_group_peer_correcting($id_user)
    {
          $query = $this->db->query("SELECT *, `activity`.name AS name_activity,
                                                `groupe`.name AS name_groupe
                                     FROM `correction`, `groupe`, `activity`
                                     WHERE id_teacher = ".$id_user."
                                     AND `correction`.id_groupe=`groupe`.id
                                     AND `activity`.id = `correction`.id_activity
                                     AND `activity`.date_end > '".date("Y-m-d H:t")."'
                                     ORDER BY `correction`.id_activity");
      if (!$query->result_array())
        return (false);
      return $query;
    }

    function list_group_user_correcting($id_user)
    {
          $query = $this->db->query("SELECT *, `activity`.name AS name_activity,
                                                `groupe`.name AS name_groupe
                                     FROM `correction`, `groupe`, `activity`, `inscrit_activity`, `user`
                                     WHERE `inscrit_activity`.id_groupe = `correction`.id_groupe
AND `inscrit_activity`.id_user = $id_user
AND `correction`.id_teacher = `user`.id
                                     AND `correction`.id_groupe=`groupe`.id
                                     AND `activity`.id = `correction`.id_activity
                                    AND `activity`.date_end > '".date("Y-m-d H:t")."'
                                     ORDER BY `correction`.id_activity");
      if (!$query->result_array())
        return (false);
      return $query;
    }

    function idgroupe_for_iduser($id_user, $id_activity)
    {
          $query = $this->db->query("SELECT *
                                     FROM `inscrit_activity`
                                     WHERE id_user= ".$id_user."
                                     AND id_activity = ".$id_activity);
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row->id_groupe;
    }

    function avg_activity_mark_user($id_activity, $id_user)
    {
      $query = $this->db->query("SELECT AVG(`correction`.mark) as AVG
                                 FROM `correction`
                                 WHERE `correction`.id_student = ".$id_user."
                                 AND `correction`.id_activity = ".$id_activity);
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row->AVG;
    }

    function avg_groupe_activity_mark_user($id_activity, $id_groupe)
    {
      $query = $this->db->query("SELECT AVG(`correction`.mark) as AVG
                                 FROM `correction`
                                 WHERE `correction`.id_groupe = ".$id_groupe."
                                 AND `correction`.id_activity = ".$id_activity);
      if (!$query->result_array())
        return (false);
      $row = $query->row();
      return $row->AVG;
    }

    function add_activity_mark($id_activity, $id_user, $mark)
    {
        $data = array(
               'id_activity' => $id_activity,
               'id_user' => $id_user,
               'mark' => $mark
            );

    if ($this->db->insert('note_activity', $data))
      return (true);
    else
      return (false);
    }

    function list_mark_user($id_user)
    {
                $query = $this->db->query("SELECT DISTINCT module.date_end, module.name AS name_module, activity.name AS name_activity, note_activity.mark FROM activity, module, note_activity
WHERE module.id =  activity.id_mod
AND note_activity.id_activity = activity.id
AND note_activity.id_user = ".$id_user);
      if (!$query->result_array())
        return (false);
      return $query;
    }
}
?>
