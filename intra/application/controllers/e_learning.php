<?php

class e_learning extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->auto_login();
		$data['title'] = "What's this Frame ?";
		if ($this->session->userdata('root'))
			$data['root'] = 1;
		$this->load->view('index/header_html');
		$this->loggin($data);
		$data['login'] = 1;
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		$data['tab_all_stuff'] = $this->e_learning_model->list_all_stuff();
		$this->load->view('e_learning/tab_all', $data);

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function learning($name_module = "", $name_activity = "", $name_tuto = "")
	{
		if (empty($name_module) && empty($name_activity) && empty($name_tuto))
			redirect(base_url()."e_learning");
		$this->auto_login();
		$data['title'] = "What's this Frame ?";
		if ($this->session->userdata('root'))
			$data['root'] = 1;
		$this->load->view('index/header_html');
		$this->loggin($data);
		$data['login'] = 1;
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		$data['name_activity'] = $name_activity;
		$data['name_module'] = $name_module;
		$data['tuto_title'] = str_replace('_', ' ', $name_tuto);
		$data['youtube_url'] = $this->e_learning_model->youtube(str_replace('_', ' ', $name_tuto));

		$data['youtube_url'] = str_replace('https:', '', $data['youtube_url']);
		$data['youtube_url'] = str_replace('watch?v=', 'embed/', $data['youtube_url']);
		$this->load->view('e_learning/view_learning', $data);

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function show($name_module = "", $name_activity = "")
	{
		if (empty($name_module) && empty($name_activity))
			redirect(base_url()."e_learning");
		$this->auto_login();
		$data['title'] = "What's this Frame ?";
		if ($this->session->userdata('root'))
			$data['root'] = 1;
		$this->load->view('index/header_html');
		$this->loggin($data);
		$data['login'] = 1;
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		$data['module_name'] = $name_module;
		$data['title_activity'] = $name_activity;
		$data['tab'] = $this->e_learning_model->list_learning($name_activity);
		$this->load->view('e_learning/tab_learning', $data);

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function add_learning($name_module = "", $name_activity = "")
	{
		if (empty($name_module) && empty($name_activity))
			redirect(base_url()."e_learning");
		$this->auto_login();
		$data['title'] = "What's this Frame ?";
		if ($this->session->userdata('root'))
			$data['root'] = 1;
		$this->load->view('index/header_html');
		$this->loggin($data);
		$data['login'] = 1;
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		$data['add'] = 1;
		$data['module_name'] = $name_module;
		$data['title_activity'] = $name_activity;
		$data['tab'] = $this->e_learning_model->list_learning($name_activity);
		$this->load->view('e_learning/tab_learning', $data);

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function add_valid()
	{
		$name = $this->input->post('name');
		$url = $this->input->post('youtube_url');
		$name_module = $this->input->post('name_module');
		$name_activity = $this->input->post('name_activity');

		$this->form_validation->set_rules('name','Name','trim|required|xss_clean|is_unique[e_learning.name]');
		$this->form_validation->set_rules('youtube_url','Youtube URL','trim|required|xss_clean');

		if ($this->form_validation->run())
		{
			$id_activity = $this->activity_model->id_to_name($name_activity);
			$this->e_learning_model->add_learning($name, $url, $id_activity);
			redirect(base_url()."e_learning/show/".$name_module."/".$name_activity);
		}
		else
			$this->add_learning($name_module, $name_activity);
	}

	public function delete_learning($name_module = '', $name_activity = '', $id = '')
	{
		if ($this->session->userdata('root'))
			$this->e_learning_model->remove($id);
		redirect(base_url()."e_learning/show/".$name_module."/".$name_activity);
	}

	private function auto_login()
	{
		if ($this->input->cookie('login', TRUE) && $this->input->cookie('passwd', TRUE))
		{
			$pseudo = $this->input->cookie('login');
			$mdp = $this->input->cookie('passwd');

			if (!($query = $this->datamodels->check_connect($pseudo, $mdp)))
			{
				echo "error cookies, delete them and try again.";
			}
			else
			{
				$row = $query->row();
				$this->root = $row->root;
				$data['pseudo'] = $row->pseudo;
				$this->session->set_userdata('pseudo', $data['pseudo']);
				$this->session->set_userdata('mdp', $row->passwd);
				$this->session->set_userdata('id', $row->id);
				$this->session->set_userdata('email', $row->email);
				$this->session->set_userdata('root', $row->root);
				$this->session->set_userdata('img_profil', $row->img_profil);
				$this->session->set_userdata('login', 1);
			}
		}
		else if ($this->session->userdata('pseudo') && $this->session->userdata('passwd'))
		{
			if ($this->session->set_userdata('autologin', 1))
			{
				$cookie_login = array(
            	       'name'   => 'login',
            	       'value'  => $this->session->userdata('pseudo'),
            	       'expire' => '82000'
            	   );

				$cookie_passwd = array(
            	       'name'   => 'passwd',
            	       'value'  => $this->session->userdata('passwd'),
            	       'expire' => '82000'
            	);
            	$this->input->set_cookie($cookie_login);
				$this->input->set_cookie($cookie_passwd);
			}
		}
		else if (!$this->session->userdata('login'))
		{
			redirect(base_url()."user");
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
?>
