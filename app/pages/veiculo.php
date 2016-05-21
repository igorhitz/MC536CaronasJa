<div class = "wrapper">
	<form action="action_page.php">
	  <fieldset>
		<legend>Registrar Veículo</legend>
		Marca:<br>
		<input type="text" name="Marca" maxlength="50"><br>
		Modelo:<br>
		<input type="text" name="Modelo" maxlength="50"><br>
		Cor:<br>
		<input type="text" name="Cor" maxlength="20"><br>
		Quantidade de lugares:<br>
		<select name="QtdLugares">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4" selected>4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
		</select><br>
		Categoria:<br>
		<input type="text" name="Categoria" maxlength="50"><br>
		Conforto:<br>
		<input type="text" name="Conforto" maxlength="50"><br><br>
		<input type="submit" value="Cadastrar Veículo!">
		
	  </fieldset>
	</form>
</div>