<?php

	header("Content-type: text/plain"); 
    $username = "root"; 
    $password = "root";   
    $host = "localhost";
    $database="bio_puce";
     
    $tabla = $_GET['tabla'];
   

    $server = mysql_connect($host, $username, $password);
    if (!$server) {
   		 echo('Could not connect to database : ' . mysql_error());
    	 exit;
	}
	else{
		 //echo("server-good <br>\n");
	}
    $connection = mysql_select_db($database, $server);
    if (!$connection) {
   		 echo('Could not connect to database : ' . mysql_error());
    	 exit;
	}
	else{
		//echo("connection-good <br>\n");
	}



    $sql = "SHOW TABLES FROM $database LIKE '$tabla'";
    $result = mysql_query($sql);  
  	$json_str = '';
  	$data_result = array();

    while ($row = mysql_fetch_row($result)) {
   	    $myquery = "SELECT * FROM $row[0]";
    	$query = mysql_query($myquery);
    
	    // if ( ! $query ) {
	    //     echo mysql_error();
	    //     die;
	    // }
		    while($row_t = mysql_fetch_assoc($query))
		    {
		    	$data[] = array_map('utf8_encode',$row_t);
		    }
	        // $data_f = array($row[0] => $data);
	        $data_result = $data;
	}	
	 
	$json_str = json_encode($data_result, JSON_PRETTY_PRINT) ;

	echo $json_str;
    
    // $myquery = "SELECT * FROM $row[0]";
    // 	$query = mysql_query($myquery);
    
	   //  if ( ! $query ) {
	   //      echo mysql_error();
	   //      die;
	   //  }
    
    // $data = array();
    // while($row = mysql_fetch_assoc($query))
    // {
    // 	$data[] = array_map('utf8_encode',$row);
    //     //$data[] = $row;
    // }
    // $data_f = array("cantones" => $data);
    // $json_str = json_encode($data_f,  JSON_FORCE_OBJECT|JSON_PRETTY_PRINT) ;
    // echo $json_str;

     
    mysql_close($server);
?>