<?php
  ob_start();
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include("php/db_config.php");
  session_start();
  $conn = new db_conn();
  $db_connection = $conn->connection();
  if(!isset($_SESSION['user_id'])) { echo "<script>location.href='login.php';</script>"; }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agenda Local - Admin Usuários Aplicativo</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <!-- CSS Customizado Local Mobile -->
    <link href="css/local.css" type="text/css" rel="stylesheet">
    <!--Glyphicons-->
    <link href="glyph_css/glyph_bootstrap.css" type="text/css" rel="stylesheet"> <!-- http://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" -->
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" type="text/css" rel="stylesheet">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" type="text/css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" type="text/css" rel="stylesheet">
  </head>
  <body id="page-top">
    <?php
      if(!empty($_GET['modal_toshow']))
      {
        $modalToShow = $_GET['modal_toshow'];
        echo"<script> window.onload = function() { $('#".$modalToShow."').modal('show'); } </script>";
      }
    ?>
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top navLogoBar">
      <a class="navbar-brand mr-1" href="index.php"><img src="Agenda Local - PNG.png" class="imgLogo"></a>
      <!-- Navbar Search -->
      <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      </div>
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
    
      <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Usuários Aplicativo</li>
          </ol>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-body">
              <div class="divBtnAdicionar">
                <button class="btn-adicionar btn" href="#" data-toggle="modal" data-target="#insertModal">Adicionar Novo Usuário</button>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>Login</th>
                      <th>Senha</th>
                      <th>Editar</th>
                      <th>Excluir</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>Login</th>
                      <th>Senha</th>
                      <th>Editar</th>
                      <th>Excluir</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                      $sqlStmtSelectAllUsuarios="SELECT * FROM agendalocal.usuarios";
                      if($resultStmtSelectAllUsuarios = pg_prepare($db_connection,"",  $sqlStmtSelectAllUsuarios  ))
                      {
                        $resultStmtSelectAllUsuarios = pg_execute($db_connection, "", array());
                        while($rowResultStmtSelectAllUsuarios = pg_fetch_array($resultStmtSelectAllUsuarios))
                        {
                          echo '<tr>';
                          echo '<td value='.'"'.$rowResultStmtSelectAllUsuarios["id_usuario"].'"'.'>'.$rowResultStmtSelectAllUsuarios["pnome"].' '.$rowResultStmtSelectAllUsuarios["snome"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllUsuarios["email"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllUsuarios["login"].'</td>';
                          echo '<td><a href='.'"'.'#'.'"'.'class='.'"'.'spanPassword'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'senhaModal'.'"'.'><span class='.'"'.'spanPassword glyphicon glyphicon-pencil'.'"'.'></span> Editar Senha</a></td>';
                          echo '<td><a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'editModal'.'"'.'><span class='.'"'.'spanEdit glyphicon glyphicon-pencil'.'"'.'></span></a></td>';
                          echo '<td><a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'deleteModal'.'"'.'><span class='.'"'.'spanDelete glyphicon glyphicon-trash'.'"'.'></span></a></td>';
                          echo '</tr>';
                        }
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        <footer>
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Todos os direitos reservados © <a href="http://www.agendalocal.com.br/" target="_blank">Agenda Local 2019</a></span>
            </div>
          </div>
        </footer>
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
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="logoutSubmit" value="Logout"/>
              <input type="text" id="hiddenlogoutConfirm" name="hiddenlogoutConfirmar" value="ok" hidden/>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenlogoutConfirmar'])))
            {
              session_destroy();
              echo "<script>location.href='login.php';</script>";
            }
          ?>
        </div>
      </div>
    </div>

    <!--Insert Modal-->
    <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Usuário do Painel</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" id="formuserInsert">
            <div class="modal-body">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="usernameInsert" name="usuarionomeInsert" class="form-control" placeholder="Nome" required/>
                  <label for="usernameInsert">Nome</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="email" id="useremailInsert" name="usuarioemailInsert" class="form-control" placeholder="E-mail" required/>
                  <label for="useremailInsert">E-mail</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="userloginInsert" name="usuariologinInsert" class="form-control" placeholder="Login" required/>
                      <label for="userloginInsert">Login</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="password" id="userpasswordInsert" name="usuariosenhaInsert" class="form-control" placeholder="Senha" required/>
                      <label for="userpasswordInsert">Senha</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="password" id="userconfirmpasswordInsert" name="usuarioconfirmarsenhaInsert" onchange="onchangeSenhaInsert(userpasswordInsert.value, this.value)" class="form-control" placeholder="Confirmar Senha" required/>
                      <label for="userconfirmpasswordInsert">Confirmar Senha</label>
                      <input type="password" id="hiddenuserconfirmpasswordInsert" name="hiddenusuarioconfirmarsenhaInsert" value="correct" hidden/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="card-header cardheader-overwrite">
                      <div>
                        <label for="levelaccessoptionsInsert">Nível de Acesso</label>
                        <select id="levelaccessoptionsInsert" name="nivelacessoopcoesInsert" required>
                          <option value="">--Selecione uma opção--</option>
                          <?php
                            $sqlStmtSelectAllNiveisAcesso = "SELECT * FROM agendalocal.niveis_acesso";
                            if($resultStmtSelectAllNiveisAcesso = pg_prepare($db_connection,"",  $sqlStmtSelectAllNiveisAcesso))
                            {
                              $resultStmtSelectAllNiveisAcesso = pg_execute($db_connection, "", array());
                              while($rowResultStmtSelectAllNiveisAcesso = pg_fetch_array($resultStmtSelectAllNiveisAcesso))
                              { echo '<option value='.'"'.(int)$rowResultStmtSelectAllNiveisAcesso["id_nivelacesso"].'"'.'>'.$rowResultStmtSelectAllNiveisAcesso["nome"].'</option>'; }
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="insertSubmit" value="Cadastrar Usuário"/>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['usuarionomeInsert'])) && (!empty($_POST['usuarioemailInsert'])) && (!empty($_POST['usuariologinInsert'])) && (!empty($_POST['usuariosenhaInsert'])) && (!empty($_POST['usuarioconfirmarsenhaInsert'])) && (!empty($_POST['nivelacessoopcoesInsert'])))
            {
              $_SESSION['user_name'] = '';
              $_SESSION['error_msg'] = '';
              $nome_usuario = explode(' ', $_POST['usuarionomeInsert']);
              $pnome_usuario="";
              $snome_usuario="";
              $i = 0;
              if(sizeof($nome_usuario) == 2)
              {
                for($i=0;$i<sizeof($nome_usuario);$i++)
                {
                  if($i == 0) { $pnome_usuario = $nome_usuario[$i]; }
                  if($i == 1) { $snome_usuario = $nome_usuario[$i]; }
                  if($i > 1) { $snome_usuario = $snome_usuario.' '.$nome_usuario[$i]; }
                }
              }
              if((sizeof($nome_usuario) == 3) || (sizeof($nome_usuario) > 3))
              {
                for($i=0;$i<sizeof($nome_usuario);$i++)
                {
                  if($i == 0) { $pnome_usuario = $nome_usuario[$i]; }
                  if($i == 1) { $pnome_usuario = $pnome_usuario.' '.$nome_usuario[$i]; }
                  if($i == 2) { $snome_usuario = $nome_usuario[$i]; }
                  if($i > 2) { $snome_usuario = $snome_usuario.' '.$nome_usuario[$i]; }
                }
              }

              if((!empty($pnome_usuario)) && (!empty($snome_usuario)))
              {
                $email_usuario = $_POST['usuarioemailInsert'];
                $login_usuario = $_POST['usuariologinInsert'];
                $senha_usuario = md5($_POST['usuariosenhaInsert']);
                $confirmarsenha_usuario = md5($_POST['usuarioconfirmarsenhaInsert']);
                $nivelacesso_usuario = (int)$_POST['nivelacessoopcoesInsert'];
                $sqlStmtInsertUsuario = "INSERT INTO agendalocal.usuarios(id_nivelacesso, pnome, snome, email, login, senha) VALUES(".(int)$nivelacesso_usuario.", '".$pnome_usuario."', '".$snome_usuario."', '".$email_usuario."', '".$login_usuario."', '".$senha_usuario."')";
                if($resultStmtInsertUsuario = pg_prepare($db_connection,"",  $sqlStmtInsertUsuario))
                {
                  $resultStmtInsertUsuario = pg_execute($db_connection, "", array());
                  if(pg_affected_rows($resultStmtInsertUsuario)>0)
                  {
                    $_SESSION['user_name'] = $pnome_usuario.$snome_usuario;
                    $_SESSION['ok_type'] = "Cadastro";
                    $_SESSION['ok_msg'] = "O usuário de '".$_SESSION['user_name']."' foi cadastrado com sucesso!";
                    echo "<script>location.href='usuariospainel.php?modal_toshow=msgSucessModal';</script>";
                  }
                  else
                  {
                    $_SESSION['user_name'] = $pnome_usuario.$snome_usuario;
                    $_SESSION['error_msg'] = "Ocorreu um erro ao tentar cadastrar o usuário `".$_SESSION['user_name']."`!<br/>";
                    $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                    echo "<script>location.href='usuariospainel.php?modal_toshow=alertModal';</script>";
                  }
                }
              }
              else
              {
                $_SESSION['error_msg'] = "Forneça um primeiro nome <b>E</b> um sobrenome!";
                echo "<script>location.href='usuariospainel.php?modal_toshow=alertModal';</script>";
              }
            }
          ?>
          <div id="divMsgPanelInsert"></div>
        </div>
      </div>
    </div>

    <!-- Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Usuário do Painel</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" id="formuserEdit">
            <div class="modal-body">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="usernameEdit" name="usuarionomeEdit" class="form-control" placeholder="Nome" required/>
                  <label for="usernameEdit">Nome</label>
                  <input type="hidden" id="hiddenuseridEdit" name="hiddenusuarioidEdit"/>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="email" id="useremailEdit" name="usuarioemailEdit" class="form-control" placeholder="E-mail" required/>
                  <label for="useremailEdit">E-mail</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="userloginEdit" name="usuariologinEdit" class="form-control" placeholder="Login" required/>
                      <label for="userloginEdit">Login</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="card-header cardheader-overwrite">
                      <div>
                        <label for="levelaccessoptionsEdit">Nível de Acesso</label>
                        <select id="levelaccessoptionsEdit" name="nivelacessoopcoesEdit" required>
                          <option value="">--Selecione uma opção--</option>
                          <?php
                            $sqlStmtSelectAllNiveisAcesso = "SELECT * FROM agendalocal.niveis_acesso";
                            if($resultStmtSelectAllNiveisAcesso = pg_prepare($db_connection,"",  $sqlStmtSelectAllNiveisAcesso))
                            {
                              $resultStmtSelectAllNiveisAcesso = pg_execute($db_connection, "", array());
                              while($rowResultStmtSelectAllNiveisAcesso = pg_fetch_array($resultStmtSelectAllNiveisAcesso))
                              { echo '<option value='.'"'.(int)$rowResultStmtSelectAllNiveisAcesso["id_nivelacesso"].'"'.'>'.$rowResultStmtSelectAllNiveisAcesso["nome"].'</option>'; }
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="editSubmit" value="Editar Usuário"/>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenusuarioidEdit'])) && (!empty($_POST['usuarionomeEdit'])) && (!empty($_POST['usuarioemailEdit'])) && (!empty($_POST['usuariologinEdit'])) && (!empty($_POST['nivelacessoopcoesEdit'])))
            {
              $_SESSION['user_name'] = '';
              $_SESSION['error_msg'] = '';
              $id_usuario = (int)$_POST['hiddenusuarioidEdit'];
              $nome_usuario = explode(' ', $_POST['usuarionomeEdit']);
              $pnome_usuario="";
              $snome_usuario="";
              $i = 0;
              if(sizeof($nome_usuario) == 2)
              {
                for($i=0;$i<sizeof($nome_usuario);$i++)
                {
                  if($i == 0) { $pnome_usuario = $nome_usuario[$i]; }
                  if($i == 1) { $snome_usuario = $nome_usuario[$i]; }
                  if($i > 1) { $snome_usuario = $snome_usuario.' '.$nome_usuario[$i]; }
                }
              }
              if((sizeof($nome_usuario) == 3) || (sizeof($nome_usuario) > 3))
              {
                for($i=0;$i<sizeof($nome_usuario);$i++)
                {
                  if($i == 0) { $pnome_usuario = $nome_usuario[$i]; }
                  if($i == 1) { $pnome_usuario = $pnome_usuario.' '.$nome_usuario[$i]; }
                  if($i == 2) { $snome_usuario = $nome_usuario[$i]; }
                  if($i > 2) { $snome_usuario = $snome_usuario.' '.$nome_usuario[$i]; }
                }
              }

              if((!empty($pnome_usuario)) && (!empty($snome_usuario)))
              {
                $email_usuario = $_POST['usuarioemailEdit'];
                $login_usuario = $_POST['usuariologinEdit'];
                $nivelacesso_usuario = (int)$_POST['nivelacessoopcoesEdit'];

                $sqlStmtEditUsuario = "UPDATE agendalocal.usuarios SET id_nivelacesso=".(int)$nivelacesso_usuario.", pnome='".$pnome_usuario."', snome='".$snome_usuario."', email='".$email_usuario."', login='".$login_usuario."' WHERE id_usuario=".(int)$id_usuario;

                if($resultStmtEditUsuario = pg_prepare($db_connection,"",  $sqlStmtEditUsuario))
                {
                  $resultStmtEditUsuario = pg_execute($db_connection, "", array());
                  if(pg_affected_rows($resultStmtEditUsuario)>0)
                  {
                    $_SESSION['user_name'] = $pnome_usuario.$snome_usuario;
                    $_SESSION['ok_type'] = "Edição";
                    $_SESSION['ok_msg'] = "O usuário de '".$_SESSION['user_name']."' foi editado com sucesso!";
                    echo "<script>location.href='usuariospainel.php?modal_toshow=msgSucessModal';</script>";
                  }
                  else
                  {
                    $_SESSION['user_name'] = $pnome_usuario.$snome_usuario;
                    $_SESSION['error_msg'] = "Ocorreu um erro ao tentar editar o usuário `".$_SESSION['user_name']."`!<br/>";
                    $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                    echo "<script>location.href='usuariospainel.php?modal_toshow=alertModal';</script>";
                  }
                }
              }
              else
              {
                $_SESSION['error_msg'] = "Forneça um primeiro nome <b>E</b> um sobrenome!";
                echo "<script>location.href='usuariospainel.php?modal_toshow=alertModal';</script>";
              }
            }
          ?>
          <div id="divMsgPanelEdit"></div>
        </div>
      </div>
    </div>

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Exclusão de Usuário</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              Seleciona "Apagar Registro" abaixo se você deseja excluir o seguinte usuário:
              <div class="form-row">
                <div class="col-md-6">
                  <label>Nome:</label>
                  <input type="hidden" id="hiddenuseridDelete" name="hiddenusuarioidDelete"/>
                  <label id="usernameDelete"></label>
                  <input type="hidden" id="hiddenusernameDelete" name="hiddenusuarionomeDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>E-mail:</label>
                  <label id="useremailDelete"></label>
                  <input type="hidden" id="hiddenuseremailDelete" name="hiddenusuarioemailDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Login:</label>
                  <label id="userloginDelete"></label>
                  <input type="hidden" id="hiddenuserloginDelete" name="hiddenusuariologinDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Nível de Acesso:</label>
                  <label id="levelaccessDelete"></label>
                  <input type="hidden" id="hiddenlevelaccessDelete" name="hiddennivelacessoDelete"/>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="deleteSubmit" value="Apagar Registro">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenusuarioidDelete'])) && (!empty($_POST['hiddenusuarionomeDelete'])) && (!empty($_POST['hiddenusuarioemailDelete'])) && (!empty($_POST['hiddenusuariologinDelete'])) && (!empty($_POST['hiddennivelacessoDelete'])))
            {
              $_SESSION['user_name'] = '';
              $_SESSION['error_msg'] = '';
              $id_usuario = (int)$_POST['hiddenusuarioidDelete'];
              $nome_usuario = explode(' ', $_POST['hiddenusuarionomeDelete']);
              $pnome_usuario="";
              $snome_usuario="";
              $i = 0;
              if(sizeof($nome_usuario) == 2)
              {
                for($i=0;$i<sizeof($nome_usuario);$i++)
                {
                  if($i == 0) { $pnome_usuario = $nome_usuario[$i]; }
                  if($i == 1) { $snome_usuario = $nome_usuario[$i]; }
                  if($i > 1) { $snome_usuario = $snome_usuario.' '.$nome_usuario[$i]; }
                }
              }
              if((sizeof($nome_usuario) == 3) || (sizeof($nome_usuario) > 3))
              {
                for($i=0;$i<sizeof($nome_usuario);$i++)
                {
                  if($i == 0) { $pnome_usuario = $nome_usuario[$i]; }
                  if($i == 1) { $pnome_usuario = $pnome_usuario.' '.$nome_usuario[$i]; }
                  if($i == 2) { $snome_usuario = $nome_usuario[$i]; }
                  if($i > 2) { $snome_usuario = $snome_usuario.' '.$nome_usuario[$i]; }
                }
              }

              if((!empty($pnome_usuario)) && (!empty($snome_usuario)))
              {
                $email_usuario = $_POST['hiddenusuarioemailDelete'];
                $login_usuario = $_POST['hiddenusuariologinDelete'];
                $nivelacesso_usuario = (int)$_POST['hiddennivelacessoDelete'];

                $sqlStmtDeleteUsuario = "DELETE FROM agendalocal.usuarios WHERE id_usuario=".(int)$id_usuario." AND pnome='".$pnome_usuario."' AND snome='".$snome_usuario."' AND email='".$email_usuario."' AND login='".$login_usuario."'";
                if($resultStmtDeleteUsuario = pg_prepare($db_connection,"",  $sqlStmtDeleteUsuario))
                {
                  $resultStmtDeleteUsuario = pg_execute($db_connection, "", array());
                  if(pg_affected_rows($resultStmtDeleteUsuario)>0)
                  {
                    $_SESSION['user_name'] = $pnome_usuario.$snome_usuario;
                    $_SESSION['ok_type'] = "Deleção";
                    $_SESSION['ok_msg'] = "O usuário de '".$_SESSION['user_name']."' foi excluído com sucesso!";
                    echo "<script>location.href='usuariospainel.php?modal_toshow=msgSucessModal';</script>";
                  }
                  else
                  {
                    $_SESSION['user_name'] = $pnome_usuario.$snome_usuario;
                    $_SESSION['error_msg'] = "Ocorreu um erro ao tentar excluir o usuário `".$_SESSION['user_name']."`!<br/>";
                    $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                    echo "<script>location.href='usuariospainel.php?modal_toshow=alertModal';</script>";
                  }
                }
              }
              else
              {
                $_SESSION['error_msg'] = "Forneça um primeiro nome <b>E</b> um sobrenome!";
                echo "<script>location.href='usuariospainel.php?modal_toshow=alertModal';</script>";
              }
            }
          ?>
        </div>
      </div>
    </div>

    <!-- Senha Modal -->
    <div class="modal fade" id="senhaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Trocar de Senha</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" id="formpasswordSubmit">
            <div class="modal-body">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="password" id="adminpasswordSubmit" name="adminsenhaSubmit" onchange="onchangeAdminSenhaSubmit(this.value, hiddenadminpasswordSubmit.value)" class="form-control" placeholder="Senha do Administrador" required/>
                  <label for="adminpasswordSubmit">Senha do Administrador</label>
                  <?php echo '<input type='.'"'.'text'.'"'.' id='.'"'.'hiddenadminpasswordSubmit'.'"'.' name='.'"'.'hiddenadminsenhaSubmit'.'"'.' value='.'"'.$_SESSION['user_password'].'"'.' hidden>';?>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="password" id="usernewpasswordSubmit" name="usuarionovasenhaSubmit" class="form-control" placeholder="Nova Senha" required/>
                      <label for="usernewpasswordSubmit">Nova Senha</label>
                      <input type="text" id="hiddenuseridSubmit" name="hiddenusuarioidSubmit" hidden>
                      <input type="text" id="hiddenusernameSubmit" name="hiddenusuarionomeSubmit" hidden>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="password" id="userconfirmnewpasswordSubmit" name="usuarioconfirmarnovasenhaSubmit" onchange="onchangeSenhaSubmit(usernewpasswordSubmit.value, this.value)" class="form-control" placeholder="Confirmar Nova Senha" required/>
                      <label for="userconfirmnewpasswordSubmit">Confirmar Nova Senha</label>
                      <input type="password" id="hiddenuserconfirmnewpasswordSubmit" name="hiddenusuarioconfirmarnovasenhaSubmit" value="correct" hidden/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="newpasswordinsertSubmit" value="Cadastrar Nova Senha"/>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['adminsenhaSubmit'])) && (!empty($_POST['usuarionovasenhaSubmit'])) && (!empty($_POST['usuarioconfirmarnovasenhaSubmit'])))
            {
              $senha_admin = md5($_POST['adminsenhaSubmit']);
              $senha_nova = md5($_POST['usuarionovasenhaSubmit']);
              $senha_novaconfirmar = md5($_POST['usuarioconfirmarnovasenhaSubmit']);

              $sqlStmtSelectUsuario = "SELECT usuarios.nome";
            }
          ?>
          <div id="divMsgPanelSubmit"></div>
        </div>
      </div>
    </div>

    <!-- Mensagem Sucesso Modal -->
    <div class="modal fade" id="msgSucessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmação de <?php echo $_SESSION['ok_type']; ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="form-label-group">
                <?php echo $_SESSION['ok_msg']; ?><br/> Clica no botão abaixo para continuar.
              </div>
            </div>
          </div>
          <form method="POST">
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="msgSuccessSubmit"/>
              <input type="text" id="hiddenmsgsuccessSubmit" name="hiddenmsgSucessoSubmit"  value="Ok" hidden/>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenmsgSucessoSubmit'])))
            { echo "<script>location.href='usuariospainel.php';</script>"; }
          ?>
        </div>
      </div>
    </div>

    <!-- Alerta Modal -->
    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-overwrite">
          <div class="modal-header modal-header-overwrite error-msg">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h5 class="modal-title" id="exampleModalLabel">Mensagem de Alerta</h5>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="form-label-group">
                <?php echo $_SESSION['error_msg']; ?><br/> Clica no botão abaixo para continuar.
              </div>
            </div>
          </div>
          <form method="POST">
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="alertSubmit"/>
              <input type="text" id="hiddenalertSubmit" name="hiddenalertaSubmit"  value="Ok" hidden/>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenalertaSubmit'])))
            { echo "<script>location.href='usuariospainel.php';</script>"; }
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
  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>
  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script type="text/javascript">
    function onchangeSenhaInsert($password, $confirmpassword)
    {
      if($confirmpassword != $password)
      {
        var $divMsgPanelInsert = document.getElementById('divMsgPanelInsert');
        $divMsgPanelInsert.className = "card-header error-msg";
        $divMsgPanelInsert.innerHTML = "As senhas digitadas não correspondem uma à outra.<br/> Digite elas novamente.";
        var $passwordcheck = document.getElementById('hiddenuserconfirmpasswordInsert');
        $passwordcheck.value = "incorrect";
      }
      else
      {
        var $divMsgPanelInsert = document.getElementById('divMsgPanelInsert');
        $divMsgPanelInsert.classList.remove("card-header");
        $divMsgPanelInsert.classList.remove("error-msg");
        $divMsgPanelInsert.innerHTML = null;
        var $passwordcheck = document.getElementById('hiddenuserconfirmpasswordInsert');
        $passwordcheck.value = "correct";
      }
    }
    function onchangeAdminSenhaSubmit($adminpassword, $adminconfirmpassword)
    {
      var MD5 = function(d){result = M(V(Y(X(d),8*d.length)));return result.toLowerCase()};function M(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function X(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function V(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function Y(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}

        var $value = $adminpassword;
        var $result = MD5($value);
        if($result == $adminconfirmpassword)
        {
          alert('admin pass confirm');
        }
        else
        {
          alert('admin pass compare error');
        }
    }
    $('#formuserInsert').submit(function(e)
    {
      var $form = this;
      e.preventDefault();
      var $error = 0;
      $('#formuserInsert input').each(function(element)
      { if($.trim($(this).val()) == "") { $error = $error + 1; } });
      var $passwordcheck = document.getElementById('hiddenuserconfirmpasswordInsert');
      if($passwordcheck.value == "correct")
      {
        $error = 0;
      }
      else
      {
        $error = 1;
      }
      if(!$error)
      {
        var $divMsgPanelInsert = document.getElementById('divMsgPanelInsert');
        $divMsgPanelInsert.classList.remove("card-header");
        $divMsgPanelInsert.classList.remove("error-msg");
        $divMsgPanelInsert.className = "card-header ok-msg";
        $divMsgPanelInsert.innerHTML = "<b>Senhas Confirmadas!</b>";
        var $passwordcheck = document.getElementById('hiddenuserconfirmpasswordInsert');
        $passwordcheck.value = "correct";
        setTimeout(function() { $form.submit(); }, 3000);
      }
      else
      {
         var $divMsgPanelInsert = document.getElementById('divMsgPanelInsert');
        $divMsgPanelInsert.classList.remove("card-header");
        $divMsgPanelInsert.classList.remove("ok-msg");
        $divMsgPanelInsert.className = "card-header error-msg";
        $divMsgPanelInsert.innerHTML = "<b>As senhas digitadas estão incorretas! Digite elas novamente.</b>";
        var $passwordcheck = document.getElementById('hiddenuserconfirmpasswordInsert');
        $passwordcheck.value = "incorrect";
        return false;
      }
    });
    $(".spanPassword").click(function()
    {
      var $rowSubmit = $(this).closest("tr"),

      $tdUsuarioNomeSubmit = $rowSubmit.find("td:eq(0)");
      document.getElementById('hiddenuseridSubmit').value = $tdUsuarioNomeSubmit.attr("value");
      document.getElementById('hiddenusernameSubmit').value = $tdUsuarioNomeSubmit.text();
    });

    $(".spanEdit").click(function()
    {
      var $rowEdit = $(this).closest("tr"),

      $tdUsuarioNomeEdit = $rowEdit.find("td:eq(0)");
      document.getElementById('usernameEdit').value = $tdUsuarioNomeEdit.text();

      $tdUsuarioEmailEdit = $rowEdit.find("td:eq(1)");
      document.getElementById('useremailEdit').value = $tdUsuarioEmailEdit.text();

      $tdUsuarioLoginEdit = $rowEdit.find("td:eq(2)");
      document.getElementById('userloginEdit').value = $tdUsuarioLoginEdit.text();

      $tdNivelAcessoEdit = $rowEdit.find("td:eq(4)");
      var $tdNivelAcessoEditValue =  $tdNivelAcessoEdit.text();
      for (var i=0; i <document.getElementById('levelaccessoptionsEdit').length; i++)
      {
        var $levelsAccessOption = document.getElementById('levelaccessoptionsEdit')[i].text;
        if($levelsAccessOption == $tdNivelAcessoEditValue)
        {
          document.getElementById('levelaccessoptionsEdit').selectedIndex  = i;
          document.getElementById('hiddenuseridEdit').value = $tdUsuarioNomeEdit.attr("value");
        }
      }
    });
    $(".spanDelete").click(function()
    {
      var $rowDelete = $(this).closest("tr"),

      $tdUsuarioDelete = $rowDelete.find("td:eq(0)");
      document.getElementById('usernameDelete').innerHTML = $tdUsuarioDelete.text();
      document.getElementById('hiddenuseridDelete').value = $tdUsuarioDelete.attr("value");
      document.getElementById('hiddenusernameDelete').value = $tdUsuarioDelete.text();

      $tdUsuarioEmailDelete = $rowDelete.find("td:eq(1)");
      document.getElementById('useremailDelete').innerHTML = $tdUsuarioEmailDelete.text();
      document.getElementById('hiddenuseremailDelete').value = $tdUsuarioEmailDelete.text();

      $tdUsuarioLoginDelete = $rowDelete.find("td:eq(2)");
      document.getElementById('userloginDelete').innerHTML = $tdUsuarioLoginDelete.text();
      document.getElementById('hiddenuserloginDelete').value = $tdUsuarioLoginDelete.text();

      $tdNivelAcessoDelete = $rowDelete.find("td:eq(4)");
      document.getElementById('levelaccessDelete').innerHTML = $tdNivelAcessoDelete.text();
      document.getElementById('hiddenlevelaccessDelete').value = $tdNivelAcessoDelete.text();
    });
    $('#dataTable').DataTable(
    {
      language:
      {
        processing:     "Processando...",
        search:         "Pesquisar",
        lengthMenu:     "Mostrar _MENU_ resultados por página",
        info:           "Mostrando _START_ até _END_ de _TOTAL_ registros",
        infoEmpty:      "Mostrando 0 até 0 de 0 registros",
        infoFiltered:   "(Filtrados de _MAX_ registros)",
        infoPostFix:    "",
        loadingRecords: "Carregando...",
        zeroRecords:    "Nenhum registro encontrado",
        emptyTable:     "Nenhum registro encontrado",
        paginate:
        {
          first:    "Primeiro",
          previous: "Anterior",
          next:     "Próximo",
          last:     "Último"
        },
        aria:
        {
          sortAscending:  ": Ordenar colunas de forma ascendente",
          sortDescending: ": Ordenar colunas de forma descendente"
        }
      }
    });
  </script>
</html>
