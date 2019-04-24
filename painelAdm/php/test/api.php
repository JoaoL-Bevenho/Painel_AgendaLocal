<?php 
require_once 'dbConnect.php';

$response = array();

if(isset($_GET['apicall']))
{
switch($_GET['apicall'])
{
case 'cadastro':
if(isTheseParametersAvailable(array('cpf','pnome','snome','datanasc', 'email', 'telefone', 'sexo', 'cep', 'logradouro', 'complemento', 'bairro', 'unidade', 'ibge', 'gia', 'numero', 'tipoendereco', 'usuario', 'senha' , 'tipologin')))
{
//PESSOA
$cpf = $_POST['cpf'];
$pnome = $_POST['pnome'];
$snome = $_POST['snome'];
$datanasc = $_POST['datanasc'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$sexo = $_POST['sexo'];
$sexoId = $_POST['sexo']; //somente para definir a variavel
//PESSOA

//ENDERECO
//Trazido da Pagina ao digitar o cep. Consulta o API $jsonEnderecoCepGET = file_get_contents('https://viacep.com.br/ws/'.$cep.'/json/'); $jsonEnderecoCepDATA = json_decode($jsonEnderecoCepGET, TRUE);
$cep = $_POST['cep'];
$logradouro = $_POST['logradouro']; //RUA
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$unidade = $_POST['unidade'];
$ibge = $_POST['ibge'];
$gia = $_POST['gia'];
$numero = $_POST['numero'];
$tipoendereco = $_POST['tipoendereco'];
$tipoenderecoId = $_POST['tipoendereco']; //somente para definir a variavel
//ENDERECO

//USUARIO
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$tipologin = $_POST['tipologin'];
$tipologinId = $_POST['tipologin']; //somente para definir a variavel
//USUARIO

//Verificar se existe Pessoa/Usuario
$sqlstmtSelectLoginCheck= "SELECT `CPF`, `EMAIL`, `LOGIN` FROM pessoa, usuario WHERE pessoa.`CPF` =".$cpf."  OR pessoa.`EMAIL` = '".$email."' OR usuario.`LOGIN` = '".$usuario."'";
if($resultSelectLoginCheck = $connection->prepare($sqlstmtSelectLoginCheck))
{
$resultSelectLoginCheck->execute();
$resultSelectLoginCheck->store_result();
if($resultSelectLoginCheck->num_rows()<=0)
{
$resultSelectLoginCheck->close(); 

//Montar e Converter DataNasc
$timestamp = strtotime($datanasc);
$dateFinal = date("Y-m-d", $timestamp);

//Retornar Id Sexo
$sqlstmtSelectSexo = "SELECT `ID` FROM sexo_pessoa WHERE `SEXO` = '".$sexo."'";
if($resultSelectSexo = $connection->prepare($sqlstmtSelectSexo))
{
$resultSelectSexo->execute();
$resultSelectSexo->store_result();
if($resultSelectSexo->num_rows()>0)
{
$resultSelectSexo->bind_result($sexoId);
$resultSelectSexo->fetch();
$resultSelectSexo->close();
// Inserir Pessoa
$sqlstmtInsertPessoa = "INSERT INTO pessoa(`CPF`, `PNOME`, `SNOME`, `DATANASC`, `EMAIL`, `TELEFONE`, `ID_SEXO`) VALUES (".$cpf.", '".$pnome."', '".$snome."', '".$dateFinal."', '".$email."', '".$telefone."', ".$sexoId.")";
if($resultInsertPessoa = $connection->prepare($sqlstmtInsertPessoa))
{
$resultInsertPessoa->execute();
if(mysqli_affected_rows($connection)>0)
{
$resultInsertPessoa->close();

//Retornar Pessoa e Armazenar dados Atualizados para serem capturados de novo pela tela de Confirmacao de Dados
$sqlstmtSelectPessoa = "SELECT `CPF`, `PNOME`, `SNOME`, `DATANASC`, `EMAIL`, `TELEFONE`, `ID_SEXO` FROM pessoa WHERE `CPF` = ".$cpf;
if($resultSelectPessoa = $connection->prepare($sqlstmtSelectPessoa))
{
$resultSelectPessoa->execute();
$resultSelectPessoa->store_result();
if($resultSelectPessoa->num_rows()>0)
{
$resultSelectPessoa->bind_result($cpf, $pnome, $snome, $datanasc, $email, $telefone, $sexoId);
$resultSelectPessoa->fetch();
$resultSelectPessoa->close();;

//Retornar Id Tipo_Login
$sqlstmtSelectTipoLogin = "SELECT `ID` FROM tipo_login WHERE `NOME` = '".$tipologin."'";
if($resultSelectTipoLogin = $connection->prepare($sqlstmtSelectTipoLogin))
{
$resultSelectTipoLogin->execute();
$resultSelectTipoLogin->store_result();
if($resultSelectTipoLogin->num_rows()>0)
{
$resultSelectTipoLogin->bind_result($tipologinId);
$resultSelectTipoLogin->fetch();
$resultSelectTipoLogin->close();

//Montar Id Unico para Usuario($cpf Pessoa + Data que foi criado o Registro)
$usuarioId = $cpf.date("dmY");

//Inserir Pessoa=>Usuario
$sqlstmtInsertUsuario = "INSERT INTO usuario(`ID`, `LOGIN`, `SENHA`, `ID_TIPOLOGIN`, `ID_PESSOA`) VALUES (".$usuarioId.", '".$usuario."', '".$senha."', ".$tipologinId.", ".$cpf.");";
if($resultInsertUsuario = $connection->prepare($sqlstmtInsertUsuario))
{
$resultInsertUsuario->execute();
if(mysqli_affected_rows($connection)>0)
{
$resultInsertUsuario->close();

//Retornar Usuario e Armazenar dados Atualizados para serem capturados de novo pela tela de Confirmacao de Dados
$sqlstmtSelectUsuario = "SELECT usuario.`ID`, `LOGIN`, `SENHA`, `ID_TIPOLOGIN`, `NOME` FROM usuario INNER JOIN tipo_login ON tipo_login.`ID` = usuario.`ID_TIPOLOGIN` WHERE usuario.`ID` =  ".$usuarioId;
if($resultSelectUsuario = $connection->prepare($sqlstmtSelectUsuario))
{
$resultSelectUsuario->execute();
$resultSelectUsuario->store_result();
if($resultSelectUsuario->num_rows()>0)
{
$resultSelectUsuario->bind_result($usuarioId, $usuario, $senha, $tipologinId, $tipologin);
$resultSelectUsuario->fetch();
$resultSelectUsuario->close();

//Verificar se existe Endereco
$sqlstmtSelectEndereco = "SELECT `CEP` FROM endereco_cidade WHERE `CEP` =".$cep;
if($resultSelectEnderecoCheck = $connection->prepare($sqlstmtSelectEndereco))
{
$resultSelectEnderecoCheck->execute();
$resultSelectEnderecoCheck->store_result();
if($resultSelectEnderecoCheck->num_rows()<=0)
{
$resultSelectEnderecoCheck->close();

//Retornar Id Tipo_Endereco
$sqlstmtSelectTipoEndereco = "SELECT `ID` FROM tipo_endereco WHERE `NOME` = '".$tipoendereco."'";
if($resultSelectTipoEndereco = $connection->prepare($sqlstmtSelectTipoEndereco))
{
$resultSelectTipoEndereco->execute();
$resultSelectTipoEndereco->store_result();
if($resultSelectTipoEndereco->num_rows()>0)
{
$resultSelectTipoEndereco->bind_result($tipoenderecoId);
$resultSelectTipoEndereco->fetch();
$resultSelectTipoEndereco->close();

//Consultar o API de Municipios com o campo $ibge
//Para que possa Inserir o Endereco e seus respectivos campos, é necessário inserir todas as outras referencia(Cidade_Estado, Micro/Mesorregiao, Estado, Regiao Pais)
if($jsonCidadeEstadoRegiaoGET = file_get_contents('https://servicodados.ibge.gov.br/api/v1/localidades/municipios/'.$ibge))
{
$jsonCidadeEstadoRegiaoDATA = json_decode($jsonCidadeEstadoRegiaoGET, TRUE);
$CIDADE_ESTADOId = $jsonCidadeEstadoRegiaoDATA['id'];
$CIDADE_ESTADONome = $jsonCidadeEstadoRegiaoDATA['nome']; //Nome Cidade
$MICRORREG_ESTADOId = $jsonCidadeEstadoRegiaoDATA['microrregiao']['id'];
$MICRORREG_ESTADONome = $jsonCidadeEstadoRegiaoDATA['microrregiao']['nome']; // Nome Microrregiao
$MESORREG_ESTADOId = $jsonCidadeEstadoRegiaoDATA['microrregiao']['mesorregiao']['id'];
$MESORREG_ESTADONome = $jsonCidadeEstadoRegiaoDATA['microrregiao']['mesorregiao']['nome']; //Nome Mesorregiao
$ESTADO_REGIAOId = $jsonCidadeEstadoRegiaoDATA['microrregiao']['mesorregiao']['UF']['id'];
$ESTADO_REGIAOSigla = $jsonCidadeEstadoRegiaoDATA['microrregiao']['mesorregiao']['UF']['sigla']; //UF Estado
$ESTADO_REGIAONome = $jsonCidadeEstadoRegiaoDATA['microrregiao']['mesorregiao']['UF']['nome']; //Nome em extenso Estado
$REGIAOId = $jsonCidadeEstadoRegiaoDATA['microrregiao']['mesorregiao']['UF']['regiao']['id'];
$REGIAOSigla = $jsonCidadeEstadoRegiaoDATA['microrregiao']['mesorregiao']['UF']['regiao']['sigla']; //Sigla Regiao País
$REGIAONome = $jsonCidadeEstadoRegiaoDATA['microrregiao']['mesorregiao']['UF']['regiao']['nome']; //Nome Regiao País

//Inserir Regiao_Pais
$sqlstmtInsertRegiaoPais = "INSERT INTO regiao_pais(`ID`, `SIGLA`, `NOME`) VALUES (".$REGIAOId.", '".$REGIAOSigla."', '".$REGIAONome."');";
if($resultInsertRegiaoPais = $connection->prepare($sqlstmtInsertRegiaoPais))
{
$resultInsertRegiaoPais->execute();
if(mysqli_affected_rows($connection)>0)
{
$resultInsertRegiaoPais->close();

//Retornar Id Regiao_Pais
$sqlstmtSelectRegiaoPais = "SELECT `ID`, `SIGLA`, `NOME` FROM regiao_pais WHERE `ID` = ".$REGIAOId;
if($resultSelectRegiaoPais = $connection->prepare($sqlstmtSelectRegiaoPais))
{
$resultSelectRegiaoPais->execute();
$resultSelectRegiaoPais->store_result();
if($resultSelectRegiaoPais->num_rows()>0)
{
$resultSelectRegiaoPais->bind_result($REGIAOId, $REGIAOSigla, $REGIAONome);
$resultSelectRegiaoPais->fetch();
$resultSelectRegiaoPais->close();

//Inserir Estado
$sqlstmtInsertEstado = "INSERT INTO estado(`ID`, `SIGLA`, `NOME`, `ID_REGIAOPAIS`) VALUES (".$ESTADO_REGIAOId.", '".$ESTADO_REGIAOSigla."', '".$ESTADO_REGIAONome."', ".$REGIAOId.");";
if($resultInsertEstado = $connection->prepare($sqlstmtInsertEstado))
{
$resultInsertEstado->execute();
if(mysqli_affected_rows($connection)>0)
{
$resultInsertEstado->close();

//Retornar Id Estado
$sqlstmtSelectEstado = "SELECT `ID`, `SIGLA`, `NOME` FROM estado WHERE `ID` = ".$ESTADO_REGIAOId;
if($resultSelectEstado = $connection->prepare($sqlstmtSelectEstado))
{
$resultSelectEstado->execute();
$resultSelectEstado->store_result();
if($resultSelectEstado->num_rows()>0)
{
$resultSelectEstado->bind_result($ESTADO_REGIAOId, $ESTADO_REGIAOSigla, $ESTADO_REGIAONome);
$resultSelectEstado->fetch();
$resultSelectEstado->close();

//Inserir Mesorregiao_Estado
$sqlstmtInsertMesorregEstado = "INSERT INTO mesorregiao_estado(`ID`, `NOME`, `ID_ESTADO`) VALUES (".$MESORREG_ESTADOId.", '".$MESORREG_ESTADONome."', '".$ESTADO_REGIAOId."');";
if($resultMesorregEstado = $connection->prepare($sqlstmtInsertMesorregEstado))
{
$resultMesorregEstado->execute();
if(mysqli_affected_rows($connection)>0)
{
$resultMesorregEstado->close();

//Retornar Id Mesorregiao_Estado
$sqlstmtSelectMesorregEstado = "SELECT mesorregiao_estado.`ID`, mesorregiao_estado.`NOME`, `ID_ESTADO`, `SIGLA` FROM mesorregiao_estado INNER JOIN estado ON estado.`ID` = mesorregiao_estado.`ID_ESTADO` WHERE mesorregiao_estado.`ID` = ".$MESORREG_ESTADOId;
if($resultSelectMesorregEstado = $connection->prepare($sqlstmtSelectMesorregEstado))
{
$resultSelectMesorregEstado->execute();
$resultSelectMesorregEstado->store_result();
if($resultSelectMesorregEstado->num_rows()>0)
{
$resultSelectMesorregEstado->bind_result($MESORREG_ESTADOId, $MESORREG_ESTADONome, $ESTADO_REGIAOId, $ESTADO_REGIAOSigla);
$resultSelectMesorregEstado->fetch();
$resultSelectMesorregEstado->close();

//Inserir Microrregiao_Estado
$sqlstmtInsertMicrorregEstado = "INSERT INTO microrregiao_estado(`ID`, `NOME`, `ID_MESOESTADO`) VALUES (".$MICRORREG_ESTADOId.", '".$MICRORREG_ESTADONome."', '".$MESORREG_ESTADOId."');";
if($resultMicrorregEstado = $connection->prepare($sqlstmtInsertMicrorregEstado))
{
$resultMicrorregEstado->execute();
if(mysqli_affected_rows($connection)>0)
{
$resultMicrorregEstado->close();

//Retornar Id Microrregiao_Estado
$sqlstmtSelectMicrorregEstado = "SELECT `ID`, `NOME`, `ID_MESOESTADO` FROM microrregiao_estado WHERE `ID` = ".$MICRORREG_ESTADOId;
if($resultSelectMicrorregEstado = $connection->prepare($sqlstmtSelectMicrorregEstado))
{
$resultSelectMicrorregEstado->execute();
$resultSelectMicrorregEstado->store_result();
if($resultSelectMicrorregEstado->num_rows()>0)
{
$resultSelectMicrorregEstado->bind_result($MICRORREG_ESTADOId, $MICRORREG_ESTADONome, $MESORREG_ESTADOId);
$resultSelectMicrorregEstado->fetch();
$resultSelectMicrorregEstado->close();

//Inserir Cidade_Estado
$sqlstmtInsertCidadeEstado = "INSERT INTO cidade_estado(`ID`, `NOME`, `ID_MICROESTADO`) VALUES (".$CIDADE_ESTADOId.", '".$CIDADE_ESTADONome."', '".$MICRORREG_ESTADOId."');";
if($resultCidadeEstado = $connection->prepare($sqlstmtInsertCidadeEstado))
{
$resultCidadeEstado->execute();
if(mysqli_affected_rows($connection)>0)
{
$resultCidadeEstado->close();

//Retornar Id Cidade_Estado
$sqlstmtSelectCidadeEstado = "SELECT `ID`, `NOME`, `ID_MICROESTADO` FROM cidade_estado WHERE `ID` = ".$CIDADE_ESTADOId;
if($resultSelectCidadeEstado = $connection->prepare($sqlstmtSelectCidadeEstado))
{
$resultSelectCidadeEstado->execute();
$resultSelectCidadeEstado->store_result();
if($resultSelectCidadeEstado->num_rows()>0)
{
$resultSelectCidadeEstado->bind_result($CIDADE_ESTADOId, $CIDADE_ESTADONome, $MICRORREG_ESTADOId);
$resultSelectCidadeEstado->fetch();
$resultSelectCidadeEstado->close();

//Apos Tudo Isso, Inserir Endereco
$sqlstmtInsertEnderecoCidade = "INSERT INTO endereco_cidade(`CEP`, `LOGRADOURO`, `COMPLEMENTO`, `BAIRRO`, `UNIDADE`, `IBGE`, `GIA`, `ID_TIPOENDERECO`, `ID_CIDADEESTADO`) VALUES (".$cep.", '".$logradouro."', '".$complemento."', '".$bairro."', '".$unidade."', '".$ibge."', '".$gia."', ".$tipoenderecoId.", ".$CIDADE_ESTADOId.");";
if($resultEnderecoCidade = $connection->prepare($sqlstmtInsertEnderecoCidade))
{
$resultEnderecoCidade->execute();
if(mysqli_affected_rows($connection)>0)
{
$resultEnderecoCidade->close();

//Retornar Id(CEP) Endereco_Cidade
echo "HELLO".$cep;
$sqlstmtSelectEnderecoCidade = "SELECT `CEP`, `LOGRADOURO`, `COMPLEMENTO`, `BAIRRO`, `UNIDADE`, `IBGE`, `GIA`, `ID_TIPOENDERECO`, `ID_CIDADEESTADO`, `NOME` FROM endereco_cidade INNER JOIN tipo_endereco ON tipo_endereco.`ID` = endereco_cidade.`ID_TIPOENDERECO` WHERE endereco_cidade.`CEP` = ".$cep;
if($resultSelectEnderecoCidade = $connection->prepare($sqlstmtSelectEnderecoCidade))
{
$resultSelectEnderecoCidade->execute();
$resultSelectEnderecoCidade->store_result();
if($resultSelectEnderecoCidade->num_rows()>0)
{
$resultSelectEnderecoCidade->bind_result($cep, $logradouro, $complemento, $bairro, $unidade, $ibge, $gia, $tipoenderecoId, $CIDADE_ESTADOId, $CIDADE_ESTADONome);
$resultSelectEnderecoCidade->fetch();
$resultSelectEnderecoCidade->close();

//Por Final, Relacionar Pessoa/Usuario com o Endereco

//Montar Id Unico Pessoa_Rel_Endereco($cpf Pessoa + $cep Endereco + $numero + Data que foi criado o Relacionamento)
$pessoaRelEnderecoId = $cep.$cpf;

//Inserir Pessoa_Rel_Endereco
$sqlstmtInsertPessoaRelEndereco = "INSERT INTO pessoa_rel_endereco(`ID`, `NUMERO_ENDERECO`, `ID_PESSOARELEND`, `ID_ENDERECORELPES`) VALUES (".$pessoaRelEnderecoId.", ".$numero.", ".$cpf.", ".$cep.");";
if($resultPessoaRelEndereco = $connection->prepare($sqlstmtInsertPessoaRelEndereco))
{
$resultPessoaRelEndereco->execute();
if(mysqli_affected_rows($connection)>0)
{
$resultPessoaRelEndereco->close();
$registrationFinal = array(
'cpf'=>$cpf,
'pnome'=>$pnome,
'snome'=>$snome,
'datanasc'=>$datanasc,
'email'=>$email,
'sexo'=>$sexo,
'telefone'=>$telefone,
'cep'=>$cep,
'logradouro'=>$logradouro,
'complemento'=>$complemento,
'numero'=>$numero,
'bairro'=>$bairro,
'cidade'=>$CIDADE_ESTADONome,
'uf'=>$ESTADO_REGIAOSigla,
'tipoendereco'=>$tipoendereco,
'login'=>$usuario,
'senha'=>$senha,
'tipologin'=>$tipologin);

$response['error'] = false; 
$response['message'] = 'PESSOA | ENDERECO | USUARIO CADASTRADOS COM SUCESSO!'; 
$response['user'] = $registrationFinal;
break;
}
else
{
$response['error'] = true;
$response['message'] = 'DATA \'INSERT\' ERROR(PESSOA_REL_ENDERECO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = '\'INSERT\' QUERY ERROR(PESSOA_REL_ENDERECO)';
break;
}													
}
else
{
$response['error'] = true;
$response['message'] = 'DATA RETURN ERROR(ENDERECO_CIDADE, TIPO_ENDERECO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'RETURN QUERY ERROR(ENDERECO_CIDADE)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA \'INSERT\' ERROR(ENDERECO_CIDADE)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = '\'INSERT\' QUERY ERROR(ENDERECO_CIDADE)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA RETURN ERROR(CIDADE_ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'RETURN QUERY ERROR(CIDADE_ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA \'INSERT\' ERROR(CIDADE_ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = '\'INSERT\' QUERY ERROR(CIDADE_ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA RETURN ERROR(MICRORREGIAO_ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'RETURN QUERY ERROR(MICRORREGIAO_ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA \'INSERT\' ERROR (MESORREGIAO_ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = '\'INSERT\' QUERY ERROR (MESORREGIAO_ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA RETURN ERROR(MESORREGIAO_ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'RETURN QUERY ERROR(MESORREGIAO_ESTADO, ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA\'INSERT\' ERROR(MESORREGIAO_ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'T\'INSERT\' QUERY ERROR(MESORREGIAO_ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA RETURN ERROR (ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'RETURN QUERY ERROR(ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA\'INSERT\' ERROR(ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = '\'INSERT\' QUERY ERROR(ESTADO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA RETURN ERROR (REGIAO_PAIS)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'RETURN QUERY ERROR(REGIAO_PAIS)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA \'INSERT\' ERROR(REGIAO_PAIS)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = '\'INSERT\' QUERY ERROR(REGIAO_PAIS)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'API WEBSERVICE OFFLINE(https://servicodados.ibge.gov.br/api/v1/localidades/municipios/'.$ibge;
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA RETURN ERROR (TIPO_ENDERECO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'RETURN QUERY ERROR(TIPO_ENDERECO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'Endereco ja registrado';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = ' RETURN QUERY ERROR (ENDERECO_CIDADE)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA RETURN ERROR (USUARIO, TIPO_LOGIN)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'RETURN QUERY ERROR(USUARIO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = ' DATA \'INSERT\' ERROR(USUARIO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = '\'INSERT\' QUERY ERROR(USUARIO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA RETURN ERROR (TIPO_LOGIN)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'RETURN QUERY ERROR(TIPO_LOGIN)';
break;
} 
}
else
{
$response['error'] = true;
$response['message'] = 'DATA RETURN ERROR (PESSOA)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'RETURN QUERY ERROR(PESSOA)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA \'INSERT\' ERROR(PESSOA)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = '\'INSERT\'QUERY ERROR(PESSOA)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA RETURN ERROR (SEXO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'RETURN QUERY ERROR(SEXO)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'Usuario/Pessoa ja registrado';
break;
}
}
else
{
$response['error'] = true; 
$response['message'] = 'RETURN QUERY ERROR(PESSOA/USUARIO)';
break;
}	 
}
else
{
$response['error'] = true; 
$response['message'] = 'PARAMETROS REQUIRIDOS NAO ENCONTRADOS';
break;
}

break;
case 'login':
if(isTheseParametersAvailable(array('usuario', 'usuarioId', 'senha', 'tipologin')))
{

//DADOS USUARIO
$login = $_POST['usuario'];
$usuarioId = $_POST['usuarioId'];
$senha = $_POST['senha']; 
$tipologin = $_POST['tipologin'];
//DADOS USUARIO

$sqlstmtSelectUsuarioTipo = "SELECT usuario.`ID`, `RESTRICAO` FROM tipo_login INNER JOIN usuario ON usuario.`ID_TIPOLOGIN` = tipo_login.`ID` INNER JOIN pessoa ON pessoa.`CPF` = usuario.`ID_PESSOA` WHERE usuario.`SENHA` = '".$senha."' AND pessoa.`EMAIL` = '".$login."' OR usuario.`LOGIN` = '".$login."'";
if($resultSelectUsuarioTipo = $connection->prepare($sqlstmtSelectUsuarioTipo))
{
$resultSelectUsuarioTipo->execute();
$resultSelectUsuarioTipo->store_result();

if($resultSelectUsuarioTipo->num_rows()>0)
{
$resultSelectUsuarioTipo->bind_result($usuarioId, $tipologin);
$resultSelectUsuarioTipo->fetch();
$resultSelectUsuarioTipo->close();
echo $tipologin;

if($tipologin == "EMAIL_RESTRICT" and strpos($login, '@') == false)
{
$senha = md5($_POST['senha']);
$sqlstmtSelectUsuarioLoginSenha = "SELECT `LOGIN`, `SENHA` FROM usuario WHERE `LOGIN` = '".$login."' AND `SENHA` = '".$senha."'";
if($resultSelectUsuarioLoginSenha = $connection->prepare($sqlstmtSelectUsuarioLoginSenha))
{
$resultSelectUsuarioLoginSenha->execute();
$resultSelectUsuarioLoginSenha->store_result();
if($resultSelectUsuarioLoginSenha->num_rows()>0)
{
$resultSelectUsuarioLoginSenha->bind_result($login, $senha);
$resultSelectUsuarioLoginSenha->fetch();
$resultSelectUsuarioLoginSenha->close();
$loginFinal = array(
'usuarioId'=>$usuarioId, 
'usuario'=>$login, 
'tipologin'=>$tipologin);

$response['error'] = false; 
$response['message'] = 'Login feito com sucesso!'; 
$response['user'] = $loginFinal;
break;
}
else
{
$response['error'] = true;
$response['message'] = 'DATA VERIFICATION RETURN ERROR (USUARIO[LOGIN/SENHA]): Usuario ou Senha Invalida';
break;
}
}
else
{
$response['error'] = true; 
$response['message'] = 'RETURN QUERY ERROR(USUARIO[LOGIN/SENHA])';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'TIPOLOGIN VERIFICATION ERROR (MUST NOT USE EMAIL)';
}
if($tipologin == "USER_RESTRICT" and strpos($login, '@') == true)
{
$sqlstmtSelectUsuarioEmailSenha = "SELECT `EMAIl`, `SENHA` FROM usuario INNER JOIN pessoa ON pessoa.`CPF` = usuario.`ID_PESSOA` WHERE pessoa.`EMAIL` = '".$login."' AND usuario.`SENHA` = '".$senha."'";
if($resultSelectUsuarioEmailSenha = $connection->prepare($sqlstmtSelectUsuarioEmailSenha))
{
$resultSelectUsuarioEmailSenha->execute();
$resultSelectUsuarioEmailSenha->store_result();
if($resultSelectUsuarioEmailSenha->num_rows()>0)
{
$resultSelectUsuarioEmailSenha->bind_result($login, $senha);
$resultSelectUsuarioEmailSenha->fetch();
$resultSelectUsuarioEmailSenha->close();
$loginFinal = array(
'usuarioId'=>$usuarioId, 
'usuario'=>$login, 
'tipologin'=>$tipologin);

$response['error'] = false; 
$response['message'] = 'Login feito com sucesso!'; 
$response['user'] = $loginFinal;
break;
}
else
{
$response['error'] = true;
$response['message'] = 'DATA VERIFICATION RETURN ERROR (USUARIO[EMAIL/SENHA]): Usuarrio ou senha Invalida';
break;
}
}
else
{
$response['error'] = true; 
$response['message'] = 'RETURN QUERY ERROR(USUARIO[EMAIL/SENHA])';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'TIPOLOGIN VERIFICATION ERROR (MUST NOT USE USERNAME)';
break;
}
}
else
{
$response['error'] = true;
$response['message'] = 'DATA RETURN ERROR (TIPO_LOGIN/USUARIO/PESSOA)';
break;
}
}
else
{
$response['error'] = true; 
$response['message'] = 'RETURN QUERY ERROR(TIPO_LOGIN/USUARIO/PESSOA)';
break;
}
}
else
{
$response['error'] = true; 
$response['message'] = 'PARAMETROS REQUIRIDOS NAO ENCONTRADOS';
break;
}
break;
case 'selectInfo':
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
break;
default: 
$response['error'] = true; 
$response['message'] = 'CHAMADA INVALIDA DE OPERACAO';
}
}
else
{
//if it is not api call 
//pushing appropriate values to response array 
$response['error'] = true; 
$response['message'] = 'CHAMADA INVALIDA DE API';
}

header('Content-Type: application/json');
//displaying the response in json structure 
echo json_encode($response);

//function validating all the paramters are available
//we will pass the required parameters to this function 
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