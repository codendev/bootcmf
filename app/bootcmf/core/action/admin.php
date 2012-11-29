<?php
class Core_Action_Admin extends Core_Abstract_Action {


	public function __construct(){

		$sidebar=new Admin_Block_Sidebar();

		$this->data["sidebar"]=$sidebar->index();

	}

	public function setTitle($title=""){

		$this->data["metaTitle"]=$title;
			
	}

	public function setDescription($description=""){
			
		$this->data["metaDescription"]=$description;
			
	}
	public function setKeywords($keywords=""){
			
		$this->data["metaKeywords"]=$keywords;
			
	}

	public function meta($title="",$description="",$keywords=""){

		$this->data["metaTitle"]=$title;
			
		$this->data["metaDescription"]=$description;

		$this->data["metaKeywords"]=$keywords;
	}

	public function redirect($url){

		header("Location: $url");

	}
	public function breadcrumb($text,$url){

		if(empty($this->data["breadcrumb"])){

			$this->data["breadcrumb"][]=array("Home"=>Core_Helper_Tool::makeUrl("admin"));
				
		}

		$this->data["breadcrumb"][]=array($text=>$url);

	}

}

?>
