<?php

abstract class Core_Abstract_Action {
   
    //Referenced by templating libraries for passing data from controller to template

    protected $data;
   
    // Contains the name of current controller
	
    static $controller;

    //Contains the name of current method
	   
    static $method;

    //Contains array of parameter passed to the controller method
 	   
    static $params;

    //Custom Route	
    private  $_route;	

    function setRoute($path,$method){
	
	if(isset($this->_route[$path])){

		echo "Error: Route exists";
	}
	else{

		$this->_route[$path]=$method;

	}
    }	
 
    function getRoute($path){
	
	$method="";
	
	if(isset($this->_route[$path])){
	
		$method= $this->_route[$path];

	}
	
	return $method;	
		
    }		    

}



?>
