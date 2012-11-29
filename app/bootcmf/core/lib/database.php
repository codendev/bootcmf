<?php

class Core_Lib_Database {

	private $__mdb2;

	private static $__instance;

	public function   __construct() {

		$this->__init();

	}

	private function __init() {

		$this->__mdb2 = MDB2::singleton(MDB_DSN);

		if (PEAR::isError($this->__mdb2))
		{
			echo 'Cannot connect to database: ' . $this->__mdb2->getMessage();
		}

	}

	public static function getDatabase() {

		if(is_null(Core_Lib_Database::$__instance)){

			Core_Lib_Database::$__instance=new Core_Lib_Database();
		}

		return Core_Lib_Database::$__instance;

	}

	function executeQuery($sql, $values=array()) {

		$results = array();

		if(sizeof($values) > 0) {

			$statement = $this->__mdb2->prepare($sql, TRUE, MDB2_PREPARE_RESULT);

			if(PEAR::isError($statement)) {

				die('DB Error... ' . $statement->getMessage());

			}
			else{

				$resultset = $statement->execute($values);
			}
			$statement->free();


		}
		else {

			$resultset = $this->__mdb2->query($sql);

		}
		if(PEAR::isError($resultset)) {

			die('DB Error... ' . $resultset->getMessage());

		}

		while($row = $resultset->fetchRow(MDB2_FETCHMODE_ASSOC)) {

			$results[] = $row;

		}

		return $results;
	}

	public function quote($str,$type='text'){

		return $this->__mdb2->quote($str,$type);

	}

	public function update($table,$data,$types,$key,$id){

		$this->__mdb2->loadModule('Extended');

		$affectedRows = $this->__mdb2->extended->autoExecute($table, $data,
				MDB2_AUTOQUERY_UPDATE, $key." = ".$this->quote($id, 'integer'), $types);

		if (PEAR::isError($affectedRows)) {
			die($affectedRows->getMessage());
		}
		return $affectedRows;
	}

	public function insert($table,$data,$types,$key){

		$this->__mdb2->loadModule('Extended');

		$affectedRows = $this->__mdb2->extended->autoExecute($table, $data,
				MDB2_AUTOQUERY_INSERT, null, $types);

		if (PEAR::isError($affectedRows)) {
			die($affectedRows->getMessage());
		}
		
		return $this->__mdb2->lastInsertID($table, $key);;

	}




}