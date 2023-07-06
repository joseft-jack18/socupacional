$(document).ready(function(){
    load(1);
});

function load(page){
    let sucursal = $('#sucursal').val();
    let fecha1 = $('#fecha_inicio').val();
    let fecha2 = $('#fecha_final').val();

    $("#resultados").fadeIn('slow');
    $.ajax({
        url:'ajax/Medico/vista_medico_action.php?action=ajax&page='+page+'&sucursal='+sucursal
            +'&fecha1='+fecha1+'&fecha2='+fecha2,
        beforeSend: function(objeto){
            $('#resultados').html('<img src="img/ajax-loader.gif"> Cargando...');
        },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#resultados').html('');
        }
    });
}

function atender(cod_atencion, cod_especialidad){
    let sucursal = $('#sucursal').val();
    //LABORATORIO
    if(cod_especialidad == 77){
        window.location = "consulta_laboratorio.php?cod_atencion="+cod_atencion+"&sucursal="+sucursal;
    }
    //OTORRINOLARINGOLOGIA
    else if(cod_especialidad == 44){
        window.location = "consulta_otorrino.php?cod_atencion="+cod_atencion+"&sucursal="+sucursal;
    }
    //OFTALMOLOGIA
    else if(cod_especialidad == 41){
        window.location = "consulta_oftalmologia.php?cod_atencion="+cod_atencion+"&sucursal="+sucursal;
    }
    //PSICOLOGIA
    else if(cod_especialidad == 49){
        window.location = "consulta_psicologia.php?cod_atencion="+cod_atencion+"&sucursal="+sucursal;
    }
    //NEUMOLOGIA
    else if(cod_especialidad == 34){
        window.location = "consulta_neumologia.php?cod_atencion="+cod_atencion+"&sucursal="+sucursal;
    }
    //ODONTOLOGIA
    else if(cod_especialidad == 40){
        window.location = "consulta_odontologia.php?cod_atencion="+cod_atencion+"&sucursal="+sucursal;
    }

    /*//MEDICINA GENERAL
    if(cod_especialidad == 26){
        window.location = 'consulta_mege.php?cod_atencion='+cod_atencion+'&sucursal='+sucursal;
    }
    //MEDICINA OCUPACIONAL
    else if(cod_especialidad == 31){
        window.location = "consulta_socu.php?cod_atencion="+cod_atencion+"&sucursal="+sucursal;
    }
    //OTRAS ESPECIALIDADES
    else {
        window.location = "consulta.php?cod_atencion="+cod_atencion+"&sucursal="+sucursal;
    }*/
}

function ver_historia(cod_atencion, cod_especialidad){
    let sucursal = $('#sucursal').val();
    //OTORRINOLARINGOLOGIA
    if(cod_especialidad == 44){
        VentanaCentrada('pdf/documentos/ver_otorrino.php?cod_atencion='+cod_atencion+
                        '&sucursal='+sucursal,'Historia Ocupacional Otorrino','','1024','768','true');
    }
    //OFTALMOLOGIA
    else if(cod_especialidad == 41){
        VentanaCentrada('pdf/documentos/ver_oftalmo.php?cod_atencion='+cod_atencion
                    +'&sucursal='+sucursal,'Factura','','1024','768','true');
    }
    //PSICOLOGIA
    else if(cod_especialidad == 49){
        VentanaCentrada('pdf/documentos/ver_psicologia.php?cod_atencion='+cod_atencion
                    +'&sucursal='+sucursal,'Factura','','1024','768','true');
    }

    /*//MEDICINA GENERAL
    if(cod_especialidad == 26){
        VentanaCentrada('pdf/documentos/ver_mege.php?cod_atencion='+cod_atencion
                    +'&sucursal='+sucursal,'Factura','','1024','768','true');
    }    
    
    //MEDICINA OCUPACIONAL
    else if(cod_especialidad == 31){
        VentanaCentrada('pdf/documentos/ver_socu.php?cod_atencion='+cod_atencion
                    +'&sucursal='+sucursal,'Factura','','1024','768','true');
    }
    //OTRAS ESPECIALIDADES
    else {
        VentanaCentrada('pdf/documentos/ver_consulta.php?cod_atencion='+cod_atencion
                    +'&sucursal='+sucursal,'Factura','','1024','768','true');
    }*/
}

function subir(cod_atencion){
    let sucursal = $("#sucursal").val();
    window.location = "subir.php?cod_atencion="+cod_atencion+"&sucursal="+sucursal;
}

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
            window.location = 'vista_medico.php';     
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

//------------------------------------------------------------------------------------------------------------------
//-------------------------------------- HISTORIA LABORATORIO ------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
$("#guardar_datos_registro_laboratorio").submit(function( event ) {
    $('#guardar_registro_laboratorio').attr("disabled", true);
    
    let parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/Medico/guardar_consulta_laboratorio.php",
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

//------------------------------------------------------------------------------------------------------------------
//------------------------------------ HISTORIA OTORRINOLARINGOLOGIA -----------------------------------------------
//------------------------------------------------------------------------------------------------------------------
$("#guardar_datos_evaluacion_audiometrica").submit(function( event ) {
    $('#guardar_evaluacion_audiometrica').attr("disabled", true);
    
    let parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/Medico/guardar_consulta_otorrino.php",
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

//------------------------------------------------------------------------------------------------------------------
//-------------------------------------- HISTORIA OFTALMOLOGIA -----------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
$("#guardar_datos_evaluacion_oftalmologica").submit(function( event ) {
    $('#guardar_evaluacion_oftalmologica').attr("disabled", true);
    
    let parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/Medico/guardar_consulta_oftalmologia.php",
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

//------------------------------------------------------------------------------------------------------------------
//-------------------------------------- HISTORIA PSICOLOGIA -------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
$(document).ready(function(){  
    let i = 1;
    
    $('#add_p').click(function(){  
        i++;  
        $('#pruebas_psicologicas').append('<tr id="row'+i+'"><td width="70%"><input type="text" name="pruebas[]" id="pruebas_'+i+'" class="form-control" placeholder="Pruebas Psicológicas"/></td><td width="20%"><input type="text" name="puntaje[]" id="puntaje_'+i+'" placeholder="Puntaje" class="form-control"/></td><td width="10%"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-block btn_remove"><i class="fa fa-minus"></i></button></td></tr>');  
    });  

    $(document).on('click', '.btn_remove', function(){
        let button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove();
    });
});

$("#guardar_datos_informe_psicologico").submit(function( event ) {
    $('#guardar_informe_psicologico').attr("disabled", true);
    
    let parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/Medico/guardar_consulta_psicologia.php",
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

//------------------------------------------------------------------------------------------------------------------
//----------------------------------------- HISTORIA NEUMOLOGIA ----------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
$("#FEV1").keyup(function() {
    let FVC = $("#FVC").val();
    let FEV1 = $("#FEV1").val();
    let FEV1_FVC = FEV1 / FVC * 100;
    $("#FEV1_FVC").val(FEV1_FVC.toFixed(2));      
});

$("#guardar_datos_evaluacion_neumologia").submit(function( event ) {
    $('#guardar_registro_neumologia').attr("disabled", true);
    
    let parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/Medico/guardar_consulta_neumologia.php",
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

//------------------------------------------------------------------------------------------------------------------
//----------------------------------------- HISTORIA ODONTOLOGIA ---------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
$("#guardar_datos_evaluacion_odontologia").submit(function( event ) {
    $('#guardar_registro_odontologia').attr("disabled", true);
    
    let parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/Medico/guardar_consulta_odontologia.php",
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