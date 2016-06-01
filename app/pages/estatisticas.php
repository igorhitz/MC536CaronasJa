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
			<?php
				foreach($lista_ranking as $item) {
			?>
				<tr>
					<td><p><b><?= $item['nome_avaliado'] ?></b></p></td>
					<td><p><?= number_format($item['media_nota'], 1) ?></p></td>
					<td><img src="<?= PATH.'resources/'?>gold.png" width="25" height="25"></td>
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