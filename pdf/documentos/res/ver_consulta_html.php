
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
	
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
	    <tr>
	        <td style="width:100%; text-align:center;" class='midnight-red2'>ENFERMEDAD ACTUAL</td>
	    </tr>
	</table>
	<br>
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<tr>
		    <td colspan="1" class='clouds' class='midnight-red2'>TIEMPO</td>
		    <td colspan="4" class='clouds' class='midnight-red2'>MOTIVO DE LA CONSULTA</td>
		</tr>
		<tr>
		    <td colspan="1"><?php echo strtoupper($t_enfermedad); ?></td>
		    <td colspan="4"><?php echo strtoupper($motivo); ?></td>
		</tr>
		<tr>
		    <td colspan="5" class='clouds' class='midnight-red2'>SIGNOS Y SÍNTOMAS PRINCIPALES</td>	
		</tr>
		<tr>
		    <td colspan="5"><?php echo strtoupper($des_funciones); ?></td>
		</tr>

		<tr>
		    <td style="width:20%" class='clouds' class='midnight-red2'>RITMO URINARIO</td>
		    <td style="width:20%" class='clouds' class='midnight-red2'>RITMO EVACUATORIO</td>
		    <td style="width:20%" class='clouds' class='midnight-red2'>SED</td>
		    <td style="width:20%" class='clouds' class='midnight-red2'>APETITO</td>
		    <td style="width:20%" class='clouds' class='midnight-red2'>SUEÑO</td>
		</tr>		
		<tr>
		    <td style="width:20%;text-align: left;">
			<?php 
				if ($r_urinario==1 || $r_urinario== "DISMINUIDO"){echo "DISMINUIDO";}
				elseif ($r_urinario== 2 || $r_urinario== "NORMAL" ){echo "NORMAL";}
				elseif ($r_urinario==3 || $r_urinario== "AUMENTADO" ){echo "AUMENTADO";}
				elseif ($r_urinario==0){echo "-";}
			?>
		    </td>

		    <td style="width:20%;text-align: left;">
			<?php 
				if ($r_evacuatorio==1 || $r_evacuatorio== "DISMINUIDO"){echo "DISMINUIDO";}
				elseif ($r_evacuatorio==2 || $r_evacuatorio== "NORMAL"){echo "NORMAL";}
				elseif ($r_evacuatorio==3 || $r_evacuatorio== "AUMENTADO"){echo "AUMENTADO";}
				elseif ($r_evacuatorio==0){echo "-";}
			?>
		    </td>

		    <td style="width:20%;text-align: left;">
			<?php 
				if ($sed==1 || $sed== "DISMINUIDO" ){echo "DISMINUIDO";}
				elseif ($sed==2 || $sed== "NORMAL"){echo "NORMAL";}
				elseif ($sed==3 || $sed== "AUMENTADO"){echo "AUMENTADO";}
				elseif ($sed==0){echo "-";}
			?>
		    </td>

		    <td style="width:20%;text-align: left;">
			<?php 
				if ($apetito==1 || $apetito== "DISMINUIDO"){echo "DISMINUIDO";}
				elseif ($apetito==2 || $apetito== "NORMAL"){echo "NORMAL";}
				elseif ($apetito==3 ||  $apetito== "AUMENTADO"){echo "AUMENTADO";}
				elseif ($apetito==0){echo "-";}
			?>
		    </td>
		
		    <td style="width:20%;text-align: left;">
			<?php 
				if ($sueno==1 || $sueno=="DISMINUIDO"){echo "DISMINUIDO";}
				elseif ($sueno==2 || $sueno=="NORMAL"){echo "NORMAL";}
				elseif ($sueno==3 || $sueno=="AUMENTADO"){echo "AUMENTADO";}
				elseif ($sueno==0){echo "-";}
			?>
		    </td>
		</tr>	
	</table>
	<br>
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
	    <tr>
	        <td style="width:100%; text-align:center;" class='midnight-red2'>ANTECEDENTES</td>
	    </tr>
	</table>
	<br>
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<tr >
		    <td style="width: 100%;" class='clouds' class='midnight-red2'>ANTECEDENTES PERSONALES</td>
		</tr>
		<tr>
		    <td style="width: 100%; text-align: left;"><?php echo strtoupper($antecedentes);  ?></td>
		</tr>
		<tr >
		    <td style="width: 100%;" class='clouds' class='midnight-red2'>ANTECEDENTES ALERGIAS</td>
		</tr>
		<tr>
		    <td style="width: 100%; text-align: left;"><?php echo strtoupper($des_antecedentes_ale);  ?></td>
		</tr>
		<tr >
		    <td style="width: 100%;" class='clouds' class='midnight-red2'>ANTECEDENTES FAMILIARES</td>
		</tr>
		<tr>
		    <td style="width: 100%; text-align: left;"><?php echo strtoupper($des_antecedentes_fam);  ?></td>
		</tr>
	</table>
	<br>
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
	    <tr>
	        <td style="width:100%;text-align:center;" class='midnight-red2'>EXAMEN FÍSICO</td>
	    </tr>
	</table>
	<br>
	<table  cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
        <tr >
            <td colspan="2" class='clouds' class='midnight-red2'>FRECUENCIA RESPIRATORIA </td>
            <td colspan="1" class='clouds' class='midnight-red2'>FRECUENCIA CARDÍACA</td>
            <td colspan="1" class='clouds' class='midnight-red2'>PRESIÓN ARTERIAL</td>
        </tr>
        <tr>
            <td colspan="2"><?php if($frecuencia_respiratoria != ""){echo strtoupper($frecuencia_respiratoria); echo " (POR MINUTO)";}else{}?></td>
            <td colspan="1"><?php if($frecuencia_cardiaca != ""){echo strtoupper($frecuencia_cardiaca); echo " (POR MINUTO)";}else{}?></td>
            <td colspan="1"><?php if($presion != ""){echo strtoupper($presion); echo " (MMHG)";}else{}?></td>
        </tr>
        <tr>
            <td style="width:25%" class='clouds' class='midnight-red2'>TEMPERATURA</td>
            <td style="width:25%" class='clouds' class='midnight-red2'>PESO</td>
            <td style="width:25%" class='clouds' class='midnight-red2'>TALLA</td>
            <td style="width:25%" class='clouds' class='midnight-red2'>IMC</td>
        </tr>
        <tr>
            <td style="width:25%"><?php if($temperatura != ""){echo strtoupper($temperatura); echo " (°C)";}else{}?></td>
            <td style="width:25%"><?php if($peso != ""){echo strtoupper($peso); echo " (KG)";}else{}?></td>
            <td style="width:25%"><?php if($talla != ""){echo strtoupper($talla); echo " (M)";}else{}?></td>
            <td style="width:25%"><?php if($imc != ""){echo strtoupper($imc);}else{}?></td>	
        </tr>	
	    <tr>
	        <td colspan="4" class='clouds' class='midnight-red2'>EXAMEN GENERAL</td>
	    </tr>
        <tr>
            <td colspan="4"><?php echo strtoupper($examen_general);  ?></td>
        </tr>
        <tr>
            <td colspan="4" class='clouds' class='midnight-red2'>EXAMEN PREFERENCIAL</td>
        </tr>
        <tr>
            <td colspan="4"><?php echo strtoupper($examen_preferencial);  ?></td>
        </tr>

	    <?php if($cod_especialidad == 41) { ?>	

        <tr>
            <td colspan="4" class='clouds' class='midnight-red2'>VISIÓN DE COLORES</td>
        </tr>
        <tr>
            <td colspan="4"><?php echo strtoupper($VISION_COLORES);  ?></td>
        </tr>
        <tr >
            <td colspan="4" class='clouds' class='midnight-red2'>BIOMICROSCOPIA</td>
        </tr>
        <tr>
            <td colspan="4"><?php echo strtoupper($BIOMICROSCOPIA);  ?></td>
        </tr>
        <tr >
            <td colspan="4" class='clouds' class='midnight-red2'>PÁRPADOS</td>
        </tr>
        <tr>
            <td colspan="4"><?php echo strtoupper($PARPADOS);  ?></td>
        </tr>
        <tr >
            <td colspan="4" class='clouds' class='midnight-red2'>APARATO LAGRIMAL</td>
        </tr>
        <tr>
            <td colspan="4"><?php echo strtoupper($APARATO_LAGRIMAL);  ?></td>
        </tr>
        <tr >
            <td colspan="4" class='clouds' class='midnight-red2'>CONJUNTIVA</td>
        </tr>
        <tr>
            <td colspan="4"><?php echo strtoupper($CONJUNTIVA);  ?></td>
        </tr>
        <tr >
            <td colspan="4" class='clouds' class='midnight-red2'>AGUDEZA VISUAL</td>
        </tr>

        <tr>
            <td colspan="4"><?php echo strtoupper($AGUDEZA_VISUAL);  ?></td>
        </tr>

        <tr >
            <td colspan="4" class='clouds' class='midnight-red2'>TONOMETRIA</td>
        </tr>

        <tr>
            <td colspan="4"><?php echo strtoupper($TONOMETRIA);  ?></td>
        </tr>
        <tr >
            <td colspan="4" class='clouds' class='midnight-red2'>FONDO DE OJO</td>
        </tr>
        <tr>
            <td colspan="4"><?php echo strtoupper($FONDO_OJO);  ?></td>
        </tr>

	    <?php } ?>

	</table>
    <br>

	<?php if ($cod_especialidad == 41) { ?>
	
	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
	    <tr>
	        <td style="width:100%;text-align:center;" class='midnight-red2'>PROCEDIMIENTO REFRACCIÓN</td>
	    </tr>
	</table>
	<br>

    <table cellspacing="5" style="width: 100%;text-align: left; font-size: 10pt;">
        <tr>
            <td style="width:24%;"></td>
            <td style="width:5%;text-align:center" class='clouds' class='midnight-red3'>OJO</td>
            <td style="width:10%;text-align:center" class='clouds' class='midnight-red3'>Sc</td>
            <td style="width:10%;text-align:center" class='clouds' class='midnight-red3'>Cc</td>
            <td style="width:10%;text-align:center" class='clouds' class='midnight-red3'>Ae</td>
            <td style="width:10%;"></td>
            <td style="width:10%;"></td>
            <td style="width:10%;"></td>
            <td style="width:1%;"></td>
            <td style="width:10%;"></td>
        </tr>        
        <tr>
            <td style="width:24%;" class='clouds' class='midnight-red3'>AGUDEZA VISUAL</td>
            <td style="width:5%;text-align:center;" class='clouds' class='midnight-red3'>OD</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AV_OD_SC;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AV_OD_CC;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AV_OD_AE;?></td>
            <td style="width:10%;"></td>
            <td style="width:10%;"></td>
            <td style="width:10%;"></td>
            <td style="width:1%;"></td>
            <td style="width:10%;"></td>
        </tr>
        <tr>
            <td style="width:24%;"></td>
            <td style="width:5%;text-align:center;" class='clouds' class='midnight-red3'>OI</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AV_OI_SC;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AV_OI_CC;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AV_OI_AE;?></td>
            <td style="width:10%;"></td>
            <td style="width:10%;"></td>
			<td style="width:10%;"></td>
            <td style="width:1%;"></td>
            <td style="width:10%;"></td>
        </tr>
        <tr>
            <td style="width:24%;"></td>
            <td style="width:5%;"></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red3'>Sph</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red3'>Cyl</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red3'>Eje</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red3'>AV</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red3'>ADD</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red3'>AV</td>
            <td style="width:1%;"></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red3'>DIP</td>
        </tr>
        <tr>
            <td style="width:24%;" class='clouds' class='midnight-red3'>SUBJETIVA</td>
            <td style="width:5%;text-align:center;" class='clouds' class='midnight-red3'>OD</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OD_SPH;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OD_CYL;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OD_EJE;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OD_AV1;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OD_ADD;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OD_AV2;?></td>
            <td style="width:1%;"></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OD_DIP;?></td>
        </tr>
        <tr>
            <td style="width:24%;"></td>
            <td style="width:5%;text-align:center;" class='clouds' class='midnight-red3'>OI</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OI_SPH;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OI_CYL;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OI_EJE;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OI_AV1;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OI_ADD;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OI_AV2;?></td>
            <td style="width:1%;text-align:center;" class='clouds' class='midnight-red3'>L</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_SJ_OI_DIP;?></td>
        </tr>
        <tr>
            <td style="width:24%;" class='clouds' class='midnight-red3'>CICLOPEJIA</td>
            <td style="width:5%;text-align:center;" class='clouds' class='midnight-red3'>OD</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OD_SPH;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OD_CYL;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OD_EJE;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OD_AV1;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OD_ADD;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OD_AV2;?></td>
            <td style="width:1%;"></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OD_DIP;?></td>
        </tr>
        <tr>
            <td style="width:24%;"></td>
            <td style="width:5%;text-align:center;" class='clouds' class='midnight-red3'>OI</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OI_SPH;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OI_CYL;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OI_EJE;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OI_AV1;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OI_ADD;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OI_AV2;?></td>
            <td style="width:1%;"></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_CC_OI_DIP;?></td>
        </tr>  
        <tr>
            <td style="width:24%;" class='clouds' class='midnight-red3'>AUTOREFRACTO</td>
            <td style="width:5%;text-align:center;" class='clouds' class='midnight-red3'>OD</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OD_SPH;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OD_CYL;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OD_EJE;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OD_AV1;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OD_ADD;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OD_AV2;?></td>
            <td style="width:1%;text-align:center;" class='clouds' class='midnight-red3'>C</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OD_DIP;?></td>
        </tr>
        <tr>
            <td style="width:24%;"></td>
            <td style="width:5%;text-align:center;" class='clouds' class='midnight-red3'>OI</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OI_SPH;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OI_CYL;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OI_EJE;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OI_AV1;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OI_ADD;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OI_AV2;?></td>
            <td style="width:1%;"></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_AR_OI_DIP;?></td>
        </tr>
        <tr>
            <td style="width:24%;" class='clouds' class='midnight-red3'>LENSOMETRIA</td>
            <td style="width:5%;text-align:center;" class='clouds' class='midnight-red3'>OD</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OD_SPH;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OD_CYL;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OD_EJE;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OD_AV1;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OD_ADD;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OD_AV2;?></td>
            <td style="width:1%;"></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OD_DIP;?></td>
        </tr>
        <tr>
            <td style="width:24%;"></td>
            <td style="width:5%;text-align:center;" class='clouds' class='midnight-red3'>OI</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OI_SPH;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OI_CYL;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OI_EJE;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OI_AV1;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OI_ADD;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OI_AV2;?></td>
            <td style="width:1%;"></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_LS_OI_DIP;?></td>
        </tr>
        <tr>
            <td style="width:24%;"></td>
            <td style="width:5%;"></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red3'>K1</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red3'>K2</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red3'>Eje</td>
            <td style="width:10%;"></td>
            <td style="width:10%;"></td>
            <td style="width:10%;"></td>
            <td style="width:1%;"></td>
            <td style="width:10%;"></td>
        </tr>
        <tr>
            <td style="width:24%;" class='clouds' class='midnight-red3'>KERATOMETRIA</td>
            <td style="width:5%;text-align:center;" class='clouds' class='midnight-red3'>OD</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_KT_OD_K1;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_KT_OD_K2;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_KT_OD_EJE;?></td>
            <td style="width:10%;"></td>
            <td style="width:10%;"></td>
            <td style="width:10%;"></td>
            <td style="width:1%;"></td>
            <td style="width:10%;"></td>
        </tr>
        <tr>
            <td style="width:24%;"></td>
            <td style="width:5%;text-align:center;" class='clouds' class='midnight-red3'>OI</td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_KT_OI_K1;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_KT_OI_K2;?></td>
            <td style="width:10%;text-align:center;" class='clouds' class='midnight-red4'><?php echo $REFL_KT_OI_EJE;?></td>
            <td style="width:10%;"></td>
            <td style="width:10%;"></td>
			<td style="width:10%;"></td>
            <td style="width:1%;"></td>
            <td style="width:10%;"></td>
        </tr>
        <tr>
            <td style="width:20%;" class='clouds' class='midnight-red3'>PIO Aire</td>
            <td style="width:5%;"></td>
            <td colspan="6" class='clouds' class='midnight-red4'><?php echo $REFL_PIO_AIRE;?></td>
            <td style="width:1%;"></td>
            <td style="width:10%;"></td>
        </tr>
    </table>
    <br>
    
    <?php } 

		//$count_query   = sqlsrv_query($conn, "SELECT count(*) AS numrows FROM hce_atencion_diagnostico a INNER JOIN hce_diagnostico d ON a.cod_diagnostico = d.cod_diagnostico WHERE a.tipo = '1' AND a.cod_atencion like '.$cod_atencion.'");
		$count_query = sqlsrv_query($conn, "SELECT count(*) AS numrows 
                                            FROM $BD..hce_atencion_diagnostico a 
                                            INNER JOIN $BD..hce_diagnostico d ON a.cod_diagnostico = d.cod_diagnostico 
                                            WHERE a.tipo = 1 AND a.cod_atencion = $cod_atencion");
		$row_count = sqlsrv_fetch_array($count_query);
		$numrows = $row_count['numrows'];


		//$sql_diagnostico_pres="SELECT d.cod_diagnostico, d.des_diagnostico FROM hce_atencion_diagnostico a INNER JOIN hce_diagnostico d ON a.cod_diagnostico = d.cod_diagnostico WHERE a.tipo = '1' AND a.cod_atencion like '.$cod_atencion.'";
		$sql_diagnostico_pres = "SELECT d.cod_diagnostico, d.des_diagnostico 
                                 FROM $BD..hce_atencion_diagnostico a 
                                 INNER JOIN $BD..hce_diagnostico d ON a.cod_diagnostico = d.cod_diagnostico 
                                 WHERE a.tipo = 1 AND a.cod_atencion  = $cod_atencion";
		$query_diagnostico_pres = sqlsrv_query($conn, $sql_diagnostico_pres);


		//$count_query2   = sqlsrv_query($conn, "SELECT count(*) AS numrows FROM hce_atencion_diagnostico a INNER JOIN hce_diagnostico d ON a.cod_diagnostico = d.cod_diagnostico WHERE a.tipo = '2' AND a.cod_atencion like '.$cod_atencion.'");
		$count_query2 = sqlsrv_query($conn, "SELECT count(*) AS numrows 
                                             FROM $BD..hce_atencion_diagnostico a 
                                             INNER JOIN $BD..hce_diagnostico d ON a.cod_diagnostico = d.cod_diagnostico 
                                             WHERE a.tipo = 2 AND a.cod_atencion  = $cod_atencion");
		$row_count2 = sqlsrv_fetch_array($count_query2);
		$numrows2 = $row_count2['numrows'];

 
		//$sql_diagnostico_def="SELECT d.cod_diagnostico, d.des_diagnostico FROM hce_atencion_diagnostico a INNER JOIN hce_diagnostico d ON a.cod_diagnostico = d.cod_diagnostico WHERE a.tipo = '2' AND a.cod_atencion like '.$cod_atencion.'";
		$sql_diagnostico_def = "SELECT d.cod_diagnostico, d.des_diagnostico 
                                FROM $BD..hce_atencion_diagnostico a 
                                INNER JOIN $BD..hce_diagnostico d ON a.cod_diagnostico = d.cod_diagnostico 
                                WHERE a.tipo = 2 AND a.cod_atencion  = $cod_atencion";
		$query_diagnostico_def = sqlsrv_query($conn, $sql_diagnostico_def); 
		
		if ($tip_estado_pa == 1) {
	?>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<tr>
			<td style="width:100%;text-align:center;" class='midnight-red2'>DIAGNÓSTICO</td>
		</tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<tr >
			<td colspan="2";class='clouds'; class='midnight-red2';">DIAGNÓSTICO PRESUNTIVO</td>
		</tr>

		<?php while ($row_diagnostico = sqlsrv_fetch_array($query_diagnostico_pres)){
			$cod_diagnostico = $row_diagnostico['cod_diagnostico'];
			$diagnostico = $row_diagnostico['des_diagnostico'];		
		?>

		<tr >
			<td style="width: 10%;" class='clouds' class='midnight-red2'>CIE10</td>
			<td style="width: 90%;" class='clouds' class='midnight-red2'>DIAGNÓSTICO</td>
		</tr>
		<tr>
			<td style="width: 10%; text-align: left;"><?php echo $cod_diagnostico ?></td>
			<td style="width: 90%; text-align: left;"><?php echo $diagnostico ?></td>
		</tr>

		<?php } ?>

		<tr >
			<td colspan="2" class='clouds' class='midnight-red2'>DIAGNÓSTICO DEFINITIVO</td>
		</tr>

		<?php while ($row_diagnostico2 = sqlsrv_fetch_array($query_diagnostico_def)){
			$cod_diagnostico2 = $row_diagnostico2['cod_diagnostico'];
			$diagnostico2 = $row_diagnostico2['des_diagnostico'];
		?>

		<tr >
			<td style="width: 10%;" class='clouds' class='midnight-red2'>CIE10</td>
			<td style="width: 90%;" class='clouds' class='midnight-red2'>DIAGNÓSTICO</td>
		</tr>
		<tr>
			<td style="width: 10%; text-align: left;"><?php echo $cod_diagnostico2 ?></td>
			<td style="width: 90%; text-align: left;"><?php echo $diagnostico2 ?></td>
		</tr>

		<?php } ?>
	</table>
	
	<?php } else { ?>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<tr>
			<td style="width:100%;text-align:center;" class='midnight-red2'>DIAGNÓSTICO</td>
		</tr>
	</table>

	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<tr>
			<td colspan="2" class='clouds' class='midnight-red2'>DIAGNÓSTICO PRESUNTIVO</td>
		</tr>

		<?php 
			$sql_dpre1 = sqlsrv_query($conn,"SELECT DES_DIAGNOSTICO FROM $BD..HCE_DIAGNOSTICO WHERE COD_DIAGNOSTICO = '$cod_diagnostico_pre1'"); 
			$rw_dpre1 = sqlsrv_fetch_array($sql_dpre1);	
			$des_diagnostico_pre1 = $rw_dpre1["DES_DIAGNOSTICO"];

			$sql_dpre2 = sqlsrv_query($conn,"SELECT DES_DIAGNOSTICO FROM $BD..HCE_DIAGNOSTICO WHERE COD_DIAGNOSTICO = '$cod_diagnostico_pre2'"); 
			$rw_dpre2 = sqlsrv_fetch_array($sql_dpre2);	
			$des_diagnostico_pre2 = $rw_dpre2["DES_DIAGNOSTICO"];
		?>

		<tr>
			<td style="width: 10%;" class='clouds' class='midnight-red2'>CIE10</td>
			<td style="width: 90%;" class='clouds' class='midnight-red2'>DIAGNÓSTICO</td>
		</tr>
		<tr>
			<td style="width: 10%; text-align: left;"><?php echo $cod_diagnostico_pre1 ?></td>
			<td style="width: 90%; text-align: left;"><?php echo $des_diagnostico_pre1 ?></td>
		</tr>
		<tr>
			<td style="width: 10%; text-align: left;"><?php echo $cod_diagnostico_pre2 ?></td>
			<td style="width: 90%; text-align: left;"><?php echo $des_diagnostico_pre2 ?></td>
		</tr>
		<tr>
			<td colspan="2" class='clouds' class='midnight-red2'>DIAGNÓSTICO DEFINITIVO</td>
		</tr>

		<?php 
			$sql_def1 = sqlsrv_query($conn,"SELECT DES_DIAGNOSTICO FROM $BD..HCE_DIAGNOSTICO WHERE COD_DIAGNOSTICO = '$cod_diagnostico_def1'"); 
			$rw_def1 = sqlsrv_fetch_array($sql_def1);	
			$des_diagnostico_def1 = $rw_def1["DES_DIAGNOSTICO"];

			$sql_def2 = sqlsrv_query($conn,"SELECT DES_DIAGNOSTICO FROM $BD..HCE_DIAGNOSTICO WHERE COD_DIAGNOSTICO = '$cod_diagnostico_def2'"); 
			$rw_def2 = sqlsrv_fetch_array($sql_def2);	
			$des_diagnostico_def2 = $rw_def2["DES_DIAGNOSTICO"];
		?>

		<tr >
			<td style="width: 10%;" class='clouds' class='midnight-red2'>CIE10</td>
			<td style="width: 90%;" class='clouds' class='midnight-red2'>DIAGNÓSTICO</td>
		</tr>
		<tr>
			<td style="width: 10%; text-align: left;"><?php echo $cod_diagnostico_def1; ?></td>
			<td style="width: 90%; text-align: left;"><?php echo $des_diagnostico_def1; ?></td>
		</tr>
		<tr>
			<td style="width: 10%; text-align: left;"><?php echo $cod_diagnostico_def2; ?></td>
			<td style="width: 90%; text-align: left;"><?php echo $des_diagnostico_def2; ?></td>
		</tr>
	</table>

	<?php } ?>

	<br>

	<?php

		$count_query3 = sqlsrv_query($conn, "SELECT count(*) AS numrows 
                                             FROM $BD..hce_atencion_plan a 
                                             INNER JOIN $BD..log_articulo_serv t ON a.cod_articulo_serv = t.cod_articulo_serv 
                                             WHERE a.cod_proveedor = 2 AND a.cod_atencion = $cod_atencion");
		$row_count3 = sqlsrv_fetch_array($count_query3);
		$numrows3 = $row_count3['numrows'];


		$sql_laboratorio = "SELECT t.cod_articulo_serv, t.des_articulo_serv 
                            FROM $BD..hce_atencion_plan a 
                            INNER JOIN $BD..log_articulo_serv t ON a.cod_articulo_serv = t.cod_articulo_serv 
                            WHERE a.cod_proveedor = 2 AND a.cod_atencion = $cod_atencion";
		$query_laboratorio = sqlsrv_query($conn, $sql_laboratorio);
		

		$count_query4 = sqlsrv_query($conn, "SELECT count(*) AS numrows 
                                             FROM $BD..hce_atencion_plan a 
                                             INNER JOIN $BD..log_articulo_serv t ON a.cod_articulo_serv = t.cod_articulo_serv 
                                             WHERE a.cod_proveedor = 1 AND a.cod_atencion = $cod_atencion");
		$row_count4 = sqlsrv_fetch_array($count_query4);
		$numrows4 = $row_count4['numrows'];


		$sql_procedimiento = "SELECT t.cod_articulo_serv, t.des_articulo_serv 
                              FROM $BD..hce_atencion_plan a 
                              INNER JOIN $BD..log_articulo_serv t ON a.cod_articulo_serv = t.cod_articulo_serv 
                              WHERE a.cod_proveedor = 1 AND a.cod_atencion = $cod_atencion";
		$query_procedimiento = sqlsrv_query($conn, $sql_procedimiento);


		$count_query5 = sqlsrv_query($conn, "SELECT count(*) AS numrows 
                                             FROM $BD..hce_atencion_plan a 
                                             INNER JOIN $BD..log_articulo_serv t ON a.cod_articulo_serv = t.cod_articulo_serv 
                                             WHERE a.cod_proveedor = 3 AND a.cod_atencion = $cod_atencion");
		$row_count5 = sqlsrv_fetch_array($count_query5);
		$numrows5 = $row_count5['numrows'];


		$sql_radiologico = "SELECT t.cod_articulo_serv, t.des_articulo_serv 
                            FROM $BD..hce_atencion_plan a 
                            INNER JOIN $BD..log_articulo_serv t ON a.cod_articulo_serv = t.cod_articulo_serv 
                            WHERE a.cod_proveedor = 3 AND a.cod_atencion = $cod_atencion";
		$query_radiologico = sqlsrv_query($conn, $sql_radiologico);


		$count_query6 = sqlsrv_query($conn, "SELECT count(*) AS numrows 
                                             FROM $BD..hce_atencion_interconsulta a 
                                             INNER JOIN $BD..cve_especialidad e ON a.cod_especialidad = e.cod_especialidad 
                                             WHERE a.cod_atencion = $cod_atencion");
		$row_count6 = sqlsrv_fetch_array($count_query6);
		$numrows6 = $row_count6['numrows'];


		$sql_interconsulta = "SELECT e.des_especialidad 
                              FROM $BD..hce_atencion_interconsulta a 
                              INNER JOIN $BD..cve_especialidad e ON  a.cod_especialidad = e.cod_especialidad 
                              WHERE a.cod_atencion = $cod_atencion";
		$query_interconsulta = sqlsrv_query($conn, $sql_interconsulta);


		$count_query7 = sqlsrv_query($conn,"SELECT count(*) AS numrows 
                                            FROM $BD..hce_atencion_tratamiento tra 
                                            WHERE tra.cod_atencion = $cod_atencion");
		$row_count7 = sqlsrv_fetch_array( $count_query7);
		$numrows7 = $row_count7['numrows'];	


		$sql_tratamiento = "SELECT * FROM $BD..hce_atencion_tratamiento tra WHERE tra.cod_atencion = $cod_atencion";
		$query_tratamiento = sqlsrv_query($conn, $sql_tratamiento);			
				
	?>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
	    <tr>
	        <td style="width:100%;text-align:center;" class='midnight-red2'>PLAN DE TRABAJO</td>
	    </tr>
	</table>
	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">

		<?php 
		    while ($row_laboratorio = sqlsrv_fetch_array($query_laboratorio)){
			    $cod_articulo = $row_laboratorio['cod_articulo_serv'];
			    $des_articulo = $row_laboratorio['des_articulo_serv'];
		?>

	    <tr>
	        <td colspan="4" class='clouds' class='midnight-red2'>EXÁMENES DE LABORATORIO</td>
	    </tr>
	    <tr>	
	        <td style="width: 80%; text-align: left;"><?php echo $des_articulo  ?></td>
	    </tr>

	    <?php } ?>

		<?php 
		    while ($row_procedimiento = sqlsrv_fetch_array($query_procedimiento)){
			    $cod_articulo2 = $row_procedimiento['cod_articulo_serv'];
			    $des_articulo2 = $row_procedimiento['des_articulo_serv'];
		?>
	    
        <tr>
	        <td colspan="4" class='clouds' class='midnight-red2'>PROCEDIMIENTOS ESPECIALES</td>
	    </tr>
	    <tr>	
	        <td style="width: 80%; text-align: left;"><?php echo $des_articulo2  ?></td>
	    </tr>
	    
        <?php } ?>

		<?php 
		    while ($row_radiologico = sqlsrv_fetch_array($query_radiologico)){
			    $cod_articulo3 = $row_radiologico['cod_articulo_serv'];
			    $des_articulo3 = $row_radiologico['des_articulo_serv'];
		?>

	    <tr >
	        <td colspan="4" class='clouds' class='midnight-red2'>EXÁMENES RADIOLÓGICOS</td>
	    </tr>
	    <tr>
	        <td style="width: 80%; text-align: left;"><?php echo $des_articulo3;  ?></td>
	    </tr>
	    
        <?php } ?>

		<?php 
		    while ($row_interconsulta = sqlsrv_fetch_array($query_interconsulta)){
			    $des_especialidad = $row_interconsulta['des_especialidad'];			
		?>

	    <tr>
	        <td colspan="4" class='clouds' class='midnight-red2'>INTERCONSULTA</td>
	    </tr>
	    <tr>
	        <td style="width: 100%; text-align: left;"><?php echo $des_especialidad; ?></td>
	    </tr>

	    <?php } ?>
	
    </table>
	<br>

    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
	    <tr>
	        <td style="width:100%;text-align:center;" class='midnight-red2'>TRATAMIENTO</td>
	    </tr>
	</table>
	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
	    <?php 
	    	while($rw_tratamiento = sqlsrv_fetch_array($query_tratamiento)){
	    		$nombre_medicamento = $rw_tratamiento["nombre_medicamento"];
	    		$forma = $rw_tratamiento["forma"];
	    		$dosis = $rw_tratamiento["dosis"];
	    		$cantidad = $rw_tratamiento["cantidad"];
	    		$indicacion = $rw_tratamiento["indicacion"];			
	    ?>
    
	    <tr>
	        <td style="width: 75%;" class='clouds' class='midnight-red2'>NOMBRE DE MEDICAMENTO</td>
	        <td style="width: 25%;" class='clouds' class='midnight-red2'>FORMA</td>	
	    </tr>
	    <tr>	
	        <td style="width: 75% text-align: center;"> <?php echo $nombre_medicamento; ?></td>
	        <td style="width: 25% text-align: center;"> <?php echo strtoupper($forma); ?></td>	
	    </tr>
	    <tr >
	        <td style="width: 75%" class='clouds' class='midnight-red2'>DOSIS</td>
	        <td style="width: 25%" class='clouds' class='midnight-red2'>CANTIDAD</td>	
	    </tr>
	    <tr>
	        <td style="width: 75% text-align: center;"> <?php echo strtoupper($dosis); ?></td>
	        <td style="width: 25% text-align: center;"> <?php echo strtoupper($cantidad); ?></td>	
	    </tr>

        <?php } ?>

    </table>
	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
		<tr>
			<td style="width: 100%;class='clouds'; class='midnight-red2';"><?php if($tip_estado_pa != 1 ) { echo "DESCRIPCIÓN";} else { echo "MEDIDAS HIGIÉNICO DIETÉTICAS"; }?></td>
		</tr>
		<tr>
			<td style="width: 100% text-align: left;"> <?php echo strtoupper($medidas_higienicas); ?></td>
		</tr>
	</table>
	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
	    <tr>
	        <td style="width:100%;text-align:center;" class='midnight-red2'>OBSERVACIONES</td>
	    </tr>
	</table>
	<br>

	<table cellspacing="0" style="width: 100%; text-align: left; font-size: 10pt;">
	    <tr>
	        <td style="width: 75%;" class='clouds' class='midnight-red2'>OBSERVACIÓN</td>
	        <td style="width: 25%;" class='clouds' class='midnight-red2'>PRÓXIMA CITA</td>                
	    </tr>
	    <tr>                
	        <td style="width: 75% text-align: center;"> <?php echo strtoupper($observacion); ?></td>
	        <td style="width: 25% text-align: center;">  </td>
        </tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<div style="font-size:10pt; text-align:center; font-weight:bold"></div>

</page>


