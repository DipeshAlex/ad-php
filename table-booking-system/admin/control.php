
<?php

include_once('model.php'); // step 1


class control extends model   // step 2
{
	function __construct()
	{
		
		session_start();
		
		model::__construct();   // step 3
		
		$url=$_SERVER['PATH_INFO']; //http://localhost/students/28Dec_PHP_2023/Project/website/control.php
		
		switch($url)
		{
			case '/login':
			
				if(isset($_REQUEST['submit']))
				{
					$email=$_REQUEST['email'];
					$normal_pass=$_REQUEST['pass'];
					$pass=md5($normal_pass);
					
					$where=array("email"=>$email,"pass"=>$pass);
					
					$res=$this->select_where('admins',$where);
					$ans=$res->num_rows;
					
					if($ans==1)
					{
						$fetch=$res->fetch_object();
						$_SESSION['aid']=$fetch->id;
						$_SESSION['aname']=$fetch->name;
						
						
						if(isset($_REQUEST['admin_rem']))
						{
							setcookie('admin_cemail',$email,time()+(365*24*60*60));
							setcookie('admin_cpass',$normal_pass,time()+(365*24*60*60));
						}
						
						echo "<script> 
						alert('Login Success');
						window.location='dashboard';
						</script>";
					}
					else
					{
						echo "<script> 
						alert('Login failed due to wrong creadential');
						window.location='admin-login';
						</script>";
					}	
				}
				include_once('index.php');
			break;
			
			case '/logout':
				
				unset($_SESSION['aid']);
				unset($_SESSION['aname']);
				echo "<script> 
						alert('Logout Success');
						window.location='admin-login';
						</script>";
			break;
			
			case '/index':
				include_once('index.php');
			break;
			
			case '/user':
				$arr_customers=$this->select('customers');
				include_once('user.php');
			break;
			case '/manage_table':
				$arr_contacts=$this->select('contacts');
				include_once('manage_table.php');
			break;
			
			case '/manage_contact':
				include_once('manage_contact.php');
			break;

			case '/booking':
				include_once('booking.php');
			break;

			case '/details':
				include_once('view-details.php');
			break;
			
		}
	}
}


$obj=new control;

?>