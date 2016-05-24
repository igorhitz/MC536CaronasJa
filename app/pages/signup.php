<div class = "wrapper">
	<form id="form1" name="form1" class="" accept-charset="UTF-8" autocomplete="off" method="post" novalidate action="">
		<h2>Cadastro de Usuário</h2>
		<ul>
			<li id = "field1">
				<label class = "desc" id = "title1" for = "Field1">Nome</label>
				<div>
					<input id = "Field1" name = "Field1" type = "text" class="field text medium" maxlength="50" tabindex = "1">
				</div>
			</li>
			<li id = "field2">
				<label class = "desc" id = "title2" for = "Field2">Email</label>
				<div>
					<input id = "Field2" name = "Field2" type = "email" class="field text medium" maxlength="50" tabindex = "2"> 
				</div>
			</li>
			<li id = "field3">
				<label class = "desc" id = "title3" for = "Field3">Senha</label>
				<div>
					<input id = "Field3" name = "Field3" type = "password" class ="field text" maxlength = "10" tabindex = "3">
				</div>
			</li>
			<li id = "field4">
				<label class = "desc" id = "title4" for = "Field4">Foto</label>
				<div>
					<input id = "Field4" name = "Field4" type = "file" name="pic" accept="image/*" class= "field text medium" value size = "10" maxlength = "6" tabindex = "4"> 
				</div>
			</li>
			<li id = "field5">
				<label class = "desc" id = "title5" for = "Field5">Data de Nascimento</label>
				<div>
					<input id = "Field5" name = "Field5" type = "date" value = "1996-05-11" class= "field text " value size = "11" maxlength = "10" tabindex = "5">
				</div>
			</li>
			<li id = "field6">
				<label class = "desc" id = "title6" for = "Field6">Sexo</label>
				<div>
					 <input type="radio" name="gender" value="male" tabindex = "6"> Masculino<br>
           <input type="radio" name="gender" value="female"> Feminino<br>
           <input type="radio" name="gender" value="other"> Outro
				</div>
			</li>
			<li id = "field7">
				<label class = "desc" id = "title7" for = "Field7">Celular</label>
				<div>
					<input id = "Field7" type ="text" class = "field text" tabindex = "7">
				</div>
			</li>
			<li>
				<div>
					<input type="submit" class = "bt" value="Cadastrar Usuário">
				</div>
			</li>
		</ul>
	</form>
</div>