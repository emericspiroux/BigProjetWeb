<?php

class contact_class extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$data = array();
	}

	public function index($data = '')
	{
		if ($this->session->userdata('login'))
			$data['login'] = 1;
		if ($this->session->userdata('root'))
			$data['root'] = 1;
		$data['title'] = "WTF ? want you communicate ?";
		$this->load->view('index/header_html');
		$this->load->view('index/start', $data);
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		$this->load->view('contact/contact_add', $data);

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function add()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$message = $this->input->post('message');
		if (empty($name))
			$data['error_name'] = 1;
		if (empty($message))
			$data['error_message'] = 1;
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			$data['error_formemail'] = 1;
		if (empty($message) || empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$this->index($data);
		}
		else
		{
			$this->datamodels->add_contact($name, $email, $message);
			$data['contact_ok'] = 1;
			$this->index($data);
		}
	}

}

?>
