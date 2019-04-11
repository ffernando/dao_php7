<?php

// Declaração da classe Usuario Codigo_081_classe_pdo_php_7_pdo_dao_Usuario
class Codigo_081_classe_pdo_php_7_pdo_dao_Usuario{

	// Atributos com encapsulamento private
	private $id_usuario;
	private $descr_login;
	private $descr_senha;
	private $date_cadastro;

	// Método getter para o id
	public function getIdusuario(){

		return $this->id_usuario;
	}
	// Método setter para o id
	public function setIdusuario($value){
		
		$this->id_usuario = $value;
	}
	// Método getter para o login
	public function getDescr_login(){

		return $this->descr_login;
	}
	// Método setter para o login
	public function setDescr_login($value){
		
		$this->descr_login = $value;
	}
	// Método getter para a senha
	public function getDescr_senha(){

		return $this->descr_senha;
	}
	// Método setter para a senha
	public function setDescr_senha($value){
		
		$this->descr_senha = $value;
	}
	// Método getter para a data de cadastro
	public function getDatecadastro(){

		return $this->date_cadastro;
	}
	// Método setter para a data de cadastro
	public function setDatecadastro($value){
		
		$this->date_cadastro = $value;
	}
	// Método public para trazer o id
	// Carrega os dados do banco para o objeto
	public function loadById($id){

		$sql = new Codigo_078_classe_pdo_php_7_pdo_dao_Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE id_usuario = :id", array(
			// "chave"=>"valor"
			":id"=>$id
		));
		// Verificando se há mais de um índice na
		// posição 0 no banco de dados
		if(isset($results[0])){

			$row = $results[0];
			$this->setIdusuario($row['id_usuario']);
			$this->setDescr_login($row['descr_login']);
			$this->setDescr_senha($row['descr_senha']);
			$this->setDatecadastro(new DateTime($row['date_cadastro']));
		}
	}
	// Método public e estático para
	// listar todos os usuários da tabela
	public static function getList(){

		// Instanciação do objeto Codigo_078_classe_pdo_php_7_pdo_dao_Sql
		$sql = new Codigo_078_classe_pdo_php_7_pdo_dao_Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY descr_login");

	}
	// Método public e estático para
	// buscar um usuario
	public static function search($descr_login){

		// Instanciação do objeto Codigo_078_classe_pdo_php_7_pdo_dao_Sql
		$sql = new Codigo_078_classe_pdo_php_7_pdo_dao_Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE descr_login LIKE :busca ORDER BY descr_login", array(
			// "%". ."%" Evitando sql injection
			":busca"=>"%".$descr_login."%"
		));
	}
	// Método public para listar do banco
	// de dados por login e senha 
	public function loginSenha($descr_login, $descr_senha){

		$sql = new Codigo_078_classe_pdo_php_7_pdo_dao_Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE descr_login = :login AND descr_senha = :senha", array(
			// "chave"=>"valor"
			":login"=>$descr_login,
			":senha"=>$descr_senha
		));
		// Verificando se há mais de um índice na
		// posição 0 no banco de dados
		if(isset($results[0])){

			$row = $results[0];
			$this->setIdusuario($row['id_usuario']);
			$this->setDescr_login($row['descr_login']);
			$this->setDescr_senha($row['descr_senha']);
			$this->setDatecadastro(new DateTime($row['date_cadastro']));
		}else{

			throw new Exception("Login e senha inválidos.");
		}
	}

	// Visualizando os dados do banco de dados
	// com a execução do método mágico __toString()
	public function __toString(){

		// Pegando o array e transformando em json
		return json_encode(array(
			"id_usuario"=>$this->getIdusuario(),
			"descr_login"=>$this->getDescr_login(),
			"descr_senha"=>$this->getDescr_senha(),
			"date_cadastro"=>$this->getDatecadastro()->format("d/m/Y H:i:s")
		));
	}
}

?>