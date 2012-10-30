<?php
class Core_Parent_Action extends Core_Abstract_Action {
	
	
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

}

?>
