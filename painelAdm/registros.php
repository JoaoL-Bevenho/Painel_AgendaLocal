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
    if((isset($_GET['city_id'])) && (isset($_GET['state_initials'])))
    {
      $_SESSION['city_id'] = (int)$_GET['city_id'];
      $_SESSION['state_initials'] = $_GET['state_initials'];
      $sqlStmtSelectCidade = "SELECT cidades.nome FROM agendalocal.cidades WHERE cidades.id_cidade=".(int)$_SESSION['city_id'];
      if($resultStmtSelectCidade = pg_prepare($db_connection,"",  $sqlStmtSelectCidade))
      {
        $resultStmtSelectCidade = pg_execute($db_connection, "", array());
        if($rowResultStmtSelectCidade = pg_fetch_array($resultStmtSelectCidade))
        { $_SESSION['city_name'] = $rowResultStmtSelectCidade['nome']; }
      }
    }
    else
    {
      $_SESSION['error_msg'] = "Acesso ao formulário de <b>Anunciantes</b> é possível somente pelo formulário de <b>Cidades</b>!";
      echo "<script>location.href='cidades.php?modal_toshow=alertModal';</script>";
    }
  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
      Agenda Local - Registros
    </title>

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
      <a class="navbar-brand mr-1" href="index.php">
        <img src="Agenda Local - PNG.png" class="imgLogo">
      </a>
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

      <div id="content-wrapper">
        <div class="container-fluid">
          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="cidades.php">Cidades</a>
            </li>
            <li class="breadcrumb-item active">
              <?php
                echo $_SESSION['city_name'];
              ?>
            </li>
            <li class="breadcrumb-item active">Registros</li>
          </ol>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-body">
              <div class="divBtnAdicionar">
                <?php
                  if($_SESSION['nivel_acesso'] == "Administrador")
                  {
                    echo '<button class='.'"'.'btn-adicionar btn'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'insertModal'.'"'.'>Cadastrar Novo Registro</button>&nbsp';
                    echo '<button class='.'"'.'btn-adicionar btn btn-adicionar-margin-adm'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'arquivoModal'.'"'.'>Processar Arquivo de Registros</button>';
                    echo '<button class='.'"'.'btn-adicionar btn'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'sqlatualizaModal'.'"'.'>Lançar Atualização de Base de Dados</button>&nbsp';
                    echo '<button class='.'"'.'btn-adicionar btn'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'jsonatualizarModal'.'"'.'>Atualizar Arquivo .JSON</button>&nbsp';
                    echo '<button class='.'"'.'btn-adicionar btn'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'deletarregistrosModal'.'"'.'>Apagar Base de Dados</button>';

                  }
                  else if($_SESSION['nivel_acesso'] == "Financeiro") {}
                  else if($_SESSION['nivel_acesso'] == "Marketing")
                  {
                    echo '<button class='.'"'.'btn-adicionar btn'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'insertModal'.'"'.'>Cadastrar Novo Registro</button>&nbsp';
                    echo '<button class='.'"'.'btn-adicionar btn btn-adicionar-margin-market'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'arquivoModal'.'"'.'>Processar Arquivo de Registros</button>';
                    echo '<button class='.'"'.'btn-adicionar btn'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'sqlatualizaModal'.'"'.'>Lançar Atualização de Base de Dados</button>&nbsp';
                    echo '<button class='.'"'.'btn-adicionar btn'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'jsonatualizarModal'.'"'.'>Atualizar Arquivo .JSON</button>';
                  }
                ?>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Telefone</th>
                      <th>Endereço</th>
                      <th>Número</th>
                      <th>Tipo</th>
                      <th>Atividade</th>
                      <th>É Cliente?</th>
                      <th>Logomarca</th>
                      <?php
                        if($_SESSION['nivel_acesso'] == "Administrador")
                        {
                          echo '<th>Editar</th>';
                          echo '<th>Excluir</th>';
                        }
                        else if($_SESSION['nivel_acesso'] == "Financeiro") {}
                        else if($_SESSION['nivel_acesso'] == "Marketing")
                        {
                          echo '<th>Editar</th>';
                        }
                      ?>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nome</th>
                      <th>Telefone</th>
                      <th>Endereço</th>
                      <th>Número</th>
                      <th>Tipo</th>
                      <th>Atividade</th>
                      <th>É Cliente?</th>
                      <th>Logomarca</th>
                      <?php
                        if($_SESSION['nivel_acesso'] == "Administrador")
                        {
                          echo '<th>Editar</th>';
                          echo '<th>Excluir</th>';
                        }
                        else if($_SESSION['nivel_acesso'] == "Financeiro") {}
                        else if($_SESSION['nivel_acesso'] == "Marketing")
                        {
                          echo '<th>Editar</th>';
                        }
                      ?>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                      $sqlStmtSelectAllRegistros="SELECT * FROM agendalocal.clientes WHERE clientes.id_cidade=".(int)$_SESSION['city_id'];
                      if($resultStmtSelectAllRegistros = pg_prepare($db_connection,"",  $sqlStmtSelectAllRegistros))
                      {
                        $resultStmtSelectAllRegistros = pg_execute($db_connection, "", array());
                        while($rowResultStmtSelectAllRegistros = pg_fetch_array($resultStmtSelectAllRegistros))
                        {

                          echo '<tr>';
                          echo '<td value='.'"'.(int)$rowResultStmtSelectAllRegistros["id_cliente"].'"'.'>'.$rowResultStmtSelectAllRegistros["nome"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllRegistros["telefone"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllRegistros["endereco"].'</td>';
                          echo '<td>'.$rowResultStmtSelectAllRegistros["numero"].'</td>';
                          $sqlStmtSelectTipoRegistro = "SELECT tipos_registro.nome FROM agendalocal.tipos_registro WHERE tipos_registro.id_tiporegistro=".(int)$rowResultStmtSelectAllRegistros["id_tiporegistro"];
                          if($resultStmtSelectTipoRegistro = pg_prepare($db_connection,"",  $sqlStmtSelectTipoRegistro))
                          {
                            $resultStmtSelectTipoRegistro = pg_execute($db_connection, "", array());
                            while($rowResultStmtSelectTipoRegistro = pg_fetch_array($resultStmtSelectTipoRegistro))
                            { echo '<td value='.'"'.(int)$rowResultStmtSelectAllRegistros["id_tiporegistro"].'"'.'>'.$rowResultStmtSelectTipoRegistro["nome"].'</td>'; }
                          }
                          echo '<td>'.$rowResultStmtSelectAllRegistros["atividade"].'</td>';
                          if($rowResultStmtSelectAllRegistros["is_cliente"] == 1)
                          { echo '<td value='.'"'.'1'.'"'.'>Sim</td>'; }
                          else if($rowResultStmtSelectAllRegistros["is_cliente"] == 0)
                          { echo '<td value='.'"'.'2'.'"'.'>Não</td>'; }
                          echo '<td value='.'"'.$rowResultStmtSelectAllRegistros["logomarca"].'"'.'><a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'viewLogoModal'.'"'.' class='.'"'.'spanViewLogo'.'"'.'><span class='.'"'.'spanViewLogo glyphicon glyphicon-fullscreen'.'"'.'></span> Visualizar Logomarca</a></td>';
                          if($_SESSION['nivel_acesso'] == "Administrador")
                          {
                            echo '<td><a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'editModal'.'"'.'><span class='.'"'.'spanEdit glyphicon glyphicon-pencil'.'"'.'></span></a></td>';
                            echo '<td><a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'deleteModal'.'"'.'><span class='.'"'.'spanDelete glyphicon glyphicon-trash'.'"'.'></span></a></td>';
                          }
                          else if($_SESSION['nivel_acesso'] == "Financeiro") {}
                          else if($_SESSION['nivel_acesso'] == "Marketing")
                          {
                            echo '<td><a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'editModal'.'"'.'><span class='.'"'.'spanEdit glyphicon glyphicon-pencil'.'"'.'></span></a></td>';
                          }

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
              <input type="text" id="hiddenlogoutConfirm" name="hiddenlogoutConfirmar" value="logout" hidden/>
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
            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Registro de <?php echo $_SESSION['city_name'];?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST"  enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="recordnameInsert" name="registronomeInsert" class="form-control" placeholder="Nome" required/>
                  <label for="recordnameInsert">Nome</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="recordtelephoneInsert" name="registrotelefoneInsert" class="form-control" placeholder="Telefone" required/>
                  <label for="recordtelephoneInsert">Telefone</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="text" id="recordaddressInsert" name="registroenderecoInsert" class="form-control" placeholder="Endereço" required/>
                      <label for="recordaddressInsert">Endereço</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="text" id="recordnumberInsert" name="registronumeroInsert" class="form-control" placeholder="Número" required/>
                      <label for="recordnumberInsert">Número</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="recordactivityInsert" name="registroatividadeInsert" class="form-control" placeholder="Atividade"/>
                  <label for="recordactivityInsert">Atividade</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="card-header cardheader-overwrite">
                      <div>
                        <label for="typerecordoptionsInsert">Tipo de Registro</label>
                        <select id="typerecordoptionsInsert" name="tiposregistroopcoesInsert" required>
                          <option value="">--Selecione uma opção--</option>
                          <?php
                            $sqlStmtSelectAllTiposRegistro = "SELECT * FROM agendalocal.tipos_registro";
                            if($resultStmtSelectAllTiposRegistro = pg_prepare($db_connection,"",  $sqlStmtSelectAllTiposRegistro))
                            {
                              $resultStmtSelectAllTiposRegistro = pg_execute($db_connection, "", array());
                              while($rowResultStmtSelectAllTiposRegistro = pg_fetch_array($resultStmtSelectAllTiposRegistro))
                              { echo '<option value='.'"'.(int)$rowResultStmtSelectAllTiposRegistro["id_tiporegistro"].'"'.'>'.$rowResultStmtSelectAllTiposRegistro["nome"].'</option>'; }
                            }
                          ?>
                        </select>
                      </div>
                  </div>
                  </div>
                  <div class="col-md-6">
                    <label>É Cliente?</label>
                    <div class="form-label-group">
                      <input type="radio" id="recordisclientInsert" name="registroisclienteInsert" value="1" required> Sim<br/>
                      <input type="radio" id="recordisclientInsert" name="registroisclienteInsert" value="2" required> Não<br/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <label for="recordlogofileInsertBtn">LogoMarca</label><br/>
                  <input type="file" id="recordlogofileInsertBtn" name="registrologoarquivoInsertBtn"><br>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="insertSubmit" value="Cadastrar Registro" accept="image/jpeg, image/jpg, image/png"/>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['registronomeInsert'])) && (!empty($_POST['registrotelefoneInsert'])) && (!empty($_POST['registroenderecoInsert'])) && (!empty($_POST['registronumeroInsert'])) && (!empty($_POST['tiposregistroopcoesInsert'])) && (!empty($_POST['registroisclienteInsert'])) && (!empty($_FILES['registrologoarquivoInsertBtn']['name'])))
            {
              $logo = $_FILES['registrologoarquivoInsertBtn']['name'];
              $logo_newdir = "clientes_logos/";
              $file_tomove = $logo_newdir . $logo;
              $nome_registro = $_POST['registronomeInsert'];
              $telefone_registro = $_POST['registrotelefoneInsert'];
              $endereco_registro = $_POST['registroenderecoInsert'];
              $numero_registro = $_POST['registronumeroInsert'];
              $tipo_registro = (int)$_POST['tiposregistroopcoesInsert'];
              $iscliente_registro = (int)$_POST['registroisclienteInsert'];
              $city_id = $_SESSION['city_id'];
              $state_initials = $_SESSION['state_initials'];

              if(!empty($_POST['registroatividadeInsert']))
              { $atividade_registro = $_POST['registroatividadeInsert']; }
              else
              { $atividade_registro = ""; }

              $sqlStmtInsertRegistro = "";
              if($iscliente_registro == "1")
              {
                $sqlTextInsertRegistro = "INSERT INTO agendalocal.clientes(id_cidade, id_tiporegistro, nome, telefone, endereco, numero, atividade, is_cliente, logomarca) VALUES(".(int)$_SESSION['city_id'].", ".(int)$tipo_registro.", '".$nome_registro."', '".$telefone_registro."', '".$endereco_registro."', '".$numero_registro."', '".$atividade_registro."', 1, "."'".$file_tomove."'".")";
                $sqlStmtInsertRegistro = $sqlTextInsertRegistro;
              }
              else if($iscliente_registro == "2")
              {
                $sqlTextInsertRegistro = "INSERT INTO agendalocal.clientes(id_cidade, id_tiporegistro, nome, telefone, endereco, numero, atividade, is_cliente, logomarca) VALUES(".(int)$_SESSION['city_id'].", ".(int)$tipo_registro.", '".$nome_registro."', '".$telefone_registro."', '".$endereco_registro."', '".$numero_registro."', '".$atividade_registro."', 0, "."'".$file_tomove."'".")";
                $sqlStmtInsertRegistro = $sqlTextInsertRegistro;
              }
              if($resultStmtInsertRegistro = pg_prepare($db_connection,"",  $sqlStmtInsertRegistro))
              {
                $resultStmtInsertRegistro = pg_execute($db_connection, "", array());
                if(pg_affected_rows($resultStmtInsertRegistro)>0)
                {
                  copy($logo, $file_tomove);
                  $_SESSION['record_name'] = $nome_registro;
                  $_SESSION['ok_type'] = "Cadastro";
                  $_SESSION['ok_msg'] = "O registro '".$_SESSION['record_name']."' da cidade de '".$_SESSION['city_name']."' foi cadastrado com sucesso!";
                  echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=msgSucessModal';</script>";
                }
                else
                {
                  copy($logo, $file_tomove);
                  $_SESSION['record_name'] = $nome_registro;
                  $_SESSION['error_msg'] = "Ocorreu um erro ao tentar cadastrar o registro '".$_SESSION['record_name']."'!<br/>";
                  $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                  echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=alertModal';</script>";
                }
              }
            }
          ?>
        </div>
      </div>
    </div>

    <!--Edit Modal-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edição de Registro de <?php echo $_SESSION['city_name'];?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="recordnameEdit" name="registronomeEdit" class="form-control" placeholder="Nome" required/>
                  <label for="recordnameEdit">Nome</label>
                  <input type="hidden" id="hiddenrecordidEdit" name="hiddenregistroidEdit"/>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="recordtelephoneEdit" name="registrotelefoneEdit" class="form-control" placeholder="Telefone" required/>
                  <label for="recordtelephoneEdit">Telefone</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="text" id="recordaddressEdit" name="registroenderecoEdit" class="form-control" placeholder="Endereço" required/>
                      <label for="recordaddressEdit">Endereço</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="text" id="recordnumberEdit" name="registronumeroEdit" class="form-control" placeholder="Número" required/>
                      <label for="recordnumberEdit">Número</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="recordactivityEdit" name="registroatividadeEdit" class="form-control" placeholder="Atividade"/>
                  <label for="recordactivityEdit">Atividade</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="card-header cardheader-overwrite">
                      <div>
                        <label for="typerecordoptionsEdit">Tipo de Registro</label>
                        <select id="typerecordoptionsEdit" name="tiposregistroopcoesEdit">
                          <option value="0">--Selecione uma opção--</option>
                          <?php
                            $sqlStmtSelectAllTiposRegistro = "SELECT * FROM agendalocal.tipos_registro";
                            if($resultStmtSelectAllTiposRegistro = pg_prepare($db_connection,"",  $sqlStmtSelectAllTiposRegistro))
                            {
                              $resultStmtSelectAllTiposRegistro = pg_execute($db_connection, "", array());
                              while($rowResultStmtSelectAllTiposRegistro = pg_fetch_array($resultStmtSelectAllTiposRegistro))
                              { echo '<option value='.'"'.(int)$rowResultStmtSelectAllTiposRegistro["id_tiporegistro"].'"'.'>'.$rowResultStmtSelectAllTiposRegistro["nome"].'</option>'; }
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label>É Cliente?</label>
                    <div class="form-label-group">
                      <input type="radio" class="recordisclientEdit" name="registroisclienteEdit" value="1"> Sim<br/>
                      <input type="radio" class="recordisclientEdit" name="registroisclienteEdit" value="2"> Não<br/>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="recordlogofileInsertBtn">LogoMarca</label><br/>
                      <input type="file" id="recordlogofileEditBtn" name="registrologoarquivoeEditBtn"><br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="editSubmit" value="Editar Registro">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenregistroidEdit'])) && (!empty($_POST['registronomeEdit'])) && (!empty($_POST['registrotelefoneEdit'])) && (!empty($_POST['registroenderecoEdit'])) && (!empty($_POST['registronumeroEdit'])) && (!empty($_POST['tiposregistroopcoesEdit'])) && (!empty($_POST['registroisclienteEdit'])) && ($_FILES['cover_image']['size'] != 0))
            {
              $id_registro = (int)$_POST['hiddenregistroidEdit'];
              $nome_registro = $_POST['registronomeEdit'];
              $telefone_registro = $_POST['registrotelefoneEdit'];
              $endereco_registro = $_POST['registroenderecoEdit'];
              $numero_registro = $_POST['registronumeroEdit'];
              $tipo_registro = (int)$_POST['tiposregistroopcoesEdit'];
              $iscliente_registro = (int)$_POST['registroisclienteEdit'];
              $city_id = $_SESSION['city_id'];
              $state_initials = $_SESSION['state_initials'];

              if(!empty($_POST['registroatividadeEdit']))
              { $atividade_registro = $_POST['registroatividadeEdit']; }
              else
              { $atividade_registro = ""; }

              $sqlStmtEditRegistro = "";
              if($iscliente_registro == "1")
              {
                $sqlTextEditRegistro = "UPDATE agendalocal.clientes SET id_cidade=".(int)$_SESSION['city_id'].", id_tiporegistro=".(int)$tipo_registro.", nome='".$nome_registro."', telefone='".$telefone_registro."', endereco='".$endereco_registro."', numero='".$numero_registro."', atividade='".$atividade_registro."', is_cliente=1 WHERE id_cliente=".(int)$id_registro;
                $sqlStmtEditRegistro = $sqlTextEditRegistro;
              }
              else if($iscliente_registro == "2")
              {
                $sqlTextEditRegistro = "UPDATE agendalocal.clientes SET id_cidade=".(int)$_SESSION['city_id'].", id_tiporegistro=".(int)$tipo_registro.", nome='".$nome_registro."', telefone='".$telefone_registro."', endereco='".$endereco_registro."', numero='".$numero_registro."', atividade='".$atividade_registro."', is_cliente=0 WHERE id_cliente=".(int)$id_registro;
                $sqlStmtEditRegistro = $sqlTextEditRegistro;
              }
              if($resultStmtEditRegistro = pg_prepare($db_connection,"",  $sqlStmtEditRegistro))
              {
                $resultStmtEditRegistro = pg_execute($db_connection, "", array());
                if(pg_affected_rows($resultStmtEditRegistro)>0)
                {
                  $_SESSION['record_name'] = $nome_registro;
                  $_SESSION['ok_type'] = "Edição";
                  $_SESSION['ok_msg'] = "O registro '".$_SESSION['record_name']."' da cidade de '".$_SESSION['city_name']."' foi editado com sucesso!";
                  echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=msgSucessModal';</script>";
                }
                else
                {
                  $_SESSION['record_name'] = $nome_registro;
                  $_SESSION['error_msg'] = "Ocorreu um erro ao tentar editar o registro '".$_SESSION['record_name']."'!<br/>";
                  $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                  echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=alertModal';</script>";
                }
              }
            }
          ?>
        </div>
      </div>
    </div>

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Exclusão de Registro de <?php echo $_SESSION['city_name'];?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              Seleciona "Apagar Registro" abaixo se você deseja excluir o seguinte registro da cidade de <?php echo $_SESSION['city_name'];?>:
              <div class="form-row">
                <div class="col-md-6">
                  <label>Nome:</label>
                  <input type="hidden" id="hiddenrecordidDelete" name="hiddenregistroidDelete"/>
                  <label id="recordnameDelete"></label>
                  <input type="hidden" id="hiddenrecordnameDelete" name="hiddenregistronomeDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Telefone:</label>
                  <label id="recordtelephoneDelete"></label>
                  <input type="hidden" id="hiddenrecordtelephoneDelete" name="hiddenregistrotelefoneDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Endereço:</label>
                  <label id="recordaddressDelete"></label>
                  <input type="hidden" id="hiddenrecordaddressDelete" name="hiddenregistroenderecoDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Número:</label>
                  <label id="recordnumberDelete"></label>
                  <input type="hidden" id="hiddenrecordnumberDelete" name="hiddenregistronumeroDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Tipo de Registro:</label>
                  <label id="typerecordoptionsDelete"></label>
                  <input type="hidden" id="hiddentyperecordoptionsDelete" name="hiddentiporegistroopcoesDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Atividade:</label>
                  <label id="recordactivityDelete"></label>
                  <input type="hidden" id="hiddenrecordactivityDelete" name="hiddenregistroatividadeDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>É Cliente?:</label>
                  <label id="recordisclientDelete"></label>
                  <input type="hidden" id="hiddenrecordisclientDelete" name="hiddenregistroisclienteDelete"/>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="deleteSubmit" value="Apagar Registro">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenregistroidDelete'])) && (!empty($_POST['hiddenregistronomeDelete'])) && (!empty($_POST['hiddenregistrotelefoneDelete'])) && (!empty($_POST['hiddenregistroenderecoDelete'])) && (!empty($_POST['hiddenregistronumeroDelete'])) && (!empty($_POST['hiddentiporegistroopcoesDelete'])) && (!empty($_POST['hiddenregistroisclienteDelete'])))
            {
              $id_registro = (int)$_POST['hiddenregistroidDelete'];
              $nome_registro = $_POST['hiddenregistronomeDelete'];
              $telefone_registro = $_POST['hiddenregistrotelefoneDelete'];
              $endereco_registro = $_POST['hiddenregistroenderecoDelete'];
              $numero_registro = $_POST['hiddenregistronumeroDelete'];
              $tipo_registro = (int)$_POST['hiddentiporegistroopcoesDelete'];
              $iscliente_registro = (int)$_POST['hiddenregistroisclienteDelete'];
              $city_id = $_SESSION['city_id'];
              $state_initials = $_SESSION['state_initials'];

              if(!empty($_POST['hiddenregistroatividadeDelete']))
              { $atividade_registro = $_POST['hiddenregistroatividadeDelete']; }
              else
              { $atividade_registro = ""; }

              $sqlStmtDeleteRegistro = "";
              if($iscliente_registro == "1")
              {
                $sqlTextDeleteRegistro = "DELETE FROM agendalocal.clientes WHERE clientes.id_cliente=".(int)$id_registro." AND id_cidade=".(int)$_SESSION['city_id']." AND id_tiporegistro=".(int)$tipo_registro." AND nome='".$nome_registro."' AND telefone='".$telefone_registro."' AND endereco='".$endereco_registro."' AND numero='".$numero_registro."' AND atividade='".$atividade_registro."' AND is_cliente=1";
                $sqlStmtDeleteRegistro = $sqlTextDeleteRegistro;
              }
              else if($iscliente_registro == "2")
              {
                $sqlTextDeleteRegistro = "DELETE FROM agendalocal.clientes WHERE clientes.id_cliente=".(int)$id_registro." AND id_cidade=".(int)$_SESSION['city_id']." AND id_tiporegistro=".(int)$tipo_registro." AND nome='".$nome_registro."' AND telefone='".$telefone_registro."' AND endereco='".$endereco_registro."' AND numero='".$numero_registro."' AND atividade='".$atividade_registro."' AND is_cliente=0";
                $sqlStmtDeleteRegistro = $sqlTextDeleteRegistro;
              }
              if($resultStmtDeleteRegistro = pg_prepare($db_connection,"",  $sqlStmtDeleteRegistro))
              {
                $resultStmtDeleteRegistro = pg_execute($db_connection, "", array());
                if(pg_affected_rows($resultStmtDeleteRegistro)>0)
                {
                  $_SESSION['record_name'] = $nome_registro;
                  $_SESSION['ok_type'] = "Deleção";
                  $_SESSION['ok_msg'] = "O registro '".$_SESSION['record_name']."' da cidade de '".$_SESSION['city_name']."' foi excluído com sucesso!";
                  echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=msgSucessModal';</script>";
                }
                else
                {
                  $_SESSION['record_name'] = $nome_registro;
                  $_SESSION['error_msg'] = "Ocorreu um erro ao tentar excluir o registro '".$_SESSION['record_name']."'!<br/>";
                  $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                  echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=alertModal';</script>";
                }
              }
            }
          ?>
        </div>
      </div>
    </div>

    <!--File Modal-->
    <div class="modal fade" id="arquivoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Processamento de Arquivo de Registros de <?php echo $_SESSION['city_name'];?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <div class="form-label-group">
                  <label for="recordfileInsertBtn">Arquivo De Registros</label><br/>
                  <span class="spanViewLogo glyphicon glyphicon-folder-open"></span><input type="file" id="recordfileInsertBtn" name="registroarquivoInsertBtn"/><br>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="insertSubmit" value="Cadastrar Registros"/>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_FILES['registroarquivoInsertBtn']['tmp_name'])))
            {
              $arquivo_registros = new DomDocument();
              //manter comentado
              //$arquivo_anunciantes->load('/var/www/html/painel-agendalocal/arquivosXML/JATAIZINHO3.xml');

              //pega do upload, funcionando bem
              $arquivo_registros->load($_FILES['registroarquivoInsertBtn']['tmp_name']);

              $registrosXML = $arquivo_registros->getElementsByTagName("Row");
              $registroXML_proximo = true;
              $value_proximo = true;
              $city_id = $_SESSION['city_id'];
              $city_name = $_SESSION['city_name'];
              $state_initials = $_SESSION['state_initials'];
              $id_cidade = "";
              $nome_cidade = "";
              $id_tiporegistro = "";
              $telefone_registro = "";
              $nome_registro = "";
              $endereco_registro = "";
              $numero_registro = "";
              $atividade_registro = "";
              $iscliente_registro = "";

              foreach($registrosXML as $registroXML)
              {
                if($registroXML_proximo == true)
                {
                  error_reporting(0);
                  if(!is_null($registroXML->getElementsByTagName("Data")->item(0)->nodeValue))
                  {
                    if($registroXML->getElementsByTagName("Data")->item(0)->nodeValue != "is_cliente")
                    { $iscliente_registro = $registroXML->getElementsByTagName("Data")->item(0)->nodeValue; }
                  }
                  else { $iscliente_registro = null; }

                  if(!empty($registroXML->getElementsByTagName("Data")->item(1)->nodeValue))
                  {
                    if($registroXML->getElementsByTagName("Data")->item(1)->nodeValue != "telefone")
                    { $telefone_registro = $registroXML->getElementsByTagName("Data")->item(1)->nodeValue; }
                  }
                  else { $telefone_registro = null; }

                  if(!empty($registroXML->getElementsByTagName("Data")->item(2)->nodeValue))
                  {
                    if($registroXML->getElementsByTagName("Data")->item(2)->nodeValue != "nome")
                    { $nome_registro = $registroXML->getElementsByTagName("Data")->item(2)->nodeValue; }
                  }
                  else { $nome_registro = null; }

                  if(!empty($registroXML->getElementsByTagName("Data")->item(3)->nodeValue))
                  {
                    if($registroXML->getElementsByTagName("Data")->item(3)->nodeValue != "endereco")
                    { $endereco_registro = $registroXML->getElementsByTagName("Data")->item(3)->nodeValue; }
                  }
                  else { $endereco_registro = null; }

                  if(!empty($registroXML->getElementsByTagName("Data")->item(4)->nodeValue))
                  {
                    if($registroXML->getElementsByTagName("Data")->item(4)->nodeValue != "numero")
                    { $numero_registro = $registroXML->getElementsByTagName("Data")->item(4)->nodeValue; }
                  }
                  else { $numero_registro = null; }

                  if((!empty($registroXML->getElementsByTagName("Data")->item(6)->nodeValue)) || (!is_null($registroXML->getElementsByTagName("Data")->item(6)->nodeValue)))
                  {
                    if($registroXML->getElementsByTagName("Data")->item(5)->nodeValue != "atividade")
                    {
                      $atividade_registro = $registroXML->getElementsByTagName("Data")->item(5)->nodeValue;
                      $sqlStmtSelectTipoRegistro = "SELECT tipos_registro.id_tiporegistro FROM agendalocal.tipos_registro WHERE tipos_registro.nome='Comercial'";
                      if($resultStmtSelectTipoRegistro = pg_prepare($db_connection,"",  $sqlStmtSelectTipoRegistro))
                      {
                        $resultStmtSelectTipoRegistro = pg_execute($db_connection, "", array());
                        if($rowResultStmtSelectTipoRegistro = pg_fetch_array($resultStmtSelectTipoRegistro))
                        { $id_tiporegistro = (int)$rowResultStmtSelectTipoRegistro["id_tiporegistro"]; }
                      }
                    }
                    if($registroXML->getElementsByTagName("Data")->item(6)->nodeValue != "cidade")
                    {
                      if($registroXML->getElementsByTagName("Data")->item(6)->nodeValue != "0")
                      {
                        if($registroXML->getElementsByTagName("Data")->item(6)->nodeValue == $city_name)
                        {
                          $id_cidade = $city_id;
                          $nome_cidade = $city_name;
                          if(!empty($registroXML->getElementsByTagName("Data")->item(7)->nodeValue))
                          {
                            if($registroXML->getElementsByTagName("Data")->item(7)->nodeValue != "logomarca")
                            { $logomarca_registro = $registroXML->getElementsByTagName("Data")->item(7)->nodeValue; }
                          }
                          else { $logomarca_registro = null; }
                        }
                        else
                        {
                          $_SESSION['error_msg'] = "A cidade fornecida no arquivo .xml não corresponde à cidade do formulário: '".$_SESSION['city_name']."'!<br/>";
                          $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                          echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=alertModal';</script>";
                        }
                      }
                      else
                      {
                        if($nome_cidade == $city_name)
                        {
                          $id_cidade = $city_id;
                          $nome_cidade = $city_name;
                          if(!empty($registroXML->getElementsByTagName("Data")->item(7)->nodeValue))
                          {
                            if($registroXML->getElementsByTagName("Data")->item(7)->nodeValue != "logomarca")
                            { $logomarca_registro = $registroXML->getElementsByTagName("Data")->item(7)->nodeValue; }
                          }
                          else { $logomarca_registro = null; }
                        }
                        else
                        {
                          $_SESSION['error_msg'] = "A cidade fornecida no arquivo .xml não corresponde à cidade do formulário: '".$_SESSION['city_name']."'!<br/>";
                          $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                          echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=alertModal';</script>";
                        }
                      }
                    }
                  }
                  else
                  {
                    $atividade_registro = null;
                    $sqlStmtSelectTipoRegistro = "SELECT tipos_registro.id_tiporegistro FROM agendalocal.tipos_registro WHERE tipos_registro.nome='Residencial'";
                    if($resultStmtSelectTipoRegistro = pg_prepare($db_connection,"",  $sqlStmtSelectTipoRegistro))
                    {
                      $resultStmtSelectTipoRegistro = pg_execute($db_connection, "", array());
                      while($rowResultStmtSelectTipoRegistro = pg_fetch_array($resultStmtSelectTipoRegistro))
                      { $id_tiporegistro = (int)$rowResultStmtSelectTipoRegistro["id_tiporegistro"]; }
                    }
                    if($registroXML->getElementsByTagName("Data")->item(5)->nodeValue != "atividade")
                    {
                      if($registroXML->getElementsByTagName("Data")->item(5)->nodeValue != "0")
                      {
                        if($registroXML->getElementsByTagName("Data")->item(5)->nodeValue == $city_name)
                        {
                          $id_cidade = $city_id;
                          $nome_cidade = $city_name;
                          if(!empty($registroXML->getElementsByTagName("Data")->item(6)->nodeValue))
                          {
                            if($registroXML->getElementsByTagName("Data")->item(6)->nodeValue != "logomarca")
                            { $logomarca_registro = $registroXML->getElementsByTagName("Data")->item(6)->nodeValue; }
                          }
                          else { $logomarca_registro = null; }
                        }
                        else
                        {
                         $_SESSION['error_msg'] = "A cidade fornecida no arquivo .xml não corresponde à cidade do formulário: '".$_SESSION['city_name']."'!<br/>";
                          $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                          echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=alertModal';</script>";
                        }
                      }
                      else
                      {
                        if($nome_cidade == $city_name)
                        {
                          $id_cidade = $city_id;
                          $nome_cidade = $city_name;
                          if(!empty($registroXML->getElementsByTagName("Data")->item(6)->nodeValue))
                          {
                            if($registroXML->getElementsByTagName("Data")->item(6)->nodeValue != "logomarca")
                            { $logomarca_registro = $registroXML->getElementsByTagName("Data")->item(6)->nodeValue; }
                          }
                          else { $logomarca_registro = null; }
                        }
                        else
                        {
                          $_SESSION['error_msg'] = "A cidade fornecida no arquivo .xml não corresponde à cidade do formulário: '".$_SESSION['city_name']."'!<br/>";
                          $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                          echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=alertModal';</script>";
                        }
                      }
                    }
                  }

                  if((!is_null($id_cidade)) && (!empty($nome_cidade)) && (!is_null($id_tiporegistro)) && (!empty($telefone_registro)) && (!empty($nome_registro)) && (!empty($endereco_registro)) && (!empty($numero_registro)) && (!is_null($iscliente_registro)))
                  {
                    $sqlStmtRegistro = "";
                    if($iscliente_registro == "1")
                    {
                      $sqlStmtSelectRegistro = "SELECT clientes.id_cliente FROM agendalocal.clientes WHERE clientes.nome = '".$nome_registro."'";
                      if($resultStmtSelectRegistro = pg_prepare($db_connection,"",  $sqlStmtSelectRegistro))
                      {
                        $resultStmtSelectRegistro = pg_execute($db_connection, "", array());
                        if($rowResultStmtSelectRegistro = pg_fetch_array($resultStmtSelectRegistro))
                        {
                          $sqlTextEditRegistro = "UPDATE agendalocal.clientes SET id_cidade=".(int)$_SESSION['city_id'].", id_tiporegistro=".(int)$id_tiporegistro.", nome='".$nome_registro."', telefone='".$telefone_registro."', endereco='".$endereco_registro."', numero='".$numero_registro."', atividade='".$atividade_registro."', is_cliente=1 WHERE id_cliente=".(int)$rowResultStmtSelectRegistro['id_cliente'];
                          $sqlStmtRegistro = $sqlTextEditRegistro;
                        }
                        else
                        {
                          $sqlTextInsertRegistro = "INSERT INTO agendalocal.clientes(id_cidade, id_tiporegistro, nome, telefone, endereco, numero, atividade, is_cliente, logomarca) VALUES(".(int)$id_cidade.", ".(int)$id_tiporegistro.", '".$nome_registro."', '".$telefone_registro."', '".$endereco_registro."', '".$numero_registro."', '".$atividade_registro."', 1, '".$logomarca_registro."')";
                          $sqlStmtRegistro = $sqlTextInsertRegistro;
                        }
                      }
                    }
                    else if($iscliente_registro == "0")
                    {
                      $sqlStmtSelectRegistro = "SELECT clientes.id_cliente FROM agendalocal.clientes WHERE clientes.nome = '".$nome_registro."'";
                      if($resultStmtSelectRegistro = pg_prepare($db_connection,"",  $sqlStmtSelectRegistro))
                      {
                        $resultStmtSelectRegistro = pg_execute($db_connection, "", array());
                        if($rowResultStmtSelectRegistro = pg_fetch_array($resultStmtSelectRegistro))
                        {
                          $sqlTextEditRegistro = "UPDATE agendalocal.clientes SET id_cidade=".(int)$_SESSION['city_id'].", id_tiporegistro=".(int)$id_tiporegistro.", nome='".$nome_registro."', telefone='".$telefone_registro."', endereco='".$endereco_registro."', numero='".$numero_registro."', atividade='".$atividade_registro."', is_cliente=0 WHERE id_cliente=".(int)$rowResultStmtSelectRegistro['id_cliente'];
                          $sqlStmtRegistro = $sqlTextEditRegistro;
                        }
                        else
                        {
                          $sqlTextInsertRegistro = "INSERT INTO agendalocal.clientes(id_cidade, id_tiporegistro, nome, telefone, endereco, numero, atividade, is_cliente, logomarca) VALUES(".(int)$id_cidade.", ".(int)$id_tiporegistro.", '".$nome_registro."', '".$telefone_registro."', '".$endereco_registro."', '".$numero_registro."', '".$atividade_registro."', 0, '".$logomarca_registro."')";
                          $sqlStmtRegistro = $sqlTextInsertRegistro;
                        }

                      }
                    }
                    if($resultStmtInsertRegistro = pg_prepare($db_connection,"",  $sqlStmtRegistro))
                    {
                      $resultStmtInsertRegistro = pg_execute($db_connection, "", array());
                      if(pg_affected_rows($resultStmtInsertRegistro)>0)
                      {
                        $value_proximo =true;
                      }
                      else
                      {
                        $value_proximo =false;
                      }
                    }
                  }
                }
                if($value_proximo == true)
                {
                  $registroXML_proximo = true;
                }
                else if($value_proximo == false)
                {
                  $registroXML_proximo = false;
                }
              }
              $_SESSION['ok_type'] = "Cadastro de XML";
              $_SESSION['ok_msg'] = "Os registros do arquivo .xml referente à cidade de '".$_SESSION['city_name']."' foram cadastrados com sucesso!";
              echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=msgSucessModal';</script>";
            }
          ?>
        </div>
      </div>
    </div>

    <!-- Atualizar .sql -->
    <div class="modal fade" id="sqlatualizaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Atualização da Base de Dados de <?php echo $_SESSION['city_name'];?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <div class="form-label-group">
                  Clica no botão 'Atualizar Base de Dados' para confirmar a atualização da base de dados dos registros da cidade de <?php echo $_SESSION['city_name']; ?> dentro do aplicativo.
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Nº de Registros encontrados:</label>
                  <label id="recordactivityDelete">
                  <?php
                    $sqlStmtCountAllRegistros = "SELECT COUNT(id_cliente) AS total FROM agendalocal.clientes";
                    if($resultStmtCountAllRegistros = pg_prepare($db_connection,"",  $sqlStmtCountAllRegistros))
                    {
                      $resultStmtCountAllRegistros = pg_execute($db_connection, "", array());
                      while($rowResultStmtCountAllRegistros = pg_fetch_array($resultStmtCountAllRegistros))
                      { echo $rowResultStmtCountAllRegistros['total'];}
                    }
                  ?>
                  </label>
                  <input type="hidden" id="hiddenrecordactivityDelete" name="hiddenregistroatividadeDelete"/>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="insertSubmit" value="Atualizar Base de Dados">
              <input type="text" id="hiddensqlConfirm" name="hiddensqlConfirmar" value="confirmar" hidden>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddensqlConfirmar'])))
            {
              $city_id = $_SESSION['city_id'];
              $city_name = $_SESSION['city_name'];
              $state_initials = $_SESSION['state_initials'];

              $arquivo_sql = 'cidades_arquivos-sql/registros_'.$city_name.'-'.$state_initials.'.sql';
              $diretorio = dirname($arquivo_sql);
              $arqsql_cidade=fopen($arquivo_sql,"wa+");
              $sqlStmtSelectAllRegistros = "SELECT * FROM agendalocal.clientes";
              if($resultStmtSelectAllRegistros = pg_prepare($db_connection,"",  $sqlStmtSelectAllRegistros))
              {
                $resultStmtSelectAllRegistros = pg_execute($db_connection, "", array());
                if(!empty($resultStmtSelectAllRegistros))
                {
                  while($rowResultStmtSelectAllRegistros = pg_fetch_array($resultStmtSelectAllRegistros))
                  {
                    // (id_cidade, id_tiporegistro,, telefone,,, atividade,)
                    $nomeregistro_sql = $rowResultStmtSelectAllRegistros['nome'];
                    $isclienteregistro_sql = (int)$rowResultStmtSelectAllRegistros['is_cliente'];
                    $enderecoregistro_sql = $rowResultStmtSelectAllRegistros['endereco'];
                    $numeroregistro_sql = $rowResultStmtSelectAllRegistros['numero'];
                    $telefoneregistro_sql = $rowResultStmtSelectAllRegistros['telefone'];
                    $anuncianteregistro_sql = $rowResultStmtSelectAllRegistros['atividade'];
                    $str_sql = 'INSERT INTO clientes VALUES( null, '.'"'.$nomeregistro_sql.'"'.', '.$isclienteregistro_sql.', '.'"'.$enderecoregistro_sql.' '.$numeroregistro_sql.'"'.', '.'"'.'_CIDADE_'.'"'.', '.'"'.$telefoneregistro_sql.'"'.', '.'"'.$anuncianteregistro_sql.'"'.');'.PHP_EOL;
                    fwrite($arqsql_cidade, $str_sql);

                    $_SESSION['ok_type'] = "Atualização da Base de Dados";
                    $_SESSION['ok_msg'] = "A base de dados de registros referente à cidade de '".$_SESSION['city_name']."' foi atualizada com sucesso!";
                    echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=msgSucessModal';</script>";
                  }
                }
                else
                {
                  $_SESSION['error_msg'] = "Ocorreu um erro ao tentar atualizar a base de dados referente à cidade de '".$_SESSION['city_name']."'!<br/>";
                  $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                  echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=alertModal';</script>";
                }
              }
              fclose($arqsql_cidade);
            }
          ?>
        </div>
      </div>
    </div>

    <!-- Atualizar .json -->
    <div class="modal fade" id="jsonatualizarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Atualização da Base de Dados de <?php echo $_SESSION['city_name'];?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <div class="form-label-group">
                  Clica no botão 'Atualizar Arquivo .JSON' para confirmar a atualização do arquivo .json referenete à cidade de <?php echo $_SESSION['city_name']; ?> para que o aplicativo possa consumí-lo.
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Nº de Registros encontrados:</label>
                  <label id="recordactivityDelete">
                  <?php
                    $sqlStmtCountAllRegistros = "SELECT COUNT(id_cliente) AS total FROM agendalocal.clientes";
                    if($resultStmtCountAllRegistros = pg_prepare($db_connection,"",  $sqlStmtCountAllRegistros))
                    {
                      $resultStmtCountAllRegistros = pg_execute($db_connection, "", array());
                      while($rowResultStmtCountAllRegistros = pg_fetch_array($resultStmtCountAllRegistros))
                      { echo $rowResultStmtCountAllRegistros['total'];}
                    }
                  ?>
                  </label>
                  <input type="hidden" id="hiddenrecordactivityDelete" name="hiddenregistroatividadeDelete"/>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="insertSubmit" value="Atualizar Arquivo .JSON'">
              <input type="text" id="hiddenjsonConfirm" name="hiddenjsonConfirmar" value="confirmar" hidden>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenjsonConfirmar'])))
            {
              $city_id = $_SESSION['city_id'];
              $city_name = $_SESSION['city_name'];
              $state_initials = $_SESSION['state_initials'];

              $arquivo_json = 'cidades_arquivos-json/registros_'.$_SESSION['city_name'].'-'.$_SESSION['state_initials'].'.json';
              $diretorio = dirname($arquivo_json);
              $arqjson_cidade=fopen($arquivo_json,"wa+");
              $sqlStmtSelectAllRegistros = "SELECT * FROM agendalocal.clientes";
              if($resultStmtSelectAllRegistros = pg_prepare($db_connection,"",  $sqlStmtSelectAllRegistros))
              {
                $resultStmtSelectAllRegistros = pg_execute($db_connection, "", array());
                $i=0;
                if(!empty($resultStmtSelectAllRegistros))
                {
                  while($rowResultStmtSelectAllRegistros = pg_fetch_array($resultStmtSelectAllRegistros))
                  {
                    $json_response[$i]['CLIENTE_ID '] = "null";
                    $json_response[$i]['CLIENTE_NOME '] = $rowResultStmtSelectAllRegistros['nome'];
                    $json_response[$i]['CLIENTE_ISCLIENTE '] = $rowResultStmtSelectAllRegistros['is_cliente'];
                    $json_response[$i]['CLIENTE_ENDERECO '] = $rowResultStmtSelectAllRegistros['endereco'].' '.$rowResultStmtSelectAllRegistros['numero'];
                    $json_response[$i]['CLIENTE_CIDADE '] = "_CIDADE_";
                    $json_response[$i]['CLIENTE_TELEFONE '] = $rowResultStmtSelectAllRegistros['telefone'];
                    $json_response[$i]['CLIENTE_ATIVIDADE '] = $rowResultStmtSelectAllRegistros['atividade'];
                    $data_json['clientes'][$i] = $json_response[$i];
                    $i = $i + 1;
                  }
                  if(!$data_json==null)
                  {
                    $json_stringUTF8 = json_encode($data_json, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
                    fwrite($arqjson_cidade, $json_stringUTF8);
                    $_SESSION['ok_type'] = "Atualização do arquivo .JSON";
                    $_SESSION['ok_msg'] = "O arquivo .JSON referente à cidade de '".$_SESSION['city_name']."' foi atualizado com sucesso!";
                    echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=msgSucessModal';</script>";
                  }
                  else
                  {
                    $_SESSION['error_msg'] = "Ocorreu um erro ao tentar atualizar o arquivo .JSON referente à cidade de '".$_SESSION['city_name']."'!<br/>";
                    $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                    echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=alertModal';</script>";
                  }
                }
              }
              fclose($arqjson_cidade);
            }
          ?>
        </div>
      </div>
    </div>

    <!-- Deletar Base de Dados -->
    <div class="modal fade" id="deletarregistrosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deleção da Base de Dados de <?php echo $_SESSION['city_name'];?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <div class="form-label-group">
                  Clica no botão 'Apagar Base de Dados' para confirmar a deleção da base de dados dos registros da cidade de <?php echo $_SESSION['city_name']; ?> dentro do aplicativo.
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Nº de Registros encontrados:</label>
                  <label id="recordactivityDelete">
                  <?php
                    $sqlStmtCountAllRegistros = "SELECT COUNT(id_cliente) AS total FROM agendalocal.clientes";
                    if($resultStmtCountAllRegistros = pg_prepare($db_connection,"",  $sqlStmtCountAllRegistros))
                    {
                      $resultStmtCountAllRegistros = pg_execute($db_connection, "", array());
                      while($rowResultStmtCountAllRegistros = pg_fetch_array($resultStmtCountAllRegistros))
                      { echo $rowResultStmtCountAllRegistros['total'];}
                    }
                  ?>
                  </label>
                  <input type="hidden" id="hiddenrecordactivityDelete" name="hiddenregistroatividadeDelete"/>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="insertSubmit" value="Apagar Base de Dados">
              <input type="text" id="hiddensdeleteConfirm" name="hiddendeletarConfirmar" value="confirmar" hidden>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddendeletarConfirmar'])))
            {
              $sqlStmtDeleteRegistros = "DELETE FROM agendalocal.clientes";
              if($resultStmtDeleteRegistros = pg_prepare($db_connection,"",  $sqlStmtDeleteRegistros))
              {
                $resultStmtDeleteRegistros = pg_execute($db_connection, "", array());
                if(pg_affected_rows($resultStmtDeleteRegistros)>0)
                {
                  $_SESSION['record_name'] = $nome_registro;
                  $_SESSION['ok_type'] = "Deleção";
                  $_SESSION['ok_msg'] = "A base de dados da cidade de '".$_SESSION['city_name']."' foi excluído com sucesso!";
                  echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=msgSucessModal';</script>";
                }
                else
                {
                  $_SESSION['record_name'] = $nome_registro;
                  $_SESSION['error_msg'] = "Ocorreu um erro ao tentar excluir a base de dados de '".$_SESSION['city_name']."'!<br/>";
                  $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                  echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."&modal_toshow=alertModal';</script>";
                }
              }
            }
          ?>
        </div>
      </div>
    </div>

    <!-- visualizar logo Modal -->
    <div class="modal fade" id="viewLogoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Visualização de Logomarca</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-row">
              <div class="col-md-6 col-md-6-overwrite">
                <label>Diretório Logo:</label>
                <label id="recordlogoDirec" name="registrologoDiret"></label>
                <input type="hidden" id="hiddenrecordlogoDirec" name="hiddenregistrologoDiret"/>
                <img id="recordimglogoDirec" name="registroimglogoDiret" class="img-modal-fit"/>
              </div>
            </div>
          </div>
          <form method="POST">
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-block btn-primary-overwrite" data-dismiss="modal" id="msgSuccessSubmit">Voltar</button>
              <input type="text" id="hiddenmsgsuccessSubmit" name="hiddenmsgSucessoSubmit"  value="success" hidden/>
            </div>
          </form>
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
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="msgSuccessSubmit" value="Continuar"/>
              <input type="text" id="hiddenmsgsuccessSubmit" name="hiddenmsgSucessoSubmit"  value="success" hidden/>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenmsgSucessoSubmit'])))
            { echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."';</script>"; }
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
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="alertSubmit" value="Continuar"/>
              <input type="text" id="hiddenalertSubmit" name="hiddenalertaSubmit"  value="error" hidden/>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenalertaSubmit'])))
            { echo "<script>location.href='registros.php?city_id=".$_SESSION['city_id']."&state_initials=".$_SESSION['state_initials']."';</script>"; }
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
    $(".spanViewLogo").click(function()
    {
      var $logoDir = $(this).closest("tr"),

      $tdRegistroLogoDiretorio = $logoDir.find("td:eq(7)");
      document.getElementById('recordlogoDirec').innerHTML = $tdRegistroLogoDiretorio.attr("value");
      document.getElementById('recordimglogoDirec').src = $tdRegistroLogoDiretorio.attr("value");
    });

    $(".spanEdit").click(function()
    {
      var $rowEdit = $(this).closest("tr"),

      $tdRegistroNomeEdit = $rowEdit.find("td:eq(0)");
      document.getElementById('recordnameEdit').value = $tdRegistroNomeEdit.text();

      $tdRegistroTelefoneEdit = $rowEdit.find("td:eq(1)");
      document.getElementById('recordtelephoneEdit').value = $tdRegistroTelefoneEdit.text();

      $tdRegistroEnderecoEdit = $rowEdit.find("td:eq(2)");
      document.getElementById('recordaddressEdit').value = $tdRegistroEnderecoEdit.text();

      $tdRegistroNumeroEdit = $rowEdit.find("td:eq(3)");
      document.getElementById('recordnumberEdit').value = $tdRegistroNumeroEdit.text();

      $tdTipoRegistroEdit = $rowEdit.find("td:eq(4)");
      var $tdTipoRegistroEditValue =  $tdTipoRegistroEdit.text();
      for (var i=0; i <document.getElementById('typerecordoptionsEdit').length; i++)
      {
        var $typesRecordOption = document.getElementById('typerecordoptionsEdit')[i].text;
        if($typesRecordOption == $tdTipoRegistroEditValue)
        {
          document.getElementById('typerecordoptionsEdit').selectedIndex  = i;
          document.getElementById('hiddenrecordidEdit').value = $tdRegistroNomeEdit.attr("value");
        }
      }

      $tdRegistroAtividadeEdit = $rowEdit.find("td:eq(5)");
      document.getElementById('recordactivityEdit').value = $tdRegistroAtividadeEdit.text();

      $tdRegistroIsClienteEdit = $rowEdit.find("td:eq(6)");
      $tdRegistroIsClienteEditValue = $tdRegistroIsClienteEdit.attr("value");
      $recordIsClientRadBtn = document.getElementsByClassName('recordisclientEdit');
      for (var i = 0; i < $recordIsClientRadBtn.length; i++)
      {
        if ($recordIsClientRadBtn[i].value == $tdRegistroIsClienteEditValue)
        {
          $recordIsClientRadBtn[i].checked = true;
        }
        else
        {
          $recordIsClientRadBtn[i].checked = false;
        }
      }
    });
    $(".spanDelete").click(function()
    {
      var $rowDelete = $(this).closest("tr"),

      $tdRegistroDelete = $rowDelete.find("td:eq(0)");
      document.getElementById('recordnameDelete').innerHTML = $tdRegistroDelete.text();
      document.getElementById('hiddenrecordidDelete').value = $tdRegistroDelete.attr("value");
      document.getElementById('hiddenrecordnameDelete').value = $tdRegistroDelete.text();

      $tdRegistroTelefoneDelete = $rowDelete.find("td:eq(1)");
      document.getElementById('recordtelephoneDelete').innerHTML = $tdRegistroTelefoneDelete.text();
      document.getElementById('hiddenrecordtelephoneDelete').value = $tdRegistroTelefoneDelete.text();

      $tdRegistroEnderecoDelete = $rowDelete.find("td:eq(2)");
      document.getElementById('recordaddressDelete').innerHTML = $tdRegistroEnderecoDelete.text();
      document.getElementById('hiddenrecordaddressDelete').value = $tdRegistroEnderecoDelete.text();

      $tdRegistroNumeroDelete = $rowDelete.find("td:eq(3)");
      document.getElementById('recordnumberDelete').innerHTML = $tdRegistroNumeroDelete.text();
      document.getElementById('hiddenrecordnumberDelete').value = $tdRegistroNumeroDelete.text();

      $tdTipoRegistroDelete = $rowDelete.find("td:eq(4)");
      document.getElementById('typerecordoptionsDelete').innerHTML = $tdTipoRegistroDelete.text();
      document.getElementById('hiddentyperecordoptionsDelete').value = $tdTipoRegistroDelete.attr("value");

      $tdRegistroAtividadeDelete = $rowDelete.find("td:eq(5)");
      document.getElementById('recordactivityDelete').innerHTML = $tdRegistroAtividadeDelete.text();
      document.getElementById('hiddenrecordactivityDelete').value = $tdRegistroAtividadeDelete.text();

      $tdRegistroIsClienteDelete = $rowDelete.find("td:eq(6)");
      document.getElementById('recordisclientDelete').innerHTML = $tdRegistroIsClienteDelete.text();
      document.getElementById('hiddenrecordisclientDelete').value = $tdRegistroIsClienteDelete.attr("value");
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
