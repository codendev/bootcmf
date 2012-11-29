<?php
class Page_Block_Admin_Segment extends Core_Abstract_Block {


	public static function  index(&$data) {

		$data["metaTitle"]="Page";

		$segment=Core_Helper_Template::template("frontend/page/block/admin/segment.php",$data,true);

		return $segment;
	}

}

?>
