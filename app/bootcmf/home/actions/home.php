<?php
class Home_Home extends Core_Abstract_Action {
   
    function __construct(){
		
	 $this->setRoute("please_read_me","indexo");
         
	 $this->setRoute("contact","indexo");

    }	

    	
    function  indexo($param=0) {
		
		$this->data["title"]="CodenDev Projects";

		Core_Helper_Template::template('frontend/home/index.php',$this->data);
    
	}

    function  contributor() {

		$this->data["title"]="CodenDev Projects Contributor";

		Core_Helper_Template::template('frontend/home/contributor.php',$this->data);
    
	}
    function  license() {

		$this->data["title"]="CodenDev Projects Contributor";

		Core_Helper_Template::template('frontend/home/license.php',$this->data);
    
    }
    function  about() {

		$this->data["title"]="CodenDev Projects Contributor";

		Core_Helper_Template::template('frontend/home/about.php',$this->data);
    
	}		
			
			

}

?>
