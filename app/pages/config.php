	<?php (isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '' ?>
	<form class="default-form" action="<?= PATH_HREF ?>action/usuario" method="update">
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
					<label>E-mail:</label>
					<input type="text" name="email" placeholder="Seu endereço de email" maxlength="100">
				</div>

				<div  class="col4">
					<label>Senha:</label>
					<input type="password" name="senha" placeholder="Sua senha">
				</div>
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
