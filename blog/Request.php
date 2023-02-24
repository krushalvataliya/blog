<?php 

/**
 * 
 */
class Request
{
	
	public function isPost()
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			return true;
		}
		return false;
	}
	public function isGet()
	{
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
			return true;
		}
		return false;
	}
	public function getPost($key = null)
	{
		if($this->isPost()){
			if ($key == null) {
				return $_POST;
			}
		return $_POST[$key];
		}
		return null;
	}
	public function getParams($key = null)
	{
		if($this->isGet()){
			if ($key == null) {
				return $_GET;
				}
		return $_GET[$key];
		}
		return null;
	}
}

?>