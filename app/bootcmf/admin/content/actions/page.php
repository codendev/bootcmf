<?php
class Admin_Cms_Page extends Core_Parent_Action {
	 

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
