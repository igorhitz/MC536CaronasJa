<?php
	$avalia = new Avalia;
	$lista_ranking = $avalia->ranking();
	$rankingQuery = Avalia::$query;
	
	$carona_origem = new Carona;
	$lista_origem = $carona_origem->moreUsers("origem", 10);
	$origemQuery = Carona::$query;
	
	$carona_destino = new Carona;
	$lista_destino = $carona_destino->moreUsers("destino", 10);
	$destinoQuery = Carona::$query;
?>
	
	<div class="lefloat">
		<div class = "card">
		<?php 	SiteHandler::getQueryAlert($rankingQuery); ?>
			<h2>Ranking</h2><br>
			<table>
			<tr>
				<td><p><b><?= $lista_ranking[0]['nome_avaliado'] ?></b></p></td>
				<td><p><?= number_format($lista_ranking[0]['media_nota'], 1) ?></p></td>
				<td><img src="<?= PATH.'resources/'?>gold.png" width="25" height="25"></td>
			</tr>

			<tr>
				<td><p><b><?= $lista_ranking[1]['nome_avaliado'] ?></b></p></td>
				<td><p><?= number_format($lista_ranking[1]['media_nota'], 1) ?></p></td>
				<td><img src="<?= PATH.'resources/'?>silver.png" width="25" height="25"></td>
			</tr>
			
			<tr>
				<td><p><b><?= $lista_ranking[2]['nome_avaliado'] ?></b></p></td>
				<td><p><?= number_format($lista_ranking[2]['media_nota'], 1) ?></p></td>
				<td><img src="<?= PATH.'resources/'?>bronze.png" width="25" height="25"></td>
			</tr>
			
			<?php
				$i = 3;
				for($i = 3; $i < count($lista_ranking); $i++) {
			?>
				<tr>
					<td><p><b><?= $lista_ranking[$i]['nome_avaliado'] ?></b></p></td>
					<td><p><?= number_format($lista_ranking[$i]['media_nota'], 1) ?></p></td>
				</tr>
			<?php
				}
			?>
			</table>
		</div>
	</div>


	<div class="rifloat">
		<div class = "card">
			<?php 	SiteHandler::getQueryAlert($origemQuery); ?>			
			<h2>De onde partem mais usuários?</h2><br>
			<table>
			<?php
				foreach($lista_origem as $item) {
			?>
				<tr>
					<td><p><b><?= $item['local'] ?></b></p></td>
					<td><p><?= $item['qtd'] ?> caronas</p></td>
				</tr>

			<?php
				}
			?>
			</table>
		</div>
		<br>
		
		<div class = "card">
		<?php 	SiteHandler::getQueryAlert($destinoQuery); ?>
		<h2>Para onde chegam mais usuários?</h2><br>
		<table>
			<?php
				foreach($lista_destino as $item) {
			?>
				<tr>
					<td><p><b><?= $item['local'] ?></b></p></td>
					<td><p><?= $item['qtd'] ?> caronas</p></td>
				</tr>
			<?php
				}
			?>
			</table>
		</div>
	</div>