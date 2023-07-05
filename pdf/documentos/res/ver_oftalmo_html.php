<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" style="font-size: 10pt; font-family: arial">
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
		    <td style="width:100%; text-align:center" class='midnight-red'>EVALUACIÓN OFTALMOLÓGICO</td>
		</tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
		    <td style="width:100%; text-align:center;" class='clouds' class='midnight-red2'>DATOS DEL PACIENTE</td>
		</tr>
	</table>

    <br>
   
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
			<td style="width:45%;" class='midnight-red2'>APELLIDOS Y NOMBRES</td>
			<td style="width:10%;"></td>
			<td style="width:25%;" class='midnight-red2'>EDAD</td>
            <td style="width:20%;" class='midnight-red2'>SEXO</td>
		</tr>
		<tr>
            <td style="width:45%;" ><?=$PACIENTE?></td>
			<td style="width:10%;"></td>
			<td style="width:25%;" ><?=$EDAD?></td>
            <td style="width:20%;" ><?=$DES_GENERO?></td>
		</tr>
		<tr>
			<td style="width:45%;" class='midnight-red2'>EMPRESA</td>
			<td style="width:10%;"></td>
			<td colspan="2" class='midnight-red2'>FECHA</td>
		</tr>
		<tr>
            <td style="width:45%;" ><?=$EMPRESA?></td>
			<td style="width:10%;"></td>
			<td colspan="2"><?=$FEC_ATENCION?></td>
		</tr>
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt; padding-bottom: 8px;">
		<tr>
		    <td style="width:100%;" class='clouds' class='midnight-red2'>ANTECEDENTES PERSONALES</td>
		</tr>
	</table>

    <table cellspacing="0" border="0.1" style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
			<td style="width:28%;" class='cuadros'>HIPERTENSIÓN ARTERIAL</td>
			<td style="width:5%;" class='cuadros'><?=$IND_HIPERTEN?></td>
			<td style="width:29%;" class='cuadros'>PTERIGIUM</td>
            <td style="width:5%;"class='cuadros'><?=$IND_PTERIGIUM?></td>
            <td style="width:28%;" class='cuadros'>GLAUCOMA</td>
            <td style="width:5%;" class='cuadros'><?=$IND_GLAUCOMA?></td>
		</tr>  
        <tr>
			<td style="width:28%;" class='cuadros'>DIABETES</td>
			<td style="width:5%;" class='cuadros'><?=$IND_DIABETES?></td>
			<td style="width:29%;" class='cuadros'>CATARATA</td>
            <td style="width:5%;"class='cuadros'><?=$IND_CATARATA?></td>
            <td style="width:28%;" class='cuadros'>TRAUMATISMO OCULAR</td>
            <td style="width:5%;" class='cuadros'><?=$IND_TRAUMA_OCULAR?></td>
		</tr>  
        <tr>
			<td style="width:28%;" class='cuadros'>CORRECTORES OCULARES</td>
			<td style="width:5%;" class='cuadros'><?=$IND_CORRECTOR_OCULAR?></td>
            <td colspan="4" style="vertical-align: middle;">
                <?="&nbsp;OTROS:&nbsp;$IND_OTROS_ANTECEDENTES"?>
            </td>
		</tr>  
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt; padding-bottom: 8px;">
		<tr>
		    <td style="width:100%;" class='clouds' class='midnight-red2'>AGUDEZA VISUAL</td>
		</tr>
	</table>

    <table cellspacing="0" border="0.1" style="width: 100%; text-align: left; font-size: 8pt;">
        <tr>
			<td style="width:20%;" class='cuadros'></td>
			<td colspan="2" class='cuadros'>SIN CORREGIR</td>
            <td colspan="2" class='cuadros'>CORREGIDA</td>
		</tr> 
		<tr>
			<td style="width:20%;" class='cuadros'></td>
			<td style="width:20%;" class='cuadros'>OJO DERECHO</td>
            <td style="width:20%;" class='cuadros'>OJO IZQUIERDO</td>
            <td style="width:20%;" class='cuadros'>OJO DERECHO</td>
            <td style="width:20%;" class='cuadros'>OJO IZQUIERDO</td>
		</tr>  
        <tr>
			<td style="width:20%;" class='cuadros'>VISIÓN DE LEJOS</td>
			<td style="width:20%;" class='cuadros'><?=$VL_SC_OD?></td>
            <td style="width:20%;" class='cuadros'><?=$VL_SC_OI?></td>
            <td style="width:20%;" class='cuadros'><?=$VL_CC_OD?></td>
            <td style="width:20%;" class='cuadros'><?=$VL_CC_OI?></td>
		</tr>  
        <tr>
			<td style="width:20%;" class='cuadros'>VISIÓN DE CERCA</td>
			<td style="width:20%;" class='cuadros'><?=$VC_SC_OD?></td>
            <td style="width:20%;" class='cuadros'><?=$VC_SC_OI?></td>
            <td style="width:20%;" class='cuadros'><?=$VC_CC_OD?></td>
            <td style="width:20%;" class='cuadros'><?=$VC_CC_OI?></td>
		</tr>  
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt; padding-bottom: 8px;">
        <tr>
            <td style="width:100%;" class='clouds' class='midnight-red2'>VISIÓN DE COLORES: TEST DE ISHIHARA</td>
        </tr>
    </table>

    <table cellspacing="0" border="0.1" style="width: 100%; text-align: left; font-size: 8pt;">
		<tr>
            <td style="width:20%;" class='cuadros'>OJO DERECHO</td>
            <td style="width:80%;" class='cuadros'><?=$VISION_COLORES_OD?></td>
		</tr>  
		<tr>
            <td style="width:20%;" class='cuadros'>OJO IZQUIERDO</td>
            <td style="width:80%;" class='cuadros'><?=$VISION_COLORES_OI?></td>
		</tr> 
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt; padding-bottom: 8px;">
        <tr>
            <td style="width:100%;" class='clouds' class='midnight-red2'>ENFERMEDADES OCULARES</td>
        </tr>
    </table>

    <table cellspacing="0" border="0.1" style="width: 100%; text-align: left; font-size: 7pt;"> 
		<tr>
			<td style="width:30%;" class='cuadros'></td>
			<td style="width:10%;" class='cuadros'>O.D.</td>
            <td style="width:10%;" class='cuadros'>O.I.</td>
            <td style="width:30%;" class='cuadros'></td>
            <td style="width:10%;" class='cuadros'>O.D.</td>
            <td style="width:10%;" class='cuadros'>O.I.</td>
		</tr>  
        <tr>
			<td style="width:30%;" class='cuadros'>PTOSIS</td>
			<td style="width:10%;" class='cuadros'><?=$PTOSIS_OD?></td>
            <td style="width:10%;" class='cuadros'><?=$PTOSIS_OI?></td>
            <td style="width:30%;" class='cuadros'>PTERIGIUM</td>
            <td style="width:10%;" class='cuadros'><?=$PTERIGIUM_OD?></td>
            <td style="width:10%;" class='cuadros'><?=$PTERIGIUM_OI?></td>
		</tr> 
        <tr>
			<td style="width:30%;" class='cuadros'>BLEFARITIS</td>
			<td style="width:10%;" class='cuadros'><?=$BLEFARITIS_OD?></td>
            <td style="width:10%;" class='cuadros'><?=$BLEFARITIS_OI?></td>
            <td style="width:30%;" class='cuadros'>CHALAZION</td>
            <td style="width:10%;" class='cuadros'><?=$CHALAZION_OD?></td>
            <td style="width:10%;" class='cuadros'><?=$CHALAZION_OI?></td>
		</tr> 
        <tr>
			<td style="width:30%;" class='cuadros'>DERMATOCALASIA</td>
			<td style="width:10%;" class='cuadros'><?=$DERMATOCALASIA_OD?></td>
            <td style="width:10%;" class='cuadros'><?=$DERMATOCALASIA_OI?></td>
            <td style="width:30%;" class='cuadros'>ESTRABISMO</td>
            <td style="width:10%;" class='cuadros'><?=$ESTRABISMO_OD?></td>
            <td style="width:10%;" class='cuadros'><?=$ESTRABISMO_OI?></td>
		</tr> 
        <tr>
			<td style="width:30%;" class='cuadros'>CONJUNTIVITIS</td>
			<td style="width:10%;" class='cuadros'><?=$CONJUNTIVITIS_OD?></td>
            <td style="width:10%;" class='cuadros'><?=$CONJUNTIVITIS_OI?></td>
            <td style="width:30%;" class='cuadros'>OTROS</td>
            <td colspan="2"><?=$OTROS_ENFERMEDADES?></td>
		</tr> 
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt; padding-bottom: 8px;">
        <tr>
            <td style="width:100%;" class='clouds' class='midnight-red2'>CAMPIMETRÍA POR CONFRONTACIÓN</td>
        </tr>
    </table>

    <table cellspacing="0" border="0.1" style="width: 100%; text-align: left; font-size: 8pt;">
		<tr>
            <td style="width:20%;" class='cuadros'>OJO DERECHO</td>
            <td style="width:80%;" class='cuadros'><?=$CAMPIMETRIA_OD?></td>
		</tr>  
		<tr>
            <td style="width:20%;" class='cuadros'>OJO IZQUIERDO</td>
            <td style="width:80%;" class='cuadros'><?=$CAMPIMETRIA_OI?></td>
		</tr> 
    </table>

    <br>

    <table cellspacing="0"  style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
            <td style="width:100%;" class='midnight-red2'>REFLEJOS PUPILARES</td>
        </tr>  
        <tr>
            <td style="width:100%;" ><?=$REFLEJOS_PUPILARES?></td>
        </tr>
    </table>

    <br>

    <table cellspacing="0"  style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
            <td style="width:100%;" class='midnight-red2'>VISIÓN DE PROFUNDIDAD</td>
        </tr>  
        <tr>
            <td style="width:100%;" ><?=$VISION_PROFUNDIDAD?></td>
        </tr>
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 8pt; padding-bottom: 8px;">
        <tr>
            <td style="width:100%;" class='clouds' class='midnight-red2'>PRESIÓN INTRAOCULAR</td>
        </tr>
    </table>

    <table cellspacing="0" border="0.1" style="width: 100%; text-align: left; font-size: 8pt;">
		<tr>
            <td style="width:20%;" class='cuadros'>OJO DERECHO</td>
            <td style="width:80%;" class='cuadros'><?=$PRESION_OD?></td>
		</tr>  
		<tr>
            <td style="width:20%;" class='cuadros'>OJO IZQUIERDO</td>
            <td style="width:80%;" class='cuadros'><?=$PRESION_OI?></td>
		</tr> 
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
            <td style="width:100%;" class='clouds' class='midnight-red2'>DIAGNÓSTICO</td>
        </tr>
    </table>

    <table cellspacing="0"  style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
            <td style="width:100%;" ><?=$DIAGNOSTICO?></td>
		</tr>  
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
            <td style="width:100%;" class='clouds' class='midnight-red2'>OBSERVACIONES</td>
        </tr>
    </table>

    <table cellspacing="0"  style="width: 100%; text-align: left; font-size: 7pt;">
		<tr>
            <td style="width:100%;" ><?=$OBSERVACIONES?></td>
		</tr>  
    </table>

    <br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 7pt;">
        <tr>
            <td style="width:25%;"><img style="width: 70%;" src="../../<?=$FIRMA_OF?>" alt="Logo"></td>
        </tr>
    </table>
</page>