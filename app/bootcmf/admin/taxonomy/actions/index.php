<?php
class Admin_Taxonomy_Index extends Core_Parent_Action {

	function __construct(){

		$this->setRoute("edit", "add");


	}
	function  index() {
			
		if(!Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."admin");

		}

		$tp= new Type();

		/*
		 * GET variables
		* */

		$title=isset($_GET["title"])?$_GET["title"]:"";

		$parent_id=isset($_GET["parent_id"])?$_GET["parent_id"]:"";

		$status=isset($_GET["status"])?$_GET["status"]:"";

		$offset=isset($_GET["offset"])?$_GET["offset"]:"";

		$num=isset($_GET["num"])?$_GET["num"]:"";



		$this->data["taxonomies"]=$tp->getTaxonomies($title,$parent_id,$status,$offset,$num);

		$this->data["parents"]=$tp->getTaxonomies();

		$this->data["action"]=BASE_URL."admin/taxonomy/index";

		load_template('admin/taxonomy/type_list.php',$this->data);



	}
	
	
	function  add($type_id=null) {
			

		$tp=new Type();

		if(!Auth::getAuth()->loggedIn()) {

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


		$this->data["parents"]=$tp->getParentTaxonomies($type["taxonomy_id"]);

		load_template('admin/taxonomy/type_form.php',$this->data);

	}


}

?>
