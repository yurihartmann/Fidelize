<?php
require_once "site.php";

$nome = $_POST['nome'];	
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];


$sqlSuporte = "INSERT INTO suporte VALUES (DEFAULT, '$nome', '$email', '$mensagem');";
$querySuporte = mysqli_query($conexao, $sqlSuporte);

if ($querySuporte) {
	echo true;
} else
echo false;





















?>