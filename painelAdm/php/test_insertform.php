<?php
	include("../php/db_config.php");
	$conn=new db_conn();
	$db_connection = $conn->connection();
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$login=$_POST['login'];
		$senha=md5($_POST['senha']);
		$id_nivelacesso=$_POST['nivelacesso'];
		$sqlStmtSelectNivelAcessoId="SELECT niveis_acesso.tipo FROM agendalocal.niveis_acesso WHERE niveis_acesso.id_nivelacesso=".(int)$id_nivelacesso.""; 
    	if($resultStmtSelectNiveisAcessoId = pg_prepare($db_connection,"",  $sqlStmtSelectNivelAcessoId))
    	{
            $resultStmtSelectNiveisAcessoId = pg_execute($db_connection, "", array());
      		if($rowResultStmtSelectNiveisAcessoId = pg_fetch_array($resultStmtSelectNiveisAcessoId))
      		{
        		$tipo_nivelacesso = $rowResultStmtSelectNiveisAcessoId['tipo'];
        		echo $login." and ".$senha." and ".$tipo_nivelacesso."<br/>";
        		$pnome="Philipe";
        		$snome="Massari";
        		$email="admin2@gmail.com";
        		$sqlStmlInsertUsuario="INSERT INTO agendalocal.usuarios(id_nivelacesso, pnome, snome, email, login, senha) VALUES('".(int)$id_nivelacesso."', '".$pnome."', '".$snome."', '".$email."', '".$login."', '".$senha."')";
        		if($resultStmtInsertUsuario = pg_prepare($db_connection,"",  $sqlStmlInsertUsuario))
        		{
        			$resultStmtInsertUsuario = pg_execute($db_connection, "", array());
        			if(pg_affected_rows($resultStmtInsertUsuario)>0)
        			{
        				echo "usuario cadastrado com sucesso!"."<br/>";
        				$sqlStmtSelectAllUsuarios="SELECT * FROM agendalocal.usuarios";
	                	if($resultStmtSelectAllUsuarios = pg_prepare($db_connection,"",  $sqlStmtSelectAllUsuarios))
	                	{
	                		$resultStmtSelectAllUsuarios = pg_execute($db_connection, "", array());
	                		while($rowResultStmtSelectAllUsuarios = pg_fetch_array($resultStmtSelectAllUsuarios))
	                		{
	                    		echo "nivel_acesso=".$rowResultStmtSelectAllUsuarios["id_nivelacesso"]."<br/>";
	                    		echo "pNome=".$rowResultStmtSelectAllUsuarios['pnome']."<br/>";
	                    		echo "sNome=".$rowResultStmtSelectAllUsuarios['snome']."<br/>";
	                    		echo "email=".$rowResultStmtSelectAllUsuarios['email']."<br/>";
	                    		echo "login=".$rowResultStmtSelectAllUsuarios['login']."<br/>";
	                    		echo "senha=".$rowResultStmtSelectAllUsuarios['senha']."<br/><br/>";
	                		}
        				}
        			}
				}
				else
				{
					echo "error";
				}
			}
		}
	}
?>
<html>
	<head>
		<title>test form</title>
	</head>
	<body>
		<form method="post">
			<label for="usuarioInput">Usuario</label>
			<input type="text" name="login" id="usuarioInput" placeholder="Usuario" required="required" autofocus="autofocus">
			<label for="senhaInput">Usuario</label>
			<input type="password" name="senha" id="senhaInput" placeholder="Senha" required="required">
			<label for="nivelacessoInput">Nivel Acesso</label>
			<select id="nivelacessoInput" name="nivelacesso">
	            <option value="">--Selecione uma opção--</option>
	            <?php
	                $sqlStmtSelectAllNiveis="SELECT * FROM agendalocal.niveis_acesso";
	                if($resultStmtSelectAllNiveis = pg_prepare($db_connection,"",  $sqlStmtSelectAllNiveis))
	                {
	                  $resultStmtSelectAllNiveis = pg_execute($db_connection, "", array());
	                  while($rowResultStmtSelectAllNiveis = pg_fetch_array($resultStmtSelectAllNiveis))
	                  {
	                    echo '<option value='.'"'.$rowResultStmtSelectAllNiveis["id_nivelacesso"].'"'.'>'.$rowResultStmtSelectAllNiveis["tipo"].'</option>';
	                  }
	                }
	            ?>
			</select>
			<input type="submit" name="submitButton" value="Cadastrar Usuario">
		</form>
	</body>
</html>

<!-- <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #3e8e41;
}

#myInput {
  border-box: box-sizing;
  background-image: url('searchicon.png');
  background-position: 14px 12px;
  background-repeat: no-repeat;
  font-size: 16px;
  padding: 14px 20px 12px 45px;
  border: none;
  border-bottom: 1px solid #ddd;
}

#myInput:focus {outline: 3px solid #ddd;}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  min-width: 230px;
  overflow: auto;
  border: 1px solid #ddd;
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
</head>
<body>

<h2>Search/Filter Dropdown</h2>
<p>Click on the button to open the dropdown menu, and use the input field to search for a specific dropdown link.</p>

<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">Dropdown</button>
  <div id="myDropdown" class="dropdown-content">
    <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
    <a href="#about">About</a>
    <a href="#base">Base</a>
    <a href="#blog">Blog</a>
    <a href="#contact">Contact</a>
    <a href="#custom">Custom</a>
    <a href="#support">Support</a>
    <a href="#tools">Tools</a>
  </div>
</div>

<script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
</script>

</body>
</html> -->