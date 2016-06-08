	<?php (isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '' ?>
	<form class="default-form" action="<?= PATH_HREF ?>action/preferencia" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Cadastrar Preferência</h2>
			</div>
			
			<div class="form-line">
				<div class="col3">
					<label>Descrição:</label>
					<input type="text" name="descricao" maxlength="50" placeholder="">
				</div>

			<div>
				<button type="submit" class="btn">Cadastrar</button>
			</div>
		</fieldset>
	</form>