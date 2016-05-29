	<?php (isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '' ?>
	<form class="default-form" action="<?= PATH_HREF ?>action/infoModelo" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Cadastrar Modelo de Veículo</h2>
			</div>
			
			<div class="form-line">
				<div class="col3">
					<label>Modelo:</label>
					<input type="text" name="modelo" maxlength="50">
				</div>

				<div class="col3">
					<label>Marca:</label>
					<input type="text" name="marca" maxlength="50">
				</div>

				<div class="col1">
					<label>Qtd. assentos:</label>
					<select name="lugares">
						<option value ="1">1</option>
						<option value ="2">2</option>
						<option value ="3">3</option>
						<option value ="4" selected>4</option>
						<option value ="5">5</option>
						<option value ="6">6</option>
						<option value ="7">7</option>
						<option value ="8">8</option>
						<option value ="9">9</option>
						<option value ="10">10</option>
					</select>
				</div>
			</div>

			<div>
				<button type="submit" class="btn">Cadastrar</button>
			</div>
		</fieldset>
	</form>