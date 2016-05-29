	<?php (isset($_GET['query'])) ? Grupo::showQuery($_GET['query']) : '' ?>
	<form class="default-form" action="<?= PATH_HREF ?>action/grupo" method="post">
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
					<select name="categoria">
						<option selected value="Grupo de Amigos">Grupo de Amigos</option>
						<option value="Grupo de Caronas">Grupo de Caronas</option>
						<option value="Grupo de Caravanas">Grupo de Caravanas</option>
					</select>
				</div>
			</div>

			<div>
				<input type="hidden" name="email_criador" value="<?= $_SESSION['email'] ?>">
				<button type="submit" class="btn">Cadastrar Grupo</button>
			</div>
		</fieldset>
	</form>