<?php
class Cms_Index extends Core_Controller_Application {
	 

	function  index() {
		 
		
		if(!Auth::getAuth()->loggedIn()){

			$this->data["title"]="CodenDev Projects";

			load_template('admin/cms/cms.php',$this->data);

		}
		else{
			
			$this->redirect("?action=account/login");
		}

	}

}

?>
