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

		public function getAlert($message, $type='error') {
			switch($type) {
				case 'error':
					echo '<div class="alert errorMsg">'.$message.'</div>';
					break;
			}
			
		}


	}
?>