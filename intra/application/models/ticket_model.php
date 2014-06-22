<?php
class ticket_model extends CI_Model
{
	function __construct()
	{
        parent::__construct();
	}

	public function add_ticket($object, $message, $id_cat, $id_user)
	{
		$query = $this->ticket_model->get_admin_message();
		$res = $query->row();
		$data = array(
			'id_admin' => $res->id,
			'id_user' => $id_user,
			'id_categorie' => $id_cat,
			'objet' => $object,
			'message' => $message
		);

		if ($this->db->insert('ticket', $data))
			return(true);
		else
			return(false);
	}

	public function add_message($id_ticket, $message, $id_user)
	{
		$data = array(
			'id_ticket' => $id_ticket,
			'id_author' => $id_user,
			'message' => $message
		);
		if ($this->db->insert('ticket_message', $data))
			return(true);
		else
			return(false);
	}

	public function get_tickets_user($id_user)
	{


		$query = $this->db->query('SELECT * FROM ticket WHERE id_user='.$id_user);
		if (!$query->result_array())
      		return (false);
    	return $query;
	}

	public function get_author($id_author)
	{
		$query = $this->db->query('SELECT pseudo FROM user, ticket WHERE user.id=ticket.id_user AND id_user='.$id_author);
		if (!$query->result_array())
      		return (false);
      	else
    		return $query;
	}

	public function get_name($id_author)
	{
		$query = $this->db->query('SELECT pseudo FROM user WHERE id='.$id_author);
		if (!$query->result_array())
      		return (false);
      	else
    		return $query;
	}

	public function get_id_max_ticket()
	{
		$query = $this->db->query('SELECT max(id) as id FROM ticket');
		if (!$query->result_array())
      		return (false);
      	else
    		return $query;
	}

	public function get_tickets_root($id_root)
	{
		$query = $this->db->query('SELECT * FROM ticket WHERE id_admin='.$id_root);
		if (!$query->result_array())
      		return (false);
    	return $query;
	}

	public function get_ticket($id_ticket)
	{
		$query = $this->db->query('SELECT * FROM ticket WHERE id='.$id_ticket);
		if (!$query->result_array())
      		return (false);
    	return $query;
	}

	public function delete_ticket($id_ticket)
	{
		$this->db->delete('ticket', array('id' => $id_ticket));
		$this->db->delete('ticket_message', array('id_ticket' => $id_ticket));
	}

	public function get_admin_message()
	{
		$query = $this->db->query('SELECT * FROM user WHERE root=1');
		if (!$query->result_array())
      		return (false);
    	return $query;
	}

	public function get_admin($id_admin)
	{
		$query = $this->db->query('SELECT * FROM user WHERE root="1" AND id<>'.$id_admin);
		if (!$query->result_array())
      		return (false);
    	return $query;
	}

	public function get_fil($id_ticket)
	{
		$query = $this->db->query('SELECT ticket_message.*, user.pseudo FROM ticket_message, user WHERE user.id = ticket_message.id_author AND id_ticket='.$id_ticket.' ORDER BY date_message');
		if (!$query->result_array())
      		return (false);
    	return $query;
	}

	public function update_admin($id_ticket, $id_admin)
	{
		$data = array(
			'id_admin' => $id_admin
		);
		if ($this->db->update('ticket', $data, "id = ".$id_ticket))
			return (true);
		else
			return (false);
	}

	public function get_cat()
	{
		$query = $this->db->query('SELECT * FROM ticket_cat');
		if (!$query->result_array())
      		return (false);
    	return $query;
	}
}

?>
