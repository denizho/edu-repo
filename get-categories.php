<?php
include_once("init.php");
$sql = "select id,kat from categ order by id";
$result = mysqli_query($db_handler,$sql) or die("Ошибка запроса БД".mysqli_error($db_handler));
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $rows[] = $row;
}
echo json_encode($rows);
mysqli_close($db_handler);
?>