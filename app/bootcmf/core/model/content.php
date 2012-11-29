<?php
class Core_Model_Content
{

	function getContent( $id, $status = null )
	{
		$criteria = isset($status) ? "status = $status AND " : "";

		$db=Core_Lib_Database::getDatabase();

		$q = "SELECT * FROM ".DB_PREFIX."content WHERE ".$criteria." content_id = ".$db->quote($id);

		$res =  $db->executeQuery( $q );

		if(empty($res))
			return false;
		else
			return $res[0];
	}

	function getContents($title="",$parent="",$status="",$offset="",$num="")
	{

		$db=Core_Lib_Database::getDatabase();

		$limit = !empty($num) ? " LIMIT ".$db->quote($offset).", ".$db->quote($num) : "";
		
		$status=!empty($status)?" WHERE status = ".$db->quote($status):"";

		$title=!empty($title)?" AND title LIKE ".$db->quote($title."%"):"";

		$parent=!empty($parent)?" AND parent_id = ".$db->quote($parent):"";

		$q = "SELECT * FROM ".DB_PREFIX."content $status $title $parent ORDER BY created DESC".$limit;

		$res =  $db->executeQuery( $q );

		return $res;
	}
	
	function getAllContents($status=NULL){
		

		$db=Core_Lib_Database::getDatabase();
		
		$status=isset($status)?" WHERE status = ".$db->quote($status):"";
		
		$q = "SELECT * FROM ".DB_PREFIX."content $status ORDER BY created DESC";
		
		$res =  $db->executeQuery( $q );
		
		return $res;
		
	}
	
	function getParentContents($parentId)
	{
	
		$db=Core_Lib_Database::getDatabase();
		
		$parent=!empty($parentId)?" WHERE parent_id = ".$db->quote($parentId):"";
	
		$q = "SELECT * FROM ".DB_PREFIX."content $parent ORDER BY created DESC";
	
		$res =  $db->executeQuery( $q );
	
		return $res;
	}

	function getTypeIdByTitle( $title )
	{
		$db=Core_Lib_Database::getDatabase();

		$q = "SELECT id FROM content WHERE title = ".$db->quote($title);

		$res =  $db-> executeQuery( $q );

		if(empty($res))
			return false;
		else
			return $res['content_id'];
	}

	function getTypeTitle( $id )
	{
		$db = Core_Lib_Database::getDatabase();

		$q = "SELECT title FROM ".DB_PREFIX."content WHERE content_id = ".$db->quote($id);

		$res = $db -> query( $q );

		if(PEAR::isError($res))
			return false;
		else
			return $r['title'];
	}

	function getTypeStatus( $id )
	{
		$db = Core_Lib_Database::getDatabase();

		$q = "SELECT status FROM ".DB_PREFIX."content WHERE content_id = ".$db->quote($id);

		$res = $db -> query( $q );


		if(PEAR::isError($res))
			return false;
		else
			return $r['status'];
	}

	function setTypeStatus( $id )
	{
		$status = $this -> get_content_status( $id );

		$status = $status == 1 ? 0 : 1;

		$db=Core_Lib_Database::getDatabase();

		$q = "UPDATE content SET status = ".$status." WHERE content_id = ".$db->quote($id);

		$res =  $db-> query( $q );

		if(PEAR::isError($res))
			return false;
		else
			return true;
	}

	function addType( $data )
	{
		$db = Core_Lib_Database::getDatabase();

		$contents=array("text","integer","integer");

		$res=$db->insert("content",$data,$contents);

		if(PEAR::isError($res))
			return false;
		else
			return $res;
	}

	function updateType( $data, $content_id )
	{
		$db = Core_Lib_Database::getDatabase();

		$contents=array("text","integer","integer");

		$res=$db->update("content",$data,$contents,"content_id",$content_id);

		if(PEAR::isError($res))
			return false;
		else
			return $res;
	}


}