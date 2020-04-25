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
    mode_play();

    if (trackList.length > 0) {
      contador++;
      console.log(contador);
      play($(trackList[contador]), $(trackList[contador]).siblings('.fa-play-circle'));
    }
    else {
      audio_id = -1;
      audio.currentTime = 0.0;
      tiempo = 0;

    }

  });

});

function play(cancion, elemento) {
  $('#cancion_actual').text($(cancion).parent().siblings().text());
  $('.fa-step-backward').removeClass('hide');
  $('.fa-step-forward').removeClass('hide');
  if (audio_id == -1) {
    audio.src = cancion.val();
    audio_id = cancion.attr('id');
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

function next() {
  playMode();
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
  playMode();
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

function playMode(){
  
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
