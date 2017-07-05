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
$user = $_SESSION['user'];
$nome_livro = ucwords(strtolower($_POST['nome_livro']));
$autor_livro = ucwords(strtolower($_POST['autor_livro']));
$edi = $_POST['edicao_livro'];
$genero = $_POST['genre'];

if (strlen($edi) < 1) {
    $edi = "1ª";
}else {
    if (strpos($edi, "ª") === false) {
        $edi = $edi . "ª";
    }
}

function verify_real($name, $author, $edi, $gen) {
    if (strlen($name) > 1 and strlen($author) > 1 and strlen($edi) > 1 and strlen($gen) > 1) {
        return true;
    }
    else {
        return false;
    }
}

if (isset($genero)) {
    if (verify_real($nome_livro, $autor_livro, $edi, $genero) == true) {
        $sql = "INSERT INTO escola (id, nome_livro, autor_livro, genero, edicao) VALUES (null, '$nome_livro', '$autor_livro', '$genero', '$edi')";
        $sql = mysqli_query($conn, $sql);
        $msg = "Livro registrado com sucesso";
    }else {
        $msg = "Livro não foi registrado. <br/>Cheque os campos novamente.";
    }
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
      <meta http-equiv="refresh" content="60">
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
                    $sql = "SELECT * FROM admins WHERE usuario LIKE '$user'";
                    $sql = mysqli_query($conn, $sql);
                    $row = mysqli_num_rows($sql);
                    if ($row > 0) {
                        echo "<li>";
                        echo "<a href='books_register.php'><i class='fa fa-plus'></i>Registro de livros</a>";
                        echo "</li>";
                    }
                    ?>
                </ul>
                            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h3>Registrar livros físicos </h3>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                  <form action="books_register.php" method="POST">
                    <input class="form-control" name="nome_livro" placeholder="Nome do livro" /><br/>
                    <input class="form-control" name="autor_livro" placeholder="Autor do livro" /><br/>
                    <input class="form-control" name="edicao_livro" placeholder="Edição do livro"><br/>
                    <p class="help-block">Se o campo de edição for deixado em branco, será utilizado o valor padrão 1, como de primeira edição.</p>
                    <div style="width:30%">
                    <label>Gênero do livro</label>
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
                    <?php
                    function clock() {
                        $today = getdate();
                        $d = $today['mday'];
                        if (strlen($d) == 1) {
                            $d = '0' . $d;
                        }
                        $m = $today['mon'];
                        if (strlen($m) == 1) {
                            $m = '0' . $m;
                        }
                        $y = $today['year'];
                        $hj ="$d-$m-$y";
                        $hour  = date('H');
                        $minutes = date('i');
                        $hour = intval($hour) - 3;
                        $hour = "$hour:$minutes";
                        echo "<center>";
                        echo "<label>Horário atual: $hour</label> - ";
                        echo "<label>Hoje é: $hj</label><br/>";
                        echo "</center>";
                    }
                    clock();
                    ?>
                    <center><input type="submit" value="Registrar livro" class="btn btn-primary" /></center><br/>
                  </form>
                 <!-- /. ROW  --> 
                 <hr/>
                 <?php
                 if ($msg != false and $msg != 'Livro não foi registrado. <br/>Cheque os campos novamente.') {
                      echo "<div class='alert alert-success'>";
                      echo "<h3>$msg</h3>";
                      echo "</div>";
                    }else {
                        if ($msg == '') {
                            
                        }else {
                          echo "<div class='alert alert-danger'>";
                            echo "<h3>$msg</h3>";
                            echo "</div>";   
                        }
                    }
                 ?>          
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
