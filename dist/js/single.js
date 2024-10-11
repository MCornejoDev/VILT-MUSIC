"use strict";

var contenedor = $('#inputs');
var i = 1;
$(document).ready(function () {
  $('#id_disco').on('change', function () {
    if ($('#div_nueva_cancion').hasClass('hide')) {
      $('#div_nueva_cancion').removeClass('hide');
    }
  });
  $('#nueva_cancion').on('click', function () {
    var input = "<div class=\"md-form\">\n                        <div class=\"custom-file\">\n                            <input type=\"file\" name=\"audio[]\" class=\"custom-file-input\" lang=\"es\" required\n                            accept=\"audio/mp3\" id=\"audio_".concat(i, "\">\n                            <label class=\"custom-file-label\" for=\"audio_").concat(i, "\">Seleccionar el archivo</label>\n                        </div>\n                    </div>");
    contenedor.append(input);
    i++;
  });
  $(document).on('change', 'input:file', function () {
    if ($('#button_enviar').hasClass('hide')) {
      $('#button_enviar').removeClass('hide');
    }
    var nombre = $(this).val().split('\\').pop();
    $(this).siblings('label.custom-file-label').text(nombre);
  });
});