<?php
  include("php/db_config.php");
  session_start();
  $conn=new db_conn();
  $db_connection = $conn->connection();
  $result="";
  $insert_msg="";
  $directory="";
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agenda Local - Admin Registro</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- CSS Customizado Local Mobile -->
    <link href="css/local.css" type="text/css" rel="stylesheet">
  </head>
  <body class="bg-dark bg-overwrite">
    <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Registrar uma Conta</div>
        <form method="post">
          <div class="card-body">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="firstName" name="pnomeInsert" class="form-control" placeholder="Primeiro Nome" required="required" autofocus="autofocus">
                    <label for="firstName">Primeiro Nome</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="lastName" name="snomeInsert" class="form-control" placeholder="Sobrenome" required="required">
                    <label for="lastName">Sobrenome</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="email" name="emailInsert" class="form-control" placeholder="Endereço email" required="required">
                <label for="email">Endereço email</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="user" name="loginInsert" class="form-control" placeholder="Usuário" required="required">
                <label for="user">Usuário</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="password" name="senhaInsert" class="form-control" placeholder="Senha" required="required">
                    <label for="password">Senha</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="password" id="confirmpassword" name="senhaConfirmar" class="form-control" placeholder="Confirmar Senha" required="required">
                    <label for="confirmpassword">Confirmar Senha</label>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card-header cardheader-overwrite">
                  <label for="nivelacessoInput">Nivel Acesso</label>
                  <select id="nivelacessoInput" name="nivelacessoInsert">
                    <option value="0">--Selecione uma opção--</option>
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
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer modal-footer-overwrite">
            <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="insertSubmit" value="Cadastrar Usuário">
            <button id="voltarFunc" type="button" class="btn btn-secondary btn-secondary-overwrite">
              Voltar
              <?php
              if(isset($_GET['return']))
              {
                $return = $_GET['return'];
                $directory='<script> document.getElementById('.'"'.'voltarFunc'.'"'.').onclick = function () { location.href = '.'"http://localhost/painelagendalocal/painelAdm/'.$return.'.php"'.';}</script>';
                echo $directory;
              }
              ?>
            </button>
          </div>
        </form>
        <?php
          if($_SERVER["REQUEST_METHOD"] == "POST")
          {
            $pnome_usuario=$_POST['pnomeInsert'];
            $snome_usuario=$_POST['snomeInsert'];
            $email_usuario=$_POST['emailInsert'];
            $login_usuario=$_POST['loginInsert'];
            $senha_usuario=md5($_POST['senhaInsert']);
            $confirmarsenha_usuario=md5($_POST['senhaConfirmar']);
            $id_nivelacesso=(int)$_POST['nivelacessoInsert'];

            if($senha_usuario == $confirmarsenha_usuario)
            {
              $sqlStmlInsertAnunciante="INSERT INTO agendalocal.usuarios(id_nivelacesso, pNome, sNome, email, login, senha) VALUES(".(int)$id_nivelacesso.", '".$pnome_usuario."', '".$snome_usuario."', '".$email_usuario."', '".$login_usuario."', '".$senha_usuario."')";
              if($resultStmtInsertAnunciante = pg_prepare($db_connection,"",  $sqlStmlInsertAnunciante))
              {
                $resultStmtInsertAnunciante = pg_execute($db_connection, "", array());
                if(pg_affected_rows($resultStmtInsertAnunciante)>0)
                {
                  if(isset($_GET['return']))
                  {
                    $return = $_GET['return'];
                    echo "<script>alert('Usuário cadastrado com sucesso!');</script>";
                    echo "<script> location.href='http://localhost/painelagendalocal/painelAdm/".$return.".php';</script>";
                  }
                }
                else
                {
                  $result="Ocorreu um erro ao tentar cadastrar o Usuário!<br/>";
                  $result.="Tente novamente ou entre em contato com um administrador.<br/>";
                  $insert_msg='<div class='.'"'.'card-header error-msg'.'"'.'>'.$result.'</div>';
                }
              }
              else
              {
                $result='Ocorreu um erro na conexão com o Banco de Dados!<br/>';
                $result.='Tente novamente ou entre em contato com um administrador<br/>';
                $insert_msg='<div class='.'"'.'card-header error-msg'.'"'.'>'.$result.'</div>';
              }
            }
            else
            {
              $result='Senha não pôde ser confirmada!<br/>';
              $result.='Verifique se ela foi digitada corretamente.<br/>';
              $insert_msg='<div class='.'"'.'card-header error-msg'.'"'.'>'.$result.'</div>';
            }
          }
        ?>
        <?php if($insert_msg!=""){ echo $insert_msg; }?>
      </div>
    </div>
    <div class="container container-overwrite">
      <img src="Agenda Local - PNG.png" class="imgLogo imgLogo-overwrite">
    </div>
  </body>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</html>
