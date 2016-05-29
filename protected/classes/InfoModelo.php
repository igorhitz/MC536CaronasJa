<?php
	class InfoModelo extends DBOp {

		public $modelo;
		
		public $marca;
		
		public $lugares;

		private static $query;

		public static function tableName() {
			return 'info_modelo';
		}


		/**
		 ** Metodo que retorna uma string com os nomes de TODOS os campos da entidade correspondente no banco
		 ** return @var integer ultimo id inserido
		**/
		public static function getFields() {
			return 'modelo, marca, lugares';
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

		public function setAttributes($modelo=null, $marca=null, $lugares=null) {
			if(!empty($modelo)) {
				$this->modelo = $modelo;
			}
			if(!empty($marca)) {
				$this->marca = $marca;
			}
			if(!empty($lugares)) {
				$this->lugares = $lugares;
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
		 ** Metodo de insert para novo info modelo do veiculo
		 ** return @var integer ultimo id inserido
		**/
		public function insert() {
			
			if(parent::checkConnection()) {
				//query para insercao generica
				$query = "INSERT INTO ".self::tableName()."(`modelo`, `marca`, `lugares`) VALUES (?,?,?)";
				self::$query = "INSERT INTO `info_modelo`(`modelo`, `marca`, `lugares`) VALUES ('".$this->modelo."', '".$this->marca."', ".$this->lugares.")";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('ssi', $this->modelo, $this->marca, $this->lugares);
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

		/**
		 ** Metodo de select para infoModelo
		 ** return @var mixed tupla do banco
		**/
		public function selectAll() {
			
			if(parent::checkConnection()) {
				//query para insercao generica
				$query = "SELECT ".self::getFields()." FROM ".self::tableName();
				self::$query = "SELECT * FROM ".self::tableName();
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($modelo, $marca, $lugares);
					
					$rows = array();
					
					if($stmt->num_rows >= 1) {
						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array('modelo' => $modelo, 'marca' => $marca, 'lugares' => $lugares);
						}
						return $rows;
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