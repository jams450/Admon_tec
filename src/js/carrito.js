$(document).ready(function() {

});

$('#si_factura').click(function(event) {
  if ($('#div_fac').css('display')=='none') {
    $('#div_fac').show();
    $('#rfc').attr('required', 'true');
    $('#direccion_fiscal').attr('required', 'true');
    $('#correo').attr('required', 'true');
  }else {
    $('#div_fac').hide();
    $('#rfc').removeAttr('required');
    $('#direccion_fiscal').removeAttr('required');
    $('#correo').removeAttr('required');
  }
});


$(document).on('click','.quitar',function(e){
  e.preventDefault();
  var id_art=$(this).attr('id');
  id_art=id_art.split("_");
  $.ajax({
    url: '/src/controladores/c_cookies.php',
    type: 'POST',
    dataType: 'json',
    data: {operacion: 'quitar', articulo: id_art[1]}
  })
  .done(function(e) {
    location.reload();
  })


});

$('#form_pagar').submit(function(event) {
  event.preventDefault();
  var evento=$('#id_mesa').val();
  if ($('#div_fac').css('display')=='none') {
    $.ajax({
      url: '/src/controladores/c_carrito.php',
      type: 'POST',
      dataType: 'json',
      data: {operacion: 'agregar', evento:evento}
    })
    .done(function(e) {
      console.log(e);
      if (e == 'exito') {
        swal({
            type: 'success',
            title: 'Exito',
            text: 'Venta Ingresada'
          });
        setTimeout(function(){
          window.location="mesas_det.php?id="+evento;
        },1500);
      }else {
        swal({
            type: 'error',
            title: 'Error',
            text: e
          });
      }
    })
  }else {
    var datos=$('#form_pagar').serializeArray();
    $.ajax({
      url: '/src/controladores/c_carrito.php',
      type: 'POST',
      dataType: 'json',
      data: {operacion: 'agregar', evento:evento, datos:datos}
    })
    .done(function(e) {
      if (e == 'exito') {
        var correo= $('#correo').val();
        $.ajax({
          url: '/src/controladores/c_carrito.php',
          type: 'POST',
          //dataType: 'json',
          data: {operacion: 'correo', correo:correo}
        }).done(function(e) {
            swal({
                type: 'success',
                title: 'Exito',
                text: 'Venta Ingresada y factura Enviada'
              });

            setTimeout(function(){
              window.open('/../../pdf.php?archivo=CFDI', '_blank');
              window.location="mesas_det.php?id="+evento;
            },1500);
        })
      }else {
        swal({
            type: 'error',
            title: 'Error',
            text: e
          });
      }
    })
  }

});
