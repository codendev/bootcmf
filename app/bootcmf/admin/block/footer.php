<?php
class Admin_Block_Footer extends Core_Abstract_Block {


	public static function  index(&$data) {
			
		return Core_Helper_Template::template("admin/block/footer.php",$data);


	}
}

?>
