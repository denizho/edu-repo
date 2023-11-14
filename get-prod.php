<?php
include_once("init.php");
$sql = "select p.id, p.name as prod_name, c.kat as categ_name,p.price,s.kol,p.img
from prod p 
left join categ c on p.categ_id = c.id
left join sklad s on p.id = s.prod_id";
$result = mysqli_query($db_handler,$sql) or die("Ошибка запроса БД".mysqli_error($db_handler));
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $rows[] = $row;
}
echo json_encode($rows);
mysqli_close($db_handler);
?>
