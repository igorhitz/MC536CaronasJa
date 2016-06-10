	<?php (isset($_GET['query'])) ? Veiculo::showQuery($_GET['query']) : '';
	//busca informações de modelos
	$infoModelo = new InfoModelo;
	$lista = $infoModelo->selectAll();
	$veiculo = new Veiculo;
	$usuarioVeiculo = $veiculo->findByEmail($_SESSION['email']);
	?>
	<?php
	if (!empty($usuarioVeiculo)) {
		SiteHandler::getAlert('Você já cadastrou um veículo.', 'advise');
		$marca = $infoModelo->findByModelo($usuarioVeiculo[0]['modelo']);
	?>
	<table class="show-results">
		<tr height="30">
			<th>Marca e Modelo</th>
			<th>Cor</th>
			<th>Categoria</th>
			<th>Conforto</th>
		</tr>
		<tr height="30">
			<td><?= $marca[0]['marca'].' - '.$usuarioVeiculo[0]['modelo'] ?></td>
			<td><?= $usuarioVeiculo[0]['cor'] ?></td>
			<td><?= $usuarioVeiculo[0]['categoria'] ?></td>
			<td><?= $usuarioVeiculo[0]['conforto'] ?></td>
		</tr>
	</table>
	
	<a href="<?= PATH_HREF ?>Config" class="btnL" role="button">Editar Veículo</a>
	<a href="<?= PATH_HREF ?>action/deleteVeiculo/id=<?= $usuarioVeiculo[0]['id'] ?>" class="btnL redBtn" role="confirm">Excluir Veículo</a>

	<?php
	} else {
	?>
	<form class="default-form" action="<?= PATH_HREF ?>action/veiculo" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Cadastrar Veículo</h2>
			</div>
			
			<div class="form-line">
				<div class="col4">
					<label>Marca e modelo:</label>
					<select name="modelo" maxlength="50">
						<?php 	
						foreach($lista as $item) {
						?>
						<option value="<?= $item['modelo'] ?>"><?= $item['marca'].' - '.$item['modelo'] ?></option>
						<?php
						}
						?>
					</select>
				</div>

				<div class="col4">
					<label>Cor:</label>
					<select name="cor">
						<option value="Amarelo">Amarelo</option>
						<option value="Azul">Azul</option>
						<option value="Branco">Branco</option>
						<option value="Laranja">Laranja</option>
						<option value="Prata">Prata</option>
						<option value="Preto">Preto</option>
						<option value="Verde">Verde</option>
						<option value="Vermelho">Vermelho</option>						
						<option value="Outra">Outra</option>
					</select>
				</div>
			</div>
			
			<div class="form-line">
				<div class="col4">
					<label>Categoria:</label>
					<select name="categoria">
						<option value="Hatch">Hatch</option>
						<option value="Sedan">Sedan</option>
						<option value="SUV">SUV</option>
						<option value="Perua/Van">Perua/Van</option>
					</select>
				</div>

				<div class="col4">
					<label>Conforto:</label>
					<select name="conforto">
						<option value="Básico">Básico</option>
						<option value="Confortável">Confortável</option>
						<option value="Luxuoso">Luxuoso</option>
					</select>
				</div>
			</div>

			<div>
				<input type="hidden" name="email" value="<?= $_SESSION['email'] ?>">
				<button type="submit" class="btn">Cadastrar</button>
			</div>
		</fieldset>
	</form>
	<?php 
	}
	?>
