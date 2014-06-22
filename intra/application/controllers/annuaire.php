<?php

class annuaire extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function search($data = array())
	{
		if ($this->session->userdata("login"))
		{
			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['title'] = "What's This Face ?";
			$data['login'] = 1;
			$this->load->view('index/header_html');
			$this->loggin($data);
			if ($this->session->userdata('root'))
				$data['root'] = 1;
			$this->load->view('index/menu', $data);
			$this->load->view('index/header_div_menu_content');

			//mod profil pic
			$data['img_profil'] = $this->session->userdata('img_profil');

			//ldap connection at 42
				//$connect = $this->ldap_model->identify($this->session->userdata('ldap_log'), $this->session->userdata('ldap_pwd'), "ldap://ldap.42.fr", 389);
			//at home
				 $connect = $this->ldap_model->identify($this->session->userdata('ldap_log'), $this->session->userdata('ldap_pwd'), "ldaps://ldap.42.fr", 636);
			//ldap search info
			$info = $this->ldap_model->search($connect, $this->input->post('search'));
			$data['search'] = $info;
			$this->load->view('annuaire/ldap_search', $data);
		}
		else
			redirect();
	}

	public function loggin($data)
	{
		if (!$this->session->userdata('login'))
		{
			$data['pseudo'] = $this->session->userdata('pseudo');
			$this->load->view('index/start', $data);
		}
		else
			$this->log_view($data);
	}

	public function log_view($data = array())
	{
		$data['pseudo'] = $this->session->userdata('pseudo');
		$data['img_profil'] = $this->session->userdata('img_profil');
		$this->load->view('user/profil_view', $data);
	}
}
