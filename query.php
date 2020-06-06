<?php
    $db_connection = pg_connect("host=localhost port=5432 dbname=muslim_pro user=YOUR_DATABASE_USERNAME password=YOUR_PASSWORD");
	if($db_connection){
		echo $_GET["querytext"],"<br>";
		$result = pg_query($db_connection, $_GET["querytext"]);
		//echo $result;
		if($result){
			while ($row = pg_fetch_row($result)) {
				
				echo "Ayat: $row[0]";
				echo "<br />\n";   
			}
		}
		else{
			exit;
		}
	}
	else{
		echo "Couldn't connect to pgsql";
		exit;
	}
	
?>