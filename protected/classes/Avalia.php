<?php
	class Avalia extends DBOp {

		public $email_avaliador;
		
		public $email_avaliado;
		
		public $data;
		
		public $nota;
		
		public $conteudo;
		
		public $rows;

		public static $query;

		public static function tableName() {
			return 'avalia';
		}
		
		public static function getFields() {
			return 'email_avaliador, email_avaliado, data, nota, conteudo';
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

		public function setAttributes($email_avaliador=null, $email_avaliado=null, $data=null, $nota=null, $conteudo=null) {
			if(!empty($email_avaliador)) {
				$this->email_avaliador = $email_avaliador;
			}
			if(!empty($email_avaliado)) {
				$this->email_avaliado = $email_avaliado;
			}
			if(!empty($data)) {
				$this->data = $data;
			}
			if(!empty($nota)) {
				$this->nota = $nota;
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
				$query = "INSERT INTO ".self::tableName()."(`email_avaliador`, `email_avaliado`, `data`, `nota`, `conteudo`) VALUES (?,?,?,?,?)";
				self::$query = "INSERT INTO `avalia`(`email_avaliador`, `email_avaliado`, `data`, `nota`, `conteudo`) VALUES ('".$this->email_avaliador."', '".$this->email_avaliado."', '".$this->data."', '".$this->nota."', '".$this->conteudo."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('sssis', $this->email_avaliador, $this->email_avaliado, $this->data, $this->nota, $this->conteudo);
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

		public function ranking() {
			if (parent::checkConnection()) {
				// query para fazer uma lista de usuarios e suas respectivas notas, em ordem decrescente de notas
				$query = "SELECT u.nome, AVG(a.nota) FROM ".self::tableName()." a JOIN usuario u ON a.email_avaliado = u.email GROUP BY a.email_avaliado ORDER BY AVG(a.nota) DESC";
				self::$query = "SELECT u.nome, AVG(a.nota) FROM ".self::tableName()." a JOIN usuario u ON a.email_avaliado = u.email GROUP BY a.email_avaliado ORDER BY AVG(a.nota) DESC";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($nome_avaliado, $media_nota);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'nome_avaliado' => $nome_avaliado,
								'media_nota' => $media_nota,
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