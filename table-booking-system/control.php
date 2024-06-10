
<?php

include_once('../admin/model.php'); // step 1

class control extends model   // step 2
{
	function __construct()
	{
		session_start();
		
		model::__construct();   // step 3
		
		date_default_timezone_set("asia/calcutta");
		
		$url=$_SERVER['PATH_INFO']; //http://localhost/students/28Dec_PHP_2023/Project/website/control.php
		
		switch($url)
		{
			// case '/':
			// 	include_once('index.php');
			// break;
			case '/index':
				include_once('index.php');
			break;
			case '/connection':
				
				include_once('connection.php');
			break;

			case '/contact':
				include_once('contact.php');
			break;

			case '/about':
				include_once('about.php');
			break;
			
			case '/detail':
				include_once('status-detail.php');
			break;
			
		}
	}
}


$obj=new control;

?>