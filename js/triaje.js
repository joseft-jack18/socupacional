$(document).ready(function(){
    load(1);
});

function load(page){
    let sucursal = $("#sucursal").val();
    let fecha1 = $("#fecha1").val();
    let fecha2 = $("#fecha2").val();

    $("#resultados").fadeIn('slow');
    $.ajax({
        url:'ajax/TRIAJE/triaje_action.php?action=ajax&page='+page+'&fecha1='+fecha1+'&fecha2='+fecha2
            +'&sucursal='+sucursal,
        beforeSend: function(objeto){
            $('#resultados').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#resultados').html('');
        }
    })
}

$("#talla").keyup(function() {
    let peso = $("#peso").val();
    let talla = $("#talla").val();
    let imc = (peso/(talla * talla));
    $("#imc").val(imc.toFixed(2));      
});

$("#cadera").keyup(function() {
    let cintura = $("#cintura").val();
    let cadera = $("#cadera").val();
    let icc = cintura / cadera;
    $("#icc").val(icc.toFixed(2));      
});

$("#guardar_triaje").submit(function( event ) {
    $('#guardar_datos_triaje').attr("disabled", true);
  
    let parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/Triaje/guardar_triaje.php",
        data: parametros,
        beforeSend: function(objeto){
            $("#resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function(datos){
            $("#resultados_ajax").html(datos);
            $('#guardar_datos').attr("disabled", false);
        }
    });
    event.preventDefault();
});

function MensajeGuardar(){
    Swal.fire({    
        icon: 'success',
        title: 'Datos Registrados',
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
            window.location = 'triaje.php';     
        }    
    })
}

function MensajeError(){
    Swal.fire({
        title: 'ERROR AL GUARDAR LOS DATOS',
        icon: 'error',
        confirmButtonText: 'VOLVER'
    })
}