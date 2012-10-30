<?php

class Database extends MDB2 {

	private $__db;
	
	private static $__instance;

	public function   __construct() {

		$this->__init();

	}
	public function __call($method,$args){
		
		echo 1;exit;
	}
	
	
	private function __init() {

		$this->__db = MDB2::singleton(MDB_DSN);

		$this->__db->executeQuery=function ($sql, $values=array()) {


			$results = array();

			if(sizeof($values) > 0) {

				$statement = $this->__db->prepare($sql, TRUE, MDB2_PREPARE_RESULT);

				$resultset = $statement->execute($values);

				$statement->free();

			}
			else {

				$resultset = $this->__db->query($sql);

			}
			if(PEAR::isError($resultset)) {

				die('DB Error... ' . $resultset->getMessage());

			}

			while($row = $resultset->fetchRow(MDB2_FETCHMODE_ASSOC)) {

				$results[] = $row;

			}

			return $results;
		};
		
		if (PEAR::isError($this->__db))
		{
			echo 'Cannot connect to database: ' . $this->__db->getMessage();
		}

	}

	public static function getDatabase() {

		if(is_null(Database::$__instance)){

			Database::$__instance=new Database();
		}

		return Database::$__instance->__db;

	}



}