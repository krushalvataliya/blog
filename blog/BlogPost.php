<?php 
require_once 'Action.php';

/**
 * 
 */
class BlogPosting extends Action
{
	public function addAction()
	{	
		require_once 'View/blog_post/add.phtml';
	}
	public function insertAction()
	{	
		$req = new Request();
		$blog = $req->getPost('blog');
		print_r($blog);
		// die();

		$target_dir = "View/blog_post/blogimg/";
		$file = basename($_FILES["blogimg"]["name"]);
		$fileArray = explode('.', $file);
		$targetName=(new \DateTime())->format('dHis').'i.'.$fileArray[1];
		$target_file = $target_dir.$targetName;
		print_r($target_file);
		move_uploaded_file($_FILES["blogimg"]["tmp_name"], $target_file);
		$adapter = new adapter();
		$sql = "INSERT INTO `blogs` (`title`, `short_description`, `image`, `description`, `status`) VALUES ('$blog[title]', '$blog[short_description]','$targetName', '$blog[description]','$blog[status]');";

		$insert=$adapter->insert($sql);
		echo $insert;
		return $this->redirect("http://localhost/blog/BlogListing.php?a=grid");

	}
		
	public function updateAction()
	{
		$req = new Request();
		$blog = $req->getPost('blog');
		print_r($blog);
		$adapter = new adapter();
		$sql =" UPDATE `blogs` SET `title` = '$blog[title]', `short_description` = '$blog[short_description]', `description` = '$blog[description]', `status` = '$blog[status]' WHERE `blogs`.`blog_id` = $blog[blog_id];";
		$update=$adapter->update($sql);
		return $this->redirect("http://localhost/blog/BlogListing.php?a=blogdetail&blog_id=$blog[blog_id]");

		echo $insert;
		
	}
	public function deleteAction()
	{
	}
	public function editAction()
	{	
		require_once 'View/blog_listing/edit.phtml';
	}
	public function errorAction($action)
	{
		throw new Exception("method:{$action} does not exists.", 1);
		
	}
	public function redirect($url)
	{
		if($url == null){
			$url = "http://localhost/blog/BlogPosting.php?a=grid";
		}
		header("location: {$url}");
		exit();
	}
}

$action = $_GET['a'].'Action';
$BlogPosting = new BlogPosting();
if(!method_exists($BlogPosting, $action)){
	$BlogPosting->errorAction($action);
}
$BlogPosting->$action();

?>