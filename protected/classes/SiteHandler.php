<?php
	class SiteHandler {

		public function getPage($page) {
			if(!file_exists('app/pages/'.$page.'.php')) {
			 	return false;
			 } else {
			 	return 'app/pages/'.$page.'.php';
			 }
		}


	}
?>