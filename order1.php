<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kros</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
        include("header.php");
    ?>
    <main>
    <div class="content">
       <div class="sneakers" id='sneakers'>
</div>
    </div>
    </main>
    <?php
        include("footer.php");
    ?>
</body>
<script>
    fetch('get-prod.php')
    .then(response => response.json())
    .then(data => {
    data.forEach(item => {
        const sneakers = document.getElementById("sneakers");
        const cardContainer = document.createElement('div');
        cardContainer.classList.add('sneaker');
        
        const img = document.createElement('img');
        img.src=item.img;
        img.classList.add('sneaker-image');
        cardContainer.appendChild(img);

        const kat = document.createElement('h3');
        kat.textContent = item.categ_name;
        cardContainer.appendChild(kat);

        const name = document.createElement('h3');
        name.textContent = item.prod_name;
        cardContainer.appendChild(name);

        const price = document.createElement('h3');
        price.textContent = new Intl.NumberFormat('ru-RU').format(item.price) + ' рублей';
        cardContainer.appendChild(price);
        
        const kol = document.createElement('h3');
        kol.textContent = 'В наличии: ' + new Intl.NumberFormat('ru-RU').format(item.kol) + ' шт.';
        cardContainer.appendChild(kol);

        const inputKol = document.createElement('input');
        inputKol.type = 'number';
        inputKol.classList.add('inputkol');
        inputKol.min = 1;
        inputKol.name = 'kolord';
        inputKol.value = 1;
        cardContainer.appendChild(inputKol);

        const submitBtn = document.createElement('input');
        submitBtn.type = 'submit';
        submitBtn.id = 'btn-1';
        submitBtn.name = 'order';
        submitBtn.value = 'Добавить в корзину';
        cardContainer.appendChild(submitBtn);
        sneakers.appendChild(cardContainer);
    });
  })
  // Обработчик события для каждой кнопки "Добавить в корзину"
document.addEventListener('click', function(event) {
  if(event.target && event.target.id == 'btn-1') {  // Проверяем, что была нажата кнопка с id "btn-1"
    const cardContainer = event.target.parentNode;  // Получаем родительский элемент кнопки (контейнер карточки с товаром)

    // Получаем данные о товаре из элементов карточки
    const img = cardContainer.querySelector('.sneaker-image').src;
    const categ_name = cardContainer.querySelector('h3:first-child').textContent;
    const prod_name = cardContainer.querySelector('h3:nth-child(2)').textContent;
    const price = parseInt(cardContainer.querySelector('h3:nth-child(3)').textContent.replace(/\D/g,'')); // Извлекаем только число из строки
    const kol = parseInt(cardContainer.querySelector('h3:nth-child(4)').textContent.replace(/\D/g,'')); // Извлекаем только число из строки
    const inputKol = parseInt(cardContainer.querySelector('.inputkol').value);

    // Создаем объект с данными о товаре
    const orderData = {
      img,
      categ_name,
      prod_name,
      price,
      kol: inputKol
    };

    // Отправляем данные на сервер для добавления в корзину
    fetch('add-to-cart.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(orderData)
    })
    .then(response => response.json())
    .then(data => {
      // Здесь можно обновить информацию о корзине на странице, если это необходимо
      console.log('Товар добавлен в корзину');
    })
    .catch(error => console.error(error));
  }
});

// Обработчик события для кнопки "Сделать заказ"
document.getElementById('order-btn').addEventListener('click', function(event) {
  // Отправляем данные на сервер для добавления в таблицу orders
  fetch('create-order.php', {
    method: 'POST'
  })
  .then(response => response.json())
  .then(data => {
    console.log('Заказ оформлен');
    
    // Здесь можно добавить дополнительные действия, например, очистить корзину или перенаправить пользователя на страницу заказа
  })
  .catch(error => console.error(error));
});


</script>
</html>