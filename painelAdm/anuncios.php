<?php
  ob_start();
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include("php/db_config.php");
  session_start();
  $conn = new db_conn();
  $db_connection = $conn->connection();
  if(!isset($_SESSION['user_id'])) { echo "<script>location.href='login.php';</script>"; }?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agenda Local - Admin Anúncios</title>

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
              <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Anúncios</li>
          </ol>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-body">
              <div class="table-responsive">
                <div class="divBtnAdicionar">
                  <button class="btn-adicionar btn" data-toggle="modal" data-target="#insertModal" >Adicionar Novo Registro</button>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nome</th>
                      <th>Tipo</th>
                      <th>Cidade</th>
                      <th>Expira em</th>
                      <th>Editar</th>
                      <th>Excluir</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nome</th>
                      <th>Tipo</th>
                      <th>Cidade</th>
                      <th>Expira em</th>
                      <th>Editar</th>
                      <th>Excluir</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $sqlStmtSelectAllAnuncios="SELECT * FROM agendalocal.anuncios";
                    if($resultStmtSelectAllAnuncios = pg_prepare($db_connection,"",  $sqlStmtSelectAllAnuncios))
                    {
                      $resultStmtSelectAllAnuncios = pg_execute($db_connection, "", array());
                      while($rowResultStmtSelectAllAnuncios = pg_fetch_array($resultStmtSelectAllAnuncios))
                      {
                        echo '<tr>';
                        echo '<td value='.'"'.$rowResultStmtSelectAllAnuncios["id_anuncio"].'"'.'>'.$rowResultStmtSelectAllAnuncios["nome"].'</td>';
                        echo '<td>'.$rowResultStmtSelectAllAnuncios["tipo"].'</td>';
                        $sqlStmtSelectCidadeAnuncios="SELECT cidades.nome FROM agendalocal.cidades WHERE cidades.id_cidade = ".$rowResultStmtSelectAllAnuncios["id_cidade"];
                        if($resultStmtSelectCidadeAnuncios = pg_prepare($db_connection,"",  $sqlStmtSelectCidadeAnuncios))
                        {
                          $resultStmtSelectCidadeAnuncios = pg_execute($db_connection, "", array());
                          while($rowResultStmtSelectCidadeAnuncios = pg_fetch_array($resultStmtSelectCidadeAnuncios))
                          {
                            echo '<td value='.'"'.$rowResultStmtSelectAllAnuncios["id_cidade"].'"'.'>'.$rowResultStmtSelectCidadeAnuncios["nome"].'</td>';
                          }
                        }
                        $dtime = new DateTime($rowResultStmtSelectAllAnuncios["expira_em"]);
                        echo '<td>'.$dtime->format("d-m-Y").'</td>';
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
          <div class="modal-body">Seleciona "Logout" abaixo se você deseja encerrar esta sessão.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="login.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Insert Modal -->
    <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Registro de Anúncios</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="announcementnameInsert" name="anuncionomeInsert" class="form-control" placeholder="Nome" required>
                  <label for="announcementnameInsert">Nome</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="announcementtypeInsert" name="anunciotipoInsert" class="form-control" placeholder="Tipo" required>
                  <label for="announcementtypeInsert">Tipo</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="citynameInsert" name="cidadenomeInsert" class="form-control" placeholder="Cidade" required>
                  <label for="citynameInsert">Cidade</label>
                </div>
              </div>
              <div class="form-group">
                <label>Expira em</label>
                <div class="form-label-group">
                  <input type="date" id="announcementexpireinInsert" name="anuncioexpiraemInsert" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="modal-footer modal-footer-overwrite">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="insertSubmit" value="Cadastrar Anúncio">
              <button class="btn btn-secondary btn-secondary-overwrite" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
          if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['anuncionomeInsert'])) && (!empty($_POST['anunciotipoInsert'])) && (!empty($_POST['cidadenomeInsert'])) && (!empty($_POST['anuncioexpiraemInsert'])))
          {
            $nome_anuncio=$_POST['anuncionomeInsert'];
            $tipo_anuncio=$_POST['anunciotipoInsert'];
            $nome_cidade=$_POST['cidadenomeInsert'];
            $expiraem_anuncio=$_POST['anuncioexpiraemInsert'];
            $sqlStmtSelectCidadeId="SELECT cidades.id_cidade FROM agendalocal.cidades WHERE cidades.nome='".$nome_cidade."'";
            if($resultStmtSelectCidadeId = pg_prepare($db_connection,"",  $sqlStmtSelectCidadeId))
            {
              $resultStmtSelectCidadeId = pg_execute($db_connection, "", array());
              if($rowResultStmtSelectCidadeId = pg_fetch_array($resultStmtSelectCidadeId))
              {
                $id_cidade = $rowResultStmtSelectCidadeId['id_cidade'];
                $sqlStmlInsertAnuncio="INSERT INTO agendalocal.anuncios(id_cidade, nome, tipo, expira_em) VALUES(".(int)$id_cidade.", '".$nome_anuncio."', '".$tipo_anuncio."', '".$expiraem_anuncio."')";
                if($resultStmtInsertAnuncio = pg_prepare($db_connection,"",  $sqlStmlInsertAnuncio))
                {
                  $resultStmtInsertAnuncio = pg_execute($db_connection, "", array());
                  if(pg_affected_rows($resultStmtInsertAnuncio)>0)
                  {
                    echo "<script>alert('Anúncio cadastrado com sucesso!');</script>";
                    echo "<script> location.href='anuncios.php';</script>";
                  }
                  else
                  {
                    echo "<script>alert('Ocorreu um erro ao tentar cadastrar o Anúncio! Ocorreu um erro ao tentar cadastrar o Anúncio!');</script>";
                    echo "<script> location.href='anuncios.php';</script>";
                  }
                }
              }
              else
              {
                echo "<script>alert('Cidade não foi encontrada! Verifique se o nome foi escrito corretamente.');</script>";
                echo "<script> location.href='anuncios.php';</script>";
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
            <h5 class="modal-title" id="exampleModalLabel">Edição de Registro de Anúncios</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="announcementnameEdit" name="anuncionomeEdit" class="form-control" placeholder="Nome" required>
                  <label for="announcementnameEdit">Nome</label>
                  <input type="hidden" id="announcementidEdit" name="anuncioidEdit"/>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="announcementtypeEdit" name="anunciotipoEdit" class="form-control" placeholder="Tipo" required>
                  <label for="announcementtypeEdit">Tipo</label>
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="citynameEdit" name="cidadenomeEdit" class="form-control" placeholder="Cidade" required>
                  <label for="citynameEdit">Cidade</label>
                </div>
              </div>
              <div class="form-group">
                <label>Expira em</label>
                <div class="form-label-group">
                  <input type="date" id="announcementexpireinEdit" name="anuncioexpiraemEdit" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="modal-footer modal-footer-overwrite">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="editSubmit" value="Editar Anúncio">
              <button class="btn btn-secondary btn-secondary-overwrite" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
          if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['anuncionomeEdit'])) && (!empty($_POST['anuncioidEdit'])) && (!empty($_POST['anunciotipoEdit'])) && (!empty($_POST['cidadenomeEdit'])) && (!empty($_POST['anuncioexpiraemEdit'])))
          {
            $id_anuncio=(int)$_POST['anuncioidEdit'];
            $nome_anuncio=$_POST['anuncionomeEdit'];
            $tipo_anuncio=$_POST['anunciotipoEdit'];
            $nome_cidade=$_POST['cidadenomeEdit'];
            $expiraem_anuncio=$_POST['anuncioexpiraemEdit'];

            $sqlStmtSelectCidadeId="SELECT cidades.id_cidade FROM agendalocal.cidades WHERE cidades.nome ='".$nome_cidade."'";
            if($resultStmtSelectCidadeId = pg_prepare($db_connection,"",  $sqlStmtSelectCidadeId))
            {
              $resultStmtSelectCidadeId = pg_execute($db_connection, "", array());
              if($rowResultStmtSelectCidadeId = pg_fetch_array($resultStmtSelectCidadeId))
              {
                $id_cidade = $rowResultStmtSelectCidadeId["id_cidade"];
                $sqlStmlEditAnuncio="UPDATE agendalocal.anuncios SET id_cidade=".(int)$id_cidade.", nome='".$nome_anuncio."', tipo='".$tipo_anuncio."', expira_em='".$expiraem_anuncio."' WHERE id_anuncio=".(int)$id_anuncio;
                if($resultStmtEditAnuncio = pg_prepare($db_connection,"",  $sqlStmlEditAnuncio))
                {
                  $resultStmtEditAnuncio = pg_execute($db_connection, "", array());
                  if(pg_affected_rows($resultStmtEditAnuncio)>0)
                  {
                    echo "<script>alert('Anúncio editada com sucesso!');</script>";
                    echo "<script> location.href='anuncios.php';</script>";
                  }
                  else
                  {
                    echo "<script>alert('Ocorreu um erro ao tentar editar o Anúncio! Tente novamente ou entre em contato com um administrador.');</script>";
                    echo "<script> location.href='anuncios.php';</script>";
                  }
                }
              }
              else
              {
                echo "<script>alert('Cidade não foi encontrada! Verifique se o nome foi escrito corretamente.');</script>";
                echo "<script> location.href='anuncios.php';</script>";
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
            <h5 class="modal-title" id="exampleModalLabel">Exclusão de Registro de Anúncios</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              Seleciona "Apagar Anúncio" abaixo se você deseja excluir o seguinte registro de Anúncios:
              <div class="form-row">
                <div class="col-md-6">
                  <label>Nome:</label>
                  <input type="hidden" id="hiddenannouncementidDelete" name="hiddenanuncioidDelete"/>
                  <label id="announcementnameDelete"></label>
                  <input type="hidden" id="hiddenannouncementnameDelete" name="hiddenanuncionomeDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Tipo:</label>
                  <label id="announcementtypeDelete"></label>
                  <input type="hidden" id="hiddenannouncementtypeDelete" name="hiddenanunciotipoDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Cidade:</label>
                  <label id="citynameDelete"></label>
                  <input type="hidden" id="hiddencitynameDelete" name="hiddencidadenomeDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Expira Em:</label>
                  <label id="announcementexpireinDelete"></label>
                  <input type="hidden" id="hiddenannouncementexpireinDelete" name="hiddenanuncioexpiraemDelete"/>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="deleteSubmit" value="Apagar Anúncio">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
          if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenanuncioidDelete'])) && (!empty($_POST['hiddenanuncionomeDelete'])) && (!empty($_POST['hiddenanunciotipoDelete'])) && (!empty($_POST['hiddencidadenomeDelete'])) && (!empty($_POST['hiddenanuncioexpiraemDelete'])))
          {
            $id_anuncio=(int)$_POST['hiddenanuncioidDelete'];
            $nome_anuncio=$_POST['hiddenanuncionomeDelete'];
            $tipo_anuncio=$_POST['hiddenanunciotipoDelete'];
            $nome_cidade=$_POST['hiddencidadenomeDelete'];
            $expiraem_anuncio=$_POST['hiddenanuncioexpiraemDelete'];
            $estado_separado = explode(" - ",$estado_composto);
            $sigla_estado = $estado_separado[1];
            $sqlStmtSelectCidadeId="SELECT cidades.id_cidade FROM agendalocal.cidades WHERE cidades.nome='".$nome_cidade."'";
            if($resultStmtSelectCidadeId = pg_prepare($db_connection,"",  $sqlStmtSelectCidadeId))
            {
              $resultStmtSelectCidadeId = pg_execute($db_connection, "", array());
              if($rowResultStmtSelectCidadeId = pg_fetch_array($resultStmtSelectCidadeId))
              {
                $id_cidade = $rowResultStmtSelectCidadeId["id_cidade"];
                $sqlStmlDeleteAnuncio="DELETE FROM agendalocal.anuncios WHERE anuncios.id_anuncio = ".(int)$id_anuncio." AND anuncios.id_cidade =".(int)$id_cidade." AND anuncios.nome='".$nome_anuncio."' AND anuncios.tipo='".$tipo_anuncio."' AND anuncios.expira_em='".$expiraem_anuncio."'";
                if($resultStmtDeleteAnuncio = pg_prepare($db_connection,"",  $sqlStmlDeleteAnuncio))
                {
                  $resultStmtDeleteAnuncio = pg_execute($db_connection, "", array());
                  if(pg_affected_rows($resultStmtDeleteAnuncio)>0)
                  {
                    echo "<script>alert('Anuncio excluída com sucesso!');</script>";
                    echo "<script> location.href='anuncios.php';</script>";
                  }
                  else
                  {
                    echo "<script>alert('Ocorreu um erro ao tentar excluir o Anuncio! Tente novamente ou entre em contato com um administrador.');</script>";
                    echo "<script> location.href='anuncios.php';</script>";
                  }
                }
              }
              else
              {
                echo "<script>alert('Cidade não foi encontrada! Verifique se o nome foi escrito corretamente.');</script>";
                echo "<script> location.href='anuncios.php';</script>";
              }
            }
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

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script type="text/javascript">
    $(".spanEdit").click(function()
    {
      var $rowEdit = $(this).closest("tr"),
      $tdAnuncioEdit = $rowEdit.find("td:eq(0)");

      document.getElementById('announcementnameEdit').value = $tdAnuncioEdit.text();
      document.getElementById('announcementidEdit').value = $tdAnuncioEdit.attr("value");

      $tdAnuncioTipoEdit = $rowEdit.find("td:eq(1)");
      document.getElementById('announcementtypeEdit').value = $tdAnuncioTipoEdit.text();

      $tdAnuncioCidadeEdit = $rowEdit.find("td:eq(2)");
      document.getElementById('citynameEdit').value = $tdAnuncioCidadeEdit.text();

      $tdAnuncioExpiraEmEdit = $rowEdit.find("td:eq(3)");
      var $datesplit = $tdAnuncioExpiraEmEdit.text().split("-");
      var $day = $datesplit[0];
      var $month = $datesplit[1];
      var $year = $datesplit[2];
      var $datefinal = new Date();
      $datefinal = $year+"-"+$month+"-"+$day;

      document.getElementById('announcementexpireinEdit').value = $datefinal;
    });

    $(".spanDelete").click(function()
    {
      var $rowDelete = $(this).closest("tr"),
      $tdAnuncioDelete = $rowDelete.find("td:eq(0)");

      document.getElementById('announcementnameDelete').innerHTML = $tdAnuncioDelete.text();
      document.getElementById('hiddenannouncementidDelete').value = $tdAnuncioDelete.attr("value");
      document.getElementById('hiddenannouncementnameDelete').value = $tdAnuncioDelete.text();

      $tdAnuncioTipoDelete = $rowDelete.find("td:eq(1)");
      document.getElementById('announcementtypeDelete').innerHTML = $tdAnuncioTipoDelete.text();
      document.getElementById('hiddenannouncementtypeDelete').value = $tdAnuncioTipoDelete.text();

      $tdAnuncioCidadeDelete = $rowDelete.find("td:eq(2)");
      document.getElementById('citynameDelete').innerHTML = $tdAnuncioCidadeDelete.text();
      document.getElementById('hiddencitynameDelete').value = $tdAnuncioCidadeDelete.text();
      $tdAnuncioExpiraEmDelete = $rowDelete.find("td:eq(3)");
      var $datesplit = $tdAnuncioExpiraEmDelete.text().split("-");
      var $day = $datesplit[0];
      var $month = $datesplit[1];
      var $year = $datesplit[2];
      var $datefinal = new Date();
      $datefinal = $year+"-"+$month+"-"+$day;
      document.getElementById('hiddenannouncementexpireinDelete').value = $datefinal;

      var $datefinaltext = new Date();
      $datefinaltext = $day+"-"+$month+"-"+$year;

      document.getElementById('announcementexpireinDelete').innerHTML = $datefinaltext;
    });
  </script>
</html>
