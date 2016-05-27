<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Caronas já</title>
        <meta name="description" content="Rede social de caronas!">
        <meta name="keywords" content="Caronas, Rede Social, Transporte, Comunicação">
        <link rel="stylesheet" href="<?= PATH.'css/' ?>style.css" />
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
                    <li><a href="SignIn">Sign in</a></li>
                    <li><a href="SignUp">Sign up</a></li>
                </ul>
            </div>
        </nav>
            <div class="wrapper">
                <div id="logo">
                    <a href="Home">
                       <img src="<?= PATH.'resources/'?>logotipo.png" alt ="Caronasjá">             
                    </a>
                </div>
            </div>
        </header>
        <div id="menu-principal">
            <div class="wrapper">
                <nav id="menu">
                    <ul>
                        <li><a href="Home" class="PrincipAtivo"><b>Home</b></a></li>
                        <li><a><b>Caronas</b></a>
							<ul>
								<li><a href="registraCaronas">Cadastrar Carona</a></li>
								<li><a href="buscaCaronas">Buscar Carona</a></li>
							</ul>
						</li>
						<li><a href="buscaUsuarios"><b>Usuários</b></a></li>
						<li><a href="veiculo"><b>Veículo</b></a></li>
						<li><a href="grupo"><b>Grupos</b></a>
							<ul>
								<li><a href="meusGrupos">Meus Grupos</a></li>
								<li><a href="buscaGrupos">Buscar Grupos</a></li>
							</ul>
						</li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="wrapper">
            <div class="content">
        