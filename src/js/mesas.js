$(document).ready(function() {

    $.fn.datepicker.dates['qtrs'] = {
    days: ["Domingo", "Lunes", "Martes", "Miercoles", "Juevez", "Viernes", "Sabado"],
    daysShort: ["D", "L", "M", "W", "J", "V", "S"],
    daysMin: ["D", "L", "M", "W", "J", "V", "S"],
    months: ["C1", "C2", "C3", "C4", "", "", "", "", "", "", "", ""],
    monthsShort: ["Ene&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Feb&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mar", "Abr&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;May&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jun", "Jul&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ago&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sep", "Oct&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nov&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dic", "", "", "", "", "", "", "", ""],
    today: "Today",
    clear: "Clear",
    format: "mm/dd/yyyy",
    titleFormat: "MM yyyy",
    /* Leverages same syntax as 'format' */
    weekStart: 0
  };

  $.ajax({
    url: '/src/controladores/c_mesas.php',
    type: 'POST',
    dataType: 'json',
    data: {operacion: 'buscar', nombre:'', tipo:'0'}
  })
  .done(function(e) {
    var vista= e;
    for (var i = 0; i < vista.length; i++) {
      $('#vista_mesas').append(vista[i]);
    }
    $('#resultados').text( vista.length+ '  Resultados Encontrados');
  });

  $('#quarter').datepicker({
    format: "MM-yyyy",
    minViewMode: 1,
    autoclose: true,
    language: "qtrs",
    forceParse: false
  }).on("show", function(event) {
    $('.datepicker').addClass('datepicker2');
    $(".month").each(function(index, element) {
      if (index > 3) $(element).hide();
    });

  });
    $('#ano').datepicker({
      format: "yyyy",
      viewMode: "years",
      minViewMode: "years",
      autoclose: true,
      language: 'es'});

  $('#mes_f').datepicker({
    format: "mm-yyyy",
    viewMode: "months",
    minViewMode: "months",
    autoclose: true,
    language: 'es'});

  $("#semana").datepicker({
      format: 'dd/mm/yyyy'
  });

   //Get the value of Start and End of Week
  $('#semana').on('dp.change', function (e) {
      var value = $("#semana").val();
      var firstDate = moment(value, "MM-DD-YYYY").day(1).format("MM-DD-YYYY");
      var lastDate =  moment(value, "MM-DD-YYYY").day(7).format("MM-DD-YYYY");
      $("#semana").val(firstDate + " - " + lastDate);
  });

});

$('#buscar').click(function(event) {
  event.preventDefault();
  var nombre =$('#nombre').val();
  var tipo =$('#tipo').val();
  $.ajax({
    url: '/src/controladores/c_mesas.php',
    type: 'POST',
    dataType: 'json',
    data: {operacion: 'buscar', nombre: nombre, tipo:tipo}
  })
  .done(function(e) {
    console.log(e);
    var vista= e;
    $('#vista_mesas').html('');
    for (var i = 0; i < vista.length; i++) {
      $('#vista_mesas').append(vista[i]);
    }
    $('#resultados').text( vista.length+ '  Resultados Encontrados');
  })
});


$('#mas_opc').click(function(event) {
  event.preventDefault();
  if ($('#div_opcfecha').css('display') == 'none') {
    $('#div_opcfecha').show();
    $('#div_fecha').show();
  }else {
    $('#div_opcfecha').hide();
    $('#div_fecha').hide();
  }

});

$('input[type=radio][name=tipo_fecha]').change(function(event) {
  var tipo= $('input[type=radio][name=tipo_fecha]:checked').val();
  switch (tipo) {
    case 'ano':
      $('#ano').show();
      $('#quarter').hide();
      $('#mes_f').hide();
      $('#semana').hide();
      break;
    case 'mes':
      $('#ano').hide();
      $('#quarter').hide();
      $('#mes_f').show();
      $('#semana').hide();
      break;
    case 'semana':
      $('#ano').hide();
      $('#quarter').hide();
      $('#mes_f').hide();
      $('#semana').show();
      break;
    case 'cuatrimestre':

      $('#ano').hide();
      $('#quarter').show();
      $('#mes_f').hide();
      $('#semana').hide();
      break;

    default:

  }
});
