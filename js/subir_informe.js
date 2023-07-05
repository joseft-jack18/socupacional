function MensajeGuardar(){
    Swal.fire({
        icon: 'success',
        title: 'Archivos Guardados',
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        onBeforeOpen: () => {      
            timerInterval = setInterval(() => {
                const content = Swal.getContent()
                if (content) {
                    const b = content.querySelector('b')
                    if (b) {
                        b.textContent = Swal.getTimerLeft()
                    }
                }
            }, 100)
        },
        onClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer');
            window.location = 'vista_medico.php';
        }
    });
}

function MensajeError(){
    Swal.fire({
        title: 'Debe cargar un informe',
        icon: 'error',
        confirmButtonText: 'VOLVER'
    });
}

$("#guardar_informe").submit(function(event) {
    $('#guardar_datosinforme').attr("disabled", true);
    
    let parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/Medico/guardar_informe.php",
        data: parametros,
        beforeSend: function(objeto){
            $("#resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function(datos){
            $("#resultados_ajax").html(datos);
            $('#guardar_datosinforme').attr("disabled", false);
            load(1);
        }
    });
    event.preventDefault();
});
