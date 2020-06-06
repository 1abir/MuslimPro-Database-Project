<?php
$db_connection = pg_connect("host=localhost port=5432 dbname=postgres user=YOUR_DATABASE_USERNAME password=YOUR_PASSWORD");
	if($db_connection){
		ob_start();
		readfile("query.html");
		$html_code = ob_get_clean();
				echo $html_code;
		$string = $_GET["querytext"];
		$result = pg_query($db_connection, $string);
		echo '<h1> Your Jakat : ', pg_fetch_result($result,0,0),"\n";
		$filteredNumbers = array_filter(preg_split("/\D+/", $string));
		$firstOccurence = reset($filteredNumbers);
		echo '<h1>Your Jakat History</h1>',"\n";
		$result = pg_query($db_connection,'select * from jakat where user_id='.$firstOccurence.' order by year;');
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
							echo '<td style="padding:5px">',$arrayItem,'</td>';
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
			exit;
		}

?>
