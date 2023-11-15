<?php
include_once("init.php");
if(isset($_POST['id'])){$id = $_POST['id'];}else{$id=0;}
if(isset($_POST['name'])){$name = $_POST['name'];}else{$name="";}
if(isset($_POST['categ'])){$categ = $_POST['categ'];}else{$categ="";}
if(isset($_POST['price'])){$price = $_POST['price'];}else{$price="";}
if(isset($_POST['kol'])){$kol = $_POST['kol'];}else{$kol="";}
if(isset($_POST['img'])){$img = $_POST['img'];}else{$img="";}
if(isset($_POST['oper'])){$oper = $_POST['oper'];}else {echo(json_encode("Переменная действия не установлена!!!")); return;}

switch($oper){
    case "add":
        $sql = "call insertprod('$name',(select id from categ where kat='$categ'),$price, '$img',$kol)";
        if(!mysqli_query($db_handler,$sql)){
            header($_SERVER['SERVER_PROTOCOL'].'500 Internal Server Error',true,500);
            header('Content-Type: text/html; charset=utf-8');
            echo "Ошибка добавления товара!1 ".mysqli_error($db_handler);
        } else {
            $sql = "select p.id
            FROM prod p 
            LEFT JOIN sklad s ON p.id = s.prod_id 
            WHERE p.name = '$name' 
            AND p.categ_id = (SELECT c.id FROM categ c WHERE c.kat = '$categ') 
            AND p.price = $price
            AND s.kol = $kol 
            AND p.img = '$img';";
            if(!($result=mysqli_query($db_handler,$sql))){
                header($_SERVER['SERVER_PROTOCOL'].'500 Internal Server Error',true,500);
                header('Content-Type: text/html; charset=utf-8');
                echo json_encode("Ошибка добавления товара!2 ".mysqli_error($db_handler));
            } else {
                $rows = [];
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $rows[] = $row;
                }
                echo(json_encode($rows));
            }
        }
        break;
    case "edit":
        if(!$id) die(json_encode("Не установлен id для изменения счета!!!"));
        $sql = "call updateProductAndSklad($id,'$name',(select id from categ where kat='$categ'), $price, '$img', $kol)";
        if(!mysqli_query($db_handler,$sql)){
            header($_SERVER['SERVER_PROTOCOL'].'500 Internal Server Error',true,500);
            header('Content-Type: text/html; charset=utf-8');
            echo json_encode("Ошибка изменеия товара! ".mysqli_error($db_handler));
        } else echo(json_encode("Updated Id=$id"));
        break;
    case "del":
        if(!$id) die(json_encode("Не установлен id для удаления товара!!!"));
        $sql = "call delprod($id)";
        if(!mysqli_query($db_handler,$sql)){
            header($_SERVER['SERVER_PROTOCOL'].'500 Internal Server Error',true,500);
            header('Content-Type: text/html; charset=utf-8');
            echo json_encode("Ошибка удаления товара! ".mysqli_error($db_handler));
        } else  echo(json_encode("Deleted Id=$id"));
        break;
}

mysqli_close($db_handler);
?>
