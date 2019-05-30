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
