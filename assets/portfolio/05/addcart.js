function showProducts(str){
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              var foo = JSON.parse(xmlhttp.responseText);
              document.getElementById("left-label name").value = foo.name;
              document.getElementById("middle-label desc").value = foo.desc_product;
              document.getElementById("middle-label price").value = foo.price;
      				document.getElementById("middle-label qty").value = foo.quantity;
      				document.getElementById("middle-label sale").value = foo.sale_price;
            }
        };
        xmlhttp.open("GET","getID.php?productID="+str,true);
        xmlhttp.send();
    }
}


function newProduct(){
    var delete_button = document.getElementById("deleteButton");
    var checkbox = document.getElementById('checkbox1');

    if(checkbox1.checked){
        delete_button.style.visibility="hidden";
    }
    else{
        delete_button.style.visibility='visible';
    }
}
