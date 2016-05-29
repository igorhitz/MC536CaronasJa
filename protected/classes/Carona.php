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
			return 'carona c';
		}


		/**
		 ** Metodo que retorna uma string com os nomes de TODOS os campos da entidade correspondente no banco
		 ** return @var string
		**/
		public static function getFields() {
			return "c.email, c.id_grupo, c.origem, c.destino, c.descricao, c.data, c.hora, c.qtd_passageiros, c.bagagem, c.preco, u.nome";
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
				self::$query = "INSERT INTO `carona`(`email`, `id_grupo`, `origem`, `destino`, `descricao`, `data`, `hora`, `qtd_passageiros`, `bagagem`, `preco`) VALUES ('".$this->email."', '".$this->id_grupo."', '".$this->origem."', '".$this->destino."', '".$this->descricao."', '".$this->data."', '".$this->hora."', '".$this->qtd_passageiros."', '".$this->bagagem."', '".$this->preco."')";
				
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
				$query = "SELECT ".self::getFields()." FROM ".self::tableName(). " JOIN usuario u ON c.email = u.email";
				self::$query = "SELECT ".self::getFields()." FROM ".self::tableName();
				
				if($orderBy !== '') {
					$query .= " ORDER BY ".$orderBy;
					self::$query .= " ORDER BY ".$orderBy;
				}

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($email, $id_grupo, $origem, $destino, $descricao, $data, $hora, $qtd_passageiros, $bagagem, $preco, $nome);
					
					$rows = array();

					if($stmt->num_rows >= 1) {
						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
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
								'nome' => $nome
								);
						}
						return $rows;
					} else {
						return false;
					}
				} else {
					echo $this->con->error;
					echo self::$query;
					return false;
				}
			} else {
				parent::getMsg('error', 'Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.');
				return false;
			}
		}

	}
?>