<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Muslim Pro</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        
        <link rel="stylesheet" href="back.css" >
		</head>
		<body>
		<?php
$db_connection = pg_connect("host=localhost port=5432 dbname=postgres user=YOUR_DATABASE_USERNAME password=YOUR_PASSWORD");
	if($db_connection){
		$id = $_GET["querytext"];
		
		$result = pg_query($db_connection, 'select nearest_restaurent_distance('.$id.')');
		if($result){
			$dis =pg_fetch_result($result, 0,0);
			$res=pg_query($db_connection, 'select nearest_restaurent('.$id.')');
			$mid= pg_fetch_result($res,0,0);
			echo '<h3>The nearest Restaurent is ',$dis,' meter ahead',"</h3>";
			
			$use='SELECT longitude,latitude FROM users INNER JOIN "location"ON users.location_id="location".id WHERE users.id = '.$id.';';
			$res=pg_query($db_connection, $use);
			$lon1= pg_fetch_result($res,0,0);
			$lat1= pg_fetch_result($res,0,1);
			$use='SELECT longitude,latitude FROM restaurents INNER JOIN "location"ON restaurents.location_id="location".id WHERE restaurents.id = '.$mid.';';
			$res=pg_query($db_connection, $use);
			$lon2= (float)pg_fetch_result($res,0,0);
			$lat2= (float)pg_fetch_result($res,0,1);
			
			$result = pg_query($db_connection, 'select get_degree('.$lon1.','.$lat1.','.$lon2.','.$lat2.');');
			$dis =pg_fetch_result($result, 0,0);
			
			echo '<h3>The nearest restaurent is in  the ',$dis,' degree clockwise from north</h3>';
			$result = pg_query($db_connection, 'select get_direction('.$lon1.','.$lat1.','.$lon2.','.$lat2.');');
			$dis =pg_fetch_result($result, 0,0);
			
			//echo '<h3>The nearest restaurent is in  the ',$dis,' direction</h3>';
			
			$links= 'https://www.google.com/maps/dir/?api=1&origin='.$lat1.','.$lon1.'&destination='.$lat2.','.$lon2.'&travelmode=walking&key=YOUR_API_KEY/';
			//echo "\n",$links,"\n";
		
		echo '<h1>Details About Restaurent</h1>';
		$use='SELECT * FROM restaurents INNER JOIN "location"ON restaurents.location_id="location".id WHERE restaurents.id = '.$mid.';';
		$result=pg_query($db_connection, $use);
		
		if($result){			
			echo('<table border="1">');
			$i = pg_num_fields($result);
			echo('<tr>');
			for ($j = 0; $j < $i; $j++) {
			    $fieldname = pg_field_name($result, $j);
			    echo '<th style="padding:10px">',$fieldname,'</th>';
			}
			echo('</tr>');
			while ($row = pg_fetch_row($result)) {
				echo('<tr>');
				foreach ($row as $arrayItem) {
							echo '<td style="padding:5px">',$arrayItem,'</td>';
						}
				echo('</tr>');						
			}
			echo('</table>');
		}

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		if($id==1)
		{$links= 'https://www.google.com/maps/dir/Electrical+and+Computer+Engineering+Building,+Azimpur+Road,+Dhaka/BUET+Del+Cafe,+Dhaka/@23.7266182,90.3889733,18z/data=!3m1!4b1!4m14!4m13!1m5!1m1!1s0x3755b8db5185c0dd:0xfe1ba7c1b37e1b74!2m2!1d90.3882859!2d23.7266249!1m5!1m1!1s0x3755b8dcd7d2e5d3:0xc7c45075a078b803!2m2!1d90.3912878!2d23.7265243!3e2';}
		/*echo '<form action="',$links,'" method="get" target="_blank">';
         echo '<button type="submit">See Direction on Google Maps</button>';
        echo '</form>';*/
		}
		else{
			echo 'failed';
		}
	
	}
	else{
		echo "Couldn't connect to pgsql";
		exit;
	}

?>
	
    </body>
</html>