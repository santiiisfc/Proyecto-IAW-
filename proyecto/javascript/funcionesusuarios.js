$(function(){
  $("#tableusu").on('change',function(){

    var dato = $('#busquedausu').val();
    var sele = $("#tableusu").val();
    var uri = './php/filtrarusuario.php';
    var arraydatos = {"rol":sele,"nombre":dato};
    $.ajax({
      type:'POST',
      url:uri,
      data:arraydatos,
      datatype:"json",
      success:function(data){
        $("#tablausuario").html(data);
      }
    });

  });

  $("#busquedausu").on('keyup',function(){

    var dato = $('#busquedausu').val();
    var sele = $("#tableusu").val();
    var uri = './php/filtrarusuario.php';
    var arraydatos = {"rol":sele,"nombre":dato};
    $.ajax({
      type:'POST',
      url:uri,
      data:arraydatos,
      datatype:"json",
      success:function(data){
        $("#tablausuario").html(data);
      }
    });
  });
});
