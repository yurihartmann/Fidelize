<?php

require_once "conecao.php";

sleep(1);
session_start();
$id_loja =  $_SESSION['empresa_id'];

$sql = "select count(*) as num from cartaoFidelidade where fk_loja = '$id_loja'";
$query = mysqli_query($conecao,$sql);
$result = mysqli_fetch_assoc($query);

echo $result['num'];

