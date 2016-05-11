<?php
    //Arquivo de configuração
    require_once("protected/config/main.php");

    //Controller 
    require_once(CONTROLLERS."SiteController.php");

    //Inclusao do cabecalho (topo) do site
    include_once("app/includes/header.php");
    
    //Chamada da index do controller
    require_once(call_user_func(array('SiteController', 'index'), 'home')); 


    //Inclusao do rodape do site
    include_once("app/includes/footer.php");
?>
            
        