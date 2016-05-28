<?php
	class Carona extends DBOp {

		public $email;
		
		public $id_grupo;
		
		public $origem;
		
		public $destino;
		
		public $descricao;
		
		public $data;
		
		public $hora;
		
		public $qtd_passageiros;
		
		public $bagagem;
		
		public $preco;

		private static $query;

		public static function tableName() {
			return 'carona';
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

		public function setAttributes($email=null, $id_grupo=null, $origem=null, $destino=null, $descricao=null, $data=null, $hora=null, $qtd_passageiros=null, $bagagem=null, $preco=null) {
			if(!empty($email)) {
				$this->email = $email;
			}
			if(!empty($id_grupo)) {
				$this->id_grupo = $id_grupo;
			}
			if(!empty($origem)) {
				$this->origem = $origem;
			}
			if(!empty($destino)) {
				$this->destino = $destino;
			}
			if(!empty($descricao)) {
				$this->descricao = $descricao;
			}
			if(!empty($data)) {
				$this->data = $data;
			}
			if(!empty($hora)){
				$this->hora = $hora;
			}
			if(!empty($qtd_passageiros)){
				$this->qtd_passageiros = $qtd_passageiros;
			}
			if(!empty($bagagem)){
				$this->bagagem = $bagagem;
			}
			if(!empty($preco)){
				$this->preco = $preco;
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
		 ** Metodo de insert para nova carona
		 ** return @var integer ultimo id inserido
		**/
		public function insert() {
			
			if(parent::checkConnection()) {
				//query para insercao generica
				$query = "INSERT INTO ".self::tableName()."(`email`, `id_grupo`, `origem`, `destino`, `descricao`, `data`, `hora`, `qtd_passageiros`, `bagagem`, `preco`) VALUES (?,?,?,?,?,?,?,?,?,?)";
				self::$query = "INSERT INTO `carona`(`email`, `id_grupo`, `origem`, `destino`, `descricao`, `data`, `hora`, `qtd_passageiros`, `bagagem`, `preco`) VALUES ('".$this->email."', '".$this->id_grupo."', '".$this->origem."', '".$this->destino."', '".$this->descricao."', '".$this->data."', '".$this->hora."', '".$this->qtd_passageiros."', '".$this->bagagem."', '".$this->preco."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('ssssss', $this->email, $this->id_grupo, $this->origem, $this->destino, $this->descricao, $this->data, $this->hora, $this->qtd_passageiros, $this->bagagem, $this->preco);
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