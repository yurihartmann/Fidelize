<?php
require_once "site.php";

$nome = $_POST['nome'];	
$email = $_POST['email'];
$descricao = $_POST['mensagem'];
$tipo = $_POST['tipo'];

$sqlSuporte = "INSERT INTO fidelizar VALUES (DEFAULT, '$nome', '$email', '$descricao' , '$tipo');";
$querySuporte = mysqli_query($conexao, $sqlSuporte);

if ($querySuporte) {
	echo true;
} else
echo false;