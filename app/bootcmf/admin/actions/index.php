<?php
class Admin_Index extends Core_Parent_Action {
   

    function  index() {
		
    	$this->login();
    
	}
	function  welcome() {
		
		$this->meta("Welcome","","");
		
		if(!Auth::getAuth()->loggedIn()) {
		
			header("Location:".BASE_URL."?action=admin");
		
		}
		
		$this->data["title"]="CodenDev Projects";
	
		load_template('admin/base/welcome.php',$this->data);
	
	}
	

    function login() {
		
		if(Auth::getAuth()->loggedIn()) {

            header("Location:".BASE_URL."?action=admin/index/welcome");

        }
		$this->meta("Login","","");
        if($_POST) {
			
			if ((time() -@$_SESSION["timeFailed"] ) > 30){
				
				$_SESSION["failed"]=0;
			
			}
			if(@$_SESSION["failed"]>10){
				$this->data["warning"]="Please wait we are calling fire brigade";
			}
			else{
				if(Auth::getAuth()->login( $_POST['email'], $_POST['password'] )) {
					@$_SESSION["failed"]=null;
					$this->redirect(BASE_URL."?action=admin/index/welcome");
				}
				else {
					@$_SESSION["failed"]++;
					@$_SESSION["timeFailed"]=time();
					$this->data["warning"]="User not found!";
				}
			}
        }

        load_template('admin/base/login.php',$this->data);
    }
    
    function logout(){
    	
    	Auth::getAuth()->logout();
    	
    	$this->redirect(BASE_URL."?action=admin");
    	
    }
    function help(){
    	 
    	
    	if(!Auth::getAuth()->loggedIn()) {
    	
    		header("Location:".BASE_URL."?action=admin");
    	
    	}
    	
    	$this->data["title"]="CodenDev Projects";
    	
    	load_template('admin/base/help.php',$this->data);
    	 
    }
    

}

?>
