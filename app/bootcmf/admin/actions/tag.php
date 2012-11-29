<?php
class Admin_Tag extends Core_Action_Admin {

	function __construct(){

		$this->setRoute("edit", "add");


	}
	function  index() {
		
		$this->data=$_GET;
			
		if(!Core_Lib_Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."admin");

		}
		

		$tp= new Core_Model_Tag();

		/*
		 * GET variables
		* */

		$title=isset($_GET["title"])?$_GET["title"]:NULL;
		
		$status=isset($_GET["status"])?$_GET["status"]:NULL;

		$offset=isset($_GET["offset"])?$_GET["offset"]:NULL;

		$num=isset($_GET["num"])?$_GET["num"]:NULL;
		
		$this->data["tags"]=$tp->getTags($title,$status,$offset,$num);
		
		$this->data["action"]=BASE_URL."admin/tag";
		
		Core_Helper_Template::template('admin/base/tag_list.php',$this->data);

	}
	
	
	function  add($tag_id=null) {
			

		$tp=new Core_Model_Tag();

		if(!Core_Lib_Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."admin");

		}

		if($_POST){

			//Save Code
			if(isset($tag_id)){

				$tp->updateTag($_POST,$tag_id);

				$this->data["updated"]=true;

			}
			else{

				$tp->addTag($_POST);

				$this->data["added"]=true;
			}

		}
		$tag=$tp->getTag($tag_id);

		if(isset($_POST["title"])){

			$this->data["title"]=$_POST["title"];
		}
		elseif(isset($tag["title"])){
				
			$this->data["title"]=$tag["title"];
		}
		else{

			$this->data["title"]="";
		}		
		if(isset($_POST["status"])){

			$this->data["status"]=$_POST["status"];
		}
		elseif(isset($tag["status"])){

			$this->data["status"]=$tag["status"];
		}
		else{

			$this->data["status"]=1;
		}
	

		Core_Helper_Template::template('admin/base/tag_form.php',$this->data);

	}


}

?>
