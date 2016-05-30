
<?php
	class Reserva extends DBOp {

		public $id_carona;
		
		public $email;

		private static $query;

		public static function tableName() {
			return 'reserva';
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

		public function setAttributes($id_carona=null, $email=null) {
			if(!empty($id_carona)) {
				$this->id_carona = $id_carona;
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
		 ** Metodo de insert para novo grupo
		 ** return @var integer ultimo id inserido
		**/
		public function insert() {
			
			if(parent::checkConnection()) {
				//query para insercao generica
				$query = "INSERT INTO ".self::tableName()."(`id_carona`, `email`) VALUES (?,?)";
				self::$query = "INSERT INTO ".self::tableName()."(`id_carona`, `email`) VALUES ('".$this->id_carona."', '".$this->email."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('ss', $this->id_carona, $this->email);
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
		 ** Metodo de select para Carona
		 ** return @var mixed tupla do banco
		**/
		public function findById($id_carona) {
			
			if(parent::checkConnection()) {
				//query para busca de carona por origem e destino, e data opcional
				$query = "SELECT id_carona, email FROM ".self::tableName(). " WHERE id_carona = ?";
				self::$query = "SELECT id_carona, email FROM ".self::tableName()." WHERE id_carona = $id_carona";

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					if($data == '') {
						$stmt->bind_param('i', $id_carona);
					} else {
						$stmt->bind_param('i', $id_carona);
					}
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
								'id' => $id,
								'email_passageiro' => $email
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