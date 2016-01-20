$(function(){
  $("#tableselect").on('change',function(){
    var dato = $('#busqueda').val();
    var sele = $("#tableselect").val();
      //alert(dato);


      var uri = './php/filtrarproducto.php';
      var arraydatos = {"tipo":sele,"nombre":dato};
      $.ajax({

          type:'POST',
          url:uri,
        //  data:'tipo'=+dato,
          data:arraydatos,
          datatype:"json",

          success:function(data){

            //alert(data);

            $("#tabla").html(data);

          }


      });

  });

  $("#busqueda").on('keyup',function(){
    var dato = $('#busqueda').val();
    var sele = $("#tableselect").val();
    //alert(dato);


  var uri = './php/filtrarproducto.php';
  var arraydatos = {"tipo":sele,"nombre":dato};
  $.ajax({

      type:'POST',
      url:uri,
    //  data:'tipo'=+dato,
      data:arraydatos,
      datatype:"json",

      success:function(data){

      //  alert(data);

        $("#tabla").html(data);

      }


  });

});

});


function borrar(idproducto){
  var parametros = {"idp":boton};

  $.ajax({
    data:parametros,
    url: './php/borrarproducto.php',
    type: 'post',
    datatype:'json',

    success: function(data){
      $("#tabla").html(data);
    }
  });

}
