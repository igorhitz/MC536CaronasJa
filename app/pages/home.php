	<?php
	$usuario = new Usuario;
	$listaUsuario = $usuario->findByEmail($_SESSION['email']);
	
	$reserva = new Reserva;
	//caronas reservadas
	$listaRes = $reserva->findByEmail($_SESSION['email']);

	$carona = new Carona;
	//caronas oferecidas
	$listaOfer = $carona->findByEmail($_SESSION['email']);
	?>
	<br>
	
	<div>
	<h2>Olá, <?= $listaUsuario['nome'] ?>!</h2>
	<br>
	</div>
	<div class="lefloat">
		<?php 	SiteHandler::getQueryAlert(Reserva::$query); ?>
		<h2>Você tem <?= $reserva->rows ?> caronas reservadas</h2>
		<div class = "search-results lefloat">
			<?php 
			foreach($listaRes as $itemRes) {
			?>
			<div class = "card">
			<p><strong>Origem:</strong> <?= $itemRes['origem'] ?></p>
			<p><strong>Destino:</strong> <?= $itemRes['destino'] ?></p>
			<p><strong>Data:</strong> <?= SiteHandler::formatData($itemRes['data']) ?></p>
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
			<div class = "card">
			<p><strong>Origem:</strong> <?= $itemOfer['origem'] ?></p>
			<p><strong>Destino:</strong> <?= $itemOfer['destino'] ?></p>
			<p><strong>Data:</strong> <?= SiteHandler::formatData($itemOfer['data']) ?></p>
			<p><strong>Hora:</strong> <?= $itemOfer['hora'] ?></p>
			</div>
		<?php
		}
		?>
		</div>
	</div>