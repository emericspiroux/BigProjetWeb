(exemple_content.php)<br>
<br>
<p>j'utilise le header_div_menu_content voir la methode profil dans le controller User<br>
<br>
function profil()<br>
	{<br>
		$data = array();<br>
			if ($this->session->userdata("login"))<br>
			{<br>
				$data['title'] = "What's This Face ?";<br>
				$this->load->view('index/header_html');<br>
				$this->loggin($data);<br>
				$this->load->view('index/menu', $data);<br>
				$this->load->view('index/header_div_menu_content');<br>
				$this->load->view('exemple_content');<br>
				//votre contenu... ($this->load->view('profil/index');)<br>
				$this->load->view('index/footer_div_menu_content');<br>
				$this->load->view('index/footer_html');<br>
			}<br>
			else<br>
			{<br>
				$this->index();<br>
			}<br>
	}<br>
</p>
