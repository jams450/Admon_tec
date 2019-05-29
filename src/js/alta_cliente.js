$(document).ready(function() {
  var valid = $("#newcustomer").validate({
    errorElement: "label",
    errorClass: 'error_form',
    errorPlacement: function(label, element) {
      var div = $(element).closest(".form_re");
      if (element.attr("class") == "styled-checkbox check_act") {
        if (val) {
          label.insertAfter($('#turisticas'));
          val = false;
        }
      } else
        label.insertAfter(div);

    },
    highlight: function(element) {
      $(element).closest('.form_re').addClass('has-error');
    },
    unhighlight: function(element) {
      $(element).closest('.form_re').removeClass('has-error');
    }
  });
});


$('#registro_cliente').click(function(event) {
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
              document.location.href = '/index.php';
            }, 1500);

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
