$(document).ready(function(){ 

  // Plugin initialization
  $('.button-collapse').sideNav();
  $(".dropdown-button").dropdown();
  $('.parallax').parallax();
  $('.scrollspy').scrollSpy({
    scrollOffset: $('#nav').height() + 50
  });
  $('.modal').modal({
      dismissible: false, // La pantalla modal se irá al pulsar en el botón solamente
      opacity: .5 // Opacidad del fondo
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

  // Añadir o eliminar favorito
  $('.btn-favorito').click(function(e){
    e.preventDefault();
    var id = '#' + $(this).attr('id');
    var id_obra = $(this).data('id_obra');
    var id_usuario = $(this).data('id_usuario');
    $.get('/favorito',{id_obra,id_usuario}, function(data, status){
      if(status == 'success'){
        if(data == 'add'){
          $(id + ' > i').empty().text('favorite');
        }else if(data == 'remove'){          
          $(id + ' > i').empty().text('favorite_border');
        }
      }
    });
  });

  // Bloquear o desbloquear usuario
  $('.btn-bloquear-usuario').click(function(e){
    e.preventDefault();
    var icono = $(this).children('i');
    console.log(icono.text());

    var form = $(this).parents('form');
    var url = form.attr('action'); 

    $.post(url,form.serialize(), function(data){
      console.log(data.accion);
      if(data.accion == 'bloqueado'){
        icono.empty().text('lock');
      }else if(data.accion == 'desbloqueado'){          
        icono.empty().text('lock_open');
      }
      $('#modal-alert-eliminar').modal('open');
      $('#modal-alert-eliminar > .modal-content').empty().append('<p>' + data.status + '</p>');
    });
  });

  // Eliminar usuario
  $('table').on('click', '.btn-eliminar', function(e){
    e.preventDefault();
    $('.modal').modal();
  });

  $('.btn-eliminar-usuario').click(function(e){
    e.preventDefault();

    var row = $(this).parents('tr'); 
    var form = $(this).parents('form');
    var url = form.attr('action');

    console.log(url);

    $('#modal-alert-eliminar > .modal-content').empty();

    $.post(url,form.serialize(), function(data){
      $('#modal-alert-eliminar').modal('open');
      console.log(data);
      row.fadeOut();
      $('#tbodyUsuarios').empty().append(data.tbody);
      $('#modal-alert-eliminar > .modal-content').append('<p>' + data.status + '</p>');
    }).fail(function(){
      $('#modal-alert-eliminar > .modal-content').append('<p>Algo salió mal</p>');
    });
  });

  // Cerrar pedido (Abrir) pedido
  $('table').on('click','.btn-estado-pedido', function(e){
    e.preventDefault();
    var icono = $(this).children('i');
    console.log(icono.text());

    var form = $(this).parents('form');
    var url = form.attr('action');

    $.post(url,form.serialize(), function(data){
      console.log(data.accion);
      if(data.accion == 'cerrado'){        
        $('#tbodyPedidos').empty().append(data.tbody);
        icono.empty().text('lock');
      }else if(data.accion == 'abierto'){          
        $('#tbodyPedidos').empty().append(data.tbody);
        icono.empty().text('lock_open');
      }
    });
  });

});