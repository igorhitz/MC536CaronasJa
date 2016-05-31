<?php
	$avalia = new Avalia;
	$lista_ranking = $avalia->ranking();
	
	$carona_origem = new Carona;
	$lista_origem = $carona_origem->moreUsers("origem");
	
	$carona_destino = new Carona;
	$lista_destino = $carona_destino->moreUsers("destino");
?>

	<div class="lefloat">
		<div class = "card">
		<h2>Ranking</h2><br>
		<?php
			foreach($lista_ranking as $item) {
		?>
			<p><?= $item['nome_avaliado'] ?> - <?= number_format($item['media_nota'], 1) ?></p>
			<br>
		<?php
			}
		?>
		</div>
	</div>


	<div class="rifloat">
		<div class = "card">
		<h2>De onde partem mais usuários?</h2>
		<br>
		<?php
			foreach($lista_origem as $item) {
		?>
			<p><?= $item['local'] ?> - <?= $item['qtd'] ?> caronas</p>
			<br>
		<?php
			}
		?>	
		</div>
		<br>
		
		<div class = "card">
		<h2>Para onde chegam mais usuários?</h2>
		<br>
		<?php
			foreach($lista_destino as $item) {
		?>
			<p><?= $item['local'] ?> - <?= $item['qtd'] ?> caronas</p>
			<br>
		<?php
			}
		?>
		</div>
	</div>