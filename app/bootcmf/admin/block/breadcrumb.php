<?php
class Admin_Block_Sidebar extends Core_Abstract_Block {


	public static function  index(&$data) {
	
		return array("Dashboard"=>array("Welcome",Core_Helper_Tool::makeUrl("admin/index")));

	}

}

?>
