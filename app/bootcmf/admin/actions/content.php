<?php
class Admin_Content extends Core_Action_Admin {

	function __construct(){

		$this->setRoute("edit", "add");


	}

	function  index() {
			
			
		if(!Core_Lib_Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."admin");

		}

		$cn= new Core_Model_Content();

		/*
		 * GET variables
		* */

		$title=isset($_GET["title"])?$_GET["title"]:"";

		$parent_id=isset($_GET["parent_id"])?$_GET["parent_id"]:"";

		$status=isset($_GET["status"])?$_GET["status"]:"";

		$offset=isset($_GET["offset"])?$_GET["offset"]:"";

		$num=isset($_GET["num"])?$_GET["num"]:"";

		$this->data["contents"]=$cn->getContents($title,$parent_id,$status,$offset,$num);

		$this->data["parents"]=$cn->getContents();

		$this->data["action"]=BASE_URL."admin/content/index";

		Core_Helper_Template::template('admin/base/content_list.php',$this->data);

	}

	function  add($content_id_id=null) {
			

		$tp=new Core_Model_Content();

		if(!Core_Lib_Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."admin");

		}

		if($_POST){

			//Save Code
			if(isset($content_id_id)){

				$tp->updateType($_POST,$content_id_id);

				$this->data["updated"]=true;

			}
			else{

				$tp->addType($_POST);

				$this->data["added"]=true;
			}

		}
		$content_id=$tp->getContent($content_id_id);

		if(isset($_POST["title"])){

			$this->data["title"]=$_POST["title"];
		}
		elseif(isset($content_id["title"])){

			$this->data["title"]=$content_id["title"];
		}
		else{

			$this->data["title"]="";
		}

		if(isset($_POST["parent_id"])){

			$this->data["parent_id"]=$_POST["parent_id"];
		}
		elseif(isset($content_id["parent_id"])){

			$this->data["parent_id"]=$content_id["parent_id"];
		}
		else{

			$this->data["parent_id"]=0;
		}

		if(isset($_POST["status"])){

			$this->data["status"]=$_POST["status"];
		}
		elseif(isset($content_id["status"])){

			$this->data["status"]=$content_id["status"];
		}
		else{

			$this->data["status"]=1;
		}


		$this->data["parents"]=$tp->getParentContents($content_id["type_id"]);

		Core_Helper_Template::template('admin/base/content_form.php',$this->data);

	}




}

?>
