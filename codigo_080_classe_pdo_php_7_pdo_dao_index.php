<?php

// Ignorando a segunda chamada do arquivo de
// configuração (no mesmo diretório) com require_once
require_once("Codigo_079_classe_pdo_php_7_pdo_dao_config.php");
/*
// Instanciando a classe Usuario
// Acessando apenas 1 usuario
$descricao_usuario = new Codigo_081_classe_pdo_php_7_pdo_dao_Usuario();

$descricao_usuario->loadById(12);

echo $descricao_usuario;
*/
/*
// Acessando método estático com toda a lista de usuarios
$lista = Codigo_081_classe_pdo_php_7_pdo_dao_Usuario::getList();

// Pegando o array e transformando em json
echo json_encode($lista);
*/
/*
// Acessando método estático buscando
// por login na lista de usuarios
$busca = Codigo_081_classe_pdo_php_7_pdo_dao_Usuario::search("jo");

// Pegando o array e transformando em json
echo json_encode($busca);
*/

// Acessando método para buscar
// por login e senha
$user = new Codigo_081_classe_pdo_php_7_pdo_dao_Usuario();
$user->loginSenha("joaooo", "1234555");

echo $user;

/*
// Instanciação do objeto Codigo_078_classe_pdo_php_7_pdo_dao_Sql
$sql = new Codigo_078_classe_pdo_php_7_pdo_dao_Sql();

// Todos os usuarios selecionados com o comando select 
// como parâmetro no método select 
$usuarios = $sql->select("SELECT * FROM tb_usuarios");

// Pegando o array e transformando em json
echo json_encode($usuarios);
*/
?>