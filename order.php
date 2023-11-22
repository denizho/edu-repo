
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
    <link rel="icon" type="image/x-icon" href="./images/favicon.ico">
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
                              <input type='number' class='inputkol' min="1" max="<?=$row['kol']?>"name='kolord' value=1>
                              <input type="submit" id='btn-1' name="order" value="Добавить в корзину">       
                      </form>
                  </div>
                <?php }?>
              </div>
              <script>
                fetch("get-contragents.php")
                .then((response) => response.json())
                .then((data) => {
                    const selCont = document.getElementById("sel_contr"); 

                    sel_cat = document.createElement('select');
                    sel_cat.id = "sel_cat";
                    sel_cat.style.width = '100%';

                    data.forEach(row => {
                        const newOption = document.createElement("option");
                        newOption.value = row.id;
                        newOption.text = row.name;
                        sel_cat.appendChild(newOption);
                    });

                    selCont.appendChild(sel_cat); 
                  });
            
</script>
          <?php 
          $total=0;
           $output='';
           $output = '
           <table class="cart__order" id="cart_table">
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
                </tr>';
                  
                  $total= $total + $value['kolord'] * $value['price'];
                };
              $output .= '
              <tr>
                <td colspan="3" id="sel_contr"></td>
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
                $button=' <button type="button" id="btnzak" onclick="insertOrder()">Сделать заказ</button>';
                echo $button;
                };?>
            <script>
              function insertOrder() {
                let table = document.getElementById("cart_table");
                let rows = table.getElementsByTagName('tr');

                for (i = 1; i < rows.length - 1; i++) {
                  let cells = rows[i].getElementsByTagName('td');
                  var prodid = cells[0].textContent;       
                  var price = cells[5].textContent;
                  var kolord = cells[4].textContent;
                  let predp = document.getElementById("sel_cat").value;                  
                  let xml = new XMLHttpRequest();
                  xml.open('POST','insertprod.php', true);
                  xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                  xml.send('prodid=' + prodid + '&price=' + price + '&kolord=' + kolord + '&predp=' + predp);
                }
                alert('Заказ сделан');
              }
       
            </script>
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