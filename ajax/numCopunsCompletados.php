<?php

require_once "conecao.php";

sleep(1);


$id_loja = $_POST['id_loja'];

$sql = "select count(distinct fk_cliente) as num from tokens 
        inner join cartaoFidelidade cF on tokens.fk_carimbo = cF.id
        inner join lojas l on cF.fk_loja = l.id where l.id = '$id_loja'";
$query = mysqli_query($conecao,$sql);
$result = mysqli_fetch_assoc($query);

echo $result['num'];
