<?php
	class Veiculo extends DBOp {
		
		public $modelo;
		
		public $conforto;
		
		public $categoria;
		
		public $cor;
		
		public $email_dono;

		private static $query;

		public static function tableName() {
			return 'veiculo';
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

		public function setAttributes($modelo=null, $conforto=null, $categoria=null, $cor=null, $email_dono=null) {
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

	}
?>