<?php
class Admin_Language extends Core_Action_Admin {

	function __construct(){

		$this->setRoute("edit", "add");


	}
	function  index() {
		
		$this->data=$_GET;
			
		if(!Core_Lib_Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."admin");

		}
		

		$tp= new Core_Model_Language();

		/*
		 * GET variables
		* */

		$title=isset($_GET["title"])?$_GET["title"]:"";

		$iso6391=isset($_GET["iso6391"])?$_GET["iso6391"]:"";
		
		$iso6392=isset($_GET["iso6392"])?$_GET["iso6392"]:"";
		
		$status=isset($_GET["status"])?$_GET["status"]:"";

		$offset=isset($_GET["offset"])?$_GET["offset"]:"";

		$num=isset($_GET["num"])?$_GET["num"]:"";

		$this->data["languages"]=$tp->getLanguages($title,$iso6391,$iso6392,$status,$offset,$num);
		
		$this->data["action"]=BASE_URL."admin/base/index";
		
		Core_Helper_Template::template('admin/base/language_list.php',$this->data);



	}
	
	
	function  add($language_id=null) {
			

		$tp=new Core_Model_Language();

		if(!Core_Lib_Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."admin");

		}

		if($_POST){

			//Save Code
			if(isset($language_id)){

				$tp->updateLanguage($_POST,$language_id);

				$this->data["updated"]=true;

			}
			else{

				$tp->addLanguage($_POST);

				$this->data["added"]=true;
			}

		}
		$language=$tp->getLanguage($language_id);

		if(isset($_POST["title"])){

			$this->data["title"]=$_POST["title"];
		}
		elseif(isset($language["title"])){
				
			$this->data["title"]=$language["title"];
		}
		else{

			$this->data["title"]="";
		}

		if(isset($_POST["iso6391"])){
		
			$this->data["iso6391"]=$_POST["iso6391"];
		}
		elseif(isset($language["iso6391"])){
		
			$this->data["iso6391"]=$language["iso6391"];
		}
		else{
		
			$this->data["iso6391"]="";
		}
		
		if(isset($_POST["iso6392"])){

			$this->data["iso6392"]=$_POST["iso6392"];
		}
		elseif(isset($language["iso6392"])){

			$this->data["iso6392"]=$language["iso6392"];
		}
		else{

			$this->data["iso6392"]="";
		}
		
		
		if(isset($_POST["status"])){

			$this->data["status"]=$_POST["status"];
		}
		elseif(isset($language["status"])){

			$this->data["status"]=$language["status"];
		}
		else{

			$this->data["status"]=1;
		}
	

		Core_Helper_Template::template('admin/base/language_form.php',$this->data);

	}


}

?>
