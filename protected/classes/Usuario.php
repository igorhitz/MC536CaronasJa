<?php
	class Usuario extends DBOp {

		public $email;
		
		public $senha;
		
		public $nome;
		
		public $genero;
		
		public $nascimento;

		public $foto;
		
		public $celular;
		
		public $rows;

		public static $query;

		public static function tableName() {
			return 'usuario';
		}
		
		public static function getFields() {
			return 'u.email, u.nome, u.genero, u.nascimento, u.foto, u.celular';
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

		public function setAttributes($email=null, $senha=null, $nome=null, $genero=null, $nascimento=null, $foto=null, $celular=null) {
			if(!empty($email)) {
				$this->email = $email;
			}
			if(!empty($senha)) {
				$this->senha = $senha;
			}
			if(!empty($nome)) {
				$this->nome = $nome;
			}
			if(!empty($genero)) {
				$this->genero = $genero;
			}
			if(!empty($nascimento)) {
				$this->nascimento = $nascimento;
			}
			if(!empty($foto)) {
				$this->foto = $foto;
			}
			if(!empty($celular)) {
				$this->celular = $celular;
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
		 ** Cria uma hash para senha em BCRYPT com 60 caracteres
		 ** return @var string senha encriptada
		**/
		public static function codificaSenha($senha) {
			$options = [
			    'cost' => 12,
			];
			return password_hash($senha, PASSWORD_DEFAULT, $options);
		}



		/**
		 ** Metodo de insert para novo usuario
		 ** return @var integer ultimo id inserido
		**/
		public function insert() {
			
			if(parent::checkConnection()) {
				//query para insercao generica
				$query = "INSERT INTO ".self::tableName()."(`email`, `senha`, `foto`, `nome`, `genero`, `nascimento`, `celular`) VALUES (?,?,?,?,?,?,?)";
				self::$query = "INSERT INTO `usuario`(`email`, `senha`, `foto`, `nome`, `genero`, `nascimento`, `celular`) VALUES ('".$this->email."', '".$this->senha."', '".$this->foto."', '".$this->nome."', '".$this->genero."', '".$this->nascimento."', '".$this->celular."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('sssssss', $this->email, $this->senha, $this->foto, $this->nome, $this->genero, $this->nascimento, $this->celular);
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
				$query = "UPDATE ".self::tableName()." SET `nome`=?, `genero`=?, `foto`=?, `nascimento`=?, `celular`=? WHERE email = ?";
				self::$query = "UPDATE ".self::tableName()." SET `nome`='".$this->nome."', `genero`='".$this->genero."',`foto`='".$this->foto."', `nascimento`='".$this->nascimento."', `celular`='".$this->celular."' WHERE email = '".$this->email."'";
				
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('ssssss', $this->nome, $this->genero, $this->foto, $this->nascimento, $this->celular, $this->email);
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


		public function selectAll(){
			
			if (parent::checkConnection()) {
				//query para busca de carona por origem e destino, e data opcional
				$query = "SELECT ".self::getFields()." FROM ".self::tableName()." u";
				self::$query = "SELECT ".self::getFields()." FROM ".self::tableName()." u";

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($email, $nome, $genero, $nascimento, $foto, $celular);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'email' => $email,
								'nome' => $nome,
								'genero' => $genero,
								'nascimento' => $nascimento,
								'foto' => $foto,
								'celular' => $celular
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
		
		public function findByNome($nome){
			
			if (parent::checkConnection()) {
				//query para busca de carona por origem e destino, e data opcional
				$query = "SELECT ".self::getFields()." FROM ".self::tableName()." u WHERE nome LIKE ?";
				self::$query = "SELECT ".self::getFields()." FROM ".self::tableName()." u WHERE nome LIKE '".$nome."%'";

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$likestring = $nome.'%';
					$stmt->bind_param('s', $likestring);
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($email, $nome, $genero, $nascimento, $foto, $celular);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'email' => $email,
								'nome' => $nome,
								'genero' => $genero,
								'nascimento' => $nascimento,
								'foto' => $foto,
								'celular' => $celular
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

		public function findByEmail($email){
			
			if (parent::checkConnection()) {
				//query para busca de carona por origem e destino, e data opcional
				$query = "SELECT ".self::getFields()." FROM ".self::tableName()." u WHERE email = ?";
				self::$query = "SELECT ".self::getFields()." FROM ".self::tableName()." u WHERE email = '$email'";

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('s', $email);
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($email, $nome, $genero, $nascimento, $foto, $celular);
					
					$rows = array();

					if($stmt->num_rows == 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows = array(
								'email' => $email,
								'nome' => $nome,
								'genero' => $genero,
								'nascimento' => $nascimento,
								'foto' => $foto,
								'celular' => $celular
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
		
		public function findByGrupo($id){
			
			if (parent::checkConnection()) {
				//query para busca de carona por origem e destino, e data opcional
				$query = "SELECT ".self::getFields()." FROM ".self::tableName()." u JOIN participa p ON u.email = p.email WHERE p.id_grupo = ?";
				self::$query = "SELECT ".self::getFields()." FROM ".self::tableName()." u JOIN participa p ON u.email = p.email WHERE p.id_grupo = '$id'";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('i', $id);
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($email, $nome, $genero, $nascimento, $foto, $celular);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'email' => $email,
								'nome' => $nome,
								'genero' => $genero,
								'nascimento' => $nascimento,
								'foto' => $foto,
								'celular' => $celular
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