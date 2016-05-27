<?php
	class Usuario extends DBOp {

		public $email;
		
		public $senha;
		
		public $nome;
		
		public $genero;
		
		public $nascimento;
		
		public $celular;


		public function setAttributes($email, $senha, $nome, $genero, $nascimento, $celular) {
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
			if(!empty($celular)) {
				$this->celular = $celular;
			}
		}

		/**
		 ** Funcao de insert para novo usuario
		 ** return @var integer ultimo id inserido
		**/
		public function insert() {
			
			if(parent::checkConnection()) {
				//query para insercao generica
				$query = "INSERT INTO `usuario`(`email`, `senha`, `nome`, `genero`, `nascimento`, `celular`) VALUES (?,?,?,?,?,?)";
				//executa a query com prepared statement
				if($stmt = $this->con->prepare($query)) {
					$stmt->bind_param('ssssss', $this->email, $this->senha, $this->nome, $this->genero, $this->nascimento, $this->celular);
					$stmt->execute();
				}
				return $this->con->insert_id;
			} else {
				parent::getMsg('error', 'Não existe uma conexão com o banco. Inicialize uma antes de realizar essa operação.');
			}
		}

	}
?>