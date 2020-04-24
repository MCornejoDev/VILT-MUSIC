//Objeto de tipo Audio.
let audio = new Audio();
audio.volume = 0.3;
//Variable que contendrá el tiempo en el que se ha pausado la canción en reproducción.
let tiempo;
//Variable que contendrá el id de la canción cuándo se haya pausado.
let audio_id = -1;
$(document).ready(function () {

  //Iniciar la reproducción de una canción
  $('.fa-play-circle').on('click', function () {
    let cancion = $(this).siblings('input:hidden');

    if (audio_id == -1) {
      audio.src = cancion.val();
      audio_id = cancion.attr('id');
      audio.play();
      $(this).addClass('hide');
      $(this).siblings('.fa-pause-circle').removeClass('hide')
    }
    else {
      if (audio_id == cancion.attr('id')) {
        audio.currentTime = tiempo;
        tiempo = 0;
        audio.play();
        $(this).addClass('hide');
        $(this).siblings('.fa-pause-circle').removeClass('hide')
      }
      else {
        audio_id = cancion.attr('id');
        tiempo = 0;
        audio.currentTime = 0.0;
        audio.src = cancion.val();
        audio.play();
        $('.fa-pause-circle').addClass('hide');
        $('.fa-play-circle').removeClass('hide');
        $(this).addClass('hide');
        $(this).siblings('.fa-pause-circle').removeClass('hide')
      }
    }


  });

  //Pausa la reproducción de una canción
  $('.fa-pause-circle').on('click', function () {
    let cancion = $(this).siblings('input:hidden');
    audio_id = cancion.attr('id');
    tiempo = audio.currentTime;
    audio.pause();
    $(this).addClass('hide');
    $(this).siblings('.fa-play-circle').removeClass('hide')
  });

  //Parar la reproducción de una canción
  $('.fa-stop-circle').on('click', function () {
    audio.pause();
    audio.src = "";
    tiempo = 0;
  });

  //Volver todo al inicio en el momento que se acabe una canción
  $(audio).on('ended', function () {
    audio_id = -1;
    audio.currentTime = 0.0;
    tiempo = 0;
    $('.fa-pause-circle').addClass('hide');
    $('.fa-play-circle').removeClass('hide');
  });

});
