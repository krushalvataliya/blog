<?php 
require_once 'Action.php';

/**
 * 
 */
class Cetegory extends Action
{
	public function gridAction()
	{	
		require_once 'View/category/grid.phtml';
	}
	public function addAction()
	{	
		require_once 'View/category/add.phtml';
	}
	public function insertAction()
	{	
		$req = new Request();
		$category = $req->getPost('category');

		$sql = "INSERT INTO `category` (`category_id`, `title`, `category_image`, `status`) VALUES (NULL, '$category[title]', '', '$category[status]');";
		$adapter = new adapter();
		$insert=$adapter->insert($sql);	
		return $this->redirect();
	}
	
	
	public function blogdetailAction()
	{
		
	}
		
	public function deleteAction()
	{

	}
	public function errorAction($action)
	{
		throw new Exception("method:{$action} does not exists.", 1);
		
	}
	public function redirect($url = null )
	{
		if($url == null){
			$url = "http://localhost/blog/BlogListing.php?a=grid";
		}
		header("location: {$url}");
		exit();
	}
}

$action = $_GET['a'].'Action';
$Cetegory = new Cetegory();	
if(!method_exists($Cetegory, $action)){
	$Cetegory->errorAction($action);
}
$Cetegory->$action();

?>