<!DOCTYPE html>
<html>
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
		
		$result = pg_query($db_connection, 'select get_quibla_direction('.$id.');');
		if($result){
			$dis =pg_fetch_result($result, 0,0);
						
			echo '<h1>The Quibla is in  the ',$dis,' degree clockwise from north</h1>';
		}
	}
	else{
		echo "Couldn't connect to pgsql";
		exit;
	}

?>
	
    </body>
</html>