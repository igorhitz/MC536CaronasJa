	<?php 
		(isset($_GET['query'])) ? Carona::showQuery($_GET['query']) : '';
	
		$grupo = new Grupo;
		$lista_nomes = $grupo->getGrupos($_SESSION['email']);
	?>
	
	<form class="default-form" action="<?= PATH_HREF ?>action/carona" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Cadastrar Carona</h2>
			</div>
		
			<div class="form-line">
				<div class="col4">
					<label>Origem:</label>
					<input type="text" name="origem" placeholder="Cidade de partida. Ex: Bauru" maxlength="50">
				</div>

				<div class="col4">
					<label>Destino:</label>
					<input type="text" name="destino" placeholder="Cidade de chegada. Ex: Campinas" maxlength="50">
				</div>
			</div>

			<div class="form-line">
				<div class="col4">
					<label>Data:</label>
					<input type="date" name="data" placeholder="aaaa-mm-dd">
				</div>
				
				<div class="col4">
					<label>Horário:</label>
					<input type="time" name="hora" placeholder="hh:mm:ss">
				</div>
			</div>
			
			<div class="form-line">
				<div class="col4">
					<label>Valor:</label>
					<input type="text" name="preco">
				</div>
			</div>
			
			<div class="form-line">
				<div class="col4">
					<label>Passageiros:</label>
					<select name="qtd_passageiros">
						<option value ="1">1</option>
						<option value ="2">2</option>
						<option value ="3">3</option>
						<option value ="4" selected>4</option>
						<option value ="5">5</option>
						<option value ="6">6</option>
						<option value ="7">7</option>
						<option value ="8">8</option>
						<option value ="9">9</option>
						<option value ="10">10</option>
					</select>
				</div>
				
				<div class="col4">
					<label>Bagagem:</label>
					<select name="bagagem">
						<option value ="P">Pequena</option>
						<option value ="M" selected>Média</option>
						<option value ="G">Grande</option>
					</select>
				</div>
			</div>
			
			<div class="form-line">
				<div class = "col6">
					<label>Grupo:</label>
					<select name="id_grupo">
						<?php 	
						foreach($lista_nomes as $item) {
						?>
							<option value="<?= $item['id_grupo'] ?>"><?= $item['nome_grupo'] ?></option>
						<?php
						}
						?>
					</select>
				</div>
			</div>
			
			
			<div class="form-line">
				<div class="col6">
					<label>Descrição:</label>
					<textarea name="descricao" style="resize:none" rows = "5" cols = "80" placeholder="Ex: ar condicionado?"></textarea>
				</div>
			</div>

			<div>
				<input type="hidden" name="email" value="<?= $_SESSION['email'] ?>">
				<button type="submit" class="btn">Publicar Carona</button>
			</div>
		</fieldset>
	</form>