

$('#agregar').click(function(event) {
  var id=$('#producto').val();
  $.ajax({
      data: {id:id, operacion: 'producto'},
      type: "POST",
      dataType: "json",
      url: "/src/controller/controlador_mesa.php",
    }).done(function(res) {
      $('#tabla_p').append(res);
    })
});

$(document).on('click','.quitar',function(e){
  e.preventDefault();
  var id_art=$(this).attr('id');
  id_art=id_art.split("_");
  $(this).closest('tr').remove();
  productos.push(id);
});
