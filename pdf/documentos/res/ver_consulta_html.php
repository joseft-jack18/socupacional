
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

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<tr>
		    <td style="width:100%; text-align:center" class='midnight-red'>HISTORIA CLÍNICA - CONSULTA EXTERNA</td>
		</tr>
	</table>

	<br> 

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<tr>
		    <td style="width:100%; text-align:center;" class='clouds' class='midnight-red2'>DATOS DEL PACIENTE</td>
		</tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
		<tr>
			<td style="width: 45%;" class='midnight-red2'>PACIENTE</td>
			<td style="width: 10%;"></td>
			<td style="width: 25%;" class='midnight-red2'>N° HISTORIA</td>
			<td style="width: 20%;" class='midnight-red2'>EDAD</td>
		</tr>
		<tr>
			<td style="width: 45%;"><?=$PACIENTE?></td>
			<td style="width: 10%;"></td>
			<td style="width: 25%;"><?=$NUM_HC?></td>
			<td style="width: 20%;"><?=$EDAD?> AÑOS</td>
		</tr>
		<tr>
			<td style="width: 45%;" class='midnight-red2'>MÉDICO</td>
			<td style="width: 10%;"></td>
			<td style="width: 25%;" class='midnight-red2'>CMP</td>
			<td style="width: 20%;" class='midnight-red2'>RNE</td>
		</tr>
		<tr>
			<td style="width: 45%;"><?=$MEDICO?></td>
			<td style="width: 10%;"></td>
			<td style="width: 25%;"><?=$NUM_CMP?></td>
			<td style="width: 20%;"><?=$NUM_RNE?></td>
		</tr>  
		<tr>
			<td style="width: 45%;" class='midnight-red2'>SERVICIO</td>
			<td style="width: 10%;"></td>
			<td style="width: 25%;" class='midnight-red2'>ATENCIÓN</td>
			<td style="width: 20%;" class='midnight-red2'>TIPO</td>
		</tr>
		<tr>
			<td style="width: 45%;"><?=$ESPECIALIDAD?></td>
			<td style="width: 10%;"></td>
			<td style="width: 25%;"><?=$FEC_ATENCION." ".$HOR_ATENCION?></td>
			<td style="width: 20%;">PARTICULAR</td>
		</tr>      
    </table>

	<br>
	
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
	    <tr>
	        <td style="width:100%; text-align:center;" class='midnight-red2'>ENFERMEDAD ACTUAL</td>
	    </tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
		<tr>
		    <td colspan="1" class='clouds midnight-red2'>TIEMPO</td>
		    <td colspan="4" class='clouds midnight-red2'>MOTIVO DE LA CONSULTA</td>
		</tr>
		<tr>
		    <td colspan="1"><?=$DES_TIEMPO_ENF?></td>
		    <td colspan="4"><?=$DES_MOTIVO_CONS?></td>
		</tr>
		<tr>
		    <td colspan="5" class='clouds midnight-red2'>SIGNOS Y SÍNTOMAS PRINCIPALES</td>	
		</tr>
		<tr>
		    <td colspan="5"><?=$DES_FUNCIONES?></td>
		</tr>
		<tr>
		    <td style="width:20%" class='clouds midnight-red2'>RITMO URINARIO</td>
		    <td style="width:20%" class='clouds midnight-red2'>RITMO EVACUATORIO</td>
		    <td style="width:20%" class='clouds midnight-red2'>SED</td>
		    <td style="width:20%" class='clouds midnight-red2'>APETITO</td>
		    <td style="width:20%" class='clouds midnight-red2'>SUEÑO</td>
		</tr>		
		<tr>
		    <td style="width:20%;text-align: left;"><?=$DES_RITMO_URINARIO?></td>
		    <td style="width:20%;text-align: left;"><?=$DES_RITMO_EVACUA?></td>
		    <td style="width:20%;text-align: left;"><?=$DES_SED?></td>
		    <td style="width:20%;text-align: left;"><?=$DES_APETITO?></td>		
		    <td style="width:20%;text-align: left;"><?=$DES_SUENO?></td>
		</tr>	
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
	    <tr>
	        <td style="width:100%; text-align:center;" class='midnight-red2'>ANTECEDENTES</td>
	    </tr>
	</table>
	<br>
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
		<tr >
		    <td style="width: 100%;" class='clouds midnight-red2'>ANTECEDENTES PERSONALES</td>
		</tr>
		<tr>
		    <td style="width: 100%; text-align: left;"><?=$DES_ALER_CIRU?></td>
		</tr>
		<tr >
		    <td style="width: 100%;" class='clouds midnight-red2'>ANTECEDENTES ALERGIAS</td>
		</tr>
		<tr>
		    <td style="width: 100%; text-align: left;"><?=$DES_ANTE_ALERGIAS?></td>
		</tr>
		<tr >
		    <td style="width: 100%;" class='clouds midnight-red2'>ANTECEDENTES FAMILIARES</td>
		</tr>
		<tr>
		    <td style="width: 100%; text-align: left;"><?=$DES_ANTE_FAMILIARES?></td>
		</tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
	    <tr>
	        <td style="width:100%;text-align:center;" class='midnight-red2'>EXAMEN FÍSICO</td>
	    </tr>
	</table>

	<br>

	<table  cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
        <tr >
            <td colspan="2" class='clouds midnight-red2'>FRECUENCIA RESPIRATORIA </td>
            <td colspan="1" class='clouds midnight-red2'>FRECUENCIA CARDÍACA</td>
            <td colspan="1" class='clouds midnight-red2'>PRESIÓN ARTERIAL</td>
        </tr>
        <tr>
            <td colspan="2"><?=$DES_FRE_RESPIRA?> (POR MINUTO)</td>
            <td colspan="1"><?=$DES_FRE_CARDIACA?> (POR MINUTO)</td>
            <td colspan="1"><?=$DES_PRESION_ARTERIAL?> (MMHG)</td>
        </tr>
        <tr>
            <td style="width:25%" class='clouds midnight-red2'>TEMPERATURA</td>
            <td style="width:25%" class='clouds midnight-red2'>PESO</td>
            <td style="width:25%" class='clouds midnight-red2'>TALLA</td>
            <td style="width:25%" class='clouds midnight-red2'>IMC</td>
        </tr>
        <tr>
            <td style="width:25%"><?=$DES_TEMPERATURA?> °C</td>
            <td style="width:25%"><?=$DES_PESO?> kg</td>
            <td style="width:25%"><?=$DES_TALLA?> m</td>
            <td style="width:25%"><?=$DES_IMC?></td>	
        </tr>	
	    <tr>
	        <td colspan="4" class='clouds midnight-red2'>EXAMEN GENERAL</td>
	    </tr>
        <tr>
            <td colspan="4"><?=$DES_EXAMEN_GENERAL?></td>
        </tr>
        <tr>
            <td colspan="4" class='clouds midnight-red2'>EXAMEN PREFERENCIAL</td>
        </tr>
        <tr>
            <td colspan="4"><?=$DES_EXAMEN_PREFERENTE?></td>
        </tr>
	</table>

    <br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
		<tr>
			<td style="width:100%;text-align:center;" class='midnight-red2'>DIAGNÓSTICO</td>
		</tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
		<?php while ($row_dia = sqlsrv_fetch_array($res_dia)){
			$COD_DIAGNOSTICO = $row_dia['COD_DIAGNOSTICO'];
			$DES_DIAGNOSTICO = $row_dia['DES_DIAGNOSTICO'];
			$tipo = $row_dia['tipo'];
			if($tipo == 1){
		?>
		<tr>
			<td style="width: 10%;" class='clouds midnight-red2'>CIE10</td>
			<td style="width: 90%;" class='clouds midnight-red2'>DIAGNÓSTICO PRESUNTIVO</td>
		</tr>
		<tr>
			<td style="width: 10%; text-align: left;"><?=$COD_DIAGNOSTICO?></td>
			<td style="width: 90%; text-align: left;"><?=$DES_DIAGNOSTICO?></td>
		</tr>
		<?php } else if($tipo == 2){ ?>
		<tr>
			<td style="width: 10%;" class='clouds midnight-red2'>CIE10</td>
			<td style="width: 90%;" class='clouds midnight-red2'>DIAGNÓSTICO DEFINITIVO</td>
		</tr>
		<tr>
			<td style="width: 10%; text-align: left;"><?=$COD_DIAGNOSTICO?></td>
			<td style="width: 90%; text-align: left;"><?=$DES_DIAGNOSTICO?></td>
		</tr>
		<?php }} ?>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
	    <tr>
	        <td style="width:100%; text-align:center;" class='midnight-red2'>PLAN DE TRABAJO</td>
	    </tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
		<?php while ($row_pla = sqlsrv_fetch_array($res_pla)){
			    $DES_ARTICULO_SERV = $row_pla['DES_ARTICULO_SERV'];
			    $cod_proveedor = $row_pla['cod_proveedor'];
				if($cod_proveedor == 2){
		?>
	    <tr>
	        <td colspan="4" class='clouds midnight-red2'>EXÁMENES DE LABORATORIO</td>
	    </tr>
	    <tr>	
	        <td style="width: 80%; text-align: left;"><?=$DES_ARTICULO_SERV?></td>
	    </tr>
	    <?php } else if($cod_proveedor == 1){ ?>
		<tr>
	        <td colspan="4" class='clouds midnight-red2'>PROCEDIMIENTOS ESPECIALES</td>
	    </tr>
	    <tr>	
	        <td style="width: 80%; text-align: left;"><?=$DES_ARTICULO_SERV?></td>
	    </tr>	    
        <?php } else if($cod_proveedor == 3){ ?>
		<tr>
	        <td colspan="4" class='clouds midnight-red2'>EXÁMENES RADIOLÓGICOS</td>
	    </tr>
	    <tr>
	        <td style="width: 80%; text-align: left;"><?=$DES_ARTICULO_SERV?></td>
	    </tr>	    
        <?php }} ?>
		<?php while ($row_int = sqlsrv_fetch_array($res_int)){
			    $DES_ESPECIALIDAD = $row_int['DES_ESPECIALIDAD'];
		?>
	    <tr>
	        <td colspan="4" class='clouds midnight-red2'>INTERCONSULTA</td>
	    </tr>
	    <tr>
	        <td style="width: 100%; text-align: left;"><?=$DES_ESPECIALIDAD?></td>
	    </tr>
	    <?php } ?>	
    </table>

	<br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
	    <tr>
	        <td style="width:100%; text-align:center;" class='midnight-red2'>TRATAMIENTO</td>
	    </tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
	    <?php while($row_tra = sqlsrv_fetch_array($res_tra)){
	    		$nombre_medicamento = strtoupper($row_tra["nombre_medicamento"]);
	    		$forma = strtoupper($row_tra["forma"]);
	    		$dosis = strtoupper($row_tra["dosis"]);
	    		$cantidad = $row_tra["cantidad"];		
	    ?>    
	    <tr>
	        <td style="width: 75%;" class='clouds midnight-red2'>NOMBRE DE MEDICAMENTO</td>
	        <td style="width: 25%;" class='clouds midnight-red2'>FORMA</td>	
	    </tr>
	    <tr>	
	        <td style="width: 75%;"><?=$nombre_medicamento?></td>
	        <td style="width: 25%;"><?=$forma?></td>	
	    </tr>
	    <tr >
	        <td style="width: 75%;" class='clouds midnight-red2'>DOSIS</td>
	        <td style="width: 25%;" class='clouds midnight-red2'>CANTIDAD</td>	
	    </tr>
	    <tr>
	        <td style="width: 75%;"><?=$dosis?></td>
	        <td style="width: 25%;"><?=$cantidad?></td>	
	    </tr>
        <?php } ?>
    </table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
		<tr>
			<td style="width: 100%;" class='clouds midnight-red2'>MEDIDAS HIGIÉNICO DIETÉTICAS</td>
		</tr>
		<tr>
			<td style="width: 100%;"><?=$MEDIDAS_HIGIENICAS?></td>
		</tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
	    <tr>
	        <td style="width:100%;text-align:center;" class='midnight-red2'>OBSERVACIONES</td>
	    </tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
	    <tr>
	        <td style="width: 75%;" class='clouds midnight-red2'>OBSERVACIÓN</td>
	        <td style="width: 25%;" class='clouds midnight-red2'>PRÓXIMA CITA</td>                
	    </tr>
	    <tr>                
	        <td style="width: 75%;"><?=$DES_OBSERVACIONES?></td>
	        <td style="width: 25%;"></td>
        </tr>
	</table>
</page>


