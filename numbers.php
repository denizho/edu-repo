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
        <div id="table_div" class="infosite"></div>
        <script>
fetch("get-orders.php")
.then((response) => response.json())
.then((data) => {
    let t_elem = document.createElement('table');
    t_elem.id="contr_table";
    t_elem.append(document.createElement('tr'));
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.append(document.createElement('th')); 
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.append(document.createElement('th'));
    t_elem.firstChild.firstChild.innerHTML="#";
    t_elem.firstChild.firstChild.nextSibling.innerHTML="Продукт ID";
    t_elem.firstChild.firstChild.nextSibling.nextSibling.innerHTML="Цена";
    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.innerHTML=" Количество";
    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML="Предприятие ID";
    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML="Дата";
    t_elem.firstChild.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML="Операторы";




    document.getElementById("table_div").append(t_elem);
    for(i=0; i< data.length;i++)  add_new_row(document.getElementById("contr_table"), data[i]);
    t_elem = document.createElement('table');
    t_elem.append(document.createElement('tr'));
 
    
})
.catch((ex) => console.log("parsing failed", ex));


function save(){
    this.classList.add('hidden_class');
    this.nextSibling.classList.add('hidden_class');
    this.nextSibling.nextSibling.classList.remove('hidden_class');
    this.nextSibling.nextSibling.nextSibling.classList.remove('hidden_class');

    contr_new = new Object();
    contr_new.id = this.parentElement.parentElement.firstChild.innerHTML;
    contr_new.product = this.parentElement.parentElement.firstChild.nextSibling.firstChild.value;;
    contr_new.price = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.value;
    contr_new.kolord = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.firstChild.value;
    contr_new.predp = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.value;
    contr_new.oper = "edit";
    
    fetch('edit-orders.php',{
        method: "POST",
    
        headers: 
        {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams(contr_new).toString(), // или body: 'oper=add&id='+contr_new.id+'&name='+contr_new.name+'&address='+contr_new.address,
    })
    .then(response => response.json())
    .then(result => {
         console.log(result);
        let product = this.parentElement.parentElement.firstChild.nextSibling.firstChild.value;
        this.parentElement.parentElement.firstChild.nextSibling.firstChild.remove();
        this.parentElement.parentElement.firstChild.nextSibling.innerHTML = product;
    
        let price = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.value;
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.remove();
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.innerHTML = price;

        let kolord = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.firstChild.value;
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.firstChild.remove();
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.innerHTML = kolord;

        let predp = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.value;
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.remove();
        this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML = predp;
    })
    .catch((ex) => console.log("failed!!! ", ex));

}

function cancel(){
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

function edit(){

    this.previousSibling.previousSibling.classList.remove('hidden_class')
    this.previousSibling.classList.remove('hidden_class')
    this.classList.add('hidden_class');
    this.nextSibling.classList.add('hidden_class');

    product = this.parentElement.parentElement.firstChild.nextSibling.innerHTML;
    this.parentElement.parentElement.firstChild.nextSibling.innerHTML="";
    input = document.createElement('input');
    input.style.width = '100%';
    input.value = product;
    this.parentElement.parentElement.firstChild.nextSibling.append(input);
    this.parentElement.parentElement.firstChild.nextSibling.old_value = product;


    price = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.innerHTML;
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.innerHTML = "";
    input = document.createElement('input');
    input.style.width='100%';
    input.value = price;
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.append(input);
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.old_value = price;

    kolord = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.innerHTML;
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.innerHTML = "";
    input = document.createElement('input');
    input.style.width='100%';
    input.value = kolord;
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.append(input);
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.old_value = kolord;

    predp = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML;
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.innerHTML = "";
    input = document.createElement('input');
    input.style.width='100%';
    input.value = predp;
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.append(input);
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.old_value = predp;

   
}

function del(){
    // alert("Del! "+"id= "+ this.parentElement.parentElement.firstChild.innerHTML);
    fetch('edit-contragents.php',{
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
        // console.log("failed!!! ", ex);
    });

}
function add(){
    // alert("Add!"+ " prepd_name=" + this.parentElement.parentElement.firstChild.nextSibling.firstChild.value
    //              + " address=" + this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.value);
                 
    contr_new = new Object();
    contr_new.id = 0;
    contr_new.product = this.parentElement.parentElement.firstChild.nextSibling.firstChild.value;
    contr_new.price = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.firstChild.value;
    contr_new.kolord = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.firstChild.value;
    contr_new.predp = this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.value;

    contr_new.oper = "add";

    fetch('edit-orders.php',{
        method: "POST",
        // headers: {
        //     // 'Accept': 'application/json',
        //     "Content-Type": "application/json"
        // },
        // body: JSON.stringify(contr_new),
        headers: 
        {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams(contr_new).toString(), // или body: 'oper=add&name='+contr_new.name+'&address='+contr_new.address,
    })
    .then(response => response.json())
    .then(result => {
        contr_new.id = result[0].id;
        delete contr_new.oper;
        add_new_row(document.getElementById("contr_table"),contr_new);
        // console.log(result);
    })
    .catch((ex) => console.log("failed!!! ", ex));

    this.parentElement.parentElement.firstChild.nextSibling.firstChild.value = "";
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.firstChild.value = "";
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.value = "";
    this.parentElement.parentElement.firstChild.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.firstChild.value = "";


}
function add_new_row(tab_elem, obj){
        
    tr_elem = document.createElement('tr');
    for(key in obj){
        td_elem = document.createElement('td');
        td_elem.innerHTML = obj[key];
        tr_elem.append(td_elem);
    }
    but_ok = document.createElement('button');
    but_ok.classList.add('hidden_class','line_button');
    but_ok.innerHTML="Сохранить";
    but_ok.addEventListener("click",save);

    but_cancel = document.createElement('button');
    but_cancel.classList.add('hidden_class','line_button');
    but_cancel.innerHTML="Отменить";
    but_cancel.addEventListener("click",cancel);

    but_edit = document.createElement('button');
    but_edit.classList.add('line_button');                   
    but_edit.innerHTML="Редактировать";
    but_edit.addEventListener("click",edit);

    but_del = document.createElement('button');
    but_del.classList.add('line_button');
    but_del.innerHTML="Удалить";
    but_del.addEventListener("click",del);

    td_elem = document.createElement('td');
    td_elem.append(but_ok);
    td_elem.append(but_cancel);
    td_elem.append(but_edit);
    td_elem.append(but_del);

    tr_elem.append(td_elem);

    tab_elem.append(tr_elem);
}
</script>
</div>
    </main>
    <?php
include("footer.php");
?>
  </body>
</html>