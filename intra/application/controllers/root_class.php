<?php
class root_class extends CI_Controller
{

	private $root;
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->data = Array();
		if (!$this->session->userdata('root'))
			redirect();
	}

	function index()
	{
		$data['title'] = "WTF Root?";
		$this->make_root_page($data);
	}

	public function log_view($data = array())
	{
		$data['pseudo'] = $this->session->userdata('pseudo');
		$data['img_profil'] = $this->session->userdata('img_profil');
		$this->load->view('user/profil_view', $data);
	}

	function make_root_page($data)
	{
		if ($this->session->userdata('root'))
		{
			$data['$my_id'] = $this->session->userdata('id');
			$data['$mypseudo'] = $this->session->userdata('pseudo');
			$data['$myemail'] = $this->session->userdata('email');
			$data['$myroot'] = $this->session->userdata('root');
			$data['tab_user'] = $this->datamodels->list_user();
			$data['tab_contact'] = $this->datamodels->list_contact();
			$data['tab_cat'] = $this->forumodels->list_cat();
			$data['id_user'] = $this->session->userdata('id');
			$this->log_view($data);
			$this->load->view('index/header_html');
			$data['login'] = 1;
			$data['root'] = 1;
			$this->load->view('index/menu', $data);
			$this->load->view('index/header_div_menu_content');
			$this->load->view('root/user_list', $data);
			$this->load->view('contact/contact_view', $data);
			$this->load->view('index/footer_div_menu_content');
		}
		else
		{
			redirect();
		}
	}

	function delete_user($id)
	{
		if ($this->datamodels->delete_user($id))
			$data['title'] = "WTF Root, ok i've delete this user !";
		else
			$data['title'] = "WTF Root, we have some problems with DB";
		$this->make_root_page($data);
	}

	function delete_contact($id)
	{
		if ($this->datamodels->delete_contact($id))
			$data['title'] = "WTF Root, ok i've delete this contact !";
		else
			$data['title'] = "WTF Root, we have some problems with DB";
		$this->make_root_page($data);
	}

	function add_user_root()
	{
		$mdp = $this->input->post('passwd');
		$pseudo = $this->input->post('pseudo');
		$email = $this->input->post('email');
		$root = $this->input->post('root');
		if ($this->datamodels->add_user($pseudo, hash('whirlpool', $mdp), $email, $root))
			$data['title'] = "WTF Root, ok i've add this user !";
		else
			$data['title'] = "WTF Root, we have some problems with DB";
		$this->make_root_page($data);
	}

	function valide_mod_user()
	{
		$id = $this->input->post('id');
		$pseudo = $this->input->post('pseudo');
		$email = $this->input->post('email');
		$root = $this->input->post('root');
		if ($this->datamodels->update_user($id, $pseudo, $email, $root))
			$data['title'] = "WTF Root, ok i've change this user !";
		else
			$data['title'] = "WTF Root, we have some problems with DB";
		$this->make_root_page($data);
	}

	function mod_user($id = '')
	{
		$data['id_mod'] = $id;
		$data['title'] = "WTF Root, do you want to change this user ?";
		$this->make_root_page($data);
	}

	public function cat_add()
	{
		$data = Array();
		$error = Array();
		$data['error'] = $error;
		if (!($title = $this->input->post('title')))
				$data['error']['title'] = 1;
		else if ($this->forumodels->check_title_cat($title))
				$data['error']['title'] = 2;
		if (!($comment = $this->input->post('comment')))
			$data['error']['comment'] = 1;
		$author = $this->session->userdata('id');
		if (empty($data['error']['title']) && empty($data['error']['comment']))
		{
			$this->forumodels->cat_add($title, $comment, $author);
			redirect(base_url()."forum");
		}
		else
		{
			$data['title'] = "WTF root, you can't add category !";
			redirect(base_url()."forum");
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect();
	}


}
?>
