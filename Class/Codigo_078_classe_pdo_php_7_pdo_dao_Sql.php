<?php

// Declaração da classe 
// Codigo_078_classe_pdo_php_7_pdo_dao_Sql 
// herdando da classe PDO (nativa)
// Para conversar com o banco de dados
class Codigo_078_classe_pdo_php_7_pdo_dao_Sql extends PDO{

	// Atributo com encapsulamento private
	private $connec;

	// Contrutor da classe Sql com encapsulamento public
	public function __construct(){

		// Instanciação da classe PDO com referência
		// connec, para conectar automaticamento
		// com o banco de dados
		$this->connec = new PDO("mysql:dbname=dbphp7; host=localhost", "root", "");
	}
	// Método setParames2 com encapsulamento 
	// private, recebendo o statement e os dados do array
	private function setParams2($statement, $parameters = array()){

		// Associando os parâmetros aos comandos sql
		foreach ($parameters as $key => $value) {
			// (:nome da variavel, valor da variavel)
			$this->setParams1($statement, $key, $value);
		}
	}
	// Método setParames1 com encapsulamento 
	// private, recebendo o statement, chave e valor
	private function setParams1($statement, $key, $value){
		// Espera os tipos de dados no bindParam
		// (:nome da variavel, valor da variavel)
		$statement->bindParam($key, $value);
	}
	// Método public query com parâmetros 
	public function query($rawQuery, $params = array()){

		// prepared statement, prepara a declaração para 
		// execução, o comando que é enviado para o banco 
		// de dados. Atributo $connec acessando método
		// prepare por herança de PDO
		$stmt = $this->connec->prepare($rawQuery);

		$this->setParams2($stmt, $params);
		// Envia o comando para o banco de dados
		// execute() tem o retorno dele mesmo
		$stmt->execute();
		// Retorna o objeto ($stmt)
		return $stmt;
	}
	// Método public select
	// Casting para retornar um array
	public function select($rawQuery, $params = array()):array{

		$stmt = $this->query($rawQuery, $params);

		// Retorna os dados associativos sem os índices
		// de cada linha do array com o método fetchAll
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>