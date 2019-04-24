<?php
// //Get cURL resource

// echo "old Data <br/>";
// echo "_________________________________________________________________________________<br/>";
// $curl = curl_init();
// // Set some options - we are passing in a useragent too here
// curl_setopt_array($curl, array(
//     CURLOPT_RETURNTRANSFER => 1,
//     CURLOPT_URL => 'https://servicodados.ibge.gov.br/api/v1/localidades/estados',
// ));
// // Send the request & save response to $resp
// $resp = curl_exec($curl);
// // Close request to clear up some resources
// curl_close($curl);
// $resp_array = json_decode($resp, true);
// print_r($resp_array);
// echo "<br/>";
// echo "---------------------------------------------------------------------------------<br/><br/>";

// echo "new Data<br/><br/>";
// echo "_________________________________________________________________________________<br/>";
// $json = file_get_contents('https://servicodados.ibge.gov.br/api/v1/localidades/estados');
// $data = json_decode($json, TRUE);
// //print_r($data);
// foreach ($data as &$json_array)
// {

// 	echo "RETURNED ";
// 	print_r($json_array['nome']);
// 	echo "<br/>";
// }
// echo "<br/>";
// echo "---------------------------------------------------------------------------------<br/><br/>";

// echo "new Data Sorted<br/><br/>";
// echo "_________________________________________________________________________________<br/>";
// $json = file_get_contents('https://servicodados.ibge.gov.br/api/v1/localidades/estados');
// $data = json_decode($json, TRUE);
// //print_r($data);
// foreach ($data as &$json_array)
// {
	
// 	echo "RETURNED ";
// 	print_r($json_array['regiao']['id']);
// 	print_r($json_array['regiao']['nome']);

// 	echo "<br/>";
// }
// echo "<br/>";
// echo "---------------------------------------------------------------------------------<br/>";

	// $uf = 'PR';

	// $jsonEstadoGET = file_get_contents('https://servicodados.ibge.gov.br/api/v1/localidades/estados');
	// $jsonEstadoDATA = json_decode($jsonEstadoGET, TRUE);
	// foreach ($jsonEstadoDATA as $jsonData)
	// {
	// 	$ESTADOID = $jsonData['id'];
	// 	$ESTADOSIGLA = $jsonData['sigla'];
	// 	$ESTADONOME = $jsonData['nome'];
	// 	$REGIAOID = $jsonData['regiao']['id'];
	// 	$REGIAOSIGLA = $jsonData['regiao']['sigla'];
	// 	$REGIAONOME = $jsonData['regiao']['nome'];
	// 	if($jsonData['sigla'] == $uf)
	// 	{
			
	// 		echo $ESTADOID.", ".$ESTADOSIGLA.", ".$ESTADONOME."<br/>";
	// 		echo $REGIAOID.", ".$REGIAOSIGLA.", ".$REGIAONOME."<br/>";
	// 	}
	// 	else
	// 	{

	// 		echo "NO MATCH ON ".$ESTADOID.", ".$ESTADOSIGLA.", ".$ESTADONOME."<br/>";
			
	// 	}
	// }]
	$cep = 86072390;
	$jsonEnderecoGET = file_get_contents('https://viacep.com.br/ws/'.$cep.'/json/');
	$jsonEnderecoDATA = json_decode($jsonEnderecoGET, TRUE);
	echo "<br/><br/>ENDERECO<br/>";
	print_r($jsonEnderecoDATA);
	$CIDADE_ESTADOID = $jsonEnderecoDATA['ibge'];
	
	$jsonCidade_EstadoGET = file_get_contents('https://servicodados.ibge.gov.br/api/v1/localidades/municipios/'.$CIDADE_ESTADOID);
	$jsonCidade_EstadoDATA = json_decode($jsonCidade_EstadoGET, TRUE);
	echo "<br/><br/>CIDADE_ESTADO<br/>";
	print_r($jsonCidade_EstadoDATA);
	echo "<br/><br/>MICRORREGIAO<br/>";
	print_r($jsonCidade_EstadoDATA['microrregiao']);
	echo "<br/><br/>MESORREGIAO<br/>";
	print_r($jsonCidade_EstadoDATA['microrregiao']['mesorregiao']);
	echo "<br/><br/>ESTADO<br/>";
	print_r($jsonCidade_EstadoDATA['microrregiao']['mesorregiao']['UF']);
	echo "<br/><br/>REGIAO<br/>";
	print_r($jsonCidade_EstadoDATA['microrregiao']['mesorregiao']['UF']['regiao']);
	date_default_timezone_set('America/Sao_Paulo');
	echo "<br/><br/>TODAYS DATE<br/>";
	echo date("d/m/Y");
	echo "<br/><br/>TODAYS DATE LONG<br/>";
	echo date("dmY");
	echo "<br/><br/>TODAYS DATE LONG BACK TO DATE<br/>";
	$dateToday = date("dmY");
	echo $dateToday."<br/>";
	$dateStr = (string)$dateToday;
	echo $dateStr."<br/>";
	$datesplit = str_split($dateStr, 2);
	print_r($datesplit);
	echo $datesplit[2].$datesplit[3];
	$timestamp = strtotime($dateStr);
	echo $timestamp."<br/>";
	echo $cep.date("dmY");
	// $date = new DateTime($dateStr);
	// echo date('d-m-Y H:i:s', $date);

?>