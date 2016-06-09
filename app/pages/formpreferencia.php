	<?php (isset($_GET['query'])) ? Preferencia::showQuery($_GET['query']) : '' ?>
	<form class="default-form" action="<?= PATH_HREF ?>action/infoModelo" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Cadastrar Preferência</h2>
			</div>
			
			<div class="form-line">
				<textarea name="descricao" placeholder="Sem fumantes" rows="5" cols="50"></textarea>
			</div>

			<div>
				<button type="submit" class="btn">Cadastrar</button>
			</div>
		</fieldset>
	</form>