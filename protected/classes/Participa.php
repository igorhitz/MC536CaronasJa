<?php
	class Participa extends DBOp {

		public $id_grupo;
		
		public $email;
		
		public $rows;

		public static $query;

		public static function tableName() {
			return 'participa';
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

		public function setAttributes($id_grupo=null, $email=null) {
			if(!empty($id_grupo)) {
				$this->id_grupo = $id_grupo;
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
		 ** Metodo de insert para novo participante
		 ** return @var integer ultimo id inserido
		**/
		public function insert() {
			
			if(parent::checkConnection()) {
				//query para insercao generica
				$query = "INSERT INTO ".self::tableName()."(`id_grupo`, `email`) VALUES (?,?)";
				self::$query = "INSERT INTO ".self::tableName()."(`id_grupo`, `email`) VALUES ('".$this->id_grupo."', '".$this->email."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('is', $this->id_grupo, $this->email);
					$stmt->execute();
					$stmt->store_result();
					if($stmt->affected_rows == 1) {
						return true;
					} else {
						echo self::$query;
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


		/**
		 ** Metodo de select para Participa
		 ** return @var mixed tupla do banco
		**/
		public function findById($id_grupo) {
			
			if(parent::checkConnection()) {
				//query para busca de carona por origem e destino, e data opcional
				$query = "SELECT id_grupo, email FROM ".self::tableName(). " WHERE id_grupo = ?";
				self::$query = "SELECT id_grupo, email FROM ".self::tableName()." WHERE id_grupo = $id_grupo";

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('i', $id_grupo);
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($id, $email);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'id_grupo' => $id,
								'email' => $email
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
				parent::getMsg('error', 'Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.');
				return false;
			}
		}
		
		/**
		 ** Metodo de select para Participa
		 ** return @var mixed tupla do banco
		**/
		public function findByEmail($email) {
			
			if(parent::checkConnection()) {
				//query para busca de carona por origem e destino, e data opcional
				$query = "SELECT id_grupo, email FROM ".self::tableName(). " WHERE email = ?";
				self::$query = "SELECT id_grupo, email FROM ".self::tableName()." WHERE email = $email";

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('s', $email);
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($id, $email);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'id_grupo' => $id,
								'email' => $email
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
				parent::getMsg('error', 'Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.');
				return false;
			}
		}



	}
?>