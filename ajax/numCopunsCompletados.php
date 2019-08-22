<?php

require_once "conecao.php";

sleep(1);

session_start();
$id_loja =  $_SESSION['empresa_id'];

$sql = "select count(*) from tokens 
    inner join cartaoFidelidade cF on tokens.fk_carimbo = cF.id
    inner join lojas l on cF.fk_loja = l.id where l.id = '1'  group by fk_carimbo";
$query = mysqli_query($conecao,$sql);
$result = mysqli_fetch_assoc($query);

echo $result['count(*)'];
