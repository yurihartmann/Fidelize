<?php


define('LOCAL', 'mysql669.umbler.com:41890');
define('USER',  'fidelize');
define('PASS',  '1qaz2wsxentra21');
define('DB', 'fidelize_master');

$conexao = mysqli_connect(LOCAL, USER, PASS, DB) or die ("Erro na conexao com o servidor.");



?>