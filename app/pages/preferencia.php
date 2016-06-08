	<?php 
	(isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '';
	
	$preferencia = 	new Preferencia();
	$lista_preferencias = $preferencia->selectAll();
	?>
	<form class="default-form" action="<?= PATH_HREF ?>action/usuariopreferencia" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Cadastrar Preferência</h2>
			</div>
			<div class="form-line">
				<div class="col3">
					<label>Selecione uma preferência:</label>
					<select name="idpreferencia" maxlength="50">
						<?php
						foreach($lista_preferencias as $item) {
						?>
						<option value="<?= $item['id'] ?>"><?= $item['descricao'] ?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			<div>
				<input type="hidden" name="email" value="<?= $_SESSION['email'] ?>">
				<button type="submit" class="btn">Cadastrar</button>
			</div>
		</fieldset>
	</form>