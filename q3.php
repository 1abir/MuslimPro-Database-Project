<?php
$db_connection = pg_connect("host=localhost port=5432 dbname=postgres user=YOUR_DATABASE_USERNAME password=YOUR_PASSWORD");
	if($db_connection){
		ob_start();
		readfile("query.html");
		$html_code = ob_get_clean();
				echo $html_code;
		$result = pg_query($db_connection, $_GET["querytext"]);
		//echo $result;
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
							echo '<td style="padding:5px" valign="top">',$arrayItem,'</td>';
						}
				echo('</tr>');						
			}
			echo('</table>');
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
