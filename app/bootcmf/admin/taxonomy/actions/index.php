<?php
class Admin_Taxonomy_Index extends Core_Parent_Action {

	function __construct(){

		$this->setRoute("edit", "add");


	}

	function  index() {
			
		$this->listing();

	}

	function  listing() {
			
		if(!Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."?action=admin");

		}
		
		$tx= new Taxonomy();
		
		$this->data["taxonomies"]=$tx->getTaxonomies();

		load_template('admin/taxonomy/list.php',$this->data);



	}
	function  add($taxonomy_id=null) {
			

		$tx=new Taxonomy();

		if(!Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."?action=admin");

		}

		if($_POST){

			//Save Code
			if(isset($taxonomy_id)){
				
				$tx->updateTaxonomy($_POST,$taxonomy_id);
				
				$this->data["updated"]=true;
				
			}
			else{
				
				$tx->addTaxonomy($_POST);
				
				$this->data["added"]=true;
			}

			
				
				
				

		}
		$taxonomy=$tx->getTaxonomy($taxonomy_id);
		
		if(isset($_POST["title"])){

			$this->data["title"]=$_POST["title"];
		}
		elseif(isset($taxonomy["title"])){
			
			$this->data["title"]=$taxonomy["title"];
		}
		else{

			$this->data["title"]="";
		}
		
		if(isset($_POST["parent_id"])){
		
			$this->data["parent_id"]=$_POST["parent_id"];
		}
		elseif(isset($taxonomy["parent_id"])){
				
			$this->data["parent_id"]=$taxonomy["parent_id"];
		}
		else{
		
			$this->data["parent_id"]=0;
		}
		
		if(isset($_POST["status"])){
		
			$this->data["status"]=$_POST["status"];
		}
		elseif(isset($taxonomy["status"])){
				
			$this->data["status"]=$taxonomy["status"];
		}
		else{
		
			$this->data["status"]=1;
		}
		
		


		$this->data["parents"]=$tx->getTaxonomies();

		load_template('admin/taxonomy/form.php',$this->data);

	}





}

?>
