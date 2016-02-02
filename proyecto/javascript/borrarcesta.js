function borrarcesta(idpro){
     var uri = './php/borrarcesta.php';
     var arraydatos={"idpro":idpro};

     //alert(arraydatos["idpro"]);
     $.ajax({
           type : "POST",
           url : uri,
           data : arraydatos,
           datatype: "json",
           success:function(data){
            //alert(data);
             var array = JSON.parse(data);

             $('#dios').html(array[1]);
             $('#cesta').html(array[2]);


           }
     });
    return false;
}
