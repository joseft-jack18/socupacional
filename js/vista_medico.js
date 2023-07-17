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
    //MEDICINA GENERAL
    else if(cod_especialidad == 26){
        window.location = 'consulta_medicina.php?cod_atencion='+cod_atencion+'&sucursal='+sucursal;
    }
    //OTRAS ESPECIALIDADES
    else {
        window.location = "consulta.php?cod_atencion="+cod_atencion+"&sucursal="+sucursal;
    }

    /*
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

//------------------------------------------------------------------------------------------------------------------
//----------------------------------------- HISTORIA CLINICA NORMAL ------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
$(document).ready(function(){
    cargar_diagnosticos(1);
    cargar_diagnosticos(2);
    cargar_plan(1);
    cargar_plan(2);
    cargar_plan(3);
    cargar_interconsulta();
    cargar_tratamiento();
});

function showContent_ap() {
    checkbox11 = document.getElementById("checkbox11");
    ap = document.getElementById("ap");
    ap_v = document.getElementById("ap_v");
  
    if (checkbox11.checked) {
        ap_v.style.display = 'block';
        ap.style.display = 'none';
    } else {
        ap_v.style.display = 'none';
        ap.style.display = 'block';
    }
}
  
function showContent_aa() {
    checkbox12 = document.getElementById("checkbox12");
    aa = document.getElementById("aa");
    aa_v = document.getElementById("aa_v");
  
    if (checkbox12.checked) {
        aa_v.style.display = 'block';
        aa.style.display = 'none';
    } else {
        aa_v.style.display = 'none';
        aa.style.display = 'block';
    }
}
  
function showContent_af() {
    checkbox13 = document.getElementById("checkbox13");
    af = document.getElementById("af");
    af_v = document.getElementById("af_v");
  
    if (checkbox13.checked) {
        af_v.style.display = 'block';
        af.style.display = 'none';
    } else {
        af_v.style.display = 'none';
        af.style.display = 'block';
    }
}

//DIAGNOSTICOS
$(document).ready(function(){
    let sucursal = $('#sucursal').val();
    let cod_atencion = $('#cod_atencion').val();

    $("#d_presuntivo").autocomplete({
        source: "ajax/autocomplete/diagnosticos.php?sucursal="+sucursal,
        minLength: 2,
        select: function(event, ui) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "ajax/Medico/guardar_diagnostico.php",
                data: {
                    sucursal: sucursal,
                    cod_atencion: cod_atencion,
                    cod_diagnostico: ui.item.cod_diagnostico,
                    tipo: 1
                },         
                success: function(resp){
                    console.log(resp);
                    $('#d_presuntivo').val("");
                    cargar_diagnosticos(1);
                }  
            });       
        }
    });

    $("#d_definitivo").autocomplete({
        source: "ajax/autocomplete/diagnosticos.php?sucursal="+sucursal,
        minLength: 2,
        select: function(event, ui) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "ajax/Medico/guardar_diagnostico.php",
                data: {
                    sucursal: sucursal,
                    cod_atencion: cod_atencion,
                    cod_diagnostico: ui.item.cod_diagnostico,
                    tipo: 2
                },         
                success: function(resp){
                    console.log(resp);
                    $('#d_definitivo').val("");
                    cargar_diagnosticos(2);
                }  
            });       
        }
    });
});

function cargar_diagnosticos(tipo){
    let sucursal = $('#sucursal').val();
    let cod_atencion = $('#cod_atencion').val();

    $.post("ajax/Medico/cargar_diagnosticos.php", { sucursal: sucursal, cod_atencion: cod_atencion, tipo: tipo }, function(data){
        if(tipo == 1){
            $("#diagnosticos_presuntivos").html(data);
        } else {
            $("#diagnosticos_definitivos").html(data);
        }        
    });
}

function quitar_diagnostico(id){
    let sucursal = $('#sucursal').val();
    $.ajax({
        type: "POST",
        url: "ajax/Medico/quitar_diagnostico.php",
        data: {
            sucursal: sucursal,
            id: id
        },         
        success: function(resp){
            console.log(resp);
            cargar_diagnosticos(1);
            cargar_diagnosticos(2);
        }  
    });  
}

//PLAN DE TRABAJO
$(document).ready(function(){
    let sucursal = $('#sucursal').val();
    let cod_atencion = $('#cod_atencion').val();

    $("#examen_laboratorio").autocomplete({
        source: "ajax/autocomplete/laboratorio.php?sucursal="+sucursal,
        minLength: 2,
        select: function(event, ui) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "ajax/Medico/guardar_plan.php",
                data: {
                    sucursal: sucursal,
                    cod_atencion: cod_atencion,
                    cod_articulo: ui.item.cod_articulo_serv,
                    tipo: 2
                },         
                success: function(resp){
                    console.log(resp);
                    $('#examen_laboratorio').val("");
                    cargar_plan(2);
                }  
            });       
        }
    });

    $("#examen_radiologico").autocomplete({
        source: "ajax/autocomplete/radiologia.php?sucursal="+sucursal,
        minLength: 2,
        select: function(event, ui) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "ajax/Medico/guardar_plan.php",
                data: {
                    sucursal: sucursal,
                    cod_atencion: cod_atencion,
                    cod_articulo: ui.item.cod_articulo_serv,
                    tipo: 3
                },         
                success: function(resp){
                    console.log(resp);
                    $('#examen_radiologico').val("");
                    cargar_plan(3);
                }  
            });       
        }
    });

    $("#procedimiento_especial").autocomplete({
        source: "ajax/autocomplete/procedimiento.php?sucursal="+sucursal,
        minLength: 2,
        select: function(event, ui) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "ajax/Medico/guardar_plan.php",
                data: {
                    sucursal: sucursal,
                    cod_atencion: cod_atencion,
                    cod_articulo: ui.item.cod_articulo_serv,
                    tipo: 1
                },         
                success: function(resp){
                    console.log(resp);
                    $('#procedimiento_especial').val("");
                    cargar_plan(1);
                }  
            });       
        }
    });
});

function cargar_plan(tipo){
    let sucursal = $('#sucursal').val();
    let cod_atencion = $('#cod_atencion').val();

    $.post("ajax/Medico/cargar_plan.php", { sucursal: sucursal, cod_atencion: cod_atencion, tipo: tipo }, function(data){
        if(tipo == 1){
            $("#procedimientos_especiales").html(data);
        } else if(tipo == 2) {
            $("#examenes_laboratorio").html(data);
        } else if(tipo == 3) {
            $("#examenes_radiologicos").html(data);
        }
    });
}

function quitar_plan(id){
    let sucursal = $('#sucursal').val();
    $.ajax({
        type: "POST",
        url: "ajax/Medico/quitar_plan.php",
        data: {
            sucursal: sucursal,
            id: id
        },         
        success: function(resp){
            console.log(resp);
            cargar_plan(1);
            cargar_plan(2);
            cargar_plan(3);
        }  
    });  
}

//INTERCONSULTAS
$(document).ready(function(){
    let sucursal = $('#sucursal').val();
    let cod_atencion = $('#cod_atencion').val();

    $("#interconsulta").autocomplete({
        source: "ajax/autocomplete/interconsulta.php?sucursal="+sucursal,
        minLength: 2,
        select: function(event, ui) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "ajax/Medico/guardar_interconsulta.php",
                data: {
                    sucursal: sucursal,
                    cod_atencion: cod_atencion,
                    cod_especialidad: ui.item.cod_especialidad
                },         
                success: function(resp){
                    console.log(resp);
                    $('#interconsulta').val("");
                    cargar_interconsulta();
                }  
            });       
        }
    });
});

function cargar_interconsulta(){
    let sucursal = $('#sucursal').val();
    let cod_atencion = $('#cod_atencion').val();

    $.post("ajax/Medico/cargar_interconsulta.php", { sucursal: sucursal, cod_atencion: cod_atencion }, function(data){
        $("#interconsultas").html(data);
    });
}

function quitar_interconsulta(id){
    let sucursal = $('#sucursal').val();
    $.ajax({
        type: "POST",
        url: "ajax/Medico/quitar_interconsulta.php",
        data: {
            sucursal: sucursal,
            id: id
        },         
        success: function(resp){
            console.log(resp);
            cargar_interconsulta();
        }  
    });  
}

//TRATAMIENTO
$(document).ready(function(){
    let sucursal = $('#sucursal').val();

    $("#medicamento").autocomplete({
        source: "ajax/autocomplete/medicamentos.php?sucursal="+sucursal,
        minLength: 2,
        select: function(event, ui) {
            event.preventDefault();
            $('#medicamento').val(ui.item.cod_articulo_serv+' | '+ui.item.des_articulo_serv);
        }
    });
});

function guardar_tratamiento(){
    let sucursal = $('#sucursal').val();
    let cod_atencion = $('#cod_atencion').val();
    let medicamento = $('#medicamento').val();
    let forma = $('#forma').val();
    let dosis = $('#dosis').val();
    let cantidad = $('#cantidad').val();

    $.ajax({
        type: "POST",
        url: "ajax/Medico/guardar_tratamiento.php",
        data: {
            sucursal: sucursal,
            cod_atencion: cod_atencion,
            medicamento: medicamento,
            forma: forma,
            dosis: dosis,
            cantidad: cantidad
        },         
        success: function(resp){
            console.log(resp);
            $('#dosis').val("");
            $('#forma').val("");
            $('#medicamento').val("");
            $('#cantidad').val("");
            cargar_tratamiento();
        }  
    });
}

function cargar_tratamiento(){
    let sucursal = $('#sucursal').val();
    let cod_atencion = $('#cod_atencion').val();

    $.post("ajax/Medico/cargar_tratamiento.php", { sucursal: sucursal, cod_atencion: cod_atencion }, function(data){
        $("#tratamientos").html(data);
    });
}

function quitar_tratamiento(id){
    let sucursal = $('#sucursal').val();
    $.ajax({
        type: "POST",
        url: "ajax/Medico/quitar_tratamiento.php",
        data: {
            sucursal: sucursal,
            id: id
        },         
        success: function(resp){
            console.log(resp);
            cargar_tratamiento();
        }  
    });  
}

$("#guardar_consulta").submit(function( event ) {
    //$('#guardar_datos').attr("disabled", true);
    
    let parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/Medico/guardar_consulta.php",
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