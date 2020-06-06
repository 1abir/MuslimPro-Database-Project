<?php
	$db_connection = pg_connect("host=localhost port=5432 dbname=postgres user=YOUR_DATABASE_USERNAME password=YOUR_PASSWORD");
	if($db_connection){
		$result = pg_query($db_connection, $_GET["querytext"]);
		if($result){
			if($row = pg_fetch_row($result)){
				
				if($row[0]){
					echo '<html lang="en">',"\n";
    echo '<head>',"\n";
		echo '<title>Muslim Pro</title>',"\n";
		echo '<link rel="stylesheet" href="form.css" >',"\n";
    echo '</head>',"\n";
	echo '<body>',"\n";
	    echo '<audio controls>',"\n";
	    echo '<source src= "',$row[0], '" type="audio/mpeg">',"\n";
	    echo 'Your browser does not support the audio element.',"\n";
	    echo '</audio>',"\n";
   echo '</body>',"\n";
 echo '</html>',"\n";
				}
			}
		}
	}
?>