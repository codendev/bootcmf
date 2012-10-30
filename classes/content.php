<?php

class Content
{

	function getContentInfo( $id, $status = 0 )
	{
		$criteria = $status == 1 ? "status = 1 AND " : "";
		$q = "SELECT * FROM content WHERE ".$criteria." id = ".$id;
		$r = Database::getDatabase() -> query( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	//	End of function get_content_info( $id, $status = 0 )

	function getContentSeo( $sef_link=null,$status=0 )
	{
		$criteria = $status == 1 ? "status = 1 AND " : "";
		$q = "SELECT * FROM content WHERE ".$criteria." sef_link='".$sef_link."'";
		$r = Database::getDatabase() -> query( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	

	function getActiveContent( $limit = "" )
	{
		$limit = $limit != "" ? " LIMIT 0, ".$limit : "";
		$q = "SELECT * FROM content WHERE status = 1 ORDER BY created DESC".$limit;
		$r = Database::getDatabase() -> query( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	

	function getAllInactive_content( $limit = "" )
	{
		$limit = $limit != "" ? " LIMIT 0, ".$limit : "";
		$q = "SELECT * FROM content WHERE status = 0 ORDER BY created DESC".$limit;
		$r = Database::getDatabase() -> query( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	

	function getAllContent( $limit = "" )
	{
		$limit = $limit != "" ? " LIMIT 0, ".$limit : "";
		$q = "SELECT * FROM content ORDER BY created DESC".$limit;
		$r = Database::getDatabase() -> query( $q );
		if( $r != false )
			return $r;
		else
			return false;
	}	

	function getContentIdByTitle( $title )
	{
		$q = "SELECT id FROM content WHERE title = '".$title."'";
		$r = Database::getDatabase() -> query( $q );
		if( $r != false )
			return $r['id'];
		else
			return false;
	}	

	function getContentTitle( $id )
	{
		$q = "SELECT title FROM content WHERE id = ".$id;
		$r = Database::getDatabase() -> query( $q );
		if( $r != false )
			return $r['title'];
		else
			return false;
	}	//	End of function get_content_title( $id )

	function getContentText( $id )
	{
		$q = "SELECT text FROM content WHERE id = ".$id;
		$r = Database::getDatabase() -> query( $q );
		if( $r != false )
			return $r['text'];
		else
			return false;
	}	

	function getContentStatus( $id )
	{
		$q = "SELECT status FROM content WHERE id = ".$id;
		$r = Database::getDatabase() -> query( $q );
		if( $r != false )
			return $r['status'];
		else
			return false;
	}	

	function setContentStatus( $id )
	{
		$status = $this -> get_content_status( $id );
		$status = $status == 1 ? 0 : 1;
		$q = "UPDATE content SET status = ".$status." WHERE id = ".$id;
		$r = Database::getDatabase() -> execute( $q );
		if( $r != false )
			return true;
		else
			return false;
	}
	function gettaxonomyText( $id )
	{
		$db = Database::getDatabase();
	
		$q = "SELECT content FROM taxonomy WHERE taxonomy_id = ".$db->quote($id);
	
		$r = $db -> query( $q );
	
		if(PEAR::isError($res))
			return false;
		else
			return $r['content'];
	}
	

}
?>