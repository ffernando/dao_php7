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
/*
// Acessando método para buscar
// por login e senha
$user = new Codigo_081_classe_pdo_php_7_pdo_dao_Usuario();
$user->loginSenha("joaooo", "1234555");

echo $user;
*/
/*
// Inserindo novo usuario (parâmetros do construtor)
$aluno = new Codigo_081_classe_pdo_php_7_pdo_dao_Usuario("aluno", "1234567");

$aluno->inserirUsuario();

// Mostra com toString e json do método construtor da 
// classe instanciada (Usuario), e mostra na
// tela com o id_usuario e date_cadastro via procedure
// do banco de dados para o objeto (referência do objeto)
echo $aluno;
*/
/*
// Instanciação do objeto Codigo_081_classe_pdo_php_7_pdo_dao_Usuario();
// Alterando usuario (update)
$usuario = new Codigo_081_classe_pdo_php_7_pdo_dao_Usuario();

$usuario->loadById(18);

$usuario->upDados("professor", "543634");

echo $usuario;
*/

// Instanciação do objeto (Usuario)
// Deletando usuario (delete)
$usuario = new Codigo_081_classe_pdo_php_7_pdo_dao_Usuario();
// Acessando o id do usuario
$usuario->loadById(16);
// Deletando usuario acessado pelo id
$usuario->deleteUsuario();

echo $usuario;

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