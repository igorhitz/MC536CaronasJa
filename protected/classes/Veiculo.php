<?php
	class Veiculo extends DBOp {
		
		public $id;

		public $modelo;
		
		public $conforto;
		
		public $categoria;
		
		public $cor;
	
		public $rows;
		
		public $email_dono;

		private static $query;

		public static function tableName() {
			return 'veiculo';
		}
		
		public static function getFields() {
			return 'v.id, v.modelo, v.conforto, v.categoria, v.cor';
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

		public function setAttributes($modelo=null, $conforto=null, $categoria=null, $cor=null, $email_dono=null, $id=null) {
			if(!empty($modelo)) {
				$this->modelo = $modelo;
			}
			if(!empty($conforto)) {
				$this->conforto = $conforto;
			}
			if(!empty($categoria)) {
				$this->categoria = $categoria;
			}
			if(!empty($cor)) {
				$this->cor = $cor;
			}
			if(!empty($email_dono)) {
				$this->email_dono = $email_dono;
			}
			if(!empty($id)) {
				$this->id = $id;
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
		 ** Metodo de insert para novo veiculo
		 ** return @var integer ultimo id inserido
		**/
		public function insert() {
			
			if(parent::checkConnection()) {
				//query para insercao generica
				$query = "INSERT INTO ".self::tableName()."(`modelo`, `conforto`, `categoria`, `cor`, `email_dono`) VALUES (?,?,?,?,?)";
				self::$query = "INSERT INTO `veiculo`(`modelo`, `conforto`, `categoria`, `cor`, `email_dono`) VALUES ('".$this->modelo."', '".$this->conforto."', '".$this->categoria."', '".$this->cor."', '".$this->email_dono."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('sssss', $this->modelo, $this->conforto, $this->categoria, $this->cor, $this->email_dono);
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

		
		public function update() {
			
			if(parent::checkConnection()){
				$query = "UPDATE ".self::tableName()." SET `modelo`=?, `conforto`=?, `categoria`=?, `cor`=? WHERE email_dono = ?";
				self::$query = "UPDATE ".self::tableName()." SET `modelo`='".$this->modelo."', `conforto`='".$this->conforto."', `categoria`='".$this->categoria."', `cor`='".$this->cor."' WHERE email_dono = '".$this->email_dono."'";
				
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('sssss', $this->modelo, $this->conforto, $this->categoria, $this->cor, $this->email_dono);
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
		
		public function findByEmail($email) {
			
			if (parent::checkConnection()) {
				//query para busca de carona por origem e destino, e data opcional
				$query = "SELECT ".self::getFields()." FROM ".self::tableName()." v WHERE email_dono = ?";
				self::$query = "SELECT ".self::getFields()." FROM ".self::tableName()." v WHERE email_dono = ".$email;

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('s', $email);
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($id, $modelo, $conforto, $categoria, $cor);
					
					$rows = array();

					if($stmt->num_rows >= 1) {
						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'id' => $id,
								'modelo' => $modelo,
								'conforto' => $conforto,
								'categoria' => $categoria,
								'cor' => $cor
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
				parent::getAlert('Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.', 'error');
				return false;
			}
		}


		public function delete() {
			
			if(parent::checkConnection()){
				$query = "DELETE FROM ".self::tableName()." WHERE `id`=?";
				self::$query = "DELETE FROM ".self::tableName()." WHERE `id`=$this->id";
				
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('i', $this->id);
					$stmt->execute();
					if($stmt->affected_rows == 1) {
						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				parent::getMsg('error', 'Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.');
				return false;
			}	
		}

	}
?>