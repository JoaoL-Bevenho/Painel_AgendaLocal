<?php
  ob_start();
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include("php/db_config.php");
  session_start();
  $conn = new db_conn();
  $db_connection = $conn->connection();
  $result="";
  $login_msg="";
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agenda Local - Admin Login</title>

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
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="usernameInput" name="usuarioInput" class="form-control"  placeholder="Nome Usuário" required autofocus>
                <label for="usernameInput">Usuário</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="passwordInput" name="senhaInput" class="form-control" placeholder="Senha" required>
                <label for="passwordInput">Senha</label>
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block" id="inputSubmit" value="Login">
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['usuarioInput'])) && (!empty($_POST['senhaInput'])))
            {
              $userlogin=$_POST['usuarioInput'];
              $email=$_POST['usuarioInput'];
              $password=md5($_POST['senhaInput']);
              $idusuario=0;

              $sqlStmtCheckLogin="SELECT usuarios.id_usuario, usuarios.id_nivelacesso FROM agendalocal.usuarios WHERE (usuarios.email='".$email."' OR usuarios.login='".$userlogin."') AND usuarios.senha = '".$password."'"; 
              if($resultStmtCheckLogin = pg_prepare($db_connection,"",  $sqlStmtCheckLogin))
              {
                $resultStmtCheckLogin = pg_execute($db_connection, "", array());
                if($rowResultStmtCheckLogin = pg_fetch_array($resultStmtCheckLogin))
                {
                  $idusuario = $rowResultStmtCheckLogin["id_usuario"];
                  $nivelacessousuario= $rowResultStmtCheckLogin["id_nivelacesso"];
                  $sqlStmtSelectNivelAcesso="";
                  $result="";
                  $login_msg="";
                  $_SESSION['user_id'] = $idusuario;
                  $_SESSION['user_password'] = $password;
                  $_SESSION['user_levelaccess'] = $nivelacessousuario;
                  header("location: index.php");
                  exit;
                }
                else
                {
                  $result="Usuário ou senha errada! Tente novamente!";
                  $login_msg='<div class='.'"'.'card-header error-msg'.'"'.'>'.$result.'</div>';
                }
              }
            }
          ?>
          <?php if($login_msg!=""){ echo $login_msg; } ?>
          <div class="text-center">
            <!-- <a class="d-block small mt-3" href="register.html">Registrar uma Conta</a> -->
            <a class="d-block small" href="forgot-password.php">Esqueceu a senha?</a>
          </div>
        </div>
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