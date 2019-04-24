<?php
  ob_start();
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include("php/db_config.php");
  session_start();
  $conn = new db_conn();
  $db_connection = $conn->connection();
  if(!isset($_SESSION['user_id'])) { echo "<script>location.href='login.php';</script>"; }
  else
  {
    if(!isset($_SESSION['nivel_acesso']))
    {
      $_SESSION['nivel_acesso'] = '';
      if(isset($_SESSION['user_levelaccess']))
      {
        $sqlStmtSelectNivelAcessoNome="SELECT niveis_acesso.nome FROM agendalocal.niveis_acesso WHERE niveis_acesso.id_nivelacesso=".(int)$_SESSION['user_levelaccess'];
        if($resultStmtSelectNivelAcessoNome = pg_prepare($db_connection,"",  $sqlStmtSelectNivelAcessoNome))
        {
          $resultStmtSelectNivelAcessoNome = pg_execute($db_connection, "", array());
          if($rowResultStmtSelectNivelAcessoNome = pg_fetch_array($resultStmtSelectNivelAcessoNome))
          { $_SESSION['nivel_acesso'] = $rowResultStmtSelectNivelAcessoNome['nome']; }
        }
      }
    }
  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agenda Local - Admin Home</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Customizado Local Mobile -->
    <link href="css/local.css" type="text/css"rel="stylesheet">

    <!--Glyphicons-->
    <link href="glyph_css/glyph_bootstrap.css" type="text/css" rel="stylesheet"> <!-- http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" -->

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
  </head>

  <body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top navLogoBar">
      <a class="navbar-brand mr-1" href="index.php"><img src="Agenda Local - PNG.png" class="imgLogo"></a>
      <!-- Navbar Search -->
      <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>
      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw logoColor"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right menuItemColor" aria-labelledby="userDropdown">
            <a class="dropdown-item menuItemColor" href="#" data-toggle="modal" data-target="#logoutModal">
              <span class="glyphicon glyphicon-log-out"></span>
              <span>Logout</span>
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <?php
          if($_SESSION['nivel_acesso'] == "Administrador")
          {
            echo '<li class='.'"'.'nav-item active'.'"'.'><a class='.'"'.'nav-link'.'"'.' href='.'"'.'index.php'.'"'.'><i class='.'"'.'fas fa-fw fa-tachometer-alt"></i><span>Home</span></a></li>';
            echo '<li class='.'"'.'nav-item'.'"'.'><a class='.'"'.'nav-link nav-overwrite'.'"'.' href='.'"'.'cidades.php'.'"'.'><i class='.'"'.'fas fa-fw fa-table'.'"'.'></i><span>Cidades</span></a></li>';
            // echo '<li class='.'"'.'nav-item'.'"'.'><a class='.'"'.'nav-link nav-overwrite'.'"'.' href='.'"'.'anuncios.php'.'"'.'><i class='.'"'.'fas fa-fw fa-table'.'"'.'></i><span>Anúncios</span></a></li>';
            echo '<li class='.'"'.'nav-item'.'"'.'><a class='.'"'.'nav-link nav-overwrite'.'"'.' href='.'"'.'pagamentos.php'.'"'.'><i class='.'"'.'fas fa-fw fa-table'.'"'.'></i><span>Pagamentos</span></a></li>';
            echo '<li class='.'"'.'nav-item'.'"'.'><a class='.'"'.'nav-link nav-overwrite'.'"'.' href='.'"'.'planos.php'.'"'.'><i class='.'"'.'fas fa-fw fa-table'.'"'.'></i><span>Planos</span></a></li>';
            echo '<li class='.'"'.'nav-item'.'"'.'><a class='.'"'.'nav-link nav-overwrite'.'"'.' href='.'"'.'usuariospainel.php'.'"'.'><i class='.'"'.'fas fa-fw fa-table'.'"'.'></i><span>Usuários Painel</span></a></li>';
            // echo '<li class='.'"'.'nav-item'.'"'.'><a class='.'"'.'nav-link nav-overwrite'.'"'.' href='.'"'.'usuariosaplicativo.php'.'"'.'><i class='.'"'.'fas fa-fw fa-table'.'"'.'></i><span>Usuários Aplicativo</span></a></li>';
          }
          else if($_SESSION['nivel_acesso'] == "Financeiro")
          {
            echo '<li class='.'"'.'nav-item active'.'"'.'><a class='.'"'.'nav-link'.'"'.' href='.'"'.'index.php'.'"'.'><i class='.'"'.'fas fa-fw fa-tachometer-alt"></i><span>Home</span></a></li>';
            echo '<li class='.'"'.'nav-item'.'"'.'><a class='.'"'.'nav-link nav-overwrite'.'"'.' href='.'"'.'cidades.php'.'"'.'><i class='.'"'.'fas fa-fw fa-table'.'"'.'></i><span>Cidades</span></a></li>';
            echo '<li class='.'"'.'nav-item'.'"'.'><a class='.'"'.'nav-link nav-overwrite'.'"'.' href='.'"'.'pagamentos.php'.'"'.'><i class='.'"'.'fas fa-fw fa-table'.'"'.'></i><span>Pagamentos</span></a></li>';
          }
          else if($_SESSION['nivel_acesso'] == "Anunciante")
          {
            echo "<script>location.href='anuncianteDash.php'</script>";
            // echo '<li class='.'"'.'nav-item active'.'"'.'><a class='.'"'.'nav-link'.'"'.' href='.'"'.'anuncianteDash.php'.'"'.'><i class='.'"'.'fas fa-fw fa-tachometer-alt"></i><span>Home</span></a></li>';

          }
        ?>
      </ul>
      <div class="divHome">
        <div id="content-wrapper">
          <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Home</a>
              </li>
              <li class="breadcrumb-item active">Página Inicial</li>
            </ol>
            <div class="divImgHome">
              <img class="imgHome" src="Agenda Local - PNG.png">
            </div>
            <!-- Sticky Footer -->
            <footer class="sticky-footer">
              <div class="container my-auto">
                <div class="copyright text-center my-auto">
                  <span>Todos os direitos reservados ©
                    <a href="http://www.agendalocal.com.br/" target="_blank">Agenda Local 2019</a>
                  </span>
                </div>
              </div>
            </footer>
          </div>
        </div>
      </div>
      <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pronto para Sair?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">Seleciona "Logout" abaixo se você deseja encerrar esta sessão.</div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="insertSubmit" value="Logout"/>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
          if($_SERVER["REQUEST_METHOD"] == "POST")
          {
             session_destroy();
             echo "<script>location.href='login.php';</script>";
          }
          ?>
        </div>
      </div>
    </div>
  </body>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
</html>
