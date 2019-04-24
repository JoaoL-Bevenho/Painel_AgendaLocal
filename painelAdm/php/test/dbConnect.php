 <?php
	$servername = "localhost:3306";
	$username = "root";
	$password = "drfsewa201456M";
	$database = "dbarduinodrip";
	
	$connection = new mysqli($servername, $username, $password, $database);
	
	if ($connection->connect_error)
	{ die("Falha na conexão: " . $connection->connect_error); }
	else
	{ echo "MYSQL CONNECTOR: Conexão feita com sucesso."; }
?> 
