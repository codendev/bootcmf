<?php 
class Index_Controller{


	public function index(){

		$data["warnings"]=array();

		if (phpversion() < '5.2') {
			$data['warnings'][] = array('message'=>'BootCMF requires PHP 5.2 and above!','suggestion'=>'Please update your PHP');
		}

		if (!ini_get('file_uploads')) {
			$data['warnings'][] = array('message'=>'File uploads are not enabled!','suggestion'=>'Please enable file_uploads in your php.ini');;
		}

		if (!extension_loaded('mysql')) {
			$data['warnings'][] = array('message'=>'Mysql extension is not enabled!','suggestion'=>'Please enable mysql extension in your php.ini');
		}

		if (!extension_loaded('gd')) {
			$data['warnings'][] = array('message'=>'GD library is not enabled!','suggestion'=>'Please enable GD extension in php.ini.GD library is required for image manipulation.');
		}

		if (!extension_loaded('curl')) {
			$data['warnings'][] = array('message'=>'CURL library is not enabled!','suggestion'=>'Please enable CURL extension in php.ini.CURL library is required for making http requests.');
		}

		if (!function_exists('mcrypt_encrypt')) {
			$data['warnings'][] = array('message'=>'CURL library is not enabled!','suggestion'=>'Please enable CURL extension in php.ini.CURL library is required for making http requests.');
		}

		if (!extension_loaded('zlib')) {
			$data['warnings'][] = array('message'=>'CURL library is not enabled!','suggestion'=>'Please enable CURL extension in php.ini.CURL library is required for making http requests.');
		}
		if (is_writable(INSTALL_DIR . 'config/database.php')) {
			$data['warnings'][] = array('message'=>'config/database.php is not writeable!','suggestion'=>'Please set the permission for config/database.php so that the webserver process can write in this file.');;
		}
		if (is_writable(INSTALL_DIR . 'config/setting.php')) {
			$data['warnings'][] = array('message'=>'config/setting.php is not writeable!','suggestion'=>'Please set the permission for config/database.php so that the webserver process can write in this file.');;
		}

		if (!is_writable(INSTALL_DIR . 'cache')) {
			$data['warnings'][] = array('message'=>'cache folder is not writeable!','suggestion'=>'Please set the permission for cache so webserver process can write.');
		}

		if(!empty($data['warnings'])){

			header('location:'.base_url().'?action=index/license');
		}

		template('index.tpl.php',$data);


	}

	public function license(){

		if(isset($_POST["agree"])){

			$_SESSION['agree']=true;

			header('location:'.base_url().'?action=index/config');
		}

		template('license.tpl.php');
	}

	public function config(){

		//Confirms the license
		if(!isset($_SESSION["agree"])){

			header('location:'.base_url().'?action=index/license');
			return;

		}

		$mdbDSN='';

		if(isset($_POST)){

			$mdbDSN='mysqli://'.$_POST['userName'].':'.$_POST['password'].'@'.$_POST['hostName'].'/'.$_POST['databaseName'];

			$obj = MDB2::singleton($mdbDSN);

			if (PEAR::isError($obj))
			{
				$_POST['error']= 'Cannot connect to database: ' . $obj->getMessage();
					
			}
			else
				$_POST['success']='Database Connection successful';
				
				
			if(isset($_POST['success'])){

				$this->_databaseConfig($mdbDSN);

				$this->_settingConfig();


			}
				

		}


			
	}

	private function _fileWrite($stringData,$fileName){

		$fh = fopen($fileName, 'w') or die("can't open file");
		fwrite($fh, $stringData);
		fclose($fh);
	}

	private function _databaseConfig($dsn,$prefix=''){
		
		$out='';
		
		$out.='<?php '.PHP_EOL;
		
		$out.='define(\'MDB_DSN\',\''.$dsn .'\' );'.PHP_EOL;
		
		$out.='define (\'DB_PREFIX\',\''.$prefix.'\');';
		
		$this->_fileWrite($out,INSTALL_DIR.'config/database.php');

	}

	private function _settingConfig(){

		$out='';

		$out.='<?php '.PHP_EOL;

		$out.='define(\'APP_DIR\',\'app\');'.PHP_EOL;

		$out.='define(\'INSTALL_DIR\',dirname(__FILE__).\'../\');'.PHP_EOL;

		$out.='define(\'SECURE_HASH\',\'ADW@#DASDA@@#DSDG$^%YGDFGFSWR#$\');'.PHP_EOL;

		$out.='define(\'LOCALE\',\'en\');'.PHP_EOL;


		$out.='define(\'ADMIN_SKIN\', \'/skin/admin/default/\');'.PHP_EOL;

		$out.='define(\'FRONTEND_SKIN\', \'/skin/frontend/default/\');'.PHP_EOL;

		$out.='define(\'TEMPLATE\', \'template/\');'.PHP_EOL;

		$out.='define(\'ADMIN_SKIN_URL\',BASE_URL.ADMIN_SKIN);'.PHP_EOL;

		$out.='define(\'FRONTEND_SKIN_URL\',BASE_URL.FRONTEND_SKIN);'.PHP_EOL;

		$out.='define(\'CONTROLLERS\',\'actions\');'.PHP_EOL;

		$out.='define(\'DEFAULT_NAMESPACE\', \'home\');'.PHP_EOL;

		$out.='define(\'DEFAULT_CONTROLLER\', \'index\');'.PHP_EOL;

		$out.='define(\'DEFAULT_METHOD\', \'index\');'.PHP_EOL;

		$out.='define(\'ERR_NAMESPACE\',\'error\');'.PHP_EOL;

		$out.='define(\'ERR_CONTROLLER\',\'error\');'.PHP_EOL;

		$out.='define(\'ERR_METHOD\',\'e404\');'.PHP_EOL;

		$this->_fileWrite($out, INSTALL_DIR.'config/setting.php');

		template('config.tpl.php',$_POST);

	}


	public function install(){

		//Install the system script

	}

	public function complete(){

		//Show the admin URL
	}

}