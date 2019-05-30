$(document).ready(function() {

});


$(document).on('click','.comprar',function(e){
  e.preventDefault();
  var id_art=$(this).attr('id');
  id_art=id_art.split("_");
  $.ajax({
    url: '/src/controladores/c_cookies.php',
    type: 'POST',
    dataType: 'json',
    data: {operacion: 'agregar', articulo: id_art[1]}
  })
  .done(function(e) {
    console.log(e);
    window.location="carrito.php";
  })


});


$('#imprimir').click(function(event) {
  event.preventDefault();
  var nombre =$('#id_even').val();
    $.ajax({
      url: '/src/controladores/c_detalle.php',
      type: 'POST',
      //dataType: 'json',
      data: {id: nombre, pdf:1}
    })
    .done(function(e) {
      console.log(e);
      window.open('/../../pdf.php?archivo=Detalle_Mesa', '_blank');
    })

});
