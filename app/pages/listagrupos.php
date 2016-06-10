	<?php
	$grupos = new Grupo;
	
	//verifica se existe parametros de filtro de busca
	if(isset($_GET['nome']) && !empty($_GET['nome'])) {
		$nome = $_GET['nome'];

		//se existirem buscamos por filtro
		$lista = $grupos->getGruposByNome($nome);
	} else {
		//senão obtem lista geral (*)
		$lista = $grupos->selectAll();
	}
	
	SiteHandler::getQueryAlert(Grupo::$query);
	?>
	<br>
	<?php if($grupos->rows > 0) { ?>
	<div class="totalbusca"><span ><?= $grupos->rows ?>&nbsp;</span><h1>grupos encontrado(s)</h1></div>
	<?php } else { ?>
	<div class="totalbusca"><h1>Nenhum grupo foi encontrado.</h1></div>
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
			<div class = "participa"><a href= "<?= PATH_HREF ?>listaUsuarios/grupo=<?=$item['id_grupo']?>">Participantes</a></div>
			
			<?php
				$participa = new Participa;
				$res = $participa->findById($item['id_grupo']);
				if($item['email_criador'] == $_SESSION['email']){ ?>
					<div class = "entra2 btn">Você criou o grupo!</div>
				<?php
				}
				else {						
					$flag = false;
					for($i = 0; $i < $participa->rows; $i++){
						if ($res[$i]['email'] == $_SESSION['email']){ ?>
							<div class = "entra2 btn">Você já participa!</div>
			<?php
							$flag = true;
						}
					}
					if ($flag == false){ ?>
						<div class = "entra btn"><a href="<?= PATH_HREF ?>action/participa/<?= $item['id_grupo'] ?>/<?= $_SESSION['email'] ?>">Entrar no Grupo</a></div>
			<?php
					}
				} ?>
		</article>
		<?php
		}
		?>
	</div>