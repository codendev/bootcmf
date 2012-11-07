<?php
class Type
{

	function getType( $id, $status = null )
	{
		$criteria = isset($status) ? "status = $status AND " : "";

		$db=Database::getDatabase();

		$q = "SELECT * FROM ".DB_PREFIX."type WHERE ".$criteria." type_id = ".$db->quote($id);

		$res =  $db->executeQuery( $q );

		if(empty($res))
			return false;
		else
			return $res[0];
	}

	function getTypes($title="",$parent="",$status="",$offset="",$num="")
	{

		$db=Database::getDatabase();

		$limit = !empty($num) ? " LIMIT ".$db->quote($offset).", ".$db->quote($num) : "";
		
		$status=!empty($status)?" WHERE status = ".$db->quote($status):"";

		$title=!empty($title)?" AND title LIKE ".$db->quote($title."%"):"";

		$parent=!empty($parent)?" AND parent_id = ".$db->quote($parent):"";

		$q = "SELECT * FROM ".DB_PREFIX."type $status $title $parent ORDER BY created DESC".$limit;

		$res =  $db->executeQuery( $q );

		return $res;
	}
	
	function getParentTypes($parentId)
	{
	
		$db=Database::getDatabase();
		
		$parent=!empty($parentId)?" WHERE parent_id = ".$db->quote($parentId):"";
	
		$q = "SELECT * FROM ".DB_PREFIX."type $parent ORDER BY created DESC";
	
		$res =  $db->executeQuery( $q );
	
		return $res;
	}

	function getTypeIdByTitle( $title )
	{
		$db=Database::getDatabase();

		$q = "SELECT id FROM type WHERE title = ".$db->quote($title);

		$res =  $db-> executeQuery( $q );

		if(empty($res))
			return false;
		else
			return $res['type_id'];
	}

	function getTypeTitle( $id )
	{
		$db = Database::getDatabase();

		$q = "SELECT title FROM ".DB_PREFIX."type WHERE type_id = ".$db->quote($id);

		$res = $db -> query( $q );

		if(PEAR::isError($res))
			return false;
		else
			return $r['title'];
	}

	function getTypeStatus( $id )
	{
		$db = Database::getDatabase();

		$q = "SELECT status FROM ".DB_PREFIX."type WHERE type_id = ".$db->quote($id);

		$res = $db -> query( $q );


		if(PEAR::isError($res))
			return false;
		else
			return $r['status'];
	}

	function setTypeStatus( $id )
	{
		$status = $this -> get_type_status( $id );

		$status = $status == 1 ? 0 : 1;

		$db=Database::getDatabase();

		$q = "UPDATE type SET status = ".$status." WHERE type_id = ".$db->quote($id);

		$res =  $db-> query( $q );

		if(PEAR::isError($res))
			return false;
		else
			return true;
	}

	function addType( $data )
	{
		$db = Database::getDatabase();

		$types=array("text","integer","integer");

		$res=$db->insert("type",$data,$types);

		if(PEAR::isError($res))
			return false;
		else
			return $res;
	}

	function updateType( $data, $type_id )
	{
		$db = Database::getDatabase();

		$types=array("text","integer","integer");

		$res=$db->update("type",$data,$types,"type_id",$type_id);

		if(PEAR::isError($res))
			return false;
		else
			return $res;
	}


}
?>