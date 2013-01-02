<?php
/*
 * Bootcmf standard dispatcher
 */

$dir='';
$namespace=array();
$action='';
$found=false;
$params=array();
extract($_GET);


/*
 * SEO Route Match
 */
$seo=new Core_Lib_Seo();

$action=$seo->map($action);

/*
 *Route Standard Pattern match
 */
if($action=='') {

    $action= DEFAULT_NAMESPACE.'/'.DEFAULT_CONTROLLER.'/'.DEFAULT_METHOD;
}
$args=explode('/',$action);


foreach($args as $item) {
	
    if(is_dir(dirname(__FILE__).'/../'.APP_DIR.'/'.'bootcmf'.'/'.strtolower(implode('/',$namespace)).'/'.$item)&&$item!=''&&$found==false) {
      	
	$dir.=$item.'/';
	
	$namespace[]=ucfirst($item);
	
    }
    else {

        array_push($params,$item);
        $found=true;
    }
}



$class=array_shift($params);

$method=array_shift($params);

$method=$method==''?'index':$method;

if(empty($class)){

	$class=DEFAULT_CONTROLLER;
}

$path =APP_DIR.'/'.'bootcmf'.'/'.$dir.strtolower(CONTROLLERS).'/'.$class.'.php';
   	

/*
 * Load controller class
 */


if(file_exists(dirname(__FILE__).'/../'.$path)) {
    require dirname(__FILE__).'/../'.$path;
}
else {
/*
* Controller not found
*/
    $namespace=array(ERR_NAMESPACE);	
	
    $class=ERR_CONTROLLER;

    $method=ERR_METHOD;
      
}


$controller=implode('_',$namespace).'_'.ucfirst($class);

/*
* Controller object
*/

$instance=new $controller();

/*
* Controller method invocation
*/

/*
* Custom in page routes
*/

$route=$instance->getRoute($method);

if(!empty($route)){

	$method=$route;

}

$ref = new ReflectionClass($controller);

if($ref->hasMethod($method)) {
    $ref->setStaticPropertyValue('controller',$class);
    $ref->setStaticPropertyValue('method',$method);
    $ref->setStaticPropertyValue('params',$params);
  

    call_user_func_array(array($instance, $method),$params);
}
elseif($ref->hasMethod(DEFAULT_METHOD)) {
	
	$params=array(0=>$method);
    $ref->setStaticPropertyValue('controller',$class);
    $ref->setStaticPropertyValue('method',DEFAULT_METHOD);
    $ref->setStaticPropertyValue('params',$params);
	
    /*
    * Controller object
    */
    
    $instance=new $controller();

    /*
    * Controller method invocation
    */

    call_user_func_array(array($instance, DEFAULT_METHOD),$params);
}
else {
    /*
     * Method not found
    */
    $controller=ucfirst(ERR_NAMESPACE).'_'.ucfirst(ERR_CONTROLLER);
    $ref->setStaticPropertyValue('controller',$controller);
    $ref->setStaticPropertyValue('method',ERR_METHOD);
    $ref->setStaticPropertyValue('params',$params);

    /*
    * Controller object
    */

    $instance=new $controller();

    /*
    * Controller method invocation
    */

    call_user_func_array(array($instance, ERR_METHOD),$params);

}
?>
