	<?php (isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '' ?>
	<form class="default-form" action="<?= PATH_HREF ?>action/preferencia" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Cadastrar Preferência</h2>
			</div>
			
			<div class="form-line">
				<div class="col3">
					<label>Descrição:</label>
					<textarea name="descricao" maxlength="50" rows="5" cols="50" placeholder="Ex: Prefiro caronas sem fumantes."></textarea>
				</div>
			</div>
			<div>
				<input type="hidden" name="email" value="<?= $_SESSION['email'] ?>">
				<button type="submit" class="btn">Cadastrar</button>
			</div>
		</fieldset>
	</form>