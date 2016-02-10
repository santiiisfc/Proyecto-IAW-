function insertarProductoCesta(idpro){
 var uri = './php/aniadircesta.php';
 var arraydatos={"idpro":idpro};

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
