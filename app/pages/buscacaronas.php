	<?php (isset($_GET['query'])) ? Carona::showQuery($_GET['query']) : '';
	
	?>
	<form class="default-form" action="<?= PATH_HREF ?>action/carona" method="get">
		<fieldset>
			<div class="form-line">
				<h2>Buscar Carona</h2>
			</div>	
			
			<div class="form-line">
				<div class="col4">
					<label>Origem:</label>
					<input type="text" name="origem" placeholder="Cidade de partida. Ex: Bauru" maxlength="50">
				</div>

				<div class="col4">
					<label>Destino:</label>
					<input type="text" name="destino" placeholder="Cidade de chegada. Ex: Campinas" maxlength="50">
				</div>
			</div>

			<div class="form-line">
				<div class="col4">
					<label>Data:</label>
					<input type="date" name="data" placeholder="aaaa-mm-dd">
				</div>
			</div>

			<div>
				<button type="submit" class="btn">Buscar</button>
			</div>
		</fieldset>
	</form>