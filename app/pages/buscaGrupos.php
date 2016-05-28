	<?php (isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '' ?>
	<form class="default-form" action="<?= PATH_HREF ?>action/usuario" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Cadastrar Grupo</h2>
			</div>
			
			<div class="form-line">
				<div class="col4">
					<label>Nome:</label>
					<input type="text" name="nome" maxlength="50">
				</div>
			</div>
			
			<div class="form-line">
				<div class="col4">
					<label>Categoria:</label>
					<input type="text" name="categoria" maxlength="50">
				</div>
			</div>

			<div>
				<button type="submit" class="btn">Buscar</button>
			</div>
		</fieldset>
	</form>