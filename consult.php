<?php
    $host = "fdb16.runhosting.com";
    $user = "2320610_jgv";
    $pwd = "reni1234";
    $db = "2320610_jgv";
    $conn = new mysqli($host, $user, $pwd, $db);
    session_start();
?>


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
                    <li class="active-link">
                        <a href="real.php"><i class="fa fa-book"></i>Biblioteca física </a>
                    </li>
                </ul>
                            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
            <h4>Biblioteca física - Consulta</h4>
                 <hr/>
                    <?php 
                            $sql = "SELECT * FROM registros";
                            $sql = mysqli_query($conn, $sql);
                            $row = mysqli_num_rows($sql);
                            echo "<h3>Ações em vigor</h3>";
                            echo '<table class="table table-striped table-bordered table-hover">';
                            echo  "<th>Nome do livro </th>";
                            echo  "<th> Autor(a) do pedido</th>";
                            echo "<th>RA do aluno que pediu</th>";
                            echo "<th>Expedimento (ano,mês,dia)</th>";
                            echo  "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                        if ($row > 0) { 
                            while ($linha = mysqli_fetch_array($sql)) {
                                $nome_livro = $linha['nome_livro'];
                                $nome = $linha['nome_aluno'];
                                $ra = $linha['ra_aluno'];
                                $data = $linha['data'];
                                echo "<tr>";
                                echo "<td>$nome_livro</td>";
                                echo "<td>$nome</td>";
                                echo "<td>$ra</td>";
                                echo "<td>$data</td>";
                                echo "</tr>";
                            }
                        }else {
                            echo "<div class='alert alert-error'>";
                            echo "<h3><strong>Os livros</strong> não foram achados, desculpe-nos.</h3>";
                            echo "</div>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        ?>
                 <hr/>
                 <center>
            <div>
              
                 <!-- /. ROW  -->           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    <div class="footer">
      
    
             <div class="row">
                <div class="col-lg-12" >
                    &copy; 2017 José Geraldo Vieira
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