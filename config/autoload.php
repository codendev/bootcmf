<?php

function __autoload($class_name) {
   
    if (file_exists(dirname(__FILE__)."/../classes/" . strtolower($class_name) . ".php")) {
        require dirname(__FILE__)."/../classes/" . strtolower($class_name) . ".php";
    }
    elseif (file_exists(dirname(__FILE__)."/../lib/lib." . strtolower($class_name) . ".php")) {
    	require dirname(__FILE__)."/../lib/lib." . strtolower($class_name) . ".php";
    }
    elseif (file_exists(dirname(__FILE__)."/../".APP_DIR.'/'.'bootcmf'.'/'.implode("/",explode("_",strtolower($class_name))) . ".php")){	
		require dirname(__FILE__)."/../".APP_DIR.'/'.'bootcmf'.'/'.implode("/",explode("_",strtolower($class_name))). ".php";
			
    }

  
    
}
