	<?php
	$caronas = new Carona;
	$lista = $caronas->selectAll();
	print_r($lista);
	?>
	<br>
	<div class="totalbusca"><span >120&nbsp;</span><h1>viagens encontradas</h1></div>
	<div class = "search-results">
		<?php 
		foreach($lista as $item) {
		?>
		<article class = "row">
			<div class = "user">	
				<img class = "photo" src = "https://d2kwny77wxvuie.cloudfront.net/user/-SEos2b3QV2Op5xI4j5HsA/thumbnail_72x72.jpeg" width="72" height="72">
				<div class = "info">
					<h2 class = "username"><?= $item['nome'] ?></h2>
					21 anos <br>
					<span class = "dark"><?= $item['modelo'] ?></span> <br> <br>
				</div>
				
				<div class = "trust">
					<p class="ratings">
						<img src = "<?= PATH.'resources/'?>star.png" width="10" height="10">
						<span class = "dark">4.9</span> 
						<span class = "light"> - 10 avaliações</span>
					</p>
				</div>
				
				<div class = "icons">
					<a href= "msg"><img src = "<?= PATH.'resources/'?>msg.png" width="30" height="30"></a>
					<a href= "avaliar"><img src = "<?= PATH.'resources/'?>avaliar.png" width="30" height="30"></a>
				</div>
			</div>
			<div class = "description-box">
				<h3 class = "day-time"><?= $item['data'] ?> às <?= $item['hora'] ?></h3>
				<h3 class = "from-to">
					<span class ="local"><?= $item['origem'] ?></span>
					<span class ="arrow">→</span>
					<span class = "local"><?= $item['destino'] ?></span>
				</h3>
				<h3 class = "description"><?= $item['descricao'] ?></h3>
				<span class = "bagagem">Bagagem: <?= $item['bagagem'] ?></span>
			</div>
			<div class = "offer">
				<div class = "price"><strong><span>R$<?= $item['preco'] ?></span></strong><span class="perUnit" dir = "rtl">por passageiro</span></div>
				<div class = "availability"><strong>1&nbsp;</strong><span>lugares disponíveis</span></div>
				<div class = "enter"><a href = "#">Ocupar lugar</a></div>
			</div>
		</article>
		<?php
		}
		?>
	</div>