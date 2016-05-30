	<form id="buscarCaronaForm" class="default-form" action="<?= PATH_HREF ?>listacaronas/">
		<fieldset>
			<div class="form-line">
				<h2>Buscar Carona</h2>
			</div>	
			
			<div class="form-line">
				<div class="col4">
					<label>Origem:</label>
					<input type="text" name="origem" placeholder="Cidade de partida. Ex: Bauru" required maxlength="50">
				</div>

				<div class="col4">
					<label>Destino:</label>
					<input type="text" name="destino" placeholder="Cidade de chegada. Ex: Campinas" required maxlength="50">
				</div>
			</div>

			<div class="form-line">
				<div class="col4">
					<label>Data:</label>
					<input type="date" name="data" placeholder="aaaa-mm-dd">
				</div>
			</div>

			<div>
				<button type="submit" class="btn">Buscar</button>
			</div>
		</fieldset>
	</form>

	<script>
		$('#buscarCaronaForm').submit(function(e){
			e.preventDefault();
			var origem = $('input[name=origem]').val();
			var destino = $('input[name=destino]').val();
			var data = $('input[name=data]').val();
			$(location).attr('href','listaCaronas/origem='+origem+'/destino='+destino+'/data='+data+'');
		});
	</script>