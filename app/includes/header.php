<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Caronas já</title>
        <meta name="description" content="Rede social de caronas!">
        <meta name="keywords" content="Caronas, Rede Social, Transporte, Comunicação">
        <!-- Styles -->
		<link rel="stylesheet" href="<?= PATH.'css/' ?>bootstrap.css" />
		<link rel="stylesheet" href="<?= PATH.'css/' ?>style.css" />
		
		
		
		<!-- jQuery -->
		<script src="<?= PATH.'js/' ?>jquery-1.12.4.min.js"></script>
		<!-- bootstrap scripts -->
		<script src="<?= PATH.'js/' ?>bootstrap.min.js"></script>
		
        <!-- 
        <link rel="shortcut icon" href="img/favicon.ico" />
        <link rel="img_src" href="http://www.yuridelgado.com.br/images/nerd-icon.png" />
        <base href="http://www.yuridelgado.com.br/"> 
         -->
    </head>
    <body>
        <header>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <ul>
                    <?php 
                    session_start();
                    if(!Login::isLogged()) {
                    ?>
                    <li><a href="<?= PATH_HREF ?>SignIn">Sign in</a></li>
                    <li><a href="<?= PATH_HREF ?>SignUp">Sign up</a></li>
                    <?php 
                    } else {
                    ?>
                    <li><a href="SignIn"><?=  $_SESSION['email'] ?></a></li>
					<li><a href="<?= PATH_HREF ?>Config">Configurações</a></li>
                    <li><a href="<?= PATH_HREF ?>action/Logout">Sair</a></li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </nav>
            <div class="wrapper">
                <div id="logo">
                    <a href="<?= PATH_HREF ?>Home">
                       <img src="<?= PATH.'resources/'?>logotipo.png" alt ="Caronasjá">             
                    </a>
                </div>
            </div>
        </header>
        <div id="menu-principal">
            <div class="wrapper">
					<nav id="menu">
						<ul>
							<li id = "first"><a id = "link" href="<?= PATH_HREF ?>Home" class="PrincipAtivo"><b>Home</b></a></li>
							<li id = "first" class = "dropdown"><a id = "link" data-toggle="dropdown" ><b>Caronas</b></a>
								<ul class = "dropdown-menu">
									<li><a href="<?= PATH_HREF ?>registraCaronas">Cadastrar Carona</a></li>
									<li><a href="<?= PATH_HREF ?>buscaCaronas">Buscar Carona</a></li>
									<li><a href="<?= PATH_HREF ?>listaCaronas">Listar Caronas</a></li>
								</ul>
							</li>
							<li id = "first"><a id = "link" href="<?= PATH_HREF ?>buscaUsuarios"><b>Usuários</b></a></li>
							<li id = "first"><a id = "link"href="<?= PATH_HREF ?>veiculo"><b>Veículo</b></a></li>
							<li id = "first" class = "dropdown"><a id = "link" data-toggle="dropdown"><b>Grupos</b></a>
								<ul class = "dropdown-menu">
									<li><a href="<?= PATH_HREF ?>registraGrupo">Cadastrar Grupo</a></li>
									<li><a href="<?= PATH_HREF ?>meusGrupos">Meus Grupos</a></li>
									<li><a href="<?= PATH_HREF ?>buscaGrupos">Buscar Grupos</a></li>
								</ul>
							</li>
						</ul>
					</nav>

		
            </div>
        </div>
        <div class="wrapper">
            <div class="content">
        