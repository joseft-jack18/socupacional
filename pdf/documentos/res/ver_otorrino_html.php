
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

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
		<tr>
		    <td style="width:100%; text-align:center" class='midnight-red'>FICHA DE EVALUACIÓN AUDIOMÉTRICA</td>
		</tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
		<tr>
		    <td style="width:100%; text-align:center;" class='clouds' class='midnight-red2'>DATOS DEL PACIENTE</td>
		</tr>
	</table>

    <br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
		<tr>
			<td style="width:45%;" class='midnight-red2'>APELLIDOS Y NOMBRES</td>
			<td style="width:10%;"></td>
			<td style="width:25%;" class='midnight-red2'>DNI</td>
            <td style="width:20%;" class='midnight-red2'>EDAD</td>
		</tr>
		<tr>
            <td style="width:45%;" ><?=$PACIENTE?></td>
			<td style="width:10%;"></td>
			<td style="width:25%;" ><?=$NUM_HC?></td>
            <td style="width:20%;" ><?=$EDAD?></td>
		</tr>
		<tr>
			<td style="width:45%;" class='midnight-red2'>SEXO</td>
			<td style="width:10%;"></td>
			<td style="width:25%;" class='midnight-red2'>FECHA</td>
            <td style="width:20%;" class='midnight-red2'>HORA</td>
		</tr>
		<tr>
            <td style="width:45%;" ><?=$DES_GENERO?></td>
			<td style="width:10%;"></td>
			<td style="width:25%;" ><?=$FEC_ATENCION?></td>
            <td style="width:20%;" ><?=$HORA_ATENCION?></td>
		</tr>
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt;">
		<tr>
		    <td style="width:100%;" class='clouds' class='midnight-red2'>ANTECEDENTES O.R.L.</td>
		</tr>
	</table>

    <br>

	<table cellspacing="0" border="0.1" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
			<td style="width:15%;" class='midnight-red2'></td>
			<td style="width:5%;vertical-align: middle;text-align:center;"class='midnight-red2'>SI</td>
			<td style="width:5%;vertical-align: middle;text-align:center;" class='midnight-red2'>NO</td>
            <td style="width:15%;" class='midnight-red2'></td>
            <td style="width:5%;vertical-align: middle;text-align:center;" class='midnight-red2'>SI</td>
            <td style="width:5%;vertical-align: middle;text-align:center;" class='midnight-red2'>NO</td>
            <td style="width:30%;text-align:center;vertical-align: middle;" class='midnight-red2'>PROTECCIÓN AURICULAR PERSONAL EN ÁREAS DE RUIDO</td>
            <td style="width:20%;text-align:center;" class='midnight-red2'>TIEMPO DE USO: SIEMPRE (A) <br>EN OCASIONES (B) NUNCA (C)</td>
		</tr>
		<tr>
			<td style="width:15%;">&nbsp;OTITIS CRÓNICA</td>
			<td style="width:5%;" class='cuadros'><?=$OTITIS_CRONICA == 1?"X":""?></td>
			<td style="width:5%;" class='cuadros' ><?=$OTITIS_CRONICA != 1?"X":""?></td>
            <td style="width:15%;">&nbsp;PAROTIDITIS</td>
            <td style="width:5%;" class='cuadros'><?=$PAROTIDITIS == 1?"X":""?></td>
            <td style="width:5%;" class='cuadros'><?=$PAROTIDITIS != 1?"X":""?></td>
            <td style="width:30%;">&nbsp;TAMPONES</td>
            <td style="width:20%;" class='cuadros'><?=$TAMPONES?></td>
		</tr>
        <tr>
			<td style="width:15%;">&nbsp;OTOTOXICIDAD</td>
			<td style="width:5%;" class='cuadros'><?=$OTOTOXICIDAD == 1?"X":""?></td>
			<td style="width:5%;" class='cuadros' ><?=$OTOTOXICIDAD != 1?"X":""?></td>
            <td style="width:15%;">&nbsp;SARAMPIÓN</td>
            <td style="width:5%;" class='cuadros'><?=$SARAMPION == 1?"X":""?></td>
            <td style="width:5%;" class='cuadros'><?=$SARAMPION != 1?"X":""?></td>
            <td style="width:30%;">&nbsp;OREJERAS</td>
            <td style="width:20%;" class='cuadros'><?=$OREJERAS?></td>
		</tr>
        <tr>
			<td style="width:15%;">&nbsp;T.E.C.</td>
			<td style="width:5%;" class='cuadros'><?=$TEC == 1?"X":""?></td>
			<td style="width:5%;" class='cuadros' ><?=$TEC != 1?"X":""?></td>
            <td style="width:15%;">&nbsp;AUDIFONOS</td>
            <td style="width:5%;" class='cuadros'><?=$WALKMAN == 1?"X":""?></td>
            <td style="width:5%;" class='cuadros'><?=$WALKMAN != 1?"X":""?></td>
            <td style="width:30%;">&nbsp;ALGODONES</td>
            <td style="width:20%;" class='cuadros'><?=$ALGODONES?></td>
		</tr>
        <tr>
			<td style="width:15%;">&nbsp;MENINGITIS</td>
			<td style="width:5%;" class='cuadros'><?=$MENINGITIS == 1?"X":""?></td>
			<td style="width:5%;" class='cuadros' ><?=$MENINGITIS != 1?"X":""?></td>
            <td style="width:15%;">&nbsp;TRAUMA AUDITIVO</td>
            <td style="width:5%;" class='cuadros'><?=$TRAUMA_AUDITIVO == 1?"X":""?></td>
            <td style="width:5%;" class='cuadros'><?=$TRAUMA_AUDITIVO != 1?"X":""?></td>
            <td style="width:30%;">&nbsp;OTROS</td>
            <td style="width:20%;" class='cuadros'><?=$OTROS?></td>
		</tr>
    </table>

    <br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
			<td style="width:50%;" class='midnight-red2'>OCUPACION</td>
            <td style="width:50%;" class='midnight-red2'>NIVEL DE RUIDO</td>
		</tr>
		<tr>
			<td style="width:50%;"><?=$PUESTO?></td>
            <td style="width:50%;"><?=$NIVEL_RUIDO?></td>
		</tr>
        <tr>
			<td style="width:50%;" class='midnight-red2'>TIEMPO EN EL PUESTO</td>
            <td style="width:50%;" class='midnight-red2'>HORAS DE EXPOSICIÓN</td>
		</tr>
		<tr>
			<td style="width:50%;"><?=""?></td>
            <td style="width:50%;"><?=$HORAS_EXPOSICION?></td> 
		</tr>
    </table>


    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
		    <td style="width:100%;" class='clouds' class='midnight-red2'>SINTOMATOLOGÍA ACTUAL</td>
		</tr>
	</table>

    <br>
    
	<table cellspacing="0" border="0.1" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
			<td style="width:90%;" class='midnight-red2'></td>
			<td style="width:5%;vertical-align: middle;text-align:center;"class='midnight-red2'>SI</td>
			<td style="width:5%;vertical-align: middle;text-align:center;" class='midnight-red2'>NO</td>

		</tr>
		<tr>
			<td style="width:90%;">ACÚFENOS</td>
			<td style="width:5%;" class='cuadros'><?=$ACUFENOS == 1?"X":""?></td>
			<td style="width:5%;" class='cuadros'><?=$ACUFENOS != 1?"X":""?></td>
		</tr>
        <tr>
			<td style="width:90%;">VÉRTIGO</td>
			<td style="width:5%;" class='cuadros'><?=$VERTIGO == 1?"X":""?></td>
			<td style="width:5%;" class='cuadros'><?=$VERTIGO != 1?"X":""?></td>
		</tr>
        <tr>
			<td style="width:90%;">HIPOACUSIA</td>
			<td style="width:5%;" class='cuadros'><?=$HIPOACUSIA == 1?"X":""?></td>
			<td style="width:5%;" class='cuadros'><?=$HIPOACUSIA != 1?"X":""?></td>
		</tr>
        <tr>
			<td style="width:90%;">OTALGIA</td>
			<td style="width:5%;" class='cuadros'><?=$OTALGIA == 1?"X":""?></td>
			<td style="width:5%;" class='cuadros'><?=$OTALGIA != 1?"X":""?></td>
		</tr>
        <tr>
			<td style="width:90%;">EXPOSICIÓN RECIENTE A RUIDO 14 HORAS PREVIAS</td>
			<td style="width:5%;" class='cuadros'><?=$EXPOSICION_RECIENTE == 1?"X":""?></td>
			<td style="width:5%;" class='cuadros'><?=$EXPOSICION_RECIENTE != 1?"X":""?></td>
		</tr>
        <tr>
			<td style="width:90%;">PRÁCTICAS RUIDOSAS: TIRO, FRECUENCIA DE DISCOTECAS</td>
			<td style="width:5%;" class='cuadros'><?=$PRACTICAS_RUIDOSAS == 1?"X":""?></td>
			<td style="width:5%;" class='cuadros'><?=$PRACTICAS_RUIDOSAS != 1?"X":""?></td>
		</tr>
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
		    <td style="width:100%;" class='clouds' class='midnight-red2'>EXAMEN O.R.L.</td>
		</tr>
	</table>

    <br>
    
	<table cellspacing="0" border="0.1" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
			<td style="width:40%;" class='midnight-red2'></td>
			<td style="width:60%;vertical-align: middle;text-align:center;"class='midnight-red2'>ESTADO</td>
		</tr>
        <tr>
			<td style="width:40%;">OÍDO</td>
			<td style="width:60%;" class='cuadros'><?=$OIDO?></td>
		</tr>
        <tr>
			<td style="width:40%;">OTOSCOPÍA OÍDO DERECHO</td>
			<td style="width:60%;" class='cuadros'><?=$OTOSCOPIA_DER?></td>
		</tr>
        <tr>
			<td style="width:40%;">OTOSCOPÍA OÍDO IZQUIERDO</td>
			<td style="width:60%;" class='cuadros'><?=$OTOSCOPIA_IZQ?></td>
		</tr>
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
            <td style="width:100%;" class='clouds' class='midnight-red2'>DIAGNÓSTICO</td>
        </tr>
    </table>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
			<td style="width:100%;"><?=$DIAGNOSTICO?></td>
		</tr>
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
            <td style="width:100%;" class='clouds' class='midnight-red2'>RECOMENDACIONES</td>
        </tr>
    </table>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
            <td style="width:100%;"><?=$RECOMENDACIONES?></td>
        </tr>
    </table>
</page>