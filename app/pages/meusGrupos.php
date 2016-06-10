	<?php

	(isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '';

	$participa = new Participa;

	//se existirem buscamos por filtro
	$lista = $participa->findByEmail($_SESSION['email']);
	
	SiteHandler::getQueryAlert(Participa::$query);
	?>
	<br>
	<?php if($participa->rows > 0) { ?>
	<div class="totalbusca"><span >Você participa de <?= $participa->rows ?>&nbsp;</span><h1>grupo(s)</h1></div>
	<?php } else { ?>
	<div class="totalbusca"><h1>Você não participa de nenhum grupo.</h1></div>
	<?php 
	}
	?>
	<div class = "search-results">	
		<?php 
		foreach($lista as $itemg) {
		$grupo = new Grupo;
		$item = $grupo->findGruposbyId($itemg['id_grupo']);
		?>
		<article class = "row">
			<div class = "name"><?= $item[0]['nome_grupo'] ?></div>
			<div class = "categoria"><?= $item[0]['categoria'] ?></div>
			<div class = "participa"><a href= "<?= PATH_HREF ?>listaUsuarios/grupo=<?=$itemg['id_grupo']?>">Participantes</a></div>
			<div class = "participa"><a href= "<?= PATH_HREF ?>listaCaronas/grupo=<?=$itemg['id_grupo']?>">Caronas</a></div>"
		</article>
		<?php
		}
		?>
	</div>