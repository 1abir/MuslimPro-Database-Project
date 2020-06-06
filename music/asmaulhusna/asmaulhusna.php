<?php
	$db_connection = pg_connect("host=localhost port=5432 dbname=postgres user=YOUR_DATABASE_USERNAME password=YOUR_PASSWORD");
	if($db_connection){
		$result = pg_query($db_connection, $_GET["querytext"]);
		if($result){
			echo '<html lang="en">',"\n";
    echo '<head>',"\n";
		echo '<title>Muslim Pro</title>',"\n";
    echo '</head>',"\n";
	echo '<body>',"\n";
	echo '<table border="1">';
	echo '<tr> <b> <td> No.</td><td>Asma ul Husna<td>Transliteration</td><td>Meaning</td><td>Explaination</td><td>Bangla Transliteration</td><td>Bangla Meaning</td><td>Audio</td></tr>';
	while($row = pg_fetch_row($result)){
		echo '<tr>';
		$i=0;
		foreach ($row as $arrayItem) {
			$i=$i+1;
			if($i==count($row)-1){
				break;
			}
			echo '<td>',$arrayItem,'</td>';
		}
		if(count($row)){
			echo '<td>';
			echo '<audio controls>',"\n";
			echo '<source src= "',$row[count($row)-1], '" type="audio/mpeg">',"\n";
			echo 'Your browser does not support the audio element.',"\n";
			echo '</audio>',"\n";
			echo '</td>';
		}
		echo '</tr>';
	}
 echo'</table>';
 echo '</body>',"\n";
 echo '</html>',"\n";
				}
			}
?>