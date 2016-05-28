	<?php (isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '' ?>
	<form class = "default-form" action="<?= PATH_HREF ?>action/msg" method="post">
		<fieldset>
			<div class="form-line">
				<h2>Enviando mensagem para: Caio H.</h2>
			</div>
			
			<div class = "form-line">
				<div class="col10">
					<label>Conteúdo:</label>
					<textarea name = "conteudo" style="resize:none" rows = "5" cols = "50" placeholder="Ex: ar condicionado?"></textarea>
				</div>
			</div>
			
			<div>
				<button type="submit" class="btn">Enviar Mensagem</button>
			</div>
		</fieldset>
	</form>