<div class = "wrapper">
	<form id="form1" name="form1" class="wufoo topLabel page1" accept-charset="UTF-8" autocomplete="off" method="post" novalidate action="">
		<h2>Registrar Carona</h2>
		<ul>
			<li id = "field1">
				<label class = "desc" id = "title1" for = "Field1">Origem</label>
				<div>
					<input id = "Field1" name = "Field1" type = "text" class="field text medium" maxlength="50" tabindex = "1">
				</div>
			</li>
			<li id = "field2">
				<label class = "desc" id = "title2" for = "Field2">Destino</label>
				<div>
					<input id = "Field2" name = "Field2" type = "text" class="field text medium" maxlength="50" tabindex = "2"> 
				</div>
			</li>
			<li id = "field3">
				<label class = "desc" id = "title3" for = "Field3">Data</label>
				<div>
					<input id = "Field3" name = "Field3" type = "date" value="2016-05-22" class ="field text" maxlength = "10" tabindex = "3">
				</div>
			</li>
			<li id = "field4">
				<label class = "desc" id = "title4" for = "Field4">Horário</label>
				<div>
					<input id = "Field4" name = "Field4" type = "time" class= "field text small" value size = "10" maxlength = "6" tabindex = "4">
				</div>
			</li>
			<li id = "field5">
				<label class = "desc" id = "title5" for = "Field5">Valor</label>
				<span class="symbol"><b>R$</b></span>
				<div>
					<input id = "Field5" name = "Field5" type = "text" class= "field text " value size = "11" maxlength = "10" tabindex = "5">
				</div>
			</li>
			<li id = "field6">
				<label class = "desc" id = "title6" for = "Field6">Passageiros</label>
				<div>
					<select id = "Field6" tabindex = "6">
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
			</li>
			<li id = "field7">
				<label class = "desc" id = "title7" for = "Field7">Bagagem</label>
				<div>
					<select id = "Field7" tabindex = "7">
						<option value ="P">Pequena</option>
						<option value ="M" selected>Média</option>
						<option value ="G">Grande</option>
					</select>
				</div>
			</li>
			<li id = "field8">
				<label class = "desc" id = "title8" for = "Field8">Descrição</label>
				<div>
					<textarea id = "Field8" name = "Field8" class = "field textarea medium" spellcheck = "true" rows = "10" cols = "70" tabindex = "8">
					</textarea>
				</div>
			</li>
			<li>
				<button type="submit" > Publicar Carona!<button>
			</li>
		</ul>
	</form>
</div>