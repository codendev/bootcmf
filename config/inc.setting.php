<?php

define("BOOTCMS_PATH","app/bootcmf/");

require_once(dirname(__FILE__).'/inc.autoload.php');

require_once(dirname(__FILE__).'/inc.database.php');

spl_autoload_register('__autoload');

//Host

define("BASE_URL", "http://localhost/workspace/bootcmf/");

define("SITE_NAME", "CodenDev");

define("CURRENCY","$");

define('DEFAULT_ACCOUNT',1);

define("DEFAULT_STATE",'05');

define("LIMIT_STRING",100);

define("HEADING_LIMIT_STRING",50);

define("SECURE_HASH","ADW@#DASDA@@#DSDG$^%YGDFGFSWR#$");

//Locale
define("LOCALE","en");

//Skin
define("ADMIN_SKIN", "skin/admin/default/");

define("FRONTEND_SKIN", "skin/frontend/default/");

//Template
define("TEMPLATE", "template/");

define("ADMIN_SKIN_URL",BASE_URL.ADMIN_SKIN);

define("FRONTEND_SKIN_URL",BASE_URL.FRONTEND_SKIN);


//Routing
define("CONTROLLERS","actions");

define("DEFAULT_NAMESPACE", "home");

define("DEFAULT_CONTROLLER", "index");

define("DEFAULT_METHOD", "index");

define("ERR_NAMESPACE","error");

define("ERR_CONTROLLER","error");

define("ERR_METHOD","e404");



//Paging Configuration

define("NUMBERS_PER_PAGE", 10);

define("NOTICE_PER_PAGE", 5);

define("RECORDS_PER_PAGE", "1");

//Images

define("DEFAULT_IMAGE", "upload/default/");

define("DEFAULT_IMAGE_NAME", "noimage.jpg");

?>
