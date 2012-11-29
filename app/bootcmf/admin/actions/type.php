<?php
class Admin_Type extends Core_Action_Admin {

	function __construct(){

		$this->setRoute("edit", "add");


	}
	function  index() {
			
		if(!Core_Lib_Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."admin");

		}

		$tp= new Core_Model_Type();

		/*
		 * GET variables
		* */

		$title=isset($_GET["title"])?$_GET["title"]:"";

		$parent_id=isset($_GET["parent_id"])?$_GET["parent_id"]:"";

		$status=isset($_GET["status"])?$_GET["status"]:"";

		$offset=isset($_GET["offset"])?$_GET["offset"]:"";

		$num=isset($_GET["num"])?$_GET["num"]:"";



		$this->data["types"]=$tp->getTypes($title,$parent_id,$status,$offset,$num);

		$this->data["parents"]=$tp->getTypes();

		$this->data["action"]=BASE_URL."admin/type/index";

		Core_Helper_Template::template('admin/base/type_list.php',$this->data);



	}
	
	
	function  add($type_id=null) {
			

		$tp=new Core_Model_Type();

		if(!Core_Lib_Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."admin");

		}

		if($_POST){

			//Save Code
			if(isset($type_id)){

				$tp->updateType($_POST,$type_id);

				$this->data["updated"]=true;

			}
			else{

				$tp->addType($_POST);

				$this->data["added"]=true;
			}

		}
		$type=$tp->getType($type_id);

		if(isset($_POST["title"])){

			$this->data["title"]=$_POST["title"];
		}
		elseif(isset($type["title"])){
				
			$this->data["title"]=$type["title"];
		}
		else{

			$this->data["title"]="";
		}

		if(isset($_POST["parent_id"])){

			$this->data["parent_id"]=$_POST["parent_id"];
		}
		elseif(isset($type["parent_id"])){

			$this->data["parent_id"]=$type["parent_id"];
		}
		else{

			$this->data["parent_id"]=0;
		}

		if(isset($_POST["status"])){

			$this->data["status"]=$_POST["status"];
		}
		elseif(isset($type["status"])){

			$this->data["status"]=$type["status"];
		}
		else{

			$this->data["status"]=1;
		}


		$this->data["parents"]=$tp->getParentTypes($type["type_id"]);

		Core_Helper_Template::template('admin/base/type_form.php',$this->data);

	}


}

?>
