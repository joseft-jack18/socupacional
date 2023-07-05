<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" style="font-size: 12pt; font-family: arial" >
    <table cellspacing="0" style="width: 100%;">
        <tr>
            <td style="width: 20%; color: #444444;">
                <img style="width: 100%;" src="../../images/logo2.png" alt="Logo">
                <br>                
            </td>
			<td style="width: 100%;  padding-left:25px; color: #252525;font-size:12px;text-align:left">
                <br>
				Av.Manuel A. Odría 702 
                <br>
                www.clinicalaluz.pe
            </td>
        </tr>
    </table>

    <br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
		    <td style="width:100%; text-align:center" class='midnight-red'>INFORME PSICOLÓGICO</td>
		</tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
		    <td style="width:100%; text-align:center; " class='clouds' class='midnight-red2'>DATOS DEL PACIENTE</td>
		</tr>
	</table>

    <br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
			<td style="width:45%;" class='midnight-red2'>APELLIDOS Y NOMBRES</td>
			<td style="width:10%;"></td>
			<td style="width:25%;" class='midnight-red2'>FECHA DE NACIMIENTO</td>
            <td style="width:20%;" class='midnight-red2'>EDAD</td>
		</tr>
		<tr>
			<td style="width:45%;"><?=$PACIENTE?></td>
			<td style="width:10%;"></td>
            <td style="width:25%;"><?=$FEC_NACIMIENTO?></td>
			<td style="width:20%;"><?=$EDAD?> AÑOS</td>
		</tr>
    </table>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
			<td style="width:45%;" class='midnight-red2'>GRADO DE INSTRUCCIÓN</td>
			<td style="width:10%;"></td>
			<td style="width:45%;" class='midnight-red2'>PUESTO DE TRABAJO</td>
		</tr>
		<tr>
			<td style="width:45%;"><?=$GRADO_INSTRUCCION?></td>
			<td style="width:10%;"></td>
			<td style="width:45%;"><?=$PUESTO?></td>
		</tr>
		<tr>
			<td style="width:45%;" class='midnight-red2'>EMPRESA</td>
			<td style="width:10%;"></td>
			<td style="width:45%;" class='midnight-red2'>FECHA DE EVALUACIÓN</td>
		</tr>
        <tr>
			<td style="width:45%;"><?=$EMPRESA?></td>
			<td style="width:10%;"></td>
			<td style="width:45%;"><?=$FEC_ATENCION?></td>
		</tr>
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
		    <td style="width:100%;" class='clouds' class='midnight-red2'>MOTIVO DE EVALUACIÓN</td>
		</tr>
		<tr>
			<td style="width:100%;"><?=$TIPO_EMO?></td>
		</tr>
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
		    <td style="width:100%;" class='clouds' class='midnight-red2'>ACCIDENTES Y ENFERMEDADES</td>
		</tr>
		<tr>
			<td style="width:100%;"><?=$ACCIDENTES_ENFERMEDADES?></td>
		</tr>
    </table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
		    <td style="width:100%;" class='clouds' class='midnight-red2'>HÁBITOS</td>
		</tr>
		<tr>
			<td style="width:100%;"><?=$HABITOS?></td>
		</tr>
    </table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
		    <td style="width:100%;" class='clouds' class='midnight-red2'>OTRAS OBSERVACIONES</td>
		</tr>
		<tr>
			<td style="width:100%;"><?=$OTRAS_OBSERVACIONES?></td>
		</tr>
    </table>

	<br>	

	<table cellspacing="0" style="width: 100%; text-align: center; font-size: 7pt;">
		<tr>
		    <td style="width:100%;" class='clouds' class='midnight-red2'>OBSERVACIÓN DE CONDUCTAS</td>
		</tr>
	</table>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
			<td style="width:33.3%;" class='midnight-red2'>DISCURSO RITMO</td>
            <td style="width:33.3%;" class='midnight-red2'>DISCURSO TONO</td>
            <td style="width:33.3%;" class='midnight-red2'>DISCURSO ARTICULACIÓN</td>
		</tr>
        <tr>
            <td style="width:33.3%;" ><?=$DISCURSO_RITMO?></td>
            <td style="width:33.3%;" ><?=$DISCURSO_TONO?></td>
            <td style="width:33.3%;" ><?=$DISCURSO_ARTICULACION?></td>
		</tr>
        <tr>
			<td style="width:33.3%;" class='midnight-red2'>ORIENTACIÓN TIEMPO</td>
            <td style="width:33.3%;" class='midnight-red2'>ORIENTACIÓN ESPACIO</td>
            <td style="width:33.3%;" class='midnight-red2'>ORIENTACIÓN PERSONA</td>
		</tr>
        <tr>
            <td style="width:33.3%;" ><?=$ORIENTACION_TIEMPO?></td>
            <td style="width:33.3%;" ><?=$ORIENTACION_ESPACIO?></td>
            <td style="width:33.3%;" ><?=$ORIENTACION_PERSONA?></td>
		</tr>

		<tr>
			<td style="width:33.3%;" class='midnight-red2'>PRESENTACIÓN</td>
            <td style="width:33.3%;" class='midnight-red2'>POSTURA</td>
            <td style="width:33.3%;"></td>
		</tr>
        <tr>
            <td style="width:33.3%;" ><?=$PRESENTACION?></td>
            <td style="width:33.3%;" ><?=$POSTURA?></td>
            <td style="width:33.3%;" ></td>
		</tr>

	</table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 7pt;">
		<tr>
		    <td style="width:100%;" class='clouds' class='midnight-red2'>PROCESOS COGNITIVOS</td>
		</tr>
	</table>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
			<td style="width:25%;" class='midnight-red2'>LUCIDO,ATENTO</td>
            <td style="width:25%;" class='midnight-red2'>PENSAMIENTO</td>
            <td style="width:25%;" class='midnight-red2'>PERCEPCION</td>
			<td style="width:25%;" class='midnight-red2'>MEMORIA</td>
		</tr>
        <tr>
            <td style="width:25%;" ><?=$LUCIDO_ATENTO?></td>
            <td style="width:25%;" ><?=$PENSAMIENTO?></td>
            <td style="width:25%;" ><?=$PERCEPCION?></td>
			<td style="width:25%;" ><?=$NIVEL_MEMORIA?></td>
		</tr>
        <tr>
			<td style="width:25%;" class='midnight-red2'>INTELIGENCIA</td>
            <td style="width:25%;" class='midnight-red2'>APETITO</td>
            <td style="width:25%;" class='midnight-red2'>SUEÑO</td>
			<td style="width:25%;" class='midnight-red2'>PERSONALIDAD</td>
		</tr>
        <tr>
            <td style="width:25%;" ><?=$INTELIGENCIA?></td>
            <td style="width:25%;" ><?=$APETITO?></td>
            <td style="width:25%;" ><?=$SUENO?></td>
			<td style="width:25%;" ><?=$PERSONALIDAD?></td>
		</tr>
        <tr>
			<td style="width:25%;" class='midnight-red2'>AFECTIVIDAD</td>
            <td style="width:25%;" class='midnight-red2'>CONDUCTA_SEXUAL</td>
            <td style="width:25%;" ></td>
			<td style="width:25%;" ></td>
		</tr>
        <tr>
            <td style="width:25%;" ><?=$AFECTIVIDAD?></td>
            <td style="width:25%;" ><?=$CONDUCTA_SEXUAL?></td>
            <td style="width:25%;" ></td>
			<td style="width:25%;" ></td>
		</tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: center; font-size: 7pt;">
		<tr>
		    <td style="width:100%;" class='clouds' class='midnight-red2'>PROCESOS COGNITIVOS</td>
		</tr>
	</table>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
			<td style="width:80%;" class='midnight-red2'>PRUEBAS PSICOLÓGICAS</td>
            <td style="width:20%;" class='midnight-red2'>PUNTAJE</td>

		</tr>
		<?php while($row_pruebas = sqlsrv_fetch_array($res_pruebas)){
		    $PUNTAJE = strtoupper($row_pruebas["PUNTAJES"]);
		    $PRUEBAS = strtoupper($row_pruebas["PRUEBAS"]);
		?>
        <tr>
            <td style="width:80%;" ><?=$PRUEBAS?></td>
            <td style="width:20%;" ><?=$PUNTAJE?></td>
		</tr>
		<?php } ?>
	</table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 7pt;">
		<tr>
		    <td style="width:100%;" class='clouds' class='midnight-red2'>CONCLUSIONES</td>
		</tr>
	</table>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
			<td style="width:100%;" class='midnight-red2'>ÁREA COGNITIVA</td>
		</tr>
        <tr>
            <td style="width:100%; text-align: justify;"><?=$AREA_COGNITIVA?></td>
		</tr>
        <tr>
			<td style="width:100%;" class='midnight-red2'>ÁREA EMOCIONAL</td>
		</tr>
        <tr>
            <td style="width:100%; text-align: justify;"><?=$AREA_EMOCIONAL?></td>
		</tr>
	</table>

	<br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
            <td style="width:100%; " class='clouds' class='midnight-red2'>RESULTADO</td>
        </tr>
    </table>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
            <td style="width:100%;"><?=$RESULTADO?></td>
        </tr>
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
            <td style="width:21%;">
                <img style="width: 100%;" src="../../<?=$FIRMA_PS?>" alt="Logo">
            </td>
        </tr>
    </table>
</page>