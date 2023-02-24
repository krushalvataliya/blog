<?php 
require_once 'Action.php';

/**
 * 
 */
class Login extends Action
{
	public function gridAction()
	{	
		// $a = "1234";
		// echo md5($a);
		require_once 'View/login/grid.phtml';
	}
	public function registerAction()
	{
		require_once 'View/register/add.phtml';
	}
	
	public function velidateAction()
	{
		session_start();
		$req = new Request();
		$email = $req->getPost("email");
		$_SESSION['email']=$email;
		$password = $req->getPost("password");
		$_SESSION['email']=$email;
		$sql = "SELECT * FROM `user`";
		$adapter = new adapter();
		$result = $adapter->fetchAll($sql);
		foreach ($result as $user):

			if($email == $user['email'] && md5($password) == $user['password'])
			{
				return $this->redirect("http://localhost/blog/BlogListing.php?a=grid");
			}
			continue;
				return $this->loginErrorAction();

		endforeach;
	}
	public function loginErrorAction()
	{
		echo "invalid email or password";
	}
	public function updateAction()
	{
		
	}
	public function errorAction($action)
	{
		throw new Exception("method:{$action} does not exists.", 1);
		
	}
	public function redirect($url)
	{
		if($url == null){
			$url = "http://localhost/blog/Login.php?a=grid";
		}
		header("location: {$url}");
		exit();
	}
}

$action = $_GET['a'].'Action';
$Login = new Login();
if(!method_exists($Login, $action)){
	$Login->errorAction($action);
}
$Login->$action();

?>