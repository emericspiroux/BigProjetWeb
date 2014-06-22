<?php
class activity extends CI_Controller
{

	private $debut = '#Les lignes suivantes sont gerees automatiquement via un script PHP. - Merci de ne pas editer manuellement';
	private $fin = '#Les lignes suivantes ne sont plus gerees automatiquement';

	public function __construct()
	{
		parent::__construct();
	}

	public function index($module_name = "")
	{
		$this->auto_login();

		$id_mod = $this->module_model->id_to_name($module_name);
		if ($this->module_model->check_register($this->session->userdata('id'), $id_mod))
			$data['register'] = 1;
		$data['login'] = 1;
		$data['title'] = "WTF ?";
		$data['pseudo'] = $this->session->userdata('pseudo');
		if ($this->session->userdata('root'))
			$data['root'] = 1;
		$data['activity_name'] = $module_name;
		$this->load->view('index/header_html');
		$data['img_profil'] = $this->session->userdata('img_profil');
		$this->load->view('user/profil_view', $data);
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');
		$data['id_mod'] = $id_mod;
		$data['tab_activity'] = $this->activity_model->list_activity($id_mod, $this->session->userdata('id'));
		$this->load->view('activity/tab_activity', $data);
		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function add_validation()
	{
		$data = array();
		$name = $this->input->post('name');
		$des = $this->input->post('description');
		$date_reg = $this->input->post('date_reg');
		$date_beg = $this->input->post('date_beg');
		$date_peer = $this->input->post('date_peer');
		$date_end = $this->input->post('date_end');
		$activity_name = $this->input->post('activity_name');
		$id_mod = $this->input->post('id_mod');
		$places = $this->input->post('places');
		$groupe = $this->input->post('groupe');
		$type = $this->input->post('type');
		$nb_groupe = $this->input->post('nb_groupe');
		$nb_peer = $this->input->post('nb_peer');

		$this->form_validation->set_rules('places','number of places','trim|required|numeric');
		$name = str_replace(' ', '_', $name);
		$des = str_replace("\n", '<br>', $des);
		if ($groupe != 0)
			$this->form_validation->set_rules('nb_groupe','number of group member','trim|required|numeric');
		else
			$nb_groupe = 0;
		$this->form_validation->set_rules('name','Name','trim|required|is_unique[activity.name]');
		$this->form_validation->set_rules('description','Description','trim|required');
		$this->form_validation->set_rules('places','number of places','trim|required|numeric');
		$this->form_validation->set_rules('date_reg','Date of regiter','trim|required');
		$this->form_validation->set_rules('date_beg','Date of the begin','trim|required');
		$this->form_validation->set_rules('date_peer','Date of the peer-correcting','trim|required');
		$this->form_validation->set_rules('date_end','Date of the end','trim|required');

		if ($this->form_validation->run())
		{
			//add bdd
			$id_activity = $this->activity_model->add($name, $des, $date_reg, $date_beg, $date_peer, $date_end, $id_mod, $places, $groupe, $nb_groupe, $type, $nb_peer);//todo

			//cut date for cron tab
			//date reg
			$date = explode('T', $date_beg);
			$resultat_date = explode('-', $date[0]);
			$mois_reg = $resultat_date[1];
			$day_reg = $resultat_date[2];
			$resultat_heure = explode(':', $date[1]);
			$min_reg = $resultat_heure[1];
			$heure_reg = $resultat_heure[0];

			//date peer
			$date = explode('T', $date_peer);
			$resultat_date = explode('-', $date[0]);
			$mois_peer = $resultat_date[1];
			$day_peer = $resultat_date[2];
			$resultat_heure = explode(':', $date[1]);
			$min_peer = $resultat_heure[1];
			$heure_peer = $resultat_heure[0];

			//date end
			$date = explode('T', $date_end);
			$resultat_date = explode('-', $date[0]);
			$mois_end = $resultat_date[1];
			$day_end = $resultat_date[2];
			$resultat_heure = explode(':', $date[1]);
			$min_end = $resultat_heure[1];
			$heure_end = $resultat_heure[0];

			//add cron tab
			if ($groupe == 1)
			{
				$id_cron_groupe = $this->addScriptCron($heure_reg, $min_reg, $day_reg, "*", $mois_reg, "open ".base_url()."peer/launch_group/".$id_activity, "group script for ".$name." activity.");
			}
			if ($groupe == 1 || $groupe == 2)
				$id_cron_peer = $this->addScriptCron($heure_peer, $min_peer, $day_peer, "*", $mois_peer, "open ".base_url()."peer/launch_group_peer/".$id_activity, "peer groupe script for ".$name." activity.");
			else
				$id_cron_peer = $this->addScriptCron($heure_peer, $min_peer, $day_peer, "*", $mois_peer, "open ".base_url()."peer/launch_peer/".$id_activity, "peer script for ".$name." activity.");
			$id_cron_mark = $this->addScriptCron($heure_end, $min_end, $day_end, "*", $mois_end, "open ".base_url()."peer/launch_mark_activity/".$id_activity, "end script for ".$name." activity.");
			$this->activity_model->update_cron($id_activity, $id_cron_peer, $id_cron_groupe, $id_cron_mark);
			redirect(base_url()."activity/index/".$activity_name);
		}
		else
		{
			$data['error_form_name'] = $this->input->post('name');
			$data['error_form_des'] = $this->input->post('description');
			$data['error_form_date_reg'] = $this->input->post('date_reg');
			$data['error_form_date_beg'] = $this->input->post('date_beg');
			$data['error_form_date_peer'] = $this->input->post('date_peer');
			$data['error_form_date_end'] = $this->input->post('date_end');
			$data['error_form_activity_name'] = $this->input->post('activity_name');
			$data['error_form_places'] = $this->input->post('places');
			$data['error_form_type'] = $this->input->post('type');
			$data['error_form_nb_groupe'] = $this->input->post('nb_groupe');
			$data['error_form_nb_peer'] = $this->input->post('nb_peer');
			$this->add($activity_name, $id_mod, $data);
		}
	}

	public function add($activity_name = "", $id_mod = "", $data = array())
	{
		$data['activity_name'] = $activity_name;
		$data['id_mod'] = $id_mod;
		if (empty($activity_name) || empty($id_mod))
		{
			redirect(base_url()."module");
		}
		if (!$this->session->userdata('root'))
		{
			redirect(base_url()."user");
		}
		$data['root'] = 1;
		$this->load->view('index/header_html');
		$this->loggin($data);
		$data['login'] = 1;
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		$data['tab_activity'] = $this->activity_model->list_activity($id_mod, $this->session->userdata('id'));
		$data['add'] = 1;
		$this->load->view('activity/tab_activity', $data);

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function modify($name_activity, $id_mod, $id_activity, $data = array())
	{
		if (empty($name_activity) || empty($id_mod))
			redirect(base_url()."module");
		$data = array();
		if (!$this->session->userdata('root'))
			redirect(base_url()."module");
		$data['root'] = 1;
		$this->load->view('index/header_html');
		$this->loggin($data);
		$data['login'] = 1;
		$data['activity_name'] = $name_activity;
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		$data['id_mod'] = $id_mod;
		$data['tab_activity'] = $this->activity_model->list_activity($id_mod, $this->session->userdata('id'));
		$data['id'] = $id_activity;
		$this->load->view('activity/tab_activity', $data);

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function modify_validation()
	{
		$data = array();
		$name = $this->input->post('name');
		$des = $this->input->post('description');
		$date_reg = $this->input->post('date_reg');
		$date_beg = $this->input->post('date_beg');
		$date_peer = $this->input->post('date_peer');
		$date_end = $this->input->post('date_end');
		$activity_name = $this->input->post('activity_name');
		$id_mod = $this->input->post('id_mod');
		$id_activity = $this->input->post('id_activity');
		$places = $this->input->post('places');
		$type = $this->input->post('type');
		$groupe = $this->input->post('groupe');
		$nb_peer = $this->input->post('nb_peer');

		$this->form_validation->set_rules('places','number of places','trim|required|numeric|xss_clean');
		$this->form_validation->set_rules('name','Name','trim|required|xss_clean');
		$this->form_validation->set_rules('description','Description','trim|required|xss_clean');
		$this->form_validation->set_rules('date_reg','Date of registering','trim|required|xss_clean');
		$this->form_validation->set_rules('date_beg','Date of the begin','trim|required|xss_clean');
		$this->form_validation->set_rules('date_peer','Date of the peer-correcting','trim|required|xss_clean');
		$this->form_validation->set_rules('date_end','Date of the end','trim|required|xss_clean');
		$name = str_replace(' ', '_', $name);
		$des = str_replace("\n", '<br>', $des);
		if ($this->form_validation->run())
		{
			$this->activity_model->update($id_activity, $name, $des, $date_reg, $date_beg, $date_peer, $date_end, $id_mod, $places, $type, $nb_peer);

			// delete last cron tab
			$row = $this->activity_model->info($id_activity);
			$id_cron_peer = $row->id_cron_peer;
			$id_cron_groupe = $row->id_cron_groupe;
			$id_cron_mark =  $row->id_cron_mark;

			$this->deleteScriptCron($id_cron_peer);
			$this->deleteScriptCron($id_cron_groupe);
			$this->deleteScriptCron($id_cron_mark);

			//cut date for cron tab
			//date reg
			$date = explode('T', $date_beg);
			$resultat_date = explode('-', $date[0]);
			$mois_reg = $resultat_date[1];
			$day_reg = $resultat_date[2];
			$resultat_heure = explode(':', $date[1]);
			$min_reg = $resultat_heure[1];
			$heure_reg = $resultat_heure[0];

			//date peer
			$date = explode('T', $date_peer);
			$resultat_date = explode('-', $date[0]);
			$mois_peer = $resultat_date[1];
			$day_peer = $resultat_date[2];
			$resultat_heure = explode(':', $date[1]);
			$min_peer = $resultat_heure[1];
			$heure_peer = $resultat_heure[0];

			//date end
			$date = explode('T', $date_end);
			$resultat_date = explode('-', $date[0]);
			$mois_end = $resultat_date[1];
			$day_end = $resultat_date[2];
			$resultat_heure = explode(':', $date[1]);
			$min_end = $resultat_heure[1];
			$heure_end = $resultat_heure[0];

			//add cron tab
			if ($groupe == 1)
			{
				$id_cron_groupe = $this->addScriptCron($heure_reg, $min_reg, $day_reg, "*", $mois_reg, "open ".base_url()."peer/launch_group/".$id_activity, "group script for ".$name." activity.");
			}
			if ($groupe == 1 || $groupe == 2)
				$id_cron_peer = $this->addScriptCron($heure_peer, $min_peer, $day_peer, "*", $mois_peer, "open ".base_url()."peer/launch_group_peer/".$id_activity, "peer groupe script for ".$name." activity.");
			else
				$id_cron_peer = $this->addScriptCron($heure_peer, $min_peer, $day_peer, "*", $mois_peer, "open ".base_url()."peer/launch_peer/".$id_activity, "peer script for ".$name." activity.");
			$id_cron_mark = $this->addScriptCron($heure_end, $min_end, $day_end, "*", $mois_end, "open ".base_url()."peer/launch_mark_activity/".$id_activity, "end script for ".$name." activity.");
			$this->activity_model->update_cron($id_activity, $id_cron_peer, $id_cron_groupe, $id_cron_mark);
			redirect(base_url()."activity/index/".$activity_name);
		}
		else
		{
			$data['name'] = $this->input->post('name');
			$data['des'] = $this->input->post('description');
			$data['date_reg'] = $this->input->post('date_reg');
			$data['date_beg'] = $this->input->post('date_beg');
			$data['date_peer'] = $this->input->post('date_peer');
			$data['date_end'] = $this->input->post('date_end');
			$data['activity_name'] = $this->input->post('activity_name');
			$data['id_mod'] = $this->input->post('id');
			$data['id_activity'] = $this->input->post('id_activity');
			$data['places'] = $this->input->post('places');
			$data['type'] = $this->input->post('type');
			$data['groupe'] = $this->input->post('groupe');
			$data['nb_peer'] = $this->input->post('nb_peer');
			$this->modify($activity_name, $id_mod, $id_activity, $data);
		}
	}

	public function show($module_name = "", $id_activity = "")
	{
		$this->auto_login();
		if (empty($module_name))
			redirect(base_url()."module");
		if (empty($id_activity))
			redirect(base_url()."activity/".$module_name);

		$id_mod = $this->module_model->id_to_name($module_name);
		$activity_name = $this->activity_model->name_to_id($id_activity);

		$data['login'] = 1;
		$data['title'] = "WTF ?";
		$data['pseudo'] = $this->session->userdata('pseudo');
		if ($this->session->userdata('root'))
			$data['root'] = 1;

		$data['activity_name'] = $module_name;
		$data['menu_activity_name'] = $activity_name;
		$this->load->view('index/header_html');
		$this->loggin($data);
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		//check register of activity
		if ($this->activity_model->check_register($this->session->userdata('id'), $id_activity))
			$data['register'] = 1;

		//details activity
		$data['activity_info'] = $this->activity_model->info($id_activity);
		$data['tab_object'] = $this->activity_model->list_object($id_activity);
		$this->load->view('activity/activity_view', $data);

		//details groupe
		if (isset($data['register']))
		{
			$data['tab_groupe'] = $this->activity_model->list_groupe($id_activity);
			$this->load->view('activity/show_groupe', $data);
		}

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function add_object($module_name = "", $activity_name = "", $data = array())
	{
		$this->auto_login();

		if (empty($module_name))
			redirect(base_url()."module");
		if (empty($activity_name))
			redirect(base_url()."activity/".$module_name);

		$id_mod = $this->module_model->id_to_name($module_name);

		$data['login'] = 1;
		$data['title'] = "WTF ?";
		$data['pseudo'] = $this->session->userdata('pseudo');
		if ($this->session->userdata('root'))
			$data['root'] = 1;

		$data['activity_name'] = $module_name;
		$data['menu_activity_name'] = $activity_name;
		$this->load->view('index/header_html');
		$this->loggin($data);
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		$id_act = $this->activity_model->id_to_name($activity_name);
		$data['id_act'] = $id_act;
		$data['activity_info'] = $this->activity_model->info($id_act);
		$data['tab_object'] = $this->activity_model->list_object($id_act);
		$data['add_object'] = 1;
		$this->load->view('activity/activity_view', $data);

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function add_object_valid($module_name = "", $activity_name = "")
	{
		$config['upload_path'] = './asset/subject';
		$config['allowed_types'] = 'gif|jpg|png|zip|pdf';
		$config['max_size']	= '10000';
		$this->load->library('upload', $config);

		$id_activity = $this->activity_model->id_to_name($activity_name);

		if ( ! $this->upload->do_upload())
		{
			$data['error'] = $this->upload->display_errors('<div class="alert alert-error bg-danger" style="border:1px solid red;color:red;"><h5>-','</div></h5>');
			$this->add_object($module_name, $activity_name, $data);
		}
		else
		{
			$file = $this->upload->data();
			$link = "asset/subject/".$file['file_name'];
			$this->activity_model->add_object($id_activity, $file['file_name'], $link);
			$this->show($module_name, $id_activity);
		}
	}

	public function register($name_module = "", $id_activity = 0)
	{
		if ($this->session->userdata('login') &&  $id_activity != 0)
		{
			$places = $this->activity_model->catch_places($id_activity);
			if ($places > 0)
			{
				$this->activity_model->register($this->session->userdata('id'), $id_activity);
				$this->activity_model->update_place($id_activity, $places - 1);
			}
			$this->index($name_module);
		}
		else
			$this->index($name_module);
	}

	public function unregister($name_module = "", $id_activity = 0)
	{
		if ($this->session->userdata('login') &&  $id_activity != 0)
		{
			$places = $this->activity_model->catch_places($id_activity);
			if ($places >= 0)
			{
				$this->activity_model->unregister($this->session->userdata('id'), $id_activity);
				$this->activity_model->update_place($id_activity, $places + 1);
			}
			$this->index($name_module);
		}
		else
			$this->index($name_module);
	}

	public function delete($name_activity, $id_mod, $id_activity)
	{
		if (empty($name_activity) || empty($id_mod))
			redirect(base_url()."module");
		if ($this->session->userdata('root'))
		{
			// delete last cron tab
			$row = $this->activity_model->info($id_activity);
			$id_cron_peer = $row->id_cron_peer;
			$id_cron_groupe = $row->id_cron_groupe;
			$id_cron_mark =  $row->id_cron_mark;

			$this->deleteScriptCron($id_cron_peer);
			$this->deleteScriptCron($id_cron_groupe);
			$this->deleteScriptCron($id_cron_mark);
			$this->activity_model->remove($id_activity);
		}
		redirect(base_url()."activity/index/".$name_activity);
	}

	public function delete_file($name_module, $name_activity, $id_file)
	{
		if (empty($name_activity) || empty($name_module))
			redirect(base_url()."module");
		if ($this->session->userdata('root'))
		{
			$path = $this->activity_model->id_to_path($id_file);
			$this->activity_model->remove_file($id_file);
			unlink(APPPATH.'../'.$path);
		}
		$id_act = $this->activity_model->id_to_name($name_activity);
		$this->show($name_module, $id_act);
	}

	public function auto_login()
	{
		if ($this->input->cookie('login', TRUE) && $this->input->cookie('passwd', TRUE))
		{
			$pseudo = $this->input->cookie('login');
			$mdp = $this->input->cookie('passwd');
			if (!($query = $this->datamodels->check_connect($pseudo, $mdp)))
				echo "error cookies, delete them and try again.";
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
						$img = imagecreatefromstring(base64_decode(base64_encode($info[0]['picture'][0])));
						imagejpeg($img , APPPATH."../asset/images/".$info[0]['uid'][0]."-profil.jpg");
						$this->session->set_userdata('img_profil', "asset/images/".$info[0]['uid'][0]."-profil.jpg");
						$this->datamodels->change_img("asset/images/".$info[0]['uid'][0]."-profil.jpg", $this->session->userdata('id'));
					}
				}
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
			redirect(base_url()."user");
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

	private function addScriptCron($chpHeure, $chpMinute, $chpJourMois, $chpJourSemaine, $chpMois, $chpCommande, $chpCommentaire)
	{
			$oldCrontab = Array();                          /* pour chaque cellule une ligne du crontab actuel */
			$newCrontab = Array();                          /* pour chaque cellule une ligne du nouveau crontab */
			$isSection = false;
			$maxNb = 0;                                     /* le plus grand numéro de script trouvé */
			exec('crontab -l', $oldCrontab, $error);
			if (is_array($oldCrontab))
			{
				 foreach($oldCrontab as $ligne)        /* copie $oldCrontab dans $newCrontab et ajoute le nouveau script */
				 {
						 if ($isSection == true)                 /* on est dans la section gérée automatiquement */
						 {
								 $motsLigne = explode(' ', $ligne);
								 if ($motsLigne[0] == '#' && $motsLigne[1] > $maxNb)     /* si on trouve un numéro plus grand */
									 $maxNb = $motsLigne[1];
						 }
						 if ($ligne == $this->debut) { $isSection = true; }
						  if ($ligne == $this->fin)                      /*on est arrivé à la fin, on rajoute le nouveau script*/
						 {
								 $id = $maxNb + 1;
								 $newCrontab[] = '# '.$id.' : '.$chpCommentaire;
								 $newCrontab[] = $chpMinute.' '.$chpHeure.' '.$chpJourMois.' '.
										$chpMois.' '.$chpJourSemaine.' '.$chpCommande;
						 }
						 $newCrontab[] = $ligne;                 /* copie $oldCrontab, ligne après ligne */
				 }
			}
			if ($isSection == false)                        /* s'il n'y a pas de section gérée par le script */
			{                                               /*  on l'ajoute maintenant */
					$id = 1;
					$newCrontab[] = $this->debut;
					$newCrontab[] = '# 1 : '.$chpCommentaire;
					$newCrontab[] = $chpMinute.' '.$chpHeure.' '.$chpJourMois.' '.$chpMois.' '.$chpJourSemaine.' '.$chpCommande;
					$newCrontab[] = $this->fin;
			}
			/* on crée le fichier temporaire */
			write_file(APPPATH.'../asset/cron', implode("\n", $newCrontab), 'w+');
			exec('crontab '.APPPATH.'../asset/cron', $errorlog, $error);                           /* on le soumet comme crontab */
			return  $id;
	}

	private function deleteScriptCron($id = 0)
	{
		   $oldCrontab = Array();                          /* pour chaque cellule une ligne du crontab actuel */
		   $newCrontab = Array();                          /* pour chaque cellule une ligne du nouveau crontab */
		   $save_line = 0;
		   $isSection = false;

		   exec('crontab -l', $oldCrontab, $error);                /* on récupère l'ancienne crontab dans $oldCrontab */
		    foreach($oldCrontab as $ligne)                  /* copie $oldCrontab dans $newCrontab sans le script à effacer */
       		{
               if ($isSection == true)                 /* on est dans la section gérée automatiquement */
               {
                       $motsLigne = explode(' ', $ligne);
                       if ($motsLigne[0] != '#' || $motsLigne[1] != $id)       /* ce n est pas le script à effacer */
                       {
                                       $newCrontab[] = $ligne;                 /* copie $oldCrontab, ligne après ligne */
                       }
               }else{
                       $newCrontab[] = $ligne;         /* copie $oldCrontab, ligne après ligne */
               }

               if ($ligne == $debut) { $isSection = true; }
       		}

		   $newCrontab[] = $this->fin;
		   write_file(APPPATH.'../asset/cron', implode("\n", $newCrontab), 'w+');
		   exec('crontab '.APPPATH.'../asset/cron', $errorlog, $error);                   /* on le soumet comme crontab */
		   return  $id;
	}

	public function register_group($id_mod, $activity_name, $id_activity2, $size, $data2 = array())
	{
		$this->auto_login();

		$data['login'] = 1;
		$data['title'] = "WTF ?";
		$data['pseudo'] = $this->session->userdata('pseudo');
		if ($this->session->userdata('root'))
			$data['root'] = 1;
		$data['activity_name'] = $activity_name;
		$this->load->view('index/header_html', $size);
		$data['img_profil'] = $this->session->userdata('img_profil');
		$this->load->view('user/profil_view', $data);
		$this->load->view('index/menu', $data);
		$this->load->view('index/header_div_menu_content');

		$data2 = array(
			'users'			=> $this->activity_model->get_user_no_group($id_mod),
			'my_id'			=> $this->session->userdata('id'),
			'size_groupe'	=> $size,
			'id_activity'	=> $id_activity2,
			'id_mod'		=> $id_mod
			);
		$this->load->view('activity/register_group', $data2);

		$this->load->view('index/footer_div_menu_content');
		$this->load->view('index/footer_html');
	}

	public function manual_group()
	{
		$name_group = $this->input->post('name_group');
		$id_activity = $this->input->post('id_activity');
		$my_id = $this->input->post('user_chief');
		$id_mod = $this->input->post('id_mod');

		//verification of unique id in group
		$i = 0;
		$groupe_user = $this->input->post();
		while ($i < $this->input->post('size_groupe') - 2)
		{
			if ($groupe_user['user_'.$i] = $groupe_user['user_'.($i + 1)])
			{
				$data['error_group'] = 1;
				$data['name_group'] = $name_group;
				$activity_name = $this->activity_model->name_to_id($id_activity);
				$this->register_group($id_mod, $activity_name, $id_activity, $this->input->post('size_groupe'), $data);
			}
			$i = $i + 1;
		}

		$this->form_validation->set_rules('name_group','Name of group','trim|required|is_unique[groupe.name]|xss_clean');

		if ($this->form_validation->run())
		{
			$module_name = $this->module_model->name_to_id($id_mod);
			$i = 0;
			$groupe_user = $this->input->post();
			while ($i < $this->input->post('size_groupe') - 1)
			{
				$user[] = $groupe_user['user_'.$i];
				$i = $i + 1;
			}
			$places = $this->activity_model->catch_places($id_activity);
			//add groupe
			$id_groupe = $this->activity_model->add_groupe($name_group, $id_activity);
			foreach ($user as $id_user)
			{
				$this->activity_model->add_user_to_inscrit_groupe($id_groupe, $id_activity, $id_user);
			}
			$this->activity_model->add_user_to_inscrit_groupe($id_groupe, $id_activity, $my_id);
			$this->activity_model->update_place($id_activity, $places - 1);
			$this->show($module_name, $id_activity);
		}
		else
		{
			$data['name_group'] = $name_group;
			$activity_name = $this->activity_model->name_to_id($id_activity);
			$this->register_group($id_mod, $activity_name, $id_activity, $this->input->post('size_groupe'), $data);
		}
	}

}
?>
