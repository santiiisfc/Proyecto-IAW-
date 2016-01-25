$(function(){
  $("#tableselect").on('change',function(){

    var dato = $('#busqueda').val();
    var sele = $("#tableselect").val();
    var uri = './php/filtrarproducto.php';
    var arraydatos = {"tipo":sele,"nombre":dato};
      $.ajax({
          type:'POST',
          url:uri,
          data:arraydatos,
          datatype:"json",
          success:function(data){
            $("#tabla").html(data);
          }
      });

  });

  $("#busqueda").on('keyup',function(){

    var dato = $('#busqueda').val();
    var sele = $("#tableselect").val();
    var uri = './php/filtrarproducto.php';
    var arraydatos = {"tipo":sele,"nombre":dato};
  $.ajax({
      type:'POST',
      url:uri,
      data:arraydatos,
      datatype:"json",
      success:function(data){
        $("#tabla").html(data);
      }
  });
});
});
