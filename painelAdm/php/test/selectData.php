<?php
require_once 'dbConnect.php';

$response = array();

if(isTheseParametersAvailable(array('table')))
{
	$table = $_POST['table'];

	$sqlStmtSelectSexo = "SELECT * FROM ".$table;
	if($resultSelectSexo = mysqli_query($connection, $sqlStmtSelectSexo))
	{
		while($r = mysqli_fetch_assoc($resultSelectSexo))
		{
		    $response[] = $r;
		}
	}
	else
	{
		$response['error'] = true; 
		$response['message'] = 'RETURN QUERY ERROR('.$table.')';
	}
}
else
{
	$response['error'] = true; 
	$response['message'] = 'PARAMETROS REQUIRIDOS NAO ENCONTRADOS';
}

echo json_encode($response);

function isTheseParametersAvailable($params)
{

//traversing through all the parameters 
foreach($params as $param)
{
//if the paramter is not available
if(!isset($_POST[$param]))
{
//return false 
return false; 
}
}
//return true if every param is available 
return true; 
}
?>