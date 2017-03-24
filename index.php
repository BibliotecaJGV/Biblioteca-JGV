<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Biblioteca JGV</title>
  <link rel='stylesheet' href='http://codepen.io/assets/libs/fullpage/jquery-ui.css'>
  <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body>

  <div class="login-card">
    <h1>Biblioteca JGV</h1><br>
  <form method="POST" action="login.php">
    <input type="text" name="user" id="user" placeholder="RA do aluno">
    <input type="password" name="pass" id="pass" placeholder="Senha">
    <input type="submit" name="login" class="login login-submit" value="Entrar">
    <?php
    if (isset($_GET["try"])) {
        echo "<style>h4 {color:red;}</style>";
        echo "<center><h4>RA e/ou senha incorreto(s).</h4></center>";
    }
    ?>
  </form>

  <div class="login-help">
    <a href="register.php">Registrar-se</a> • <a href="forgot.php">Esqueci minha senha</a>
  </div>
</div>

<!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div> -->

  <script src='http://codepen.io/assets/libs/fullpage/jquery_and_jqueryui.js'></script>

</body>

</html>
