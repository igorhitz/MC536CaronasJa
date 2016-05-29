<?php
	class Grupo extends DBOp {

		public $nome;
		
		public $categoria;
		
		public $email_criador;

		private static $query;

		public static function tableName() {
			return 'grupo';
		}

		public function checkAttributes($attributes) {
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

		public function setAttributes($nome=null, $categoria=null, $email_criador=null) {
			if(!empty($nome)) {
				$this->nome = $nome;
			}
			if(!empty($categoria)) {
				$this->categoria = $categoria;
			}
			if(!empty($email_criador)) {
				$this->email_criador = $email_criador;
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
		 ** Metodo de insert para novo usuario
		 ** return @var integer ultimo id inserido
		**/
		public function insert() {
			
			if(parent::checkConnection()) {
				//query para insercao generica
				$query = "INSERT INTO ".self::tableName()."(`nome`, `categoria`, `email_criador`) VALUES (?,?,?)";
				self::$query = "INSERT INTO `grupo`(`id`, `nome`, `categoria`, `email_criador`) VALUES ('".$this->nome."', '".$this->categoria."', '".$this->email_criador."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('ssssss', $this->nome, $this->categoria, $this->email_criador);
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