<?php
session_start();
//echo 'http://' . $_SERVER['HTTP_HOST'] .dirname($_SERVER['SCRIPT_NAME']). '/';
error_reporting(E_ALL);

ini_set('display_errors','On');

define('LOCALE','en');
define('ERR_CONTROLLER','error');
define ('CONTROLLER_POSTFIX','Controller');
define('DEFAULT_ACTION','index/index');
define('INSTALL_DIR',realpath(dirname(__FILE__)).'/../');
define('TEMPLATE',dirname(__FILE__).'/view/');

//Common Utility Functions

require dirname(__FILE__).'/func/common.php';

set_include_path(get_include_path() . PATH_SEPARATOR . INSTALL_DIR . '/extlib/');

require_once('PEAR.php');

require_once('PEAR/Exception.php');

require_once('MDB2.php');

/*
Turn off magic quotes
*/
if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}
/*
Normally all GET request are applied urldecode before being available to the
acesss throught $_GET so this causes a problem if our url contains html special character for /
which are converted to / on urlencode. This is an integrity issue with the data as we are exploding the
url action=controller/method/params on '/'.

To circumvent this issue either you choose the REQUEST_URI variable available in $_SERVER or
variable that might include such data should be not be part of the action url variable in $_GET.
*/





/*
 * Clean http request
*/
$_GET = clean($_GET);
$_POST = clean($_POST);
$_REQUEST = clean($_REQUEST);
$_COOKIE = clean($_COOKIE);
$_FILES = clean($_FILES);
$_SERVER = clean($_SERVER);



$dir='';
$found=0;
$params=array();
extract($_GET);

/*
 *Route Standard Pattern match
 */
if(!isset($action)) {

    $action=DEFAULT_ACTION;
}
$args=explode('/',$action);

foreach($args as $item) {
    if(is_dir('controller/'.$item)&&$item!=''&&$found==0) {
        $dir.=$item.'/';

    }
    else {

        array_push($params,$item);
        $found=1;
    }
}


$class=array_shift($params);
$method=array_shift($params);
$method=$method==''?'index':$method;

if($dir!='')
    $path ='/controller/'.$dir.$class.'.php';
else
    $path ='/controller/'.$class.'.php';


/*
 * Load controller class
 */

if(file_exists(dirname(__FILE__).$path)) {
    require dirname(__FILE__).$path;
}
else {
/*
* Controller not found
*/
    $class=ERR_CONTROLLER;
    $method=ERR_METHOD;

}


$controller=ucfirst($class).'_'.CONTROLLER_POSTFIX;

$ref = new ReflectionClass($controller);

if($ref->hasMethod($method)) {


    /*
    * Controller object
    */

    $instance=new $controller();

    /*
    * Controller method invocation
    */

    call_user_func_array(array($instance, $method),$params);
}
elseif($ref->hasMethod(DEFAULT_METHOD)) {
	
	$params=array(0=>$method);
   
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
    $controller=ucfirst(ERR_CONTROLLER).'_'.CONTROLLER_POSTFIX;


    /*
    * Controller object
    */

    $instance=new $controller();

    /*
    * Controller method invocation
    */

    call_user_func_array(array($instance, ERR_METHOD),$params);

}