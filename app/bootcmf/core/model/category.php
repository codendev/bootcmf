<?php

class Core_Model_Category
{

	function getCategory( $id, $status = null )
	{
		$criteria = isset($status) ? "status = $status AND " : "";

		$db=Core_Lib_Database::getDatabase();

		$q = "SELECT * FROM ".DB_PREFIX."category WHERE ".$criteria." category_id = ".$db->quote($id);

		$res =  $db->executeQuery( $q );

		if(empty($res))
			return false;
		else
			return $res[0];
	}

	function getCategories($title="",$parent="",$status="",$offset="",$num="")
	{

		$db=Core_Lib_Database::getDatabase();

		$limit = !empty($num) ? " LIMIT ".$db->quote($offset).", ".$db->quote($num) : "";

		$status=!empty($status)?" WHERE status = ".$db->quote($status):"";

		$title=!empty($title)?" AND title LIKE ".$db->quote($title."%"):"";

		$parent=!empty($parent)?" AND parent_id = ".$db->quote($parent):"";

		$q = "SELECT * FROM ".DB_PREFIX."category $status $title $parent ORDER BY created DESC".$limit;

		$res =  $db->executeQuery( $q );

		return $res;
	}

	function getParentCategories($parentId)
	{

		$db=Core_Lib_Database::getDatabase();

		$parent=!empty($parentId)?" WHERE parent_id = ".$db->quote($parentId):"";

		$q = "SELECT * FROM ".DB_PREFIX."category $parent ORDER BY created DESC";

		$res =  $db->executeQuery( $q );

		return $res;
	}

	function getCategoryIdByTitle( $title )
	{
		$db=Core_Lib_Database::getDatabase();

		$q = "SELECT id FROM category WHERE title = ".$db->quote($title);

		$res =  $db-> executeQuery( $q );

		if(empty($res))
			return false;
		else
			return $res['category_id'];
	}

	function getCategoryTitle( $id )
	{
		$db = Core_Lib_Database::getDatabase();

		$q = "SELECT title FROM ".DB_PREFIX."category WHERE category_id = ".$db->quote($id);

		$res = $db -> query( $q );

		if(PEAR::isError($res))
			return false;
		else
			return $r['title'];
	}

	function getCategoryStatus( $id )
	{
		$db = Core_Lib_Database::getDatabase();

		$q = "SELECT status FROM ".DB_PREFIX."category WHERE category_id = ".$db->quote($id);

		$res = $db -> query( $q );


		if(PEAR::isError($res))
			return false;
		else
			return $r['status'];
	}

	function setCategoryStatus( $id )
	{
		$status = $this -> get_category_status( $id );

		$status = $status == 1 ? 0 : 1;

		$db=Core_Lib_Database::getDatabase();

		$q = "UPDATE category SET status = ".$status." WHERE category_id = ".$db->quote($id);

		$res =  $db-> query( $q );

		if(PEAR::isError($res))
			return false;
		else
			return true;
	}
	
	function getCategoryTypes($category_id){
		
		$list=array();
		
		$db = Core_Lib_Database::getDatabase();
		
		$q = "SELECT type_id FROM ".DB_PREFIX."category_type WHERE category_id = ".$db->quote($category_id);
		
		$res = $db -> executeQuery( $q );
		
		if(PEAR::isError($res))
			return false;
		else{
			array_walk($res,function($val,$key) use(&$list){
				
				$list[]=$val["type_id"];
			});
		
			return $list;
			
		}
		
	}

	function addCategory( $data )
	{
		$db = Core_Lib_Database::getDatabase();

		$typeParams=$data["type"];
		
		unset($data["type"]);
		
		$types=array("text","integer","integer");

		$category_id=$db->insert("category",$data,$types,"category_id");
		
		$res=$this->updateCategoryType($typeParams,$category_id);

		if(PEAR::isError($res))
			return false;
		else
			return $res;
	}

	function updateCategory( $data, $category_id )
	{
		$db = Core_Lib_Database::getDatabase();

		$types=$data["type"];

		$this->updateCategoryType($types,$category_id);

		unset($data["type"]);

		$types=array("text","integer","integer");

		$res=$db->update("category",$data,$types,"category_id",$category_id);

		if(PEAR::isError($res))
			return false;
		else
			return $res;
	}

	function updateCategoryType($params,$categoryId){
		
		$db = Core_Lib_Database::getDatabase();

		$q = "DELETE FROM category_type WHERE category_id = ".$db->quote($categoryId);
		
		$res =  $db-> executeQuery( $q );
		
		$types=array("integer","integer");
		
		foreach($params as $param){

			$data["category_id"]=$categoryId;

			$data["type_id"]=$param;
			
			$res=$db->insert("category_type",$data,$types,"category_type_id");
		}

		if(PEAR::isError($res))
			return false;
		else
			return true;


	}


}