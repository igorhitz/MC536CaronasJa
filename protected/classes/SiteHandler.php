<?php
	class SiteHandler {

		public function getPage($page) {
			if(!file_exists('app/pages/'.$page.'.php')) {
			 	return false;
			 } else {
			 	return 'app/pages/'.$page.'.php';
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