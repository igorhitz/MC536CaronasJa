	<form class="default-form" action="" method="post">
		<fieldset>
			<div class="form-line">
				<div class="col col6">
					<label>Nome:</label>
					<input type="text" name="userName" placeholder="Seu nome completo">
				</div>

				<div class="col2">
					<label>Gênero:</label>
					<select name="userGender">
						<option>Gênero</option>
						<option value="M">Masculino</option>
						<option value="F">Feminino</option>
					</select>
				</div>
			</div>

			<div class="form-line">
				<div class="col4">
					<label>E-mail:</label>
					<input type="text" name="userEmail" placeholder="Seu endereço de email">
				</div>

				<div  class="col4">
					<label>Senha:</label>
					<input type="password" name="userPass" placeholder="Sua senha">
				</div>
			</div>

			<div class="form-line">
				<div class="col8">
					<label>Foto de perfil:</label>
					<input type="text" name="userPhoto" placeholder="URL de foto de perfil">
				</div>
			</div>

			<div>
				<button type="submit" class="btn">Cadastrar</button>
			</div>
		</fieldset>
	</form>
