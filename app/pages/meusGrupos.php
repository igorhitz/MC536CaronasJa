	<?php
	$participa = new Participa;

	//se existirem buscamos por filtro
	$lista = $participa->findByEmail($_SESSION['email']);
	
	SiteHandler::getQueryAlert(Participa::$query);
	?>
	<br>
	<?php if($participa->rows > 0) { ?>
	<div class="totalbusca"><span >Você participa de <?= $participa->rows ?>&nbsp;</span><h1>grupo(s)</h1></div>
	<?php } else { ?>
	<div class="totalbusca"><h1>Você não participa de nenhum grupo.</h1></div>
	<?php 
	}
	?>
	<div class = "search-results">	
		<?php 
		foreach($lista as $item) {
		?>
		<article class = "row">
			<div class = "name"><?= $item['nome_grupo'] ?></div>
			<div class = "categoria"><?= $item['categoria'] ?></div>
			<div class = "participa"><a href= "#">Participantes</a></div>
			
			<?php
				$participa = new Participa;
				$res = $participa->findById($item['id_grupo']);
				if($item['email_criador'] == $_SESSION['email']){ ?>
					<div class = "entra btn">Você criou o grupo!</div>
				<?php
				}
				else {						
					$flag = false;
					for($i = 0; $i < $reserva->rows; $i++){
						if ($res[$i]['email'] == $_SESSION['email']){ ?>
							<div class = "entra btn">Você já participa!</div>
			<?php
							$flag = true;
						}
					}
					if ($flag == false){ ?>
						<div class = "entra btn"><a href="<?= PATH_HREF ?>action/participa/<?= $item['id'] ?>/<?= $_SESSION['email'] ?>">Entrar no Grupo</a></div>
			<?php
					}
				} ?>
		</article>
		<?php
		}
		?>
	</div>