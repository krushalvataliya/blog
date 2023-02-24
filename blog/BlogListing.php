<?php 
require_once 'Action.php';

/**
 * 
 */
class BlogListing extends Action
{
	public function gridAction()
	{	
		require_once 'View/blog_listing/grid.phtml';
	}
	
	
	public function blogdetailAction()
	{
		require_once 'View/blog_listing/blog_detail.phtml';
	}
		
	public function deleteAction()
	{
		$req = new Request();
		$id = $req->getParams('blog_id');
		$sql =  "DELETE FROM blogs WHERE `blogs`.`blog_id` = $id";
		$adapter = new adapter();
		$results =$adapter->delete($sql);
		$this->redirect("http://localhost/blog/BlogListing.php?a=grid");

	}
	public function errorAction($action)
	{
		throw new Exception("method:{$action} does not exists.", 1);
		
	}
	public function redirect($url )
	{
		if($url == null){
			$url = "http://localhost/blog/BlogListing.php?a=grid";
		}
		header("location: {$url}");
		exit();
	}
}

$action = $_GET['a'].'Action';
$BlogListing = new BlogListing();	
if(!method_exists($BlogListing, $action)){
	$BlogListing->errorAction($action);
}
$BlogListing->$action();

?>