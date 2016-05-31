<?php
	class Mensagem extends DBOp {

		public $email_destinatario;
		
		public $email_remetente;
		
		public $data;
		
		public $conteudo;
		
		public $rows;

		public static $query;

		public static function tableName() {
			return 'mensagem m';
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

		public function setAttributes($email_destinatario=null, $email_remetente=null, $data=null, $conteudo=null) {
			if(!empty($email_destinatario)) {
				$this->email_destinatario = $email_destinatario;
			}
			if(!empty($email_remetente)) {
				$this->email_remetente = $email_remetente;
			}
			if(!empty($data)) {
				$this->data = $data;
			}
			if(!empty($conteudo)) {
				$this->conteudo = $conteudo;
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
				$query = "INSERT INTO ".self::tableName()."(`email_destinatario`, `email_remetente`, `data`, `conteudo`) VALUES (?,?,?,?)";
				self::$query = "INSERT INTO `mensagem`(`email_destinatario`, `email_remetente`, `data`, `conteudo`) VALUES ('".$this->email_destinatario."', '".$this->email_remetente."', '".$this->data."', '".$this->conteudo."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('ssss', $this->email_destinatario, $this->email_remetente, $this->data,  $this->conteudo);
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