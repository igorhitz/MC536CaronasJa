	<?php
	$grupos = new Grupo;
	
	//verifica se existe parametros de filtro de busca
	if(isset($_GET['nome'])) {
		$nome = $_GET['nome'];

		//se existirem buscamos por filtro
		$lista = $grupos->getGruposByNome($nome);
	} else {
		//senão obtem lista geral (*)
		$lista = $grupos->selectAll();
	}
	
	SiteHandler::getQueryAlert(Grupo::$query);
	?>
	<br>
	<?php if($grupos->rows > 0) { ?>
	<div class="totalbusca"><span ><?= $grupos->rows ?>&nbsp;</span><h1>grupos encontrado(s)</h1></div>
	<?php } else { ?>
	<div class="totalbusca"><h1>Nenhum grupo foi encontrado.</h1></div>
	<?php 
	}
	?>
	<div class = "search-results">
		<?php 
		foreach($lista as $item) {
		?>
		<article class = "row">
				<?= $item['nome_grupo'] ?>
				<?= $item['categoria'] ?>
				Criador: <?= $item['nome_user'] ?>
				<a href= "#">Participantes</a>
				<div class = "enter"><a href="<?= PATH_HREF ?>action/participa/<?= $item['id'] ?>/<?= $_SESSION['email'] ?>">Entrar no grupo</a></div>
		</article>
		<?php
		}
		?>
	</div>