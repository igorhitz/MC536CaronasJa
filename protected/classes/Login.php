<?php
	class Login extends DBOp {

		public $email;
		
		public $senha;


		public function setAttributes($email, $senha) {
			if(!empty($email)) {
				$this->email = $email;
			}
			if(!empty($senha)) {
				$this->senha = $senha;
			}
		}

		public static function tableName() {
			return 'usuario';
		}

		/**
		 ** Classe para criacao de sessao
		 ** Return @var boolean true se encontrar o usuario
		**/
		public function findByEmailPass($email, $senha) {
			//se a conexao existir
			if(parent::checkConnection()) {

				$query = "SELECT COUNT(*) FROM ".self::tableName()." WHERE email = ? AND senha = ?";
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('ss', $this->email, $this->senha);
					$stmt->bind_result($qnt);
					$stmt->execute();
					$stmt->fetch();

					if($qnt == 1) {
						return true;
					} else {
						return false;
					}
					
				} else {
					parent::getAlert('Não foi possível preparar a operação.', 'error');
					return false;
				}
			} else {
				parent::getAlert('Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.', 'error');
				return false;
			}
		}

		private function createSession() {
			//se a conexao existir
			if($this->findByEmailPass($this->email, $this->senha)) {
				//usuario autenticado
				if(!isset($_SESSION)) session_start();
				$_SESSION['email'] = $this->email;
				$_SESSION['md5token'] = md5($this->email.$this->senha);
				$_SESSION['logged'] = true;
				return true;
			} else {
				return false;
			}
		}

		public function auth() {
			if($this->createSession()) {
				return true;
			} else {
				return false;
			}
		}

		public static function isLogged() {
			if(isset($_SESSION['logged'])) {
				if($_SESSION['logged']) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		public function logout() {
			if(isset($_SESSION)) {
				unset($_SESSION);
			}
			if(session_id() !== '') {
				session_destroy();
			}
		}
			

	}
?>