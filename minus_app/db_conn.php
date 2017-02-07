<?php
function getConn()
{
	$link = mysql_connect('localhost', 'root');
	if (!$link) {
	    die('Not connected : ' . mysql_error());
	}

	$db_selected = mysql_select_db('minus_app_db', $link);
	
	if (!$db_selected) {
	    die ('Erro ao conectar em minus_app_db : ' . mysql_error());
	}

}

?>

<!DOCTYPE html>
<html>
<head>
<title> - App</title>
</head>
<body>

<h1>- APP</h1>
<p></p>
<form action="index.php" method="post">
	User Name <input type="text" name="UserName"/>
	<button name="btn-submit" type="submit">Postar</button>
</form>
</body>
</html>
