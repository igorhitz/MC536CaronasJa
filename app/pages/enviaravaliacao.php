	<?php (isset($_GET['query'])) ? Avalia::showQuery($_GET['query']) : '';
	(isset($_GET['email'])) ? $email = $_GET['email'] : '';
	?>
	<form class = "default-form" action="<?= PATH_HREF ?>action/avalia" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Enviar Avaliação</h2>
			</div>
			
			<div class="form-line">
				<div class="col10">
					<label>Avaliando:</label>
					<input type = "text" name="email_avaliado" value = "<?= (isset($email)) ? $email : '' ?>"> 
				</div>
			</div>
			
			<div class="form-line">
				<div class="col4">
					<label>Nota:</label>
					<select name="nota">
						<option value ="1">1</option>
						<option value ="2">2</option>
						<option value ="3">3</option>
						<option value ="4">4</option>
						<option value ="5" selected>5</option>
					</select>
				</div>
			</div>
			
			<div class = "form-line">
				<div class="col10">
					<label>Descrição:</label>
					<textarea name = "conteudo" style="resize:none" rows = "5" cols = "50" placeholder="Ex: boa conversa, muito educado!"></textarea>
				</div>
			</div>
			
			<div>
				<input type = "hidden" name="email_avaliador" value = "<?= $_SESSION['email']?>"> 
				<button type="submit" class="btn">Enviar Avaliação</button>
			</div>
		</fieldset>
	</form>