<?php class DBQuery
{
	 
    public function executeQuery($query, $connectionParams)
    {
    	$result = array();
    	
    	$dbLink = $this->connect($connectionParams['host'], $connectionParams['username'], $connectionParams['password'], $connectionParams['database']);
    	
    	$resource = mysql_query($query, $dbLink) or die(mysql_error());
    	$numFields = mysql_num_fields($resource);

		while($row = mysql_fetch_array($resource, MYSQL_ASSOC))
		{
		   $aRow = array();
		   
		   for($i=0; $i<$numFields; $i++)
		   {
		   		$fieldName = mysql_field_name($resource, $i);
		   		$aRow[$fieldName] = $row[$fieldName];
		   }
		   
		   array_push($result, $aRow);
		}
		
		mysql_free_result($resource);
		
		$this->close($dbLink);
		
		return $result;
    }
    
    public function executeNonQuery($query, $connectionParams)
    {
		$dbLink = $this->connect($connectionParams['host'], $connectionParams['username'], $connectionParams['password'], $connectionParams['database']);

		mysql_query($query, $dbLink);
		$newId = mysql_insert_id();
		
		$this->close($dbLink);

		return $newId;
	}
	
    private function connect($host, $username, $password, $database)
    {
        $dbLink = mysql_connect($host, $username, $password);
        mysql_select_db($database, $dbLink);
        
        return $dbLink;
    }
    
    private function close($dbLink)
    { 
            return mysql_close($dbLink); 
    }
}
?>