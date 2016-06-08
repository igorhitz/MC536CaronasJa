<?php
	class UsuarioPreferencias extends DBOp {
		public $id;

		public $email;
		
		public $rows;

		public static $query;

		public static function tableName() {
			return 'usuario_preferencias';
		}

		public static function getFields() {
			return 'up.id, up.email';
		}

		public static function checkAttributes($attributes) {
			if(is_array($attributes)) {
				foreach($attributes as $item) {
					if(!isset($item) || empty($item)) {
						return false;
					}
				}
			} else {
				return false;
			}
			return true;
		}

		public function setAttributes($id=null, $email=null) {
			if(!empty($id)) {
				$this->id = $id;
			}
			if(!empty($email)) {
				$this->email = $email;
			}
		}

		/**
		 ** Metodo que retorna ultima query encriptada
		 ** return @var integer ultimo id inserido
		**/
		public static function encodeQuery() {
			return base64_encode(self::$query);
		}

		/**
		 ** Metodo que des(encripta) query
		 ** return @var integer ultimo id inserido
		**/
		public static function decodeQuery($encodedQuery) {
			return base64_decode($encodedQuery);
		}

		/**
		 ** Metodo que des(encripta) query
		 ** return @var integer ultimo id inserido
		**/
		public static function showQuery($query) {
			return parent::getQueryAlert(self::decodeQuery($query));
		}

		/**
		 ** Metodo de insert para nova avaliacao
		 ** return @var integer ultimo id inserido
		**/
		public function insert() {
			
			if(parent::checkConnection()) {
				//query para insercao generica
				$query = "INSERT INTO ".self::tableName()." (`id`,`email`) VALUES (?,?)";
				self::$query = "INSERT INTO `usuario_preferencias`(`id`, `email`) VALUES ('".$this->id."', '".$this->email."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('ss', $this->id, $this->email);
					$stmt->execute();
					if($stmt->affected_rows == 1) {
						return true;
					} else {
						parent::getAlert('Erro: '.$this->con->error."\n ".self::$query,'error');
						echo 'false1';
						exit;
						return false;
					}
				} else {
					parent::getAlert('Erro: '.$this->con->error."\n ".self::$query,'error');
					echo 'false2';
						exit;
					return false;
				}
			} else {
				parent::getAlert('error', 'Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.');
				echo 'false3';
						exit;
				return false;
			}
		}
		
		public function update() {
			if(parent::checkConnection()){
				$query = "UPDATE ".self::tableName()." SET `descricao`=?";
				self::$query = "UPDATE ".self::tableName()." SET `descricao`='".$this->descricao."'";
				
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('s', $this->descricao);
					$stmt->execute();
					return true;
				} else {
					return false;
				}
			} else {
				parent::getMsg('error', 'Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.');
				return false;
			}	
		}
		
		public function selectAll(){
			
			if (parent::checkConnection()) {
				$query = "SELECT id, descricao FROM ".self::tableName();
				self::$query = "SELECT id, descricao FROM ".self::tableName();

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($id, $descricao);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'id' => $id,
								'descricao' => $descricao
								);
						}
						return $rows;
					} else {
						$this->rows = 0;
						return $rows;
					}
				} else {
					return false;
				}
			} else {
				parent::getMsg('Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.', 'error');
				return false;
			}
		}
	}
?>