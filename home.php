<?php
$host = "fdb16.runhosting.com";
$user = "2320610_jgv";
$pwd = "reni1234";
$db = "2320610_jgv";
$conn = new mysqli($host, $user, $pwd, $db);
?>
<?php
session_start();
if (!isset($_SESSION['user']) || (!isset($_SESSION['pass']))) {
    header("Location:login.php");
}
?>
<?php
$host = "fdb16.runhosting.com";
$user = "2320610_jgv";
$pwd = "reni1234";
$db = "2320610_jgv";
$conn = new mysqli($host, $user, $pwd, $db);
$ra = $_SESSION['user'];
$pass = $_SESSION['pass'];
$sql = mysqli_query($conn, "SELECT * FROM alunos WHERE ra_aluno = '$ra' AND senha = '$pass'");
$nome = $sql->nome_aluno;
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="UTF-8">
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
                    <?php
                    $user = $_SESSION['user'];
                    $sql = "SELECT * FROM admins WHERE usuario LIKE '$user'";
                    $sql = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($sql);
                    if ($row > 0) {
                        echo "<li>";
                        echo "<a href='books_register.php'><i class='fa fa-plus'></i>Registro de livros</a>";
                        echo "</li>";
                        session_start();
                    }
                    ?>
                </ul>
                            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                     <h3>Painel principal do aluno</h3>
                    </div>
                </div>
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    <div class="col-lg-12 ">
                        <label>Recomendação da semana</label>
                        <div class="alert alert-warning">
                        <strong> As últimas notícias sobre educação, Enem, bolsa de estudo, ProUni, Sisu, Fuvest, Ciências sem Fronteiras, CAPES, CNPq, vestibular, carreira, currículo e mais.</strong>
                        <a href="http://www.universia.com.br/">Universia Brasil</a>
                        </div>
                        <div class="alert alert-info">
                             <?php
                             $host = "fdb16.runhosting.com";
                             $user = "2320610_jgv";
                             $pwd = "reni1234";
                             $db = "2320610_jgv";
                             $conn = new mysqli($host, $user, $pwd, $db);
                             $ra = $_SESSION['user'];
                             $pass = $_SESSION['pass'];
                             $sql = mysqli_query($conn, "SELECT * FROM alunos WHERE ra_aluno = '$ra' AND senha = '$pass'");
                             $sql = mysqli_fetch_object($sql);
                             $nome = $sql->nome_aluno;
                             echo "Bem vindo(a), <strong>$nome</strong>.";
                             ?>
                             <!-- <strong>Welcome Jhon Doe ! </strong> You Have No pending Task For Today. > -->
                        </div>
                    </div>
                    </div>
                  <!-- /. ROW  -->
                            <div class="row text-center pad-top">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                           <a href="notification.php" >
 <i class="fa fa-bell-o fa-5x"></i>
                      <h4>Notificações </h4>
                      </a>
                      </div>


                  </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">
                      <div class="div-square">
                          <a href="settings.php" >
 <i class="fa fa-gear fa-5x"></i>
                      <h4>Definições</h4>
                      </a>
                      </div>


                  </div>
              </div>
                    <div class="row text-center pad-top">
                 <!-- /. ROW  -->
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
