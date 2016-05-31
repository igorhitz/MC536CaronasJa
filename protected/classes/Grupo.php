<?php
	class Grupo extends DBOp {

		public $nome;
		
		public $categoria;
		
		public $email_criador;

		private static $query;

		public static function tableName() {
			return 'grupo';
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
		 ** Metodo de insert para novo grupo
		 ** return @var integer ultimo id inserido
		**/
		public function insert() {
			
			if(parent::checkConnection()) {
				//query para insercao generica
				$query = "INSERT INTO ".self::tableName()."(`nome`, `categoria`, `email_criador`) VALUES (?,?,?)";
				self::$query = "INSERT INTO `grupo`(`nome`, `categoria`, `email_criador`) VALUES ('".$this->nome."', '".$this->categoria."', '".$this->email_criador."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('sss', $this->nome, $this->categoria, $this->email_criador);
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

		/* retorna os nomes de todos os grupos cadastrados no site, em ordem crescente */
		public function getNames($email) {
			
			if (parent::checkConnection()) {
				$query = "SELECT g.nome FROM ".self::tableName()." g WHERE g.email_criador = ? OR g.id = (SELECT p.id_grupo FROM participa p WHERE p.email = ?)";
				//self::$query = "SELECT nome FROM ".self::tableName()." WHERE 1";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('ss',$email, $email);
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($nome);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'nome_grupo' => $nome,
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