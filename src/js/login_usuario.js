

$('#newcustomer').submit(function(event) {
  event.preventDefault();
  var correo_login = $('#correo_login').val();
  var passwd_login = $('#passwd_login').val();
  $.ajax({
      data: {operacion: 'login',correo_login: correo_login,passwd_login:  passwd_login},
      type: "POST",
      dataType: "json",
      url: "/src/controller/controlador_cliente.php",
    })
    .done(function(res) {
      var data = res;
      switch (data) {
        case 'exito':
        swal({
            type: 'success',
            title: 'Logeado correctamente',
          });
          setTimeout(function(){
            window.location="index.php";
          }, 1000);

          break;
        case 'error':
        swal({
            type: 'error',
            title: 'Ocurrió un error',
            text: 'Informacion erronea',
          })
          break;
        default:

      }
    });

});

(function(event) {
  event.preventDefault();
  if ($('#newcustomer').valid()) {
    var datos = $('#newcustomer').serializeArray();
    $.ajax({
        data: datos,
        type: "POST",
        dataType: "json",
        url: "/src/controller/controlador_cliente.php",
      })
      .done(function(res) {
        var data = res;
        switch (data) {
          case 'exito':
          swal({
              type: 'success',
              title: 'Cliente registrado',
            });
            setTimeout(function(){
              window.location="index.php";
            }, 10000);

            break;
          case 'correo_mal':
            swal({
                type: 'error',
                title: 'Ocurrió un error',
                text: 'El correo ya esta asociado a una cuenta',
              })
           break;
          case 'error':
          swal({
              type: 'error',
              title: 'Ocurrió un error',
              text: 'Intente nuevamente',
            })
            break;
          default:

        }
      })
  }
});
