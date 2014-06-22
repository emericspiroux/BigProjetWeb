<?php

class user extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index($error_pass = false, $error_sub = false, $data = array())
	{
		if ($this->input->cookie('login', TRUE) && $error_pass == false && $this->input->cookie('passwd', TRUE))
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
				$this->session->set_userdata('pseudo', $row->pseudo);
				$this->session->set_userdata('mdp', $row->passwd);
				$this->session->set_userdata('id', $row->id);
				$this->session->set_userdata('email', $row->email);
				$this->session->set_userdata('root', $row->root);
				//log connection ldap
				$this->session->set_userdata('ldap_log', 'YOUR_ID');
				$this->session->set_userdata('ldap_pwd', 'YOUR_MDP');
				if (file_exists(APPPATH."../".$row->img_profil))
            	    $this->session->set_userdata('img_profil', $row->img_profil);
            	else
            	{
            	    //ldap connection at 42
            	        //$connect = $this->ldap_model->identify($this->session->userdata('ldap_log'), $this->session->userdata('ldap_pwd'), "ldap://ldap.42.fr", 389);
            	    //at home
            	        $connect = $this->ldap_model->identify($this->session->userdata('ldap_log'), $this->session->userdata('ldap_pwd'), "ldaps://ldap.42.fr", 636);
            	    //ldap profile info recuperacion
            	    $info = $this->ldap_model->profile($connect, $this->session->userdata('pseudo'));
            	    if (!$info)
            	        $this->session->set_userdata('img_profil', "asset/images/profil.jpg");
            	    else
            	    {
            	        $img = imagecreatefromstring(base64_decode(base64_encode($info[0]['picture'][0])));
            	        imagejpeg($img , APPPATH."../asset/images/".$info[0]['uid'][0]."-profil.jpg");
            	        $this->session->set_userdata('img_profil', "asset/images/".$info[0]['uid'][0]."-profil.jpg");
            	        $this->datamodels->change_img("asset/images/".$info[0]['uid'][0]."-profil.jpg", $this->session->userdata('id'));
            	    }
            	}
				$this->session->set_userdata('login', 1);
				header('Location: '.base_url()."user/profil");
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
			header('Location: '.base_url()."user/profil");
		}
		else
		{
			if($this->session->userdata('login'))
				redirect(base_url().'user/profil');
			$data['title'] = "WTF ?";
			if ($error_pass == true)
				$data['title'] = "WTF? <span style='color:red;'>Wrong Login or Password ! <span> <a href='' class='hidden-xs'>have you forgotten password ?</a></span></span>";
			else if ($error_sub == true)
				$data['title'] = "WTF? <span style='color:red;'>you're not registred!</span>";
			$data['error_pass'] = $error_pass;
			$this->load->view('index/header_html');
			$this->load->view('index/start_subscribe', $data);
			if ($error_sub == false || $error_pass == true)
				$this->load->view('presentation/presentation_en', $data);
			else
				$this->load->view('index/jumpcontent');
			$this->load->view('contact/contact_link');
			$this->load->view('index/subscribe', $data);
			$this->load->view('index/footer_html');
		}
	}

	public function connexion()
	{
		$pseudo = $this->input->post('login');
		$locate = $this->input->post('locate');

		$this->form_validation->set_rules('passwd','password','required|xss_clean|alpha_dash');
		$this->form_validation->set_rules('login','login','required|xss_clean');

		$mdp = hash('whirlpool',$this->input->post('passwd'));
		$data = array();
		if(!empty($pseudo) && !empty($mdp) && ($query = $this->datamodels->check_connect($pseudo, $mdp)) && $this->form_validation->run())
		{
			$row = $query->row();
			$this->root = $row->root;
			$data['pseudo'] = $row->pseudo;
			$this->session->set_userdata('pseudo', $data['pseudo']);
			$this->session->set_userdata('id', $row->id);
			$this->session->set_userdata('passwd', $mdp);
			$this->session->set_userdata('email', $row->email);
			$this->session->set_userdata('root', $row->root);
			//log connection ldap
			$this->session->set_userdata('ldap_log', 'espiroux');
			$this->session->set_userdata('ldap_pwd', 'Larryeme25');
 			if (file_exists(APPPATH."../".$row->img_profil))
                $this->session->set_userdata('img_profil', $row->img_profil);
            else
            {
                //ldap connection at 42
                    //$connect = $this->ldap_model->identify($this->session->userdata('ldap_log'), $this->session->userdata('ldap_pwd'), "ldap://ldap.42.fr", 389);
                //at home
                    $connect = $this->ldap_model->identify($this->session->userdata('ldap_log'), $this->session->userdata('ldap_pwd'), "ldaps://ldap.42.fr", 636);
                //ldap profile info recuperacion
                $info = $this->ldap_model->profile($connect, $this->session->userdata('pseudo'));
                if (!$info)
                    $this->session->set_userdata('img_profil', "asset/images/profil.jpg");
                else
                {
                	if (isset($info[0]['picture'][0]))
                	{
                    	$img = imagecreatefromstring(base64_decode(base64_encode($info[0]['picture'][0])));
                    	imagejpeg($img , APPPATH."../asset/images/".$info[0]['uid'][0]."-profil.jpg");
                    	$this->session->set_userdata('img_profil', "asset/images/".$info[0]['uid'][0]."-profil.jpg");
                    	$this->datamodels->change_img("asset/images/".$info[0]['uid'][0]."-profil.jpg", $this->session->userdata('id'));
                    }
                    else
                    {
                    	$this->session->set_userdata('img_profil', "asset/images/profil.jpg");
                    }
                }
            }
			$this->session->set_userdata('login', 1);


			//add cookies
         	if ($this->input->post('auto-login') == 1)
			{
				$this->session->set_userdata('autologin', 1);
				$cookie_login = array(
                   'name'   => 'login',
                   'value'  => $pseudo,
                   'expire' => '82000'
               	);

				$cookie_passwd = array(
                   'name'   => 'passwd',
                   'value'  => $mdp,
                   'expire' => '82000'
            	);
				$this->input->set_cookie($cookie_login);
				$this->input->set_cookie($cookie_passwd);
			}
			if (isset($locate))
				header('Location: '.$locate);
			else
				header('Location: '.base_url()."user/profil");
		}
		else
		{
			$data['error_form_login'] = $pseudo;
			$this->index(true, false, $data);
		}
	}

	function profil($data = array())
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


				//record ressources profil
				$data['peusdo'] = $this->session->userdata('pseudo');
				$data['email'] = $this->session->userdata('email');

				//ldap connection at 42
				//$connect = $this->ldap_model->identify($this->session->userdata('ldap_log'), $this->session->userdata('ldap_pwd'), "ldap://ldap.42.fr", 389);
				//at home
				$connect = $this->ldap_model->identify($this->session->userdata('ldap_log'), $this->session->userdata('ldap_pwd'), "ldaps://ldap.42.fr", 636);
				//ldap profile info recuperacion
				if (isset($connect))
				{
					$info = $this->ldap_model->profile($connect, $this->session->userdata('pseudo'));
					$data['info'] = $info;
				}
				else
				{
					$data['pseudo'] = $this->session->userdata('pseudo');
					$data['email'] = $this->session->userdata('email');
				}
				$this->load->view('user/mod_img_profil', $data);

				//peer correcting
				$data['id_user'] = $this->session->userdata('id');
				$data['tab_peer'] = $this->correction_model->list_peer_correcting($this->session->userdata('id'));
				$data['tab_user'] = $this->correction_model->list_user_correcting($this->session->userdata('id'));

				//peer correction groupe
				$data['tab_group_peer'] = $this->correction_model->list_group_peer_correcting($this->session->userdata('id'));
				$data['tab_group_user'] = $this->correction_model->list_group_user_correcting($this->session->userdata('id'));

				$this->load->view('user/peer_correcting', $data);

				//list_activity
				$data['tab_activity'] = $this->activity_model->list_profil_activity($this->session->userdata('id'));
				$this->load->view('user/activity_profil', $data);

				$this->load->view('index/footer_div_menu_content');
				$this->load->view('index/footer_html');
			}
			else
			{
				$this->index();
			}
	}

	function change_img()
	{
		if ($this->session->userdata('login'))
		{
				$config['upload_path'] = './asset/images';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '2000';
				$this->load->library('upload', $config);

			if ( !$this->upload->do_upload())
			{
				$data['error'] = $this->upload->display_errors('<div class="alert alert-error bg-danger" style="border:1px solid red;color:red;position:relative;bottom:3em;"><h5>-','</div></h5>');
				$this->profil($data);

			}
			else
			{
				$this->load->library('upload', $config);
				if ($this->session->userdata('img_profil') != "asset/images/profil.jpg")
						unlink(APPPATH.'../'.$this->session->userdata('img_profil'));
				$file = $this->upload->data();
				$link = "asset/images/".$file['file_name'];
				$this->session->set_userdata('img_profil', $link);
				$this->datamodels->change_img($link, $this->session->userdata('id'));
				$this->profil();
			}
		}
		else
			$this->index();
	}

	function subscribe()
	{
		$data = array();
		$pseudo = $this->input->post('pseudo');
		$email = $this->input->post('email');
		$mdp = $this->input->post('passwd');
		$mdp2 = $this->input->post('passwd_conf');

		$this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|is_unique[user.email]');
        $this->form_validation->set_rules('passwd','password','trim|required|min_length[6]|xss_clean');
        $this->form_validation->set_rules('passwd_conf','password confirmation','trim|required|min_length[6]|matches[passwd]|xss_clean');
        $this->form_validation->set_rules('pseudo','login','trim|required|xss_clean|is_unique[user.pseudo]');

		if (!$this->form_validation->run() || isset($data['error_pseudo']))
		{
			$data['error_form_pseudo'] = $this->input->post('pseudo');
			$data['error_form_email'] = $this->input->post('email');
			$this->index(false, true, $data);
		}
		else
		{
			if ($this->datamodels->add_user($pseudo, hash('whirlpool', $mdp), $email, 0))
				$data['title'] = "WTF, Welcome to WTF !";
			else
				$data['title'] = "WTF, we have some problems with DB";

			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from('emeric.spiroux@gmail.com', 'WTForum');
			$this->email->to($email);
			$this->email->subject('Wtforum confirmation');
			$this->email->message('<h1> WTF, have you subscribe ?</h1>');
			if ($this->email->send())
				echo "<h1>error during send email</h1>";

			$this->view_confirmation($email, $pseudo, $data);
		}
	}

	function view_confirmation($email = " ", $pseudo = " ", $data = false)
	{
		if (!is_array($data))
		{
			$data['title'] = "wtfucking test ?";
		}
		$data['email'] = $email;
		$data['pseudo'] = $pseudo;
		$this->load->view('index/header_html');
		$this->session->userdata('login');
		$this->load->view('index/start', $data);
		$this->load->view('index/jumpcontent');
		$this->load->view('index/confirm_subscribe', $data);
		$this->load->view('contact/contact_link');
		$this->load->view('index/footer_html');
	}

	function resend_confirm($email_user, $pseudo)
	{
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('emeric.spiroux@gmail.com', 'WTForum');
		$this->email->to($email_user);
		$this->email->subject('Wtforum confirmation');
		$this->email->message('<h1> WTF, have you subscribe ?</h1>');
		if ($this->email->send())
			echo "<h1>error during send email</h1>";
		$data = array('email'=>$email_user,'pseudo'=>$pseudo);
		$this->load->view('index/confirm_subscribe', $data);
	}

	function change_password()
	{
		$pass_old = $this->input->post('password_old');
		$pass_new = $this->input->post('password_new');

		$this->form_validation->set_rules('password_old','Old Password','trim|required');
		$this->form_validation->set_rules('password_new','New Password','trim|required|min_length[6]');
        $this->form_validation->set_rules('password_new_conf','password confirmation','trim|required | matches[password_new]');

        if ($this->form_validation->run())
        {
        	if ($this->datamodels->match_old_password($this->session->userdata('id'), hash('whirlpool', $pass_old)))
        		$this->datamodels->change_password($this->session->userdata('id'), hash('whirlpool', $pass_new));
        	else
        		$this->form_validation->set_message('password_old', 'Wrong old password.');
        }
        	$this->profil();
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

	public function logout()
	{
		delete_cookie('login');
		delete_cookie('passwd');
		$this->session->sess_destroy();
		redirect();
	}

}

?>
