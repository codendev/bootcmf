<?PHP
class Auth {
	const SALT = 'SALT';
	 
	private static $me;

	public $id;

	public $username;

	public $user;

	public $expiryDate;

	private $nid;

	private $loggedIn;

	public function __construct() {
		$this->id = null;
		$this->nid = null;
		$this->username = null;
		$this->user = null;
		$this->loggedIn = false;
		$this->expiryDate = mktime(0, 0, 0, 6, 2, 2037);

	}

	public static function getAuth() {
		if(is_null(self::$me)) {
			self::$me = new Auth();
			self::$me->init();
		}
		return self::$me;
	}

	public function init() {
		$this->setACookie();
		$this->loggedIn = $this->attemptCookieLogin();

	}

	public function login($username, $password) {
		$this->loggedIn = false;

		$db = Database::getDatabase();

		$hashed_password = self::hashedPassword($password);

		$res = $db->executeQuery("SELECT * FROM user WHERE username = " . $db->quote($username) . " AND password = " . $db->quote($hashed_password));
		
		var_dump("SELECT * FROM user WHERE username = " . $db->quote($username) . " AND password = " . $db->quote($hashed_password));
		if(!empty($res)){

			$row=$res[0];
			
			$this->id = $row['id'];

			$this->nid = $row['nid'];

			$this->username = $row['username'];

			$this->user = $row;

			$this->generateBCCookies();

			$this->loggedIn = true;

			return true;
		}
		else{
			
			return false;
		}
	}

	public function logout() {
		 
		$this->loggedIn = false;

		$this->clearCookies();

		//$this->sendToLoginPage();
	}

	public function loggedIn() {

		return $this->loggedIn;

	}

	public function requireUser() {

		if(!$this->loggedIn())

			$this->sendToLoginPage();

	}
	public function isAdmin() {

		return ($this->user['level'] === 'admin');

	}

	public function changeCurrentUsername($new_username) {

		$db = Database::getDatabase();
		srand(time());
		$this->user["nid"] = Auth::newNid();
		$this->nid = $this->user["nid"];
		$this->user["username"] = $new_username;
		$this->username = $this->user["username"];
		$q = "UPDATE user SET `nid`='".$this->user["nid"]."', `username` = ".$db->quote($new_username).", `modifieddate` = '".date('Y-m-d H:i:s')."' WHERE id = ".$this->id;
		$db->execute($q);
		$this->generateBCCookies();

	}

	public function changeCurrentPassword($old_password,$new_password) {
		$db = Database::getDatabase();
		srand(time());

		if(self::hashedPassword($old_password)==$this->user["password"]) {
			$this->user["nid"] =  self::newNid();
			$this->user["password"] = self::hashedPassword($new_password);
			$q = "UPDATE user SET `nid`='".$this->user["nid"]."' ,`password` = '".$this->user["password"]."', `modifieddate` = '".date('Y-m-d H:i:s')."' WHERE id = ".$this->id;
			$this->nid = $this->user["nid"];
			$db->execute($q);
			$this->generateBCCookies();
			return true;
		}
		else {

			return false;
		}
	}
	public function createPassword($username) {

		$db = Database::getDatabase();

		srand(time());

		$password=self::randPassword();

		$res = $db->query("SELECT * FROM user WHERE username = " . $db->quote($username));
		 
		if(PEAR::isError($res))
			 
			return false;

		$row=$res->fetchRow();

		$nid =  self::newNid();

		$new_password = self::hashedPassword($password);

		$q = "UPDATE user SET `nid`='".$nid."' ,`password` = '".$new_password."', `modifieddate` = '".date('Y-m-d H:i:s')."' WHERE username = ".$db->quote($username);
		 
		$db->execute($q);
		// $this->generateBCCookies();

		return array('id'=>$row['id'],'password'=>$password);
	}

	public static function changeUsername($id_or_id, $new_username) {
		//            if(ctype_digit($id_or_username))
			//                $u = new User($id_or_username);
			//            else
				//            {
				//               $q = "UPDATE user SET `username` = '".$username."', `modifieddate` = '".date('Y-m-d H:i:s')."' WHERE id = ".$id;
				//            }
				//
				//            if($u->ok())
					//            {
					//                $q = "UPDATE user SET `username` = '".$username."', `modifieddate` = '".date('Y-m-d H:i:s')."' WHERE id = ".$id;
					//                $u->update();
					//            }
	}

	public static function changePassword($id_or_username, $new_password) {
		if(ctype_digit($id_or_username))
			$u = new User($id_or_username);
		else {
			$u = new User();
			$u->select($id_or_username, 'username');
		}

		if($u->ok()) {
			$u->nid = self::newNid();
			$u->password = self::hashedPassword($new_password);
			$u->update();
		}
	}

	public static function createNewUser($username, $password = null,$status=1,$level="user") {

		if(is_null($password))

			$password = Auth::generateStrongPassword();

		srand(time());

		$nid = self::newNid();

		$password = self::hashedPassword($password);

		$q = "INSERT INTO user(`username`,`nid`, `password`,`level`, `status`, `addeddate`, `modifieddate`)
		VALUES('".$username."', '".$nid."', '".$password."', '".$level."', '".$status."', '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."')";

		$r = Database::getDatabase() -> execute( $q );

		if( $r != false )
			return true;
		else
			return false;

	}

	public static function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds') {

		$sets = array();

		if(strpos($available_sets, 'l') !== false)
			$sets[] = 'abcdefghjkmnpqrstuvwxyz';

		if(strpos($available_sets, 'u') !== false)
			$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';

		if(strpos($available_sets, 'd') !== false)
			$sets[] = '23456789';

		if(strpos($available_sets, 's') !== false)
			$sets[] = '!@#$%&*?';

		$all = '';

		$password = '';

		foreach($sets as $set) {
			$password .= $set[array_rand(str_split($set))];
			$all .= $set;
		}

		$all = str_split($all);

		for($i = 0; $i < $length - count($sets); $i++)
			$password .= $all[array_rand($all)];

		$password = str_shuffle($password);

		if(!$add_dashes)
			return $password;

		$dash_len = floor(sqrt($length));

		$dash_str = '';

		while(strlen($password) > $dash_len) {

			$dash_str .= substr($password, 0, $dash_len) . '-';

			$password = substr($password, $dash_len);
		}

		$dash_str .= $password;

		return $dash_str;
	}


	private function attemptCookieLogin() {

		if(!isset($_COOKIE['A']) || !isset($_COOKIE['B']) || !isset($_COOKIE['C']))
			return false;

		$ccookie = base64_decode(str_rot13($_COOKIE['C']));

		if($ccookie === false)
			return false;

		$c = array();

		parse_str($ccookie, $c);

		if(!isset($c['n']) || !isset($c['l']))
			return false;

		$bcookie = base64_decode(str_rot13($_COOKIE['B']));

		if($bcookie === false)
			return false;

		$b = array();

		parse_str($bcookie, $b);

		if(!isset($b['s']) || !isset($b['x']))
			return false;

		if($b['x'] < time())
			return false;

		$computed_sig = md5(str_rot13(base64_encode($ccookie)) . $b['x'] . self::SALT);

		if($computed_sig != $b['s'])
			return false;

		$nid = base64_decode($c['n']);

		if($nid === false)
			return false;

		$db = Database::getDatabase();

		$res = $db->executeQuery('SELECT * FROM user WHERE nid = ' . $db->quote($nid));
		 
		if(empty($res))
			 
			return false;
		
		$row=$res[0];
		 
		$this->id = $row['id'];

		$this->nid = $row['nid'];

		$this->username = $row['username'];

		$this->user = $row;

		return true;
	}

	private function setACookie() {

		if(!isset($_COOKIE['A'])) {

			srand(time());

			$a = md5(rand() . microtime());

			setcookie('A', $a, $this->expiryDate, '/',(strpos($_SERVER['HTTP_HOST'],'.') !== false) ? $_SERVER['HTTP_HOST'] : '');

		}
	}

	private function generateBCCookies() {

		$c = '';

		$c .= 'n=' . base64_encode($this->nid) . '&';

		$c .= 'l=' . str_rot13($this->username) . '&';

		$c = base64_encode($c);

		$c = str_rot13($c);

		$sig = md5($c . $this->expiryDate . self::SALT);

		$b = "x={$this->expiryDate}&s=$sig";

		$b = base64_encode($b);

		$b = str_rot13($b);

		setcookie('B', $b, $this->expiryDate, '/', (strpos($_SERVER['HTTP_HOST'],'.') !== false) ? $_SERVER['HTTP_HOST'] : '');

		setcookie('C', $c, $this->expiryDate, '/', (strpos($_SERVER['HTTP_HOST'],'.') !== false) ? $_SERVER['HTTP_HOST'] : '');

	}

	private function clearCookies() {

		setcookie('B', '', time() - 3600, '/', (strpos($_SERVER['HTTP_HOST'],'.') !== false) ? $_SERVER['HTTP_HOST'] : '');

		setcookie('C', '', time() - 3600, '/', (strpos($_SERVER['HTTP_HOST'],'.') !== false) ? $_SERVER['HTTP_HOST'] : '');

	}

	private static function hashedPassword($password) {

		return md5($password . self::SALT);

	}

	private static function newNid() {

		srand(time());

		return md5(rand() . microtime());
	}

	private static function randPassword(){

		srand(time());

		return substr(md5(rand() . microtime()+rand() . microtime()),0,8);

	}
}