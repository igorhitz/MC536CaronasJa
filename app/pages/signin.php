	<?php (isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '' ?>
	<form class="default-form" action="<?= PATH_HREF ?>action/usuario" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Entrar</h2>
			</div>
			
			<div class="form-line">
				<div class="col4">
					<label>E-mail:</label>
					<input type="text" name="email" placeholder="Seu endereço de email" maxlength="100">
				</div>
			</div>

			<div class="form-line">
				<div  class="col4">
					<label>Senha:</label>
					<input type="password" name="senha" placeholder="Sua senha">
				</div>
			</div>

			<div>
				<button type="submit" class="btn">Entrar</button>
			</div>
		</fieldset>
	</form>