<?php
    //Arquivo de configuração
    require_once("protected/config/main.php");
    require_once("protected/classes/SiteHandler.php");


    //Inclusao do cabecalho (topo) do site
    include_once("app/includes/header.php");


    /* Se existirem os parametros passados via get */
    $site = new SiteHandler;

    if(isset($_GET['p']) && !empty($_GET['p'])) {
         require_once($site->getPage($_GET['p']));
    } else {
        require_once($site->getHome());
    }

    //Inclusao do rodape do site
    include_once("app/includes/footer.php");
?>
            
        