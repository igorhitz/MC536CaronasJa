<?php
    //Arquivo de configuração
    require_once("protected/config/main.php");
    require_once("protected/classes/SiteHandler.php");
    require_once("protected/libs/DBOp.php");
    require_once("protected/classes/Usuario.php");
    require_once("protected/classes/Login.php");
    require_once("protected/classes/Carona.php");
	require_once("protected/classes/Grupo.php");
    require_once("protected/classes/InfoModelo.php");
    require_once("protected/classes/Veiculo.php");
    require_once("protected/classes/Reserva.php");
	require_once("protected/classes/Avalia.php");
	require_once("protected/classes/Mensagem.php");
	require_once("protected/classes/Amizade.php");
	require_once("protected/classes/Participa.php");
	require_once("protected/classes/Preferencia.php");
	

    //Inclusao do cabecalho (topo) do site
    include_once("app/includes/header.php");

    /* Se existirem os parametros passados via get */
    $site = new SiteHandler;

    $permitidas = array('signin','signup');

    if(isset($_GET['p']) && !empty($_GET['p'])) {
        //exibe notificacao ao usuario se houver
        SiteHandler::getNotification();
        
        if($_GET['p'] == 'action') {
            //caso seja uma action
            require_once($site->getAction($_GET['s']));
        } else {
            //se não for uma action
            //se a página for permitida (sem necessidade de login)
            if(in_array(strtolower($_GET['p']), $permitidas)) {
                require_once($site->getPage($_GET['p'])); 
            } else {
                //se for restrita verifica se há login
                if(Login::isLogged()) {
                    require_once($site->getPage($_GET['p'])); 
                } else {
                    SiteHandler::getAlert('Você precisa estar logado para acessar essa página.','error');
                    require_once($site->getLoginPage());
                }
            }           
       }
    } else {
        require_once($site->getHome());
    }

    //Inclusao do rodape do site
    include_once("app/includes/footer.php");
?>
            
        