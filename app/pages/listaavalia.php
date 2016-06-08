	<?php
	$avalia = new Avalia;
	
	$lista = $avalia->findByEmail($_GET['email']);

	SiteHandler::getQueryAlert(Avalia::$query);
	?>
	<br>
	<?php if($avalia->rows > 0) { ?>
	<div class="totalbusca"><span ><?= $avalia->rows ?>&nbsp;</span><h1>avaliações encontradas</h1></div>
	<?php } else { ?>
	<div class="totalbusca"><h1>Nenhuma avaliação foi encontrada.</h1></div>
	<?php 
	} if ($avalia->rows > 0) {
	?>
	<div class = "search-results">
		<?php 
		foreach($lista as $item) {
		?>
		<article class = "row">
			<div class = "user">	
				<img class = "photo" src = "<?= $item['foto_avaliador'] ?>" width="72" height="72">
				<div class = "info">
					<h2 class = "username">De: <?= $item['nome_avaliador'] ?></h2>
					 <br> <br>
				</div>
			</div>
			<div class = "description-box">
				<h3 class = "day-time"><?= SiteHandler::formatData($item['data']) ?></h3>
				<span class = "dark">Nota: <?= $item['nota'] ?></span>
				<h3 class = "description"><?= $item['conteudo'] ?></h3>
			</div>
		</article>
		<?php
	} }
		?>
	</div>