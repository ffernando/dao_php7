<?php

// Registra mais de uma função como funções de autoload
// Incluindo as classes que estão em outra pasta
// Como função anônima
spl_autoload_register(function($classe_nome){

	// Verifica se o arquivo existe em um subdiretório
	$filename = "Class".DIRECTORY_SEPARATOR.$classe_nome.".php";

	// Se existir um arquivo .php, chame com o require_once
	if(file_exists($filename)){

		// Ignorando a segunda chamada do arquivo .php
		require_once($filename);
	}
});

?>