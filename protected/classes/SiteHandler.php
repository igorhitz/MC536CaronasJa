<?php
	class SiteHandler {

		/** 
		** @var home retorna o nome do arquivo de gome 
		**/
		private $home;

		function __construct() {
			$this->home = 'home';
		}

		public function getHome() {
			return 'app/pages/'.$this->home.'.php';
		}

		public function getPage($page) {
			$file = 'app/pages/'.$page.'.php';
			$errorFile = 'app/pages/'.'404.php';
			if(!file_exists($file)) {
			 	return $errorFile;
			 } else {
			 	return $file;
			 }
		}

		public function getAction($page) {
			$file = 'app/action/'.$page.'.php';
			$errorFile = 'app/pages/'.'404.php';
			if(!file_exists($file)) {
			 	return $errorFile;
			 } else {
			 	return $file;
			 }
		}

		public static function getAlert($message, $type='error') {
			switch($type) {
				case 'error':
					echo '<div class="alert errorMsg">'.$message.'</div>';
					break;

				case 'advise':
					echo '<div class="alert adviseMsg">'.$message.'</div>';
					break;
			}
			
		}

		public static function getNotification() {
			if(isset($_GET['stat']) && !empty($_GET['stat'])) {
				$stat = $_GET['stat'];
				switch($stat) {
					case 'campos-vazios':
						self::getAlert('Preencha os campos obrigatórios');
						break;
					case 'falha-login':
						self::getAlert('Usuário e/ou senha incorreto(s).');
						break;
				}
			}
		}

		public static function getQueryAlert($query) {
			self::getAlert("O comando executado foi:<br> <span class=\"query\">".$query . "</span>", 'advise');
		}


	}
?>