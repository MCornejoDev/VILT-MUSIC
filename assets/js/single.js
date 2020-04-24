let contenedor = $('#inputs');
let i = 1;
$(document).ready(function () {

    $('#id_disco').on('change', function () {
        if ($('#div_nueva_cancion').hasClass('hide')) {
            $('#div_nueva_cancion').removeClass('hide');
        }
    });

    $('#nueva_cancion').on('click', function () {
        let input = `<div class="md-form">
                        <div class="custom-file">
                            <input type="file" name="audio[]" class="custom-file-input" lang="es" required
                            accept="audio/mp3" id="audio_${i}">
                            <label class="custom-file-label" for="audio_${i}">Seleccionar el archivo</label>
                        </div>
                    </div>`;
        contenedor.append(input);
        i++;
    });

    $(document).on('change', 'input:file', function () {
        if ($('#button_enviar').hasClass('hide')) {
            $('#button_enviar').removeClass('hide');
        }
        let nombre = $(this).val().split('\\').pop();
        $(this).siblings('label.custom-file-label').text(nombre);
    });
 
});