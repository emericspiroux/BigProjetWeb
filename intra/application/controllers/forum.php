<?php
class forum extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$data= array();
	}

	public function index($id_cat = '', $id_s_cat = '', $id_thread = '')
	{
		if (empty($id_cat) && empty($id_thread) && empty($id_s_cat))
			$this->cat_view();
		else if (isset($id_cat) && empty($id_thread) && empty($id_s_cat))
			$this->s_cat_view($id_cat);
		else if (isset($id_cat) && isset($id_s_cat) && empty($id_thread))
			$this->thread_view($id_cat, $id_s_cat);
		else if (isset($id_cat) && isset($id_s_cat) && isset($id_thread))
			$this->message_view($id_cat, $id_s_cat, $id_thread);
	}

	public function message_view($id_cat, $id_s_cat, $id_thread, $data = array())
	{
		$data['tab_message'] = $this->forumodels->list_message($id_thread);
		$query = $this->forumodels->title_cat($id_cat);
		$query2 = $this->forumodels->title_s_cat($id_s_cat);
		$query3 = $this->forumodels->title_thread($id_thread);
		$data['cat_title'] = $query->row()->title;
		$data['s_cat_title'] = $query2->row()->title;
		$data['thread_title'] = $query3->row()->title;
		$data['id_s_cat'] = $id_s_cat;
		$data['id_cat'] = $id_cat;
		$data['id_thread'] = $id_thread;
		$data['title'] = "What the Forum ?!";
		$data['id_user'] = $this->session->userdata('id');
		$this->load->view('index/header_html');
		$this->loggin($data);
		if($this->session->userdata('root'))
			$data['root'] = 1;
		if($this->session->userdata('login'))
			$data['login'] = 1;
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');
		$this->load->view('forum/forum_message_view', $data);
		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function thread_view($id_cat, $id_s_cat, $data = array())
	{
		$data['title'] = "What the Forum ?!";
		$data['id_user'] = $this->session->userdata('id');
		$this->load->view('index/header_html');
		$this->loggin($data);
		if($this->session->userdata('root'))
			$data['root'] = 1;
		if($this->session->userdata('login'))
			$data['login'] = 1;
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		$data['tab_thread'] = $this->forumodels->list_thread($id_s_cat);
		$query = $this->forumodels->title_cat($id_cat);
		$query2 = $this->forumodels->title_s_cat($id_s_cat);
		$data['cat_title'] = $query->row()->title;
		$data['s_cat_title'] = $query2->row()->title;
		$data['id_s_cat'] = $id_s_cat;
		$data['id_cat'] = $id_cat;
		$this->load->view('forum/forum_thread_view', $data);

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function cat_view()
	{
		$data['tab_cat'] = $this->forumodels->list_cat();
		$data['title'] = "What the Forum ?!";
		$data['id_user'] = $this->session->userdata('id');
		$this->load->view('index/header_html');
		$this->loggin($data);
		if($this->session->userdata('root'))
			$data['root'] = 1;
		if($this->session->userdata('login'))
			$data['login'] = 1;
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');
		$this->load->view('forum/forum_view', $data);
		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function s_cat_view($id_cat, $data = array())
	{
		$data['tab_s_cat'] = $this->forumodels->list_s_cat($id_cat);
		$query = $this->forumodels->title_cat($id_cat);
		$data['cat_title'] = $query->row()->title;
		$data['id_cat'] = $id_cat;
		$data['title'] = "What the Forum ?!";
		$data['id_user'] = $this->session->userdata('id');
		$this->load->view('index/header_html');
		$this->loggin($data);
				if($this->session->userdata('root'))
			$data['root'] = 1;
		if($this->session->userdata('login'))
			$data['login'] = 1;
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');
		$this->load->view('forum/forum_s_cat_view', $data);
		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function s_cat_add($id_cat)
	{
		$data = Array();
		$error = Array();
		$data['error'] = $error;
		if (!($title = $this->input->post('title')))
				$data['error']['title'] = 1;
		else if ($this->forumodels->check_title_s_cat($title))
				$data['error']['title'] = 2;
		if (!($comment = $this->input->post('comment')))
			$data['error']['comment'] = 1;
		$author = $this->session->userdata('id');
		if (empty($data['error']['title']) && empty($data['error']['comment']))
		{
			$this->forumodels->s_cat_add($title, $comment, $author, $id_cat);
			$data['title'] = "WTF, you've add '".$title."' sub-category !";
			$this->s_cat_view($id_cat, $data);
		}
		else
		{
			$data['title'] = "WTF, you can't add sub-category ?!";
			$this->s_cat_view($id_cat, $data);
		}
	}

	public function thread_add($id_cat, $id_s_cat)
	{
		$data = Array();
		$error = Array();
		$data['error'] = $error;
		if (!($title = $this->input->post('title')))
				$data['error']['title'] = 1;
		else if ($this->forumodels->check_title_thread($title))
				$data['error']['title'] = 2;
		if (!($comment = $this->input->post('comment')))
			$data['error']['comment'] = 1;
		$author = $this->session->userdata('id');
		if (empty($data['error']['title']) && empty($data['error']['comment']))
		{
			$this->forumodels->thread_add($title, $comment, $author, $id_s_cat);
			$data['title'] = "WTF, you've add '".$title."' thread !";
			$this->thread_view($id_cat, $id_s_cat,  $data);
		}
		else
		{
			$data['title'] = "WTF, you can't add thread ?!";
			$this->thread_view($id_cat, $id_s_cat,  $data);
		}
	}

	public function message_add($id_cat, $id_s_cat, $id_thread)
	{
		$data = Array();
		$error = Array();
		$data['error'] = $error;
		if (!($comment = nl2br($this->input->post('comment'))))
			$data['error']['comment'] = 1;
		$author = $this->session->userdata('id');
		if (empty($data['error']['comment']))
		{
			$this->forumodels->message_add($comment, $author, $id_thread);
			$data['title'] = "WTF, you've add a message !";
			$this->message_view($id_cat, $id_s_cat, $id_thread, $data);
		}
		else
		{
			$data['title'] = "WTF, you can't add this message ?!";
			$this->message_view($id_cat, $id_s_cat, $id_thread, $data);
		}
	}

	public function delete($id_user, $id_cat, $id_s_cat = '', $id_thread= '', $id_message = '')
	{
		$id_user = $this->session->userdata('id');
		if (isset($id_cat) && empty($id_s_cat) && empty($id_thread) && empty($id_message))
		{
			$this->forumodels->delete_cat($id_cat, $id_user);
			$this->cat_view();
		}
		else if (isset($id_cat) && isset($id_s_cat) && empty($id_thread) && empty($id_message))
		{
			$this->forumodels->delete_s_cat($id_s_cat, $id_user);
			$this->s_cat_view($id_cat);
		}
		else if (isset($id_cat) && isset($id_s_cat) && isset($id_thread) && empty($id_message))
		{
			$this->forumodels->delete_thread($id_thread, $id_user);
			$this->thread_view($id_cat, $id_s_cat);
		}
		else if (isset($id_cat) && isset($id_s_cat) && isset($id_thread) && isset($id_message))
		{
			$this->forumodels->delete_message($id_message, $id_user);
			$this->message_view($id_cat, $id_s_cat, $id_thread);
		}
	}

	public function delete_cat($id)
	{
		if ($this->session->userdata('root'))
		{
			$this->forumodels->delete_cat($id);
			$this->cat_view();
		}
	}

	public function log_view($data)
	{
		$data['pseudo'] = $this->session->userdata('pseudo');
		$data['img_profil'] = $this->session->userdata('img_profil');
		$this->load->view('user/profil_view', $data);
	}

	public function loggin($data)
	{
		if (!$this->session->userdata('login'))
			$this->load->view('index/start', $data);
		else
			$this->log_view($data);
	}

}
