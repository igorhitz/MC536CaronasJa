<?php
	class Mensagem extends DBOp {

		public $email_destinatario;
		
		public $email_remetente;
		
		public $conteudo;

		public $status;
		
		public $rows;

		public static $query;

		public static function tableName() {
			return 'mensagem';
		}

		public static function getFields() {
			return 'm.id, m.email_destinatario, m.email_remetente, m.conteudo, m.status, m.data';
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
				$query = "INSERT INTO ".self::tableName()." (`email_destinatario`, `email_remetente`, `conteudo`) VALUES (?,?,?)";
				self::$query = "INSERT INTO ".self::tableName()." (`email_destinatario`, `email_remetente`, `conteudo`) VALUES ('".$this->email_destinatario."', '".$this->email_remetente."', '".$this->conteudo."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('sss', $this->email_destinatario, $this->email_remetente, $this->conteudo);
					$stmt->execute();
					if($stmt->affected_rows == 1) {
						return true;
					} else {
						parent::getAlert('Erro: '.$this->con->error."\n ".self::$query,'error');
						return false;
					}
				} else {
					parent::getAlert('Erro: '.$this->con->error."\n ".self::$query,'error');
					return false;
				}
			} else {
				parent::getAlert('error', 'Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.');
				return false;
			}
		}


		public function findByEmail($email_destinatario){
			
			if (parent::checkConnection()) {
				$query = "SELECT ".self::getFields().", u.foto as foto_remetente, u.nome as nome_remetente FROM ".self::tableName()." m JOIN usuario u ON u.email = m.email_remetente WHERE m.email_destinatario = ?";
				self::$query = "SELECT ".self::getFields().", u.foto as foto_remetente,  u.nome as nome_remetente FROM ".self::tableName()." m JOIN usuario u ON u.email = m.email_remetente WHERE m.email_destinatario = 'email_destinatario'";

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('s', $email_destinatario);
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($id, $email_destinatario, $email_remetente, $conteudo, $status, $data, $foto_remetente, $nome_remetente);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'id' => $id,
								'email_destinatario' => $email_destinatario,
								'email_remetente' => $email_remetente,
								'conteudo' => $conteudo,
								'status' => $status,
								'data' => $data,
								'foto_remetente' => $foto_remetente,
								'nome_remetente' => $nome_remetente
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
				parent::getMsg('Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.', 'error');
				return false;
			}
		}

		public function findById($id_mensagem){
			
			if (parent::checkConnection()) {
				$query = "SELECT ".self::getFields().", u.foto as foto_remetente, u.nome as nome_remetente FROM ".self::tableName()." m JOIN usuario u ON u.email = m.email_remetente WHERE m.id = ?";
				self::$query = "SELECT ".self::getFields().", u.foto as foto_remetente,  u.nome as nome_remetente FROM ".self::tableName()." m JOIN usuario u ON u.email = m.email_remetente WHERE m.id = $id_mensagem";
				

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('i', $id_mensagem);
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($id, $email_destinatario, $email_remetente, $conteudo, $status, $data, $foto_remetente, $nome_remetente);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'id' => $id,
								'email_destinatario' => $email_destinatario,
								'email_remetente' => $email_remetente,
								'conteudo' => $conteudo,
								'status' => $status,
								'data' => $data,
								'foto_remetente' => $foto_remetente,
								'nome_remetente' => $nome_remetente
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
				parent::getMsg('Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.', 'error');
				return false;
			}
		}
	}
?>