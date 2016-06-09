	<?php 
	(isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '';
	$usuario = new Usuario;
	$item = $usuario->findByEmail($_SESSION['email']);
	 ?>
	<form class="default-form" action="<?= PATH_HREF ?>action/usuarioupdate" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Configurações</h2>
			</div>
			<div class="form-line">
				<h2>Editar Usuário</h2>
			</div>	
				
			<div class="form-line">
				<div class="col col6">
					<label>Nome:</label>
					<input type="text" name="nome" value = "<?= $item['nome'] ?>" maxlength="50">
				</div>

				<div class="col2">
					<label>Gênero:</label>
					<select name="genero">
						<option value="M" <?php if($item['genero']=='M') echo 'selected'; ?>>Masculino</option>
						<option value="F" <?php if($item['genero']=='F') echo 'selected'; ?>>Feminino</option>
					</select>
				</div>
			</div>

			<div class="form-line">
				<div class="col4">
					<input type="hidden" name="email" value="<?= $_SESSION['email'] ?>" maxlength="100">
				</div>

			<div class="form-line">
				<div class="col8">
					<label>Foto de perfil:</label>
					<input type="text" name="foto" value="<?= $item['foto'] ?>">
				</div>
			</div>

			<div class="form-line">
				<div class="col4">
					<label>Data de nascimento:</label>
					<input type="date" name="nascimento" placeholder="dd/mm/aaaa" value="<?= $item['nascimento'] ?>">
				</div>

				<div  class="col4">
					<label>Celular:</label>
					<input type="text" name="celular" placeholder="Seu número de celular" maxlength="11" value="<?= $item['celular'] ?>">
				</div>
			</div>


			<div>
				<button type="submit" class="btn">Salvar Alterações</button>
			</div>
		</fieldset>
	</form>	

	</form>
	<?php 
	$infoModelo = new InfoModelo;
	$lista = $infoModelo->selectAll();
	$veiculo = new Veiculo;
	$usuarioVeiculo = $veiculo->findByEmail($_SESSION['email']);
	if (!empty($usuarioVeiculo)) {
	 ?>
	<form class="default-form" action="<?= PATH_HREF ?>action/veiculoupdate" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Editar Veículo</h2>
			</div>
			
			<div class="form-line">
				<div class="col4">
					<label>Marca e modelo:</label>
					<select name="modelo" maxlength="50">
						<?php 	
						foreach($lista as $item) {
						?>
						<option value="<?= $item['modelo'] ?>"  <?php if($item['modelo'] == $usuarioVeiculo[0]['modelo']) echo 'selected'; ?>><?= $item['modelo'].' - '.$item['marca'] ?></option>
						<?php
						}
						?>
					</select>
				</div>

				<div class="col4">
					<label>Cor:</label>
					<select name="cor">
						<option value="Amarelo" <?php if('Amarelo' == $usuarioVeiculo[0]['cor']) echo 'selected'; ?>>Amarelo</option>
						<option value="Azul" <?php if('Azul' == $usuarioVeiculo[0]['cor']) echo 'selected'; ?>>Azul</option>
						<option value="Branco" <?php if('Branco' == $usuarioVeiculo[0]['cor']) echo 'selected'; ?>>Branco</option>
						<option value="Laranja" <?php if('Laranja' == $usuarioVeiculo[0]['cor']) echo 'selected'; ?>>Laranja</option>
						<option value="Prata" <?php if('Prata' == $usuarioVeiculo[0]['cor']) echo 'selected'; ?>>Prata</option>
						<option value="Preto" <?php if('Preto' == $usuarioVeiculo[0]['cor']) echo 'selected'; ?>>Preto</option>
						<option value="Verde" <?php if('Verde' == $usuarioVeiculo[0]['cor']) echo 'selected'; ?>>Verde</option>
						<option value="Vermelho" <?php if('Vermelho' == $usuarioVeiculo[0]['cor']) echo 'selected'; ?>>Vermelho</option>						
						<option value="Outra" <?php if('Outra' == $usuarioVeiculo[0]['cor']) echo 'selected'; ?>>Outra</option>
					</select>
				</div>
			</div>
			
			<div class="form-line">
				<div class="col4">
					<label>Categoria:</label>
					<select name="categoria">
						<option value="Hatch" <?php if('Hatch' == $usuarioVeiculo[0]['categoria']) echo 'selected'; ?>>Hatch</option>
						<option value="Sedan" <?php if('Sedan' == $usuarioVeiculo[0]['categoria']) echo 'selected'; ?>>Sedan</option>
						<option value="SUV" <?php if('SUV' == $usuarioVeiculo[0]['categoria']) echo 'selected'; ?>>SUV</option>
						<option value="Perua/Van" <?php if('Perua/Van' == $usuarioVeiculo[0]['categoria']) echo 'selected'; ?>>Perua/Van</option>
					</select>
				</div>

				<div class="col4">
					<label>Conforto:</label>
					<select name="conforto">
						<option value="Básico" <?php if('Básico' == $usuarioVeiculo[0]['conforto']) echo 'selected'; ?>>Básico</option>
						<option value="Confortável" <?php if('Confortável' == $usuarioVeiculo[0]['conforto']) echo 'selected'; ?>>Confortável</option>
						<option value="Luxuoso" <?php if('Luxuoso' == $usuarioVeiculo[0]['conforto']) echo 'selected'; ?>>Luxuoso</option>
					</select>
				</div>
			</div>

			<div>
				<input type="hidden" name="email" value="<?= $_SESSION['email'] ?>">
				<button type="submit" class="btn">Salvar Alterações</button>
			</div>
		</fieldset>
	</form>
<?php
	} else{
?>
	<form class="default-form" method="post">
		<fieldset>
			<div>
				<a href="<?= PATH_HREF ?>veiculo" class="btnL" role="button">Cadastrar Veículo</a>
			</div>
		</fieldset>
	</form>
<?php
}
?>
