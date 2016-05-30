	<?php
	$reserva = new Reserva;
	//caronas reservadas
	$listaRes = $reserva->findByEmail($_SESSION['email']);


	$carona = new Carona;
	//caronas oferecidas
	$listaOfer = $carona->findByEmail($_SESSION['email']);
	?>
	<br>
	
	<div class="lefloat">
		<?php 	SiteHandler::getQueryAlert(Reserva::$query); ?>
		<h2>Você tem <?= $reserva->rows ?> caronas reservadas</h2>
		<div class = "search-results lefloat">
			<?php 
			foreach($listaRes as $itemRes) {
			?>
			<div>
			<p><strong>Origem:</strong> <?= $itemRes['origem'] ?></p>
			<p><strong>Destino:</strong> <?= $itemRes['origem'] ?></p>
			<p><strong>Data:</strong> <?= $itemRes['data'] ?></p>
			<p><strong>Hora:</strong> <?= $itemRes['hora'] ?></p>
			<p><strong>Motorista:</strong> <?= $itemRes['motorista'] ?></p>
			</div>
			<br>
		<?php
		}
		?>
		</div>
	</div>


	<div class="rifloat">
		<?php 	SiteHandler::getQueryAlert(Reserva::$query); ?>
		<h2>Você está oferencendo <?= $carona->rows ?> caronas</h2>
		<div class = "search-results lefloat">
			<?php 
			foreach($listaOfer as $itemOfer) {
			?>
			
		<?php
		}
		?>
		</div>
	</div>