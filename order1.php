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
    // fetch("get-prod.php")
    // .then((response) => response.json())
    // .then((data) => {
    // //sneakers
    //     const prods = document.createElement('div');
    //     prods.classList.add('sneakers');
    // //sneaker
    //     let card = document.createElemen('div');
    //     card.classList.add('sneaker');
    //     prods.appendChild(card);
    fetch('get-prod.php')
    .then(response => response.json())
    .then(data => {
    // Создание карточек на основе полученных данных
    data.forEach(item => {
        const sneakers = document.getElementById("sneakers");
      // Создание контейнера для карточки товара
        const cardContainer = document.createElement('div');
        cardContainer.classList.add('sneaker');
        // Создание элементов карточки: название, цена и наличие
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

        
      

          // Добавление карточки на страницу
        sneakers.appendChild(cardContainer);
    });
  })

</script>
</html>