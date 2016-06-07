	<?php
	$usuario = new Usuario;
	$listas = array ();
	//verifica se existe parametros de filtro de busca
	if(isset($_GET['nome'])) {
		$nome = $_GET['nome'];
		//se existirem buscamos por filtro
		$listas = $usuario->findByNome($nome);
		
	}
	
	(isset($_GET['query'])) ? Usuario::showQuery($_GET['query']) : '';
	
	SiteHandler::getQueryAlert(Usuario::$query);
	?>

<div class="default-list">

	<div class="totalbusca">
	
		<?php if($usuario->rows > 0) { ?>
		<span><?= $usuario->rows ?>&nbsp;</span><h1>pessoas encontradas</h1>
		<?php } else { ?>
		<h1>Nenhuma pessoa foi encontrada.</h1>
		<?php 
		}
		?>
	</div>
	<?php 
		foreach($listas as $item) {
	?>
	<div class="line">
		<div class="col4">
			<div class="info">
				<img src="<?= PATH.'resources/'.$item['foto'] ?>" width="72" height="72">
				<span class="username"><b><?= $item['nome'] ?></b> <br>
				<span class="username">Idade: <?= 2016 - ($item['nascimento']) ?> anos <br>
				</span>
				<div class="trust">
					<p>
						<img src="<?= PATH.'resources/'?>star.png" width="15" height="15">
						<span class="dark">4.9&nbsp;</span> 
						<span class="light"> - 10 avaliações</span>
					</p>
				</div>
				
			</div>

		</div>
			<div class = "icons col3">
				<?php if($_SESSION['email'] !== $item['email']): ?>
					<a href="<?= PATH_HREF  ?>action/amigo/<?= $item['email'] ?>/<?= $_SESSION['email'] ?>" class="btn">Adicionar Amigo</a> <br> <br>
				<?php endif; ?>	
					<a href= "<?= PATH_HREF ?>enviarMensagem/email=<?= $item['email'] ?>"><img src = "<?= PATH.'resources/'?>msg.png" width="30" height="30"></a>
					<a href= "<?= PATH_HREF ?>enviarAvaliacao/email=<?= $item['email'] ?>"><img src = "<?= PATH.'resources/'?>avaliar.png" width="30" height="30"></a>
			</div>
	</div>
	<?php
		}
	?>
</div>