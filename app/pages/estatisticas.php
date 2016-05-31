<?php
	$avalia = new Avalia;
	$listaRes = $avalia->ranking();
?>

	<div class="lefloat">
		<div class = "card">
		<h2>Ranking</h2><br>
		<?php
			foreach($listaRes as $item) {
		?>
				<p><?= $item['email_avaliado'] ?> - <?= $item['media_nota'] ?></p>
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
		</div>
		<br>
		<div class = "card">
			<h2>Para onde chegam mais usuários?</h2>
			<br>
		</div>
	</div>