<?php
class Admin_Cms_Index extends Core_Parent_Action {

	function __construct(){

		$this->setRoute("add", "content");

		$this->setRoute("edit", "content");


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

	function  content() {
			

			
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
		if(isset($_POST["content"])){

			$this->data["content"]=$_POST["content"];
		}
		else{

			$this->data["content"]="";
		}

	load_template('admin/cms/form.php',$this->data);

}




}

?>
