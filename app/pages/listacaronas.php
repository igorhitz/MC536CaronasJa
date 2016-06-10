	<?php
	$caronas = new Carona;
	$date = new DateTime('today');
	//verifica se existe parametros de filtro de busca
	if(isset($_GET['origem']) && $_GET['destino']) {
		$origem = $_GET['origem'];
		$destino = $_GET['destino'];

		//data é opcional
		if(isset($_GET['data'])) {
			$data = $_GET['data'];
		} else {
			$data = '';
		}

		//se existirem buscamos por filtro
		$lista = $caronas->findByFilter($origem, $destino, $data);
	} else if (isset($_GET['grupo'])){
		$grupo = $_GET['grupo'];
		$lista = $caronas->findByGrupo($grupo);
	} else {
		//senão obtem lista geral (*)
		$lista = $caronas->selectAll();
	}
	
	SiteHandler::getQueryAlert(Carona::$query);
	?>
	<br>
	<?php if($caronas->rows > 0) { ?>
	<div class="totalbusca"><span ><?= $caronas->rows ?>&nbsp;</span><h1>viagens encontradas</h1></div>
	<?php } else { ?>
	<div class="totalbusca"><h1>Nenhuma carona foi encontrada.</h1></div>
	<?php 
	}
	?>
	<div class = "search-results">
		<?php 
		foreach($lista as $item) {
			$reserva = new Reserva;
			$res = $reserva->findById($item['id']);
			$avalia = new Avalia;
			$nota = $avalia->getCountAvgNotas($item['email_dono']);
			if ($avalia->rows < 1){
				$nota[0]['avg_nota'] = 0;
				$nota[0]['count_nota'] = 0;
			}
			$pref = new Preferencia;
			$usupref = new UsuarioPreferencias;
			$preferencias = $usupref->findByEmail($item['email_dono']);
			
			
		?>
		<article class = "row">
			<div class = "user">	
				<img class="photo" src="<?= $item['foto'] ?>" width="72" height="72">
				<div class = "info">
					<h2 class = "username"><?= $item['nome'] ?></h2>
					<?= $date->diff(date_create($item['nascimento']))->y ?> anos<br>
					<span class = "dark"><?= $item['marca'] ?> - <?= $item['modelo'] ?></span> <br> <br>
					<?php 
						foreach($preferencias as $valor){
						$descricao = $pref->findByID($valor['id']);
							switch ($descricao[0]['descricao']){
								case "Aceito fumantes": ?>
							<img src = "<?= PATH.'resources/'?>pref-smoking-yes.png" width="30px">
					<?php
								break;
								case "Nao aceito fumantes": ?>
							<img src =  "<?= PATH.'resources/'?>pref-smoking-no.png" width="30px">
					<?php
								break;
								case "Gosto de ouvir musica":?>
							<img src = "<?= PATH.'resources/'?>pref-music-yes.png" width="30px"">
					<?php
								break;
								case "Nao gosto de ouvir musica":?>
							<img src = "<?= PATH.'resources/'?>pref-music-no.png" width="30px"">
					<?php
								break;
								case "Adoro animais":?>
							<img src = "<?= PATH.'resources/'?>pref-pet-yes.png" width="30px"">
					<?php
								break;
								case "Nao gosto de animais": ?>
							<img src = "<?= PATH.'resources/'?>pref-pet-no.png" width="30px"">
					<?php
								break;
								case "Gosto de conversar": ?>
							<img src = "<?= PATH.'resources/'?>pref-bla.png" width="30px"">
					<?php
								break;
								case "Nao gosto de conversar": ?>
							<img src = "<?= PATH.'resources/'?>pref-blablabla.png" width="30px"">
					<?php
								break;
							}
						} ?>
					
				</div>
				
				<div class = "trust">
					<p class="ratings">
						<img src = "<?= PATH.'resources/'?>star.png" width="10" height="10">
						<span class = "dark"><?= number_format($nota[0]['avg_nota'],1) ?></span> 
						<span class = "light"> - <a href ="<?= PATH_HREF ?>listaAvalia/email=<?= $item['email_dono'] ?>"><?= $nota[0]['count_nota'] ?> avaliações </a> </span>
					</p>
				</div>
				<?php if($item['email_dono'] != $_SESSION['email']){ ?>
				<div class = "icons">
					<a href= "<?= PATH_HREF ?>enviarMensagem/email=<?= $item['email_dono'] ?>"><img src = "<?= PATH.'resources/'?>msg.png" width="30" height="30"></a>
					<a href= "<?= PATH_HREF ?>enviarAvaliacao/email=<?= $item['email_dono'] ?>"><img src = "<?= PATH.'resources/'?>avaliar.png" width="30" height="30"></a>
				</div>
				
				<?php } ?>
			</div>
			<div class = "description-box">
				<h3 class = "day-time"><?= SiteHandler::formatData($item['data']) ?> às <?= $item['hora'] ?></h3>
				<h3 class = "from-to">
					<span class ="local"><?= $item['origem'] ?></span>
					<span class ="arrow">→</span>
					<span class = "local"><?= $item['destino'] ?></span>
				</h3>
				<h3 class = "description"><?= $item['descricao'] ?></h3>
				<span class = "bagagem">Bagagem: <?= $item['bagagem'] ?></span>
			</div>
			<div class = "offer">
				<div class = "price"><strong><span>R$<?= $item['preco'] ?></span></strong><span class="perUnit" dir = "rtl">por passageiro</span></div>
				<div class = "availability"><strong><?= $item['qtd_passageiros'] - $reserva->rows ?>&nbsp;</strong><span>lugares disponíveis</span></div>
				
				
				<?php
				if($item['email_dono'] == $_SESSION['email']){ ?>
					<div class = "reservado">Você criou a carona!</div>
				<?php
				}
				else {						
					if ($reserva->rows >= 0){
						$flag = false;
						for($i = 0; $i < $reserva->rows; $i++){
							if ($res[$i]['email_passageiro'] == $_SESSION['email']){ ?>
								<div class = "reservado">Você já reservou!</div>
				<?php
								$flag = true;
							}
						}
						if ($flag == false){
						if ($reserva->rows >= $item['qtd_passageiros']){ ?>
							<div class = "reservado">Carona lotada!</div>	
				<?php
						}
						else{ ?>
							<div class = "enter"><a href="<?= PATH_HREF ?>action/reserva/<?= $item['id'] ?>/<?= $_SESSION['email'] ?>">Ocupar lugar</a></div>
				<?php
						}
						}
					}
				} ?>
		
				
				
			</div>
		</article>
		<?php
		}
		?>
	</div>
