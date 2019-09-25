<?php
require_once "site.php";

$nome = $_POST['nome'];	
$email = $_POST['email'];
$descricao = $_POST['mensagem'];
$segmento = $_POST['segmento'];

$sqlSuporte = "INSERT INTO fidelizar VALUES (DEFAULT, '$nome', '$email', '$descricao' , '$segmento');";
$querySuporte = mysqli_query($conexao, $sqlSuporte);

var_dump($sqlSuporte);

if ($querySuporte) {
	echo true;
} else
echo false;