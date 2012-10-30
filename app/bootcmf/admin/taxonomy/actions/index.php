<?php
class Admin_Taxonomy_Index extends Core_Parent_Action {
	
	function __construct(){

		$this->setRoute("add", "group");

		$this->setRoute("edit", "group");


	}

	function  index() {
			
		$this->listing();

	}

	function  listing() {
			
		if(!Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."?action=admin");

		}

		load_template('admin/cms/list.php',$this->data);



	}
	function  group() {
			

			
		if(!Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."?action=admin");

		}

		if($_POST){

			//Save Code
		}

		if(isset($_POST["title"])){

			$this->data["title"]=$_POST["title"];
		}
		else{

			$this->data["title"]="";
		}
		
		$tx=new Taxonomy();
		
		$this->data["parents"]=$tx->getTaxonomies();
		
		load_template('admin/taxonomy/group/form.php',$this->data);

	}





}

?>
