<?php
class Admin_Index extends Core_Action_Admin {


	function  index() {

		$this->login();

	}
	function  welcome() {

		$this->meta("Welcome","","");

		if(!Core_Lib_Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."/admin");

		}

		$this->data["title"]="CodenDev Projects";

		Core_Helper_Template::template('admin/base/welcome.php',$this->data);

	}


	function login() {

		if(Core_Lib_Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."admin/index/welcome");

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
				if(Core_Lib_Auth::getAuth()->login( $_POST['email'], $_POST['password'] )) {
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

		Core_Helper_Template::template('admin/base/login.php',$this->data);
	}

	function logout(){
			
		Core_Lib_Auth::getAuth()->logout();
			
		$this->redirect(BASE_URL."?action=admin");
			
	}
	function help(){

			
		if(!Core_Lib_Auth::getAuth()->loggedIn()) {

			header("Location:".BASE_URL."?action=admin");

		}
			
		$this->data["title"]="CodenDev Projects";
			
		Core_Helper_Template::template('admin/base/help.php',$this->data);

	}

	function extension(){
			
		$array=func_get_args();
		
		$method=array_pop($array);

		array_walk($array, function($val,$key) use(&$array){

			$array[$key]=ucfirst($val);

		});

			$objName= implode("_",$array);
		
			$this->data["segment"]=$objName::$method($this->data);
		
			Core_Helper_Template::template("admin/base/layout.php",$this->data);

	}


}

?>
