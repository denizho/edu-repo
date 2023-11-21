<?php
include_once("init.php");
if(isset($_POST['id'])){$id = $_POST['id'];}else{$id=0;}
if(isset($_POST['product'])){$product = $_POST['product'];}else{$product="";}
if(isset($_POST['price'])){$price = $_POST['price'];}else{$price="";}
if(isset($_POST['kolord'])){$kolord = $_POST['kolord'];}else{$kolord="";}
if(isset($_POST['predp'])){$predp = $_POST['predp'];}else{$predp="";}
if(isset($_POST['oper'])){$oper = $_POST['oper'];}else {echo(json_encode("Переменная действия не установлена!!!")); return;}

switch($oper){
    case "edit":
        if(!$id) die(json_encode("Не установлен id для изменения счета!!!"));
        $sql = "update 
        set 
        product='$product', 
        price = '$price',
        kolord = '$kolord',
        predp = '$predp'
        where id = $id";
        if(!mysqli_query($db_handler,$sql)){
            header($_SERVER['SERVER_PROTOCOL'].'500 Internal Server Error',true,500);
            header('Content-Type: text/html; charset=utf-8');
            echo json_encode("Ошибка изменеия товара! ".mysqli_error($db_handler));
        } else echo(json_encode("Updated Id=$id"));
        break;
    case "del":
        if(!$id) die(json_encode("Не установлен id для удаления товара!!!"));
        $sql = "delete from orders where id = $id";
        if(!mysqli_query($db_handler,$sql)){
            header($_SERVER['SERVER_PROTOCOL'].'500 Internal Server Error',true,500);
            header('Content-Type: text/html; charset=utf-8');
            echo json_encode("Ошибка удаления товара! ".mysqli_error($db_handler));
        } else  echo(json_encode("Deleted Id=$id"));
        break;
}

mysqli_close($db_handler);
?>
