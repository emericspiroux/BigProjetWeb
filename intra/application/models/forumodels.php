<?php
class forumodels extends CI_Model
{

	function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	function list_cat()
	{
		$query = $this->db->query('SELECT forum_cat.id, forum_cat.title, forum_cat.comment, user.pseudo, user.id AS id_user FROM forum_cat, user WHERE user.id = forum_cat.id_user');
		if (!$query->result_array())
			return (false);
		return $query;
	}

	function list_s_cat($id_cat)
	{
		$query = $this->db->query('SELECT forum_s_cat.id, forum_s_cat.id_cat, forum_s_cat.title, forum_s_cat.comment, user.pseudo, user.id AS id_user FROM user, forum_s_cat WHERE user.id = forum_s_cat.id_user AND forum_s_cat.id_cat='.$id_cat.';');
		if (!$query->result_array())
			return (false);
		return $query;
	}

	function list_thread($id_s_cat)
	{
		$query = $this->db->query('SELECT forum_thread.id, forum_thread.id_s_cat, forum_thread.title, forum_thread.comment, user.pseudo, user.id AS id_user FROM user, forum_thread WHERE user.id = forum_thread.id_user AND forum_thread.id_s_cat='.$id_s_cat.';');
		if (!$query->result_array())
			return (false);
		return $query;
	}

	function list_message($id_thread)
	{
		$query = $this->db->query('SELECT forum_message.id, forum_message.id_thread, forum_message.comment, forum_message.datetime, user.pseudo, user.img_profil, user.id AS id_user FROM user, forum_message WHERE user.id = forum_message.id_user AND forum_message.id_thread='.$id_thread.';');
		if (!$query->result_array())
			return (false);
		return $query;
	}

	function title_cat($id_cat)
	{
		$query = $this->db->query('SELECT title
			FROM forum_cat WHERE id ='.$id_cat.';');
		if (!$query->result_array())
			return (false);
		return $query;
	}

	function title_s_cat($id_s_cat)
	{
		$query = $this->db->query('SELECT title
			FROM forum_s_cat WHERE id ='.$id_s_cat.';');
		if (!$query->result_array())
			return (false);
		return $query;
	}

	function title_thread($id_thread)
	{
		$query = $this->db->query('SELECT title
			FROM forum_thread WHERE id ='.$id_thread.';');
		if (!$query->result_array())
			return (false);
		return $query;
	}

	function check_title_cat($title)
	{
		$query = $this->db->query('SELECT * FROM forum_cat WHERE title="'.$title.'"');
		if (!$query->result_array())
			return (false);
		return (true);
	}

	function check_title_s_cat($title)
	{
		$query = $this->db->query('SELECT * FROM forum_s_cat WHERE title="'.$title.'"');
		if (!$query->result_array())
			return (false);
		return (true);
	}

	function check_title_thread($title)
	{
		$query = $this->db->query('SELECT * FROM forum_thread WHERE title="'.$title.'"');
		if (!$query->result_array())
			return (false);
		return (true);
	}

	function cat_add($title, $comment, $author)
	{
		$data = array(
               'title' => $title,
               'comment' => $comment,
               'id_user' => $author
            );

		if ($this->db->insert('forum_cat', $data))
			return (true);
		else
			return (false);
	}

	function s_cat_add($title, $comment, $id_user, $id_cat)
	{
		$data = array(
               'title' => $title,
               'comment' => $comment,
               'id_user' => $id_user,
               'id_cat' => $id_cat
            );

		if ($this->db->insert('forum_s_cat', $data))
			return (true);
		else
			return (false);
	}

	function thread_add($title, $comment, $id_user, $id_s_cat)
	{
		$data = array(
               'title' => $title,
               'comment' => $comment,
               'id_user' => $id_user,
               'id_s_cat' => $id_s_cat
            );

		if ($this->db->insert('forum_thread', $data))
			return (true);
		else
			return (false);
	}

	function message_add($comment, $id_user, $id_thread)
	{
		$data = array(
               'comment' => $comment,
               'id_user' => $id_user,
               'id_thread' => $id_thread
            );

		if ($this->db->insert('forum_message', $data))
			return (true);
		else
			return (false);
	}

	function delete_cat($id_cat, $id_user = '')
	{
		$this->db->query('DELETE FROM forum_cat WHERE id='.$id_cat);
	}

	function delete_s_cat($id_s_cat, $id_user)
	{
		$this->db->query('DELETE FROM forum_s_cat WHERE id="'.$id_s_cat.'" AND id_user='.$id_user);
	}

	function delete_thread($id_thread, $id_user)
	{
		$this->db->query('DELETE FROM forum_thread WHERE id="'.$id_thread.'" AND id_user='.$id_user);
	}

	function delete_message($id_message, $id_user)
	{
		$this->db->query('DELETE FROM forum_message WHERE id="'.$id_message.'" AND id_user='.$id_user);
	}

}
?>
