	<?php (isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '';
	$email = $_GET['email'];
	?>
	<form class = "default-form" action="<?= PATH_HREF ?>action/mensagem" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Enviando mensagem para: <?= $email ?></h2>
			</div>
			
			<div class = "form-line">
				<div class="col10">
					<label>Conteúdo:</label>
					<textarea name = "conteudo" style="resize:none" rows = "5" cols = "50" placeholder="Ex: ar condicionado?"></textarea>
				</div>
			</div>
			
			<div>
				<input type = "hidden" name = "email_destinatario" value = "<?= $email?>"> 
				<input type = "hidden" name = "email_remetente" value = "<?= $_SESSION['email']?>"> 
				<button type="submit" class="btn">Enviar Mensagem</button>
			</div>
		</fieldset>
	</form>