<?php


define('LOCAL', 'localhost');
define('USER',  'root');
define('PASS',  '');
define('DB', 'fidelize_master');

$conexao = mysqli_connect(LOCAL, USER, PASS, DB) or die ("Erro na conexao com o servidor.");



?>