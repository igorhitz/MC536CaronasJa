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
		
		public $qtd_local;

		public $rows;

		public static $query;

		public static function tableName() {
			return 'carona';
		}


		/**
		 ** Metodo que retorna uma string com os nomes de TODOS os campos da entidade correspondente no banco
		 ** return @var string
		**/
		public static function getFields() {
			return "c.id, c.email, c.id_grupo, c.origem, c.destino, c.descricao, c.data, c.hora, c.qtd_passageiros, c.bagagem, c.preco, u.nome, u.nascimento, u.foto, v.modelo, m.marca";
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
		 ** return @var boolean true se inserido corretamente
		**/
		public function insert() {
			
			if(parent::checkConnection()) {
				//query para insercao generica
				$query = "INSERT INTO ".self::tableName()."(`email`, `id_grupo`, `origem`, `destino`, `descricao`, `data`, `hora`, `qtd_passageiros`, `bagagem`, `preco`) VALUES (?,?,?,?,?,?,?,?,?,?)";
				self::$query = "INSERT INTO ".self::tableName()."(`email`, `id_grupo`, `origem`, `destino`, `descricao`, `data`, `hora`, `qtd_passageiros`, `bagagem`, `preco`) VALUES ('".$this->email."', '".$this->id_grupo."', '".$this->origem."', '".$this->destino."', '".$this->descricao."', '".$this->data."', '".$this->hora."', '".$this->qtd_passageiros."', '".$this->bagagem."', '".$this->preco."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('sisssssiss', $this->email, $this->id_grupo, $this->origem, $this->destino, $this->descricao, $this->data, $this->hora, $this->qtd_passageiros, $this->bagagem, $this->preco);
					$stmt->execute();
					if($stmt->affected_rows == 1) {
						return true;
					} else {
						parent::getAlert('error', 'Falha ao realizar essa operação.');
						return false;
					}
				} else {
					return false;
				}
			} else {
				parent::getAlert('error', 'Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.');
				return false;
			}
		}

		/**
		 ** Metodo de select para Caronas
		 ** return @var mixed tupla do banco
		**/
		public function selectAll($orderBy='') {
			
			if(parent::checkConnection()) {
				//query para insercao generica
				
				$query = "SELECT ".self::getFields()." FROM ".self::tableName(). " c JOIN usuario u ON c.email = u.email JOIN veiculo v ON v.email_dono = c.email JOIN info_modelo m ON v.modelo = m.modelo GROUP BY c.id";
				self::$query = "SELECT ".self::getFields()." FROM ".self::tableName(). " c JOIN usuario u ON c.email = u.email JOIN veiculo v ON v.email_dono = c.email JOIN info_modelo m ON v.modelo = m.modelo GROUP BY c.id";
				
				if($orderBy !== '') {
					$query .= " ORDER BY ".$orderBy;
					self::$query .= " ORDER BY ".$orderBy;
				}
	
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($id, $email, $id_grupo, $origem, $destino, $descricao, $data, $hora, $qtd_passageiros, $bagagem, $preco, $nome, $nascimento, $foto, $modelo, $marca);
					
					$rows = array();
					if($stmt->num_rows >= 1) {

						//salva o numero de linhas
						$this->rows = $stmt->num_rows;
						
						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'id' => $id,
								'email_dono' => $email,
								'id_grupo' => $id_grupo,
								'origem' => $origem,
								'destino' => $destino,
								'descricao' => $descricao,
								'data' => $data,
								'hora' => $hora,
								'qtd_passageiros' => $qtd_passageiros,
								'bagagem' => $bagagem,
								'preco' => $preco,
								'nome' => $nome,
								'nascimento' => $nascimento,
								'foto' => $foto,
								'modelo' => $modelo,
								'marca' => $marca
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


		/**
		 ** Metodo de select para Caronas
		 ** return @var mixed tupla do banco
		**/
		public function findByFilter($origem, $destino, $data='') {
			
			if(parent::checkConnection()) {
				//query para busca de carona por origem e destino, e data opcional
				$query = "SELECT ".self::getFields()." FROM ".self::tableName(). " c JOIN usuario u ON c.email = u.email JOIN veiculo v ON v.email_dono = u.email JOIN info_modelo m ON v.modelo = m.modelo WHERE origem = ? && destino = ?";
				self::$query = "SELECT ".self::getFields()." FROM ".self::tableName()." c JOIN usuario u ON c.email = u.email JOIN veiculo v ON v.email_dono = u.email JOIN info_modelo m ON v.modelo = m.modelo WHERE origem = '$origem' && destino = '$destino'";
				
				if($data !== '') {
					$query .= " AND data = ? ";
					self::$query .= " AND data = '$data'";
				}

				$query .= " GROUP BY c.id";
				self::$query .= " GROUP BY c.id";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					if($data == '') {
						$stmt->bind_param('ss', $origem, $destino);
					} else {
						$stmt->bind_param('sss', $origem, $destino, $data);
					}
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($id, $email, $id_grupo, $origem, $destino, $descricao, $data, $hora, $qtd_passageiros, $bagagem, $preco, $nome, $nascimento, $foto, $modelo, $marca);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'id' => $id,
								'email_dono' => $email,
								'id_grupo' => $id_grupo,
								'origem' => $origem,
								'destino' => $destino,
								'descricao' => $descricao,
								'data' => $data,
								'hora' => $hora,
								'qtd_passageiros' => $qtd_passageiros,
								'bagagem' => $bagagem,
								'preco' => $preco,
								'nome' => $nome,
								'nascimento' => $nascimento,
								'foto' => $foto,
								'modelo' => $modelo,
								'marca' => $marca,
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
		
			public function findByGrupo($id) {
			
			if(parent::checkConnection()) {
				//query para busca de carona por origem e destino, e data opcional
				$query = "SELECT ".self::getFields()." FROM ".self::tableName(). " c JOIN usuario u ON c.email = u.email JOIN veiculo v ON v.email_dono = u.email JOIN info_modelo m ON v.modelo = m.modelo WHERE id_grupo = ?";
				self::$query = "SELECT ".self::getFields()." FROM ".self::tableName()." c JOIN usuario u ON c.email = u.email JOIN veiculo v ON v.email_dono = u.email JOIN info_modelo m ON v.modelo = m.modelo WHERE id_grupo = '$id'";
				
				$query .= " GROUP BY c.id";
				self::$query .= " GROUP BY c.id";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('i', $id);
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($id, $email, $id_grupo, $origem, $destino, $descricao, $data, $hora, $qtd_passageiros, $bagagem, $preco, $nome, $nascimento, $foto, $modelo, $marca);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'id' => $id,
								'email_dono' => $email,
								'id_grupo' => $id_grupo,
								'origem' => $origem,
								'destino' => $destino,
								'descricao' => $descricao,
								'data' => $data,
								'hora' => $hora,
								'qtd_passageiros' => $qtd_passageiros,
								'bagagem' => $bagagem,
								'preco' => $preco,
								'nome' => $nome,
								'nascimento' => $nascimento,
								'foto' => $foto,
								'modelo' => $modelo,
								'marca' => $marca,
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

		/**
		 ** Metodo de select para Caronas
		 ** return @var mixed tupla do banco
		**/
		public function findByEmail($email_motorista) {
			
			if(parent::checkConnection()) {
				//query para busca de carona por origem e destino, e data opcional
				$query = "SELECT ".self::getFields()." FROM ".self::tableName(). " c JOIN usuario u ON c.email = u.email JOIN veiculo v ON v.email_dono = c.email JOIN info_modelo m ON v.modelo = m.modelo WHERE c.email = ? GROUP BY c.id ORDER BY c.data ASC";
				self::$query = "SELECT ".self::getFields()." FROM ".self::tableName()." c JOIN usuario u ON c.email = u.email JOIN veiculo v ON v.email_dono = c.email JOIN info_modelo m ON v.modelo = m.modelo WHERE c.email = '$email_motorista' GROUP BY c.id ORDER BY c.data ASC";

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('s', $email_motorista);
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($id, $email, $id_grupo, $origem, $destino, $descricao, $data, $hora, $qtd_passageiros, $bagagem, $preco, $nome, $nascimento, $foto, $modelo, $marca);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'id' => $id,
								'email_dono' => $email,
								'id_grupo' => $id_grupo,
								'origem' => $origem,
								'destino' => $destino,
								'descricao' => $descricao,
								'data' => $data,
								'hora' => $hora,
								'qtd_passageiros' => $qtd_passageiros,
								'bagagem' => $bagagem,
								'preco' => $preco,
								'nome' => $nome,
								'nascimento' => $nascimento,
								'foto' => $foto,
								'modelo' => $modelo,
								'marca' => $marca,
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

		/* Verifica de quais locais partem / chegam (origem / destino) mais usuários */
		public function moreUsers($campo, $limit='') {
			if(parent::checkConnection()) {
				
				$query = "SELECT ".$campo.", COUNT(".$campo.") FROM ".self::tableName(). " GROUP BY ".$campo." ORDER BY COUNT(".$campo.") DESC";
				self::$query = "SELECT ".$campo.", COUNT(".$campo.") FROM ".self::tableName(). " GROUP BY ".$campo." ORDER BY COUNT(".$campo.") DESC";
				
				if(!empty($limit)) {
					$query .= " LIMIT $limit";
					self::$query .= " LIMIT $limit";
				}

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($campo, $qtd_local);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'local' => $campo,
								'qtd' => $qtd_local,
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
				parent::getAlert('Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.','error');
				return false;
			}
		}
	}
?>