<?php

	class SiteController {

		public function index($page) {
			 if(!file_exists('protected/views/'.$page.'.php')) {
			 	//$this->redirect('404');
			 	echo '404';
			 } else {
			 	return 'protected/views/'.$page.'.php';
			 }
		}

	}

?>