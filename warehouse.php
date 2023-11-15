<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Кроссы и точка</title>
    <link href="style.css" rel="stylesheet" />
</head>
<body>
        <?php
        include("header.php");
        ?>
            <main>
                
                <div id="cat_div" style="width: 40%;" class="infosite"></div>
                <div id="prod_div" style="width: 80%;" class="infosite"></div>
                
            </main>
        <?php
        include("footer.php");
        ?>
</body>
<script>
    fetch("get-categories.php")
    .then((response) => response.json())
    .then((data) => {
    let t_elem = document.createElement('table');
    t_elem.id="cat_table";
    t_elem.append(document.createElement('tr'));
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.append(document.createElement('th'));

    t_elem.firstChild.firstChild.innerHTML="#";
    t_elem.firstChild.firstChild.nextSibling.innerHTML="Наименование";
    t_elem.firstChild.firstChild.nextSibling.nextSibling.innerHTML="Категория";

    document.getElementById("cat_div").append(t_elem);
    for(i=0; i< data.length;i++)  cat_add_new_row(document.getElementById("cat_table"), data[i]);


    //// add_table
    t_elem = document.createElement('table');
    t_elem.append(document.createElement('tr'));
    t_elem.firstChild.append(document.createElement('td'));
    t_elem.firstChild.append(document.createElement('td'));
    t_elem.firstChild.append(document.createElement('td'));
    t_elem.firstChild.firstChild.innerHTML = "+";
    t_elem.firstChild.firstChild.nextSibling.append(document.createElement('input'));
    t_elem.firstChild.firstChild.nextSibling.firstChild.style.width = '105px';
    but_add = document.createElement('button');
    but_add.classList.add('line_button')
    but_add.innerHTML="Добавить";
    but_add.style.width="318px";
    but_add.addEventListener("click",cat_add);
    t_elem.firstChild.firstChild.nextSibling.nextSibling.append(but_add);
    document.getElementById("cat_div").append(t_elem);
    })
    .catch((ex) => console.log("parsing failed", ex));


    fetch("get-prod.php")
    .then((response) => response.json())
    .then((data) => {
    let t_elem = document.createElement('table');
    t_elem.id="prod_table";
    t_elem.append(document.createElement('tr'));
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.append(document.createElement('th'));

    t_elem.firstChild.firstChild.innerHTML="#";
    t_elem.firstChild.firstChild.nextSibling.innerHTML="Наименование";
    t_elem.firstChild.firstChild.nextSibling.nextSibling.innerHTML="Категория";
    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.innerHTML="Цена";
    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML="Количество";
    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML="Картинка";

    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML="Операторы";
    
    document.getElementById("prod_div").append(t_elem);
    for(i=0; i< data.length;i++)  prod_add_new_row(document.getElementById("prod_table"), data[i]);

    t_elem = document.createElement('table');
    t_elem.append(document.createElement('tr'));
    t_elem.firstChild.append(document.createElement('td'));
    t_elem.firstChild.append(document.createElement('td'));
    t_elem.firstChild.append(document.createElement('td'));
    t_elem.firstChild.append(document.createElement('td'));
    t_elem.firstChild.append(document.createElement('td'));
    t_elem.firstChild.append(document.createElement('td'));
    t_elem.firstChild.append(document.createElement('td'));

    t_elem.firstChild.firstChild.innerHTML = "+";
    t_elem.firstChild.firstChild.style.width = "19px";

    t_elem.firstChild.firstChild.nextSibling.append(document.createElement('input'));
    t_elem.firstChild.firstChild.nextSibling.firstChild.style.width = '127px';

    fetch("get-categories.php")
    .then((response) => response.json())
    .then((data) => {
        sel_cat = document.createElement('select');
        sel_cat.id="sel_cat";
        sel_cat.style.width='100%';
        data.forEach(row =>{
            const newOption = document.createElement("option");
            newOption.value = row.id;
            newOption.text = row.kat;
            sel_cat.appendChild(newOption);
        })
        t_elem.firstChild.firstChild.nextSibling.nextSibling.append(sel_cat);
        t_elem.firstChild.firstChild.nextSibling.nextSibling.firstChild.style.width = '79px';
    })
    .catch((ex) => console.log("parsing failed", ex));

    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.append(document.createElement('input'));
    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.firstChild.style.width = '43px';

    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.append(document.createElement('input'));
    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.style.width = '88px';

    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.append(document.createElement('input'));
    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.style.width = '257px';


    but_add = document.createElement('button');
    but_add.classList.add('line_button')
    but_add.innerHTML="Добавить";
    but_add.addEventListener("click",prod_add);
    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.append(but_add);
    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.style.width= "312px";
    document.getElementById("prod_div").append(t_elem);
   
    })
    .catch((ex) => console.log("parsing failed", ex));

function prod_save(){
    this.classList.add('hidden_class');
    this.nextSibling.classList.add('hidden_class');
    this.nextSibling.nextSibling.classList.remove('hidden_class');
    this.nextSibling.nextSibling.nextSibling.classList.remove('hidden_class');

    prod_new = new Object();
    prod_new.id = this.parentElement.parentElement.firstChild.innerHTML;
    prod_new.name = this.parentElement.parentElement.firstChild.nextSibling.firstChild.value;
    prod_new.categ = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.options[this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.selectedIndex].text;
    prod_new.price = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.firstChild.value;
    prod_new.kol = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.value;
    prod_new.img = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.value;

    
    prod_new.oper = "edit";
    
    fetch('edit-prod.php',{
        method: "POST",
        headers: 
        {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams(prod_new).toString(), 
    })
    .then(response => response.json())
    .then(result => {
        console.log(result);
        let prod_name = this.parentElement.parentElement.firstChild.nextSibling.firstChild.value;
        this.parentElement.parentElement.firstChild.nextSibling.firstChild.remove();
        this.parentElement.parentElement.firstChild.nextSibling.innerHTML = prod_name;
    
        let categ = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.options[this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.selectedIndex].text;
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.remove();
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.innerHTML = categ;

        let price = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.firstChild.value;
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.firstChild.remove();
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.innerHTML = price;

        let kol = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.value;
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.remove();
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML = kol;

        let img = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.value;
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.remove();
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML = img;
    })
    .catch((ex) => console.log("failed!!! ", ex));

}

function prod_cancel(){
    this.previousSibling.classList.add('hidden_class');
    this.classList.add('hidden_class');
    this.nextSibling.classList.remove('hidden_class');
    this.nextSibling.nextSibling.classList.remove('hidden_class');

    this.parentElement.parentElement.firstChild.nextSibling.firstChild.remove();
    this.parentElement.parentElement.firstChild.nextSibling.innerHTML = this.parentElement.parentElement.firstChild.nextSibling.old_value;

    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.remove();
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.innerHTML = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.old_value;

    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.firstChild.remove();
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.innerHTML = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.old_value;

    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.remove();
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.old_value;

    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.remove();
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.old_value;
}

function prod_edit(){

    this.previousSibling.previousSibling.classList.remove('hidden_class')
    this.previousSibling.classList.remove('hidden_class')
    this.classList.add('hidden_class');
    this.nextSibling.classList.add('hidden_class');

    field1 = this.parentElement.parentElement.firstChild.nextSibling.innerHTML;
    this.parentElement.parentElement.firstChild.nextSibling.innerHTML="";
    input = document.createElement('input');
    input.style.width = '100%';
    input.value = field1;
    this.parentElement.parentElement.firstChild.nextSibling.append(input);
    this.parentElement.parentElement.firstChild.nextSibling.old_value = field1;
    
    field2 = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.innerHTML;
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.innerHTML = "";
    
    field3 = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.innerHTML;
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.innerHTML="";
    input2 = document.createElement('input');
    input2.style.width = '100%';
    input2.value = field3;
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.append(input2);
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.old_value = field3;

    field4 = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML;
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML="";
    input3 = document.createElement('input');
    input3.style.width = '100%';
    input3.value = field4;
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.append(input3);
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.old_value = field4;

    field5 = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML;
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML="";
    input4 = document.createElement('input');
    input4.style.width = '100%';
    input4.value = field5;
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.append(input4);
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.old_value = field5;
    
    fetch("get-categories.php")
    .then((response) => response.json())
    .then((data) => {
        let sel = document.createElement('select');
        sel.style.width='100%';
        data.forEach(row =>{
            const newOption = document.createElement("option");
            newOption.value = row.id;
            newOption.text = row.kat;
            sel.appendChild(newOption);
        })
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.append(sel);
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.old_value = field2;
    })
    .catch((ex) => console.log("parsing failed", ex));

}

function prod_del(){    
    fetch('edit-prod.php',{
        method: "POST",
        headers: 
        {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: 'oper=del&id='+this.parentElement.parentElement.firstChild.innerHTML,
    })
    .then(response => {
        if(response.status != 500) response.json();
        else {
            console.log("rejected!!!");
            return Promise.reject(response);
        }
    })
    .then(result => {
         console.log(result);
         this.parentElement.parentElement.remove();
    })
    .catch((ex) => {
        alert("failed!!! " + ex.statusText);
    });

}

function prod_add(){
    prod_new = new Object();
    prod_new.id = 0;
    prod_new.name = this.parentElement.parentElement.firstChild.nextSibling.firstChild.value;
    prod_new.categ = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.options[this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.selectedIndex].text;
    prod_new.price = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.firstChild.value;
    prod_new.kol = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.value;
    prod_new.img = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.value;
    prod_new.oper = "add";

    fetch('edit-prod.php',{
        method: "POST",
        headers: 
        {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams(prod_new).toString(), 
    })
    .then(response => response.json())
    .then(result => {
        prod_new.id = result[0].id;
        delete prod_new.oper;
        prod_add_new_row(document.getElementById("prod_table"),prod_new);
        console.log(result);
    })
    .catch((ex) => console.log("failed!!! ", ex));

    this.parentElement.parentElement.firstChild.nextSibling.firstChild.value = "";
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.value = "";
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.firstChild.value = "";
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.value = "";
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.value = "";
}



function cat_save(){
    this.classList.add('hidden_class');
    this.nextSibling.classList.add('hidden_class');
    this.nextSibling.nextSibling.classList.remove('hidden_class');
    this.nextSibling.nextSibling.nextSibling.classList.remove('hidden_class');

    cat_new = new Object();
    cat_new.id = this.parentElement.parentElement.firstChild.innerHTML;
    cat_new.name = this.parentElement.parentElement.firstChild.nextSibling.firstChild.value;;
    cat_new.oper = "edit";
    
    fetch('edit-categories.php',{
        method: "POST",
        headers: 
        {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams(cat_new).toString(), 
    })
    .then(response => response.json())
    .then(result => {
         console.log(result);
        let cat_name = this.parentElement.parentElement.firstChild.nextSibling.firstChild.value;
        this.parentElement.parentElement.firstChild.nextSibling.firstChild.remove();
        this.parentElement.parentElement.firstChild.nextSibling.innerHTML = cat_name;

        update_cat_list();

    })
    .catch((ex) => console.log("failed!!! ", ex));

}

function cat_cancel(){
    this.previousSibling.classList.add('hidden_class');
    this.classList.add('hidden_class');
    this.nextSibling.classList.remove('hidden_class');
    this.nextSibling.nextSibling.classList.remove('hidden_class');

    this.parentElement.parentElement.firstChild.nextSibling.firstChild.remove();
    this.parentElement.parentElement.firstChild.nextSibling.innerHTML = this.parentElement.parentElement.firstChild.nextSibling.old_value;
}

function cat_edit(){

    this.previousSibling.previousSibling.classList.remove('hidden_class')
    this.previousSibling.classList.remove('hidden_class')
    this.classList.add('hidden_class');
    this.nextSibling.classList.add('hidden_class');

    field1 = this.parentElement.parentElement.firstChild.nextSibling.innerHTML;
    this.parentElement.parentElement.firstChild.nextSibling.innerHTML="";
    input = document.createElement('input');
    input.style.width = '100%';
    input.value = field1;
    this.parentElement.parentElement.firstChild.nextSibling.append(input);
    this.parentElement.parentElement.firstChild.nextSibling.old_value = field1;
}

function cat_del(){
    fetch('edit-categories.php',{
        method: "POST",
        headers: 
        {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: 'oper=del&id='+this.parentElement.parentElement.firstChild.innerHTML,
    })
    .then(response => {
        if(response.status != 500) response.json();
        else {
            console.log("rejected!!!");
            return Promise.reject(response);
        }
    })
    .then(result => {
         console.log(result);
         this.parentElement.parentElement.remove();
         update_cat_list();
    })
    .catch((ex) => {
        alert("failed!!! " + ex.statusText);
        });

}

function cat_add(){
                 
    cat_new = new Object();
    cat_new.id = 0;
    cat_new.name = this.parentElement.parentElement.firstChild.nextSibling.firstChild.value;
    cat_new.oper = "add";

    fetch('edit-categories.php',{
        method: "POST",
        headers: 
        {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams(cat_new).toString(), 
    })
    .then(response => response.json())
    .then(result => {
        cat_new.id = result[0].id;
        delete cat_new.oper;
        cat_add_new_row(document.getElementById("cat_table"),cat_new);
        update_cat_list();
    })
    .catch((ex) => console.log("failed!!! ", ex));

    this.parentElement.parentElement.firstChild.nextSibling.firstChild.value = "";
}



function cat_add_new_row(tab_elem, obj){
        
    tr_elem = document.createElement('tr');
    for(key in obj){
        td_elem = document.createElement('td');
        td_elem.innerHTML = obj[key];
        tr_elem.append(td_elem);
    }
    but_ok = document.createElement('button');
    but_ok.classList.add('hidden_class','line_button');
    but_ok.innerHTML="Сохранить";
    but_ok.style="border-bottom: 1px solid rgb(0,0,0,0.4)"

    but_ok.addEventListener("click",cat_save);

    but_cancel = document.createElement('button');
    but_cancel.classList.add('hidden_class','line_button');
    but_cancel.innerHTML="Отменить";
    but_cancel.addEventListener("click",cat_cancel);

    but_edit = document.createElement('button');
    but_edit.classList.add('line_button');                   
    but_edit.innerHTML="Изменить";
    but_edit.style="border-bottom: 1px solid rgb(0,0,0,0.4)"
    but_edit.addEventListener("click",cat_edit);

    but_del = document.createElement('button');
    but_del.classList.add('line_button');
    but_del.innerHTML="Удалить";
    but_del.addEventListener("click",cat_del);

    td_elem = document.createElement('td');
    td_elem.append(but_ok);
    td_elem.append(but_cancel);
    td_elem.append(but_edit);
    td_elem.append(but_del);

    tr_elem.append(td_elem);

    tab_elem.append(tr_elem);
}


function prod_add_new_row(tab_elem, obj){
        
        tr_elem = document.createElement('tr');
        for(key in obj){
            td_elem = document.createElement('td');
            td_elem.innerHTML = obj[key];
            tr_elem.append(td_elem);
        }
        but_ok = document.createElement('button');
        but_ok.classList.add('hidden_class','line_button');
        but_ok.innerHTML="Сохранить";
        but_ok.style="border-bottom: 1px solid rgb(0,0,0,0.4)"
        but_ok.addEventListener("click",prod_save);
    
        but_cancel = document.createElement('button');
        but_cancel.classList.add('hidden_class','line_button');
        but_cancel.innerHTML="Отменить";
        but_cancel.addEventListener("click",prod_cancel);
    
        but_edit = document.createElement('button');
        but_edit.classList.add('line_button');                   
        but_edit.innerHTML="Изменить";
        but_edit.style="border-bottom: 1px solid rgb(0,0,0,0.4)"
        but_edit.addEventListener("click",prod_edit);
    
        but_del = document.createElement('button');
        but_del.classList.add('line_button');
        but_del.innerHTML="Удалить";
        but_del.addEventListener("click",prod_del);
    
        td_elem = document.createElement('td');
        td_elem.append(but_ok);
        td_elem.append(but_cancel);
        td_elem.append(but_edit);
        td_elem.append(but_del);
    
        tr_elem.append(td_elem);
    
        tab_elem.append(tr_elem);
    }

function update_cat_list(){
    fetch("get-categories.php")
        .then((response) => response.json())
        .then((data) => {
            let sel_cat = document.getElementById('sel_cat');
            for(elem in sel_cat.options) {
                sel_cat.remove(elem);
            }
            data.forEach(row =>{
                const newOption = document.createElement("option");
                newOption.value = row.id;
                newOption.text = row.kat;
                sel_cat.appendChild(newOption);
            })
        })
        .catch((ex) => console.log("parsing failed", ex));
}

function update_prod_list(){
    fetch("get-prod.php")
        .then((response) => response.json())
        .then((data) => {
            for(i=0; i< data.length;i++) 
             prod_add_new_row(document.getElementById("prod_table"), data[i]);
        })
        .catch((ex) => console.log("parsing failed", ex));
}
</script>
</html>