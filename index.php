<?php
    //Arquivo de configuração
    require_once("protected/config/main.php");
    require_once("protected/classes/SiteHandler.php");


    //Inclusao do cabecalho (topo) do site
    include_once("app/includes/header.php");


    /* Se existirem os parametros passados via get */
    $site = new SiteHandler;

    if(isset($_GET['p'])) {
        if($page = $site->getPage($_GET['p'])) {
            require_once($page);
        } else {
            require_once('404.php');
        }
    }

    //Inclusao do rodape do site
    include_once("app/includes/footer.php");
?>
            
        