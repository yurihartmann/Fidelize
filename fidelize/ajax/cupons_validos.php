<?php 
require_once "site.php";

$sqlTokens = "SELECT count(*) FROM tokens";
$queryTokens = mysqli_query($conexao, $sqlTokens);
$result = mysqli_fetch_assoc($queryTokens);

echo $result["count(*)"];


?>