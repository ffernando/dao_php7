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
			// Acessando o método inserirDados()
			$this->inserirDados($results[0]);
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
			// Acessando o método inserirDados()
			$this->inserirDados($results[0]);
		}else{

			throw new Exception("Login e senha inválidos.");
		}
	}
	// Método public para inserir dados, para ser 
	// usado em mais de um lugar, nos métodos loadByID e 
	// loginSenha (caso precise alterar, altera apenas nesse método inserirDados)
	public function inserirDados($dados){

		$this->setIdusuario($dados['id_usuario']);
		$this->setDescr_login($dados['descr_login']);
		$this->setDescr_senha($dados['descr_senha']);
		$this->setDatecadastro(new DateTime($dados['date_cadastro']));	
	}
	// Método public para inserir usuario
	public function inserirUsuario(){

		$sql = new Codigo_078_classe_pdo_php_7_pdo_dao_Sql();
		// Método select() com Stored Procedure da
		// tabela de usuarios para inserir, quando 
	    // a procedure executar por último vai chamar uma // função do banco de dados que retorna qual id 
	    // foi gerado na tabela e colocar dentro do objeto
		// $sql (referência do objeto)
		// CALL acessa (chama) a stored procedure do db
		$results = $sql->select("CALL sp_tb_usuarios_insert(:login, :senha)", array(

			":login"=>$this->getDescr_login(),
			":senha"=>$this->getDescr_senha()
		));
		// Carregando os dados do banco para o objeto
		//if(isset($results[0])){
		if(count($results) > 0){

			$this->inserirDados($results[0]);
		}
	}
	// Método (mágico) construtor
	// = "" se chamar em outra classe ok
	// se não chamar, alimenta com vazio para não dar 
	// erro e não se tornar obrigatório a passagem
	// em outra classe que chamar esse método
	public function __construct($login = "", $senha = ""){

		$this->setDescr_login($login);
		$this->setDescr_senha($senha);
	}
	// Método para atualizar usuario
	// Passando como parâmetros o que deseja alterar,
	// pega os setters dos atributos e passa na query
	public function upDados($login, $senha){

		$this->setDescr_login($login);
		$this->setDescr_senha($senha);

		$sql = new Codigo_078_classe_pdo_php_7_pdo_dao_Sql();

		$sql->query("UPDATE tb_usuarios SET descr_login = :login, descr_senha = :senha WHERE id_usuario = :id", array(

			":login"=>$this->getDescr_login(),
			":senha"=>$this->getDescr_senha(),
			":id"=>$this->getIdusuario()
		));
	}
	// Método para deletar usuarios
	public function deleteUsuario(){

		$sql = new Codigo_078_classe_pdo_php_7_pdo_dao_Sql();
		// Deletando do banco de dados
		$sql->query("DELETE FROM tb_usuarios WHERE id_usuario = :id", array(

			":id"=>$this->getIdusuario()
		));
		// Zerando o objeto
		$this->setIdusuario(0);
		$this->setDescr_login("");
		$this->setDescr_senha("");
		$this->setDatecadastro(new DateTime());
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