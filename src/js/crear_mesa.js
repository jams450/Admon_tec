
var articulo= new Array();

$('#agregar').click(function(event) {
  var id=$('#producto').val();
  var valid=true;

  if (articulo.indexOf(id)!=-1) {
    valid=false;
  }
  console.log(valid);
  if (valid) {
    $.ajax({
        data: {id:id, operacion: 'producto'},
        type: "POST",
        dataType: "json",
        url: "/src/controller/controlador_mesa.php",
      }).done(function(res) {
        $('#tabla_p').append(res);
        articulo.push(id);
      })
  }

});

$(document).on('click','.quitar',function(e){
  e.preventDefault();
  var id_art=$(this).attr('id');
  id_art=id_art.split("_");
  $(this).closest('tr').remove();
  var index=articulo.indexOf(id_art[1]);
  articulo.pop(id_art[1]);
});


$('#newcustomer').submit(function(event) {
  event.preventDefault();
  var datos = $('#newcustomer').serializeArray();
  $.ajax({
      data: {operacion: 'alta_mesa' , datos:datos , articulo:articulo},
      type: "POST",
      dataType: "json",
      url: "/src/controller/controlador_mesa.php",
    }).done(function(res) {
      swal({
          type: 'success',
          title: 'Exito',
          text: 'Mesa creada'
        });
      setTimeout(function(){
        window.location="mesas_det.php?id="+res;
      },1500);
    })

});
