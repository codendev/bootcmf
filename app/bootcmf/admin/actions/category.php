<?php
class Admin_Category extends Core_Action_Admin {

	function __construct(){

		$this->setRoute("edit", "add");
		
		parent::__construct();
		
		
	}

	function  index() {
			
		if(!Core_Lib_Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."admin");

		}

		$cat= new Core_Model_Category();

		/*
		 * GET variables
		* */

		$title=isset($_GET["title"])?$_GET["title"]:"";

		$parent_id=isset($_GET["parent_id"])?$_GET["parent_id"]:"";
		
		$status=isset($_GET["status"])?$_GET["status"]:"";

		$offset=isset($_GET["offset"])?$_GET["offset"]:"";

		$num=isset($_GET["num"])?$_GET["num"]:"";

		$this->data["categories"]=$cat->getCategories($title,$parent_id,$status,$offset,$num);

		$this->data["parents"]=$cat->getCategories();

		$this->data["action"]=BASE_URL."admin/category/index";

		Core_Helper_Template::template('admin/base/category_list.php',$this->data);



	}
	
	
	function  add($category_id=null) {
			

		$cat=new Core_Model_Category();
		
		$tx= new Core_Model_Type();

		if(!Core_Lib_Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."admin");

		}

		if($_POST){
			
			//Save Code
			if(isset($category_id)){

				$cat->updateCategory($_POST,$category_id);

				$this->data["updated"]=true;

			}
			else{

				$cat->addCategory($_POST);

				$this->data["added"]=true;
			}

		}
		$category=$cat->getCategory($category_id);

		if(isset($_POST["title"])){

			$this->data["title"]=$_POST["title"];
		}
		elseif(isset($category["title"])){
				
			$this->data["title"]=$category["title"];
		}
		else{

			$this->data["title"]="";
		}
		
		if(isset($_POST["type"])){
		
			$this->data["type"]=$_POST["type"];
		}
		elseif(isset($category["category_id"])){
			
			$types=$cat->getCategoryTypes($category["category_id"]);
			
			
			
			$this->data["type"]=$types;
		}
		else{
		
			$this->data["type"]=array();
		}
		
		
		if(isset($_POST["parent_id"])){

			$this->data["parent_id"]=$_POST["parent_id"];
		}
		elseif(isset($category["parent_id"])){

			$this->data["parent_id"]=$category["parent_id"];
		}
		else{

			$this->data["parent_id"]=0;
		}
		
		
		if(isset($_POST["status"])){

			$this->data["status"]=$_POST["status"];
		}
		elseif(isset($category["status"])){

			$this->data["status"]=$category["status"];
		}
		else{

			$this->data["status"]=1;
		}
	
		$this->data["types"]=$tx->getAllTypes();
		
		
		$this->data["parents"]=$cat->getParentCategories($category["category_id"]);

		Core_Helper_Template::template('admin/base/category_form.php',$this->data);

	}


}

?>
