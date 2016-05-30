	<?php (isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '' ?>
	<form id="buscarUsuarioForm" class="default-form" action="<?= PATH_HREF ?>listaUsuarios/">
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
	
	<script>
		$('#buscarUsuarioForm').submit(function(e){
			e.preventDefault();
			var nome = $('input[name=nome]').val();
			$(location).attr('href','listaUsuarios/nome='+nome+'');
		});
	</script>