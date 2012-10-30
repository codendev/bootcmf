<?php
/*
 * almStart
*/
session_start();

error_reporting(E_ALL);

ini_set('display_errors','On');

define('INSTALLDIR', dirname(__FILE__));


//Common Utility Functions

require dirname(__FILE__).'/func/tool.php';

//Templating Functions

require dirname(__FILE__).'/func/template.php';


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
url action=controller/method/params on "/".

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


require dirname(__FILE__).'/config/inc.setting.php';

set_include_path(get_include_path() . PATH_SEPARATOR . INSTALLDIR . '/extlib/');


require_once('PEAR.php');

require_once('PEAR/Exception.php');

require_once('MDB2.php');

//require_once('DB/DataObject.php');

//require_once('DB/DataObject/Cast.php'); # for dates

require_once 'php-gettext/gettext.inc';


//locale

if (isSet($_GET["locale"])) 
	$locale = $_GET["locale"];
else 
	$locale=LOCALE;

putenv("LC_ALL=$locale");

setlocale(LC_ALL, $locale);

bindtextdomain("messages", "./locale");

textdomain("messages");


//almStart Dispatcher

require dirname(__FILE__).'/app/bootcmf.php';


?>
