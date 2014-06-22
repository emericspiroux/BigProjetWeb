<?php

class module extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$data= array();
	}

	public function index($data = array())
	{
		$this->auto_login();
		if ($this->session->userdata('root'))
			$data['root'] = 1;
		$this->load->view('index/header_html');
		$this->loggin($data);
		$data['login'] = 1;
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');
		$data['tab_module'] = $this->module_model->list_module($this->session->userdata('id'));
		$this->load->view('module/tab', $data);
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

	public function delete($id)
	{
		$data = array();
		if ($this->session->userdata('root'))
			$this->module_model->remove($id);
		redirect(base_url()."module");
	}

	public function register($id_module = 0)
	{
		if ($this->session->userdata('login') &&  $id_module != 0)
		{
			$places = $this->module_model->catch_places($id_module);
			if ($places > 0)
			{
				$this->module_model->register($this->session->userdata('id'), $id_module);
				$this->module_model->update_place($id_module, $places - 1);
			}
			$this->index();
		}
		else
			$this->index();
	}

	public function unregister($id_module = 0)
	{
		if ($this->session->userdata('login') &&  $id_module != 0)
		{
			$places = $this->module_model->catch_places($id_module);
			if ($places >= 0)
			{
				$this->module_model->unregister($this->session->userdata('id'), $id_module);
				$this->module_model->update_place($id_module, $places + 1);
			}
			$this->index();
		}
		else
			$this->index();
	}

	public function modify($id, $data = array())
	{
		$data = array();
		if (!$this->session->userdata('root'))
			redirect(base_url()."user");
		$data['root'] = 1;
		$this->load->view('index/header_html');
		$this->loggin($data);
		$data['login'] = 1;
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		$data['tab_module'] = $this->module_model->list_module($this->session->userdata('id'));
		$data['id'] = $id;
		$this->load->view('module/tab', $data);

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function modify_validation($id)
	{
		$data = array();
		$name = $this->input->post('name');
		$des = $this->input->post('description');
		$date_beg = $this->input->post('date_beg');
		$date_end_register = $this->input->post('date_end_register');
		$date_end = $this->input->post('date_end');
		$nb_credit = $this->input->post('nb_credit');
		$places = $this->input->post('places');
		$this->form_validation->set_rules('places','number of places','trim|required|numeric');

		$this->form_validation->set_rules('name','Name','trim|required|is_unique[module.name]');
		$this->form_validation->set_rules('description','Description','trim|required');
		$this->form_validation->set_rules('date_beg','Date of the begin','trim|required');
		$this->form_validation->set_rules('date_end_register','End date of registration','trim|required');
		$this->form_validation->set_rules('date_end','Date of the end','trim|required');
		$this->form_validation->set_rules('nb_credit','number of credit','trim|required|numeric');
		$name = str_replace(' ', '_', $name);

		if ($this->form_validation->run())
		{
			$this->module_model->update($id, $name, $des, $date_beg, $date_end_register, $date_end, $nb_credit, $places);
			redirect(base_url()."module");
		}
		else
		{
			$this->modify($id, $data);
		}
	}

	public function add_validation()
	{
		$data = array();
		$name = $this->input->post('name');
		$des = $this->input->post('description');
		$date_beg = $this->input->post('date_beg');
		$date_end_register = $this->input->post('date_end_register');
		$date_end = $this->input->post('date_end');
		$nb_credit = $this->input->post('nb_credit');
		$places = $this->input->post('places');

		$this->form_validation->set_rules('name','Name','trim|required|is_unique[module.name]');
		$this->form_validation->set_rules('description','Description','trim|required');
		$this->form_validation->set_rules('date_beg','Date of the begin','trim|required');
		$this->form_validation->set_rules('date_end_register','End date of registration','trim|required');
		$this->form_validation->set_rules('date_end','Date of the end','trim|required');
		$this->form_validation->set_rules('nb_credit','number of credit','trim|required|numeric');
		$this->form_validation->set_rules('places','number of places','trim|required|numeric');
		$name = str_replace(' ', '_', $name);
		if ($this->form_validation->run())
		{
			$this->module_model->add($name, $des, $date_beg, $date_end_register, $date_end, $nb_credit, $places);
			$this->forumodels->cat_add($name, $des, $this->session->userdata('id'));
			redirect(base_url()."module");
		}
		else
		{
			$data['error_form_name'] = $name;
			$data['error_form_des'] = $des;
			$data['error_form_date_beg'] = $date_beg;
			$data['error_form_date_end_reg'] = $date_end_register;
			$data['error_form_date_end'] = $date_end;
			$data['error_form_nb_credit'] = $nb_credit;
			$data['error_form_places'] = $places;
			$this->add($data);
		}
	}

	public function add($data = array())
	{
		if (!$this->session->userdata('root'))
		{
			redirect();
		}
		$data['root'] = 1;
		$this->load->view('index/header_html');
		$this->loggin($data);
		$data['login'] = 1;
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		$data['tab_module'] = $this->module_model->list_module($this->session->userdata('id'));
		$data['add'] = 1;
		$this->load->view('module/tab', $data);

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function log_view($data = array())
	{
		$data['title'] = "WTF ?";
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
