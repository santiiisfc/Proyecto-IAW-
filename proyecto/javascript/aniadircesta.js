function insertarProductoCesta(idprod){
     var uri = './php/aniadircesta.php';
     var arraydatos={"idpro":idpro};

     aler(arraydatos);
     $.ajax({
           type : "POST",
           url : uri,
           data : arraydatos,
           datatype: "json",
           success:function(data){
             $("#cesta").text(data);


           }
     });
    return false;
}
