<?php
    session_start();
    $ra = $_POST['user'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $host = "fdb16.runhosting.com";
    $user = "2320610_jgv";
    $pwd = "reni1234";
    $db = "2320610_jgv";
    $conn = new mysqli($host, $user, $pwd, $db);
	session_start();
	if (!isset($_SESSION['user']) || !isset($_SESSION['pass'])) {
		header("Location:login.php");
	}
    mysqli_query($conn, "SET NAMES utf8");
    mysqli_query($conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
?>﻿

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Biblioteca JGV</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>



    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="assets/img/Book-icon.png" />
                    </a>
                </div>

                 <span class="logout-spn" >
                      <?php 
                $ra = $_SESSION['user'];
                $sql = "SELECT * FROM alunos WHERE ra_aluno LIKE '$ra'";
                $sql = mysqli_query($conn, $sql);
                $row = mysqli_num_rows($sql);
                if ($row > 0) {
                    while ($linha = mysqli_fetch_array($sql)) {
                        $email = $linha['email_aluno'];
                        $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s=32";
                        echo "<a href='settings.php'><img src='$grav_url'/><a/>";
                    }
                }
                ?>
                  <a href="index.php" style="color:#fff;">SAIR</a>

                </span>
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">


                    <li class="active-link">
                        <a href="home.php" ><i class="fa fa-desktop "></i>Principal </a>
                    </li>
                    <li>
                        <a href="search.php"><i class="fa fa-search "></i>Pesquisa por livro </a>
                    </li>
                    <li>
                        <a href="list_all.php"><i class="fa fa-table "></i>Listar todos os livros  </a>
                    </li>
                    <li>
                        <a href="upload.php"><i class="fa fa-upload "></i>Envio de livros  </a>
                    </li>
                    <li>
                        <a href="real.php"><i class="fa fa-book"></i>Biblioteca física </a>
                    </li>
                </ul>
                            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h3>Configurações </h3>
                    </div>
                </div>
                 <!-- /. ROW  -->
                  <hr />
                  <?php
                    $user = $_SESSION['user'];
                    $sql = "SELECT * FROM alunos WHERE ra_aluno LIKE '$user'";
                    $sql = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($sql);
                    if ($row > 0) {
                        while ($linha = mysqli_fetch_array($sql)) {
                            $nome = $linha['nome_aluno'];
                            $email = $linha['email_aluno'];
                            $ra = $linha['ra_aluno'];
                            $senha = $linha['senha'];
                            $senha_final = "";
                            $tam = strlen($senha);
                            for ($i=0; $i < $tam; $i++) {
                                $senha_final .= '*';
                            }
                            echo '<form action="settings.php" method="POST" autocomplete="off">';
                            echo  '<label>Nome do aluno</label>';
                            echo "<input class='form-control' name='new_name' placeholder='$nome' autocomplete='new-password'/>";
                            echo '<label>Email do aluno</label>';
                            echo "<input class='form-control' name='new_email' placeholder='$email' autocomplete='new-password'/>";
                            echo '<label>RA do aluno</label>';
                            echo "<input class='form-control' name='new_ra' placeholder='$ra' autocomplete='new-password'/>";
                            echo '<label>Senha</label>';
                            echo "<input type='password' class='form-control' id='pwd' name='new_pass' placeholder='$senha_final' autocomplete='new-password'/>";
                            echo '<hr>';
                            echo '<input class="btn btn-success" type="submit" name="submit" value="Registrar mudanças" />';
                            echo '</hr>';
                            echo '</form>';
                        }
                    }
                  ?>
                  <?php
                    $new_ra = $_POST['new_ra'];
                    $new_name = $_POST['new_name'];
                    $new_email = $_POST['new_email'];
                    $new_pass = $_POST['new_pass'];
                    $sql = "SELECT ra_aluno FROM alunos";
                    $sql = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($sql);
                    $todos_alunos = array();
                    if ($row > 0) {
                      while ($linha = mysqli_fetch_array($sql)) {
                        $ra = $linha['ra_aluno'];
                        array_push($todos_alunos, $ra);
                      }
                    }
                    if (strlen($new_ra) > 1) {
                        if (in_array($new_ra, $todos_alunos)) {
                          echo "<hr>";
                          echo "<div class='alert alert-danger'>";
                          echo "<h3>Esse RA já está cadastrado, você não pode usar-lo também.</h3>";
                          echo "</div>";
                          echo "</hr>";
                        }else {
                          $sql = "UPDATE alunos SET ra_aluno='$new_ra' WHERE ra_aluno='$ra'";
                          if ($conn->query($sql) === TRUE) {
                            echo "<hr>";
                            echo "<div class='alert alert-success'>";
                            echo "<h3>RA alterado com sucesso.</h3>";
                            echo "</div>";
                            echo "</hr>";
                          }else {
                            echo "<hr>";
                            echo "<div class='alert alert-danger'>";
                            echo "<h3>RA não foi alterado.</h3>";
                            echo "</div>";
                            echo "</hr>";
                          }
                        }
                    }else if (strlen($new_name) > 1) {
                      $sql = "UPDATE alunos SET nome_aluno='$new_name' WHERE ra_aluno='$ra'";
                      if ($conn->query($sql) === TRUE) {
                        echo "<hr>";
                        echo "<div class='alert alert-success'>";
                        echo "<h3>Nome alterado com sucesso.</h3>";
                        echo "</div>";
                        echo "</hr>";
                      }else {
                        echo "<hr>";
                        echo "<div class='alert alert-danger'>";
                        echo "<h3>Nome não foi alterado.</h3>";
                        echo "</div>";
                        echo "</hr>";
                      }
                    }else if (strlen($new_email) > 1) {
                      $sql = "UPDATE alunos SET email_aluno='$new_email' WHERE ra_aluno='$ra'";
                      if ($conn->query($sql) === TRUE) {
                        echo "<hr>";
                        echo "<div class='alert alert-success'>";
                        echo "<h3>Email alterado com sucesso.</h3>";
                        echo "</div>";
                        echo "</hr>";
                      }else {
                        echo "<hr>";
                        echo "<div class='alert alert-danger'>";
                        echo "<h3>Email não foi alterado.</h3>";
                        echo "</div>";
                        echo "</hr>";
                      }
                    }else if (strlen($new_pass) > 1) {
                      $sql = "UPDATE alunos SET senha='$new_pass' WHERE ra_aluno='$ra'";
                      if ($conn->query($sql) === TRUE) {
                        echo "<hr>";
                        echo "<div class='alert alert-success'>";
                        echo "<h3>Senha alterada com sucesso.</h3>";
                        echo "</div>";
                        echo "</hr>";
                      }else {
                        echo "<hr>";
                        echo "<div class='alert alert-danger'>";
                        echo "<h3>Senha não foi alterada.</h3>";
                        echo "</div>";
                        echo "</hr>";
                      }
                    }else {
                      if (isset($new_name) or isset($new_ra) or isset($new_pass) or isset($new_email)) {
                        echo "<hr>";
                        echo "<div class='alert alert-danger'>";
                        echo "<h3>Nenhuma mudança foi feita.</h3>";
                        echo "</div>";
                        echo "</hr>";
                      }
                    }
                  ?>

                 <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    <div class="footer">


             <div class="row">
                <div class="col-lg-12" >
                    &copy;  2017 José Geraldo Vieira
                </div>
        </div>
        </div>


     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>
</html>
