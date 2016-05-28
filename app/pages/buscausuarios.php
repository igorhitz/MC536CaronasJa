	<?php (isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '' ?>
	<form class="default-form" action="" method="post">
		<fieldset>
			<div class = "form-line">
				<h2>Buscar Usuário</h2>
			</div>
			
			<div class = "form-line">
				<div class = "col4">
					<label>Nome:</label>
					<input type="text" name="nome" placeholder="Nome do usuário. Ex: Yuri" maxlength="50">
				</div>
			</div>
			
			<div>
				<button type="submit" class="btn">Buscar Usuario</button>
			</div>
		</fieldset>
	</form>