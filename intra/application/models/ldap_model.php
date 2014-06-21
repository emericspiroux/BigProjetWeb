<?php

class ldap_model extends CI_Model
{
	function __construct()
	{
		 parent::__construct();
 	}

	function bind($connect, $dc, $passwd)
	{
		$ldapbind = ldap_bind($connect, $dc, $passwd);
		return ($ldapbind);
	}

	function identify($login, $passwd, $host, $port)
	{
		$connect = ldap_connect($host, $port);
		if ($connect)
		{
			ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
			$dc = 'uid='.$login.',ou=2013,ou=people,dc=42,dc=fr';
			if ($this->bind($connect, $dc, $passwd))
				return ($connect);
			else
				return (NULL);
		}
		return (NULL);
	}

	function profile($connect, $login)
	{
		if (isset($connect) && $connect !== NULL)
		{
			$dn = "dc=42,dc=fr";
			$filter = "(&(uid=".$login."))";
			$search = ldap_search($connect, $dn, $filter, ['birth-date', 'uid', 'mobile-phone', 'first-name', 'last-name', 'picture']);
			if ($search)
			{
				$info = ldap_get_entries($connect, $search);
				return ($info);
			}
			else
				return (NULL);
		}
		return (NULL);
	}

	function search($connect, $login)
	{

		if (isset($connect) && $connect !== NULL)
		{
			$dn = "dc=42,dc=fr";
			$filter = "(&(uid=".$login."*)(gidnumber=4207)(!(close=non admis)))";
			$search = ldap_search($connect, $dn, $filter, ['birth-date', 'uid', 'mobile-phone', 'first-name', 'last-name', 'picture']);
			if ($search)
			{
				$info = ldap_get_entries($connect, $search);
				return ($info);
			}
			else
				return (NULL);
		}
		return (NULL);
	}

	//unbind user if you wanna connect with another guy
	function unbind($connect)
	{
		return (ldap_unbind($connect));
	}
}
?>
