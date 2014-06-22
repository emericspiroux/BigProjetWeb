<?php
	class ticket extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->auto_login();
		}

		public function index($data = array())
		{
			$this->load->view('index/header_html');
			if ($this->session->userdata('root'))
				$data['root'] = 1;
			$data = array(
				'title' => 'wtf',
				'login' => 1
				);
			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['img_profil'] = $this->session->userdata('img_profil');
			$this->load->view('user/profil_view', $data);

						if ($this->session->userdata('root'))
					$data['root'] = 1;
			$this->load->view('index/menu', $data);
			$this->load->view('index/header_div_menu_content');
			if ($this->session->userdata('root'))
			{
				$data = array(
					'titre' 	=> 'ticket root',
					'tickets' 	=> $this->ticket_model->get_tickets_root($this->session->userdata('id')),

				);
				$this->load->view('ticket/ticket_root', $data);
			}
			else
			{
				$data = array(
					'titre'		=> 'ticket user',
					'tickets' 	=> $this->ticket_model->get_tickets_user($this->session->userdata('id')),
					'cat'			=> $this->ticket_model->get_cat(),

				);
				$this->load->view('ticket/ticket_user', $data);
			}
			$this->load->view('index/footer_div_menu_content');
			$this->load->view('index/footer_html');
		}

		public function check_ticket()
		{
			$id_cat = $this->input->post('id_cat');
			$object = $this->input->post('object');
			$content = $this->input->post('content');

			$this->form_validation->set_rules('object','object','trim|required|max_length[15]');
       		$this->form_validation->set_rules('content','content','trim|required');
       		if ($this->form_validation->run())
       		{
       			if ($this->ticket_model->add_ticket($object, $content, $id_cat, $this->session->userdata('id')))
       			{
       				$query = $this->ticket_model->get_id_max_ticket();
       				$row = $query->row();
       				if ($this->ticket_model->add_message($row->id, $content, $this->session->userdata('id')))
       				{
       					$this->session->set_flashdata('success', 'Ticket envoyé');
       					$this->index();
       				}
       			}
       			else
       			{
       				$this->index();
       			}
       		}
		}


		public function display_ticket($id_ticket)
		{
			$this->load->view('index/header_html');
			if ($this->session->userdata('root'))
				$data['root'] = 1;
			$data = array(
				'title' => 'wtf',
				'login' => 1
				);
			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['img_profil'] = $this->session->userdata('img_profil');
			$this->load->view('user/profil_view', $data);

			if ($this->session->userdata('root'))
					$data['root'] = 1;
			$this->load->view('index/menu', $data);

			$this->load->view('index/header_div_menu_content');
			if ($this->session->userdata('root'))
			{
				$data = array(
					'titre' 		=> 'ticket root',
					'root'			=>	1,
					'ticket' 		=> $this->ticket_model->get_ticket($id_ticket),
					'conversation' 	=> $this->ticket_model->get_fil($id_ticket),
					'admin'			=> $this->ticket_model->get_admin($this->session->userdata('id'))
				);
				$this->load->view('ticket/display_ticket', $data);
			}
			else
			{
				$data = array(
					'titre' 		=> 'ticket user',
					'ticket'		=> $this->ticket_model->get_ticket($id_ticket),
					'conversation' 	=> $this->ticket_model->get_fil($id_ticket)
				);
				$this->load->view('ticket/display_ticket', $data);
			}
			$this->load->view('index/footer_div_menu_content');
			$this->load->view('index/footer_html');
		}

		public function add_message()
		{
			$id_ticket = $this->input->post('id_ticket');
			$id_author = $this->session->userdata('id');
			$message = $this->input->post('comment');

       		$this->form_validation->set_rules('comment','comment','trim|required');

       		if ($this->form_validation->run())
       		{
				$this->ticket_model->add_message($id_ticket, $message, $id_author);
				$this->display_ticket($id_ticket);
			}
			else
				$this->display_ticket($id_ticket);
		}

		public function update_admin()
		{
			$id_ticket = $this->input->post('id_ticket');
			$new_id_admin = $this->input->post('list_admin');

			$this->ticket_model->update_admin($id_ticket, $new_id_admin);
			$this->ticket_model->add_message($id_ticket, "I take your Ticket", $new_id_admin);
			$this->index();
		}

		public function delete_ticket($id_ticket)
		{
			$this->ticket_model->delete_ticket($id_ticket);
			$this->index();
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
