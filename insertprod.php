<?php
include_once("init.php");
$prodid = $_POST['prodid'];
$price = $_POST['price'];
$kolord = $_POST['kolord'];
$predp = $_POST['predp'];
$sql = "insert into orders(product,price, kolord, predp_id) values ('$prodid','$price', '$kolord', '$predp')";
        if(!mysqli_query($db_handler,$sql)){
            header($_SERVER['SERVER_PROTOCOL'].'500 Internal Server Error',true,500);
            header('Content-Type: text/html; charset=utf-8');
            echo "Ошибка добавления категории! ".mysqli_error($db_handler);
        } else {
            $sql = "select id from orders where product='$prodid'";
            if(!($result=mysqli_query($db_handler,$sql))){
                header($_SERVER['SERVER_PROTOCOL'].'500 Internal Server Error',true,500);
                header('Content-Type: text/html; charset=utf-8');
                echo json_encode("Ошибка добавления категории! ".mysqli_error($db_handler));
            } else {
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $rows[] = $row;
                }
                echo(json_encode($rows));
            }
        }


?>