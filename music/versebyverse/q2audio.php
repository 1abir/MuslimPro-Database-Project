<?php
function endsWith($string, $endString) 
{ 
    $len = strlen($endString); 
    if ($len == 0) { 
        return false; 
    } 
    return (substr($string, -$len) === $endString); 
} 
		echo '<html lang="en">',"\n";
		echo '<head>',"\n";
		echo '<title>Muslim Pro</title>',"\n";
		echo '<link rel="stylesheet" href="form.css" >',"\n";
		echo '</head>',"\n";
		echo '<body>',"\n";
	$db_connection = pg_connect("host=localhost port=5432 dbname=postgres user=YOUR_DATABASE_USERNAME password=YOUR_PASSWORD");
	if($db_connection){
		$result = pg_query($db_connection, $_GET["querytext"]);
		if($result){
			echo('<table border="1" bgcolor="#EAF9FF">');
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
									echo '<td style="padding:5px">';
									if(endsWith($arrayItem,'.mp3')!==false)
									{
										echo '<audio controls>',"\n";
										echo '<source src= "',$arrayItem, '" type="audio/mpeg">',"\n";
										echo 'Your browser does not support the audio element.',"\n";
										echo '</audio>',"\n";
									}
									
									else{
										echo $arrayItem;
									}
									echo '</td>';
						}
				echo('</tr>');						
			}
			echo('</table>');
			}
		}
		echo '</body>',"\n";
		echo '</html>',"\n";
		/*echo '<audio controls>',"\n";
	    echo '<source src= "',$row[0], '" type="audio/mpeg">',"\n";
	    echo 'Your browser does not support the audio element.',"\n";
	    echo '</audio>',"\n";*/
?>