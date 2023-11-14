<?php error_reporting(0); ?>
<?php
session_start();
$connect = mysqli_connect('localhost','root','root','mydb');
if(isset($_POST["order"])){
  if(isset($_SESSION['car11'])){
      $session_array_id= array_column($_SESSION['car11'], 'id');
      if (!in_array($_GET['id'], $session_array_id)){
        $session_array = array(
          'id'=>$_GET['id'],
          "kat"=>$_POST['kat'],
          "name"=>$_POST['name'],
          "price"=>$_POST['price'],
          "kolord"=>$_POST['kolord'],
          "kol"=>$_POST['kol']);
          $_SESSION['car11'][] = $session_array;
      }
  }else{
    $session_array = array(
      'id'=>$_GET['id'],
      "kat"=>$_POST['kat'],
      "name"=>$_POST['name'],
      "price"=>$_POST['price'],
      "kolord"=>$_POST['kolord'],
      "kol"=>$_POST['kol']);
      $_SESSION['car11'][] = $session_array;
  }
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кроссы — и точка</title>
    <link rel="stylesheet" href="style.css"/>
  </head>
  <body>
    <?php
    include("header.php");
    ?>
    <main>
          <div class="content">
            <h1>Коллекция. {октябрь:2023}</H1>
            <h2>Есть в наличии:</h2>
            <?php
              $query = 'select * from prod
                        left join sklad on prod.id=sklad.prod_id
                        left join categ on prod.categ_id=categ.id
                        where sklad.kol>0';
              $result = mysqli_query($connect, $query);
            ?>
              <div class='sneakers'>
                <?php
                while ($row = mysqli_fetch_array($result)){?>
                  <div class='sneaker'>
                      <form method="post" action="order.php?id=<?=$row['id']?>">
                              <img src='<?= $row['img']?>' class='sneaker-image' alt='Обувь'/>
                              <h3><?= $row['kat']; ?></h3>
                              <h3><?= $row['name']; ?></h3>
                              <h3><?= number_format($row['price']);?> рублей</h3>
                              <h3>В наличии: <?= number_format($row['kol']); ?> шт.</h3><br>
                              <input type='hidden' name='kat' value='<?=$row['kat']?>'>
                              <input type='hidden' name='name' value='<?=$row['name']?>'>
                              <input type='hidden' name='price' value='<?=$row['price']?>'>
                              <input type='hidden' name='kol' value='<?=$row['kol']?>'>
                              <input type='number' class='inputkol' min="1" name='kolord' value=1>
                              <input type="submit" id='btn-1' name="order" value="Добавить в корзину">       
                      </form>
                  </div>
                <?php }?>
              </div>
          <?php 
          $total=0;
           $output='';
           $output = '
           <table class="cart__order">
            <tr>
              <th>Ид</th>
              <th>Фирма</th>
              <th>Модель</th>
              <th>Цена</th>
              <th>Количество</th>
              <th>Итог</th>
              <th>Действия</th>
            </tr>';           
              if(!empty($_SESSION['car11'])){
                foreach($_SESSION['car11'] as $key => $value ){
                  $output .= '
                <tr>
                  <td>'.$value["id"].'</td>
                  <td>'.$value["kat"].'</td>
                  <td>'.$value["name"].'</td>
                  <td>'.$value["price"].'</td>
                  <td>'.$value["kolord"].'</td>
                  <td>'.$value["price"]*$value["kolord"].'</td>
                  <td>
                      <a href="order.php?action=remove&id='.$value["id"].'">
                        <button id="delbtn">Удалить</button>
                      </a>
                  </td>
                </tr>
                  '
                  ;
                  
                  $total= $total + $value['kolord'] * $value['price'];
                };
              $output .= '
              <tr>
                <td colspan="3"></td>
                <td>Итог всего</td>
                <td>'.$total.'</td>
                <td>
                  <a href="order.php?action=clearall">
                  <button id="delallbtn">Удалить все</button>
                  </a>
                </td>
              </tr>
              </table>
              ';
                echo $output;
                $button=' <a href="order.php?action=clearall"><button id="btnzak" onclick="alert(`Заказ сделан`)">Сделать заказ</button></a>';
                echo $button;
                };?>
           
          <?php
            if (isset($_GET['action'])){
                if ($_GET['action'] == 'clearall'){
                  unset($_SESSION['car11']);
                }
                if($_GET['action'] == 'remove'){
                  foreach ($_SESSION['car11'] as $key => $value){
                    if ($value['id'] == $_GET['id']){
                      unset($_SESSION['car11'][$key]);
                    }
                  }

                }
            }
          ?>
      
        </div>
        </main>
        <?php
include("footer.php");
?> 
  </body>
</html>