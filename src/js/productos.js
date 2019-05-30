$(document).ready(function() {

  $.ajax({
    url: '/src/controladores/c_productos.php',
    type: 'POST',
    dataType: 'json',
    data: {operacion: 'buscar', tipo:'0'}
  })
  .done(function(e) {
    console.log(e);
    var vista= e;
    for (var i = 0; i < vista.length; i++) {
      $('#vista_productos').append(vista[i]);
    }
    $('#resultados').text( vista.length+ '  Resultados Encontrados');
  });

});

$('#buscar').click(function(event) {
  event.preventDefault();
  var nombre =$('#nombre').val();
  var tipo =$('#tipo').val();
    $.ajax({
      url: '/src/controladores/c_productos.php',
      type: 'POST',
      dataType: 'json',
      data: {operacion: 'buscar', tipo:tipo}
    })
    .done(function(e) {
      console.log(e);
      var vista= e;
      $('#vista_productos').html('');
      for (var i = 0; i < vista.length; i++) {
        $('#vista_productos').append(vista[i]);
      }
      $('#resultados').text( vista.length+ '  Resultados Encontrados');
      if ( vista.length == 0) {
        $('#vista_productos').html('<h1 style="padding-top:50px;padding-bottom: 200px;" class="text-center">No se encontraron resultados</h1>');
      }
    })


});

$(document).on('click','.anadir',function(e){
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
