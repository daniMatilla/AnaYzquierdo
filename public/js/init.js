$(document).ready(function () {

  // Plugin initialization
  $('.button-collapse').sideNav();
  $(".dropdown-button").dropdown();
  $('.chips').material_chip();   

  $('.chips-placeholder').material_chip({
    placeholder: '+Etiquetas',
  });

  $('textarea#comentario').characterCounter();

  $('.tooltipped').tooltip({delay: 50});
  $('.parallax').parallax();
  $('.scrollspy').scrollSpy({
    scrollOffset: $('#nav').height() + 50
  });
  $('.modal').modal({
    dismissible: true, // La pantalla modal se irá al pulsar en el botón solamente
    opacity: .8 // Opacidad del fondo
  });

  $('#modal-alert').modal('open');

  // Pushpin Init
  $('.sider-pushpin').pushpin({
    top: $('.contenido').offset().top,
    offset: $('#nav').height() + 14
  });
  $('.nav-pushpin').pushpin({
    top: $('#nav').offset().top
  });

  /* OBRA *****************************************************************************/

  // Eliminar obra
  $('#tabla-admin-obras').on('click', '.btn-eliminar', function (e) {
    e.preventDefault();

    var id = $(this).attr('id');

    $('#modal-alert-eliminar-' + id).modal({
      dismissible: false, // La pantalla modal se irá al pulsar en el botón solamente
      opacity: .8 // Opacidad del fondo
    }).modal('open');
  });

  $('.btn-eliminar-obra').click(function (e) {
    e.preventDefault();

    var row = $(this).parents('tr');
    var form = $(this).parents('form');
    var url = form.attr('action');

    console.log(url);

    $('#modal-alert-eliminar').children('.modal-content').empty();

    $.post(url, form.serialize(), function (data) {
      console.log(data);
      $('#modal-alert-eliminar').modal({
        dismissible: false, // La pantalla modal se irá al pulsar en el botón solamente
        opacity: .8 // Opacidad del fondo
      }).children('.modal-content')
      .append('<p>' + data.status + '</p>')
      .modal('open');
      $('#tbodyObras').empty().append(data.tbody);
      location.reload();      
      row.fadeOut();
    }).fail(function () {
      $('#modal-alert-eliminar').children('.modal-content')
      .append('<p>Algo salió mal</p>');
    });

  });

  var formMod = $(this).parents('form');
  var url = formMod.attr('action');

  // Carga de etiquetas existentes de la BBDD en el .chips-autocomplete
  $.get(url ,function(data){
    var todasEtiquetasArray = data.todas_etiquetas;
    var etiquetasArray = data.etiquetas;
    var dataEtiquetas = {};
    var chipsEtiquetas = [];
    if(todasEtiquetasArray !== undefined){
      for (var i = 0; i < todasEtiquetasArray.length; i++) {
        dataEtiquetas[todasEtiquetasArray[i]] = null;
      }
    }
    if(todasEtiquetasArray !== undefined){
      for (var i = 0; i < etiquetasArray.length; i++) {
        var chip = {};
        chip['tag'] = etiquetasArray[i];
        chipsEtiquetas.push(chip);
      }
    }    
    $('#chips').material_chip({
      data: chipsEtiquetas,
      autocompleteOptions: {
        data: dataEtiquetas,
        limit: 5,
        minLength: 1
      },
      placeholder: '+Etiquetas'
    });
  });

  // 
  $('#chips').on('chip.add', function(e, chip){
    var form = $(this).parents('form');
    // var url = form.attr('action');
    var _token = form.find('input[name="_token"]').val();
    $.post(url,{
      chip,
      _token,
      accion: 'tag_aniadir'
    }, function(data){
      console.log(data.resultado);
    })
  });

  $('#chips').on('chip.delete', function(e, chip){
    var form = $(this).parents('form');
    // var url = form.attr('action');
    var _token = form.find('input[name="_token"]').val();
    $.post(url,{
      chip,
      _token,
      accion: 'tag_eliminar'
    }, function(data){
      console.log(data.resultado);
    })
  });

  /* FAVORITOS *****************************************************************************/

  // Añadir o eliminar favorito
  $('.btn-favorito').click(function (e) {
    e.preventDefault();
    var id = '#' + $(this).attr('id');
    var id_obra = $(this).data('id_obra');
    var id_usuario = $(this).data('id_usuario');
    $.get('/favorito', {id_obra, id_usuario}, function (data, status) {
      if (status == 'success') {
        if (data == 'add') {
          $(id + ' > i').empty().text('favorite');
        } else if (data == 'remove') {
          $(id + ' > i').empty().text('favorite_border');
        }
      }
    });
  });


  /* USUARIOS *****************************************************************************/

  // Bloquear o desbloquear usuario
  $('.btn-bloquear-usuario').click(function (e) {
    e.preventDefault();
    var icono = $(this).children('i');
    console.log(icono.text());

    var form = $(this).parents('form');
    var url = form.attr('action');

    $.post(url, form.serialize(), function (data) {
      console.log(data.accion);
      if (data.accion == 'bloqueado') {
        icono.empty().text('lock');
      } else if (data.accion == 'desbloqueado') {
        icono.empty().text('lock_open');
      }
      $('#modal-alert-admin-usuarios').modal({
        dismissible: false, // La pantalla modal se irá al pulsar en el botón solamente
        opacity: .8 // Opacidad del fondo
      }).children('.modal-content').empty()
      .append('<p>' + data.status + '</p>')
      .modal('open');
    });
  });

  //Eliminar usuario
  $('#tabla-admin-usuarios').on('click', '.btn-eliminar', function (e) {
    e.preventDefault();

    var id = $(this).attr('id');

    $('#modal-alert-eliminar-' + id).modal({
      dismissible: false, // La pantalla modal se irá al pulsar en el botón solamente
      opacity: .8 // Opacidad del fondo
    }).modal('open');
  });

  $('.btn-eliminar-usuario').click(function (e) {
    e.preventDefault();

    var row = $(this).parents('tr');
    var form = $(this).parents('form');
    var url = form.attr('action');

    console.log(url);

    $('#modal-alert-eliminar').children('.modal-content').empty();

    $.post(url, form.serialize(), function (data) {
      console.log(data);
      row.fadeOut();
      $('#tbodyUsuarios').empty().append(data.tbody);
      $('#modal-alert-eliminar').modal({
        dismissible: false, // La pantalla modal se irá al pulsar en el botón solamente
        opacity: .8 // Opacidad del fondo
      }).children('.modal-content')
      .append('<p>' + data.status + '</p>')
      .modal('open');
    }).fail(function () {
      $('#modal-alert-eliminar').children('.modal-content')
      .append('<p>Algo salió mal</p>');
    });

    location.reload();
  });


  /* PEDIDOS *****************************************************************************/

  // Cerrar pedido (Abrir)
  $('#tabla-admin-pedidos').on('click', '.btn-estado-pedido', function (e) {
    e.preventDefault();
    
    $('.tooltipped').tooltip('remove');
    var icono = $(this).children('i');
    console.log(icono.text());

    var form = $(this).parents('form');
    var url = form.attr('action');

    $.post(url, form.serialize(), function (data) {
      console.log(data.accion);
      if (data.accion == 'cerrado') {
        $('#tbodyPedidos').empty().append(data.tbody);
        icono.empty().text('lock');
        $('.tooltipped').tooltip();
      } else if (data.accion == 'abierto') {
        $('#tbodyPedidos').empty().append(data.tbody);
        icono.empty().text('lock_open');
        $('.tooltipped').tooltip();
      }
    });
  });

  // Ver detalle de pedido
  $('#tabla-admin-pedidos').on('click', '.btn-detalle-pedido', function(e){
    e.preventDefault();

    var form = $(this).parents('form');
    var url = form.attr('action');
    var id = $(this).attr('id');
    var cuerpo = $('#tbodyDetalle');

    cuerpo.empty();

    $.get(url, form.serialize(), function (data) {
      console.log(data.items);
      for(var i = 0; i < data.items.length; i++){
        var fila = '<tr>';
        fila += '<td><img src="'+data.items[i].obra.imagen+'"/></td>';
        fila += '<td>'+data.items[i].obra.titulo_obra+'</td>';
        fila += '<td>'+data.items[i].precio+'</td>';
        fila += '<td>'+data.items[i].cantidad+'</td>';
        fila += '<td>'+data.items[i].precio * data.items[i].cantidad+'</td>';
        fila += '</tr>';
        cuerpo.append(fila);
      }
      $('#modal-detalle-pedido-' + id).modal({
        dismissible: false, // La pantalla modal se irá al pulsar en el botón solamente
        opacity: .8 // Opacidad del fondo
      }).modal('open');
    });
  });

  /* ETIQUETAS *****************************************************************************/
  // Ver obras relacionadas
  $('.datos-obra').on('click', '.btn-obras-relacionadas', function(e){
    e.preventDefault();

    var form = $(this).parents('form');
    var url = form.attr('action');
    var id = $(this).attr('id');
    var cuerpo = $('#imagenes-etiqueta-'+id);

    cuerpo.empty();

    $.get(url, form.serialize(), function (data) {
      console.log(data.items);
      for(var i = 0; i < data.items.length; i++){
        var img = 
        '<div class="chip"><img class="z-depth-2" src="/'
        +data.items[i].imagen+'" alt="'+data.items[i].titulo_obra+'"><a href="'+data.items[i].titulo_obra+'">'
        +data.items[i].titulo_obra
        +'</a></div>'
        cuerpo.append(img);
      }
      $('#modal-obras-relacionadas-'+id).modal({
        dismissible: false, // La pantalla modal se irá al pulsar en el botón solamente
        opacity: .8 // Opacidad del fondo
      }).modal('open');
    });
  });

  // Eliminar etiqueta
  $('#tabla-admin-etiquetas').on('click', '.btn-eliminar', function (e) {
    e.preventDefault();

    var id = $(this).attr('id');

    $('#modal-alert-eliminar-' + id).modal({
      dismissible: false, // La pantalla modal se irá al pulsar en el botón solamente
      opacity: .8 // Opacidad del fondo
    }).modal('open');
  });

  $('.btn-eliminar-etiqueta').click(function (e) {
    e.preventDefault();

    var row = $(this).parents('tr');
    var form = $(this).parents('form');
    var url = form.attr('action');

    console.log(url);

    $('#modal-alert-eliminar').children('.modal-content').empty();

    $.post(url, form.serialize(), function (data) {
      console.log(data);
      $('#modal-alert-eliminar').modal({
        dismissible: false, // La pantalla modal se irá al pulsar en el botón solamente
        opacity: .8 // Opacidad del fondo
      }).children('.modal-content')
      .append('<p>' + data.status + '</p>')
      .modal('open');
      $('#tbodyEtiquetas').empty().append(data.tbody);
      location.reload();      
      row.fadeOut();
    }).fail(function () {
      $('#modal-alert-eliminar').children('.modal-content')
      .append('<p>Algo salió mal</p>');
    });

  });

});