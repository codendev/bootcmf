<?php

class Taxonomy
{

	function getTaxonomy( $id, $status = 0 )
	{
		$criteria = $status == 1 ? "status = 1 AND " : "";
		
		$db=Database::getDatabase() -> query( $q );
		
		$q = "SELECT * FROM taxonomy WHERE ".$criteria." taxonomy_id = ".$db->quote($id);
		
		$res = $db->query($q);
		
		if(PEAR::isError($res))
            return false;
		else
			return $r;
	}	

	function getTaxonomies( $limit = "",$status=1)
	{
		$limit = $limit != "" ? " LIMIT 0, ".$limit : "";
		
		$db=Database::getDatabase();
		
		$q = "SELECT * FROM taxonomy WHERE status = ".$db->quote($status)." ORDER BY created DESC".$limit;
		
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
		
		$res =  $db-> query( $q );
		
		if(PEAR::isError($res))
            return false;
		else
			return $res['taxonomy_id'];
	}	

	function getTaxonomyTitle( $id )
	{
		$db = Database::getDatabase();
		
		$q = "SELECT title FROM taxonomy WHERE taxonomy_id = ".$db->quote($id);
		
		$res = $db -> query( $q );
		  
        if(PEAR::isError($res))
            return false;
		else
			return $r['title'];
	}	
	
	function getTaxonomyStatus( $id )
	{
		$db = Database::getDatabase();
		
		$q = "SELECT status FROM taxonomy WHERE taxonomy_id = ".$db->quote($id);
		
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

}
?>