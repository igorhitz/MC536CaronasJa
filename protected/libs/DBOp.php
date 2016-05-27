<?php
	class DBOp extends SiteHandler {

		public $con;

		public function __construct($host=HOST, $user=USER, $pass=PASS, $db=DB) {
			$this->connect($host, $user, $pass, $db);
		}

		private function connect($host, $user, $pass, $db) {
			mysqli_report(MYSQLI_REPORT_STRICT);
			try {
				$this->con = new mysqli($host, $user, $pass, $db);
			} catch (Exception $e ) { 
				parent::getAlert('Falha na conexao. Verfique se os dados estao corretos.');
					
			}
		}

		public function checkConnection() {
			if($this->con->ping()) {
				return true;
			} else {
				return false;
			}
		}
	}
?>