<?php
  include 'connection.php';
  session_start();
  if (!isset($_SESSION['user']) || !isset($_SESSION['pass'])) {
	header("Location:login.php");
  }
  mysqli_query($conn, "SET NAMES utf8");
  mysqli_query($conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
?>



﻿<!DOCTYPE html>
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
                     <!-- <h2>Aceitações </h2>  -->
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <h3>Livros disponíveis para aceitação no site</h3>
                  <hr />
                        <?php
                            $sql = "SELECT * FROM pendentes";
                            $sql = mysqli_query($conn, $sql);
                            $row = mysqli_num_rows($sql);
                            if ($row > 0) {
                                while ($linha = mysqli_fetch_array($sql)) {
                                    $titulo = $linha['nome_livro'];
                                    $autor = $linha['autor_livro'];
                                    $genero = $linha['genero'];
                                    $usuario = $linha['usuario'];
                                    $arquivo = $linha['arquivo'];
                                    $data = $linha['data'];
                                    $data = date("d/m/Y", strtotime($data));
                                    echo '<div class="panel-group" id="accordion">';
                                    echo '<div class="panel panel-default">';
                                    echo '<div class="panel-heading">';
                                    echo '<h4 class="panel-title">';
                                    echo "<a data-toggle='collapse'data-parent='#accordion'" . "href='#collapse$id' class='collapsed'>$titulo</a></h4>";
                                    echo '</div>';
                                    echo "<div id='collapse$id' class='panel-collapse collapse' style='height: 0px;'>";
                                    echo "<div class='panel-body'>
                                            Autor: $autor.<br />Gênero: $genero. <br /> Partilhado por: $usuario em $data.<br/>
                                                <a href='/uploads/$arquivo'>Clique aqui para acessar o livro</a><br />
                                                <button type='button' class='btn btn-success'><a href='#' style='color: rgb(255, 255, 255)'>Aceitar</a></button>
                                                <button type='button' class='btn btn-danger'><a href='#' style='color: rgb(255, 255, 255)'>Recusar</a></button>
                                        </div>";
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
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