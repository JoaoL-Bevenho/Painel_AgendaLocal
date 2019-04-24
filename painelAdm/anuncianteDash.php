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
    // echo "<script>alert('Realize o login');</script>";
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
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0 logoColor" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>
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
            <li class="breadcrumb-item"><a href="index.php">Home</a>
            </li>

            <li class="breadcrumb-item active">DashBoard</li>
          </ol>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-body">
              <form method="post">
                    <?php
                    /// ******** carrega os planos nas textbox **********
                      $sqlStmtSelectAllRegistros="SELECT * FROM agendalocal.planos WHERE planos.id=1";
                      if($resultStmtSelectAllRegistros = pg_prepare($db_connection,"",  $sqlStmtSelectAllRegistros))
                      {
                        $resultStmtSelectAllRegistros = pg_execute($db_connection, "", array());
                        while($rowResultStmtSelectAllRegistros = pg_fetch_array($resultStmtSelectAllRegistros))
                        {
                          echo "<h5>Detalhes da conta:</h5>";
                          echo "Plano: &ensp;";
                          echo $rowResultStmtSelectAllRegistros["plano1link"];
                          echo "&ensp;&ensp;&ensp; Status de Pagamento: &ensp;";
                          echo $rowResultStmtSelectAllRegistros["plano1link"];
                          echo "<br/><br/><br/>";
                          echo "<h5>Anúncio:</h5>";
                          echo '<td><a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'editModal'.'"'.'><span class='.'"'.'spanEdit glyphicon glyphicon-pencil'.'"'.'></span></a></td>';

                        }
                      }
                    ?>
                  </form>
                  <?php
                    // if(($_SERVER["REQUEST_METHOD"] == "POST"))
                    // {
                    //   $plano1link = $_POST['tx_ouro'];
                    //   $plano2link = $_POST['tx_prata'];
                    //   $plano1valor = $_POST['tx_ouro_valor'];
                    //   $plano2valor = $_POST['tx_prata_valor'];
                    //
                    //   $sqlStmtEditRegistro = "";
                    //   $sqlTextEditRegistro = "UPDATE agendalocal.planos SET plano1link='".$plano1link."',plano2link='".$plano2link."',plano1valor='".$plano1valor."',plano2valor='".$plano2valor."' WHERE planos.id=1";
                    //   $sqlStmtEditRegistro = $sqlTextEditRegistro;
                    //
                    // if($resultStmtEditRegistro = pg_prepare($db_connection,"",  $sqlStmtEditRegistro))
                    // {
                    //   $resultStmtEditRegistro = pg_execute($db_connection, "", array());
                    //   if(pg_affected_rows($resultStmtEditRegistro)>0)
                    //   {
                    //       //onde vai colocar o codigo que insere esse cara nos anunciantes 2312
                    //     echo "<script>alert('Planos Atualizados com sucesso!');</script>";
                    //     echo "<script>location.href='planos.php';</script>";
                    //   }
                    //   else
                    //   {
                    //     echo "<script>alert('Erro ao atualizar, tente novamente ou consulte o suporte técnico.');</script>";
                    //   }
                    // }
                    // }
                  ?>
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
    </div>

    <!--******************** Edit Modal ****************************-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Gerênciamento de Anúncio</h5>
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
                </div>
              </div>
            </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="editSubmit" value="Salvar">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenregistroidEdit'])) && (!empty($_POST['registronomeEdit'])) && (!empty($_POST['registrotelefoneEdit'])) && (!empty($_POST['registroenderecoEdit'])) && (!empty($_POST['registronumeroEdit'])) && (!empty($_POST['tiposregistroopcoesEdit'])) && (!empty($_POST['registroisclienteEdit'])))
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
