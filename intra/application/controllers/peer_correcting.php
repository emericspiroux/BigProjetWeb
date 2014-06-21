<?php
class peer_correcting extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
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

				//peer correcting
				$data['id_user'] = $this->session->userdata('id');
				$data['tab_peer'] = $this->correction_model->list_peer_correcting($this->session->userdata('id'));
				$data['tab_user'] = $this->correction_model->list_user_correcting($this->session->userdata('id'));

				//peer correction groupe
				$data['tab_group_peer'] = $this->correction_model->list_group_peer_correcting($this->session->userdata('id'));
				$data['tab_group_user'] = $this->correction_model->list_group_user_correcting($this->session->userdata('id'));

				//show correction groupe and alone
				$this->load->view('user/peer_correcting', $data);

				//mark of user
				$data['tab_mark'] = $this->correction_model->list_mark_user($this->session->userdata('id'));
				$this->load->view('user/mark', $data);

				$this->load->view('index/footer_div_menu_content');
				$this->load->view('index/footer_html');
			}
			else
				redirect();
	}

	public function correct($id_activity, $id_teacher, $id_student)
	{
			if ($this->session->userdata("login"))
			{
				if ($id_teacher != $this->session->userdata('id'))
					redirect();

				$data['pseudo'] = $this->session->userdata('pseudo');
				$data['title'] = "What's This Face ?";
				$data['login'] = 1;
				$this->load->view('index/header_html');
				$this->loggin($data);
				if ($this->session->userdata('root'))
					$data['root'] = 1;
				$this->load->view('index/menu', $data);
				$this->load->view('index/header_div_menu_content');

				//put form with save later...
				$data['id'] = $this->correction_model->find_id($id_teacher, $id_student, $id_activity);
				$row = $this->correction_model->info_id($data['id']);
				$data['mark'] = $row->mark;
				$data['feedback'] = $row->feedback;
				$data['name_activity'] = $this->activity_model->name_to_id($id_activity);
				$data['name_student'] = $this->datamodels->id_to_name($id_student);
				$data['img_student'] = $this->datamodels->id_to_img($id_student);
				$this->load->view('peer_correcting/correct', $data);

				$this->load->view('index/footer_div_menu_content');
				$this->load->view('index/footer_html');
			}
			else
				redirect();
	}

	public function correct_groupe($id_activity, $id_teacher, $id_groupe)
	{
			if ($this->session->userdata("login"))
			{
				if ($id_teacher != $this->session->userdata('id'))
					redirect();

				$data['pseudo'] = $this->session->userdata('pseudo');
				$data['title'] = "What's This Face ?";
				$data['login'] = 1;
				$this->load->view('index/header_html');
				$this->loggin($data);
				if ($this->session->userdata('root'))
					$data['root'] = 1;
				$this->load->view('index/menu', $data);
				$this->load->view('index/header_div_menu_content');

				//put form with save later...
				$data['id'] = $this->correction_model->find_id_for_groupe($id_teacher, $id_groupe, $id_activity);
				$row = $this->correction_model->info_id($data['id']);
				$data['mark'] = $row->mark;
				$data['feedback'] = $row->feedback;
				$data['name_activity'] = $this->activity_model->name_to_id($id_activity);
				$data['name_student'] = $this->groupe_model->id_to_name($id_groupe);
				$data['imgs_groupe'] = $this->groupe_model->user_groupe_info($id_groupe);
				$this->load->view('peer_correcting/correct_groupe', $data);

				$this->load->view('index/footer_div_menu_content');
				$this->load->view('index/footer_html');
			}
			else
				redirect();
	}

	public function my_correct($id_activity, $id_teacher, $id_student)
	{
			if ($this->session->userdata("login"))
			{
				if ($id_student != $this->session->userdata('id'))
					redirect();

				$data['pseudo'] = $this->session->userdata('pseudo');
				$data['title'] = "What's This Face ?";
				$data['login'] = 1;
				$this->load->view('index/header_html');
				$this->loggin($data);
				if ($this->session->userdata('root'))
					$data['root'] = 1;
				$this->load->view('index/menu', $data);
				$this->load->view('index/header_div_menu_content');

				$data['id'] = $this->correction_model->find_id($id_teacher, $id_student, $id_activity);
				$r_activity = $this->activity_model->info($row->id_activity);
				$row = $this->correction_model->info_id($data['id']);
				if ($row->accept == 1)
				{
					$data['mark'] = $row->mark;
					$data['feedback'] = $row->feedback;
				}
				$data['name_activity'] = $this->activity_model->name_to_id($id_activity);
				$data['name_teacher'] = $this->datamodels->id_to_name($id_teacher);
				$data['img_teacher'] = $this->datamodels->id_to_img($id_teacher);
				$this->load->view('peer_correcting/my_correct', $data);

				$this->load->view('index/footer_div_menu_content');
				$this->load->view('index/footer_html');
			}
			else
				redirect();
	}

	public function my_correct_groupe($id_activity, $id_teacher, $id_groupe)
	{
			if ($this->session->userdata('login'))
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

				$data['id'] = $this->correction_model->find_id_for_groupe($id_teacher, $id_groupe, $id_activity);
				$row = $this->correction_model->info_id($data['id']);

				if ($row->accept == 1 && $id_groupe != $this->groupe_model->id_user_to_id_groupe($this->session->userdata('id')))
					redirect();

				$data['mark'] = $row->mark;
				$data['feedback'] = $row->feedback;
				$data['name_activity'] = $this->activity_model->name_to_id($id_activity);
				$data['name_teacher'] = $this->datamodels->id_to_name($id_teacher);
				$data['img_teacher'] = $this->datamodels->id_to_img($id_teacher);
				$this->load->view('peer_correcting/my_correct', $data);

				$this->load->view('index/footer_div_menu_content');
				$this->load->view('index/footer_html');
			}
			else
				redirect();
	}


	public function valide_correct()
	{
		$mark = $this->input->post('mark');
		$feedback = $this->input->post('comment');
		$submit = $this->input->post('submit');
		$row = $this->correction_model->info_id($this->input->post('id'));
		$r_activity = $this->activity_model->info($row->id_activity);
		if ($submit != "save")
		{
			$this->form_validation->set_rules('mark','Mark','trim|required|numeric|xss_clean');
        	$this->form_validation->set_rules('comment','Comment','trim|required|xss_clean');
        }
        else
        {
        	$this->form_validation->set_rules('mark','Mark','trim|numeric|xss_clean');
        	$this->form_validation->set_rules('comment','Comment','trim|xss_clean');
    	}

        if ($this->form_validation->run())
        {
        	if ($submit != "save")
        			$this->correction_model->update_mark($row->id, $mark, nl2br($feedback), 1, 0);
        	else
        		$this->correction_model->update_mark($row->id, $mark, nl2br($feedback), 0, 1);
        	redirect();
        }
        else
        	$this->correct($row->id_activity, $row->id_teacher, $row->id_student);
	}



	public function log_view($data = array())
	{
		$data['pseudo'] = $this->session->userdata('pseudo');
		$data['img_profil'] = $this->session->userdata('img_profil');
		$this->load->view('user/profil_view', $data);
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
}
?>
