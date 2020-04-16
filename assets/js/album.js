let audio = document.querySelector('#audio');
audio.volume = 0.3;
$(document).ready(function () {

  //Iniciar la reproducción de una canción
  $(".fa-play-circle").on('click', function () {
    $(".fa-pause-circle").removeClass('fa-pause-circle').addClass('fa-play-circle');
    if (audio.paused) {
      $(this).removeClass('fa-play-circle').addClass('fa-pause-circle');
      let cancion = $(this).siblings('input:hidden').val();
      audio.src = cancion;
      audio.play();
    }
    else {
      $(this).removeClass('fa-pause-circle').addClass('fa-play-circle');
      audio.pause();
    }
  });

  //Parar la reproducción de una canción
  $(".fa-stop-circle").on('click', function () {
    $(this).siblings('i.fa-pause-circle').removeClass('fa-pause-circle').addClass('fa-play-circle');
    audio.pause();
    audio.src = "";
  });

});


audio.addEventListener("ended", function () {
  
});