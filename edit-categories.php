<?php
include_once("init.php");
if(isset($_POST['id'])){$id = $_POST['id'];}else{$id=0;}
if(isset($_POST['name'])){$name = $_POST['name'];}else{$name="";}
if(isset($_POST['oper'])){$oper = $_POST['oper'];}else {echo(json_encode("Переменная действия не установлена!!!")); return;}

switch($oper){
    case "add":
        $sql = "insert into categ (kat) values ('$name')";
        if(!mysqli_query($db_handler,$sql)){
            header($_SERVER['SERVER_PROTOCOL'].'500 Internal Server Error',true,500);
            header('Content-Type: text/html; charset=utf-8');
            echo "Ошибка добавления категории! ".mysqli_error($db_handler);
        } else {
            $sql = "select id from categ where kat ='$name'";
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
        break;
    case "edit":
        if(!$id) die(json_encode("Не установлен id для изменения категории!!!"));
        $sql = "update categ 
                set 
                    kat='$name'
                where id = $id";
        if(!mysqli_query($db_handler,$sql)){
            header($_SERVER['SERVER_PROTOCOL'].'500 Internal Server Error',true,500);
            header('Content-Type: text/html; charset=utf-8');
            echo json_encode("Ошибка изменеия категории! ".mysqli_error($db_handler));
        } else echo(json_encode("Updated Id=$id"));
        break;
    case "del":
        if(!$id) die(json_encode("Не установлен id для удаления категории!!!"));
        $sql = "delete from categ where id = $id";
        if(!mysqli_query($db_handler,$sql)){
            header($_SERVER['SERVER_PROTOCOL'].'500 Internal Server Error',true,500);
            header('Content-Type: text/html; charset=utf-8');
            echo json_encode("Ошибка удаления категории! ".mysqli_error($db_handler));
        } else  echo(json_encode("Deleted Id=$id"));
        break;
}

mysqli_close($db_handler);
?>
