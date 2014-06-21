<?php
class planning extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auto_login();
	}

	public function log_view($data = array())
	{
		$data['pseudo'] = $this->session->userdata('pseudo');
		$data['img_profil'] = $this->session->userdata('img_profil');
		$this->load->view('user/profil_view', $data);
	}


	public function index()
	{
		$data['login'] = 1;
		$data['title'] = "WTF ?";
		$data['pseudo'] = $this->session->userdata('pseudo');
		if ($this->session->userdata('root'))
			$data['root'] = 1;
		$this->load->view('index/header_html');
		$this->log_view($data);
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		$data['tab_planning'] = $this->planning_model->keep_planning(date("Y-m-d H:t"), $this->session->userdata('id'));
		$this->load->view("planning/tab", $data);

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
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
		else if (!$this->session->userdata('login'))
		{
			redirect(base_url()."user");
		}
	}
}
?>
