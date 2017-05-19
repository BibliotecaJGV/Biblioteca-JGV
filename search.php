<?php
  $host = "fdb16.runhosting.com";
  $user = "2320610_jgv";
  $pwd = "reni1234";
  $db = "2320610_jgv";
  $conn = new mysqli($host, $user, $pwd, $db);
  session_start();
  if (!isset($_SESSION['user']) || !isset($_SESSION['pass'])) {
	  header("Location:login.php");
  }
  $msg = false;
  mysqli_query($conn, "SET NAMES utf8");
  mysqli_query($conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
?>




<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="UTF-8">
<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
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


                    <li>
                        <a href="home.php" ><i class="fa fa-desktop "></i>Principal </a>
                    </li>
                    <li class="active-link">
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
                     <h3>Pesquisa por livro </h3>
                    </div>
                </div>
                 <!-- /. ROW  -->
                  <hr />
                  <form action="search.php" method="POST" enctype="multipart/form-data">
                   <div class="form-group">
                            <label>Nome do livro</label>
                            <input class="form-control" name="book-name" />
                            <label>Nome do autor</label>
                            <input class="form-control" name="author-name" />
                            <div style="width:30%">
                            <label>Gênero</label>
                            <select name="genre" class="form-control">
                                <option>Selecione uma opção...</option>
                                <option>Administração e Negócios</option>
                                <option>Contos e Crônicas</option>
                                <option>Engenharia e Tecnologia</option>
                                <option>Ficção Científica</option>
                                <option>Romance</option>
                                <option>Literatura Infanto Juvenil</option>
                                <option>Filosofia</option>
                                <option>Ciências Humanas e Sociais</option>
                                <option>Ciências Biológicas</option>
                                </select>
                            </div>
                            <p class="help-block">Utilizaremos o nome do livro, do autor e o gênero do mesmo para nossas pesquisas.</p>
                        </div>
                  <input type="submit" class="btn btn-default" name="pesquisar" value="Pesquisar">
                  </form>
                  <hr>
                      <?php
                            $livro = ucwords($_POST['book-name']);
                            $autor = ucwords($_POST['author-name']);
                            $genre = $_POST['genre'];
                            $sql = "SELECT * FROM livros WHERE (nome_livro LIKE '$livro') OR (autor_livro LIKE '$autor') OR (genero LIKE '$genre') ORDER BY data DESC";
                            $sql = mysqli_query($conn, $sql);
                            $row = mysqli_num_rows($sql);

                            $pasta = dirname(getcwd()).'/uploads/';

                            if ( (strlen($livro) > 1) or (strlen($autor) > 1) or (strlen($genre) > 1) ) {
                                echo "<h4>Livro encontrado</h4>";
                                echo '<table class="table table-striped table-bordered table-hover">';
                                echo "<tr>";
                                echo  "<th>Nome do livro </th>";
                                echo  "<th>Autor(a) do livro</th>";
                                echo "<th>Gênero</th>";
                                echo "<th>RA do aluno que partilhou</th>";
                                echo "<th>Data de inclusão (ano, mês, dia)</th>";
                                echo  "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                             if ($row > 0) {
                                while ($linha = mysqli_fetch_array($sql)) {
                                    $titulo = $linha['nome_livro'];
                                    $autor = $linha['autor_livro'];
                                    $user = $linha['usuario'];
                                    $gen = $linha['genero'];
                                    $arquivo = $linha['arquivo'];
                                    $date = $linha['data'];
                                    echo "<tr>";
                                    echo "<td><a href='/uploads/$arquivo'>$titulo</a></td>";
                                    echo "<td>$autor</td>";
                                    echo "<td>$gen</td>";
                                    echo "<td><center>$user<center/></td>";
                                    echo "<td><center>$date</center></td>";
                                    echo "</tr>";
                                }
                            }else {
                                echo "<div class='alert alert-error'>";
                                if (strlen($livro) > 1) {
                                    echo "<h4><strong>$livro</strong> não foi achado, desculpe-nos.</h4>";
                                }
                                else if (strlen($autor) > 1) {
                                    echo "<h4>O autor <strong>$autor</strong> não foi achado, desculpe-nos.</h4>";
                                }else if (strlen($genre) > 1) {
                                    echo "<h4>O gênero <strong>$genre</strong> não resultou em buscas satisfatórias.</h4>";
                                }
                                echo "</div>";
                            }
                            }
                        echo "</tbody>";
                        echo "</table>";
                      ?>
                        <!-- LISTA COM LIVROS FICARÁ AQUI -->
                  </hr>
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
