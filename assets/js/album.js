//Objeto de tipo Audio.
let audio = new Audio();
audio.volume = 0.3;
//Variable que contendrá el tiempo en el que se ha pausado la canción en reproducción.
let tiempo = 0;
//Variable que contendrá el id de la canción cuándo se haya pausado.
let audio_id = -1;
//Lista de canciones del albúm.
let trackList = document.querySelectorAll('.audio');
let contador = 0;
//Modo seleccionado.
let modo = "";
//Posición de la canción en reproducción en el array.
let pos = -1;
//Posición aleatoria de la canción en el array.
let pos_aleatoria = -1;
//Variables para la duración de la canción
let hours = -1;
let minutes = -1;
let seconds = -1;
//Constantes
const rutabase = "http://localhost/PHP/PROYECTO_PHP_SPOTIFY/disco/";

$(document).ready(function () {

  //Iniciar la reproducción de una canción.
  $('.fa-play-circle').on('click', function () {
    let cancion = $(this).siblings('input:hidden');
    play(cancion, $(this));
  });

  //Pausa la reproducción de una canción.
  $('.fa-pause-circle').on('click', function () {
    let cancion = $(this).siblings('input:hidden');
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
    $('.indigo-text').removeClass('indigo-text');
    $(this).addClass('indigo-text');
    modo = "aleatoria";
  });

  //Reproducirá las canciones de forma repetitiva.
  $('.fa-redo-alt').on('click', function () {
    $('.indigo-text').removeClass('indigo-text');
    $(this).addClass('indigo-text');
    modo = "repetitiva";
  });

  //Reproducirá las canciones de forma normal.
  $('.normal').on('click', function () {
    $('.indigo-text').removeClass('indigo-text');
    $(this).addClass('indigo-text');
    modo = "";
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

  $(".detalles").on('mouseover', function () {
    $(this).find('.fa-edit').removeClass('hide');
  });

  $(".detalles").on('mouseout', function () {
    $(this).find('.fa-edit').addClass('hide');
  });

  $(".fa-edit").on('click', function () {
    let id = window.location.pathname.substring(window.location.pathname.lastIndexOf('=') + 1);
    let columna = $(this).attr('id');
    let id_text = columna.charAt(0).toUpperCase() + columna.slice(1).toLowerCase();
    let date_type = $(this).attr('data-type');
    let date_placeholder = $(this).attr('data-placeholder');
    let date_tama = $(this).attr('data-tama');
    swalFire(id, columna, date_type, date_placeholder, date_tama, id_text);
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
    $(elemento).siblings('.fa-pause-circle').removeClass('hide')
  }
  else {
    if (audio_id == cancion.attr('id')) {
      audio.currentTime = tiempo;
      tiempo = 0;
      audio.play();
      $(elemento).addClass('hide');
      $(elemento).siblings('.fa-pause-circle').removeClass('hide')
    }
    else {
      audio_id = cancion.attr('id');
      tiempo = 0;
      audio.currentTime = 0.0;
      audio.src = cancion.val();
      audio.play();
      $('.fa-pause-circle').addClass('hide');
      $('.fa-play-circle').removeClass('hide');
      $(elemento).addClass('hide');
      $(elemento).siblings('.fa-pause-circle').removeClass('hide')
    }
  }

}

function pause(cancion, elemento) {
  audio_id = cancion.attr('id');
  tiempo = audio.currentTime;
  audio.pause();
  $(elemento).addClass('hide');
  $(elemento).siblings('.fa-play-circle').removeClass('hide')
}

function stop() {

}

//Reproducirá la siguiente canción de la manera del modo usado.
function next() {

  if (modo === "aleatoria") {
    //Se reproducirá la siguiente canción de forma aleatoria.
    pos = encontrarPos();
    pos_aleatoria = posAleatoria();
    play($(trackList[pos_aleatoria]), $(trackList[pos_aleatoria]).siblings('.fa-play-circle'));
  }
  else {
    if (modo === "repetitiva") {
      //Se reproducirá la misma canción.
      pos = encontrarPos();
      play($(trackList[pos]), $(trackList[pos]).siblings('.fa-play-circle'));
    }
    else {
      //Ningún modo activado, reproducción normal.
      pos = encontrarPos();
      if (pos == trackList.length - 1) {
        play($(trackList[0]), $(trackList[0]).siblings('.fa-play-circle'));
      }
      else {
        play($(trackList[pos + 1]), $(trackList[pos + 1]).siblings('.fa-play-circle'));
      }
    }
  }
}


function prev() {

  if (modo === "aleatoria") {
    //Se reproducirá la anterior canción de forma aleatoria.
    pos = encontrarPos();
    pos_aleatoria = posAleatoria();
    play($(trackList[pos_aleatoria]), $(trackList[pos_aleatoria]).siblings('.fa-play-circle'));
  }
  else {
    if (modo === "repetitiva") {
      //Se reproducirá la misma canción.
      pos = encontrarPos();
      play($(trackList[pos]), $(trackList[pos]).siblings('.fa-play-circle'));
    }
    else {
      //Ningún modo activado, reproducción normal.
      pos = encontrarPos();
      if (pos == 0) {
        play($(trackList[trackList.length - 1]), $(trackList[trackList.length - 1]).siblings('.fa-play-circle'));
      }
      else {
        play($(trackList[pos - 1]), $(trackList[pos - 1]).siblings('.fa-play-circle'));
      }

    }
  }
}

function encontrarPos() {
  for (let i = 0; i < trackList.length; i++) {
    if (trackList[i].id == audio_id) {
      return i;
    }
  }
}

function posAleatoria() {
  let pos_aleatoria = pos;
  while (pos_aleatoria == pos) {
    pos_aleatoria = Math.floor(Math.random() * trackList.length);
  }
  return pos_aleatoria;
}

function songDur() {

  setInterval(function () {
    // let durationTotal = audio.duration;
    // let minutesT = Math.floor(durationTotal / 60);
    // let secondsT = Math.floor(durationTotal % 60);
    // let secondsWithLeadingZeroT = secondsT < 10 ? '0' + secondsT : secondsT;
    // $('#tiempo').text(" / " + minutesT + ':' + secondsWithLeadingZeroT);

    let timeRemaining = audio.duration - audio.currentTime;
    let minutes = Math.floor(timeRemaining / 60);
    let seconds = Math.floor(timeRemaining % 60);
    let secondsWithLeadingZero = seconds < 10 ? '0' + seconds : seconds;
    $('#cambiaTiempo').text(minutes + ':' + secondsWithLeadingZero);

  }, 500);
}

function swalFire(id, columna, date_type, date_placeholder, date_tama, texto) {
  console.log("El id es : " + id + " la columna es : " + columna);
  Swal.fire({
    title: `<h5 class='h5'>Va a actualizar el campo ${texto}</h5>`,
    input: date_type,
    inputAttributes: {
      autocapitalize: 'off',
      required: true,
      step: 0.1,
      class: 'form-control',
      maxlength: date_tama
    },
    inputPlaceholder: date_placeholder,
    showCancelButton: true,
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Confirmar',
    showLoaderOnConfirm: true,
    inputValidator: (value) => {
      if (!value) {
        return "Rellene el campo";
      }
    },
    preConfirm: function (value) {
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
          }).then((result)=>{
            if(result){
              window.setTimeout(function() {
                location.reload();
              }, 2500)
            }
          })
        })
          .fail(function () {
            Swal.fire({
              title: 'Oops',
              text: 'Something went wrong with ajax !',
              icon: 'Error',
              confirmButtonText: 'Vale'
            })
          });
      });
    }
  })
}
