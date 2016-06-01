	<?php (isset($_GET['query'])) ? Grupo::showQuery($_GET['query']) : '' ?>
	<form id="buscarGrupoForm" class="default-form" action="<?= PATH_HREF ?>listaGrupos" method="get">
		<fieldset>
			<div class="form-line">
				<h2>Buscar Grupo</h2>
			</div>
			
			<div class="form-line">
				<div class="col4">
					<label>Nome:</label>
					<input type="text" name="nome" maxlength="50">
				</div>
			</div>

			<div>
				<button type="submit" class="btn">Buscar</button>
			</div>
		</fieldset>
	</form>

	<script>
		$('#buscarGrupoForm').submit(function(e){
			e.preventDefault();
			var nome = $('input[name=nome]').val();
			$(location).attr('href','listaGrupos/nome='+nome);
		});
	</script>