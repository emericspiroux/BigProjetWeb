<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Configuration EMAIL
| -------------------------------------------------------------------------
*/



	$config = Array(
	    'protocol' => 'smtp',
	    'smtp_host' => 'ssl://smtp.googlemail.com',
	    'smtp_port' => 465,
	    'smtp_user' => 'emeric.spiroux@gmail.com',
	    'smtp_pass' => 'Larryeme25',
	    'mailtype'  => 'html',
	    'charset'   => 'iso-8859-1'
	);

	$config['crlf'] = '\r\n';
	$config['newline'] = '\r\n';
	$config['mailtype'] = 'html';

?>
