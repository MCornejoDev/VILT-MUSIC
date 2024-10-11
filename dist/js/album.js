"use strict";

//Objeto de tipo Audio.
var audio = new Audio();
audio.volume = 0.3;
//Variable que contendrá el tiempo en el que se ha pausado la canción en reproducción.
var tiempo = 0;
//Variable que contendrá el id de la canción cuándo se haya pausado.
var audio_id = -1;
//Lista de canciones del albúm.
var trackList = document.querySelectorAll('.audio');
var contador = 0;
//Modo seleccionado.
var modo = "";
//Posición de la canción en reproducción en el array.
var pos = -1;
//Posición aleatoria de la canción en el array.
var pos_aleatoria = -1;
//Variables para la duración de la canción
var hours = -1;
var minutes = -1;
var seconds = -1;
//Constantes
var rutabase = "http://localhost/PHP/PROYECTO_PHP_SPOTIFY/disco/";
$(document).ready(function () {
  //Iniciar la reproducción de una canción.
  $('.fa-play-circle').on('click', function () {
    var cancion = $(this).siblings('input:hidden');
    play(cancion, $(this));
  });

  //Pausa la reproducción de una canción.
  $('.fa-pause-circle').on('click', function () {
    var cancion = $(this).siblings('input:hidden');
    pause(cancion, $(this));
  });

  //Parar la reproducción de una canción.
  $('.fa-stop-circle').on('click', function () {
    audio.pause();
    audio.src = "";
    tiempo = 0;
  });

  //Reproducirá la lista completa de canciones del albúm.
  $('#album_completo').on('click', function () {
    play($(trackList[0]), $(trackList[0]).siblings('.fa-play-circle'));
  });

  //Reproducirá las canciones de forma aleatoría.
  $('.fa-random').on('click', function () {
    modo = "aleatoria";
    cambiarTitle(modo, $(this));
  });

  //Reproducirá las canciones de forma repetitiva.
  $('.fa-redo-alt').on('click', function () {
    modo = "repetitiva";
    cambiarTitle(modo, $(this));
  });

  //Reproducirá las canciones de forma normal.
  $('.normal').on('click', function () {
    modo = "";
    cambiarTitle(modo, $(this));
  });

  //Reproducirá la anterior canción.
  $('.fa-step-backward').on('click', function () {
    prev();
  });

  //Reproducirá la siguiente canción.
  $('.fa-step-forward').on('click', function () {
    next();
  });

  //Según el modo seleccionado hará una cosa u otra.
  $(audio).on('ended', function () {
    $('.fa-pause-circle').addClass('hide');
    $('.fa-play-circle').removeClass('hide');
    next();
  });

  //Muestra un icono para editar el campo.
  $(".detalles").on('mouseover', function () {
    $(this).find('.fa-edit').removeClass('hide');
  });

  //Esconde el icono del edición del campo.
  $(".detalles").on('mouseout', function () {
    $(this).find('.fa-edit').addClass('hide');
  });

  //Obtendrá los datos para actualizar el valor de la columna seleccionada.
  $(".fa-edit").on('click', function () {
    //Id de la fila de la base de datos.
    var id = window.location.pathname.substring(window.location.pathname.lastIndexOf('=') + 1);
    //Columna de la base de datos.
    var columna = $(this).attr('id');
    // Columna de la base de datos en formato bonito.
    var id_text = columna.charAt(0).toUpperCase() + columna.slice(1).toLowerCase();
    //Datas de cada elemento del edit seleccionado.
    var date_type = $(this).attr('data-type');
    var date_placeholder = $(this).attr('data-placeholder');
    var date_tama = $(this).attr('data-tama');
    //Muestra un alert en formato bonito para hacer el cambio.
    swalFire(id, columna, date_type, date_placeholder, date_tama, id_text);
  });
  $("#progress_audio").on("click", function (e) {
    var percent = e.offsetX / this.offsetWidth;
    audio.currentTime = percent * audio.duration;
  });
});
function play(cancion, elemento) {
  $('#cancion_actual').text($(cancion).parent().siblings().text());
  $('.fa-step-backward').removeClass('hide');
  $('.fa-step-forward').removeClass('hide');
  if (audio_id == -1) {
    audio.src = cancion.val();
    audio_id = cancion.attr('id');
    songDur();
    audio.play();
    $(elemento).addClass('hide');
    $(elemento).siblings('.fa-pause-circle').removeClass('hide');
  } else {
    if (audio_id == cancion.attr('id')) {
      audio.currentTime = tiempo;
      tiempo = 0;
      audio.play();
      $(elemento).addClass('hide');
      $(elemento).siblings('.fa-pause-circle').removeClass('hide');
    } else {
      audio_id = cancion.attr('id');
      tiempo = 0;
      audio.currentTime = 0.0;
      audio.src = cancion.val();
      audio.play();
      $('.fa-pause-circle').addClass('hide');
      $('.fa-play-circle').removeClass('hide');
      $(elemento).addClass('hide');
      $(elemento).siblings('.fa-pause-circle').removeClass('hide');
    }
  }
}

//Pausa la canción del elemento seleccionado.
function pause(cancion, elemento) {
  audio_id = cancion.attr('id');
  tiempo = audio.currentTime;
  audio.pause();
  $(elemento).addClass('hide');
  $(elemento).siblings('.fa-play-circle').removeClass('hide');
}
function stop() {}
function next() {
  var pos = encontrarPos();
  var pos_aleatoria = posAleatoria();
  switch (modo) {
    case "aleatoria":
      // Se reproducirá la siguiente canción de forma aleatoria.
      play($(trackList[pos_aleatoria]), $(trackList[pos_aleatoria]).siblings('.fa-play-circle'));
      break;
    case "repetitiva":
      // Se reproducirá la misma canción.
      play($(trackList[pos]), $(trackList[pos]).siblings('.fa-play-circle'));
      break;
    default:
      // Reproducción normal.
      var nextPos = pos === trackList.length - 1 ? 0 : pos + 1;
      play($(trackList[nextPos]), $(trackList[nextPos]).siblings('.fa-play-circle'));
      break;
  }
}
function prev() {
  var pos = encontrarPos();
  var pos_aleatoria = posAleatoria();
  switch (modo) {
    case "aleatoria":
      // Se reproducirá la anterior canción de forma aleatoria.
      play($(trackList[pos_aleatoria]), $(trackList[pos_aleatoria]).siblings('.fa-play-circle'));
      break;
    case "repetitiva":
      // Se reproducirá la misma canción.
      play($(trackList[pos]), $(trackList[pos]).siblings('.fa-play-circle'));
      break;
    default:
      // Reproducción normal.
      var prevPos = pos === 0 ? trackList.length - 1 : pos - 1;
      play($(trackList[prevPos]), $(trackList[prevPos]).siblings('.fa-play-circle'));
      break;
  }
}

//Encuentra y devulve la posición del elemento audio_id en la lista 
function encontrarPos() {
  for (var i = 0; i < trackList.length; i++) {
    if (trackList[i].id == audio_id) {
      return i;
    }
  }
}

//Devuelve una posición aleatoria de la lista.
function posAleatoria() {
  var pos_aleatoria = pos;
  while (pos_aleatoria == pos) {
    pos_aleatoria = Math.floor(Math.random() * trackList.length);
  }
  return pos_aleatoria;
}

//Muestra el tiempo que le queda a la canción y modifica la barra de progreso según el tiempo.
function songDur() {
  setInterval(function () {
    // let durationTotal = audio.duration;
    // let minutesT = Math.floor(durationTotal / 60);
    // let secondsT = Math.floor(durationTotal % 60);
    // let secondsWithLeadingZeroT = secondsT < 10 ? '0' + secondsT : secondsT;
    // $('#tiempo').text(" / " + minutesT + ':' + secondsWithLeadingZeroT);

    var timeRemaining = audio.duration - audio.currentTime;
    var minutes = Math.floor(timeRemaining / 60);
    var seconds = Math.floor(timeRemaining % 60);
    var secondsWithLeadingZero = seconds < 10 ? '0' + seconds : seconds;
    $('#cambiaTiempo').text(minutes + ':' + secondsWithLeadingZero);
    $('#progress_audio').attr('max', audio.duration);
    $('#progress_audio').attr('value', audio.currentTime);
  }, 500);
}
function cambiarTitle(modo, elemento) {
  $('.data-activado').attr('title', 'Desactivado');
  $('.indigo-text').removeClass('indigo-text');
  $(elemento).addClass('indigo-text');
  switch (modo) {
    case "aleatoria":
      $('.fa-random').attr('title', 'Activado');
      break;
    case "repetitiva":
      $('.fa-redo-alt').attr('title', 'Activado');
      break;
    case "":
      $('.normal').attr('title', 'Activado');
      break;
  }
}

//Alert para modificación de campos.
function swalFire(id, columna, date_type, date_placeholder, date_tama, texto) {
  var pattern = new RegExp('[0-9]{4}/(0[1-9]|1[012])/(0[1-9]|1[0-9]|2[0-9]|3[01])');
  Swal.fire({
    title: "<h5 class='h5'>Va a actualizar el campo ".concat(texto, "</h5>"),
    input: date_type,
    inputAttributes: {
      autocapitalize: 'off',
      required: true,
      step: 0.1,
      "class": 'form-control',
      maxlength: date_tama
    },
    inputPlaceholder: date_placeholder,
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Confirmar',
    showLoaderOnConfirm: true,
    inputValidator: function inputValidator(value) {
      if (!value) {
        return "Rellene el campo";
      }
      if (columna == 'fecha') {
        if (pattern.test(value) == false) {
          return "Rellene el campo correctamente YYYY/MM/DD";
        }
      }
    },
    preConfirm: function preConfirm(value) {
      return new Promise(function (resolve) {
        /*
        Ajax code will be here
        */
        $.ajax({
          url: rutabase + "/update",
          type: 'POST',
          cache: false,
          data: {
            id: id,
            columna: columna,
            value: value
          }
        }).done(function (response) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'La página se recargará en breve',
            showConfirmButton: false,
            timer: 1500
          }).then(function (result) {
            if (result) {
              window.setTimeout(function () {
                location.reload();
              }, 2500);
            }
          });
        }).fail(function () {
          Swal.fire({
            title: 'Oops',
            text: 'Something went wrong with ajax !',
            icon: 'Error',
            confirmButtonText: 'Vale'
          });
        });
      });
    }
  });
}