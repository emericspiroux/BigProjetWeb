<?php
class datamodels extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	function check_connect($name, $mdp)
	{
		$query = $this->db->query('SELECT * FROM user WHERE pseudo="'.$name.'" AND passwd="'.$mdp.'"');
		if (!$query->result_array())
			return (false);
		return $query;
	}

	function id_to_img($id)
	{
		$query = $this->db->query('SELECT img_profil FROM user WHERE id='.$id);
		if (!$query->result_array())
			return (false);
		$row = $query->row();
		return $row->img_profil;
	}

	function match_old_password($id, $pass_old)
	{
		$query = $this->db->query('SELECT passwd FROM user WHERE id='.$id);
		if (!$query->result_array())
			return (0);
		$pass = $query->row();
		if ($pass->passwd != $pass_old)
			return (0);
		else
			return (1);
	}

	function change_password($id, $password)
	{
		$data = array(
               'passwd' => $password
            );

		if ($this->db->update('user', $data, array('id' => $id)))
			return (true);
		else
			return (false);
	}

	function id_to_name($id)
	{
		$query = $this->db->query('SELECT pseudo FROM user WHERE id='.$id);
		if (!$query->result_array())
			return (false);
		$row = $query->row();
		return $row->pseudo;
	}

	function pseudo_check($name)
	{
		$query = $this->db->query('SELECT * FROM user WHERE pseudo="'.$name.'"');
		if (!$query->result_array())
			return (false);
		return true;
	}

	function mail_check($email)
	{
		$query = $this->db->query('SELECT * FROM user WHERE email="'.$email.'"');
		if (!$query->result_array())
			return (false);
		return true;
	}

	function list_user()
	{
		$query = $this->db->query('SELECT id, pseudo, email, root FROM user');
		if (!$query->result_array())
			return (false);
		return $query;
	}

	function update_user($id, $pseudo, $email, $root)
	{
		if (strtoupper($root) == "OUI")
			$root = 1;
		else
			$root = 0;
		$data = array(
               'pseudo' => $pseudo,
               'email' => $email,
               'root' => $root
            );

		if ($this->db->update('user', $data, array('id' => $id)))
			return (true);
		else
			return (false);
	}

	function delete_user($id)
	{
		if ($this->db->delete('user', array('id' => $id)))
			return (true);
		else
			return (false);
	}

	function add_user($pseudo, $mdp, $email, $root)
	{
		if (strtoupper($root) == "OUI")
			$root = 1;
		else
			$root = 0;
		$data = array(
               'pseudo' => $pseudo,
               'passwd' => $mdp,
               'email' => $email,
               'root' => $root
            );

		if ($this->db->insert('user', $data))
			return (true);
		else
			return (false);
	}

	function add_contact($name, $email, $message)
	{
		$data = array(
               'name' => $name,
               'email' => $email,
               'message' => $message,
            );

		if ($this->db->insert('contact', $data))
			return (true);
		else
			return (false);
	}

	function delete_contact($id)
	{
		if ($this->db->delete('contact', array('id' => $id)))
			return (true);
		else
			return (false);
	}

	function list_contact()
	{
		$query = $this->db->query('SELECT * FROM contact');
		if (!$query->result_array())
			return (false);
		return $query;
	}

	function change_img($link, $id)
	{
		$data = array(
               'img_profil' => $link
            );

		if ($this->db->update('user', $data, array('id' => $id)))
			return (true);
		else
			return (false);
	}
}
?>
