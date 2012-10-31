<?php

class Taxonomy
{

	function getTaxonomy( $id, $status = null )
	{
		$criteria = isset($status) ? "status = $status AND " : "";

		$db=Database::getDatabase();

		$q = "SELECT * FROM ".DB_PREFIX."taxonomy WHERE ".$criteria." taxonomy_id = ".$db->quote($id);

		$res =  $db->executeQuery( $q );

		if(empty($res))
			return false;
		else
			return $res[0];
	}

	function getTaxonomies( $limit = "",$status=NULL)
	{
		$limit = $limit != "" ? " LIMIT 0, ".$limit : "";

		$db=Database::getDatabase();

		$status=isset($status)?"WHERE status = ".$db->quote($status):"";

		$q = "SELECT * FROM ".DB_PREFIX."taxonomy $status ORDER BY created DESC".$limit;

		$res =  $db->executeQuery( $q );

		if(PEAR::isError($res))
			return false;
		else
			return $res;
	}

	function getTaxonomyIdByTitle( $title )
	{
		$db=Database::getDatabase();

		$q = "SELECT id FROM taxonomy WHERE title = ".$db->quote($title);

		$res =  $db-> executeQuery( $q );

		if(empty($res))
			return false;
		else
			return $res['taxonomy_id'];
	}

	function getTaxonomyTitle( $id )
	{
		$db = Database::getDatabase();

		$q = "SELECT title FROM ".DB_PREFIX."taxonomy WHERE taxonomy_id = ".$db->quote($id);

		$res = $db -> query( $q );

		if(PEAR::isError($res))
			return false;
		else
			return $r['title'];
	}

	function getTaxonomyStatus( $id )
	{
		$db = Database::getDatabase();

		$q = "SELECT status FROM ".DB_PREFIX."taxonomy WHERE taxonomy_id = ".$db->quote($id);

		$res = $db -> query( $q );


		if(PEAR::isError($res))
			return false;
		else
			return $r['status'];
	}

	function setTaxonomyStatus( $id )
	{
		$status = $this -> get_taxonomy_status( $id );

		$status = $status == 1 ? 0 : 1;

		$db=Database::getDatabase();

		$q = "UPDATE taxonomy SET status = ".$status." WHERE taxonomy_id = ".$db->quote($id);

		$res =  $db-> query( $q );

		if(PEAR::isError($res))
			return false;
		else
			return true;
	}

	function addTaxonomy( $data )
	{
		$db = Database::getDatabase();

		$types=array("text","integer","integer");
		
		$res=$db->insert("taxonomy",$data,$types);
	
		if(PEAR::isError($res))
			return false;
		else
			return $res;
	}

	function updateTaxonomy( $data, $taxonomy_id )
	{
		$db = Database::getDatabase();
	
		$types=array("text","integer","integer");
		
		$res=$db->update("taxonomy",$data,$types,"taxonomy_id",$taxonomy_id);
	
		if(PEAR::isError($res))
			return false;
		else
			return $res;
	}



}
?>