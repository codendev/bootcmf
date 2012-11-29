<?php

class Core_Model_Tag
{

	function getTag( $id, $status = null )
	{
		$criteria = isset($status) ? "status = $status AND " : "";

		$db=Core_Lib_Database::getDatabase();

		$q = "SELECT * FROM ".DB_PREFIX."tag WHERE ".$criteria." tag_id = ".$db->quote($id);

		$res =  $db->executeQuery( $q );

		if(empty($res))
			return false;
		else
			return $res[0];
	}

	function getTags($title="",$status=NULL,$offset=NULL,$num=NULL)
	{

		$db=Core_Lib_Database::getDatabase();
	
		$limit = isset($num)&&isset($offset) ? " LIMIT ".$db->quote($offset).", ".$db->quote($num) : "";
	
		$status=isset($status)?" WHERE status = ".$db->quote($status):"";

		$title=isset($title)?" AND title LIKE ".$db->quote($title."%"):"";

		$q = "SELECT * FROM ".DB_PREFIX."tag $status $title ORDER BY created DESC".$limit;

		$res =  $db->executeQuery( $q );

		return $res;
	}
	
	function getParentTaxonomies($parentId)
	{
	
		$db=Core_Lib_Database::getDatabase();
		
		$parent=!empty($parentId)?" WHERE parent_id = ".$db->quote($parentId):"";
	
		echo $q = "SELECT * FROM ".DB_PREFIX."tag $parent ORDER BY created DESC";
	
		$res =  $db->executeQuery( $q );
	
		return $res;
	}

	function getTagIdByTitle( $title )
	{
		$db=Core_Lib_Database::getDatabase();

		$q = "SELECT id FROM tag WHERE title = ".$db->quote($title);

		$res =  $db-> executeQuery( $q );

		if(empty($res))
			return false;
		else
			return $res['tag_id'];
	}

	function getTagTitle( $id )
	{
		$db = Core_Lib_Database::getDatabase();

		$q = "SELECT title FROM ".DB_PREFIX."tag WHERE tag_id = ".$db->quote($id);

		$res = $db -> query( $q );

		if(PEAR::isError($res))
			return false;
		else
			return $r['title'];
	}

	function getTagStatus( $id )
	{
		$db = Core_Lib_Database::getDatabase();

		$q = "SELECT status FROM ".DB_PREFIX."tag WHERE tag_id = ".$db->quote($id);

		$res = $db -> query( $q );


		if(PEAR::isError($res))
			return false;
		else
			return $r['status'];
	}

	function setTagStatus( $id )
	{
		$status = $this -> get_tag_status( $id );

		$status = $status == 1 ? 0 : 1;

		$db=Core_Lib_Database::getDatabase();

		$q = "UPDATE tag SET status = ".$status." WHERE tag_id = ".$db->quote($id);

		$res =  $db-> query( $q );

		if(PEAR::isError($res))
			return false;
		else
			return true;
	}

	function addTag( $data )
	{
		$db = Core_Lib_Database::getDatabase();

		$types=array("text","integer","integer");

		$res=$db->insert("tag",$data,$types);

		if(PEAR::isError($res))
			return false;
		else
			return $res;
	}

	function updateTag( $data, $tag_id )
	{
		$db = Core_Lib_Database::getDatabase();

		$types=array("text","integer","integer");

		$res=$db->update("tag",$data,$types,"tag_id",$tag_id);

		if(PEAR::isError($res))
			return false;
		else
			return $res;
	}


}