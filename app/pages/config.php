	<?php (isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '' ?>
	<form class="default-form" action="<?= PATH_HREF ?>action/usuarioupdate" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Editar Usuário</h2>
			</div>	
				
			<div class="form-line">
				<div class="col col6">
					<label>Nome:</label>
					<input type="text" name="nome" value = "Caio Henrique Andrade da Silva" maxlength="50">
				</div>

				<div class="col2">
					<label>Gênero:</label>
					<select name="genero">
						<option value="M">Masculino</option>
						<option value="F">Feminino</option>
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
					<input type="text" name="foto" placeholder="URL de foto de perfil">
				</div>
			</div>

			<div class="form-line">
				<div class="col4">
					<label>Data de nascimento:</label>
					<input type="text" name="nascimento" placeholder="aaaa-mm-dd">
				</div>

				<div  class="col4">
					<label>Celular:</label>
					<input type="text" name="celular" placeholder="Seu número de celular" maxlength="11">
				</div>
			</div>


			<div>
				<button type="submit" class="btn">Salvar Alterações</button>
			</div>
		</fieldset>
	</form>	

	</form>
	<?php (isset($_GET['query'])) ? Veiculo::showQuery($_GET['query']) : '';
	$infoModelo = new InfoModelo;
	$lista = $infoModelo->selectAll();
	 ?>
	<form class="default-form" action="<?= PATH_HREF ?>action/veiculoupdate" method="post">
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
						<option value="<?= $item['modelo'] ?>"><?= $item['modelo'].' - '.$item['marca'] ?></option>
						<?php
						}
						?>
					</select>
				</div>

				<div class="col4">
					<label>Cor:</label>
					<select name="cor">
						<option value="Prata">Prata</option>
						<option value="Preto">Preto</option>
						<option value="Branco">Branco</option>
						<option value="Azul">Azul</option>
						<option value="Amarelo">Amarelo</option>
						<option value="Vermelho">Vermelho</option>
						<option value="Verde">Verde</option>
						<option value="Laranja">Laranja</option>
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
				<button type="submit" class="btn">Salvar Alterações</button>
			</div>
		</fieldset>
	</form>