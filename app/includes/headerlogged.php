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
                <div class="logged-user">
					<img src = "https://d2kwny77wxvuie.cloudfront.net/user/-SEos2b3QV2Op5xI4j5HsA/thumbnail_72x72.jpeg">
					<a href="#" style="text-decoration:none">Caio H.</a>
				</div>
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
                        <li id = "first"><a id = "link" href="<?= PATH_HREF ?>Home" class="PrincipAtivo"><b>Home</b></a></li>
                        <li id = "first" class = "dropdown"><a id = "link" data-toggle="dropdown" ><b>Caronas</b></a>
							<ul class = "dropdown-menu">
								<li><a href="<?= PATH_HREF ?>registraCaronas">Cadastrar Carona</a></li>
								<li><a href="<?= PATH_HREF ?>buscaCaronas">Buscar Carona</a></li>
							</ul>
						</li>
						<li id = "first"><a id = "link" href="<?= PATH_HREF ?>buscaUsuarios"><b>Usuários</b></a></li>
						<li id = "first"><a id = "link"href="<?= PATH_HREF ?>veiculo"><b>Veículo</b></a></li>
						<li id = "first" class = "dropdown"><a id = "link" data-toggle="dropdown" href="<?= PATH_HREF ?>grupo"><b>Grupos</b></a>
							<ul class = "dropdown-menu">
								<li><a href="<?= PATH_HREF ?>meusGrupos">Meus Grupos</a></li>
								<li><a href="<?= PATH_HREF ?>buscaGrupos">Buscar Grupos</a></li>
							</ul>
						</li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="content">