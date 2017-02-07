<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/icon.png">
<title> - App</title>
</head>
<body>


<?php

echo 'Versão Atual do PHP: ' . phpversion();

$conn = mysql_connect('localhost', 'root');
if (!$conn) {
    die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db('minus_app_db', $conn);
if (!$db_selected) {
    die ('Erro ao conectar em minus_app_db : ' . mysql_error());
}

$isPost = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($isPost) {
	
	$userId = $_POST['Id'];
	$latitude = $_POST['Latitude'];
	$longitude = $_POST['Longitude'];
		
	$sql = "INSERT INTO Register (Date, UserId, Latitude, Longitude) values (
		NOW(), $userId, $latitude, $longitude)";
		
	if (mysql_query($sql)) {
		echo "Registro inserido com seucesso!";
	} 
	else {
		echo "Ocorreu um erro ao salvar o registro : " . $sql . "<br>" . mysql_error($conn);
	}
}

?>



<h1>Registros hr/lugar:</h1>

<table border="1">
<tr>
	<th>Id</th>
	<th>User</th>
	<th>Data</th>
	<th>Latitude</th>
	<th>Longitude</th>
</tr>
	<?php	
		$query = "SELECT  reg.Id, user.Name, reg.Date, reg.Latitude, reg.Longitude  
		FROM REGISTER reg 
		INNER JOIN User user on reg.UserId = user.Id";
		$result = mysql_query($query);
				
		//JSON 
		// $sth = mysql_query($query);
		// $rows = array();
		// while($r = mysql_fetch_assoc($sth)) {
			// $rows[] = $r;
		// }
		// print json_encode($rows);	
		//FIM JSON
		
		echo"</br>";				
		
		if (empty($result)) { 
			echo 'Nenhum resultado encontrado'; 
		}
		else
		{
			while( $row = mysql_fetch_assoc($result)){
				
				$date = $row["Date"];
				$dateToday = IsDateToday($date);				
				$styleToday = IsDateToday($date) ? "style='background-color:#1E90FF;'" : "";
				
				echo "<tr $styleToday>";
				
				echo "<td>".$row["Id"]."</td>";
				echo "<td>".$row["Name"]."</td>";								
				echo "<td>".$date."</td>";
				echo "<td>".$row["Latitude"]."</td>";
				echo "<td>".$row["Longitude"]."</td>";
				
				echo "</tr>";
			}		
		}
		
		function  IsDateToday($dateToValidate){			
			$currentDateTime = date('d/m/y');			
			$time = strtotime($dateToValidate);
			$myFormatForView = date("d/m/y" , $time);			 
			 if($myFormatForView == $currentDateTime)
				 return true;			 
			 return false;
		}		
	?>
</table>

</body>
</html>





