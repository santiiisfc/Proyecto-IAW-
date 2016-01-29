function insertarProductoCesta(idpro){
     var uri = './php/aniadircesta.php';
     var arraydatos={"idpro":idpro};

     //aler(arraydatos);
     $.ajax({
           type : "POST",
           url : uri,
           data : arraydatos,
           datatype: "json",
           success:function(data){
            // alert(data);
             $("#cesta").text(data);


           }
     });
    return false;
}
