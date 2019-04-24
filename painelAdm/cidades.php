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
    $_SESSION['city_name'] = '';
  }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Agenda Local - Admin Cidades</title>

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
              <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Cidades</li>
          </ol>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-body">
              <div class="divBtnAdicionar">
                <?php
                  if($_SESSION['nivel_acesso'] == "Administrador")
                  {
                    echo '<button class='.'"'.'btn-adicionar btn'.'"'.' href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'insertModal'.'"'.'>Adicionar Novo Registro</button>';
                  }
                  else if($_SESSION['nivel_acesso'] == "Financeiro") {}
                  else if($_SESSION['nivel_acesso'] == "Marketing") {}
                ?>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Cidade</th>
                      <th>Estado</th>
                      <th>Base de Dados</th>
                      <!-- <th>Editar</th> -->
                      <?php
                        if($_SESSION['nivel_acesso'] == "Administrador") { echo '<th>Excluir</th>'; }
                        else if($_SESSION['nivel_acesso'] == "Financeiro") {}
                        else if($_SESSION['nivel_acesso'] == "Marketing") {}
                      ?>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Cidade</th>
                      <th>Estado</th>
                      <th>Base de Dados</th>
                      <!-- <th>Editar</th> -->
                      <?php
                        if($_SESSION['nivel_acesso'] == "Administrador") { echo '<th>Excluir</th>'; }
                        else if($_SESSION['nivel_acesso'] == "Financeiro") {}
                        else if($_SESSION['nivel_acesso'] == "Marketing") {}
                      ?>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $state_initials='';
                      $sqlStmtSelectAllCidades="SELECT * FROM agendalocal.cidades";
                      if($resultStmtSelectAllCidades = pg_prepare($db_connection,"",  $sqlStmtSelectAllCidades))
                      {
                        $resultStmtSelectAllCidades = pg_execute($db_connection, "", array());
                        while($rowResultStmtSelectAllCidades = pg_fetch_array($resultStmtSelectAllCidades))
                        {
                          echo '<tr>';
                          echo '<td value='.'"'.$rowResultStmtSelectAllCidades["id_cidade"].'"'.'>'.$rowResultStmtSelectAllCidades["nome"].'</td>';
                          $sqlStmtSelectEstadoCidades="SELECT estados.sigla, estados.nome FROM agendalocal.estados WHERE estados.id_estado = ".(int)$rowResultStmtSelectAllCidades["id_estado"];
                          if($resultStmtSelectEstadoCidades = pg_prepare($db_connection,"",  $sqlStmtSelectEstadoCidades))
                          {
                            $resultStmtSelectEstadoCidades = pg_execute($db_connection, "", array());
                            while($rowResultStmtSelectEstadoCidades = pg_fetch_array($resultStmtSelectEstadoCidades))
                            {
                              $state_initials=$rowResultStmtSelectEstadoCidades["sigla"];
                              echo '<td value='.'"'.$rowResultStmtSelectEstadoCidades["nome"].'"'.'>'.$rowResultStmtSelectEstadoCidades["sigla"].'</td>';

                            }
                          }
                          echo '<td><a href='.'"'.'registros.php?city_id='.$rowResultStmtSelectAllCidades["id_cidade"].'&state_initials='.$state_initials.'"'.'><span class='.'"'.'spanRedirect glyphicon glyphicon-list-alt'.'"'.'></span></a></td>';
                          // echo '<td><a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'editModal'.'"'.'><span class='.'"'.'spanEdit glyphicon glyphicon-pencil'.'"'.'></span></a></td>';
                          if($_SESSION['nivel_acesso'] == "Administrador")
                          {
                            echo '<td><a href='.'"'.'#'.'"'.' data-toggle='.'"'.'modal'.'"'.' data-target='.'"'.'#'.'deleteModal'.'"'.'><span class='.'"'.'spanDelete glyphicon glyphicon-trash'.'"'.'></span></a></td>';
                          }
                          else if($_SESSION['nivel_acesso'] == "Financeiro") {}
                          else if($_SESSION['nivel_acesso'] == "Marketing") {}
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
            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Registro de Cidades</h5>
            <button class="close" type="button" data-dismiss="modal q" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              <div class="form-group">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="cityInsert" name="cidadeInsert" class="form-control" placeholder="Cidade" required/>
                    <label for="cityInsert">Cidade</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card-header cardheader-overwrite">
                    <div>
                      <label for="stateoptionsInsert">Estado</label>
                      <select id="stateoptionsInsert" name="estadoopcoesInsert" required>
                        <option value="0">--Selecione uma opção--</option>
                        <?php
                          $sqlStmtSelectAllEstados="SELECT * FROM agendalocal.estados";
                          if($resultStmtSelectAllEstados = pg_prepare($db_connection,"",  $sqlStmtSelectAllEstados))
                          {
                            $resultStmtSelectAllEstados = pg_execute($db_connection, "", array());
                            while($rowResultStmtSelectAllEstados = pg_fetch_array($resultStmtSelectAllEstados))
                            {
                              echo '<option value='.'"'.$rowResultStmtSelectAllEstados["id_estado"].':'.$rowResultStmtSelectAllEstados['sigla'].'"'.'>'.$rowResultStmtSelectAllEstados["nome"].' - '.$rowResultStmtSelectAllEstados['sigla'].'</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="insertSubmit" value="Cadastrar Cidade"/>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['cidadeInsert'])) && (!empty($_POST['estadoopcoesInsert'])))
            {
              $_SESSION['city_name'] = '';
              $_SESSION['error_msg'] = '';
              $nome_cidade=$_POST['cidadeInsert'];
              $estado_array=$_POST['estadoopcoesInsert'];
              list($id_estado, $sigla_estado) = explode(':', $estado_array);
              $sqlStmtSelectCidade="SELECT * FROM agendalocal.cidades WHERE cidades.id_estado = ".(int)$id_estado." AND cidades.nome = '".$nome_cidade."'";
              if($resultStmtSelectCidade = pg_prepare($db_connection,"",  $sqlStmtSelectCidade))
              {
                $resultStmtSelectCidade = pg_execute($db_connection, "", array());
                if($rowResultStmtSelectCidade = pg_fetch_array($resultStmtSelectCidade))
                {
                  echo "<script>alert('Cidade ja cadastrada');</script>";
                  echo "<script>location.href='cidades.php';</script>";
                }
                else
                {
                  $sqlStmlInsertCidade="INSERT INTO agendalocal.cidades(id_estado, nome) VALUES(".(int)$id_estado.", '".$nome_cidade."')";
                  if($resultStmtInsertCidade = pg_prepare($db_connection,"",  $sqlStmlInsertCidade))
                  {
                    $resultStmtInsertCidade = pg_execute($db_connection, "", array());
                    if(pg_affected_rows($resultStmtInsertCidade)>0)
                    {
                      $arquivo_sql = 'cidades_arquivos-sql/registros_'.$nome_cidade.'-'.$sigla_estado.'.sql';
                      $diretorio = dirname($arquivo_sql);
                      if(!file_exists($arquivo_sql))
                      {
                        mkdir($diretorio, 0755, true);
                        $arqsql_cidade=fopen($arquivo_sql,"wa+");
                        fwrite($arqsql_cidade, '');
                        fclose($arqsql_cidade);

                        $_SESSION['city_name'] = $nome_cidade;
                        $_SESSION['ok_type'] = "Cadastro";
                        $_SESSION['ok_msg'] = "A cidade '".$_SESSION['city_name']."' foi cadastrada com sucesso!";
                        echo "<script>location.href='cidades.php?modal_toshow=msgSucessModal';</script>";
                      }
                      else
                      {
                        $_SESSION['city_name'] = $nome_cidade;
                        $_SESSION['ok_type'] = "Cadastro";
                        $_SESSION['ok_msg'] = "A cidade '".$_SESSION['city_name']."' foi cadastrada com sucesso!";
                        echo "<script>location.href='cidades.php?modal_toshow=msgSucessModal';</script>";
                      }

                      $arquivo_json = 'cidades_arquivos-json/registros_'.$nome_cidade.'-'.$sigla_estado.'.json';
                      $diretorio = dirname($arquivo_json);
                      if(!file_exists($arquivo_json))
                      {
                        mkdir($diretorio, 0755, true);
                        $arqjson_cidade=fopen($arquivo_json,"wa+");
                        fwrite($arqjson_cidade, '');
                        fclose($arqjson_cidade);
                        $_SESSION['city_name'] = $nome_cidade;
                        $_SESSION['ok_type'] = "Cadastro";
                        $_SESSION['ok_msg'] = "A cidade '".$_SESSION['city_name']."' foi cadastrada com sucesso!";
                        echo "<script>location.href='cidades.php?modal_toshow=msgSucessModal';</script>";
                      }
                      else
                      {
                        $_SESSION['city_name'] = $nome_cidade;
                        $_SESSION['ok_type'] = "Cadastro";
                        $_SESSION['ok_msg'] = "A cidade '".$_SESSION['city_name']."' foi cadastrada com sucesso!";
                        echo "<script>location.href='cidades.php?modal_toshow=msgSucessModal';</script>";
                      }
                    }
                    else
                    {
                      $_SESSION['city_name'] = $nome_cidade;
                      $_SESSION['error_msg'] = "Ocorreu um erro ao tentar cadastrar a cidade `".$_SESSION['city_name']."`!<br/>";
                      $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                      echo "<script>location.href='cidades.php?modal_toshow=alertModal';</script>";
                    }
                  }
                }
              }
            }
          ?>
        </div>
      </div>
    </div>

    <!--Edit Modal-->
    <!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edição de Registro de Cidades</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div> -->
          <!-- <form method="POST">
            <div class="modal-body">
              <div class="form-group">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" id="citynameEdit" name="cidadenomeEdit" class="form-control" placeholder="Cidade" required/>
                    <label for="cityEdit">Cidade</label>
                    <input type="hidden" id="hiddencityidEdit" name="hiddencidadeidEdit"/>
                    <input type="hidden" id="hiddencitynameEdit" name="hiddencidadenomeEdit"/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card-header cardheader-overwrite">
                    <div>
                      <label for="stateoptionsEdit">Estado</label>
                      <select id="stateoptionsEdit" name="estadoopcoesEdit" required>
                        <option value="">--Selecione uma opção--</option>
                        <?php
                          // $sqlStmtSelectAllEstados="SELECT * FROM agendalocal.estados";
                          // if($resultStmtSelectAllEstados = pg_prepare($db_connection,"",  $sqlStmtSelectAllEstados))
                          // {
                          //   $resultStmtSelectAllEstados = pg_execute($db_connection, "", array());
                          //   while($rowResultStmtSelectAllEstados = pg_fetch_array($resultStmtSelectAllEstados))
                          //   {
                          //     echo '<option value='.'"'.$rowResultStmtSelectAllEstados["id_estado"].':'.$rowResultStmtSelectAllEstados['sigla'].'"'.'>'.$rowResultStmtSelectAllEstados["nome"].' - '.$rowResultStmtSelectAllEstados['sigla'].'</option>';
                          //   }
                          // }
                        ?>
                      </select>
                      <input type="hidden" id="hiddenstateoptionsEdit" name="hiddenestadoopcoesEdit"/>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="editSubmit" value="Editar Cidade"/>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </form> -->
          <!-- <?php
            // if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['cidadenomeEdit'])) && (!empty($_POST['hiddencidadeidEdit'])) && (!empty($_POST['hiddencidadenomeEdit'])) && (!empty($_POST['estadoopcoesEdit'])) && (!empty($_POST['hiddenestadoopcoesEdit'])))
            // {
            //   $id_cidade=(int)$_POST['hiddencidadeidEdit'];
            //   $old_nomecidade=$_POST['hiddencidadenomeEdit'];
            //   $nome_cidade=$_POST['cidadenomeEdit'];
            //   $estado_array=$_POST['estadoopcoesEdit'];
            //   $hidden_estadoarray=$_POST['hiddenestadoopcoesEdit'];
            //   list($id_estado, $sigla_estado) = explode(':', $estado_array);
            //   list($old_idestado, $old_siglaestado) = explode(':', $hidden_estadoarray);
            //   $sqlStmtSelectCidade="SELECT * FROM agendalocal.cidades WHERE cidades.id_estado = ".$id_estado." AND cidades.nome = '".$nome_cidade."'";
            //   if($resultStmtSelectCidade = pg_prepare($db_connection,"",  $sqlStmtSelectCidade))
            //   {
            //     $resultStmtSelectCidade = pg_execute($db_connection, "", array());
            //     if($rowResultStmtSelectCidade = pg_fetch_array($resultStmtSelectCidade))
            //     {
            //       echo "<script>alert('Cidade ja cadastrada');</script>";
            //       echo "<script> location.href='cidades.php';</script>";
            //     }
            //     else
            //     {
            //       $sqlStmlUpdateCidade="UPDATE agendalocal.cidades SET id_estado=".(int)$id_estado.", nome='".$nome_cidade."' WHERE id_cidade=".(int)$id_cidade;
            //       if($resultStmtUpdateCidade = pg_prepare($db_connection,"",  $sqlStmlUpdateCidade))
            //       {
            //         $resultStmtUpdateCidade = pg_execute($db_connection, "", array());
            //         if(pg_affected_rows($resultStmtUpdateCidade)>0)
            //         {
            //           $old_arquivosql = 'cidades_arquivos-sql/registros_'.$old_nomecidade.'-'.$old_siglaestado.'.sql';
            //           if(!file_exists($old_arquivosql))
            //           {
            //             $new_arquivosql = 'cidades_arquivos-sql/registros_'.$nome_cidade.'-'.$sigla_estado.'.sql';
            //             $new_diretorio = dirname($new_arquivosql);
            //             mkdir($new_diretorio, 0755, true);
            //             $arqsql_cidade=fopen($new_arquivosql,"wa+");
            //             fwrite($arqsql_cidade, '');
            //             fclose($arqsql_cidade);
            //             echo "<script>alert('O arquivo .sql referente à cidade de ".$nome_cidade." foi gerado com sucesso!');</script>";
            //             echo "<script>alert('A cidade ".$nome_cidade." foi editada com sucesso!');</script>";
            //             echo "<script>location.href='cidades.php';</script>";
            //           }
            //           else
            //           {
            //             $new_arquivosql = 'cidades_arquivos-sql/registros_'.$nome_cidade.'-'.$sigla_estado.'.sql';
            //             rename($old_arquivosql, $new_arquivosql);
            //             echo "<script>alert('O registro `".$nome_cidade."` já possui um arquivo .sql referente a ela! Verifique seus dados!');</script>";
            //             echo "<script>alert('O registro `".$nome_cidade."` foi editado com sucesso!');</script>";
            //             echo "<script>location.href='cidades.php';</script>";
            //           }

            //           $old_arquivojson = 'cidades_arquivos-json/registros_'.$old_nomecidade.'-'.$old_siglaestado.'.json';
            //           if(!file_exists($old_arquivosql))
            //           {
            //             $new_arquivojson = 'cidades_arquivos-sql/registros_'.$nome_cidade.'-'.$sigla_estado.'.json';
            //             $new_diretorio = dirname($new_arquivojson);
            //             mkdir($new_diretorio, 0755, true);
            //             $arqjson_cidade=fopen($new_arquivojson,"wa+");
            //             fwrite($arqjson_cidade, '');
            //             fclose($arqjson_cidade);
            //             echo "<script>alert('O arquivo .json referente à cidade de ".$nome_cidade." foi gerado com sucesso!');</script>";
            //             echo "<script>alert('A cidade ".$nome_cidade." foi editada com sucesso!');</script>";
            //             echo "<script>location.href='cidades.php';</script>";
            //           }
            //           else
            //           {
            //             $new_arquivojson = 'cidades_arquivos-json/registros_'.$nome_cidade.'-'.$sigla_estado.'.json';
            //             rename($old_arquivojson, $new_arquivojson);
            //             echo "<script>alert('O registro `".$nome_cidade."` já possui um arquivo .json referente a ela! Verifique seus dados!');</script>";
            //             echo "<script>alert('O registro `".$nome_cidade."` foi editado com sucesso!');</script>";
            //             echo "<script>location.href='cidades.php';</script>";
            //           }
            //         }
            //         else
            //         {
            //           echo "<script>alert('Ocorreu um erro ao tentar editar o registro `".$nome_cidade."`!');</script>";
            //           echo "<script>alert('Verifique seus dados, tente novamente ou entre em contato com um administrador.');</script>";
            //           echo "<script>location.href='cidades.php';</script>";
            //         }
            //       }
            //     }
            //   }
            // }
          // ?>
        </div>
      </div>
    </div> -->

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Exclusão de Registro de Cidades</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              Seleciona "Apagar Registro" abaixo se você deseja excluir o seguinte registro de Cidades:
              <div class="form-row">
                <div class="col-md-6">
                  <label>Cidade:</label>
                  <input type="hidden" id="hiddencityidDelete" name="hiddencidadeidDelete"/>
                  <label id="citynameDelete"></label>
                  <input type="hidden" id="hiddencitynameDelete" name="hiddencidadenomeDelete"/>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <label>Estado:</label>
                  <input type="hidden" id="hiddenstatenameDelete" name="hiddenestadonomeDelete"/>
                  <label id="statecompositeDelete" name="estadonomeDelete"></label>
                  <input type="hidden" id="hiddenstatecompositeDelete" name="hiddenestadocompostoDelete"/>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-block btn-primary-overwrite" id="deleteSubmit" value="Apagar Registro"/>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddencidadeidDelete'])) && (!empty($_POST['hiddencidadenomeDelete'])) && (!empty($_POST['hiddenestadonomeDelete'])) && (!empty($_POST['hiddenestadocompostoDelete'])))
            {
              $_SESSION['city_name'] = '';
              $_SESSION['error_msg'] = '';
              $id_cidade=$_POST['hiddencidadeidDelete'];
              $nome_cidade=$_POST['hiddencidadenomeDelete'];
              $nome_estado=$_POST['hiddenestadonomeDelete'];
              $estado_array=$_POST['hiddenestadocompostoDelete'];
              list($nome_estado, $sigla_estado) = explode(" - ",$estado_array);
              $sqlStmtSelectEstadoId="SELECT estados.id_estado FROM agendalocal.estados WHERE estados.nome='".$nome_estado."' AND estados.sigla ='".$sigla_estado."'";
              if($resultStmtSelectEstadoId = pg_prepare($db_connection,"",  $sqlStmtSelectEstadoId))
              {
                $resultStmtSelectEstadoId = pg_execute($db_connection, "", array());
                if($rowResultStmtSelectEstadoId = pg_fetch_array($resultStmtSelectEstadoId))
                {
                  $id_estado = $rowResultStmtSelectEstadoId["id_estado"];
                  $sqlStmlDeleteCidade="DELETE FROM agendalocal.cidades WHERE cidades.id_cidade = ".(int)$id_cidade." AND cidades.id_estado =".(int)$id_estado." AND cidades.nome='".$nome_cidade."'";
                  if($resultStmtDeleteCidade = pg_prepare($db_connection,"",  $sqlStmlDeleteCidade))
                  {
                    $resultStmtDeleteCidade = pg_execute($db_connection, "", array());
                    if(pg_affected_rows($resultStmtDeleteCidade)>0)
                    {
                      $arquivo_sql = 'cidades_arquivos-sql/registros_'.$nome_cidade.'-'.$sigla_estado.'.sql';
                      if(!file_exists($arquivo_sql))
                      {
                        $_SESSION['city_name'] = $nome_cidade;
                        $_SESSION['ok_type'] = "Deleção";
                        $_SESSION['ok_msg'] = "A cidade '".$_SESSION['city_name']."' foi excluída com sucesso!";
                        echo "<script>location.href='cidades.php?modal_toshow=msgSucessModal';</script>";
                      }
                      else
                      {
                        $_SESSION['city_name'] = $nome_cidade;
                        $_SESSION['ok_type'] = "Deleção";
                        $_SESSION['ok_msg'] = "A cidade '".$_SESSION['city_name']."' foi excluída com sucesso!";
                        echo "<script>location.href='cidades.php?modal_toshow=msgSucessModal';</script>";
                      }

                      $arquivo_json = 'cidades_arquivos-json/registros_'.$nome_cidade.'-'.$sigla_estado.'.json';
                      if(!file_exists($arquivo_json))
                      {
                        $_SESSION['city_name'] = $nome_cidade;
                        $_SESSION['ok_type'] = "Deleção";
                        $_SESSION['ok_msg'] = "A cidade '".$_SESSION['city_name']."' foi excluída com sucesso!";
                        echo "<script>location.href='cidades.php?modal_toshow=msgSucessModal';</script>";
                      }
                      else
                      {
                        $_SESSION['city_name'] = $nome_cidade;
                        $_SESSION['ok_type'] = "Deleção";
                        $_SESSION['ok_msg'] = "A cidade '".$_SESSION['city_name']."' foi excluída com sucesso!";
                        echo "<script>location.href='cidades.php?modal_toshow=msgSucessModal';</script>";
                      }
                    }
                    else
                    {
                      $_SESSION['city_name'] = $nome_cidade;
                      $_SESSION['error_msg'] = "Ocorreu um erro ao tentar excluir a cidade `".$_SESSION['city_name']."`!<br/>";
                      $_SESSION['error_msg'] += "Verifique seus dados, tente novamente ou entre em contato com um administrador.";
                      echo "<script>location.href='cidades.php?modal_toshow=alertModal';</script>";
                    }
                  }
                }
              }
            }
          ?>
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
              <input type="text" id="hiddenmsgsuccessSubmit" name="hiddenmsgSucessoSubmit"  value="success" hidden/>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenmsgSucessoSubmit'])))
            { echo "<script>location.href='cidades.php';</script>"; }
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
              <input type="text" id="hiddenalertSubmit" name="hiddenalertaSubmit"  value="error" hidden/>
            </div>
          </form>
          <?php
            if(($_SERVER["REQUEST_METHOD"] == "POST") && (!empty($_POST['hiddenalertaSubmit'])))
            { echo "<script>location.href='cidades.php';</script>"; }
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
      $tdCidadeEdit = $rowEdit.find("td:eq(0)");

      document.getElementById('citynameEdit').value = $tdCidadeEdit.text();
      document.getElementById('hiddencitynameEdit').value = $tdCidadeEdit.text();

      $tdEstadoEdit = $rowEdit.find("td:eq(1)");
      var $tdEstadoEditValue =  $tdEstadoEdit.attr("value") + " - " + $tdEstadoEdit.text();

      for (var i=0; i <document.getElementById('stateoptionsEdit').length; i++)
      {
        var $stateOption = document.getElementById('stateoptionsEdit')[i].text;
        if($stateOption == $tdEstadoEditValue)
        {
          document.getElementById('stateoptionsEdit').selectedIndex  = i;
          document.getElementById('hiddencityidEdit').value = $tdCidadeEdit.attr("value");
          document.getElementById('hiddenstateoptionsEdit').value = document.getElementById('stateoptionsEdit').value;
        }
      }
    });
    $(".spanDelete").click(function()
    {
      var $rowDelete = $(this).closest("tr"),
      $tdCidadeDelete = $rowDelete.find("td:eq(0)");

      document.getElementById('hiddencityidDelete').value = $tdCidadeDelete.attr("value");
      document.getElementById('citynameDelete').innerHTML = $tdCidadeDelete.text();
      document.getElementById('hiddencitynameDelete').value = $tdCidadeDelete.text();

      $tdEstadoDelete = $rowDelete.find("td:eq(1)");
      var $tdEstadoDeleteValue =  $tdEstadoDelete.attr("value") + " - " + $tdEstadoDelete.text();
      document.getElementById('hiddenstatenameDelete').value = $tdEstadoDelete.attr("value");
      document.getElementById('statecompositeDelete').innerHTML = $tdEstadoDeleteValue;
      document.getElementById('hiddenstatecompositeDelete').value = $tdEstadoDeleteValue;
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
