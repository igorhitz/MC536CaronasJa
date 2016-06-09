
<?php
	class Amizade extends DBOp {

		public $email_amigo1;
		
		public $email_amigo2;
		
		public $data_inicio;
				
		public $rows;

		public static $query;

		public static function tableName() {
			return 'amizade';
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

		public function setAttributes($email_amigo1=null, $email_amigo2=null) {
			if(!empty($email_amigo1)) {
				$this->email_amigo1 = $email_amigo1;
			}
			if(!empty($email_amigo2)) {
				$this->email_amigo2 = $email_amigo2;
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
				$query = "INSERT INTO ".self::tableName()."(`email_amigo1`, `email_amigo2`) VALUES (?,?)";
				self::$query = "INSERT INTO ".self::tableName()."(`email_amigo1`, `email_amigo2`) VALUES ('".$this->email_amigo1."', '".$this->email_amigo2."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('ss', $this->email_amigo1, $this->email_amigo2);
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
		 ** Metodo de select para Amizade
		 ** return @var mixed tupla do banco
		**/
		
		public function findByEmail($email_amigo1, $email_amigo2) {
			
			if(parent::checkConnection()) {
				//query para busca de carona por origem e destino, e data opcional
				$query = "SELECT a.email_amigo1, a.email_amigo2, a.data_inicio FROM ".self::tableName(). " a WHERE (a.email_amigo1 = ? AND a.email_amigo2 = ?) OR (a.email_amigo2 = ? AND a.email_amigo1 = ?)";
				self::$query = "SELECT a.email_amigo1, a.email_amigo2, a.data_inicio FROM ".self::tableName(). " a WHERE a.email_amigo1 = '$email_amigo1' AND a.email_amigo2 = '$email_amigo2'";


				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('ssss', $email_amigo1, $email_amigo2, $email_amigo1, $email_amigo2);
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($email_amigo1, $email_amigo2, $data_inicio);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'email_amigo1' => $email_amigo1,
								'email_amigo2' => $email_amigo2,
								'data_inico' => $data_inicio
								);
						}
						return $rows;
					} else {
						$this->rows = 0;
						return $rows;
					}
				} else {
					echo self::$query;
					return false;
				}
			} else {
				parent::getMsg('error', 'Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.');
				return false;
			}
		}
		

	}
?>