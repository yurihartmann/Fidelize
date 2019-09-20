<?php
require_once "site.php";

$sql = "SELECT count(*) FROM lojas";
$query = mysqli_query($conexao, $sql);
$resultado = mysqli_fetch_array($query);

echo ($resultado["count(*)"]);



?>