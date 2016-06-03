
<?php
	class Amizade extends DBOp {

		public $email_amigo1;
		
		public $email_amigo2;
				
		public $rows;

		public static $query;

		public static function tableName() {
			return 'amizade';
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

		public function setAttributes($email_amigo1=null, $email_amigo2=null) {
			if(!empty($email_amigo1)) {
				$this->email_amigo1 = $email_amigo1;
			}
			if(!empty($email_amigo2)) {
				$this->email_amigo2 = $email_amigo2;
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
				$query = "INSERT INTO ".self::tableName()."(`email_amigo1`, `email_amigo2`) VALUES (?,?)";
				self::$query = "INSERT INTO ".self::tableName()."(`email_amigo1`, `email_amigo2`) VALUES ('".$this->email_amigo1."', '".$this->email_amigo2."')";
				
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('ss', $this->email_amigo1, $this->email_amigo2);
					$stmt->execute();
					$stmt->store_result();
					if($stmt->affected_rows == 1) {
						return true;
					} else {
						echo self::$query;
						return false;
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
		 ** Metodo de select para Reserva
		 ** return @var mixed tupla do banco
		**/
		/*
		public function findByEmail($email_amigo1) {
			
			if(parent::checkConnection()) {
				//query para busca de carona por origem e destino, e data opcional
				$query = "SELECT r.id_carona, r.email, c.origem, c.destino, c.descricao, c.data, c.hora, c.preco, c.qtd_passageiros, c.bagagem, u.nome FROM ".self::tableName(). " r JOIN carona c ON c.id = r.id_carona JOIN usuario u ON u.email = c.email WHERE r.email = ?";
				self::$query = "SELECT r.id_carona, r.email, c.origem, c.destino, c.descricao, c.data, c.hora, c.preco, c.qtd_passageiros, c.bagagem, u.nome FROM ".self::tableName()." r JOIN carona c ON c.id = r.id_carona JOIN usuario u ON u.email = c.email WHERE r.email = '$email_passageiro'";

				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('s', $email_passageiro);
					$stmt->execute();
					$stmt->store_result(); //armazena os dados de execução em memória
					$stmt->bind_result($id, $email, $origem, $destino, $descricao, $data, $hora, $preco, $qtd_passageiros, $bagagem, $motorista);
					
					$rows = array();

					if($stmt->num_rows >= 1) {

						//salva o numero de linhas 
						$this->rows = $stmt->num_rows;

						//para cada linha retornada
						while($row = $stmt->fetch()) {
							//adiciona no vetor rows[]
							$rows[] = array(
								'id' => $id,
								'email_passageiro' => $email,
								'origem' => $origem,
								'destino' => $destino,
								'descricao' => $descricao,
								'data' => $data,
								'hora' => $hora,
								'preco' => $preco,
								'qtd_passageiros' => $qtd_passageiros,
								'bagagem' => $bagagem,
								'motorista' => $motorista
								);
						}
						return $rows;
					} else {
						$this->rows = 0;
						return $rows;
					}
				} else {
					echo self::$query;
					return false;
				}
			} else {
				parent::getMsg('error', 'Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.');
				return false;
			}
		}
		*/

	}
?>