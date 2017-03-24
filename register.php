<?php 
    $ra = $_POST['user'];
    $name = ucwords(strtolower($_POST['name']));
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $host = "fdb16.runhosting.com";
    $user = "2320610_jgv";
    $pwd = "reni1234";
    $db = "2320610_jgv";
    $conn = new mysqli($host, $user, $pwd, $db);
    mysqli_query($conn, "SET NAMES utf8");
    mysqli_query($conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    if (isset($ra)) {
     if (strlen($name) > 1 and strlen($ra) > 1 and str_getcsv($pass) > 1) {
       $sql = mysqli_query($conn, "INSERT INTO alunos(ra_aluno, nome_aluno, email_aluno, senha) VALUES('$ra', '$name', '$email', '$pass')");
       header("Location:index.php");   
    }else {
        header("Location:register.php?t=invalid");
        }   
    }
?>




<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Cadastro na Biblitoeca</title>

  <link rel='stylesheet' href='http://codepen.io/assets/libs/fullpage/jquery-ui.css'>

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body>

  <div class="login-card">
    <h1>Biblioteca JGV</h1><br>
  <form method="POST" action="register.php">
    <input type="text" name="user" id="user" placeholder="RA do aluno">
    <input type="text" name="name" id="name" placeholder="Nome do aluno">
    <input type="text" name="email" id="email" placeholder="Email do aluno">
    <input type="password" name="pass" id="pass" placeholder="Senha">
    <input type="submit" name="login" class="login login-submit" value="Registrar">
    <?php
    if (isset($_GET['t'])) {
        echo "<style>h4 {color:red;}</style>";
        echo "<center><h4>Há campos que não foram preenchidos.</h4></center>";
    }
    ?>
  </form>

  <div class="login-help">
    <a href="index.php">Logar-se</a> • <a href="#">Esqueci minha senha</a>
  </div>
</div>

<!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div> -->

  <script src='http://codepen.io/assets/libs/fullpage/jquery_and_jqueryui.js'></script>

</body>

</html>