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
            <h4>Biblioteca física</h4>
                 <hr/>
                 <form action="real.php" method="POST">
                     <input class="form-control" name="nome_livro" placeholder="Nome do livro"/>
                     <center><label>Ação a se fazer</label></center>
                        <br/>
                     <center>
                     <select name="acao">
                         <option>Selecione uma opção...</option>
                         <option>Doar livro</option>
                         <option>Pegar emprestado (com prazo determinado)</option>
                         </select>
                     </center>
                     <br/>
                     <center><input type="submit" class="btn btn-primary" value="Realizar ação"/></center>
                 </form>
                 <?php 
                    $acao = $_POST['acao'];
                    $nome_livro = ucwords($_POST['nome_livro']);
                    if (strlen($nome_livro)) {
                        if ($acao == "Pegar emprestado (com prazo determinado)") {
                            $acao = "emprestado";
                            echo "O livro $nome_livro foi $acao para você.";
                        }else if ($acao == "Doar livro") {
                            $acao = "doado";
                            echo "O livro $nome_livro foi $acao por você.";
                        }
                    }
                  ?>
                 <hr/>
                 <center>
            <div>
                      <div>
                          <a href="#" >
                              <center><i class="fa fa-book fa-5x"></i></center>
                      <h4>Consultar todos os livros emprestados por ora</h4>
                      </a>
                      </div>
            </div></center>
              
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
