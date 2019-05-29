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
    })


});
