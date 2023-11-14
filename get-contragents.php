<?php
include_once("init.php");
$sql = "select id,name,address from predp";
$result = mysqli_query($db_handler,$sql) or die("Ошибка запроса БД".mysqli_error($db_handler));
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $rows[] = $row;
}
echo json_encode($rows);
mysqli_close($db_handler);
?>