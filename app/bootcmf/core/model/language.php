<?php
class Core_Model_Language
{

	function getLanguage( $id, $status = null )
	{
		$criteria = isset($status) ? "status = $status AND " : "";

		$db=Core_Lib_Database::getDatabase();

		$q = "SELECT * FROM ".DB_PREFIX."language WHERE ".$criteria." language_id = ".$db->quote($id);

		$res =  $db->executeQuery( $q );

		if(empty($res))
			return false;
		else
			return $res[0];
	}

	function getLanguages($title="",$iso6391="",$iso6392="",$status="",$offset="",$num="")
	{

		$db=Core_Lib_Database::getDatabase();

		$limit = !empty($num) ? " LIMIT ".$db->quote($offset).", ".$db->quote($num) : "";
		
		$status=!empty($status)?" WHERE status = ".$db->quote($status):" WHERE 1=1 ";

		$title=!empty($title)?" AND title LIKE ".$db->quote($title."%"):"";

		$iso6391=!empty($iso6392)?" AND iso6391 = ".$db->quote($iso6391):"";
		
		$iso6392=!empty($iso6392)?" AND iso6392 = ".$db->quote($iso6392):"";
		
		$q = "SELECT * FROM ".DB_PREFIX."language $status $iso6391 $iso6392 ORDER BY created DESC".$limit;

		$res =  $db->executeQuery( $q );

		return $res;
	}
	
	function getParentLanguages($parentId)
	{
	
		$db=Core_Lib_Database::getDatabase();
		
		$parent=!empty($parentId)?" WHERE parent_id = ".$db->quote($parentId):"";
	
		$q = "SELECT * FROM ".DB_PREFIX."language $parent ORDER BY created DESC";
	
		$res =  $db->executeQuery( $q );
	
		return $res;
	}

	function getLanguageIdByTitle( $title )
	{
		$db=Core_Lib_Database::getDatabase();

		$q = "SELECT id FROM language WHERE title = ".$db->quote($title);

		$res =  $db-> executeQuery( $q );

		if(empty($res))
			return false;
		else
			return $res['language_id'];
	}

	function getLanguageTitle( $id )
	{
		$db = Core_Lib_Database::getDatabase();

		$q = "SELECT title FROM ".DB_PREFIX."language WHERE language_id = ".$db->quote($id);

		$res = $db -> query( $q );

		if(PEAR::isError($res))
			return false;
		else
			return $r['title'];
	}

	function getLanguageStatus( $id )
	{
		$db = Core_Lib_Database::getDatabase();

		$q = "SELECT status FROM ".DB_PREFIX."language WHERE language_id = ".$db->quote($id);

		$res = $db -> query( $q );


		if(PEAR::isError($res))
			return false;
		else
			return $r['status'];
	}

	function setLanguageStatus( $id )
	{
		$status = $this -> get_language_status( $id );

		$status = $status == 1 ? 0 : 1;

		$db=Core_Lib_Database::getDatabase();

		$q = "UPDATE language SET status = ".$status." WHERE language_id = ".$db->quote($id);

		$res =  $db-> query( $q );

		if(PEAR::isError($res))
			return false;
		else
			return true;
	}

	function addLanguage( $data )
	{
		$db = Core_Lib_Database::getDatabase();

		$languages=array("text","text","text","integer");

		$res=$db->insert("language",$data,$languages);

		if(PEAR::isError($res))
			return false;
		else
			return $res;
	}

	function updateLanguage( $data, $language_id )
	{
		$db = Core_Lib_Database::getDatabase();

		$languages=array("text","text","text","integer");

		$res=$db->update("language",$data,$languages,"language_id",$language_id);

		if(PEAR::isError($res))
			return false;
		else
			return $res;
	}


}